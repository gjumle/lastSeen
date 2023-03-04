<?php

class Contact {
    private $cid;
    private $user_id;
    private $f_name;
    private $l_name;
    private $email;
    private $last_seen;
    private $count_seen;
    private $duration_seen;

    public function __construct($cid = null, $user_id = null, $f_name = null, $l_name = null, $email = null, $last_seen = null, $count_seen = null, $duration_seen = null) {
        $this->cid = $cid;
        $this->user_id = $user_id;
        $this->f_name = $f_name;
        $this->l_name = $l_name;
        $this->email = $email;
        $this->last_seen = $last_seen;
        $this->count_seen = $count_seen;
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
        $sql = "INSERT INTO contacts (user_id, f_name, l_name, email, last_seen, count_seen, duration_seen) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->user_id, $this->f_name, $this->l_name, $this->email, $this->last_seen, $this->count_seen, $this->duration_seen]);
    }

    public function saveToDB() {
        $pdo = DB::connectPDO();
        $sql = "UPDATE contacts SET user_id = ?, f_name = ?, l_name = ?, email = ?, last_seen = ?, count_seen = ?, duration_seen = ? WHERE cid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->user_id, $this->f_name, $this->l_name, $this->email, $this->last_seen, $this->count_seen, $this->duration_seen, $this->cid]);
    }

    public static function add($user_id, $f_name, $l_name, $email, $last_seen, $count_seen, $duration_seen) {
        $contact = new Contact(null, $user_id, $f_name, $l_name, $email, $last_seen, $count_seen, $duration_seen);
        $contact->insertToDB();
    }

    public static function delete($cid) {
        $contact = new Contact($cid, null, null, null, null, null, null, null);
        $contact->deleteFromDB();
    }

    public static function edit($cid, $user_id, $f_name, $l_name, $email, $last_seen, $count_seen, $duration_seen) {
        $contact = new Contact($cid, $user_id, $f_name, $l_name, $email, $last_seen, $count_seen, $duration_seen);
        $contact->saveToDB();
    }
}