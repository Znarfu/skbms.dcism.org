<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>SK Barangay Management System - Login</title>
</head>
<body>
    
    <div class="header">
        <h1 class ="title">SK BMS</h1>
        <p class ="subtitle">Epektibong pagdumala sa mga programa sa kabataan ug pakig-ambit sa komunidad</p>
        <img src="images/sk_logo.jpg" alt="SK Ibabao Logo" class="logo">
        <div class="user-controls">
            <a href="index.php" class="btn">Register</a>
        </div>
    </div>

    <div class="main-container">
        <div class="form-container">
            <form action="login.inc.php" method="post">
                <h1>Log in</h1>
                
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email address">
                
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password">
                
                <button type="submit" id="login-button" name="login-button" class="btn-primary">Login</button>
                
                <p class="auth-link">Don't have an account? <a href="index.php">Register here</a></p>
                
                <?php 
                if (isset($_GET["error"])) {   
                    $error = $_GET["error"];
                    if ($error === "wrongcredentials") { 
                        ?>
                        <p class="error-message">Incorrect email or password.</p>
                        <?php
                    } else if ($error === "sqlerror") { 
                        ?>  
                        <p class="error-message">Database error. Please try again later.</p>
                        <?php
                    }
                }
                ?>
            </form>
        </div>
    </div>
</body>
</html>