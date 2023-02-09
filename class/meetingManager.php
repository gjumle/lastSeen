<?php
class MeetingManager {

    private static function getMeetings($mid = null) {
        $condition = ($mid == null) ? "" : "WHERE mid = " . $mid;

        $conn = DB::getConnection();
        $sql = "SELECT * FROM meetings " . $condition . " ORDER BY name ASC";
        $result = $conn->query($sql);
        $meetings = array();
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
                $meeting = new Meeting ($row['mid'], $row['name'], $row['description'], $row['date'], $row['location'], UserManager::getUser($row['uid']));
                array_push($meetings, $meeting);
            }
        }
        return $meetings;
    }

    public static function getMeeting($mid) {
        $meetings = self::getMeetings();
        return $meetings[0];
    }

    private static function formHandler() {
        if (isset($_POST['edit'])) {
            $editMeeting = new Meeting ($_POST['mid'], $_POST['name'], $_POST['description'], $_POST['date'], $_POST['location'], UserManager::getUser($_POST['user']));
            $editMeeting->saveToDB();
            echo "<script type='text/javascript'>window.location.replace('meetingManager.php');</script>";
        }
        if (isset($_GET['delete'])) {
            $deleteMeeting = self::getMeeting($_GET['delete']);
            $deleteMeeting->deleteFromDB(); 
            echo "<script type='text/javascript'>window.location.replace('meetingManager.php');</script>";
        }
        if (isset($_POST['insert'])) {
            $isnertMeeting = new Meeting (null, $_POST['name'], $_POST['description'], $_POST['date'], $_POST['location'], UserManager::getUser($_POST['user']));
            $isnertMeeting->insertToDB();
            echo "<script type='text/javascript'>window.location.replace('meetingManager.php');</script>";
        }
    }

    private static function renderAllAsTableRow() {
        $meetings = self::getMeetings();
        $table = "";
        foreach ($meetings as $meeting) {
            $table .= $meeting->renderAsRowTable();
        }
        return $table;
    }

    public static function renderDataTable() {
        self::formHandler();
        $table = "<table class='table-data'>";
        $table .= Meeting::renderHead();

        if (isset($_GET['action']) && ($_GET['action'] == 'new')) {
            $meeting = new Meeting();
            $table .= $meeting->renderForm();
        }
        $table .= self::renderAllAsTableRow();
        $table .= "</table>";

        return $table;
    }
}