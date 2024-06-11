<?php
include('dbcon.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get the image path before deleting the post
    $stmt = $conn->prepare("SELECT img FROM gallery WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    if ($post) {
        // Delete the post from the database
        $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Delete the image file if it exists
            if ($post['img'] && file_exists($post['img'])) {
                unlink($post['img']);
            }?>
            <script type="text/javascript">
            alert("Delete was successful");
             window.location.href = "../gallery.php";
            </script>
            <?php
        } else {
            echo "Error deleting record: " . $stmt->error;
            include '../error.php';
        }

        $stmt->close();
    } else {
        echo "Post not found.";
    }

    $conn->close();
}
?>