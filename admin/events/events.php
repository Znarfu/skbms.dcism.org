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
            <a href="/admin/dashboard.php" class="btn">Back</a>
        </div>
    </div>

    <div class="main-container">
        <div class="dashboard-container">
    <h2>Create an Event</h2>
    <form method="POST" action="events/create_events.php">   
    <input type="text" name="title" placeholder="Event Title" required><br>
    <input type="text" name="location" placeholder="Location" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="number" name="required_volunteers" placeholder="No. of Volunteers" required><br>
    <button type="submit">Create Event</button>
    </form>
        </div>
    </div>
    <hr>


    <?php
    include '../../dbh.inc.php';

    $result = $connection->query("SELECT * FROM events");

    while ($row = $result->fetch_assoc()) {
        echo "<h3>{$row['title']}</h3>";
        echo "<p>Location: {$row['location']}</p>";
        echo "<p>Description: {$row['description']}</p>";
        echo "<form method='POST' action='events/signup_task.php'>
            <input type='hidden' name='event_id' value='{$row['id']}'>
            <input type='text' name='task_name' placeholder='e.g. Help Set Up' required>
            <input type='text' name='signed_up_by' placeholder='Your Name' required>
            <button type='submit'>Sign Up</button>
          </form><hr>";
    }
    ?>
    
</body>
</html>