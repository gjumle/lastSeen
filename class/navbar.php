<?php

class NavBar {
    protected static $navLinks = array();
  
    public static function addLink($text, $url) {
      self::$navLinks[] = array('text' => $text, 'url' => $url);
    }
  
    public static function render() {
      $html = '<div class="nav-bar">';
      $html .= '<ul>';
      foreach(self::$navLinks as $link) {
        $html .= "<li><a href='{$link['url']}'>{$link['text']}</a></li>";
      }
      $html .= '</ul>';
      $html .= '</div>';
      return $html;
    }
  }  

NavBar::addLink('Login', '/login');
NavBar::addLink('Register', '/register');
