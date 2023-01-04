<?php

function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

$conn = DB::connect();

$admin = new User('', 'admin', 'admin', 'admin@lsa.com', '1', 'Brno');

echo User::renderForm();