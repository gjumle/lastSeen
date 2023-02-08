<?php

class UserManager {
    
    public static function getUsers($id = null) {
        $conn = DB::connect();
        $sql = "SELECT * FROM users";
        if ($id) {
            $sql .= " WHERE id = :id";
        }
        $stmt = $conn->prepare($sql);
        if ($id) {
            $stmt->bindParam(":id", $id);
        }
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public static function renderHead() {
        return "
            <th>"
    }
}