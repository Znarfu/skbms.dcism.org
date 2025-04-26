<?php

if (!isset($_POST["login-button"])) {
    header("Location: login.php");
    exit();
}

$email = $_POST["email"];
$password = $_POST["password"];

// Basic validation
if (empty($email) || empty($password)) {
    header("Location: login.php?error=emptyfields");
    exit();
}

include "dbh.inc.php";

$sql = "SELECT * FROM users WHERE email=?";
$stmt = mysqli_stmt_init($connection);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: login.php?error=sqlerror");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $email);

if (!mysqli_stmt_execute($stmt)) {
    header("Location: login.php?error=sqlerror");
    exit();
}

$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    // Check if user account is active
    if ($row["status"] != "active") {
        header("Location: login.php?error=inactiveaccount");
        exit();
    }
    
    // Verify password
    $passwordCheck = password_verify($password, $row['password']);
    
    if ($passwordCheck) {
        // Start a session
        session_start();
        $_SESSION["userId"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["userEmail"] = $row["email"];
        $_SESSION["userRole"] = $row["role"];
        $_SESSION["fullName"] = $row["full_name"];
        
        // Redirect based on user role
        if ($row["role"] == "admin") {
            header("Location: admin/dashboard.php");
        } else if ($row["role"] == "sk_member") {
            header("Location: officer/dashboard.php");
        } else {
            header("Location: resident/dashboard.php");
        }
        exit();
    } else {
        header("Location: login.php?error=wrongcredentials");
        exit();
    }
} else {
    header("Location: login.php?error=wrongcredentials");
    exit();
}