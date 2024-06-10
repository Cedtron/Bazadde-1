<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OGA Suites</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body> 
<div id="loader"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="custom-loader"></div>
</div>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                 
                </a>
                <p class="text-center">
                <img src="assets/images/logos/logo.jpg" class="rounded-3" width="80" alt="" />
                </p>
                <form action="api/log.php" method="post">
    <div class="mb-3">
        <label for="user" class="form-label">Email</label>
        <input type="email" class="form-control" id="user" name="user" aria-describedby="emailHelp">
    </div>
    <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
       
        <a class="text-primary fw-bold" href="forgot.php">Forgot Password ?</a>
    </div>
    <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-2 rounded-2">Log In</button>
    <div class="text-center my-4" id="notification">
  
</div>
    
</form>

              </div>
            </div>

            <div class="text-center justify-content-between mt-4">
       
            <p class="text-primary fw-bold">Developed and maintained by <a href="https://cedo-plum.vercel.app">Cedo</a> <script>document.write(new Date().getFullYear())</script></p>
   </div>



          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="log.js"></script>
    <script >
      const urlParams = new URLSearchParams(window.location.search);
const error = urlParams.get('error');
const message = urlParams.get('message');
const notificationDiv = document.getElementById('notification');

// Function to create and append Bootstrap alert
function appendAlert(type, content) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.textContent = content;
    notificationDiv.appendChild(alertDiv);
}

// Display error message as Bootstrap alert
if (error) {
    appendAlert('danger', decodeURIComponent(error));
}

// Display general message as Bootstrap alert
if (message) {
    appendAlert('info', decodeURIComponent(message));
}
    </script>
</body>

</html>