<!-- connect to db -->
<?php

$servername = "localhost";
$username = "root";
$password = "1234218@Nanjila22";
$dbname = "voting_system";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
