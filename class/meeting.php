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

    public static function getDuration_in_minutes($start_time, $end_time) {
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        $duration = $end_time - $start_time;
        $duration_in_minutes = $duration / 60;
        return $duration_in_minutes;
    }

    public static function getDayTimeAsString($start_time, $end_time) {
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        $start_time = date('g:i A', $start_time);
        $end_time = date('g:i A', $end_time);
        $day_time = $start_time . ' - ' . $end_time;
        return $day_time;
    }

    public static function getContactName($contact_id) {
        $pdo = DB::connectPDO();
        $sql = "SELECT f_name, l_name FROM contacts WHERE cid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$contact_id]);
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        $contact_name = $contact['f_name'] . ' ' . $contact['l_name'];
        return $contact_name;
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

    public static function renderMeetings() {
        $meetings = Meeting::getMeetings($_COOKIE['uid']);
        foreach ($meetings as $meeting) {
            echo '<div class="content">
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
                                            <a href="#">' . Meeting::getContactName($meeting->getContact_id()) . '</a>
                                        </div>
                                        <div class="feed-ui-media-body-subtitle-wrapper">
                                            <time class="timestamp text-medium" datetime="2023-02-24 00-15-30 UTC">Feburary 24, 2023</time>
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
                                            <h3 class="feed-body-header">'. Meeting::getDayTimeAsString($meeting->getStart_time(), $meeting->getEnd_time()) .' Meeting</h3>
                                            <div class="feed-ui-media">
                                                <div class="feed-ui-nmedia-body">
                                                    <ul class="feed-media-items">
                                                        <li class="feed-media-item">
                                                            <div class="package-stat">
                                                                <span class="stat-label">
                                                                    Duration
                                                                </span>
                                                                <div class="stat-value">
                                                                    ' . Meeting::getDuration_in_minutes($meeting->getStart_time(), $meeting->getEnd_time()) .'
                                                                    <abbr title="metrics" class="unit">min</abbr>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="feed-media-item">
                                                            <div class="package-stat">
                                                                <span class="stat-label">
                                                                    Location
                                                                </span>
                                                                <div class="stat-value">
                                                                    ' . $meeting->getLocation() . '
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="feed-media-item">
                                                            <div class="package-stat">
                                                                <span class="stat-label">
                                                                    Description
                                                                </span>
                                                                <div class="stat-value">
                                                                    ' . $meeting->getDescription() . '
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
            </div>';
        }
    }
}