<?php
class UserManager {
    private $users = array();

    function __construct() {
        $this->loadUsers();
    }

    public function loadUsers() {
        $sql = "SELECT * FROM users";
        $result = DB::query($sql);
        while ($row = $result->fetch_assoc()) {
            $user = new User($row['uid'], $row['username'], $row['password'], $row['admin'], $row['lastSeen']);
            $this->users[] = $user;
        }
    }

    public function renderAsTable() {
        $table = "
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Admin</th>
                <th>Last Seen</th>
                <th>Actions</th>
            </tr>";
        foreach ($this->users as $user) {
            $table .= $user->renderAsRowTable();
        }
        $table .= "</table>";
        return $table;
    }

    public function renderAsSelect($name, $selected = null) {
        $select = "<select name='" . $name . "'>";
        foreach ($this->users as $user) {
            $select .= $user->renderAsOption($selected);
        }
        $select .= "</select>";
        return $select;
    }

    public function getUserById($id) {
        foreach ($this->users as $user) {
            if ($user->uid == $id) {
                return $user;
            }
        }
        return null;
    }

    public function getUserByUsername($username) {
        foreach ($this->users as $user) {
            if ($user->username == $username) {
                return $user;
            }
        }
        return null;
    }

    public function getUserByPassword($password) {
        foreach ($this->users as $user) {
            if ($user->password == $password) {
                return $user;
            }
        }
        return null;
    }

    public function getUserByAdmin($admin) {
        foreach ($this->users as $user) {
            if ($user->admin == $admin) {
                return $user;
            }
        }
        return null;
    }

    public function getUserByLastSeen($lastSeen) {
        foreach ($this->users as $user) {
            if ($user->lastSeen == $lastSeen) {
                return $user;
            }
        }
        return null;
    }

    public function addUser($username, $password, $admin, $lastSeen) {
        $user = new User(null, $username, $password, $admin, $lastSeen);
        $user->insertToDB();
        $this->loadUsers();
    }

    public function updateUser($uid, $username, $password, $admin, $lastSeen) {
        $user = $this->getUserById($uid);
        $user->username = $username;
        $user->password = $password;
        $user->admin = $admin;
        $user->lastSeen = $lastSeen;
        $user->updateToDB();
        $this->loadUsers();
    }

    public function deleteUser($uid) {
        $user = $this->getUserById($uid);
        $user->deleteFromDB();
        $this->loadUsers();
    }

    public function deleteAllUsers() {
        $sql = "DELETE FROM users";
        DB::query($sql);
        $this->loadUsers();
    }

    public function getNumUsers() {
        return count($this->users);
    }

    public function getNumAdmins() {
        $numAdmins = 0;
        foreach ($this->users as $user) {
            if ($user->admin == 1) {
                $numAdmins++;
            }
        }
        return $numAdmins;
    }

    public function getNumNonAdmins() {
        $numNonAdmins = 0;
        foreach ($this->users as $user) {
            if ($user->admin == 0) {
                $numNonAdmins++;
            }
        }
        return $numNonAdmins;
    }

    public function getNumUsersLastSeenToday() {
        $numUsersLastSeenToday = 0;
        foreach ($this->users as $user) {
            if ($user->lastSeen == date("Y-m-d")) {
                $numUsersLastSeenToday++;
            }
        }
        return $numUsersLastSeenToday;
    }

    public function getNumUsersLastSeenYesterday() {
        $numUsersLastSeenYesterday = 0;
        foreach ($this->users as $user) {
            if ($user->lastSeen == date("Y-m-d", strtotime("-1 day"))) {
                $numUsersLastSeenYesterday++;
            }
        }
        return $numUsersLastSeenYesterday;
    }

    public function getNumUsersLastSeenThisWeek() {
        $numUsersLastSeenThisWeek = 0;
        foreach ($this->users as $user) {
            if ($user->lastSeen >= date("Y-m-d", strtotime("last Monday")) && $user->lastSeen <= date("Y-m-d", strtotime("next Sunday"))) {
                $numUsersLastSeenThisWeek++;
            }
        }
        return $numUsersLastSeenThisWeek;
    }

    public function getNumUsersLastSeenThisMonth() {
        $numUsersLastSeenThisMonth = 0;
        foreach ($this->users as $user) {
            if ($user->lastSeen >= date("Y-m-d", strtotime("first day of this month")) && $user->lastSeen <= date("Y-m-d", strtotime("last day of this month"))) {
                $numUsersLastSeenThisMonth++;
            }
        }
        return $numUsersLastSeenThisMonth;
    }

    public function getNumUsersLastSeenThisYear() {
        $numUsersLastSeenThisYear = 0;
        foreach ($this->users as $user) {
            if ($user->lastSeen >= date("Y-m-d", strtotime("first day of January")) && $user->lastSeen <= date("Y-m-d", strtotime("last day of December"))) {
                $numUsersLastSeenThisYear++;
            }
        }
        return $numUsersLastSeenThisYear;
    }

    public function getNumUsersLastSeenLastWeek() {
        $numUsersLastSeenLastWeek = 0;
        foreach ($this->users as $user) {
            if ($user->lastSeen >= date("Y-m-d", strtotime("last Monday -1 week")) && $user->lastSeen <= date("Y-m-d", strtotime("next Sunday -1 week"))) {
                $numUsersLastSeenLastWeek++;
            }
        }
        return $numUsersLastSeenLastWeek;
    }

    public function getNumUsersLastSeenLastMonth() {
        $numUsersLastSeenLastMonth = 0;
        foreach ($this->users as $user) {
            if ($user->lastSeen >= date("Y-m-d", strtotime("first day of last month")) && $user->lastSeen <= date("Y-m-d", strtotime("last day of last month"))) {
                $numUsersLastSeenLastMonth++;
            }
        }
        return $numUsersLastSeenLastMonth;
    }

    public function getNumUsersLastSeenLastYear() {
        $numUsersLastSeenLastYear = 0;
        foreach ($this->users as $user) {
            if ($user->lastSeen >= date("Y-m-d", strtotime("first day of January last year")) && $user->lastSeen <= date("Y-m-d", strtotime("last day of December last year"))) {
                $numUsersLastSeenLastYear++;
            }
        }
        return $numUsersLastSeenLastYear;
    }
}