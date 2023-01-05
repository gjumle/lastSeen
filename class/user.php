<?php

function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

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

    public static function renderRegisterForm() {
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
    }

    public static function renderLoginForm() {
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
}