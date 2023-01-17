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
        return md5($password);
    }

    public static function handleForm() {
        if (isset($_POST['submit'])) {
            if (isset($_GET['register'])) {
                $password_hash = self::hashPassword($_POST['password']);
                $user = new User (null, $_POST['username'], $password_hash, $_POST['email'], 0, $_POST['city']);
                $user->insertToDB();
                echo 'New user registerd';
            }
            if (isset($_GET['login'])) {
                $user = new User (null, $_POST['username'], null, null, null, null);
                $password_hash = self::hashPassword($_POST['password']);
                $user->password = $password_hash;
                $user->uid = $user->checkUserLogin();
                if ($uid = $user->uid) {
                    echo 'User successfuly logged in';
                    echo $uid;
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
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $uid = $row['uid'];
        }
        $conn->close();
        return $uid;
    }

    public function getPassword() {
        $conn = DB::connect();
        $sql = 'SELECT password FROM users WHERE username ="' . $this->username . '"';
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $password = $row['password'];
        }
        $conn->close();
        return $password;
    }
}