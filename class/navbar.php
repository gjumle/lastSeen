<?php 

class NavBar {
    private static $links = array(
        'Home' => './index.php',
        'UserManager' => './userManager.php',
        'MeetingsManager' => './meetingManager.php',
        'Login' => './account.php?action=login',
        'Register' => './account.php?action=register',
        'User' => './userAccount.php',
        'Logout' => './logout.php',
        'About' => './about.php'
    );

    public static function renderAllLinks() {
        $active = basename($_SERVER['PHP_SELF']);
        $html = "<div class='nav-bar'>";
        foreach (self::$links as $name => $url) {
            $html .= "<div class='nav-bar-item'><a href='" . $url . "'" . ($active == $url ? ' class="active"' : '') . ">" . $name . "</a></div>";
        }
        $html .= "</div>";
        return $html;
    }
}