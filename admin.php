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

User::handleForm();

User::logout();

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta lang="en">

    <title>lastSeen | Admin</title>

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
                        <li class="nav-item" data-log-category="dashboard" data-log-page="dashboard">
                            <a href="./profile.php" class="selection nav-link">Profile</a>
                        </li>
                        <?php

                        if (isset($_COOKIE['admin']) && $_COOKIE['admin'] == 1) {
                            echo '<li class="nav-item selected" data-log-category="dashboard" data-log-page="dashboard">
                            <a href="./admin.php" class="selection nav-link">Admin</a></li>';
                        }
                        ?>
                    </ul>
                    <ul class="user-nav nav-group">
                        <li class="nav-object-group">
                            <div class="nav-item logged-out-nav">
                                <a href="?add" class="btn btn-primary btn-login" type="sumbit" name="add">Add</a>
                            </div>
                            <div class="nav-item logged-out-nav">
                                <a href="?logout" class="btn btn-primary btn-signup" type="sumbit" name="logout">Logout</a>
                            </div>

                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="page container">
            <?php echo User::renderUsers(null); ?>
        </div>
    </div>
</body>

</html>