<?php

function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

class UserManager {
    public static function getUsers($uid = null) {
        // Function to load users from DB
    }

    public static function getUser($uid) {
        // Function to load only one user
    }

    public static function renderAllAsTableRow() {
        // Function to render all the stuff
    }
}