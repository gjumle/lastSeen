<?php

Class Meeting {
    private $mid;
    private $user_id;
    private $contact_id;
    private $location;
    private $start_time;
    private $end_time;

    public function __construct($mid = null, $user_id = null, $contact_id = null, $location = null, $start_time = null, $end_time = null) {
        $this->mid = $mid;
        $this->user_id = $user_id;
        $this->contact_id = $contact_id;
        $this->location = $location;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
    }

    public function getMid() {
        return $this->mid;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getContactId() {
        return $this->contact_id;
    }

    public function getLocation() {
        return $this->location;
    }

    public function getStartTime() {
        return $this->start_time;
    }

    public function getEndTime() {
        return $this->end_time;
    }

    public function setMid($mid) {
        $this->mid = $mid;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setContactId($contact_id) {
        $this->contact_id = $contact_id;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function setStartTime($start_time) {
        $this->start_time = $start_time;
    }

    public function setEndTime($end_time) {
        $this->end_time = $end_time;
    }

    public function getDurationMinutes() {
        $start = new DateTime($this->start_time);
        $end = new DateTime($this->end_time);
        $interval = $start->diff($end);
        return $interval->format('%i');
    }

    public function deleteFromDB() {
        $pdo = DB::connectPDO();
        $sql = " DELTE FROM meetings WHERE mid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->mid]);
    }

    public function insertToDB() {
        $pdo = DB::connectPDO();
        $sql = "INSERT INTO meetings (user_id, contact_id, location, start_time, end_time) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->user_id, $this->contact_id, $this->location, $this->start_time, $this->end_time]);
    }

    public function saveToDB() {
        $pdo = DB::connectPDO();
        $sql = "UPDATE meetings SET user_id = ?, contact_id = ?, location = ?, start_time = ?, end_time = ? WHERE mid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->user_id, $this->contact_id, $this->location, $this->start_time, $this->end_time, $this->mid]);
    }

    public static function getMeetingById($mid) {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM meetings WHERE mid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$mid]);
        $row = $stmt->fetch();
        if ($row) {
            return new Meeting($row['mid'], $row['user_id'], $row['contact_id'], $row['location'], $row['start_time'], $row['end_time']);
        } else {
            return null;
        }
    }

    public static function getMeetingsByUserId($user_id) {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM meetings WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        $meetings = [];
        while ($row = $stmt->fetch()) {
            $meetings[] = new Meeting($row['mid'], $row['user_id'], $row['contact_id'], $row['location'], $row['start_time'], $row['end_time']);
        }
        return $meetings;
    }

    public static function getMeetingsByContactId($contact_id) {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM meetings WHERE contact_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$contact_id]);
        $meetings = [];
        while ($row = $stmt->fetch()) {
            $meetings[] = new Meeting($row['mid'], $row['user_id'], $row['contact_id'], $row['location'], $row['start_time'], $row['end_time']);
        }
        return $meetings;
    }

    public static function getMeetingsByUserIdAndContactId($user_id, $contact_id) {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM meetings WHERE user_id = ? AND contact_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $contact_id]);
        $meetings = [];
        while ($row = $stmt->fetch()) {
            $meetings[] = new Meeting($row['mid'], $row['user_id'], $row['contact_id'], $row['location'], $row['start_time'], $row['end_time']);
        }
        return $meetings;
    }
}