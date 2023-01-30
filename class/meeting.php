<?php
class Meeting {
    private $id;
    private $name;
    private $desctiption;
    private $date;
    private $location;
    private $uid;

    public function __construct($id = null, $name = null, $desctiption = null, $date = null, $location = null, $uid = null) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $desctiption;
        $this->date = $date;
        $this->location = $location;
        $this->uid = $uid;
    }
}