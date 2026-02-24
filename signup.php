<?php
session_start();

$username = $email = $password = $confirmPassword = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirmPassword"]);
    // VALIDATION
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $error = "All fields are required!";
    }
    elseif (strlen($username) < 4) {
        $error = "Username must be at least 4 characters!";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    }
    elseif ($password != $confirmPassword) {
        $error = "Passwords do not match!";
    }
    else {
        $_SESSION["registered_user"] = $username;
        $_SESSION["registered_email"] = $email;
        $_SESSION["registered_pass"] = $password;

        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Signup - Job Hiring System</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .form {
        background: white;
        padding: 30px;
        width: 350px;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .form h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form input[type="text"],
    .form input[type="email"],
    .form input[type="password"] {
        width: 92%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form input[type="submit"] {
        width: 50%;
        padding: 10px;
        background-color: #007ef5;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        display: block;
        margin: 20px auto 0 auto;
    }

    .form input[type="submit"]:hover {
        background-color: #013d75;
    }

    .error {
        color: red;
        text-align: center;
        margin-bottom: 10px;
    }
</style>

</head>
<body>

<div class="form">
    <h2>Signup</h2>

    <?php if ($error != "") echo "<div class='error'>$error</div>"; ?>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirmPassword" placeholder="Confirm Password">
        <input type="submit" value="Register">
    </form>

    <p style="text-align:center;">Already have an account? <a href="login.php">Login</a></p>
</div>

</body>
</html>