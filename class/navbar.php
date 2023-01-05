<?php

class NavBar {
    protected static $navLinks = array();
    
    public static function addLink($text, $url) {
        self::$navLinks[] = array('text' => $text, 'url' => $url);
    }
    
    public static function render() {
        echo '<ul>';
        foreach(self::$navLinks as $link) {
        echo "<li><a href='{$link['url']}'>{$link['text']}</a></li>";
        }
        echo '</ul>';
    } 
}

NavBar::addLink('Login', '/login');
NavBar::addLink('Register', '/register');
