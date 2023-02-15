<?php
function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");


// Delete cookies
setcookie('logged_in', '', time() - 3600);
setcookie('uid', '', time() - 3600);
setcookie('name', '', time() - 3600);
setcookie('password', '', time() - 3600);
setcookie('admin', '', time() - 3600);
setcookie('email', '', time() - 3600);
setcookie('city', '', time() - 3600);
header("Refresh: 2; url=index.php");
?>

<html>
    <head>
        <meta lang="en">
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="./css/master.css">
        <link rel="stylesheet" href="./css/navbar.css">
    </head>
    <body>
        <?php echo NavBar::renderAllLinks() ?>
        <div class="heading">
            <h1>Logging out . . . </h1>
        </div>
    </body>
</html>