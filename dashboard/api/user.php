<?php

include "dbcon.php";

// Escape user inputs to prevent SQL injection
$userName = mysqli_real_escape_string($conn, $_POST['userName']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$role = mysqli_real_escape_string($conn, $_POST['role']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$passwordHint = mysqli_real_escape_string($conn, $_POST['passwordHint']);

// Check if passwords match
if ($_POST['password'] !== $_POST['confirmPassword']) {
    $response = array('success' => false, 'message' => 'Passwords do not match');
    echo json_encode($response);
    exit();
}

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement to prevent SQL injection
$sql = "INSERT INTO users (user_name, email, roles, passwords, password_hint) VALUES ('$userName', '$email', '$role', '$hashedPassword', '$passwordHint')";

if (mysqli_query($conn, $sql)) {
    $response = array('success' => true, 'message' => 'User registered successfully');
    echo json_encode($response);
} else {
    $response = array('success' => false, 'message' => 'Error: ' . mysqli_error($conn));
    echo json_encode($response);
}

// Close database connection
mysqli_close($conn);

?>