<?php
function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

?>

<html>
    <head>
        <meta lang="en">
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="./css/master.css">
        <link rel="stylesheet" href="./css/navbar.css">
    </head>
    <body>
        <?php echo NavBar::renderAllLinks() ?>
        <div class="heading">
            <h1>About lastSeen</h1>
        </div>
        <div class="text">
            <p>Last seen was create as school project.</p>
            <p>Created by <i>gjumle</i></p>
        </div>
    </body>
</html>