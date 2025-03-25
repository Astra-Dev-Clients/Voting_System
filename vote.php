<?php
session_start();
include 'Database/db.php';

// Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: auth/index.php");
//     exit();
// }

// Check if election is active
$sql = "SELECT * FROM election_settings WHERE status = 'active' AND NOW() BETWEEN start_date AND end_date";
$result = mysqli_query($conn, $sql);
$election = mysqli_fetch_assoc($result);

if (!$election) {
    $error = "No active election at the moment.";
} else {
    // Get all positions
    $positions_sql = "SELECT * FROM positions ORDER BY position_id";
    $positions_result = mysqli_query($conn, $positions_sql);

    // Check if user has already voted
    $user_id = $_SESSION['user_id'];
    $check_vote_sql = "SELECT position FROM votes WHERE user_id = ?";
    $check_stmt = mysqli_prepare($conn, $check_vote_sql);
    mysqli_stmt_bind_param($check_stmt, "i", $user_id);
    mysqli_stmt_execute($check_stmt);
    $voted_positions = mysqli_stmt_get_result($check_stmt);
    $voted_positions_array = [];
    while ($row = mysqli_fetch_assoc($voted_positions)) {
        $voted_positions_array[] = $row['position'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cast Your Vote - Zetech University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .candidate-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .candidate-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .candidate-card.selected {
            border-color: #1C1D3C;
            background-color: #f8f9fa;
        }
        .candidate-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .position-section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .submit-btn {
            background-color: #1C1D3C;
            color: white;
            padding: 10px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .submit-btn:hover {
            background-color: #2a2c5a;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="Assets/Img/logo11.png" alt="Zetech Logo" height="40">
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="dashboard/voter/index.php">Dashboard</a>
                <a class="nav-link" href="auth/logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="text-center mb-4">Cast Your Vote</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-info"><?php echo $error; ?></div>
        <?php else: ?>
            <form action="process_vote.php" method="POST" id="votingForm">
                <?php while ($position = mysqli_fetch_assoc($positions_result)): ?>
                    <div class="position-section">
                        <h3><?php echo htmlspecialchars($position['title']); ?></h3>
                        <p class="text-muted"><?php echo htmlspecialchars($position['description']); ?></p>
                        
                        <?php
                        // Get candidates for this position
                        $candidates_sql = "SELECT * FROM candidates WHERE Position = ?";
                        $candidates_stmt = mysqli_prepare($conn, $candidates_sql);
                        mysqli_stmt_bind_param($candidates_stmt, "s", $position['title']);
                        mysqli_stmt_execute($candidates_stmt);
                        $candidates_result = mysqli_stmt_get_result($candidates_stmt);
                        ?>

                        <div class="row">
                            <?php while ($candidate = mysqli_fetch_assoc($candidates_result)): ?>
                                <div class="col-md-4">
                                    <div class="candidate-card">
                                        <img src="<?php echo htmlspecialchars($candidate['Photo'] ?? 'Assets/images/default-avatar.png'); ?>" 
                                             alt="<?php echo htmlspecialchars($candidate['First_Name']); ?>" 
                                             class="candidate-photo">
                                        <h5><?php echo htmlspecialchars($candidate['First_Name'] . ' ' . $candidate['Last_Name']); ?></h5>
                                        <p class="text-muted"><?php echo htmlspecialchars($candidate['Course']); ?> - Year <?php echo $candidate['Year_of_Study']; ?></p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                                   name="vote_<?php echo $position['position_id']; ?>" 
                                                   value="<?php echo $candidate['candidate_id']; ?>"
                                                   <?php echo in_array($position['title'], $voted_positions_array) ? 'disabled' : ''; ?>>
                                            <label class="form-check-label">Select Candidate</label>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div class="text-center mt-4">
                    <button type="submit" class="submit-btn" <?php echo count($voted_positions_array) > 0 ? 'disabled' : ''; ?>>
                        Submit Votes
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add visual feedback for selected candidates
        document.querySelectorAll('.form-check-input').forEach(radio => {
            radio.addEventListener('change', function() {
                const card = this.closest('.candidate-card');
                document.querySelectorAll('.candidate-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
            });
        });
    </script>
</body>
</html> 