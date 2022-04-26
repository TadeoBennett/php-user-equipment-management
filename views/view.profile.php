<?php
include_once "../class.views/class.dashboard-header.php";
$_SESSION["currentPage"] = "profile";
?>
<main class="main-profile main-content position-relative max-height-vh-100 h-100 border-radius-lg">
  <div class="main-content position-relative max-height-vh-100 h-100 ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Profile</h6>
        </nav>
        <!-- <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div> -->
          <ul class="navbar-nav  justify-content-end">
            
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <!-- <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
            </li> -->
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <!-- Profile Name -->
              <img src="../images/<?php if (isset($_SESSION["userRecord"])){if($_SESSION["userRecord"]["Sex"] == 'M'){echo "male";}else{echo "female";}}?>-profile.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php
                  if(isset($_SESSION["userRecord"])){ echo $_SESSION["userRecord"]["User_name"];}
                ?>
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                <?php
                  if(isset($_SESSION["userRecord"])){ echo $_SESSION["userRecord"]["Job_Title"];}
                ?>
              </p>
            </div>
          </div>
          <div class="col-md-2 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-1">
              <ul class="nav nav-pills nav-fill p-2" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 " href="../index.php" role="tab">
                    <i class="material-icons text-lg position-relative">home</i>
                    <span class="ms-1">Home</span>
                  </a>
                </li>
                <li class="nav-item bg-gray-200 rounded">
                  <form action="../functions/function.sign-out.php" method="post">
                    <button type="submit" style="all: unset; cursor:pointer;" title="Log Out" name="sign-out-submit">
                      <a class="nav-link mb-0 px-0 py-1">
                        <i class="material-icons text-lg position-relative">key</i>
                        <span class="d-sm-inline d-none ms-1">Sign Out</span>
                      </a>
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="row">
            <div class="col-12 col-xl-4">
              <div class="card card-plain h-100">
              <div class="card-header pb-0">
                  <div class="row">
                    <div class="col-md-8 d-flex  align-items-start">
                      <h6 class="mb-0 me-3">Profile Information</h6>
                      <div class="col-md-4 text-end">
                        <a href="javascript:;">
                          <i class="fas fa-user-edit text-secondary text-lg" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile Information"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <hr class="horizontal gray-light my-1">
                  <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Identification Number:</strong> &nbsp; <?php if (isset($_SESSION["userRecord"])){echo $_SESSION["userRecord"]["Employee_id"];}?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php if (isset($_SESSION["userRecord"])){echo $_SESSION["userRecord"]["First_name"] . " " .  $_SESSION["userRecord"]["Last_name"];} ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Department:</strong> &nbsp; <?php if (isset($_SESSION["userRecord"])){echo returnDepartmentName($conn, $_SESSION["userRecord"]["Department_id"]);}?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php if (isset($_SESSION["userRecord"])){echo $_SESSION["userRecord"]["Email"];}?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Sex:</strong> &nbsp; <?php if (isset($_SESSION["userRecord"])){if($_SESSION["userRecord"]["Sex"] == 'M'){echo "Male";}else{echo "Female";}}?></li>
                    <!-- <li class="list-group-item border-0 ps-0 pb-0">
                      <strong class="text-dark text-sm">Social:</strong> &nbsp;
                      <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                        <i class="fab fa-facebook fa-lg"></i>
                      </a>
                      <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                        <i class="fab fa-twitter fa-lg"></i>
                      </a>
                      <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                        <i class="fab fa-instagram fa-lg"></i>
                      </a>
                    </li> -->
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-xl-4" style="height: 400px; overflow: auto;">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <h6 class="mb-0">Your Devices</h6>
                </div>
                <div class="card">
                  <div class="card-body pt-3 p-3">
                    <?php
                      $currentUserDevices = returnCurrentUserDevices_Query($conn, $_SESSION["userRecord"]["Users_id"]);
                    ?>
                    <!-- list can neatly show 3-4 devices on the page -->
                    <ul class="list-group">
                      <?php
                        if ($currentUserDevices != "") {
                          while($row = mysqli_fetch_assoc($currentUserDevices)){
                            echo '
                            <li class="list-group-item border-0 d-flex p-3 mb-2 bg-gray-200 border-radius-lg">
                              <div class="d-flex flex-column">
                                <h6 class="mb-1 text-sm">.' . $row["Device_name"] . '</h6>
                                <span class="mb-2 text-xs">Device Number ID: <span class="text-dark font-weight-bold ms-sm-2">' . $row["Device_AssetTag_id"] . '</span></span>
                              </div>
                              <div class="ms-auto text-end">
                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                              </div>
                            </li>';
                          }
                        }else{
                          echo '<h6>NO DEVICES TO SHOW</h6>';
                        }
                      ?>
                    </ul>
                    <!--  -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
    include_once "../class.views/class.dashboard-footer.php";
    ?>


    <!-- <div class="col-12 col-xl-4">
  <div class="card card-plain h-100">
    <div class="card-header pb-0 p-3">
      <h6 class="mb-0">Your Devices</h6>
    </div>
    <div class="card">
      <div class="card-body pt-3 p-3">
        <ul class="list-group">
          <li class="list-group-item border-0 d-flex p-3 mb-2 bg-gray-200 border-radius-lg">
            <div class="d-flex flex-column">
              <h6 class="mb-1 text-sm">Device Name</h6>
              <span class="mb-2 text-xs">Device Number ID: <span class="text-dark font-weight-bold ms-sm-2">#####</span></span>
              <span class="text-xs">Registered to: <span class="text-dark ms-sm-2 font-weight-bold">uregistered/Mr. John Doe</span></span>
            </div>
            <div class="ms-auto text-end">
              <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Delete</a>
              <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div> -->