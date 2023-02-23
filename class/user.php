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
        $this->admin = $admin ? $admin : 0;
        $this->email = $email;
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

    public function renderForm() {
        if ($this->uid > 0) {
            $uid = $this->uid;
            $name = $this->name;
            $password = $this->password;
            $admin = $this->getAdmin();
            $email = $this->email;
            $btnName = "edit";
        } else {
            $uid = "";
            $name = "";
            $password = "";
            $admin = "";
            $email = "";
            $btnName = "insert";
        }
        return "
            <form action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method='post' class=table>
                <tr>
                    <td><input type='hidden' name='uid' id='uid' value='" . $uid . "'></td>
                    <td><input type='text' name='name' id='name' value='" . $name . "'></td>
                    <td><input type='password' name='password' id='password' value='" . $password . "'></td>
                    <td><input type='checkbox' name='admin' id='admin' value='1' " . $admin . "></td>
                    <td><input type='text' name='email' id='email' value='" . $email . "'></td>
                    <td colspan='2'><input type='submit' name='" . $btnName . "' id='submit'></td>
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
        $sql = "INSERT INTO users (name, password, admin, email, city) VALUES ('" . $this->name . "', '" . $this->password . "', '" . $this->admin . "', '" . $this->email . ")";
        $result = $conn->query($sql);
    }

    public function saveToDB() {
        $conn = DB::getConnection();
        $sql = "UPDATE users SET name = '" . $this->name . "', password = '" . $this->password . "', admin = '" . $this->admin . "', email = '" . $this->email . "' WHERE uid = " . $this->uid;
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