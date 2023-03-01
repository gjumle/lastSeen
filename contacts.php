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
                            <li class="nav-item" data-log-category="dashboard" data-log-page="dashboard">
                                <a href="./dashboard.php" class="selection nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item selected" data-log-category="dashboard" data-log-page="dashboard">
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
                                                        <a href="#">Leoš Gjumija</a>
                                                    </div>
                                                    <div class="feed-ui-media-body-subtitle-wrapper">
                                                        <time class="timestamp text-medium" datetime="2023-02-27 00-13-30 UTC">Feburary 24, 2023</time>
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
                                                        <h3 class="feed-body-header">Dominik Novotný</h3>
                                                        <div class="feed-ui-media">
                                                            <div class="feed-ui-nmedia-body">
                                                                <ul class="feed-media-items">
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Type
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                Friend
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Address
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                Masarykova 1, 602 00 Brno
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Date Added
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                27. Feburary 2023
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Last Seen                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                2023-02-28
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                E-mail                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                dominik@gmail.com
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
                                                        <a href="#">Leoš Gjumija</a>
                                                    </div>
                                                    <div class="feed-ui-media-body-subtitle-wrapper">
                                                        <time class="timestamp text-medium" datetime="2023-02-27 00-13-30 UTC">Feburary 24, 2023</time>
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
                                                        <h3 class="feed-body-header">Patrik Tomaško</h3>
                                                        <div class="feed-ui-media">
                                                            <div class="feed-ui-nmedia-body">
                                                                <ul class="feed-media-items">
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Type
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                Friend
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Address
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                Višnová 14, 602 00 Brno
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Date Added
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                2š. Feburary 2023
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Last Seen                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                2023-01-28
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                E-mail                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                tomasko@gmail.com
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
                                                        <a href="#">Leoš Gjumija</a>
                                                    </div>
                                                    <div class="feed-ui-media-body-subtitle-wrapper">
                                                        <time class="timestamp text-medium" datetime="2023-02-27 00-13-30 UTC">Feburary 24, 2023</time>
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
                                                        <h3 class="feed-body-header">Dominik Hanák</h3>
                                                        <div class="feed-ui-media">
                                                            <div class="feed-ui-nmedia-body">
                                                                <ul class="feed-media-items">
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Type
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                Friend
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Address
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                Dominikova 1, 602 00 Brno
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Date Added
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                22. January 2023
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Last Seen                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                2023-01-16
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                E-mail                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                dominik123@gmail.com
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
                                                        <a href="#">Leoš Gjumija</a>
                                                    </div>
                                                    <div class="feed-ui-media-body-subtitle-wrapper">
                                                        <time class="timestamp text-medium" datetime="2023-02-27 00-13-30 UTC">Feburary 24, 2023</time>
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
                                                        <h3 class="feed-body-header">Lenka Weber</h3>
                                                        <div class="feed-ui-media">
                                                            <div class="feed-ui-nmedia-body">
                                                                <ul class="feed-media-items">
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Type
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                Family
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Address
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                Aufdan 23, Bensheim, Germany
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Date Added
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                14. May 2022
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Last Seen                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                2022-12-28
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                E-mail                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                lenkaweber@email.de
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
                                                        <a href="#">Leoš Gjumija</a>
                                                    </div>
                                                    <div class="feed-ui-media-body-subtitle-wrapper">
                                                        <time class="timestamp text-medium" datetime="2023-02-27 00-13-30 UTC">Feburary 24, 2023</time>
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
                                                        <h3 class="feed-body-header">Svaťa Kreidl</h3>
                                                        <div class="feed-ui-media">
                                                            <div class="feed-ui-nmedia-body">
                                                                <ul class="feed-media-items">
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Type
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                Friend
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Address
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                Bellova 21, 602 00 Brno
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Date Added
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                18. Feburary 2020
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Last Seen                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                2023-02-15
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                E-mail                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                svatajeden@gmail.com
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
                                                        <a href="#">Leoš Gjumija</a>
                                                    </div>
                                                    <div class="feed-ui-media-body-subtitle-wrapper">
                                                        <time class="timestamp text-medium" datetime="2023-02-27 00-13-30 UTC">Feburary 24, 2023</time>
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
                                                        <h3 class="feed-body-header">Jaroslav Kaleta</h3>
                                                        <div class="feed-ui-media">
                                                            <div class="feed-ui-nmedia-body">
                                                                <ul class="feed-media-items">
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Type
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                Friend
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Address
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                Mocenská 41, 642 00 Brno
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Date Added
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                22. May 2021
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                Last Seen                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                2023-01-26
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="feed-media-item">
                                                                        <div class="package-stat">
                                                                            <span class="stat-label">
                                                                                E-mail                 
                                                                            </span>
                                                                            <div class="stat-value">
                                                                                kaleta@gmail.com
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
            </div>
        </div>
    </body>
</html>