<?php

class Contact {
    private $cid;
    private $user_id;
    private $f_name;
    private $l_name;
    private $email;
    private $status;
    private $last_seen;
    private $count_seen;
    private $duration_seen;

    public function __construct($cid = null, $user_id = null, $f_name = null, $l_name = null, $email = null, $status = null, $last_seen = null, $count_seen = null, $duration_seen = null) {
        $this->cid = $cid;
        $this->user_id = $user_id;
        $this->f_name = $f_name;
        $this->l_name = $l_name;
        $this->email = $email;
        $this->status = $status;
        $this->last_seen = $last_seen;
        $this->count_seen = $count_seen;
        $this->duration_seen = $duration_seen;
    }

    public function getCid() {
        return $this->cid;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getFName() {
        return $this->f_name;
    }

    public function getLName() {
        return $this->l_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getLastSeen() {
        return $this->last_seen;
    }

    public function getCountSeen() {
        return $this->count_seen;
    }

    public function getDurationSeen() {
        return $this->duration_seen;
    }

    public function setCid($cid) {
        $this->cid = $cid;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setFName($f_name) {
        $this->f_name = $f_name;
    }

    public function setLName($l_name) {
        $this->l_name = $l_name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setLastSeen($last_seen) {
        $this->last_seen = $last_seen;
    }

    public function setCountSeen($count_seen) {
        $this->count_seen = $count_seen;
    }

    public function setDurationSeen($duration_seen) {
        $this->duration_seen = $duration_seen;
    }

    public function deleteFromDB() {
        $pdo = DB::connectPDO();
        $sql = "DELETE FROM contacts WHERE cid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->cid]);
    }

    public function insertToDB() {
        $pdo = DB::connectPDO();
        $sql = "INSERT INTO contacts (user_id, f_name, l_name, email, status, last_seen, count_seen, duration_seen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->user_id, $this->f_name, $this->l_name, $this->email, $this->status, $this->last_seen, $this->count_seen, $this->duration_seen]);
    }

    public function saveToDB() {
        $pdo = DB::connectPDO();
        $sql = "UPDATE contacts SET user_id = ?, f_name = ?, l_name = ?, email = ?, status = ?, last_seen = ?, count_seen = ?, duration_seen = ? WHERE cid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->user_id, $this->f_name, $this->l_name, $this->email, $this->status, $this->last_seen, $this->count_seen, $this->duration_seen, $this->cid]);
    }

    public function addSeen() {
        $this->count_seen++;
        $this->duration_seen += time() - $this->last_seen;
        $this->last_seen = time();
        $this->status = 1;
        $this->saveToDB();
    }

    public function updateStatus() {
        $this->status = 0;
        $this->saveToDB();
    }
}