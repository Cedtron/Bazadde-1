<?php

 include 'dbcon.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are set
    if (isset($_POST["user"]) && isset($_POST["password"])) {
        $email = $_POST["user"];
        $password = $_POST["password"];
        
        // Validate email (optional)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../login.php?error=Invalid%20email%20format");
            exit;
        }
        
        // Assuming you have a database connection established in dbcon.php
       
        
        // Prepare and execute SQL statement to fetch user from database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $row['passwords'])) {
                // Set session variables
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['roles'];
                $_SESSION['user'] = $row['user_name'];
                $_SESSION['id'] = $row['id'];
                
                // Redirect to index.php
                header("Location: ../index.php");
                exit;
            } else {
                header("Location: ../login.php?error=Incorrect%20password");
                exit;
            }
        } else {
            header("Location: ../login.php?error=User%20not%20found");
            exit;
        }
    } else {
        header("Location: ../login.php?error=Email%20or%20password%20not%20provided");
        exit;
    }
} else {
    // Return JSON response for invalid request method
    header("Location: ../login.php?error=Invalid%20request%20method");
    exit;
}
?>