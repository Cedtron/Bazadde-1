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
                <form action="api/forgot.php" method="post">
    <div class="mb-3">
        <label for="user" class="form-label">Email</label>
        <input type="email" class="form-control"  name="email" aria-describedby="emailHelp">
    </div>
    <div class="mb-4">
        <label for="password" class="form-label">Password hint</label>
        <input type="text" class="form-control" name="passwordhint">
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
       
        
    </div>
    <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-2 rounded-2">Send</button>

    
</form>
<div id="notifi" class="m-4 w-50 fixed-bottom">
          </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>







  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="log.js"></script>

    <script>
    // Function to read URL parameters
    function getUrlParameter(name) {
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(window.location.href);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    // Check if message parameter exists in the URL
    var message = getUrlParameter('message');
    if (message) {
        // Create Bootstrap alert
        var alertDiv = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
            message +
            '</div>';
        // Insert alert into the notification div
        document.getElementById('notifi').innerHTML = alertDiv;
        // Automatically close the alert after 3 seconds
        setTimeout(function () {
            $('.alert').alert('close');
        }, 3000);
    }
</script>


</body>

</html>