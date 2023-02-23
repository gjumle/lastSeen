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

        <title>Home</title>

        <link rel="stylesheet" type="text/css" href="css/master.css">
        <link rel="stylesheet" type="text/css" href="css/navbar.css">
    </head>
    <body>
        <?php echo NavBar::getNavBar("Home"); ?>
        <div class="content">
            <h1>Home</h1>
            <p>Welcome to the home page.</p>
        </div>
    </body>
</html>