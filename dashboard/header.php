<!doctype html>
<html lang="en">
<?php include "api/dbcon.php";?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bazzade Admin</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.ico" />
   <link rel="stylesheet" href="assets/css/richtext.min.css" />
  <link rel="stylesheet" href="assets/css/vanilla-calendar.min.css" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="assets/css/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="assets/css/main.css" />
 
  <link href="assets/libs/datatables/datatables.css" rel="stylesheet">
  <!-- <link href="assets/css/datatables.min.css" rel="stylesheet"> -->
  <link href="assets/css/apexcharts.css" rel="stylesheet">
  <link href="assets/css/select2.css" rel="stylesheet">
</head>
<?php

echo "<script> const roles = '" . $_SESSION['role'] . "'; </script>";
?>
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar bg">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="./index.html" class="text-nowrap logo-img m-2 mx-auto">
            <img src="assets/images/logos/logo.jpg" class="col-8 rounded-3" width="80" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">

            
          
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php" aria-expanded="false">
                <span>
                  <i class="bi bi-journal-richtext"></i>
                </span>
                <span class="hide-menu">Post</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="gallery.php" aria-expanded="false">
                <span>
                  <i class="bi bi-images"></i>
                </span>
                <span class="hide-menu">Gallery</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="slider.php" aria-expanded="false">
                <span>
                  <i class="bi bi-image"></i>
                </span>
                <span class="hide-menu">Slider</span>
              </a>
            </li>

            
         
            <li  class="sidebar-item">
              <a class="sidebar-link" href="setting.php" aria-expanded="false">
                <span>
                  <i class="ti ti-settings-2"></i>
                </span>
                <span class="hide-menu">Settings</span>
              </a>
            </li>
        
         
            <li class="sidebar-item mt-4">
              <a class="btn btn-primary rounded-4" href="logout.php" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">LogOut</span>
              </a>
            </li>

 
          </ul>
       
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
    <button class="btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        <i class="ti ti-bell-ringing"></i>
        <div class="notification bg-primary rounded-circle"></div>
        <span class="badge text-bg-danger"></span>
    </button>
</li>




          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

            
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
             
                  <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle m-2"> 
                   <span class="text-uppercase"><?php echo $_SESSION['user']; ?></span>
                </a>
           
              </li>
            </ul>
          </div>
        </nav>
      </header>