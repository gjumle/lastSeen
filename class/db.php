<?php
<<<<<<< HEAD

class DB {
    static $conn = null;

    static function connect() {
=======
class DB {
    static $conn = null;

    static function getConnection() {
>>>>>>> parent of ff7fad0 (reset 2)
        if (self::$conn == null) {
            $db = new mysqli('localhost', 'lsa', 'lsa', 'ls');
            self::$conn = $db;
        } else {
            $db = self::$conn;
        }
        return $db;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> parent of ff7fad0 (reset 2)
