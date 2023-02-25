<?php
function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

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
                                <a href="./account.php" class="selection nav-link">Profile</a>
                            </li>
                        </ul>
                        <ul class="user-nav nav-group">
                            <li class="nav-object-group">
                                <div class="nav-item logged-out-nav">
                                    <a href="./subscription.php" class="btn btn-primary btn-signup">Start Trial</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
    </body>
</html>