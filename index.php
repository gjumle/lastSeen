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
            <li><a href="./admin/userManager.php">UserManager</a></li>
            <li><a href="./admin/meetingManager.php">MeetingManager</a></li>
            <li><a href="./user/account.php">Account</a></li>
        </ul>       
    </body>
</html>