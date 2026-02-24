<?php
session_start();

$username = "";
$error = "";

// GET 
if (isset($_GET["logout"])) {
    $message = "You have logged out successfully!";
}

// Check cookie
if (isset($_COOKIE["remember_user"])) {
    $username = $_COOKIE["remember_user"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // VALIDATION
    if (empty($username) || empty($password)) {
        $error = "All fields are required!";
    }
    elseif (!isset($_SESSION["registered_user"])) {
        $error = "No registered user found. Please signup first.";
    }
    elseif ($username != $_SESSION["registered_user"] || $password != $_SESSION["registered_pass"]) {
        $error = "Invalid login credentials!";
    }
    else {
        // SESSION
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $username;
        // COOKIE
        setcookie("remember_user", $username, time() + 3600);
        header("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login - Job Hiring System</title>

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
    <h2>Login</h2>

    <?php 
        if (isset($message)) echo "<div style='color:green;text-align:center;'>$message</div>";
        if ($error != "") echo "<div class='error'>$error</div>"; 
    ?>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Login">
    </form>

    <p style="text-align:center;">No account yet? <a href="signup.php">Signup</a></p>
</div>

</body>
</html>