<?php

include '../Database/db.php';




$error = '';
$success = '';
if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $adm_no = $_POST['adm_no'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $pass = $_POST['pass'];
    $confirm = $_POST['confirm'];

    if ($pass != $confirm) {
        $error = 'Passwords do not match';
    } else {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (First_Name, Last_Name, Adm_No, Email, Course, Year_of_Study, Pass) VALUES ('$first_name', '$last_name', '$adm_no', '$email', '$course', '$year', '$pass')";
        if (mysqli_query($conn, $sql)) {
            $success = 'Registration successful. You can now login';
        } else {
            $error = 'An error occurred. Please try again';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zetech University - Voter Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url("../Assets/images/zu.jpeg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .container {
            margin-top: 130px;
            max-width: 400px;
            margin: auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            margin-top: 210px;
            color: #1C1D3C;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #1C1D3C;
            font-weight: bold;
        }

        input {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #1C1D3C;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2a2c5a;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #1C1D3C;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
        <?php if (!empty($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <?php if (!empty($success)) { echo "<p style='color: green;'>$success</p>"; } ?>
        <form action="signup.php" method="POST">
<body>
    <div class="container">
        <h1>Voter Registration</h1>
        <form action="signup.php" method="POST">
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="first_name" required>

            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="last_name" required>

            <label for="adm-no">Student ID Number:</label>
            <input type="text" id="adm-no" name="adm_no" required>

            <label for="email">University Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="course">Course:</label>
            <input type="text" id="course" name="course" required>

            <label for="year">Year of Study:</label>
            <input type="number" id="year" name="year" min="1" max="4" required>

            <label for="password">Create Password:</label>
            <input type="password" id="password" name="pass" required>

            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm" required>

            <button type="submit" name="submit">Register as Voter</button>
        </form>
        <div class="login-link">
            Already registered? <a href="index.php">Login here</a>
        </div>
    </div>
</body>
</html>
