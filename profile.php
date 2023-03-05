<?php

function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

User::logout();

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta lang="en">

        <title>lastSeen | Profile</title>

        <link rel="stylesheet" type="text/css" href="css/master.css">
    </head>
    <body>
        <div class="view">
            <header id="global-header">
                <nav class="nav-bar container" role="navigation">
                    <div class="branding" title="Return to the home page">
                        <a href="./index.php" class="branding-content">
                            <img src="./svg/logo.svg" alt="">
                            <span class="str-only">lastSeen</span>
                        </a>
                    </div>
                    <div id="container-nav" class="nav-container">
                        <ul class="global-nav nav-group">
                            <li class="nav-item" data-log-category="dashboard" data-log-page="dashboard">
                                <a href="./dashboard.php" class="selection nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item" data-log-category="dashboard" data-log-page="dashboard">
                                <a href="./contacts.php" class="selection nav-link">Contacts</a>
                            </li>
                            <li class="nav-item selected" data-log-category="dashboard" data-log-page="dashboard">
                                <a href="./profile.php" class="selection nav-link">Profile</a>
                            </li>
                        </ul>
                        <ul class="user-nav nav-group">
                            <li class="nav-object-group">
                                <div class="nav-item logged-out-nav">
                                    <a href="?logout" class="btn btn-primary btn-signup" type="sumbit" name="logout">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="page container">
                <div class="profile-heading profile section">
                    <div class="avatar avatar-xl">
                        <div class="avatar-content">
                            <div class="avatar-img-wrapper">
                                <img class="avatar-img" src="./svg/avatar.svg" alt="avatar">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="spans5">
                            <h1 class="text-title1 profile-name"><?php echo $_COOKIE['name'] ?></h1>
                            <div class="location">
                                <div class="app-icon icon-location icon-xs"></div>
                                Brno, Czech Republic
                            </div>
                        </div>
                        <div class="spans10">
                            <section class="activity-summary">
                                <div class="activity-count">
                                    <h3 class="count-header">All Time Seen</h3>
                                    <div class="count-total">
                                        <div class="count text-display5">153</div>
                                        <div class="count-label">Total Minutes</div>
                                    </div>
                                </div>
                                <div class="activity-count">
                                    <h3 class="count-header">All Time Count</h3>
                                    <div class="count-total">
                                        <div class="count text-display5">45</div>
                                        <div class="count-label">Total Meetins</div>
                                    </div>
                                </div>
                                <div class="activity-count">
                                    <h3 class="count-header">Current Last Seen</h3>
                                    <div class="count-total">
                                        <div class="count text-display5">12</div>
                                        <div class="count-label">Last Seen</div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>