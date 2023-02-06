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
        if(isset($_COOKIE['logged_in']) && $_COOKIE['logged_in'] == true) {
            if(isset($_COOKIE['username'])) {
                $html .= '<a href="./account.php?username='.$_COOKIE['username'].'">'.$_COOKIE['username'].'</a>';
            }            
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
