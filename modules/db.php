<?php

class DB {
    private $host = 'localhost';
    private $user = 'last_seen_admin';
    private $pswd = 'lsa';
    private $db = 'last_seen';

    private static function connect() {
        $conn = new mysqli($host, $user, $pswd, $db);
        if (!$conn) {
            die ('Connection failed: ' . $conn->connect_error);
        }
        echo 'Connected successfully';
    }
}