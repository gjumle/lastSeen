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
        <div class="nav-bar">
            <div class="nav-bar-item">
                <h1>LastSeen</h1>
            </div>
            <div class="nav-bar-item">
                <a href="./userManager.php">UserManager</a>
            </div>
            <div class="nav-bar-item">
                <a href="./meetingManager.php">MeetingManager</a>
            </div>
            <div class="nav-bar-item">
                <a href="./account.php">Account</a>
            </div>                 
        </div>
    </body>
</html>