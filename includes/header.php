<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zetech University Online Voting System</title>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="Assets/CSS/styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-light">
    <!-- Header -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center justify-content-center" href="index.php">
                <img src="Assets/Img/logo11.png" alt="" class="img-fluid me-2" style="width: 39px; height: auto;">
                <div class="d-flex flex-column">
                    Zetech University<br>
                    <small style="font-size: x-small;">Invent your future</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" 
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto ms-auto my-2 my-lg-0 gap-4 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" 
                           href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>" 
                           href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'campaigns.php' ? 'active' : ''; ?>" 
                           href="campaigns.php">Campaigns</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo in_array(basename($_SERVER['PHP_SELF']), ['vote.php', 'results.php', 'profile.php']) ? 'active' : ''; ?>" 
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Voting
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="vote.php">Vote</a></li>
                            <li><a class="dropdown-item" href="results.php">View Results</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'candidates.php' ? 'active' : ''; ?>" 
                           href="candidates.php">Candidates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'guidelines.php' ? 'active' : ''; ?>" 
                           href="guidelines.php">Guidelines</a>
                    </li>
                </ul>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <div class="d-flex align-items-center">
                        <span class="me-3">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <a href="auth/logout.php" class="btn btn-outline-danger">Logout</a>
                    </div>
                <?php else: ?>
                    <a href="auth/index.php" class="btn text-white" style="background-color: #1C1D3C;">Get Started</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</body>
</html> 