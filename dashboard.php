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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta lang="en">

        <title>lastSeen | Dashboard</title>

        <link rel="stylesheet" type="text/css" href="css/master.css">
    </head>
    <body>
        
    </body>
</html>