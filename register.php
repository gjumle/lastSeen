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

        <title>Home</title>

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
                    <form id="register-form" action="/session" class="website" method="post" accept-charset="UTF-8">
                        <fieldset class="mt-0 mb-0">
                            <div class="form-group">
                                <input id="name" class="form-control" type="text" name="name" value="" placeholder="Your Name" autofocus="autofocus">
                            </div>
                            <div class="form-group">
                                <input id="email" class="form-control" type="text" name="email" value="" placeholder="Your Email" autofocus="autofocus">
                            </div>
                            <div class="form-group">
                            <input id="password" class="form-control" type="password" name="password" value="" placeholder="Your Password" autofocus="autofocus">
                            </div>
                            <button id="register-button" class="btn btn-primary" type="submit">Sign Up</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>