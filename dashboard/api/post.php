<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $details = $_POST['details'];
    $date = $_POST['date'];

    // Image upload handling
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
            $img = $target_file;

            // Prepare SQL and bind parameters
            $stmt = $conn->prepare("INSERT INTO posts (nam, details, img, dates) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $details, $img, $date);

            if ($stmt->execute()) {
                // echo "New record created successfully";
                header("Location: ../index.php?success=true");
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
            // echo "Sorry, there was an error uploading your file.";
            ?>
            <script type="text/javascript">
                alert("Sorry, there was an error uploading your file.");
                 window.location.href = "../updatepost.php";
                </script>
            <?php
        }
    }

    $conn->close();
}
?>