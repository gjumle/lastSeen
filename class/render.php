<?php

class Render {
    public static function renderHeader($title) {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>$title</title>
            <link rel='stylesheet' href='css/style.css'>
        </head>
        <body>";
    }

    public static function renderFooter() {
        echo "</body>
        </html>";
    }

    public static function renderNav() {
        if (isset($_COOKIE['logged_in'])) {
            User::logout();
            return 
                "<nav>
                    <ul>
                        <li><a href='dashboard.php'>Dashboard</a></li>
                        <li><a href='contacts.php'>Contacts</a></li>
                        <li><a href='meetings.php'>Meetings</a></li>
                        <li><a href='profile.php'>Profile</a></li>
                        <li><a href='?logout=1'>Logout</a></li>
                    </ul>
                </nav>";
        } else {
            return
                "<nav>
                    <ul>
                        <li><a href='index.php'>Home</a></li>
                        <li><a href='login.php'>Login</a></li>
                        <li><a href='register.php'>Register</a></li>
                    </ul>
                </nav>";
        }
    }

    public static function renderLogin() {
        return
            "<div class='container'>
                <div class='login'>
                    <form action='login.php' method='POST'>
                        <input type='email' name='email' placeholder='Email'>
                        <input type='password' name='password' placeholder='Password'>
                        <input type='submit' value='Login'>
                    </form>
                </div>
            </div>";
    }

    public static function renderRegister() {
        return 
            "<div class='container'>
                <div class='register'>
                    <form action='register.php' method='POST'>
                        <input type='text' name='username' placeholder='User Name'>
                        <input type='text' name='f_name' placeholder='First Name'>
                        <input type='text' name='l_name' placeholder='Last Name'>
                        <input type='email' name='email' placeholder='Email'>
                        <input type='password' name='password' placeholder='Password'>
                        <input type='submit' value='Register'>
                    </form>
                </div>
            </div>";
    }

    public static function renderIndex() {
        return
            "<div class='container'>
                <div class='index'>
                    <h1>Index</h1>
                </div>
            </div>";
    }

    public static function renderDashboard() {
        return
            "<div class='container'>
                <div class='dashboard'>
                    <h1>Dashboard</h1>
                </div>
            </div>";
    }

    public static function renderContacts() {
        return
            "<div class='container'>
                <div class='contacts'>
                    <h1>Contacts</h1>
                </div>
            </div>";
    }

    public static function renderMeetings() {
        return
            "<div class='container'>
                <div class='meetings'>
                    <h1>Meetings</h1>
                </div>
            </div>";
    }

    public static function renderProfile() {
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
                                <td><input type='text' name='username' value='" . $_COOKIE['username'] . "'</td>
                                <td><input type='text' name='f_name' value='" . $_COOKIE['f_name'] . "'</td>
                                <td><input type='text' name='l_name' value='" . $_COOKIE['l_name'] . "'</td>
                                <td><input type='email' name='email' value='" . $_COOKIE['email'] . "'</td>
                                <td><input type='password' name='password'</td>
                                <td>" . User::getAdminString($_COOKIE['admin']) . "</td>
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
                            <td>" . $_COOKIE['username'] . "</td>
                            <td>" . $_COOKIE['f_name'] . "</td>
                            <td>" . $_COOKIE['l_name'] . "</td>
                            <td>" . $_COOKIE['email'] . "</td>
                            <td>******</td>
                            <td>" . User::getAdminString($_COOKIE['admin']) . "</td>
                            <td><a href='?edit=" . $_COOKIE['uid'] . "'>Edit</a></td>
                        </tr>
                </div>";
        }
        
    }

    public static function renderProfileEdit() {
        
    }

    public static function renderIndexPage() {
        self::renderHeader("Home");
        echo self::renderNav();
        echo self::renderIndex();
        self::renderFooter();
    }

    public static function renderDashboardPage() {
        self::renderHeader("Dashboard");
        echo self::renderNav();
        echo self::renderDashboard();
        self::renderFooter();
    }

    public static function renderContactsPage() {
        self::renderHeader("Contacts");
        echo self::renderNav();
        echo self::renderContacts();
        self::renderFooter();
    }

    public static function renderMeetingsPage() {
        self::renderHeader("Meetings");
        echo self::renderNav();
        echo self::renderMeetings();
        self::renderFooter();
    }

    public static function renderProfilePage() {
        self::renderHeader("Profile");
        echo self::renderNav();
        echo self::renderProfile();
        self::renderFooter();
    }

    public static function renderRegisterPage() {
        self::renderHeader("Register");
        echo self::renderNav();
        echo self::renderRegister();
        self::renderFooter();
    }

    public static function renderLoginPage() {
        self::renderHeader("Login");
        echo self::renderNav();
        echo self::renderLogin();
        self::renderFooter();
    }
}