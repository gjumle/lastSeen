<?php
    setcookie("logged_in", "", time() - 3600);
    setcookie("username", "", time() - 3600);
    setcookie("uid", "", time() - 3600);
    echo "You have been logged out successfully.";
    header("Refresh: 2; url=index.php");