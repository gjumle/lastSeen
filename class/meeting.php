<?php

class Meeting {
    private $mid;
    private $user_id;
    private $contact_id;
    private $start_time;
    private $end_time;
    private $location;
    private $description;

    public function __construct($mid = null, $user_id = null, $contact_id = null, $start_time = null, $end_time = null, $location = null, $description = null) {
        $this->mid = $mid;
        $this->user_id = $user_id;
        $this->contact_id = $contact_id;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->location = $location;
        $this->description = $description;
    }

    public function getMid() {
        return $this->mid;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getContact_id() {
        return $this->contact_id;
    }

    public function getStart_time() {
        return $this->start_time;
    }

    public function getEnd_time() {
        return $this->end_time;
    }

    public function getLocation() {
        return $this->location;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setMid($mid) {
        $this->mid = $mid;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function setContact_id($contact_id) {
        $this->contact_id = $contact_id;
    }

    public function setStart_time($start_time) {
        $this->start_time = $start_time;
    }

    public function setEnd_time($end_time) {
        $this->end_time = $end_time;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function delteFromDB() {
        $pdo = DB::connectPDO();
        $sql = "DELETE FROM meetings WHERE mid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->mid]);
    }

    public function insertToDB() {
        $pdo = DB::connectPDO();
        $sql = "INSERT INTO meetings (user_id, contact_id, start_time, end_time, location, description) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->user_id, $this->contact_id, $this->start_time, $this->end_time, $this->location, $this->description]);
    }

    public function saveToDB() {
        $pdo = DB::connectPDO();
        $sql = "UPDATE meetings SET user_id = ?, contact_id = ?, start_time = ?, end_time = ?, location = ?, description = ? WHERE mid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->user_id, $this->contact_id, $this->start_time, $this->end_time, $this->location, $this->description, $this->mid]);
    }

    public static function getMeetings($user_id) {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM meetings WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        $meetings = [];
        while ($row = $stmt->fetch()) {
            $meetings[] = new Meeting($row['mid'], $row['user_id'], $row['contact_id'], $row['start_time'], $row['end_time'], $row['location'], $row['description']);
        }
        return $meetings;
    }

    public static function getMeeting($mid) {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM meetings WHERE mid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$mid]);
        $row = $stmt->fetch();
        return new Meeting($row['mid'], $row['user_id'], $row['contact_id'], $row['start_time'], $row['end_time'], $row['location'], $row['description']);
    }
}