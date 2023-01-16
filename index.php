<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf8'></meta>
        <meta lang='en'></meta>
        <link rel=stylesheet href='./css/master.css'>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300&display=swap" rel="stylesheet">
        <style> @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@300&display=swap'); </style>
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

        echo NavBar::render();
        echo User::renderForm();
        echo User::handleForm();


    ?>
    </body>
</html>