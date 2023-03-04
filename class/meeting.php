<?php

class Meeting {
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
}