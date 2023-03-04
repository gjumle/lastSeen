<?php 

class User {
    private $uid;
    private $username;
    private $f_name;
    private $l_name;
    private $password;
    private $admin;
    private $email;

    public function __construct($uid = null, $username = null, $f_name = null, $l_name = null, $password = null, $admin = null, $email = null) {
        $this->uid = $uid;
        $this->username = $username;
        $this->f_name = $f_name;
        $this->l_name = $l_name;
        $this->password = $password;
        $this->admin = $admin;
        $this->email = $email;
    }

    public static function getAdminString($admin) {
        if ($admin == 1) {
            return "Yes";
        } else {
            return "No";
        }
    }

    public static function updateCookies($uid) {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM users WHERE uid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$uid]);
        $row = $stmt->fetch();
        setcookie('uid', $row['uid'], time() + 3600, '/');
        setcookie('username', $row['username'], time() + 3600, '/');
        setcookie('f_name', $row['f_name'], time() + 3600, '/');
        setcookie('l_name', $row['l_name'], time() + 3600, '/');
        setcookie('email', $row['email'], time() + 3600, '/');
        setcookie('password', $row['password'], time() + 3600, '/');
        setcookie('admin', $row['admin'], time() + 3600, '/');
    }

    public function deleteFromDB() {
        $pdo = DB::connectPDO();
        $sql = "DELETE FROM users WHERE uid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->uid]);
    }

    public function insertToDB() {
        $pdo = DB::connectPDO();
        $sql = "INSERT INTO users (username, f_name, l_name, password, admin, email) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->username, $this->f_name, $this->l_name, $this->password, $this->admin, $this->email]);
    }

    public function saveToDB() {
        $pdo = DB::connectPDO();
        $sql = "UPDATE users SET username = ?, f_name = ?, l_name = ?, password = ?, admin = ?, email = ? WHERE uid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->username, $this->f_name, $this->l_name, $this->password, $this->admin, $this->email, $this->uid]);
        self::updateCookies($this->uid);
    }

    public static function login($email, $password) {
        if (isset($_COOKIE['logged_in'])) {
            header("Location: ./dashboard.php");
        }
        $user = new User();
        $user->email = $email;
        $user->password = $password;
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user->email]);
        $row = $stmt->fetch();

        if ($row == null) {
            echo "Wrong email";
            return;
        }

        if (password_verify($user->password, $row['password'])) {
            setcookie('uid', $row['uid'], time() + 3600, '/');
            setcookie('username', $row['username'], time() + 3600, '/');
            setcookie('f_name', $row['f_name'], time() + 3600, '/');
            setcookie('l_name', $row['l_name'], time() + 3600, '/');
            setcookie('email', $row['email'], time() + 3600, '/');
            setcookie('password', $row['password'], time() + 3600, '/');
            setcookie('admin', $row['admin'], time() + 3600, '/');
            setcookie('logged_in', true, time() + 3600, '/');
            header("Location: ./dashboard.php");
        }
        else {
            echo "Wrong password";
            return;
        }
    }

    public static function logout() {
        if (isset($_GET['logout'])) {
            setcookie('uid', '', time() - 3600, '/');
            setcookie('username', '', time() - 3600, '/');
            setcookie('f_name', '', time() - 3600, '/');
            setcookie('l_name', '', time() - 3600, '/');
            setcookie('email', '', time() - 3600, '/');
            setcookie('password', '', time() - 3600, '/');
            setcookie('admin', '', time() - 3600, '/');
            setcookie('logged_in', '', time() - 3600, '/');
            header("Location: ./login.php");
        }
    }

    public static function getUsers($uid) {
        $pdo = DB::connectPDO();
        $conndition = ($uid == null) ? "" : "WHERE uid = ?";
        $sql = "SELECT * FROM users $conndition";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$uid]);
        $rows = $stmt->fetchAll();
        $users = [];
        foreach ($rows as $row) {
            $user = new User($row['uid'], $row['username'], $row['f_name'], $row['l_name'], $row['password'], $row['admin'], $row['email']);
            $users[] = $user;
        }
        return $users;
    }

    public static function getUser($uid) {
        return self::getUsers($uid)[0];
    }

    public static function register($username, $f_name, $l_name, $password, $email) {
        $user = new User(NULL, $username, $f_name, $l_name, password_hash($password, PASSWORD_DEFAULT), 0, $email);
        $user->insertToDB();
        header("Location: ./login.php");
    }

    public static function edit($uid, $username, $f_name, $l_name, $password, $email) {
        $user = new User($uid, $username, $f_name, $l_name, password_hash($password, PASSWORD_DEFAULT), 0, $email);
        $user->saveToDB();
        header("Location: ./profile.php");
    }

    public static function renderLogin() {
        return
            "<div class='container'>
                <div class='login'>
                    <form action='login.php' method='POST'>
                        <input type='email' name='email' placeholder='Email'>
                        <input type='password' name='password' placeholder='Password'>
                        <input type='submit' value='Login'>
                    </form>
                </div>
            </div>";
    }

    public static function renderRegister() {
        return 
            "<div class='container'>
                <div class='register'>
                    <form action='register.php' method='POST'>
                        <input type='text' name='username' placeholder='User Name'>
                        <input type='text' name='f_name' placeholder='First Name'>
                        <input type='text' name='l_name' placeholder='Last Name'>
                        <input type='email' name='email' placeholder='Email'>
                        <input type='password' name='password' placeholder='Password'>
                        <input type='submit' value='Register'>
                    </form>
                </div>
            </div>";
    }

    public static function renderProfile() {
        $user = self::getUser($_COOKIE['uid']);
        if (isset($_GET['edit'])) {
            return
                "<div class='container'>
                    <div class='profile'>
                        <h1>Profile</h1>
                    </div>
                    <table>
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Admin</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <form action='profile.php' method='POST'>
                                <td><input type='text' name='username' value='" . $user->username . "'</td>
                                <td><input type='text' name='f_name' value='" . $user->f_name . "'</td>
                                <td><input type='text' name='l_name' value='" . $user->l_name . "'</td>
                                <td><input type='email' name='email' value='" . $user->email . "'</td>
                                <td><input type='password' name='password'</td>
                                <td>" . User::getAdminString($user->admin) . "</td>
                                <td><input type='submit' value='Save'></td>
                            </form>
                        </tr>
                </div>";
        } else {
            return
                "<div class='container'>
                    <div class='profile'>
                        <h1>Profile</h1>
                    </div>
                    <table>
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Admin</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <td>" . $user->username . "</td>
                            <td>" . $user->f_name . "</td>
                            <td>" . $user->l_name . "</td>
                            <td>" . $user->email . "</td>
                            <td>******</td>
                            <td>" . User::getAdminString($user->admin) . "</td>
                            <td><a href='?edit=" . $user->uid . "'>Edit</a></td>
                        </tr>
                </div>";
        }
    }
}