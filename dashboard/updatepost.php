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



$id = $_GET['id'];

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
            <h4 class="text-center">Update Post</h4>

            <form action="api/upost.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <div class="row">
            <div class="col-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $post['nam']; ?>" required />
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">Details</label>
                    <input type="text" name="details" class="form-control" value="<?php echo $post['details']; ?>" required />
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" value="<?php echo $post['dates']; ?>" required />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="input-group mb-3">
                    <input type="file" name="image" class="form-control" id="inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
                <?php if ($post['img']): ?>
                    <img src="api/<?php echo $post['img']; ?>" alt="Current Image" style="max-width: 100px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary m-1" id="submitButton">Update</button>
        </div>
    </form>

     
        </div>
    </div>
</div>
<?php

include 'footer.php';
?>
