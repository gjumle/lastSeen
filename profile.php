<?php

function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

if (isset($_POST['username']) && isset($_POST['f_name']) && isset($_POST['l_name']) && isset($_POST['email']) && isset($_POST['password'])) {
    User::edit($_COOKIE['uid'],$_POST['username'], $_POST['f_name'], $_POST['l_name'], $_POST['password'], $_COOKIE['email']);
}

Render::renderProfilePage();