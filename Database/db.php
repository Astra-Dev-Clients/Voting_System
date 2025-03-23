<!-- connect to db -->
<?php

    $conn = new mysqli("localhost", "root", "22092209", "Online_Voting");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>
