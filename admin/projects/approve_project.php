<?php

include '../dbh.inc.php';

$project_id = $_POST['project_id'];

$sql = "UPDATE projects SET status = 'approved' WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();

header("Location: ../dashboard.php?tab=records");
?>

reject_project.php

<?php
include '../../dbh.inc.php';

$project_id = $_POST['project_id'];

$sql = "UPDATE projects SET status = 'rejected' WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();

header("Location: ../dashboard.php?tab=records");

