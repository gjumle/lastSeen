<?php

class DB {
    private static $host = "localhost";
    private static $username = "lsa";
    private static $password = "lsa";
    private static $dbname = "ls";

    public static function connectPDO() {
        $dsn = "mysql:host=".self::$host.";dbname=".self::$dbname;
        $pdo = new PDO($dsn, self::$username, self::$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
