<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <title>SK Barangay Management System - Login</title>
</head>
<body>
    
    <div class="header">
        <h1 class ="title">SK BMS</h1>
        <p class ="subtitle">Epektibong pagdumala sa mga programa sa kabataan ug pakig-ambit sa komunidad</p>
        <img src="../sk_logo.jpg" alt="SK Ibabao Logo" class="logo">
        <div class="user-controls">
            <a href="../admin/dashboard.php" class="btn">Back</a>
        </div>
    </div>

    <?php
include '../../dbh.inc.php';

$result = $connection->query("SELECT * FROM projects WHERE status = 'pending'");

while ($row = $result->fetch_assoc()) {
    echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px;'>
        <h3>{$row['project_name']}</h3>
        <p><strong>Description:</strong> {$row['description']}</p>
        <p><strong>Submitted By:</strong> {$row['submitted_by']}</p>
        <form action='records/approve_project.php' method='POST' style='display:inline-block;'>
            <input type='hidden' name='project_id' value='{$row['id']}'>
            <button type='submit'>Approve</button>
        </form>
        <form action='records/reject_project.php' method='POST' style='display:inline-block;'>
            <input type='hidden' name='project_id' value='{$row['id']}'>
            <button type='submit'>Reject</button>
        </form>
    </div>";
}
?>

<hr>

<div class="main-container">
        <div class="dashboard-container">
        <h2>Generate Report</h2>
        <form method="POST" action="records/download_report.php">
        <label>Select Report Type:</label>
            <select name="report_type" required>
                <option value="projects">Projects</option>
                <option value="members">Members</option>
                <option value="funds">Fund Allocation</option>
            </select>
        <button type="submit">Download</button>
        </form>
    </div>
</div>

</body>
</html>