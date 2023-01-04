<?php

class User {
    private $uid;
    private $username;
    private $password;
    private $email;
    private $admin;
    private $city;

    private function __construct($uid = null, $username = null, $password = null, $email = null, $admin = null, $city = null) {
        $this->uid = $uid;
        $this->usermame = $username;
        $this->password = $password;
        $this->email = $email;
        $this->admin = $admin;
        $this->city = $city;
    }
}