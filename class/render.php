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

    public static function renderMeetings() {
        return
            "<div class='container'>
                <div class='meetings'>
                    <h1>Meetings</h1>
                </div>
            </div>";
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
        echo ContactsManager::renderContacts();
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
        echo UserManager::renderProfile();
        self::renderFooter();
    }

    public static function renderRegisterPage() {
        self::renderHeader("Register");
        echo self::renderNav();
        echo User::renderRegister();
        self::renderFooter();
    }

    public static function renderLoginPage() {
        self::renderHeader("Login");
        echo self::renderNav();
        echo User::renderLogin();
        self::renderFooter();
    }
}