<?php
class UserManager {

    private static function getUsers($uid = null, $admin = null) {
        $condition = ($admin == 'Yes') ? "" : "WHERE uid = " . $uid;

        $conn = DB::getConnection();
        $sql = "SELECT * FROM users " . $condition . " ORDER BY name ASC";
        $result = $conn->query($sql);
        $users = array();
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
                $user = new User ($row['uid'], $row['name'], $row['password'], $row['admin'], $row['email'], $row['city']);
                array_push($users, $user);
            }
        }
        return $users;
    }

    public static function getUser($uid) {
        $users = self::getUsers($uid);
        return $users[0];
    }

    private static function formHandler() {
        $admin = (isset($_POST['admin'])) ? $_POST['admin'] : 0;
        $password = (isset($_POST['password'])) ? md5($_POST['password']) : "";
        if (isset($_POST['edit'])) {
            $editUser = new User ($_POST['uid'], $_POST['name'], $password, $admin, $_POST['email'], $_POST['city']);
            $editUser->saveToDB();
            echo "<script type='text/javascript'>window.location.replace('userManager.php');</script>";        
        }
        if (isset($_GET['delete'])) {
            $deleteUser = self::getUser($_GET['delete']);
            $deleteUser->deleteFromDB();
            echo "<script type='text/javascript'>window.location.replace('userManager.php');</script>";
        }
        if (isset($_POST['insert'])) {
            $insertUser = new User (null, $_POST['name'], $password, $admin, $_POST['email'], $_POST['city']);
            $insertUser->insertToDB();
            echo "<script type='text/javascript'>window.location.replace('userManager.php');</script>";
        }
    }

    private static function renderAllAsTableRow() {
        $uid = ($_COOKIE['uid'] == null) ? null : $_COOKIE['uid'];
        $admin = ($_COOKIE['admin'] == 'No') ? null : $_COOKIE['admin'];
        $users = self::getUsers($uid, $admin);
        $table = "";
        foreach ($users as $user) {
            $table .= $user->renderAsRowTable();
        }
        return $table;
    }

    public static function renderDataTable() {
        self::formHandler();
        $table = "<table class='table-data'>";
        $table .= User::renderHead();

        if (isset($_GET['action']) && ($_GET['action'] == 'new')) {
            $user = new User();
            $table .= $user->renderForm();
        }
        $table .= self::renderAllAsTableRow();
        $table .= "</table>";

        return $table;
    }

    public static function renderAsSelect($edit) {
        $users = self::getUsers();
        $select = "<select name='user'><option>---user---</option>";
        foreach ($users as $user) {
            $select .= $user->renderAsOption($edit);
        }
        $select .= "</select>";
        return $select;
    }
}