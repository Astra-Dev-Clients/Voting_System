
<!-- CREATE TABLE `candidates` (
  `candidate_id` int NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Position` varchar(100) NOT NULL,
  `Course` varchar(100) NOT NULL,
  `Year_of_Study` int NOT NULL,
  `Manifesto` text,
  `Photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','inactive','disqualified') DEFAULT 'active'
); -->


<!-- CREATE TABLE `positions` (
  `position_id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `max_winners` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','inactive') DEFAULT 'active'
)  -->


<!-- CREATE TABLE `users` (
  `SN` int NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Adm_No` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Course` varchar(100) NOT NULL,
  `Year_of_Study` int NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `user_role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive','suspended') DEFAULT 'active'
)  -->

<!-- 
CREATE TABLE `votes` (
  `vote_id` int NOT NULL,
  `user_id` int NOT NULL,
  `candidate_id` int NOT NULL,
  `position` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
)  -->
<?php
// Database connection
$conn = new mysqli("localhost", "root", "22092209", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch positions and candidates
$positionsQuery = "SELECT * FROM positions WHERE status = 'active'";
$positionsResult = $conn->query($positionsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-section {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Vote for Your Candidates</h1>
    <form action="submit_vote.php" method="POST">
        <?php while ($position = $positionsResult->fetch_assoc()): ?>
            <div class="form-section">
                <h3><?php echo htmlspecialchars($position['title']); ?></h3>
                <?php
                $candidatesQuery = "SELECT * FROM candidates WHERE Position = '" . $conn->real_escape_string($position['title']) . "' AND status = 'active'";
                $candidatesResult = $conn->query($candidatesQuery);
                ?>
                <?php while ($candidate = $candidatesResult->fetch_assoc()): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="vote[<?php echo $position['position_id']; ?>]" 
                               value="<?php echo $candidate['candidate_id']; ?>" id="candidate-<?php echo $candidate['candidate_id']; ?>" required>
                        <label class="form-check-label" for="candidate-<?php echo $candidate['candidate_id']; ?>">
                            <?php echo htmlspecialchars($candidate['First_Name'] . " " . $candidate['Last_Name']); ?>
                        </label>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endwhile; ?>
        <button type="submit" class="btn btn-primary">Submit Vote</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
