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
    setcookie('logged_in', '', time() - 3600, '/');
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
                <div class="row">
                    <div id="dashboard-sidebar" class="sidebar col-lg-3 col-md-4">
                        <div class="container">
                            <div class="fixed-sidebar-container">
                                <div class="col-lg-3 col-md-4">
                                    <div id="sidebar-profile" class="card sidebar-profile">
                                        <div class="card-body text-center">
                                            <a href="./profile.php">
                                                <div class="avatar avatar-profile avatar-lg">
                                                    <div class="avatar-content">
                                                        <div class="avatar-img-wrapper">
                                                            <div class="avatar-img">
                                                                <img src="./svg/avatar.svg" alt="avatar">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h2 class="text-title2 mt-sm mb-md">
                                                    <div class="progile-name">Leoš Gjumija</div>
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
                                                        <b class="stat-text">10</b>
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
                                    <div class="card">
                                        <div class="tab-contents">
                                            <div class="card-body">
                                                <div class="media upsell">
                                                    <div class="media-body pl-sm">
                                                        Subscribe to stay motivated with custom progress, segment and power goals. 
                                                        <a href="./subscription">Upgrade</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body text-center">
                                                <h4 class="h6 mt-0">THIS WEEK</h4>
                                                <div class="primary-stats">
                                                    <span class="actual">44 <abbr title="metrics" class="unit">min</abbr></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dashboard-feed" class="main col-lg-6 col-md-8">
                        <div class="feed-container">
                            <div class="content">
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
                                                            <a href="#">Patrik</a>
                                                        </div>
                                                        <div class="feed-ui-media-body-subtitle-wrapper">
                                                            <time class="timestamp text-medium" datetime="2023-02-24 00-15-30 UTC">Feburary 24, 2023</time>
                                                        </div>
                                                    </div>
                                                    <div class="feed-ui-media-right">
                                                        <div class="feed-ui-media-right-components">
                                                            <div class="feed-media-right-component">
                                                                <button class="package-ui-btn">
                                                                    <svg class="package-btn-svg">
                                                                        <path class="btn-svg-path" d="M16 3.39V4.8l-8.02 8.03L0 4.81V3.39l7.98 8.02L16 3.39z" fill=""></path>
                                                                    </svg>
                                                                </button>
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
                                                            <h3 class="feed-body-header">Evening Meeting</h3>
                                                            <div class="feed-ui-media">
                                                                <div class="feed-ui-nmedia-body">
                                                                    <ul class="feed-media-items">
                                                                        <li class="feed-media-item">
                                                                            <div class="package-stat">
                                                                                <span class="stat-label">
                                                                                    Duration
                                                                                </span>
                                                                                <div class="stat-value">
                                                                                    47
                                                                                    <abbr title="metrics" class="unit">min</abbr>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="feed-media-item">
                                                                            <div class="package-stat">
                                                                                <span class="stat-label">
                                                                                    Location
                                                                                </span>
                                                                                <div class="stat-value">
                                                                                    Caffe UM
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="feed-media-item">
                                                                            <div class="package-stat">
                                                                                <span class="stat-label">
                                                                                    Start Time
                                                                                </span>
                                                                                <div class="stat-value">
                                                                                    15:00
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
                            </div>
                        </div>
                    </div>
                    <div id="right-sidebar" class="sidebar col-md-3">
                        <div class="container fixed-sidebar-top">
                            <div class="fixed-sidebar-container">
                                <div class="col-md-3">
                                    <div id="your-chalenges" class="section">
                                        <div class="media">
                                            <div class="media-object">
                                                <img alt="Challenges Icon" class="media-img" src="https://d3nn82uaxijpm6.cloudfront.net/assets/application/dashboard/sidebar-badge-challenges-9908f45d44160c600a4f9d788795b180a74001daae32461705f5f57d90a7c651.png">
                                            </div>
                                            <div class="media-body">
                                                <h3 class="text-subhead media-title">Challenges</h3>
                                                <p class="media-text">
                                                    Join a Challenge to stay on top of your game, earn new achievements and see how you stack up.
                                                </p>
                                                <a href="#" class="btn btn-link btn-sm">View All Challenges</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="your-clubs" class="section">
                                        <div class="media">
                                            <div class="media-object">
                                                <img alt="Challenges Icon" class="media-img" src="https://d3nn82uaxijpm6.cloudfront.net/assets/application/dashboard/sidebar-badge-clubs-dda5c075f23e3f2ced7d0e4b2afb87df988978962b6de33c7a232be53b6a75ca.png">
                                            </div>
                                            <div class="media-body">
                                                <h3 class="text-subhead media-title">Clubs</h3>
                                                <p class="media-text">
                                                    Why do it alone? Get more out of your Strava experience by joining or creating a Club. 
                                                </p>
                                                <a href="#" class="btn btn-link btn-sm">View All Clubs</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="your-privacy" class="section">
                                        <div class="media">
                                            <div class="media-object">
                                                <img alt="Challenges Icon" class="media-img" src="https://d3nn82uaxijpm6.cloudfront.net/assets/application/dashboard/sidebar-badge-prompt-privacy-0fc1803e5bfe7def07ad5be716aa653371be602b5fbda57a49c7dc894a9c07d2.png">
                                            </div>
                                            <div class="media-body">
                                                <h3 class="text-subhead media-title">Privacy</h3>
                                                <p class="media-text">
                                                    You can hide the location of your home, office or other private places in your activities. 
                                                </p>
                                                <a href="#" class="btn btn-link btn-sm">Review Your Privacy Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="suggested-contacts" class="section">
                                        <h3 class="text-callout section-title">Suggested Contacts</h3>
                                        <ul class="list-media">
                                            <li>
                                                <div class="media">
                                                    <div class="media-object">
                                                        <div class="feed-ui-icon-container">
                                                            <a href="#" class="ui-avatar">
                                                                <div class="ui-img-wrapper">
                                                                    <img class="avatar-img" src="./svg/avatar.svg" alt="avatar">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <a href="#" class="media-title contact-name">Dominik</a>
                                                        <div class="location text-small">Ceska, Brno, Czech Republic</div>
                                                        <div class="action">
                                                            <a href="#" class="btn btn-link btn-sm">Contact detail</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="section sidebar-footer">
                                        <ul class="mt-md mb-sm">
                                            <li><a href="#">Support</a></li>
                                            <li><a href="#">Subscription</a></li>
                                            <li><a href="#">Student Discount</a></li>
                                            <li><a href="#">Terms of Service</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                        </ul>
                                    </div>
                                    <div class="copyright mt-md md-md">© 2023 lastSeen</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>