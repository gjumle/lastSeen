<?php
class Meeting {
    private $mid;
    private $name;
    private $description;
    private $date;
    private $location;
    private $user;

    public function __construct($mid = null, $name = null, $description = null, $date = null, $location = null, $user = null) {
        $this->mid = $mid;
        $this->name = $name;
        $this->description = $description;
        $this->date = $date;
        $this->location = $location;
        $this->user = $user;
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
        return $this->user;
    }

    public function renderForm() {
        if ($this->mid > 0) {
            $mid = $this->mid;
            $name = $this->name;
            $description = $this->description;
            $date = $this->date;
            $location = $this->date;
            $user = UserManager::renderAsSelect($this->user);
            $btnName = "edit";
        } else {
            $mid = "";
            $name = "";
            $description = "";
            $date = "";
            $location = "";
            $user = UserManager::renderAsSelect(null);
            $btnName = "insert";
        }
        return "
            <form action='' method='post'>
                <tr>
                    <td><input type='hidden' name='mid' value='" . $mid . "'></td>
                    <td><input type='text' name='name' value='" . $name . "'></td>
                    <td><input type='text' name='description' value='" . $description . "'></td>
                    <td><input type='date' name='date' value='" . $date . "'></td>
                    <td><input type='text' name='location' value='" . $location . "'></td>
                    <td>" . $user . "</td>
                    <td colspan='2'><input type='submit' name='" . $btnName . "'></td>
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
                    <td>" . $this->name . "</td>
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
                <th>User</th>
                <th colspan='2'>Action</th>
            </tr>";
    }

    public function insertToDB() {
        $conn = DB::getConnection();
        $sql = "INSERT INTO meetings (name, description, date, location, uid) VALUES ('" . $this->name . "', '" . $this->description . "', '" . $this->date . "', '" . $this->location . "', " . $this->user->getId() . ")";
        $reult = $conn->query($sql);
    }

    public function saveToDB() {
        $conn = DB::getConnection(); 
        $sql = "UPDATE meetings SET name = '" . $this->name . "', description = '" . $this->description . "', date = '" . $this->date . "', location = '" . $this->location . "', uid = " . $this->user->getUid() . " WHERE mid = " . $this->mid;
        $reult = $conn->query($sql);
    }

    public function deleteFromDB() {
        $conn = DB::getConnection();
        $sql = "DELETE FROM meetings WHERE mid = " . $this->mid;
        $reult = $conn->query($sql);
    }
}