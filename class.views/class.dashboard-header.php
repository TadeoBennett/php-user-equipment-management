<?php
if (session_status() == PHP_SESSION_NONE) { //check if session was already started
  session_start();
}
if (!(isset($_SESSION["userRecord"]))) {
  //username not recognized then go to sign in
  header("Location: ../views/view.sign-in.php");
  exit();
}
include_once "../functions/function.dbh.php";
include_once "../functions.php";
?>
<!-- be able to use the database connection and functions -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="../images/btb icon.ico">
  <title>
    BTB Inventory
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../includes/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../includes/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../includes/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
  <!-- AJAX CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>


<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start  bg-gradient-dark" id="sidenav-main">
    <!--ms-3, my-3, border-radius-xl-->
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="../index.php">
        <img src="../images/btb-logo.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="text-white">Inventory Dashboard</span>
      </a>
    </div>
    <p class="text-center text-white">
      <?php
      if (isset($_SESSION["userRecord"])){
        if ($_SESSION["userRecord"]["User_level_id"] == 1) {
          echo 'Administrator';
        } else {
          echo $_SESSION["userRecord"]["User_name"];
        }
      }
      ?>
    </p>
    <hr class="horizontal light mt-0 mb-2">



    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="../index.php" id="dashboardlink">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="./view.tables.php"  id="tableslink">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="./view.notifications.php"  id="notificationslink">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <div  <?php if (isset($_SESSION["userRecord"])){if($_SESSION["userRecord"]["User_level_id"] == 2){ echo 'style="display: none"';}} ?>> <!-- Device Pages not visible by non-admins -->
          <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Device pages</h6>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white " href="./view.add-device.php" id="adddevicelink">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">person</i>
              </div>
              <span class="nav-link-text ms-1">Add Device</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white " href="./view.edit-device.php" id="editdevicelink">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">person</i>
              </div>
              <span class="nav-link-text ms-1">Edit Device</span>
            </a>
          </li>
        </div>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="./view.profile.php" id="profilelink">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item"  <?php if (isset($_SESSION["userRecord"])){if($_SESSION["userRecord"]["User_level_id"] == 2){ echo 'style="display: none"';}} ?>>
          <a class="nav-link text-white " href="./view.add-user.php" id="adduserlink">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons bi bi-pen-fill opacity-10">add</i>
            </div>
            <span class="nav-link-text ms-1">Add User</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="./view.edit-user.php" id="edituserlink">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">edit</i>
            </div>
            <span class="nav-link-text ms-1">Edit User</span>
          </a>
        </li>
      </ul>
    </div>


    

    <!-- <div class="collapse navbar-collapse  w-auto  max-height-vh-110" id="sidenav-collapse-main">
      <nav class="sidebar">
        <ul class="navbar-nav nav flex-column" id="nav_accordion">
          <li class="nav-item">
            <a class="nav-link text-white" href="../index.php" id="dashboardlink">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">dashboard</i>
              </div>
              <span class="nav-link-text ms-1">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="../views/view.tables.php" id="tableslink">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">table_view</i>
              </div>
              <span class="nav-link-text ms-1">Device Tables</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="../views/view.notifications.php" id="notificationslink">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">notifications</i>
              </div>
              <span class="nav-link-text ms-1">Notifications</span>
            </a>
          </li>

          <li class="nav-item has-submenu"  <?php if ($_SESSION["userRecord"]["User_level_id"] == 2) {
                echo 'style="display: none"';
              } ?>>
            <h6 class="nav-link ps-4 ms-2 text-uppercase text-sm text-white font-weight-bolder opacity-8">Device pages
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons">arrow_drop_down</i>
              </div>
            </h6>
            <ul class="collapse">
              <li class="nav-item">
                <a class="nav-link text-white " href="../views/view.add-device.php" id="adddevicelink">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">person</i>
                  </div>
                  <span class="nav-link-text ms-1">Add Device</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="../views/view.edit-device.php" id="editdevicelink">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">person</i>
                  </div>
                  <span class="nav-link-text ms-1">Edit Device</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-submenu">
            <h6 class="nav-link ps-4 ms-2 text-uppercase text-sm text-white font-weight-bolder opacity-8">Account pages  
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons"> arrow_drop_down</i>
              </div>
            </h6>
            
            <ul class="collapse">
              <li class="nav-item">
                <a class="nav-link text-white " href="../views/view.profile.php" id="profilelink">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">person</i>
                  </div>
                  <span class="nav-link-text ms-1">Profile</span>
                </a>
              </li>
              <li class="nav-item" <?php if ($_SESSION["userRecord"]["User_level_id"] == 2) {
                echo 'style="display: none"';
              } ?>>
                <a class="nav-link text-white " href="../views/view.add-user.php" id="adduserlink">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons bi bi-pen-fill opacity-10">add</i>
                  </div>
                  <span class="nav-link-text ms-1">Add User</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="../views/view.edit-user.php" id="edituserlink">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">edit</i>
                  </div>
                  <span class="nav-link-text ms-1">Edit User</span>
                </a>
              </li>
            </ul>
          </li>
        </ul> 
      </nav>
    </div> -->
  </aside>