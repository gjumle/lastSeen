<?php

function autoloadModel($className) {
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

if (isset($_COOKIE['logged_in'])) {
    header("Location: ./dashboard.php");
}

User::handleForm();

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta lang="en">

    <title>Home</title>

    <link rel="stylesheet" type="text/css" href="css/master.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
                                <a href="./register.php" class="btn btn-primary btn-signup">Sign Up</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="page container">
            <div class="registration-panel">
                <h1 class="mb-o">Log In</h1>
                <form id="login-form" action="" class="website" method="post" accept-charset="UTF-8">
                    <fieldset class="mt-0 mb-0">
                        <div class="form-group">
                            <input id="email" class="form-control" type="text" name="email_username" value="" placeholder="Your Email or Username" autofocus="autofocus">
                            <span id="email-error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <input id="password" class="form-control" type="password" name="password" value="" placeholder="Your Password" autofocus="autofocus">
                            <span id="password-error" class="error-message"></span>
                        </div>
                        <button id="login-button" class="btn btn-primary" type="submit" name="login">Log In</button>
                    </fieldset>
                    <div class="reset-password">
                        <b>
                            <a id="forgot-password" href="./password_recovery.php">Forgot Your Password?</a>
                        </b>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/master.js"></script>
</body>

</html>