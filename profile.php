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
        <script>
            console.log("<?php echo $conn; ?>");
        </script>
        <link rel="stylesheet" href="css/master.css">
        <link rel='stylesheet' href='css/mode.css'>
        <link rel='stylesheet' href='css/profile.css'>
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
                    <li><a class='nav-bar-link' href="#" id='mode'>Dark Mode</i></a></li>
                </ul>
            </div>
       </div>
       <div class="profile-card">
             <div class="profile-heading">
                    <h1>Profile</h1>
             </div>
             <div class="profile-info">
                    <div class="profile-item">
                        <div class="info-head">
                            <h2>First Name</h2>
                        </div>
                        <div class="info-body">
                            <p>John</p>
                        </div>
                    </div>
                    <div class="profile-item">
                        <div class="info-head">
                            <h2>Last Name</h2>
                        </div>
                        <div class="info-body">
                            <p>Doe</p>
                        </div>
                    </div>
                    <div class="profile-item">
                        <div class="info-head">
                            <h2>Email</h2>
                        </div>
                        <div class="info-body">
                            <p>addres@domain.xz</p>
                        </div>
                    </div>
                    <div class="profile-item">
                        <div class="info-head">
                            <h2>Phone</h2>
                        </div>
                        <div class="info-body">
                            <p>1234567890</p>
                        </div>
                    </div>
             </div>
             <div class="profile-add">
                <button id="add-profile"><i class="fa-solid fa-plus"></i></button>
            </div>
       </div>
       <script src='./js/mode.js'></script>
        <footer class='foot'>
            <div class="footer">
                <p>lastSeen &copy; 2022</p>
            </div>
        </footer>
    </body>