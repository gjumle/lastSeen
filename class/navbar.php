<?php

class NavBar {
    private static $navBar = array(
        "Home" => "index.php",
        "Register" => "register.php",
        "Login" => "login.php",
        "Account" => "account.php",
        "Logout" => "logout.php"
    );

    public static function getNavBar($active) {
        $navBar = "<div class='navbar'>";
        foreach (self::$navBar as $key => $value) {
            $navBar .= "<div class='navbar-item'>";
            if ($key == $active) {
                $navBar .= "<a class='active' href='$value'>$key</a>";
            } else {
                $navBar .= "<a href='$value'>$key</a>";
            }
            $navBar .= "</div>";
        }
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            $navBar .= "<a href='admin.php'>Admin</a>";
        }
        if (isset($_SESSION['uid'])) {
            $navBar .= "<a href='user.php?uid=" . $_SESSION['uid'] . "'>User</a>";
        }
        $navBar .= "</div>";
        return $navBar;
    }
}