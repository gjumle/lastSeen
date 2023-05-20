<?php
function autoloadModel($className)
{
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

if (isset($_COOKIE['logged_in'])) {
    header("Location: ./dashboard.php");
}

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta lang="en">

    <title>Home</title>

    <link rel="stylesheet" type="text/css" href="css/master.css">
    <link rel="icon" type="image/x-icon" href="./svg/favicon.ico">
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
                <div id="nav-container" class="container-nav">
                    <ul class="user-nav nav-group">
                        <li class="nav-object-group">
                            <div class="nav-item logged-out-nav">
                                <a href="./login.php" class="btn btn-primary btn-login">Login</a>
                            </div>
                            <div class="nav-item logged-out-nav">
                                <a href="./register.php" class="btn btn-primary btn-signup">Join For Free</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="page container">
            <div class="row">
                <div class="col-12">
                    <div class="hero">
                        <div class="hero-content">
                            <h1 class="hero-title">lastSeen</h1>
                            <p class="hero-subtitle">A simple way to keep track of your time with others.</p>
                            <div class="hero-cta">
                                <a href="./register.php" class="btn btn-primary btn-signup">Join For Free</a>
                                <a href="./login.php" class="btn btn-primary btn-login">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>