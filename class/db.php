<?php

class DB {
    static $conn = null;

    static function connect() {
        if (self::$conn == null) {
            $db = new mysqli('localhost', 'lsa', 'lsa', 'ls');
            self::$conn = $db;
        } else {
            $db = self::$conn;
        }
        return $db;
    }
}
