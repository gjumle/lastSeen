<?php

class User {
    private $uid;
    private $username;
    private $password;
    private $email;
    private $admin;
    private $city;

    public function __construct($uid = null, $username = null, $password = null, $email = null, $admin = null, $city = null) {
        $this->uid = $uid;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->admin = $admin;
        $this->city = $city;
    }

    public static function registerForm() {
        return "
            <div class='registration-form'>
                <h1>Registration</h1>
                <form action='register.php' method='post'>
                    <label for='username'>Username</label>
                    <input type='text' name='username' id='username'>
                    <span class='error-message'></span>
                    <label for='password'>Password</label>
                    <input type='password' name='password' id='password'>
                    <span class='error-message'></span>
                    <label for='email'>E-Mail</label>
                    <input type='text' name='email' id='email'>
                    <span class='error-message'></span>
                    <label for='city'>City</label>
                    <input type='text' name='city' id='city'>
                    <span class='error-message'></span>
                    <input type='submit' name='register' id='submit' value='submit'>
                </form>
            </div>
        ";
    }

    public static function loginForm() {
        return "
        <div class='login-form'>
            <h1>Login</h1>
            <form action='login.php' method='post'>
                <label for='username'>Username</label>
                <input type='text' id='username' name='username'>
                <span class='error-message'></span>
                <label for='password'>Password</label>
                <input type='password' id='password' name='password'>
                <span class='error-message'></span>
                <input type='submit' name='login' id='submit' value='submit'>
            </form>
        </div>
    ";
    }

    public static function hashPassword($password) {
        return md5($password);
    }

    public static function handleForm() {
        if (isset($_POST['register'])) {
            $password_hash = self::hashPassword($_POST['password']);
            $user = new User (null, $_POST['username'], $password_hash, $_POST['email'], 0, $_POST['city']);
            $user->insertToDB();
            echo 'New user registerd';
        }
        if (isset($_POST['login'])) {
            $user = new User (null, $_POST['username'], null, null, null, null);
            $password_hash = self::hashPassword($_POST['password']);
            $user->password = $password_hash;
            $user->uid = $user->checkUserLogin();
            $user = $user->getUserData();
            if ($user->uid) {
                setcookie("logged_in", true, time() + (86400 * 30));
                setcookie("uid", $user->uid, time() + (86400 * 30));
                setcookie("username", $user->username, time() + (86400 * 30));
                setcookie("admin", $user->admin, time() + (86400 * 30));
                header("Location: account.php");
            }
        }
    }

    public function insertToDB() {
        $conn = DB::connect();
        $sql = 'INSERT INTO users (username, password, email, admin, city) VALUES ("' . $this->username . '", "' . $this->password . '", "' . $this->email . '", ' . $this->admin . ', "' . $this->city . '")';
        $conn->query($sql);
        $conn->close();
    }

    public function saveToDB() {
        $conn = DB::connect();
        $sql = 'UPDATE users SET username ="' . $this->username . '", password ="' . $this->password . '", email = "' . $this->admin . '", city = "' . $this->city . '" WHERE uid = ' . $this->uid;
        $conn->query($sql);
        $conn->close();
    }

    public function delefeFromDB() {
        $conn = DB::connect();
        $sql = 'DELETE FROM users WHERE uid=' . $this->uid;
        $conn->query($sql);
        $conn->close();
    }

    public function checkUserLogin() {
        $conn = DB::connect();
        $sql = 'SELECT uid FROM users WHERE username ="' . $this->username . '" AND password ="' . $this->password . '"';
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $uid = $row['uid'];
        }
        $conn->close();
        return $uid;
    }

    public function getUserData() {
        $conn = DB::connect();
        $sql = 'SELECT uid, password, email, admin, city FROM users WHERE username = '.$this->username;
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        while ($row = $resul->fetch_assoc()) {
            $user = new User ($row['uid'], $this->username, $row['password'], $row['email'], $row['admin'], $row['city']);
        }
        $conn->close();
        return $user;
    }
}