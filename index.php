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
        <h1>Menu</h1>
        <ul>
            <li><a href="./user.php">User</a></li>
            <li><a href="./contacts.php">Contacts</a></li>
            <li><a href="./contacts.php">Meetings</a></li>
        </ul>
    </body>
</html>
