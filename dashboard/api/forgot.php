<?php
include "dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $passwordHint = $_POST['passwordhint'];
    
    // SQL query to fetch user data based on email and password hint
    $query = "SELECT * FROM users WHERE email = '$email' AND password_hint = '$passwordHint'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        // Fetch the user's ID from the query result
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];
        
        // User found, redirect to another page
        header("Location: ../change.php?id=$id");
        exit;
    } else {
        // User not found or incorrect credentials, handle accordingly
        $message = "Incorrect email or password hint.";
        header("Location: ../forgot.php?message=" . urlencode($message));
        exit;
    }
}
?>