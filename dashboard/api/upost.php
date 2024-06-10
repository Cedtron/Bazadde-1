<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $details = $_POST['details'];
    $date = $_POST['date'];
    
    // Initialize an array to store the columns to be updated
    $updates = [];
    $params = [];
    $types = "";

    // Fetch the current data from the database
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
    $stmt->close();

    // Check for changes in the 'name' field
    if ($name !== $post['nam']) {
        $updates[] = "nam=?";
        $params[] = $name;
        $types .= "s";
    }

    // Check for changes in the 'details' field
    if ($details !== $post['details']) {
        $updates[] = "details=?";
        $params[] = $details;
        $types .= "s";
    }

    // Check for changes in the 'date' field
    if ($date !== $post['dates']) {
        $updates[] = "dates=?";
        $params[] = $date;
        $types .= "s";
    }

    // Image upload handling
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Delete the old image file if it exists
                if ($post['img'] && file_exists($post['img'])) {
                    unlink($post['img']);
                }
                $img = $target_file;
                $updates[] = "img=?";
                $params[] = $img;
                $types .= "s";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    if (!empty($updates)) {
        // Construct the SQL query dynamically
        $sql = "UPDATE posts SET " . implode(", ", $updates) . " WHERE id=?";
        $params[] = $id;
        $types .= "i";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            // echo "Record updated successfully";
            header("Location: ../updatepost.php?success=true");
        } else {
            // echo "Error: " . $stmt->error;
            ?>
            <script type="text/javascript">
                alert("Error.");
                 window.location.href = "../updatepost.php";
                </script>
            <?php
        }

        $stmt->close();
    } else {
        // echo "No changes detected.";
        ?>
        <script type="text/javascript">
            alert("No changes detected.");
             window.location.href = "../updatepost.php";
            </script>
        <?php
    }

    $conn->close();
}
?>
