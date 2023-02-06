<<<<<<< HEAD
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf8'></meta>
        <meta lang='en'></meta>
        
        <link rel="icon" type="image/x-icon" href="./svg/favicon.ico">
        
        <link rel=stylesheet href='./css/master.css'>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300&display=swap" rel="stylesheet">
        <style> @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@300&display=swap'); </style>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
    <?php

        function autoloadModel($className) {
            $filename = "class/" . $className . ".php";
            if (is_readable($filename)) {
                require $filename;
            }
        }
        spl_autoload_register("autoloadModel");

        echo NavBar::display();

    ?>
    <script src='./js/master.js'></script>
=======
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
            <li><a href="./userManager.php">UserManager</a></li>
            <li><a href="./meetingManager.php">MeetingManager</a></li>
            <li><a href="./login.php">Login</a></li>
        </ul>        
>>>>>>> parent of ff7fad0 (reset 2)
    </body>
</html>