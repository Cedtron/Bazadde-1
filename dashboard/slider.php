<?php
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    ?>
    <script>
        window.location.href = "login.php";
    </script>
    <?php
    exit();
}

$email = $_SESSION['email'];

// Logout functionality
if (isset($_GET['logout'])) {
    setcookie("pass", "", time() - 50000);
    session_destroy();
    ?>
    <script>
        window.location.href = "login.php";
    </script>
    <?php
    exit();
}



$id = 1;

$sql = "SELECT * FROM posts WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

$stmt->close();
$conn->close();

?>
<!-- Header End -->
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="text-center">Update slider</h4>

            <form action="api/slider.php" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title1">Title 1</label>
        <input type="text" class="form-control" id="title1" name="title1">
    </div>
    <div class="form-group">
        <label for="detail1">Detail 1</label>
        <input type="text" class="form-control" id="detail1" name="detail1">
    </div>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="img1" name="img1">
        <label class="input-group-text" for="img1">Upload</label>
    </div>
    <div class="form-group">
        <label for="title2">Title 2</label>
        <input type="text" class="form-control" id="title2" name="title2">
    </div>
    <div class="form-group">
        <label for="detail2">Detail 2</label>
        <input type="text" class="form-control" id="detail2" name="detail2">
    </div>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="img2" name="img2">
        <label class="input-group-text" for="img2">Upload</label>
    </div>
    <div class="form-group">
        <label for="title3">Title 3</label>
        <input type="text" class="form-control" id="title3" name="title3">
    </div>
    <div class="form-group">
        <label for="detail3">Detail 3</label>
        <input type="text" class="form-control" id="detail3" name="detail3">
    </div>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="img3" name="img3">
        <label class="input-group-text" for="img3">Upload</label>
    </div>
    <button type="submit" class="btn btn-primary">Update slider</button>
</form>

     
        </div>
    </div>
</div>
<?php

include 'footer.php';
?>
