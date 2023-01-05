<?php

class NavBar {
    protected static $navLinks = array();
  
    public static function addLink($text, $url) {
      self::$navLinks[] = array('text' => $text, 'url' => $url);
    }
  
    public static function render() {
      $html = '<div class="nav-bar">';
      $html .= '<div class="nav-links">';
      foreach(self::$navLinks as $link) {
        $html .= "<a class='nav-link' href='{$link['url']}'>{$link['text']}</a>";
      }
      $html .= '</div>';
      $html .= '</div>';
      return $html;
    }
  }  

NavBar::addLink('About', '?about');
NavBar::addLink('Home', '?home');
NavBar::addLink('Login', '?login');
NavBar::addLink('Register', '?register');
