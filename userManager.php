<?php
function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

if ($_COOKIE['admin'] == "Yes") {
    $button = "<button class='add-record' type='button'><a href='?action=new'>Add record</a></button>";
} else {
    $button = null;
}

?>

<html>
    <head>
        <meta lang="en">
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="./css/master.css">
        <link rel="stylesheet" href="./css/navbar.css">
        <link rel="stylesheet" href="./css/manager.css">
    </head>
    <body>
        <?php
            echo NavBar::renderAllLinks();
            echo $button;
            echo UserManager::renderDataTable();
        ?>
    </body>
</html>