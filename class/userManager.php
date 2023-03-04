<?php

class UserManager {
    public static function getUsers($uid = null) {
        $pdo = DB::connectPDO();
        $conndition = ($uid == null) ? "" : "WHERE uid = ?";
        $sql = "SELECT * FROM users $conndition";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$uid]);
        $rows = $stmt->fetchAll();
        $users = [];
        foreach ($rows as $row) {
            $user = new User($row['uid'], $row['username'], $row['f_name'], $row['l_name'], $row['password'], $row['admin'], $row['email']);
            $users[] = $user;
        }
        return $users;
    }

    public static function getUser($uid) {
        return self::getUsers($uid)[0];
    }

    public static function renderProfile() {
        $user = self::getUser($_COOKIE['uid']);
        if (isset($_GET['edit'])) {
            return
                "<div class='container'>
                    <div class='profile'>
                        <h1>Profile</h1>
                    </div>
                    <table>
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Admin</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <form action='profile.php' method='POST'>
                                <td><input type='text' name='username' value='" . $user->getUsername() . "'</td>
                                <td><input type='text' name='f_name' value='" . $user->getFName() . "'</td>
                                <td><input type='text' name='l_name' value='" .  $user->getLName() . "'</td>
                                <td><input type='email' name='email' value='" . $user->getEmail() . "'</td>
                                <td><input type='password' name='password'</td>
                                <td>" . User::getAdminString($user->getAdmin()) . "</td>
                                <td><input type='submit' value='Save'></td>
                            </form>
                        </tr>
                </div>";
        } else {
            return
                "<div class='container'>
                    <div class='profile'>
                        <h1>Profile</h1>
                    </div>
                    <table>
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Admin</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <td>" . $user->getUsername() . "</td>
                            <td>" . $user->getFName() . "</td>
                            <td>" . $user->getLName() . "</td>
                            <td>" . $user->getEmail() . "</td>
                            <td>******</td>
                            <td>" . User::getAdminString($user->getAdmin()) . "</td>
                            <td><a href='?edit=" . $user->getUid() . "'>Edit</a></td>
                        </tr>
                </div>";
        }
    }
}