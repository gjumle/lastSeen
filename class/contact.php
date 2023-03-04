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

    public static function getContacts($cid = null) {
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

    public static function add($user_id, $f_name, $l_name, $email, $phone, $address, $city, $state, $zip, $country, $notes, $status, $last_seen, $count_seen, $duration_seen) {
        $contact = new Contact(null, $user_id, $f_name, $l_name, $email, $phone, $address, $city, $state, $zip, $country, $notes, $status, $last_seen, $count_seen, $duration_seen);
        $contact->insertToDB();
    }

    public static function edit($cid, $user_id, $f_name, $l_name, $email, $phone, $address, $city, $state, $zip, $country, $notes, $status, $last_seen, $count_seen, $duration_seen) {
        $contact = new Contact($cid, $user_id, $f_name, $l_name, $email, $phone, $address, $city, $state, $zip, $country, $notes, $status, $last_seen, $count_seen, $duration_seen);
        $contact->saveToDB();
    }

    public static function delete($cid) {
        $contact = self::getContact($cid);
        $contact->deleteFromDB();
    }

    public static function renderHead() {
        return  "
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Country</th>
            <th>Notes</th>
            <th>Status</th>
            <th>Last Seen</th>
            <th>Count Seen</th>
            <th>Duration Seen</th>";
    }

    public static function renderContacts($contacts = null) {
        $html = "<table>";
        $html .= Contact::renderHead();
        $contacts = ($contacts == null) ? self::getContacts() : $contacts;
        foreach ($contacts as $contact) {
            $html .= "<tr>";
            $html .= "<td>" . $contact->f_name . "</td>";
            $html .= "<td>" . $contact->l_name . "</td>";
            $html .= "<td>" . $contact->email . "</td>";
            $html .= "<td>" . $contact->phone . "</td>";
            $html .= "<td>" . $contact->address . "</td>";
            $html .= "<td>" . $contact->city . "</td>";
            $html .= "<td>" . $contact->state . "</td>";
            $html .= "<td>" . $contact->zip . "</td>";
            $html .= "<td>" . $contact->country . "</td>";
            $html .= "<td>" . $contact->notes . "</td>";
            $html .= "<td>" . $contact->status . "</td>";
            $html .= "<td>" . $contact->last_seen . "</td>";
            $html .= "<td>" . $contact->count_seen . "</td>";
            $html .= "<td>" . $contact->duration_seen . "</td>";
            $html .= "<td><a href='?edit=" . $contact->cid . "'>Edit</a></td>";
            $html .= "<td><a href='?delete=" . $contact->cid . "'>Delete</a></td>";
            $html .= "</tr>";
        }
        return $html;
    }

    public static function renderForm() {
        echo "<button type='submit' name='add'>Add</button>";
        if (isset($_GET['add'])) {
             return "
                <form action='contact.php' method='post'>
                    <tr>
                        <td><input type='text' name='f_name' placeholder='First Name'></td>
                        <td><input type='text' name='l_name' placeholder='Last Name'></td>
                        <td><input type='text' name='email' placeholder='Email'></td>
                        <td><input type='text' name='phone' placeholder='Phone'></td>
                        <td><input type='text' name='address' placeholder='Address'></td>
                        <td><input type='text' name='city' placeholder='City'></td>
                        <td><input type='text' name='state' placeholder='State'></td>
                        <td><input type='text' name='zip' placeholder='Zip'></td>
                        <td><input type='text' name='country' placeholder='Country'></td>
                        <td><input type='text' name='notes' placeholder='Notes'></td>
                        <td><input type='text' name='status' placeholder='Status'></td>
                        <td><input type='text' name='last_seen' placeholder='Last Seen'></td>
                        <td><input type='text' name='count_seen' placeholder='Count Seen'></td>
                        <td><input type='text' name='duration_seen' placeholder='Duration Seen'></td>
                        <td><input type='submit' name='submit' value='Add'></td>
                </form>";
        }
        if (isset($_GET['edit'])) {
            $cid = $_GET['edit'];
            $contact = self::getContact($cid);
            return "
                <form action='contact.php' method='post'>
                    <tr>
                        <td><input type='text' name='f_name' value='" . $contact->f_name . "'></td>
                        <td><input type='text' name='l_name' value='" . $contact->l_name . "'></td>
                        <td><input type='text' name='email' value='" . $contact->email . "'></td>
                        <td><input type='text' name='phone' value='" . $contact->phone . "'></td>
                        <td><input type='text' name='address' value='" . $contact->address . "'></td>
                        <td><input type='text' name='city' value='" . $contact->city . "'></td>
                        <td><input type='text' name='state' value='" . $contact->state . "'></td>
                        <td><input type='text' name='zip' value='" . $contact->zip . "'></td>
                        <td><input type='text' name='country' value='" . $contact->country . "'></td>
                        <td><input type='text' name='notes' value='" . $contact->notes . "'></td>
                        <td><input type='text' name='status' value='" . $contact->status . "'></td>
                        <td><input type='text' name='last_seen' value='" . $contact->last_seen . "'></td>
                        <td><input type='text' name='count_seen' value='" . $contact->count_seen . "'></td>
                        <td><input type='text' name='duration_seen' value='" . $contact->duration_seen . "'></td>
                        <td><input type='submit' name='submit' value='Edit'></td>
                </form>";
        }
    }
}