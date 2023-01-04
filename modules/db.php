<?php

class DB {
    private $host = 'localhost';
    private $user = 'lsa';
    private $pswd = 'lsa';
    private $db = 'ls';

    private static function connect() {
        $conn = new mysqli($host, $user, $pswd, $db);
        if (!$conn) {
            die ('Connection failed: ' . $conn->connect_error);
        }
        echo 'Connected successfully';
    }
}