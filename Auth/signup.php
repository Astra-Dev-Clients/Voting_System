<?php

include '../Database/db.php';

if (isset($_POST['submit'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $admNo = $_POST['adm_no'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT); // Hash the password for security

    $sql = "INSERT INTO users (First_Name, Last_Name, Adm_No, Email, Pass) VALUES ('$firstName', '$lastName', '$admNo', '$email', '$pass')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('User Registered Successfully!')</script>";
    } else {
        echo "<script>alert('There was an error. Kindly try again.')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Feedback Sign-Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url("../assets/img/back2.jpg");
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
            max-width: 400px;
            margin: auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Citizen Feedback Sign-Up</h1>
        <form action="signup.php" method="POST">
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="first_name" required>

            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="last_name" required>

            <label for="adm-no">Admission Number:</label>
            <input type="text" id="adm-no" name="adm_no" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Create Password:</label>
            <input type="password" id="password" name="pass" required>

            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm" required>

            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
