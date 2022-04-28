<?php
include_once "../class.views/class.checkUserLevel.php";
include_once "../class.views/class.dashboard-header.php";
$_SESSION["currentPage"] = "add-device";
?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg main-adddevice">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Device</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Add Device</h6>
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
      <div class="row min-vh-80 h-100" id="edit-add-form-list">
        <div class="col-lg-8">
          <form action="../functions/function.add-device.php"  enctype="multipart/form-data" method="post">
          <fieldset id="device-edit-add-fieldset">
          <div class="card">
            <legend>
              <h5 class="card-header">
                Enter the <u>New Device</u>  Details below
              </h5>
            </legend>
            <div class="card-body pt-sm-3 pt-0">
                <?php include_once "../class.views/class.form-EditAdd-Device.php"; ?>
                
                <div class="row justify-content-center">
                  <div class="col-md-3">
                    <button type="submit" class="form-control btn bg-gradient-info" name="add-device-submit">ADD DEVICE</button>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
        </div>
        <!-- Device specs forms -->
        <?php include_once "../class.views/class.include-specsform.php"; ?>

      </form>
    </div>

<?php
  include_once "../class.views/class.dashboard-footer.php";
?>
