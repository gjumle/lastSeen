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

User::handleForm();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="./svg/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta dir="ltr">
    <meta name="author" content="gjumle">
    <meta name="description" content="lastSeen registration page">

    <title>Register</title>

    <link rel="stylesheet" type="text/css" href="css/master.css">
    <link rel="icon" type="image/x-icon" href="./svg/favicon.ico">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <scrtipt src="js/master.js"></scrtipt>
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
                                <a href="./login.php" class="btn btn-primary btn-signup">Log In</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="page container">
            <div class="registration-panel">
                <h1 class="mb-o">Sign Up</h1>
                <form id="register-form" action="" class="website" method="post" accept-charset="UTF-8">
                    <fieldset class="mt-0 mb-0">
                        <div class="form-group">
                            <input id="username" class="form-control" type="text" name="username" value="" placeholder="Your Username" autofocus="autofocus" required>
                            <span id="username-error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <input id="first-name" class="form-control" type="text" name="first_name" value="" placeholder="Your First Name" autofocus="autofocus" required>
                            <span id="firs-name-error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <input id="last-name" class="form-control" type="text" name="last_name" value="" placeholder="Your Last Name" autofocus="autofocus" required>
                            <span id="last-name-error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <input id="email" class="form-control" type="text" name="email" value="" placeholder="Your E-mail" autofocus="autofocus" required>
                            <span id="email-error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <input id="password" class="form-control" type="password" name="password" value="" placeholder="Your Password" autofocus="autofocus" required>
                            <span id="email-error" class="error-message"></span>
                        </div>
                        <button id="register-button" class="btn btn-primary" type="submit" name="register">Sign Up</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <script src="js/master.js"></script>
</body>

</html>