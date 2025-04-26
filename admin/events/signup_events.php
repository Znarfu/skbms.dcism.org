<?php
include '../../dbh.inc.php';

$event_id = $_POST['event_id'];
$task_name = $_POST['task_name'];
$signed_up_by = $_POST['signed_up_by'];

$sql = "INSERT INTO event_tasks (event_id, task_name, signed_up_by)
        VALUES ('$event_id', '$task_name', '$signed_up_by')";
$connection->query($sql);

header("Location: ../dashboard.php?tab=events");
?>
