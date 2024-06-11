<?php
include 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    
    // Handle file upload
    $target_dir = "gallery/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0; 
    }
    
    // Check file size
    if ($_FILES["img"]["size"] > 5000000) { // 500KB
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" 
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            // Insert into database
            $img = $target_file; // Store the path in the database
            $stmt = $conn->prepare("INSERT INTO gallery (title, img) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $img);
            
            if ($stmt->execute()) {
                //echo "The file ". htmlspecialchars( basename( $_FILES["img"]["name"])). " has been uploaded and data saved.";
                ?>
                <script type="text/javascript">
                    alert("Uploading your file successful.");
                     window.location.href = "../gallery.php";
                    </script>
                <?php
            } else {
                // echo "Error: " . $stmt->error;
                ?>
        <script type="text/javascript">
            alert("Sorry, there was an error uploading your file.");
             window.location.href = "../gallery.php";
            </script>
        <?php
            }
            
            $stmt->close();
        } else {
            
            ?>
        <script type="text/javascript">
            alert("Sorry, there was an error uploading your file.");
             window.location.href = "../updatepost.php";
            </script>
        <?php
        }
    }
}

$conn->close();
?>