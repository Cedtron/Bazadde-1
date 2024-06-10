<?php
include 'dbcon.php';


$id = 1;
$title1 = $_POST['title1'];
$detail1 = $_POST['detail1'];
$title2 = $_POST['title2'];
$detail2 = $_POST['detail2'];
$title3 = $_POST['title3'];
$detail3 = $_POST['detail3'];

$updateFields = [];
if ($title1) $updateFields[] = "title1='$title1'";
if ($detail1) $updateFields[] = "detail1='$detail1'";
if ($_FILES['img1']['name']) {
    $img1 = "images/" . basename($_FILES['img1']['name']);
    move_uploaded_file($_FILES['img1']['tmp_name'], $img1);
    $updateFields[] = "img1='$img1'";
}
if ($title2) $updateFields[] = "title2='$title2'";
if ($detail2) $updateFields[] = "detail2='$detail2'";
if ($_FILES['img2']['name']) {
    $img2 = "images/" . basename($_FILES['img2']['name']);
    move_uploaded_file($_FILES['img2']['tmp_name'], $img2);
    $updateFields[] = "img2='$img2'";
}
if ($title3) $updateFields[] = "title3='$title3'";
if ($detail3) $updateFields[] = "detail3='$detail3'";
if ($_FILES['img3']['name']) {
    $img3 = "images/" . basename($_FILES['img3']['name']);
    move_uploaded_file($_FILES['img3']['tmp_name'], $img3);
    $updateFields[] = "img3='$img3'";
}

if (!empty($updateFields)) {
    $updateQuery = "UPDATE slider SET " . implode(', ', $updateFields) . " WHERE id=$id";
    if ($conn->query($updateQuery) === TRUE) {
        // echo "Record updated successfully";
        header("Location: ../slider.php?success=true");
    } else {
        // echo "Error updating record: " . $conn->error;
        ?>
        <script type="text/javascript">
            alert("Sorry, there was an error uploading your file.");
             window.location.href = "../updatepost.php";
            </script>
        <?php
    }
}

$conn->close();
?>
