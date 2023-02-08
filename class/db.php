<?php
<<<<<<< HEAD
class DB {
    static $conn = null;

    static function getConnection() {
=======

class DB {
    static $conn = null;

    static function connect() {
>>>>>>> parent of e3ed010 (chat)
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
>>>>>>> parent of e3ed010 (chat)
