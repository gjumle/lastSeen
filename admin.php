<?php
function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");


?>
<!DOCTYPE html>
<html>
    <head>
        <title>lastSeen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/master.css">
        <link rel='stylesheet' href='css/mode.css'>
        <link rel='stylesheet' href='css/admin.css'>
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <!-- FONT AWESOM -->
        <script src="https://kit.fontawesome.com/b848197ec1.js" crossorigin="anonymous"></script>
    </head>
    <body>
       <div class="nav-bar">
            <div class="nav-bar">
                <ul class='nav-bar-links'>
                    <li><a class='nav-bar-link' href="./index.php">Home</a></li>
                    <li><a class='nav-bar-link' href="./profile.php">Profile</a></li>
                    <li><a class='nav-bar-link' href="./contacts.php">Contacts</a></li>
                    <li><a class='nav-bar-link' href="./meetings.php">Meetings</a></li>
                </ul>
            </div>
            <div class="nav-bar-right">
                <ul class='nav-bar-links'>
                    <li><a class='nav-bar-link' href="./register.php">Register</a></li>
                    <li><a class='nav-bar-link' href="#" id='mode'>Dark Mode</i></a></li>
                </ul>
            </div>
       </div>
       <div class="admin-card">

       </div>
       <script src='./js/mode.js'></script>
       <footer class='foot'>
            <div class="footer">
                <p>lastSeen &copy; 2022</p>
            </div>
        </footer>
    </body>