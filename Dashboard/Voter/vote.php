<?php
// Database connection
include "../../Database/db.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user from uid
$id = $_GET['uid'];

if (!isset($id)) {
    header('location: ../../auth/index.php');
    exit;
}

// Fetch user details
$get_user = "SELECT * FROM users WHERE SN = $id";
$result = mysqli_query($conn, $get_user);
$user = mysqli_fetch_assoc($result);
$adm = $user['Adm_No'];
$course = $user['Course'];

// Fetch candidates for the course
$get_candidates = "SELECT * FROM candidates WHERE Course = '$course'";
$candidates = mysqli_query($conn, $get_candidates);

if (mysqli_num_rows($candidates) > 0) {
    while ($row = mysqli_fetch_assoc($candidates)) {
        $candidate[] = $row;
    }
} else {
    $candidate = [];
}

// Check if user has already voted
$check_vote = "SELECT * FROM votes WHERE user_adm = '$adm'";
$vote_result = mysqli_query($conn, $check_vote);
$has_voted = mysqli_num_rows($vote_result) > 0;

// Handle form submission
if (isset($_POST['vote']) && !$has_voted) {
    $cand_adm = $_POST['cand_adm'];

    // Check candidate's position
    $get_position = "SELECT Position FROM candidates WHERE Adm_No = '$cand_adm'";
    $pos_result = mysqli_query($conn, $get_position);
    $position = mysqli_fetch_assoc($pos_result)['Position'];

    // Double-check: Has the user already voted for this position?
    $check_position_vote = "SELECT * FROM votes WHERE user_adm = '$adm' AND position = '$position'";
    $pos_vote_result = mysqli_query($conn, $check_position_vote);

    if (mysqli_num_rows($pos_vote_result) > 0) {
        echo "<script>alert('You have already voted for this position.'); window.location.href='vote.php?uid=$id';</script>";
    } else {
        // Insert vote
        $insert_vote = "INSERT INTO votes (Course, user_adm, Cand_adm, position) 
                        VALUES ('$course', '$adm', '$cand_adm', '$position')";

        if (mysqli_query($conn, $insert_vote)) {
            echo "<script>alert('Vote submitted successfully!');</script>";
        } else {
            echo "<script>alert('Error submitting vote: " . mysqli_error($conn) . "');</script>";
        }
    }
}

?>

<?php include "../../includes/header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="text-center">Vote for Your Candidate</h2>

    <?php if ($has_voted) { ?>
        <p class="alert alert-danger text-center">You have already voted. You cannot vote again.</p>
    <?php } elseif (!empty($candidate)) { ?>
        <form method="POST" action="">
            <div class="list-group">
                <?php foreach ($candidate as $cand) { ?>
                    <label class="list-group-item">
                        <input type="radio" name="cand_adm" value="<?= $cand['Adm_No'] ?>" required>
                        <?= htmlspecialchars($cand['First_Name']) ?> <?= htmlspecialchars($cand['Last_Name']) ?> - <?= htmlspecialchars($cand['Position']) ?>
                    </label>
                <?php } ?>
            </div>
            <button type="submit" name="vote" class="btn btn-primary mt-3">Submit Vote</button>
        </form>
    <?php } else { ?>
        <p class="alert alert-warning text-center">No candidates available for your course.</p>
    <?php } ?>
</body>
</html>

<?php include "../../includes/footer.php"; ?>
