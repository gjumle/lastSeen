<?php

function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

if (isset($_POST['edit'])) {
    Contact::edit($_GET['edit'], $_POST['f_name'], $_POST['l_name'], $_POST['email'], NULL, NULL, NUll, NULL);
} elseif (isset($_GET['delete'])) {
    Contact::delete($_GET['delete']);
} elseif (isset($_POST['add'])) {
    Contact::add(NULL, $_POST['f_name'], $_POST['l_name'], $_POST['email'], NULL, NULL, NUll, NULL);
}

Render::renderContactsPage();