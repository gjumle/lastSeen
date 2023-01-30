<?php
class User {
    private $id;
    private $name;
    private $password;
    private $admin;
    private $email;
    private $city;

    public function __construct($id = null, $name = null, $password = null, $admin = null, $email = null, $city = null) {
        $this->id = $id;
        $this->name = $name;
        $this->pasword = $password;
        $this->admin = $admin ? $admin : 0;
        $this->email = $email;
        $this->city = $city;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

    private function getAdmin() {
        return ($this->admin == 1) ? "Yes" : "No";
    }

    public function getAdminAsChecked() {
        return ($this->admin == 1) ? "checked='checked'" : "";
    }

    public function renderForm() {
        if ($this->id > 0) {
            $id = $this->id;
            $name = $this->name;
            $password = $this->password;
            $admin = $this->getAdmin();
            $email = $this->email;
            $city = $this->city;
            $btnName = "edit";
        } else {
            $id = "";
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
                    <td><input type='hidden' name='id' value='" . $id . "'></td>
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
        if (isset($_GET['edit']) && $_GET['edit'] == $this->id) {
            return $this->renderForm();
        } else {
            return "
                <tr>
                    <td>#" . $this->id . "</td>
                    <td>" . $this->name . "</td>
                    <td>" . $this->password . "</td>
                    <td>" . $this->getAdmin() . "</td>
                    <td>" . $this->email . "</td>
                    <td>" . $this->city . "</td>
                    <td><a href='?edit=" . $this->id . "'>Edit</a></td>
                    <td><a href='?delete=" . $this->id . "'>Delete</a></td>
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
        $selected = ($edit == $this->id) ? "selected='selected'" : "";
        return "<option value='" . $this->id . "' " . $selected . ">" . $this->name . "</option>";
    }

    public function insertToDB() {
        $conn = DB::getConnection();
        $sql = "INSERT INTO users (name, password, admin, email, city) VALUES ('" . $this->name . "', '" . $this->password . "', '" . $this->admin . "', '" . $this->email . "', '" . $this->city . "')";
        $result = $conn->query($sql);
    }

    public function saveToDB() {
        $conn = DB::getConnection();
        $sql = "UPDATE users SET name = '" . $this->name . "', password = '" . $this->password . "', admin = '" . $this->admin . "', email = '" . $this->email . "', city = '" . $this->city . "' WHERE uid = " . $this->id;
        $result = $conn->query($sql);
    }
    
    public function deleteFromDB() {
        $conn = DB::getConnection();
        $sql = "DELETE FROM users WHERE uid = " . $this->id;
        $result = $conn->query($sql);
    }
}