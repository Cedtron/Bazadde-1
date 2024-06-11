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


?>
<!-- Header End -->
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="text-center">Add to gallery</h4>

            <form class="my-4" action="api/gallery.php" method="post" enctype="multipart/form-data">
    
    <div class="form-group my-2">
        <label for="title1">Title</label>
        <input type="text" class="form-control" name="title">
    </div>
 
    <div class="input-group mb-3">
        <input type="file" class="form-control"  name="img">
        <label class="input-group-text" for="img1">Upload</label>
    </div>
  
    <button type="submit" class="btn btn-primary">Add </button>
</form>

<div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                      <thead class="bg text-light fs-4">
                        <tr>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Title</h6>
                          </th>
                          
                          
                         
                         
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Action</h6>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                     

                                 
                      <?php
 
  // Query to select data from the 'gallery' table
  $sqls = "SELECT * FROM gallery ORDER BY id DESC;";
  $res = mysqli_query($conn, $sqls);
  $rescheck = mysqli_num_rows($res);
  if ($rescheck > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
      echo "
      <tr>
        <td>
          <p class='mb-0 text-muted'><strong>".$row["title"]."</strong></p>
        </td> 
        <td>
          <a href='api/dgall.php?id=".urlencode($row["id"])."' class='btn btn-danger'>Delete</a>
        </td>
      </tr>";
    }
  } else {
    // If no rows were returned, display a message
    echo "<tr><td colspan='2' class='text-center'>No data available</td></tr>";
  }
?>



                                   
                      </tbody>
                    </table>
                  </div>
     
        </div>
    </div>
</div>
<?php

include 'footer.php';
?>
