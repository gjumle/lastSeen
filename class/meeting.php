<?php
class Meeting {
    private $mid;
    private $name;
    private $desctiption;
    private $date;
    private $location;
    private $uid;

    public function __construct($mid = null, $name = null, $desctiption = null, $date = null, $location = null, $uid = null) {
        $this->mid = $mid;
        $this->name = $name;
        $this->description = $desctiption;
        $this->date = $date;
        $this->location = $location;
        $this->uid = $uid;
    }

    public function getId() {
        return $this->mid;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDate() {
        return $this->date;
    }

    public function getLocation() {
        return $this->location;
    }

    public function getuid() {
        return $this->uid;
    }

    public function renderForm() {
        if ($this->mid > 0) {
            $mid = $this->mid;
            $name = $this->name;
            $desctiption = $this->description;
            $date = $this->date;
            $location = $this->date;
            $user = UserManager::renderAsSelect($this->user);
            $btnName = "edit";
        } else {
            $mid = "";
            $name = "";
            $desctiption = "";
            $date = "";
            $location = "";
            $user = UserManager::renderAsSelect(null);
            $btnName = "insert";
        }
        return "
            <form action='' method='post'>
                <tr>
                    <td><input type='hidden' name='uid' value='" . $mid . "'></td>
                    <td><input type='text' name='name' value='" . $name . "'></td>
                    <td><input type='text' name='description' value='" . $desctiption . "'></td>
                    <td><input type='date' name='date' value='" . $date . "'></td>
                    <td><input type='text' name='location' value='" . $location . "'></td>
                    <td>" . $user . "</td>
                    <td><input type='sumbit' name='" . $btnName . "'></td>
                </tr>
            </form>";
    }

    public function renderAsRowTable() {
        if (isset($_GET['edit']) && $_GET['edit'] == $this->mid) {
            return $this->renderForm();
        } else {
            return "
                <tr>
                    <td>#" . $this->mid . "</td>
                    <td>" . $this->name . "<td/>
                    <td>" . $this->description . "</td>
                    <td>" . $this->date . "</td>
                    <td>" . $this->location . "</td>
                    <td>" . $this->user->getName() . "</td>
                    <td><a href='?edit=" . $this->mid . "'>Edit</a></td>
                    <td><a href='?delete=" . $this->mid . "'>Delete</a></td>
                </tr>";
        }
    }

    public static function renderHead() {
        return "
            <tr>
                <th>ID</th>
                <th width='170px'>Name</th>
                <th width='170px'>Description</th>
                <th>Date</th>
                <th width='170px'>Location</th>
                <th width='170px'>User</th>
            </tr>";
    }

    public function insertToDB() {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("INSERT INTO meetings (name, description, date, location, uid) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssi", $this->namme, $this->description, $this->date, $this->location, $this->user);
        $stmt->execute();
    }

    public function saveToDB() {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("UPDATE meetings SET name = ?, description = ?, date = ?, location = ?, uid = ? WHERE mid = ?");
        $stmt->bind_param("sssii", $this->name, $this->description, $this->date, $this->location, $this->user, $this->mid);
        $stmt->execute();
    }

    public function deleteFromDB() {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("DELETE FROM meetings WHERE mid = ?");
        $stmt->bind_param("i", $this->mid);
        $stmt->execute();
    }
}