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
?>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
           
            <div class="col-lg-12 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                <div class="card-body p-4">
                <form action="api/post.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required />
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">Details</label>
                    <input type="text" name="details" class="form-control" required />
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" required />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="input-group mb-3">
                    <input type="file" name="image" class="form-control" id="inputGroupFile02" required>
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary m-1" id="submitButton">Add</button>
        </div>
    </form>
</div>
                 


                
                  <h5 class="card-title fw-semibold mb-4">Recent Orders</h5>
                  <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                      <thead class="bg text-light fs-4">
                        <tr>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Name</h6>
                          </th>
                          
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Details</h6>
                          </th>
                         
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0"> Date</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Action</h6>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                     

                                 
<?php
  $dt = "SELECT * FROM posts ORDER BY id DESC;";
  $res = mysqli_query($conn, $dt);
  $rescheck = mysqli_num_rows($res);

  if ($rescheck > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
      echo "
      <tr>
        <td>
          <p class='mb-0 text-muted'><strong>".$row["nam"]."</strong></p>
        </td> 
        
        <td>
        <p class='mb-0 text-muted'>".$row["details"]."</p>
      </td>
      
    <td>
    <p class='mb-0 text-muted'>".$row["dates"]."</p>
  </td>
       
        <td>
        <a href='updatepost.php?id=".$row["id"]."' class='btn btn-primary'>Update</a>
        <button class='btn btn-danger' data-toggle='modal' data-target='#deleteModal' data-id='" . $row["id"] . "'>Delete</button>
        </td>
      </tr>";
    }
  } else {
    echo "<div class='text-center'>Failed to load. Please try again.</div>";
  }
?>


                                   
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this post?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger" id="confirmDelete">Delete</a>
            </div>
        </div>
    </div>
</div>



  <?php

mysqli_close($conn);
include 'footer.php';
?>
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var confirmDelete = document.getElementById('confirmDelete');
        confirmDelete.href = 'api/del.php?id=' + id;
    });
</script>