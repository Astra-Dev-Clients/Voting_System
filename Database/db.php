<!-- connect to db -->
<?php

    $conn = new mysqli("localhost", "root", "", "Online_Voting");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>
