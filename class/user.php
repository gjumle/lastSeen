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

    public static function renderRegisterForm() {
        if (isset($_POST['edit'])) {
            $uid = $this->uid;
            $username = $this->username;
            $password = $this->password;
            $email = $this->email;
            $admin = $this->admin;
            $city = $this->city;
            $action = 'edit';
        } else {
            $uid = '';
            $username = '';
            $password = '';
            $email = '';
            $admin = '';
            $city = '';
            $action = 'insert';
        }
        return "
            <h1>Registration</h1>
            <form action='' method='post'>
                <label for=uid>#UID</label>
                <input type=text name=uid id=uid value=" . $uid . "></input>

                <label for=username>Username</label>
                <input type=text name=username id=username value=" . $username . "></input>

                <label for=password>Password</label>
                <input type=password name=password id=password value=" . $password . "></input>

                <labe for=email>E-Mail</label>
                <input type=text name=email id=email value=" . $email . "></input>

                <label for=admin>Admin</label>
                <input type=text name=admin id=admin value=" . $admin . "></input>

                <label for=city>City</label>
                <input type=text name=city id=city value=" . $city . "></label>

                <input type=submit name=" . $action . " id=submit value=Save></input>
            </form>
        ";
    }

    public function insertToDB() {
        $conn = DB::connect();
        $sql = 'INSERT INTO users VALUES (' . $uid . ', "' . $username . '", "' . $password . '", "' . $email . '", ' . $admin . ', "' . $city . '")';
        $conn->query($sql);
        $conn->close();
    }

    public function saveToDB() {
        $conn = DB::connect();
        $sql = '';
        $conn->query($sql);
        $conn->close();
    }
}