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

    public function getUser_id() {
        return $this->user_id;
    }

    public function getF_name() {
        return $this->f_name;
    }

    public function getL_name() {
        return $this->l_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getStatus() {
        return ($this->status == 1) ? $this->status = "Family" : $this->status = "Friend";
    }

    public function getLast_seen() {
        return $this->last_seen;
    }

    public function getCount_seen() {
        return $this->count_seen;
    }

    public function getDuration_seen() {
        return $this->duration_seen;
    }

    public function setCid($cid) {
        $this->cid = $cid;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function setF_name($f_name) {
        $this->f_name = $f_name;
    }

    public function setL_name($l_name) {
        $this->l_name = $l_name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setLast_seen($last_seen) {
        $this->last_seen = $last_seen;
    }

    public function setCount_seen($count_seen) {
        $this->count_seen = $count_seen;
    }

    public function setDuration_seen($duration_seen) {
        $this->duration_seen = $duration_seen;
    }

    public static function getDateAsString($date) {
        $date = new DateTime($date);
        return $date->format('d/m/Y');
    }

    public static function getDurationAsString($duration) {
        $duration = new DateTime($duration);
        return $duration->format('H:i') . " hours";
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

    public static function getContacts($user_id) {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM contacts WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        $contacts = [];
        while ($row = $stmt->fetch()) {
            $contacts[] = new Contact($row['cid'], $row['user_id'], $row['f_name'], $row['l_name'], $row['email'], $row['status'], $row['last_seen'], $row['count_seen'], $row['duration_seen']);
        }
        return $contacts;
    }

    public static function getContact($cid) {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM contact WHERE cid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cid]);
        $row = $stmt->fetch();
        return new Contact($row['cid'], $row['user_id'], $row['f_name'], $row['l_name'], $row['email'], $row['status'], $row['last_seen'], $row['count_seen'], $row['duration_seen']);
    }

    public static function renderContacts() {
        $contacts = Contact::getContacts($_COOKIE["uid"]);
        foreach ($contacts as $contact) {
            echo '<div id="dashboard-feed" class="main col-lg-6 col-md-8">
                    <div class="feed-container">
                        <div class="content">
                            <main id="main" class="feed-mfe">
                                <div class="package-feed-ui">
                                    <div class="feed-ui-components">
                                        <div class="feed-ui-header">
                                            <div class="feed-ui-media">
                                                <div class="feed-ui-media-left">
                                                    <div class="feed-ui-icon-container">
                                                        <a href="#" class="ui-avatar">
                                                            <div class="ui-img-wrapper">
                                                                <img src="./svg/avatar.svg" alt="avatar">
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="feed-ui-media-body">
                                                    <div class="feed-ui-media-body-header">
                                                        <a href="./profile">' . $_COOKIE["f_name"], ' ' . $_COOKIE["l_name"] . '</a>
                                                    </div>
                                                    <div class="feed-ui-media-body-subtitle-wrapper">
                                                        <time class="timestamp text-medium" datetime="2023-02-27 00-13-30 UTC">Feburary 24, 2023</time>
                                                    </div>
                                                </div>
                                                <div class="feed-ui-media-right">
                                                    <div class="feed-ui-media-right-components">
                                                        <div class="feed-media-right-component">
                                                            <button class="package-ui-btn">
                                                                <svg class="package-btn-svg">
                                                                    <path class="btn-svg-path" d="M16 3.39V4.8l-8.02 8.03L0 4.81V3.39l7.98 8.02L16 3.39z" fill=""></path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="feed-body" class="feed-ui-body">
                                            <div class="feed-ui-media">
                                                <div class="feed-ui-media-left">
                                                    <div class="feed-ui-icon-activity">
                                                        <svg class="icon-activity">
                                                            <path d="M19.99 13.33a3.7 3.7 0 01-3.32-2l-.17-.32h-1.01l-.17.32a3.763 3.763 0 01-6.65 0l-.17-.32H7.49l-.17.32a3.72 3.72 0 01-3.32 2 3.7 3.7 0 01-3.01-1.51v1.88a5.02 5.02 0 003.01.98 5.054 5.054 0 004-1.92 5.116 5.116 0 007.99 0 5.122 5.122 0 007.01.94v-1.88a3.71 3.71 0 01-3.01 1.51zm-7.99 8a3.725 3.725 0 01-3.33-2L8.49 19H7.5l-.18.33a3.7 3.7 0 01-3.32 2 3.7 3.7 0 01-3.01-1.51v1.89c.873.64 1.929.98 3.01.97a5.054 5.054 0 004-1.92 5.054 5.054 0 004 1.92 4.947 4.947 0 003-.98v-1.87a3.654 3.654 0 01-3 1.5zm8-16.02a3.735 3.735 0 01-3.33-2L16.51 3h-1.02l-.16.31a3.724 3.724 0 01-3.33 2 3.681 3.681 0 01-3-1.5V5.7a5.04 5.04 0 003 .96 5.024 5.024 0 004-1.92 5.023 5.023 0 004 1.92 5.124 5.124 0 003-.95v-1.9a3.654 3.654 0 01-3 1.5z" fill=""></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="feed-ui-media-body">
                                                    <div class="feed-ui-media-body-activity">
                                                        <h3 class="feed-body-header">' . $contact->getF_Name(), ' ' . $contact->getL_Name() . '</h3>
                                                        <div class="feed-ui-media">
                                                            <div class="feed-ui-nmedia-body">
                                                                <ul class="feed-media-items">
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Type
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                ' . $contact->getStatus() .'
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Duration Seen
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                ' . Contact::getDurationAsString($contact->getDuration_seen()) .'
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Count Seen
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                ' . $contact->getCount_seen() . '
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                ' . Contact::getDateAsString($contact->getLast_seen()) .'                
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                2023-02-28
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                E-mail                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                ' . $contact->getEmail() . '
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>';
        }
    }
}
