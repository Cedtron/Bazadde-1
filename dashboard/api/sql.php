<?php
 // Check if orders table exists
$result = $conn->query("SHOW TABLES LIKE 'posts'");
if ($result->num_rows == 0) {
    // posts table doesn't exist, so create it
    $sql = "CREATE TABLE posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nam VARCHAR(255) NOT NULL,
        details TEXT,
        img TEXT,    
        dates VARCHAR(20)
       
    )";

    if ($conn->query($sql) === TRUE) {
       // echo "Table posts created successfully<br>";
    } else {
       // echo "Error creating table: " . $conn->error . "<br>";
    }
} else {
   // echo "Table posts already exists<br>";
}


// Check if users table exists
$result = $conn->query("SHOW TABLES LIKE 'slider'");
if ($result->num_rows == 0) {
    // Users table doesn't exist, so create it
    $sql = "CREATE TABLE slider (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title1 VARCHAR(20) NOT NULL,
        detail1 VARCHAR(50) NOT NULL,
        img1 VARCHAR(50) NOT NULL,
        title2 VARCHAR(20) NOT NULL,
        detail2 VARCHAR(50) NOT NULL,
        img2 VARCHAR(50) NOT NULL,
        title3 VARCHAR(20) NOT NULL,
        detail3 VARCHAR(50) NOT NULL,
        img3 VARCHAR(50) NOT NULL
       
    )";

    if ($conn->query($sql) === TRUE) {
       // echo "Table slider created successfully<br>";
    } else {
       // echo "Error creating table: " . $conn->error . "<br>";
    }
} else {
   // echo "Table users already exists<br>";
}


$result = $conn->query("SHOW TABLES LIKE 'users'");
if ($result->num_rows == 0) {
    // Users table doesn't exist, so create it
    $sql = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        roles ENUM('Admin', 'Saler') NOT NULL,
        passwords VARCHAR(255) NOT NULL,
        password_hint VARCHAR(255)
    )";

    if ($conn->query($sql) === TRUE) {
        // Table created successfully, now insert initial data
        $insert_sql = "INSERT INTO users (user_name, email, roles, passwords, password_hint) VALUES
        ('allan', 'allan@gmail.com', 'Admin', '$2y$10$Tbev0ZmIkfS.gpxsmbgYvuSIXqnVfPCyxO8QJI46Wsje9ntkH62sS', 'boy')";

        if ($conn->query($insert_sql) === TRUE) {
            // Initial data inserted successfully
            // echo "Table users created successfully and initial data inserted<br>";
        } else {
            // echo "Error inserting initial data: " . $conn->error . "<br>";
        }
    } else {
        // echo "Error creating table: " . $conn->error . "<br>";
    }
} else {
    // echo "Table users already exists<br>";
}


?>