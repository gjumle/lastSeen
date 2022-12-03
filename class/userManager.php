<?php
class UserManager {
    private $users = array();

    public static function getAllInstancesAsArray() {
        $condition = $userID > 0 ? "u_id = " . $userID : "1";

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

    
}