<?php
class DB {
    static $conn = null;

    static function connect() {
        if (self::$conn = null) {
            $db = new mysqli('localhost', 'lastSeenAdmin', 'lsa', 'lastSeen');
            $db = self::$conn;
        } else {
            $db = self::$conn;
        }
        return $db;
    }
}