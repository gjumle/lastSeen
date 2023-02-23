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
            <h1>Logging out . . . </h1>
        </div>
    </body>
</html>