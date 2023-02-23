<?php

class NavBar {
    private static $navBar = array(
        "Home" => "index.php",
        "Account" => "account.php",
        "About" => "about.php"
    );

    public static function addLink($name, $link) {
        self::$navBar[$name] = $link;
    }

    public static function getNavBar($active) {
        $navBar = "<div class='navbar'>";
        foreach (self::$navBar as $key => $value) {
            $navBar .= "<div class='navbar-item'>";
            if ($key == $active) {
                $navBar .= "<a class='nabar-item active' href='$value'>$key</a>";
            } else {
                $navBar .= "<a class='navbar-item' href='$value'>$key</a>";
            }
            $navBar .= "</div>";
        }
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            $navBar .= "<div class='navbar-item dropdown<a href='admin.php'>Administration</a>";
        }
        if (isset($_SESSION['uid'])) {
            $navBar .= "<a href='user.php?uid=" . $_SESSION['uid'] . "'>Account</a>";
        }
        $navBar .= "</div>";
        return $navBar;
    }
}