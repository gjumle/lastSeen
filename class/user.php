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
        $pdo = DB::connectPDO();
        $sql = "DELETE FROM users WHERE uid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->uid]);
    }

    public function insertToDB() {
        $pdo = DB::connectPDO();
        $sql = "INSERT INTO users (name, password, email) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->name, $this->password, $this->email]);
    }

    public function saveToDB() {
        $pdo = DB::connectPDO();
        $sql = "UPDATE users SET name = ?, password = ?, email = ? WHERE uid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->name, $this->password, $this->email, $this->uid]);
    }

    public function login() {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

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
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['email'] == $this->email) {
            echo "Email already exists";
        } else {
            $this->insertToDB();
            header("Location: ./login.php");
        }
    }
}