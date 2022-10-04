<?php

include './functions/db_conn.php';

$conn = db_conn('localhost', 'lastSeenAdmin', 'lsa', 'lastSeen', TRUE);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
    </head>
    <body>
        <script>
            console.log("<?php echo $conn; ?>");
            alert("<?php echo $conn; ?>");
        </script>
    </body>