<?php
class Meeting {
    private $mid;
    private $name;
    private $desctiption;
    private $date;
    private $location;
    private $uid;

    public function __construct($mid = null, $name = null, $desctiption = null, $date = null, $location = null, $uid = null) {
        $this->mid = $mid;
        $this->name = $name;
        $this->description = $desctiption;
        $this->date = $date;
        $this->location = $location;
        $this->uid = $uid;
    }
}