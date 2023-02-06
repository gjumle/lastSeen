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
        echo User::loginForm();
        echo User::handleForm();


    ?>
    <script src='./js/master.js'></script>
    </body>
</html>