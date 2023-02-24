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
                        <a href="/" class="branding-content">
                            <span class="str-only">lastSeen</span>
                        </a>
                    </div>
                    <div id="nav-container" class="container-nav">
                        <ul class="global-nav nav-group">
                            <li class="nav-item drop-down-menu accessible-nav-dropwdown selected enable" data-log-category="dashboard" data-log-page="dashboard">
                                <a href="./dashboard.php" class="selection nav-link accessible-link">Dashboard</a>
                                <button class="selection nav-link accessible-nav-arrow" title="Expand dashboard menu">
                                    <span class="app-icon-wrapper">
                                        <span class="app-icon icon-caret-down icon-dark"></span>
                                    </span>
                                </button>
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