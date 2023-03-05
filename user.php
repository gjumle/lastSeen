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
        <h1>User</h1>
        <p>Go to <a href='./index.php'>menu</a> Edit records <a href="?action=edit">here</a></p>
    </body>
</html>

<?php

