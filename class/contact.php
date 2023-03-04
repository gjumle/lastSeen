<?php

class Contact {
    private $cid;
    private $user_id;
    private $f_name;
    private $l_name;
    private $email;
    private $phone;
    private $address;
    private $city;
    private $state;
    private $zip;
    private $country;
    private $notes;
    private $status;
    private $last_seen;
    private $count_seen;
    private $duration_seen;

    public function __construct($cid, $user_id, $f_name, $l_name, $email, $phone, $address, $city, $state, $zip, $country, $notes, $status, $last_seen, $count_seen, $duration_seen) {
        $this->cid = $cid;
        $this->user_id = $user_id;
        $this->f_name = $f_name;
        $this->l_name = $l_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->country = $country;
        $this->notes = $notes;
        $this->status = $status;
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
        $sql = "INSERT INTO contacts (user_id, f_name, l_name, email, phone, address, city, state, zip, country, status, last_seen, count_seen, duration_seen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->user_id, $this->f_name, $this->l_name, $this->email, $this->phone, $this->address, $this->city, $this->state, $this->zip, $this->country, $this->status, $this->last_seen, $this->count_seen, $this->duration_seen]);
    }

    public function saveToDB() {
        $pdo = DB::connectPDO();
        $sql = "UPDATE contacts SET user_id = ?, f_name = ?, l_name = ?, email = ?, phone = ?, address = ?, city = ?, state = ?, zip = ?, country = ?, status = ?, last_seen = ?, count_seen = ?, duration_seen = ? WHERE cid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->user_id, $this->f_name, $this->l_name, $this->email, $this->phone, $this->address, $this->city, $this->state, $this->zip, $this->country, $this->status, $this->last_seen, $this->count_seen, $this->duration_seen, $this->cid]);
    }

    public static function getContacts($cid) {
        $pdo = DB::connectPDO();
        $condition = ($cid == null) ? "" : " WHERE cid = ?";
        $sql = "SELECT * FROM contacts $condition";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cid]);
        $contacts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $contact = new Contact($row['cid'], $row['user_id'], $row['f_name'], $row['l_name'], $row['email'], $row['phone'], $row['address'], $row['city'], $row['state'], $row['zip'], $row['country'], $row['notes'], $row['status'], $row['last_seen'], $row['count_seen'], $row['duration_seen']);
            $contacts[] = $contact;
        }
    }

    public static function getContact($cid) {
        $contacts = self::getContacts($cid);
        return $contacts[0];
    }
}