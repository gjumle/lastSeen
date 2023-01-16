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
        $this->usermame = $username;
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

                        <input type=submit name=register id=submit value=submit></input>
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

                        <input type=submit name=login id=submit value=submit></input>
                    </form>
                </div>
            ";
        }
    }

    public static function hashPassword($password) {
        $password = $_POST['password'];
        $hash = md5($password);
        return $hash;
    }

    public function handleForm() {
        if (isset($_POST['register'])) {
            $password = hashPassword($_POST['password']);
            $user = new User ($_POST['username'], $password, $_POST['email'], $_POST['admin'], $_POST['city']);
            $user->insertToDB();
        }
        if (isset($_POST['login'])) {
            $password = hashPassword($_POST['password']);
            $user = new User ($_POST['username'], $password);
            $u_id = $user->checkUserLogin();
            if ($u_id) {
                echo 'User successfuly logged in!';
            } else {
                echo 'Incorrect username or password';
            }
        }
    }

    public function insertToDB() {
        $conn = DB::connect();
        $sql = 'INSERT INTO users (uid, username, password, email, admin, city) VALUES (' . $uid . ', "' . $username . '", "' . $password . '", "' . $email . '", ' . $admin . ', "' . $city . '")';
        $conn->query($sql);
        $conn->close();
    }

    public function saveToDB() {
        $conn = DB::connect();
        $sql = 'UPDATE users SET username ="' . $username . '", password ="' . $password . '", email = "' . $admin . '", city = "' . $city . '" WHERE uid = ' . $uid;
        $conn->query($sql);
        $conn->close();
    }

    public function delefeFromDB() {
        $conn = DB::connect();
        $sql = 'DELETE FROM users WHERE uid=' . $uid;
        $conn->query($sql);
        $conn->close();
    }

    public function checkUserLogin() {
        $conn = DB::connect();
        $sql = 'SELECT u_id FROM users WHERE username ="' . $user->username . '" AND password ="' . $user->password . '"';
        $conn->query($sql);
        $conn->close();
    }
}