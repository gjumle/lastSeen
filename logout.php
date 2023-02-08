<?php

function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

echo NavBar::display();

setcookie("logged_in", "", time() - 3600);
setcookie("username", "", time() - 3600);
setcookie("uid", "", time() - 3600);
setcookie("admin", "", time() - 3600);
header("Refresh: 5; url=index.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf8'></meta>
        <meta lang='en'></meta>
        
        <link rel="icon" type="image/x-icon" href="./svg/favicon.ico">
        
        <link rel=stylesheet href='./css/master.css'>
        <link rel="stylesheet" type="text/css" href="./css/logout.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300&display=swap" rel="stylesheet">
        <style> @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@300&display=swap'); </style>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class="logout-message">You have been logged out successfully.</div>
        <div class="redirect-message">You will be redirected to the index page in 5 seconds.</div>
        <script src='./js/master.js'></script>
    </body>
</html>
