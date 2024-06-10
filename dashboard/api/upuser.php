<?php
include "dbcon.php";

// Simulated user update functionality
$userId = $_POST['userId'];
$userName = isset($_POST['username']) && trim($_POST['username']) !== '' ? $_POST['username'] : null;
$email = isset($_POST['email']) && trim($_POST['email']) !== '' ? $_POST['email'] : null;
$role = isset($_POST['role']) && trim($_POST['role']) !== '' ? $_POST['role'] : null;
$newPassword = isset($_POST['newPassword']) && trim($_POST['newPassword']) !== '' ? $_POST['newPassword'] : null;
$passwordHint = isset($_POST['passwordHint']) && trim($_POST['passwordHint']) !== '' ? $_POST['passwordHint'] : null;

// Check if passwords match (only if new password is provided)
if ($newPassword !== null && $_POST['newPassword'] !== $_POST['confirmNewPassword']) {
   $response = array('success' => false, 'message' => 'Passwords do not match');
   echo json_encode($response);
   exit();
}

// Build dynamic SQL query
$sql = "UPDATE users SET";
$params = array();

// Add SET clauses for non-empty fields
if ($userName !== null) {
   $sql .= " user_name = ?,";
   $params[] = &$userName;
}
if ($email !== null) {
   $sql .= " email = ?,";
   $params[] = &$email;
}
if ($role !== null) {
   $sql .= " roles = ?,";
   $params[] = &$role;
}
if ($newPassword !== null) {
   $sql .= " passwords = ?,";
   $params[] = &$newPassword;
}
if ($passwordHint !== null) {
   $sql .= " password_hint = ?,";
   $params[] = &$passwordHint;
}

// Remove trailing comma
$sql = rtrim($sql, ",");
$sql .= " WHERE id = ?";
$params[] = &$userId;

// Simulated database operation
$stmt = $conn->prepare($sql);

// Dynamically bind parameters
$types = str_repeat('s', count($params)); // Assuming all parameters are strings
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
   $response = array('success' => true, 'message' => 'Order updated successfully');
    header("Location: ../setting.php?success=true");
  
   exit(); 
} else {
   $response = array('success' => false, 'message' => 'Error updating order: ' . $conn->error);
    header("Location: ../userupdate.php?id=$userId&success=false");

   exit(); 
}

$stmt->close();
$conn->close();
?>