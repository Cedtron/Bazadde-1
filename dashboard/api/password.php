<?php
include_once "dbcon.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password']; // Assuming the input field name is "confirm_password"
    $id = $_POST['id'];
   
    // Validate that the ID is set and is a valid integer
    if (!isset($id) || !filter_var($id, FILTER_VALIDATE_INT)) {
        // Handle the case where ID is not set or invalid
        header("Location: ../change.php?id=$id&error=Invalid user ID");
        exit;
    }
    
    // Perform validation
    if ($newPassword != $confirmPassword) {
        // Passwords do not match, redirect back to the change password page with an error message
        header("Location: ../change.php?id=$id&error=Passwords do not match");
        exit;
    }

    // Hash the new password before storing it in the database
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
    // Update the password in the database
    $updateQuery = "UPDATE users SET passwords = '$hashedPassword' WHERE id = '$id'";
    
    if (mysqli_query($conn, $updateQuery)) {
        // Password updated successfully, redirect to a success page or dashboard
        header("Location: ../login.php?success=Password updated successfully");
        exit;
    } else {
        // Error updating password, redirect back to the change password page with an error message
        header("Location: ../change.php?id=$id&error=Error updating password");
        exit;
    }
} else {
    // Redirect back to the change password page if accessed directly without POST method
    if (isset($id)) {
        header("Location: ../change.php?id=$id");
    } else {
        header("Location: ../change.php?id=$id");
    }
    exit;
}
?>