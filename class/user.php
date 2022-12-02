<?php
class User {
    public $uid;
    public $username;
    public $password;
    public $admin;
    public $lastSeen;

    function __construct($uid = null, $username = null, $password = null, $admin = null, $lastSeen = null) {
        $this->uid = $uid;
        $this->username = $username;
        $this->password = $password;
        $this->admin = $admin;
        $this->lastSeen = $lastSeen;
    }

    public function renderFomr() {
        if ($this->uid > 0) {
            $userID == $this->uid;
            $userName == $this->username;
            $userPassword == $this->password;
            $userAdmin == $this->admin;
            $userLastSeen == $this->lastSeen;
        } else {
            $userID == "";
            $userName == "";
            $userPassword == "";
            $userAdmin == "";
            $userLastSeen == "";
            $btnName = "insertNewUser";
        }
        return "
        <form action='' method='POST'>
            <td>#" . $userID . "</td>
            <td><input type='text' name='username' value='" . $userName . "'></td>
            <td><input type='text' name='password' value='" . $userPassword . "'></td>
            <td><input type='text' name='admin' value='" . $userAdmin . "'></td>
            <td><input type='text' name='lastSeen' value='" . $userLastSeen . "'></td>
            <td><input type='submit' name='" . $btnName . "' value='Save'></td>
        </form>";
    }
}