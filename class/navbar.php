<?php

class NavBar {
    private static $links = [
        'Home' => 'index.php',
        'About' => 'about.php',
    ];

    public static function display() {
        $current_page = $_SERVER['REQUEST_URI'];
        $html = '<nav>';
        $html .= '<ul>';
        foreach(self::$links as $name => $url) {
            $html .= '<li><a href="'.$url.'"'.($current_page == $url ? ' class="active"' : '').'>'.$name.'</a></li>';
        }
        $html .= '<li class="dropdown" style="float:right">';
        $html .= '<a href="#">Account</a>';
        $html .= '<div class="dropdown-content">';
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            $html .= '<a href="./account.php">My Account</a>';
            $html .= '<a href="./logout.php">Logout</a>';
        } else {
            $html .= '<a href="./login.php">Login</a>';
            $html .= '<a href="./register.php">Register</a>';
        }
        $html .= '</div>';
        $html .= '</li>';
        $html .= '</ul>';
        $html .= '</nav>';
        return $html;
    }
}
