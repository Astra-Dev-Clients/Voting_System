
<?php
// Database connection

include "../../Database/db.php";


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// fetch user from uid
$id = $_GET['uid'];

if(!isset($id)){
    header('location: ../../auth/index.php');
}




$get_user = "SELECT * FROM users where SN = $id";
$result = mysqli_query($conn,$get_user);
$user = mysqli_fetch_assoc($result);
$adm = $user['Adm_No'];




// Fetch candidates data
$sql = "SELECT * FROM candidates where Course = '".$user['Course']."' AND Year_of_Study = ".$user['Year_of_Study'];
$result = $conn->query($sql);
$cand = mysqli_fetch_assoc($result);
$cand_name = $cand['First_Name'] . " " . $cand['Last_Name'];
$cand_id = $cand['candidate_id'];





?>


