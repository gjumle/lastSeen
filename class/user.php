<?php 

class User {
    private $uid;
    private $name;
    private $password;
    private $admin;
    private $email;

    public function __construct($uid = null, $name = null, $password = null, $admin = null, $email = null) {
        $this->uid = $uid;
        $this->name = $name;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->admin = $admin;
        $this->email = $email;
    }

    public function getUid() {
        return $this->uid;
    }

    public function getName() {
        return $this->name;
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

    public function setName($name) {
        $this->name = $name;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function deleteFromDB() {
        $db = DB::connect();
        $sql = "DELETE FROM users WHERE uid = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $this->uid);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function insertToDB() {
        $db = DB::connect();
        $sql = "INSERT INTO users (name, password, admin, email) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssis", $this->name, $this->password, $this->admin, $this->email);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function saveToDB() {
        $db = DB::connect();
        $sql = "UPDATE users SET name = ?, password = ?, admin = ?, email = ? WHERE uid = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssisi", $this->name, $this->password, $this->admin, $this->email, $this->uid);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public static function loginUser() {
        $db = DB::connect();
        $sql = "SELECT * FROM users WHERE name = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $_POST['name']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $db->close();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($_POST['password'], $row['password'])) {
                $_SESSION['uid'] = $row['uid'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['admin'] = $row['admin'];
                return true;
            }
        }
        return false;
    }

    public static function registerForm() {
        return "
            <form action='index.php' method='post'>
                <input type='hidden' name='action' value='register'>
                <input type='text' name='name' placeholder='Name' required>
                <input type='password' name='password' placeholder='Password' required>
                <input type='email' name='email' placeholder='Email' required>
                <input type='submit' value='Register'>
            </form>";
    }

    public static function loginForm() {
        return "
            <form action='index.php' method='post'>
                <input type='hidden' name='action' value='login'>
                <input type='text' name='name' placeholder='Name' required>
                <input type='password' name='password' placeholder='Password' required>
                <input type='submit' value='Login'>
            </form>";
    }

    public static function logoutForm() {
        return "
            <form action='index.php' method='post'>
                <input type='hidden' name='action' value='logout'>
                <input type='submit' value='Logout'>
            </form>";
    }

    public static function handleForm() {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'register':
                    $user = new User(null, $_POST['name'], $_POST['password'], 0, $_POST['email']);
                    $user->insertToDB();
                    header("Location: login.php");
                    break;
                case 'login':
                    if (User::loginUser()) {
                        header("Location: account.php");
                    } else {
                        echo "Login failed";
                    }
                    break;
                case 'logout':
                    session_destroy();
                    header("Location: login.php");
                    break;
            }
        }
    }
}