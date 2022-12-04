<?php
class UserManager {

    public static function renderDatatable() {
        self::formHandler();
        $ret = "<table border='1'>";
        $ret = User::renderDatatableHeader();

        if (isset($_GET['action']) && $_GET['action'] == "new") {
            $ret .= (new User())->renderForm();
        }
        return $ret . "</table>";
    }

    public static function renderAllAsTableRow() {
        $users = self::getAllInstancesAsArray();
        $ret = "";
        foreach ($users as $user) {
            $ret .= $user->renderAsRowTable();
        }
        return $ret;
    }

    public static function getAllInstancesAsArray() {
        $condition = $uid > 0 ? "u_id = " . $uid : "1";

        $conn = DB::connect();
        $sql = "SELECT * FROM users WHERE " . $condition . " ORDER BY name ASC";
        $ersult = $conn->query($sql);
        $ret = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ret[] = new User($row['u_id'], $row['name'], $row['password'], $row['admin'], $row['last_seen']);
            }
        }
        return $ret;
    }

    public static function getOneInstance($userID) {
        $user = self::getAllInstancesAsArray($userID);
        return $user[0];
    }

    public static function formHandler() {
        if (isset($_GET['action']) && $_GET['action'] == "insertUser") {
            $conn = DB::connect();
            $sql = "INSERT INTO users (name, password, admin) VALUES ('" . $_POST['username'] . "', '" . $_POST['password'] . "', '" . $_POST['admin'] . "', '" . $_POST['lastSeen'] . "')";
            $conn->query($sql);
        } else if (isset($_GET['action']) && $_GET['action'] == "updateUser") {
            $user = self::getOneInstance($_POST['u_id']);
            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            $user->admin = $_POST['admin'];
            $user->lastSeen = $_POST['lastSeen'];
            $user->saveToDB();
        } else if (isset($_GET['action']) && $_GET['action'] == "deleteUser") {
            $user = self::getOneInstance($_GET['delete']);
            $user->deleteFromDB();
        }
    }
    
}