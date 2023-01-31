<?php
class MeetingManger {

    private static function getMeetings($mid = null) {
        $condition = ($mid == null) ? "" : "WHERE mid = " . $mid;

        $conn = DB::getConnection();
        $sql = "SELECT * FROM meetings " . $condition . " ORDER BY name ASC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
                $meeting = new Meeting ($row['mid'], $row['name'], $row['description'], $row['date'], $row['location'], $row['uid']);
                array_push($meetings, $meeting);
            }
        }
        return $meetings;
    }

    public static function getMeeting($mid) {
        $meetings = self::getMeetings();
        return $meeting[0];
    }
}