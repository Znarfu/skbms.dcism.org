<?php
include '../../dbh.inc.php';

$title = $_POST['title'];
$location = $_POST['location'];
$description = $_POST['description'];
$required_volunteers = $_POST['required_volunteers'];

$sql = "INSERT INTO events (title, location, description, required_volunteers)
        VALUES ('$title', '$location', '$description', '$required_volunteers')";
$connection->query($sql);

header("Location: ../dashboard.php?tab=events");
?>

