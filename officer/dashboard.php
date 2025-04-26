<?php
session_start();

if (!isset($_SESSION["userId"]) || $_SESSION["userRole"] != "sk_member") {
    header("Location: ../login.php?error=unauthorized");
    exit();
}

include "../dbh.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Admin Dashboard - SK Barangay Ibabao</title>
</head>
<body>
    <div class="header">
        <img src="../images/sk_logo.jpg" alt="SK Ibabao Logo" class="logo">
        <h1 class ="title">SK BMS</h1>
        <p class ="subtitle">Epektibong pagdumala sa mga programa sa kabataan ug pakig-ambit sa komunidad</p>
        <div class="user-controls">
            <span>Welcome, <?php echo $_SESSION["fullName"]; ?></span>
            <a href="../logout.php" class="btn">Logout</a>
        </div>
    </div>

    <div class="main-container">
        <div class="dashboard-container">
            <h1>Welcome Officer!</h1>
        </div>
    </div>
</body>
</html>