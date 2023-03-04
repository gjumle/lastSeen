<?php

function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

if () {
    Contact::login($_POST['email'], $_POST['password']);
}

Render::renderContactsPage();