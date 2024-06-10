<?php
include 'api/dbcon.php';

if(isset($_POST['dash'])) {
    $email = $_POST['admin'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (password_verify($pass, $row['passwords'])) {
                // Start PHP session and set session variables
                
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['roles'];
                $_SESSION['id'] = $row['id'];

                // Return JSON response
                echo json_encode(array(
                    'success' => true,
                    'email' => $row['email'],
                    'role' => $row['roles'],
                    'id' => $row['id']
                ));
                exit; 
            }
        }
    }
    // Return JSON response with login failed message
    echo json_encode(array('success' => false, 'message' => 'Login failed'));
} else {
    // Return JSON response with error message if 'dash' is not set
    echo json_encode(array('success' => false, 'message' => 'Error: No data received'));
}
?>