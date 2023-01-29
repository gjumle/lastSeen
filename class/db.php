<?php

class DB {
    static $conn = null;

    public static function connect() {
        if (self::$conn == null) {
            $db = new mysqli('localhost', 'lsa', 'lsa', 'ls');
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }
            self::$conn = $db;
        } else {
            $db = self::$conn;
        }
        return $db;
    }
}
