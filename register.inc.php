<?php

if (!isset($_POST["submit-button"])) {
    header("Location: index.php?error=nosubmit");
    exit;
}

$firstName = trim($_POST["first-name"]); 
$lastName = trim($_POST["last-name"]);
$email = trim($_POST["email"]);
$age = $_POST["age"];
$password = $_POST["password"];
$repeatPassword = $_POST["repeat-password"];
$userType = $_POST["user-type"];

if (empty($firstName) || empty($lastName) || empty($email) || empty($age) || empty($password) || empty($repeatPassword)) {
    header("Location: index.php?error=emptyfields");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?error=invalidemail");
    exit();
}

if ($password !== $repeatPassword) {
    header("Location: index.php?error=passwordmismatch");
    exit();
}

if ($age < 15 || $age > 30) {
    header("Location: index.php?error=invalidage");
    exit();
}

$fullName = $firstName . " " . $lastName;
// username from email add
$username = strtolower(explode('@', $email)[0]);
$contactNumber = "";
$address = "";
// convert user to role
$role = ($userType === "admin") ? "admin" : (($userType === "sk-member") ? "sk_member" : "resident");
// Set status to pending by default
$status = "pending";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

include "dbh.inc.php"; 

// Check if email already exists
$sql = "SELECT * FROM users WHERE email=?";
$stmt = mysqli_stmt_init($connection);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: index.php?error=sqlprepare");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $email);

if (!mysqli_stmt_execute($stmt)) {
    header("Location: index.php?error=sqlexecute");
    exit();
}

$results = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($results);

if ($row) {
    header("Location: index.php?error=emailinuse");
    exit();
}

// Check if username already exists
$sql = "SELECT * FROM users WHERE username=?";
$stmt = mysqli_stmt_init($connection);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: index.php?error=sqlprepare");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $username);

if (!mysqli_stmt_execute($stmt)) {
    header("Location: index.php?error=sqlexecute");
    exit();
}

$results = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($results);

if ($row) {
    // If username exists, add a random number to make it unique
    $username = $username . rand(100, 999);
}

// Insert new user
$sql = "INSERT INTO users (username, email, password, full_name, contact_number, address, role, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: index.php?error=sqlprepare");
    exit();
}

mysqli_stmt_bind_param($stmt, "ssssssss", $username, $email, $hashedPassword, $fullName, $contactNumber, $address, $role, $status);

if (!mysqli_stmt_execute($stmt)) {
    header("Location: index.php?error=sqlexecute");
    exit();
}

header("Location: index.php?registration=success");
exit();
?>