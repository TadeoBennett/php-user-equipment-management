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
        <div class="specs"></div>
        <div class="col-lg-4 mt-3 screen specs">
          <fieldset id="device-edit-add-specs">
            <div class="card">
              <legend>
                <h5 class="card-header"><u>Edit</u> Screen <u>Specifications</u></h5>
              </legend>
              <div class="card-body pt-0">
                <input type="text" hidden name="add-spec-type" value="1">
                <label for="inputSize">Size</label>
                <input id="inputSize" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Size..." name="size">
                <label for="inputModel">Model</label>
                <input id="inputModel" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Model..." name="screen_model">
                <label for="inputSerial">Serial</label>
                <input id="inputSerial" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Serial..." name="screen_serial">
              </div>
            </div>
          </fieldset>
        </div>
        
        <div class="col-lg-4 mt-3 computer specs">
          <fieldset id="device-edit-add-specs">
            <div class="card">
              <legend>
                <h5 class="card-header"><u>Edit</u> Computer <u>Specifications</u></h5>
              </legend>
              <div class="card-body pt-0">
                <input type="text" hidden name="add-spec-type" value="2">
                <label for="inputMake">Make</label>
                <input id="inputMake" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Make..." name="make">
                <label for="inputModel">Model</label>
                <input id="inputModel" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Model..."  name="comp_model">
                <label for="inputSerial">Serial</label>
                <input id="inputSerial" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Serial..." name="comp_serial">
                <label for="inputProcessor">Processor</label>
                <input id="inputProcessor" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Processor..." name="processor">
                <label for="inputRAM">RAM</label>
                <input id="inputRAM" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device RAM..." name="ram">
                <label for="inputHDD">HDD</label>
                <input id="inputHDD" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device HDD..." name="hdd">
              </div>
            </div>
          </fieldset>
        </div>


        <div class="col-lg-4 mt-3 ups specs">
          <fieldset id="device-edit-add-specs">
            <div class="card">
              <legend>
                <h5 class="card-header"><u>Edit</u> UPS <u>Specifications</u></h5>
              </legend>
              <div class="card-body pt-0">
                <input type="text" hidden name="add-spec-type" value="3">
                <label for="inputModel">Model</label>
                <input id="inputModel" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Model..." name="ups_model">
                <label for="inputSerial">Serial</label>
                <input id="inputSerial" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Serial..." name="ups_serial">
              </div>
            </div>
          </fieldset>
        </div>

      </form>
    </div>

<?php
  include_once "../class.views/class.dashboard-footer.php";
?>
