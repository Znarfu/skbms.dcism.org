<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="main.js"></script>
    <title>SK Barangay Management System</title>
</head>
<body>
    <div class="header">
        <img src="images/sk_logo.jpg" alt="SK Ibabao Logo" class="logo">
        <h1 class ="title">SK BMS</h1>
        <p class ="subtitle">Epektibong pagdumala sa mga programa sa kabataan ug pakig-ambit sa komunidad</p>
        <div class="user-controls">
            <a href="login.php" class="btn">Login</a>
        </div>
    </div>

    <div class="main-container">
        <div class="form-container">
            <form action="register.inc.php" method="post">
                <h1>Registration</h1>
                
                <label for="first-name">First Name</label>
                <input type="text" name="first-name" id="first-name" placeholder="Enter your first name">
                
                <label for="last-name">Last Name</label>
                <input type="text" name="last-name" id="last-name" placeholder="Enter your last name">
                
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email address">
                <span class="error-message" id="email-error-message"></span>
                
                <label for="age">Age</label>
                <input type="number" name="age" id="age" placeholder="Enter your age">
                <span class="error-message" id="age-error-message"></span>
                
                <label for="user-type">User Type</label>
                <select name="user-type" id="user-type">
                    <option value="resident">Barangay Youth Resident</option>
                    <option value="sk-member">SK Member</option>
                    <option value="admin">SK Chairperson/Administrator</option>
                </select>
                
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                
                <label for="repeat-password">Confirm Password</label>
                <input type="password" name="repeat-password" id="repeat-password">
                <span class="error-message" id="password-error-message"></span>
                
                <div style="display: flex; justify-content: space-between;">
                    <button type="button" id="clear-button" class="btn-cancel">Clear</button>
                    <button type="submit" id="submit-button" name="submit-button" class="btn-primary">Register</button>
                </div>
                
                <p class="auth-link">Already have an account? <a href="login.php">Login here</a></p>
                
                <?php 
                if (isset($_GET["error"])) {   
                    $error = $_GET["error"];
                    if ($error === "sqlprepare") { 
                        ?>
                        <p class="error-message">Error in preparing sql statement.</p>
                        <?php
                    } else if ($error === "sqlexecute") { 
                        ?>  
                        <p class="error-message">Error in executing sql statement.</p>
                        <?php
                    } else if ($error === "emailinuse") {
                        ?>
                        <p class="error-message">That email is already in use. Please select another email.</p>
                        <?php
                    }
                }

                if (isset($_GET["registration"])) {     
                    $registration = $_GET["registration"];
                    if ($registration === "success") { 
                        ?>
                        <p class="success-message">Registration Success! You can now <a href="login.php">login</a>.</p>
                        <?php
                    }
                }
                ?>
            </form>
        </div>
    </div>
</body>
</html>