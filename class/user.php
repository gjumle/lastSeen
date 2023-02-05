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

    public static function editForm() {
        // Get the current user's data
        $user = User::getCurrentUser();
    
        return "
            <div class='registration-form'>
                <h1>Edit</h1>
                <form action='edit-account.php' method='post'>
                    <label for='username'>Username</label>
                    <input type='text' name='username' id='username' value='".$user['username']."'>
                    <span class='error-message'></span>
                    <label for='password'>Password</label>
                    <input type='password' name='password' id='password' value='".$user['password']."'>
                    <span class='error-message'></span>
                    <label for='email'>E-Mail</label>
                    <input type='text' name='email' id='email' value='".$user['email']."'>
                    <span class='error-message'></span>
                    <label for='city'>City</label>
                    <input type='text' name='city' id='city' value='".$user['city']."'>
                    <span class='error-message'></span>
                    <input type='submit' name='register' id='submit' value='submit'>
                </form>
            </div>
        ";
    }
    

    public static function handleForm() {
        if (isset($_POST['register'])) {
            $password_hash = self::hashPassword($_POST['password']);
            $user = new User (null, $_POST['username'], $password_hash, $_POST['email'], 0, $_POST['city']);
            $user->insertToDB();
            echo 'New user registered';
        } elseif (isset($_POST['login'])) {
            $password_hash = self::hashPassword($_POST['password']);
            $user = new User (null, $_POST['username'], $password_hash, null, null, null);
            $user = $user->getData();
            if ($user->uid) {
                setcookie("logged_in", true, time() + (86400 * 30));
                setcookie("uid", $user->uid, time() + (86400 * 30));
                setcookie("username", $user->username, time() + (86400 * 30));
                setcookie("admin", $user->admin, time() + (86400 * 30));
                header("Location: account.php");
            } else {
                echo 'Login Failed';
            }
        } elseif (isset($_POST['edit'])) {
            $user = User::getData();
            $user->updateData($_POST['email'], $_POST['password'], $_POST['city']);
            header("Location: account.php");
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

    public function getData() {
        $conn = DB::connect();
        $sql = 'SELECT * FROM users WHERE username = ? AND password = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $this->username, $this->password);
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

    static function renderAccount() {
        $conn = DB::connect();
        if (isset($_COOKIE['uid'])) {
            $user_id = $_COOKIE['uid'];
            $sql = 'SELECT * FROM users WHERE uid = ?';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $username = $row['username'];
                $email = $row['email'];
                $city = $row['city'];
            }
            $stmt->close();
        }
        $conn->close();
    
        $output = '<table class="user-table">';
        $output .= '<tr><th>Username</th><td>' . $username . '</td></tr>';
        $output .= '<tr><th>Email</th><td>' . $email . '</td></tr>';
        $output .= '<tr><th>City</th><td>' . $city . '</td></tr>';
        $output .= '<tr><td colspan="2"><a href="edit-account.php" class="edit-button">Edit</a></td></tr>';
        $output .= '</table>';
    
        return $output;
    }

    
}