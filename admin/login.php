<?php
session_start();
require_once '../Database/db.php';

// Check if already logged in as admin
if(isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields";
    } else {
        $sql = "SELECT * FROM users WHERE email = ? AND user_role = 'admin'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['Pass'])) {
                $_SESSION['admin_id'] = $user['SN'];
                $_SESSION['admin_name'] = $user['First_Name'] . ' ' . $user['Last_Name'];
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid password";
            }
        } else {
            $error = "Admin not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Zetech University Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1C1D3C 0%, #2C3E50 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
            padding: 2rem;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header img {
            width: 80px;
            margin-bottom: 1rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.8rem;
        }
        .btn-login {
            background-color: #1C1D3C;
            border: none;
            border-radius: 8px;
            padding: 0.8rem;
            width: 100%;
            font-weight: 600;
        }
        .btn-login:hover {
            background-color: #2C3E50;
        }
        .back-link {
            color: white;
            text-decoration: none;
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>
<body>
    <a href="../index.php" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>

    <div class="login-card">
        <div class="login-header">
            <img src="../Assets/Img/logo11.png" alt="Zetech Logo">
            <h2>Admin Login</h2>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 