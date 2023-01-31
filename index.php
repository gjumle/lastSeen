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
        <h1>Rozcestnik</h1>
        <ul>
            <li><a href="./userManager.php">User</a></li>
            <li><a href="./meetingManager.php">Meeting</a></li>
            <li><a href="./login.php">Login</a></li>
        </ul>        
    </body>
</html>