<?php

class User {
    private $id;
    private $username;
    private $f_name;
    private $l_name;
    private $password;
    private $admin;
    private $email;

    public function __construct($id = null, $username = null, $f_name = null, $l_name = null, $password = null, $admin = null, $email = null) {
        $this->id = $id;
        $this->username = $username;
        $this->f_name = $f_name;
        $this->l_name = $l_name;
        $this->password = $password;
        $this->admin = $admin ? $admin : 0;
        $this->email = $email;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    private function getAdmin() {
        return ($this->admin == 1) ? "Yes" : "No";
    }

    private function getAdminAsChecked() {
        return ($this->admin == 1) ? "checked='checked'" : "";
    }

    public function renderForm() {
        if ($this->id > 0) {
            $id = $this->id;
            $username = $this->username;
            $f_name = $this->f_name;
            $l_name = $this->l_name;
            $password = $this->password;
            $admin = $this->getAdmin();
            $email = $this->email;
            $btnName = "edit";
        } else {
            $id = "";
            $username = "";
            $f_name = "";
            $l_name = "";
            $password = "";
            $admin = "";
            $email = "";
            $btnName = "insert";
        }
        return "
            <form action='' method='post' class='table'>
                <tr>
                    <td><input type='hidden' name='id' value='" . $id . "' /></td>
                    <td><input type='text' name='name' value='" . $username. "' /></td>
                    <td><input type='text' name='f_name' value='" . $f_name . "' /></td>
                    <td><input type='text' name='l_name' value='" . $l_name . "' /></td>
                    <td><input type='text' name='password' value='" . $password . "' /></td>
                    <td><input type='checkbox' name='admin' value='1' " . $admin . "/></td>
                    <td><input type='text' name='email' value='" . $email . "' /></td>
                    <td colspan='2'><input type='submit' name='" . $btnName ."'/></td>
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
                    <td>" . $this->username . "</td>
                    <td>" . $this->f_name . "</td>
                    <td>" . $this->l_name . "</td>
                    <td>" . $this->password . "</td>
                    <td>" . $this->getAdmin() . "</td>
                    <td>" . $this->email . "</td>
                    <td><a href='?edit=" . $this->id . "'>Edit</a></td>
                    <td><a href='?delete=" . $this->id . "'>Delete</a></td>
                </tr>";
        }
    }

    public static function renderHead() {
        return "
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Password</th>
                <th>Admin</th>
                <th>Email</th>
                <th colspan='2'>Action</th>
            </tr>";
    }

    public function renderAsOption($edit = null) {
        $selected = ($edit != null && $this->id == $edit->id) ? "selected='selected'" : "";
        return "<option value='" . $this->id . "' " . $selected . ">" . $this->username . "</option>";
    }

    public function insertToDB() {
        $conn = DB::getConnection();
        $sql = "INSERT INTO users (username, f_name, l_name, password, admin, email) VALUES ('" . $this->username . "', '" . $this->f_name . "', '" . $this->l_name . "', '" . $this->password . "', " . $this->admin . ", '" . $this->email . "')";
        $result = $conn->query($sql);
    }

    public function saveToDB() {
        $conn = DB::getConnection();
        $sql = "UPDATE users SET username = '" . $this->username . "', f_name = '" . $this->f_name . "', l_name = '" . $this->l_name . "', password = '" . $this->password . "', admin = " . $this->admin . ", email = '" . $this->email . "' WHERE uid = " . $this->id;
        $result = $conn->query($sql);
    }
    public function deleteFromDB() {
        $conn = DB::getConnection();
        $sql = "DELETE FROM users WHERE uid = " . $this->id;
        $result = $conn->query($sql);
    }
}