<?php

function autoloadModel($className)
{
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

if (!isset($_COOKIE['logged_in'])) {
    header("Location: ./login.php");
}

if (isset($_GET['delete'])) {
    $meeting = new Meeting();
    $meeting->setMid($_GET['delete']);
    $meeting->deleteFromDB();
    header("Location: ./dashboard.php");
}

User::logout();

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
                                                <div class="progile-name"><?php echo $_COOKIE['f_name'] . " " . $_COOKIE['l_name'] ?></div>
                                            </h2>
                                        </a>
                                        <ul class="list-stats text-center">
                                            <li>
                                                <a href="./contacts.php" class="stat">
                                                    <div class="stat-subtext">Contacts</div>
                                                    <b class="stat-text"><?php echo User::getContactsCount() ?></b>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="stat">
                                                    <div class="stat-subtext">Meetings</div>
                                                    <b class="stat-text"><?php echo Meeting::getMeetingsCount() ?></b>
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
                                                <strong><?php echo Contact::getLastSeenContactName($_COOKIE['uid']) ?></strong>
                                                *
                                                <time class="timestamp text-medium" datetime="2023-02-24 00-15-30 UTC"><?php echo Contact::getLastSeenContactTime($_COOKIE['uid']) ?></time>
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
                                                <span class="actual"><?php echo Meeting::getAllDurationForLastWeek() ?><abbr title="metrics" class="unit"> min</abbr></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="card-section">
                                            <a href="./profile.php" class="btn-card-link media media-middle">
                                                <div class="media-body">See your stats</div>
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
                <div id="dashboard-feed" class="main col-lg-6 col-md-8">
                    <div class="feed-container">
                        <?php echo Meeting::renderMeetings(); ?>
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
                                                Why do it alone? Get more out of your LastSeen experience by joining or creating a Club.
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
                                                    <a href="#" class="media-title contact-name"><?php echo Contact::getLeastSeenContactName($_COOKIE['uid']) ?></a>
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