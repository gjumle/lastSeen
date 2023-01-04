<?php

function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

class Render {
    public  static function renderRegsiter() {
        // Register functions
    }

    public static function renderLogin() {
        // Login functios
    }
}