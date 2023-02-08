<?php
<<<<<<< HEAD
class User {
    private $uid;
    private $name;
    private $password;
    private $admin;
    private $email;
    private $city;

    public function __construct($uid = null, $name = null, $password = null, $admin = null, $email = null, $city = null) {
        $this->uid = $uid;
        $this->name = $name;
        $this->password = $password;
        $this->admin = $admin ? $admin : 0;
        $this->email = $email;
        $this->city = $city;
    }

    public function getId() {
        return $this->uid;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAdmin() {
        return ($this->admin == 1) ? "Yes" : "No";
    }

    public function getAdminAsChecked() {
        return ($this->admin == 1) ? "checked='checked'" : "";
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCity() {
        return $this->city;
    }

    public function renderForm() {
        if ($this->uid > 0) {
            $uid = $this->uid;
            $name = $this->name;
            $password = $this->password;
            $admin = $this->getAdmin();
            $email = $this->email;
            $city = $this->city;
            $btnName = "edit";
        } else {
            $uid = "";
            $name = "";
            $password = "";
            $admin = "";
            $email = "";
            $city = "";
            $btnName = "insert";
        }
        return "
            <form action='' method='post' class=table>
                <tr>
                    <td><input type='hidden' name='uid' value='" . $uid . "'></td>
                    <td><input type='text' name='name' value='" . $name . "'></td>
                    <td><input type='password' name='password' value='" . $password . "'></td>
                    <td><input type='checkbox' name='admin' value='1' " . $admin . "></td>
                    <td><input type='text' name='email' value='" . $email . "'></td>
                    <td><input type='text' name='city' value='" . $city . "'></td>
                    <td colspan='2'><input type='submit' name='" . $btnName . "'></td>
                </tr>
            </form>";
    }

    public function renderAsRowTable() {
        if (isset($_GET['edit']) && $_GET['edit'] == $this->uid) {
            return $this->renderForm();
        } else {
            return "
                <tr>
                    <td>#" . $this->uid . "</td>
                    <td>" . $this->name . "</td>
                    <td>" . $this->password . "</td>
                    <td>" . $this->getAdmin() . "</td>
                    <td>" . $this->email . "</td>
                    <td>" . $this->city . "</td>
                    <td><a href='?edit=" . $this->uid . "'>Edit</a></td>
                    <td><a href='?delete=" . $this->uid . "'>Delete</a></td>
                </tr>";
        }
    }

    public static function renderHead() {
        return "
            <tr>
                <th>ID</th>
                <th width='170px'>Name</th>
                <th width='170px'>Password</th>
                <th>Admin</th>
                <th width='170px'>Email</th>
                <th width='170px'>City</th>
                <th colspan='2'>Action</th>
            </tr>";
    }

    public function renderAsOption($edit = null) {
        $selected = ($edit != null && $this->uid == $edit->id) ? "selected='selected'" : "";
        return "<option value='" . $this->uid . "' " . $selected . ">" . $this->name . "</option>";
    }

    public function insertToDB() {
        $conn = DB::getConnection();
        $sql = "INSERT INTO users (name, password, admin, email, city) VALUES ('" . $this->name . "', '" . $this->password . "', '" . $this->admin . "', '" . $this->email . "', '" . $this->city . "')";
        $result = $conn->query($sql);
    }

    public function saveToDB() {
        $conn = DB::getConnection();
        $sql = "UPDATE users SET name = '" . $this->name . "', password = '" . $this->password . "', admin = '" . $this->admin . "', email = '" . $this->email . "', city = '" . $this->city . "' WHERE uid = " . $this->uid;
        $result = $conn->query($sql);
    }
    
    public function deleteFromDB() {
        $conn = DB::getConnection();
        $sql = "DELETE FROM users WHERE uid = " . $this->uid;
        $result = $conn->query($sql);
    }

    public function checkDB() {
        $conn = DB::getConnection();
        $sql = "SELECT uid FROM users WHERE name = '". $this->name . "' AND password = '" . $this->password . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row['uid'];
            }
        }
    }
}
=======

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
                <span class='error-message username-error'></span>
                <label for='password'>Password</label>
                <input type='password' name='password' id='password'>
                <span class='error-message password-error'></span>
                <label for='email'>E-Mail</label>
                <input type='text' name='email' id='email'>
                <span class='error-message email-error'></span>
                <label for='city'>City</label>
                <input type='text' name='city' id='city'>
                <span class='error-message city-error'></span>
                <input type='submit' name='register' id='submit' value='submit'>
            </form>
        </div>";
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
        // Get the data from the cookies
        $username = $_COOKIE['username'];
        $password = $_COOKIE['password'];
        $email = $_COOKIE['email'];
        $city = $_COOKIE['city'];
        
        return "
            <div class='registration-form'>
                <h1>Edit</h1>
                <form action='edit-account.php' method='post'>
                    <label for='username'>Username</label>
                    <input type='text' name='username' id='username' value='$username'>
                    <span class='error-message'></span>
                    <label for='password'>Password</label>
                    <input type='password' name='password' id='password' value='".$password."'>
                    <span class='error-message'></span>
                    <label for='email'>E-Mail</label>
                    <input type='text' name='email' id='email' value='$email'>
                    <span class='error-message'></span>
                    <label for='city'>City</label>
                    <input type='text' name='city' id='city' value='$city'>
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
            echo '<span style="color: green;">New user registered</span>';
            header("Refresh: 5; url=login.php");
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
                echo '<span style="color: red;">Login Failed</span>';
            }
        } elseif (isset($_POST['edit'])) {
            $user = User::getData();
            $user->saveToDB($_POST['email'], $_POST['password'], $_POST['city']);
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
>>>>>>> parent of e3ed010 (chat)
