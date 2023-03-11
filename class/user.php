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
        $this->admin = ($admin) ? $admin : 0;
        $this->email = $email;
    }

    public function getUid() {
        return $this->uid;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getF_name() {
        return $this->f_name;
    }

    public function getL_name() {
        return $this->l_name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setUid($uid) {
        $this->uid = $uid;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setF_name($f_name) {
        $this->f_name = $f_name;
    }

    public function setL_name($l_name) {
        $this->l_name = $l_name;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function setEmail($email) {
        $this->email = $email;
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

    public function login() {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM users WHERE email = ? OR username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->email, $this->username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['username'] != $this->username && $this->username != null) {
            return "<span class='error'>Wrong username</span>";
        }
        if ($row['email'] != $this->email && $this->email != null) {
            return "<span class='error'>Wrong email</span>";
        }

        if (password_verify($this->password, $row['password'])) {
            setcookie('uid', $row['uid'], time() + (86400 * 30), '/');
            setcookie('username', $row['username'], time() + (86400 * 30), '/');
            setcookie('f_name', $row['f_name'], time() + (86400 * 30), '/');
            setcookie('l_name', $row['l_name'], time() + (86400 * 30), '/');
            setcookie('email', $row['email'], time() + (86400 * 30), '/');
            setcookie('admin', $row['admin'], time() + (86400 * 30), '/');
            setcookie('logged_in', true, time() + (86400 * 30), '/');
            header("Location: ./dashboard.php");
        } else {
            return "<span class='error'>Wrong password</span>";
        }
    }

    public static function logout() {
        if (isset($_GET['logout'])) {
            setcookie('uid', '', time() - 3600, '/');
            setcookie('username', '', time() - 3600, '/');
            setcookie('f_name', '', time() - 3600, '/');
            setcookie('l_name', '', time() - 3600, '/');
            setcookie('email', '', time() - 3600, '/');
            setcookie('admin', '', time() - 3600, '/');
            setcookie('logged_in', '', time() - 3600, '/');
            header("Location: ./login.php");
        }
    }

    public function register() {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM users WHERE email = ? OR username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->email, $this->username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['username'] == $this->username && $this->username != null) {
            return "<span class='error'>Username already exists</span>";
        } else
        if ($row['email'] == $this->email && $this->email != null) {
            return "<span class='error'>Email already exists</span>";
        } else {
            $this->insertToDB();
            header("Location: ./login.php");
        }
    }
}