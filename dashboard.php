<?php

function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

if (isset($_GET['logout'])) {
    setcookie('uid', '', time() - 3600, '/');
    setcookie('name', '', time() - 3600, '/');
    setcookie('email', '', time() - 3600, '/');
    setcookie('admin', '', time() - 3600, '/');
    header("Location: ./login.php");
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta lang="en">

        <title>lastSeen | Dashboard</title>

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
                            <li class="nav-item selected" data-log-category="dashboard" data-log-page="dashboard">
                                <a href="./dashboard.php" class="selection nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item" data-log-category="dashboard" data-log-page="dashboard">
                                <a href="./contacts.php" class="selection nav-link">Contacts</a>
                            </li>
                            <li class="nav-item" data-log-category="dashboard" data-log-page="dashboard">
                                <a href="./account.php" class="selection nav-link">Profile</a>
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
                <div class="row">
                    <div id="dashboard-sidebar" class="sidebar col-lg-3 col-md-4">
                        <div class="container">
                            <div class="fixed-sidebar-container">
                                <div class="col-lg-3 col-md-4">
                                    <div id="sidebar-profile" class="card sidebar-profile">
                                        <div class="card-body text-center">
                                            <a href="./profile.php">
                                                <h2 class="text-title2 mt-sm mb-md">
                                                    <div class="progile-name"><?php echo $_COOKIE['name'] ?></div>
                                                </h2>
                                            </a>
                                            <ul class="list-stats text-center">
                                                <li>
                                                    <a href="./contacts.php" class="stat">
                                                        <div class="stat-subtext">Contacts</div>
                                                        <b class="stat-text">5</b>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="stat">
                                                        <div class="stat-subtext">Meetings</div>
                                                        <b class="stat-text">4</b>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="stat">
                                                        <div class="stat-subtext">Status</div>
                                                        <b class="stat-text">76</b>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-footer">
                                            <div class="card-section">
                                                <div class="text-label text-small mb-8px">Last seen</div>
                                                <a href="#" class="text-large hover-orange">
                                                    <strong>Patrik</strong>
                                                    *
                                                    <time class="timestamp text-medium" datetime="2023-02-24 00-15-30 UTC">Feburary 24, 2023</time>
                                                </a>
                                            </div>
                                            <div class="card-section">
                                                <a href="#" class="btn-card-link media media-middle">
                                                    <div class="media-body">Your Meeting Log</div>
                                                    <div class="media-right">
                                                        <span class="app-icon-wrapper">
                                                            <span class="app-icon icon-caret-right icon-dark"></span>
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>