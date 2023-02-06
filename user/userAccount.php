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
    <body>
        <h1><?php echo $_COOKIE['username'] ?></h1>
    </body>
</html>