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

            <h4 class="text-center">User Update</h4>
            <form action="api/upuser.php" method="post">

                    <?php
                    $id = $_GET['id'];
                    $dt = "SELECT * FROM `users` WHERE id='$id';";
                    $res = mysqli_query($conn, $dt);
                    $rescheck = mysqli_num_rows($res);

                    if ($rescheck > 0) {
                        $row = mysqli_fetch_assoc($res);
                        ?>
                        <input type="hidden" value="<?php echo $id;?>" name="userId"/>
                <div class="row">
              <div class="col-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">User Name</label>
                    <input type="text" class="form-control" name="username" placeholder="User Name" value="<?php echo $row['user_name']; ?>"/>
                </div>
              </div>
             <div class="col-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $row['email']; ?>"/>
                </div>
             </div>
             <div class="col-6 col-md-4">
                <div class="mb-3">
                    <label for="Select" class="form-label">Role</label>
                    <select name="role" class="form-select">
                        <option <?php if($row['roles'] == 'Admin') echo 'selected'; ?>>Admin</option>
                        <option <?php if($row['roles'] == 'Saler') echo 'selected'; ?>>Saler</option>
                    </select>
                </div>
             </div>
             <div class="col-6 col-md-4">
                 <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Password" />
                </div>
             </div>
             <div class="col-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="text" class="form-control" name="confirmpassword" placeholder="Confirm Password" />
                </div>
             </div>
             <div class="col-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">Password Hint</label>
                    <input type="text" class="form-control" id="passwordhint" placeholder="Password Hint" value="<?php echo $row['password_hint']; ?>"/>
                </div>
             </div>
               </div>
                        <?php
            } else {
                echo "<div class='text-center'>Failed to load. Please try again.</div>";
            }
            ?>
               <button type="submit" class="btn btn-primary m-1 mx-auto">Update</button>
</form>
          
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php

mysqli_close($conn);
include 'footer.php';
?>