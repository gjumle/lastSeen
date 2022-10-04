<?php

include './functions/db_conn.php';

$conn = db_conn('localhost', 'root', '', 'test', TRUE);

?>

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