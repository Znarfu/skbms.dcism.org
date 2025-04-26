<?php
session_start();

if (!isset($_SESSION["userId"]) || $_SESSION["userRole"] != "admin") {
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
            <h1>Welcome Admin!</h1>
            
            <div class="nav-tabs">
                <a href="dashboard.php" class="nav-tab active">Dashboard</a>
                <a href="events/events.php" class="nav-tab">Events</a>
                <a href="projects/projects.php" class="nav-tab">Projects</a>
                <a href="records/records.php" class="nav-tab">Records</a>
                <a href="users/users.php" class="nav-tab">Users</a>
            </div>
            
            <div class="dashboard-content">
                <h2>System Overview</h2>
                
                <div class="stats-container" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                    <div class="stat-card card" style="width: 23%;">
                        <h3>Total Users</h3>
                        <p class="stat-number">
                            <?php
                            $sql = "SELECT COUNT(*) as count FROM users";
                            $result = mysqli_query($connection, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['count'];
                            ?>
                        </p>
                    </div>
                    <div class="stat-card card" style="width: 23%;">
                        <h3>Upcoming Events</h3>
                        <p class="stat-number">
                            <?php
                            $sql = "SELECT COUNT(*) as count FROM events WHERE start_datetime > NOW()";
                            $result = mysqli_query($connection, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['count'];
                            ?>
                        </p>
                    </div>
                    <div class="stat-card card" style="width: 23%;">
                        <h3>Active Projects</h3>
                        <p class="stat-number">
                            <?php
                            $sql = "SELECT COUNT(*) as count FROM projects WHERE status = 'in_progress'";
                            $result = mysqli_query($connection, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['count'];
                            ?>
                        </p>
                    </div>
                    <div class="stat-card card" style="width: 23%;">
                        <h3>Pending Accounts</h3>
                        <p class="stat-number">
                            <?php
                            $sql = "SELECT COUNT(*) as count FROM users WHERE status = 'pending'";
                            $result = mysqli_query($connection, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['count'];
                            ?>
                        </p>
                    </div>
                </div>
                
                <div class="recent-section">
                    <h3>Recent Announcements</h3>
                    <div class="announcements">
                        <?php
                        $sql = "SELECT a.*, u.full_name FROM announcements a 
                                JOIN users u ON a.posted_by = u.id 
                                ORDER BY a.post_date DESC LIMIT 5";
                        $result = mysqli_query($connection, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="announcement card">';
                                echo '<div class="card-title">' . $row['title'] . '</div>';
                                echo '<div class="card-content">' . $row['content'] . '</div>';
                                echo '<div class="announcement-date">Posted by: ' . $row['full_name'] . ' on ' . date('F j, Y', strtotime($row['post_date'])) . '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No announcements yet.</p>';
                        }
                        ?>
                    </div>
                    <a href="announcements.php" class="btn">Manage Announcements</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>