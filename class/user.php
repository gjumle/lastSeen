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
        $this->password = $password;
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
        $this->password = $password;
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

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
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
            setcookie('uid', $row['uid'], time() + (86400 * 30), '/');
            setcookie('name', $row['name'], time() + (86400 * 30), '/');
            setcookie('email', $row['email'], time() + (86400 * 30), '/');
            setcookie('admin', $row['admin'], time() + (86400 * 30), '/');
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