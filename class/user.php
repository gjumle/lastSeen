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

    public static function handleForm() {
        if (isset($_POST['register'])) {
            $password_hash = self::hashPassword($_POST['password']);
            $user = new User (null, $_POST['username'], $password_hash, $_POST['email'], 0, $_POST['city']);
            $user->insertToDB();
            echo 'New user registerd';
        } elseif (isset($_POST['login'])) {
            $user = new User (null, $_POST['username'], null, null, null, null);
            $password_hash = self::hashPassword($_POST['password']);
            $user->password = $password_hash;
            $user->uid = $user->checkUserLogin();
            if ($user->uid) {
                $user = $user->getUserData();
                setcookie("logged_in", true, time() + (86400 * 30));
                setcookie("uid", $user->uid, time() + (86400 * 30));
                setcookie("username", $user->username, time() + (86400 * 30));
                setcookie("admin", $user->admin, time() + (86400 * 30));
                header("Location: account.php");
            } else {
                echo 'Login Failed';
            }
        }
    }
    
    
    public static function hashPassword($password) {
        return md5($password);
    }
    

    public function insertToDB() {
        $conn = DB::connect();
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, admin, city) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssds", $this->username, $this->password, $this->email, $this->admin, $this->city);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
    
    public function saveToDB() {
        $conn = DB::connect();
        $stmt = $conn->prepare("UPDATE users SET username=?, password=?, email=?, city=? WHERE uid=?");
        $stmt->bind_param("ssssi", $this->username, $this->password, $this->email, $this->city, $this->uid);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
    
    public function deleteFromDB() {
        $conn = DB::connect();
        $stmt = $conn->prepare("DELETE FROM users WHERE uid=?");
        $stmt->bind_param("i", $this->uid);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
    

    public function checkUserLogin() {
        $conn = DB::connect();
        $sql = 'SELECT uid FROM users WHERE username = ? AND password = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $this->username, $this->password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $uid = $row['uid'];
        }
        $stmt->close();
        $conn->close();
        return $uid;
    }
    
    public function getUserData() {
        $conn = DB::connect();
        $sql = 'SELECT * FROM users WHERE uid = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $this->uid);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->uid = $row['uid'];
            $this->username = $row['username'];
            $this->password = $row['password'];
            $this->email = $row['email'];
            $this->admin = $row['admin'];
            $this->city = $row['city'];
        }
        $stmt->close();
        $conn->close();
        return $this;
    }
      
}