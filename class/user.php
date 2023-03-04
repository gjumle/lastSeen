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

    public static function getPasswordStealth($password) {
        $stealth = "";
        for ($i = 0; $i < strlen($password); $i++) {
            $stealth .= "*";
        }
        return $stealth;
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
}