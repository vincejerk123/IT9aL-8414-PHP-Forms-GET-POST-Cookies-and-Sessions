<?php
session_start();

if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: login.php?logout=1");
    exit();
}

$applyMessage = "";
if (isset($_GET["apply"])) {
    $applyMessage = "You applied for: " . htmlspecialchars($_GET["apply"]);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard - Job Hiring System</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f9;
        margin: 0;
        padding: 40px;
    }

    .container {
        max-width: 900px;
        margin: auto;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .logout {
        text-align: right;
        margin-bottom: 20px;
    }

    .logout a {
        text-decoration: none;
        color: white;
        background-color: #007ef5;
        padding: 8px 15px;
        border-radius: 5px;
    }

    .logout a:hover {
        background-color: #013d75;
    }

    .job-card {
        background: white;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .job-card h3 {
        margin-top: 0;
    }

    .apply-btn {
        display: inline-block;
        text-decoration: none;
        background-color: #007ef5;
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
    }

    .apply-btn:hover {
        background-color: #013d75;
    }

    .message {
        color: green;
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }
</style>

</head>
<body>

<div class="container">

    <div class="header">
        <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
        <p>Job Posting / Hiring Management Dashboard</p>
    </div>

    <div class="logout">
        <a href="dashboard.php?logout=1">Logout</a>
    </div>

    <?php if ($applyMessage != "") echo "<div class='message'>$applyMessage</div>"; ?>
    <div class="job-card">
        <h3>Web Developer</h3>
        <p><strong>Company:</strong> Tech Solutions Inc.</p>
        <p><strong>Location:</strong> Remote</p>
        <p>We are looking for a PHP Web Developer to manage job posting systems.</p>
        <a class="apply-btn" href="dashboard.php?apply=Web Developer">Apply</a>
    </div>
    <div class="job-card">
        <h3>HR Assistant</h3>
        <p><strong>Company:</strong> Bright Future Corp.</p>
        <p><strong>Location:</strong> Manila</p>
        <p>Assist in recruitment and applicant management.</p>
        <a class="apply-btn" href="dashboard.php?apply=HR Assistant">Apply</a>
    </div>
    <div class="job-card">
        <h3>System Administrator</h3>
        <p><strong>Company:</strong> Global IT Services</p>
        <p><strong>Location:</strong> Quezon City</p>
        <p>Maintain company servers and hiring database systems.</p>
        <a class="apply-btn" href="dashboard.php?apply=System Administrator">Apply</a>
    </div>

</div>

</body>
</html>