<?php

include './functions/db_conn.php';

$conn = db_conn('localhost', 'lastSeenAdmin', 'lsa', 'lastSeen', TRUE);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location: login.php');
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>lastSeen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/master.css">
        <link rel='stylesheet' href='css/mode.css'>
        <link rel='stylesheet' href='css/register.css'>
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <!-- FONT AWESOM -->
        <script src="https://kit.fontawesome.com/b848197ec1.js" crossorigin="anonymous"></script>
    </head>
    <body>
       <div class="nav-bar">
            <div class="nav-bar">
                <ul class='nav-bar-links'>
                    <li><a class='nav-bar-link' href="./index.php">Home</a></li>
                    <li><a class='nav-bar-link' href="./profile.php">Profile</a></li>
                    <li><a class='nav-bar-link' href="./contacts.php">Contacts</a></li>
                    <li><a class='nav-bar-link' href="./meetings.php">Meetings</a></li>
                </ul>
            </div>
            <div class="nav-bar-right">
                <ul class='nav-bar-links'>
                    <li><a class='nav-bar-link' href="./register.php">Register</a></li>
                    <li><a class='nav-bar-link' href="#" id='mode'>Dark Mode</i></a></li>
                </ul>
            </div>
       </div>
       <div class="register-card">
            <div class="reg-heading">
                <h1>Register</h1>
            </div>
            <form action="./register.php" method="POST" class='register'>
                
                <div class="register-field">
                    <div class="label">
                        <label for="username">Username</label>
                    </div>
                    <div class="input">
                        <input type="text" name="username" id="username" placeholder="Username">
                    </div>
                </div>
                <div class="register-field">
                    <div class="lable">
                        <label for="password">Password</label>
                    </div>
                    <div class="input">
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>
                </div>
                <div class="register-field">
                    <div class="lable">
                        <label for="password2">Confirm password</label>
                    </div>
                    <div class="input">
                        <input type="password" name="password2" id="password2" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="register-field">
                    <input type="submit" value="Register" href='./profile.php'>
                </div>
            </form>
       </div>
       <script src='./js/mode.js'></script>
       <footer class='foot'>
            <div class="footer">
                <p>lastSeen &copy; 2022</p>
            </div>
        </footer>
    </body>