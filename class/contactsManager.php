<?php 

class ContactsManager {
    public static function getContacts($cid = null) {
        $pdo = DB::connectPDO();
        $condition = ($cid == null) ? "" : " WHERE cid = ?";
        $sql = "SELECT * FROM contacts $condition";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cid]);
        $contacts = [];
        while ($row = $stmt->fetch()) {
            $contacts[] = new Contact($row['cid'], $row['user_id'], $row['f_name'], $row['l_name'], $row['email'], $row['last_seen'], $row['count_seen'], $row['duration_seen']);
        }
    }

    public static function getContact($cid) {
        $contacts = self::getContacts($cid);
        return $contacts[0];
    }
}