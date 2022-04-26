<?php
include_once "../class.views/class.checkUserLevel.php";
include_once "../class.views/class.dashboard-header.php"; 
$_SESSION["currentPage"] = "add-user";
?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg main-adduser">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add User</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Add User</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <!-- <ul class="navbar-nav  justify-content-end">
            <?php //include_once "../class.views/class.include-ColorConfigurator.php" ?>
          </ul> -->
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row min-vh-80 h-100">
        <div class="col col-lg-9">
          <div class="card">
            <h5 class="card-header">
              Enter the <u>New User</u>  Details below
            </h5>
            <div class="card-body pt-sm-3 pt-0">
              <fieldset id="user-edit-add-fieldset">
                <form action="../functions/function.add-user.php" method="post">
                  <?php include_once "../class.views/class.form-EditAdd-User.php"; ?>
                <div class="row justify-content-center">
                  <div class="col-md-3">
                    <button type="submit" class="form-control btn bg-gradient-warning" name="add-user-submit">ADD USER</button>
                  </div>
                </div>
              </form>
            </fieldset>
            </div>
          </div>
        </div>
    </div>
<?php include_once "../class.views/class.dashboard-footer.php"; ?>