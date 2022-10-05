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
            alert("<?php echo $conn; ?>");
        </script>
        <link rel="stylesheet" href="css/master.css">
        <!-- FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
       <div class="nav-bar">
              <ul class='nav-bar-links'>
                <li><a class='nav-bar-link' href="profile.php">Profile</a></li>
                <li><a class='nav-bar-link' href="contacs.php">Contacts</a></li>
                <li><a class='nav-bar-link' href="meetings.php">Meetings</a></li>
                <li><a class='nav-bar-link' href="register.php">Register</a></li>
              </ul>
       </div>
    </body>