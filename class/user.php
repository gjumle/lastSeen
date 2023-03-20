<?php 

class User {
    private $uid;
    private $username;
    private $f_name;
    private $l_name;
    private $password;
    private $admin;
    private $email;
    private $timestamp;

    public function __construct($uid = null, $username = null, $f_name = null, $l_name = null, $password = null, $admin = null, $email = null, $timestamp = null) {
        $this->uid = $uid;
        $this->username = $username;
        $this->f_name = $f_name;
        $this->l_name = $l_name;
        $this->password = $password;
        $this->admin = $admin ? 1 : 0;
        $this->email = $email;
        $this->timestamp = $timestamp;
    }

    public function getUid() {
        return $this->uid;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getF_name() {
        return $this->f_name;
    }

    public function getL_name() {
        return $this->l_name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function getAdminAsStr() {
        return ($this->admin) ? "Admin" : "User";
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setUid($uid) {
        $this->uid = $uid;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setF_name($f_name) {
        $this->f_name = $f_name;
    }

    public function setL_name($l_name) {
        $this->l_name = $l_name;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    public static function getContactsCount() {
        $pdo = DB::connectPDO();
        $sql = "SELECT COUNT(*) FROM contacts WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_COOKIE['uid']]);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        return $row[0];
    }


    public function deleteFromDB() {
        $pdo = DB::connectPDO();
        $sql = "DELETE FROM users WHERE uid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->uid]);
    }

    public function insertToDB() {
        $pdo = DB::connectPDO();
        $sql = "INSERT INTO users (username, f_name, l_name, password, admin, email) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->username, $this->f_name, $this->l_name, $this->password, $this->admin, $this->email]);
    }

    public function saveToDB() {
        $pdo = DB::connectPDO();
        $sql = "UPDATE users SET username = ?, f_name = ?, l_name = ?, password = ?, admin = ?, email = ? WHERE uid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->username, $this->f_name, $this->l_name, $this->password, $this->admin, $this->email, $this->uid]);
    }

    public static function getUsers($uid) {
        $condition = ($uid) ? " WHERE uid = ?" : "";
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM users" . $condition;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$uid]);
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($row['uid'], $row['username'], $row['f_name'], $row['l_name'], $row['password'], $row['admin'], $row['email'], $row['timestamp']);
        }
        return $users;
    }

    public static function getUser($uid) {
        $users = self::getUsers($uid);
        return $users[0];
    }

    public static function getDateAsString($date) {
        $date = new DateTime($date);
        return $date->format('d.m.Y');
    }

    public static function handleForm() {
        if (isset($_GET['delete'])) {
            $user = User::getUser($_GET['delete']);

            $user->deleteFromDB();

            header("Location: ./admin.php");
        }
        if (isset($_POST['save'])) {
            if (isset($_GET['edit']) && !empty($_GET['edit'])) {
                $user = User::getUser($_GET['edit']);
                $user->setUsername($_POST['username']);
                $user->setF_name($_POST['f_name']);
                $user->setL_name($_POST['l_name']);
                if (isset($_POST['admin']) && isset($_COOKIE['admin']) && $_COOKIE['admin'] == 1) {
                    $user->setAdmin($_POST['status']);
                }
                $user->setPassword($_POST['password']);
                $user->setAdmin($_POST['admin']);
                $user->setEmail($_POST['email']);

                $user->saveToDB();

            } else {
                $user = new User();
                $user->setUsername($_POST['username']);
                $user->setF_name($_POST['f_name']);
                $user->setL_name($_POST['l_name']);
                if (isset($_POST['admin']) && isset($_COOKIE['admin']) && $_COOKIE['admin'] == 1) {
                    $user->setAdmin($_POST['status']);
                }
                $user->setPassword($_POST['password']);
                $user->setAdmin($_POST['admin']);
                $user->setEmail($_POST['email']);

                $user->insertToDB();
            }

            header('Location: ./admin.php');
        }
        if (isset($_GET['cancel'])) {
            header("Location: ./admin.php");
        }
    }

    public function login() {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM users WHERE email = ? OR username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->email, $this->username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['username'] != $this->username && $this->username != null) {
            return "<span class='error'>Wrong username</span>";
        }
        if ($row['email'] != $this->email && $this->email != null) {
            return "<span class='error'>Wrong email</span>";
        }

        if (password_verify($this->password, $row['password'])) {
            setcookie('uid', $row['uid'], time() + (86400 * 30), '/');
            setcookie('username', $row['username'], time() + (86400 * 30), '/');
            setcookie('f_name', $row['f_name'], time() + (86400 * 30), '/');
            setcookie('l_name', $row['l_name'], time() + (86400 * 30), '/');
            setcookie('email', $row['email'], time() + (86400 * 30), '/');
            setcookie('admin', $row['admin'], time() + (86400 * 30), '/');
            setcookie('logged_in', true, time() + (86400 * 30), '/');
            header("Location: ./dashboard.php");
        } else {
            return "<span class='error'>Wrong password</span>";
        }
    }

    public static function logout() {
        if (isset($_GET['logout'])) {
            setcookie('uid', '', time() - 3600, '/');
            setcookie('username', '', time() - 3600, '/');
            setcookie('f_name', '', time() - 3600, '/');
            setcookie('l_name', '', time() - 3600, '/');
            setcookie('email', '', time() - 3600, '/');
            setcookie('admin', '', time() - 3600, '/');
            setcookie('logged_in', '', time() - 3600, '/');
            header("Location: ./login.php");
        }
    }

    public function register() {
        $pdo = DB::connectPDO();
        $sql = "SELECT * FROM users WHERE email = ? OR username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->email, $this->username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['username'] == $this->username && $this->username != null) {
            return "<span class='error'>Username already exists</span>";
        } else
        if ($row['email'] == $this->email && $this->email != null) {
            return "<span class='error'>Email already exists</span>";
        } else {
            $this->insertToDB();
            header("Location: ./login.php");
        }
    }

    public static function renderUsers($uid) {
        if (isset($_GET['add'])) {
            $user = new User();
            echo
                '<div class="content">
                    <main id="main" class="feed-mfe">
                        <div class="package-feed-ui">
                            <form method="post" action="">
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
                                                <time class="timestamp text-medium" datetime="2023-02-27 00-13-30 UTC">' . User::getDateAsString($user->getTimestamp()) . '</time>
                                            </div>
                                        </div>
                                        <div class="feed-ui-media-right">
                                            <div class="feed-ui-media-right-components">
                                                <div class="feed-ui-media-right-component">
                                                    <input type="submit" class="btn btn-primary btn-delete" type="submit" name="save" value="Save">
                                                </div>
                                                <div class="feed-ui-media-right-component">
                                                    <a href="?cancel=' . $user->getUid() . '" class="btn btn-primary btn-edit" type="submit" name="cancel">Cancel</a>
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
                                                <h3 class="feed-body-header"><input type="text" name="f_name" value="' . $user->getF_Name(), '" placeholder="First Name"> <input type="text" name="l_name" value="' . $user->getL_Name() . '" placeholder="Last Name"></h3>
                                                <div class="feed-ui-media">
                                                    <div class="feed-ui-nmedia-body">
                                                        <ul class="feed-media-items">
                                                            <li class="feed-media-item">
                                                                <div class="package-stat">
                                                                    <span class="stat-label">
                                                                        Type
                                                                    </span>
                                                                    <div class="stat-value">
                                                                        <select name="status">
                                                                            <option value="">Select Status</option>
                                                                            <option value="1">Admin</option>
                                                                            <option value="0">User</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="feed-media-item">
                                                                <div class="package-stat">
                                                                    <span class="stat-label">
                                                                        E-mail                 
                                                                    </span>
                                                                    <div class="stat-value">
                                                                        <input type="email" name="email" value="' . $user->getEmail() . '" placeholder="Email">
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
                            </form>
                        </div>
                    </main>
                </div>';
        }
        $users = User::getUsers($uid);
        foreach ($users as $user) {
            if (isset($_GET['edit']) && $_GET['edit'] == $user->getUid()) {
                echo 
                    '<div class="content">
                        <main id="main" class="feed-mfe">
                            <div class="package-feed-ui">
                                <form method="post" action="">
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
                                                    <time class="timestamp text-medium" datetime="2023-02-27 00-13-30 UTC">' . User::getDateAsString($user->getTimestamp()) . '</time>
                                                </div>
                                            </div>
                                            <div class="feed-ui-media-right">
                                                <div class="feed-ui-media-right-components">
                                                    <div class="feed-ui-media-right-component">
                                                        <input type="submit" class="btn btn-primary btn-delete" type="submit" name="save" value="Save">
                                                    </div>
                                                    <div class="feed-ui-media-right-component">
                                                        <a href="?cancel=' . $user->getUid() . '" class="btn btn-primary btn-edit" type="submit" name="cancel">Cancel</a>
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
                                                    <h3 class="feed-body-header"><input type="text" name="f_name" value="' . $user->getF_Name(), '"> <input type="text" name="l_name" value="' . $user->getL_Name() . '"></h3>
                                                    <div class="feed-ui-media">
                                                        <div class="feed-ui-nmedia-body">
                                                            <ul class="feed-media-items">
                                                                <li class="feed-media-item">
                                                                    <div class="package-stat">
                                                                        <span class="stat-label">
                                                                            Type
                                                                        </span>
                                                                        <div class="stat-value">
                                                                            <select name="status">';
                                                                            if ($user->getAdmin == 1) {
                                                                                echo '<option value="1" selected>Admin</option>';
                                                                            } else {
                                                                                echo '<option value="1">Admin</option>';
                                                                            }
                                                                            if ($user->getAdmin == 0) {
                                                                                echo '<option value="0" selected>User</option>';
                                                                            } else {
                                                                                echo '<option value="0">User</option>';
                                                                            }
                                                                            echo '</select>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="feed-media-item">
                                                                    <div class="package-stat">
                                                                        <span class="stat-label">
                                                                            E-mail                 
                                                                        </span>
                                                                        <div class="stat-value">
                                                                            <input type="email" name="email" value="' . $user->getEmail() . '">
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
                                </form>
                            </div>
                        </main>
                    </div>';
            } else {
                echo 
                    '<div class="content">
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
                                                    <time class="timestamp text-medium" datetime="2023-02-27 00-13-30 UTC">' . User::getDateAsString($user->getTimestamp()) . '</time>
                                                </div>
                                            </div>
                                            <div class="feed-ui-media-right">
                                                <div class="feed-ui-media-right-components">
                                                    <div class="feed-ui-media-right-component">
                                                        <a href="?edit=' . $user->getUid() . '&#' . $user->getUid() . '" class="btn btn-primary btn-edit" type="submit" name="logout">Edit</a>
                                                    </div>
                                                    <div class="feed-ui-media-right-component">
                                                        <a href="?delete=' . $user->getUid() . '" class="btn btn-primary btn-delete" type="submit" name="logout">Delete</a>
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
                                                    <h3 class="feed-body-header">' . $user->getF_Name(), ' ' . $user->getL_Name() . '</h3>
                                                    <div class="feed-ui-media">
                                                        <div class="feed-ui-nmedia-body">
                                                            <ul class="feed-media-items">
                                                                <li class="feed-media-item">
                                                                    <div class="package-stat">
                                                                        <span class="stat-label">
                                                                            Type
                                                                        </span>
                                                                        <div class="stat-value">
                                                                            ' . $user->getAdminAsStr() . '
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="feed-media-item">
                                                                    <div class="package-stat">
                                                                        <span class="stat-label">
                                                                            Date Registered
                                                                        </span>
                                                                        <div class="stat-value">
                                                                            ' . User::getDateAsString($user->getTimestamp()) . '
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="feed-media-item">
                                                                    <div class="package-stat">
                                                                        <span class="stat-label">
                                                                            Meetings
                                                                        </span>
                                                                        <div class="stat-value">
                                                                            ' . Meeting::getMeetingsCount() . '
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="feed-media-item">
                                                                    <div class="package-stat">
                                                                        <span class="stat-label">
                                                                            Contacts            
                                                                        </span>
                                                                        <div class="stat-value">
                                                                            ' . User::getContactsCount() . '
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="feed-media-item">
                                                                    <div class="package-stat">
                                                                        <span class="stat-label">
                                                                            E-mail                 
                                                                        </span>
                                                                        <div class="stat-value">
                                                                            ' . $user->getEmail() . '
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

    public static function renderUser($uid) {
        return User::renderUsers($uid);
    }
}