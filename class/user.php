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
        $sql = "INSERT INTO users (name, password, email) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sss", $this->name, $this->password, $this->email);
        $stmt->execute();
        $stmt->close();
        var_dump($stmt);
        $db->close();
    }

    public function saveToDB() {
        $db = DB::connect();
        $sql = "UPDATE users SET name = ?, password = ?, email = ? WHERE uid = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssi", $this->name, $this->password, $this->email, $this->uid);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function login() {
        $db = DB::connect();
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        if (password_verify($this->password, $row['password'])) {
            $_SESSION['uid'] = $row['uid'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['admin'] = $row['admin'];
            header("Location: ./dashboard.php");
        } else {
            echo "Wrong password";
        }
    }

    public function register() {
        $db = DB::connect();
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        if ($row['email'] == $this->email) {
            echo "Email already exists";
        } else {
            $this->insertToDB();
            header("Location: ./login.php");
        }
    }
}