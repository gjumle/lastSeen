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


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf8'></meta>
        <meta lang='en'></meta>
    </head>
    <body>
        
    </body>
</html>