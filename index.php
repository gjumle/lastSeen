<?php

function autoloadModel($className) {
    $filename = "modules/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

$conn = DB::connect();