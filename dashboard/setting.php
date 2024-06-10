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
if ($_SESSION['role'] !== 'Admin') {
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
           
            <div class="col-lg-10 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">

                <form id="registrationForm">
            <div class="row">
                <div class="col-6 col-md-4">
                    <div class="mb-3">
                        <label class="form-label">User Name</label>
                        <input type="text" class="form-control" id="userName" name="userName"/>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email"/>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="mb-3">
                        <label for="Select" class="form-label">Role</label>
                        <select id="role" class="form-select">
                            <option>Admin</option>
                            <option>Saler</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"/>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword"/>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Password Hint</label>
                        <input type="text" class="form-control" id="passwordHint" name="passwordHint"/>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary m-1">Register</button>
        </form>
        <a type="button" class="btn btn-primary m-1" href="api/backup.php">Back up</a>

    <div id="notifi" class="m-4 w-25 fixed-bottom">

        <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

       </div>

    </div>

                 
                  <div class="mt-4 table-responsive">
                     <h5 class="card-title fw-semibold mb-4 text-center">Users</h5>
                    <table class="table text-nowrap mb-0 align-middle">
                      <thead class="bg text-light fs-4">
                        <tr>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">User Name</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Email</h6>
                          </th>
                       
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Role</h6>
                          </th>

                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Action</h6>
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                                 
    <?php
      $dt = "SELECT * FROM users ORDER BY id DESC;";
      $res = mysqli_query($conn, $dt);
      $rescheck = mysqli_num_rows($res);

      if ($rescheck > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          echo "
          <tr>
            <td>
              <p class='mb-0 text-muted'><strong>".$row["user_name"]."</strong></p>
            </td> 
            <td>
              <p class='mb-0 text-muted'>".$row["email"]."</p>
            </td>
            <td>
            <p class='mb-0 text-muted'>".$row["roles"]."</p>
          </td>
          
            <td>
            <a href='userupdate.php?id=".$row["id"]."' class='btn btn-primary'>Update</a>
              <a href='api/duser.php?id=".$row["id"]."' class='btn btn-danger dan'>Delete</a>
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
  <?php

mysqli_close($conn);
include 'footer.php';
?>
