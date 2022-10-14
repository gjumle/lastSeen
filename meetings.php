<?php

include './functions/db_conn.php';

$conn = db_conn('localhost', 'lastSeenAdmin', 'lsa', 'lastSeen', TRUE);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>lastSeen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/master.css">
        <link rel='stylesheet' href='css/mode.css'>
        <link rel="stylesheet" href="css/meetings.css">
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
                    <li><a class='nav-bar-link' href="./profile.php">Profile</a></li>
                    <li><a class='nav-bar-link' href="./contacts.php">Contacts</a></li>
                    <li><a class='nav-bar-link' href="./meetings.php">Meetings</a></li>
                </ul>
            </div>
            <div class="nav-bar-right">
                <ul class='nav-bar-links'>
                    <li><a class='nav-bar-link' href="./register.php">Register</a></li>
                    <li><a class='nav-bar-link nav-bar-icon' href="#"><button id='mode'><i class="fa-solid fa-sun"></i></button></a></li>
                </ul>
            </div>
       </div>
       <div class="meetings-card">
              <div class="meetings-heading">
                <h1>Meetings</h1>
              </div>
              <div class="meetings-card-body">
                <div class="meetings-card-body-item">
                     <div class="item-heading">
                          <h1>Meeting</h1>
                     </div>
                     <div class="item-body">
                          <p>Here is your meeting info</p>
                     </div>
                </div>
                <div class="meetings-card-body-item">
                     <div class="item-heading">
                          <h1>Meeting</h1>
                     </div>
                     <div class="item-body">
                          <p>Here is your meeting info</p>
                     </div>
                </div>
                <div class="meetings-card-body-item">
                     <div class="item-heading">
                          <h1>Meeting</h1>
                     </div>
                     <div class="item-body">
                          <p>Here is your meeting info</p>
                     </div>
                </div>
            </div>
            <div class="meetings-add">
                <button id="add-meeting"><i class="fa-solid fa-plus"></i></button>
            </div>
       </div>
       <footer class='foot'>
            <div class="footer">
                <p>lastSeen &copy; 2022</p>
            </div>
        </footer>
    </body>