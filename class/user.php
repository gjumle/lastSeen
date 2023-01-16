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

    public static function renderForm() {
        if (isset($_GET['register'])) {
            return "
                <div class='registration-form'>
                    <h1>Registration</h1>
                    <form action='' method='post'>

                        <label for=username>Username</label>
                        <input type=text name=username id=username></input>

                        <label for=password>Password</label>
                        <input type=password name=password id=password></input>

                        <labe for=email>E-Mail</label>
                        <input type=text name=email id=email></input>

                        <label for=city>City</label>
                        <input type=text name=city id=city></label>

                        <input type=submit name=submit id=submit value=submit></input>
                    </form>
                </div>
            ";
        }
        if (isset($_GET['login'])) {
            return "
                <div class='login-form'>
                    <h1>Login</h1>
                    <form action='' method='post'>

                        <label for=username>Username</label>
                        <input type=text name=username id=username></input>

                        <label for=password>Password</label>
                        <input type=password name=password id=password></input>

                        <input type=submit name=submit id=submit value=submit></input>
                    </form>
                </div>
            ";
        }
    }

    public static function hashPassword($password) {
        $password = $_POST['password'];
        $salt = "$2y$10$" . strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
        $hash = crypt($password, $salt);
        return $hash;
    }

    public static function verifyHashPassword($password) {
        $password = $_POST['password'];
        $hashed_password = self::getPassword();
        return crypt($password, $hashed_password) === $hashed_password ? true : false;
    }

    public static function handleForm() {
        if (isset($_POST['submit'])) {
            if (isset($_GET['register'])) {
                $password = self::hashPassword($_POST['password']);
                $user = new User (null, $_POST['username'], $password, $_POST['email'], 0, $_POST['city']);
                $user->insertToDB();
                echo 'New user registerd';
            }
            if (isset($_GET['login'])) {
                $password = 
                $user = new User (null, $_POST['username'], $password, null, null, null);
                $uid = $user->checkUserLogin();
                if ($uid) {
                    echo 'User successfuly logged in';
                } else {
                    echo 'Incorrect username or password';
                }
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
        $conn->query($sql);
        $conn->close();
    }

    public function getPassword() {
        $conn = DB::connect();
        $sql = 'SELECT password FROM users WHERE username ="' . $this->username . '"';
        $conn->query($sql);
        $conn->close();
    }
}