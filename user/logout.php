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
header("Refresh: 5; url=../index.php");
?>

<html>
    <body>
        <h1>Logout</h1>
        <p>Logout successfull</p>
    </body>
</html>