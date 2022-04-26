<?php
include_once "../class.views/class.dashboard-header.php";
$_SESSION["currentPage"] = "tables";
?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg main-tables">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tables</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Tables</h6>
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
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3" id="user-table">User table</h6>
            </div>
          </div>
          <div class="pt-3 px-4">
            <div class="row">
              <div class="col-4">
                <div class="input-group input-group-outline col-4">
                  <input type="text" class="form-control" placeholder="search by name..." id="searchUsers">
                </div>
              </div>
            </div>
          </div>
          <div class="card-body pt-2 pe-5 overflow-auto" style="max-height: 520px;">
            <div class="table">
              <table class="table table-striped table-hover align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Job Title</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Department</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Gender</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Devices Registered</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 border" colspan="2" 
                     <?php if(isset($_SESSION["userRecord"])){
                        if($_SESSION["userRecord"]["User_level_id"] != 1){
                            echo 'style="display:none;"';
                          }
                        } ?>
                     >Actions</th>
                  </tr>
                </thead>
                <tbody id="displayUsers">
                  <!-- run AJAX code -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3" id="device_types-table">Device Tables</h6>
            </div>
          </div>
          <ul class="nav nav-tabs mt-3 justify-content-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="monitors-tab" data-bs-toggle="tab" data-bs-target="#monitors" type="button" role="tab" aria-controls="monitors" aria-selected="true">Monitors</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="laptops-tab" data-bs-toggle="tab" data-bs-target="#laptops" type="button" role="tab" aria-controls="laptops" aria-selected="false">Laptops</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="headsets-tab" data-bs-toggle="tab" data-bs-target="#headsets" type="button" role="tab" aria-controls="headsets" aria-selected="false">Headsets</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="desktops-tab" data-bs-toggle="tab" data-bs-target="#desktops" type="button" role="tab" aria-controls="desktops" aria-selected="false">Desktops</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="bags-tab" data-bs-toggle="tab" data-bs-target="#bags" type="button" role="tab" aria-controls="bags" aria-selected="false">Bags</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="ups-tab" data-bs-toggle="tab" data-bs-target="#ups" type="button" role="tab" aria-controls="ups" aria-selected="false">UPS</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="keyboards-tab" data-bs-toggle="tab" data-bs-target="#keyboards" type="button" role="tab" aria-controls="keyboards" aria-selected="false">Keyboards</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="mice-tab" data-bs-toggle="tab" data-bs-target="#mice" type="button" role="tab" aria-controls="mice" aria-selected="false">Mice</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="dockingstations-tab" data-bs-toggle="tab" data-bs-target="#dockingstations" type="button" role="tab" aria-controls="dockingstations" aria-selected="false">Docking Stations</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="printers-tab" data-bs-toggle="tab" data-bs-target="#printers" type="button" role="tab" aria-controls="printers" aria-selected="false">Printers (workstations)</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="monitors" role="tabpanel" aria-labelledby="monitors-tab">
              <!--  -->
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="input-group input-group-outline col-4">
                        <input type="text" class="form-control" placeholder="search by device tag ID..." id="searchMonitors">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-1 p-3 w-100 row m-0 auto" id="displayMonitors" style="max-height: 520px;">
                  <!-- run ajax code to display info-->
                </div>
              </div>
              <!--  -->
            </div>

            <div class="tab-pane fade" id="laptops" role="tabpanel" aria-labelledby="laptops-tab">
              <!--  -->
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="input-group input-group-outline col-4">
                        <input type="text" class="form-control" placeholder="search by device tag ID..." id="searchLaptops">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-1 p-3 w-100 row m-0 auto" id="displayLaptops" style="max-height: 520px;">
                  <!-- run ajax code -->
                </div>
              </div>
              <!--  -->
            </div>

            <div class="tab-pane fade" id="headsets" role="tabpanel" aria-labelledby="headsets-tab">
              <!--  -->
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="input-group input-group-outline col-4">
                        <input type="text" class="form-control" placeholder="search by device tag ID..." id="searchHeadsets">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-1 p-3 w-100 row m-0 auto" id="displayHeadsets" style="max-height: 520px;">
                  <!-- run ajax code -->
                </div>
              </div>
              <!--  -->
            </div>

            <div class="tab-pane fade" id="desktops" role="tabpanel" aria-labelledby="desktops-tab">
              <!--  -->
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="input-group input-group-outline col-4">
                        <input type="text" class="form-control" placeholder="search by device tag ID..." id="searchDesktops">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-1 p-3 w-100 row m-0 auto" id="displayDesktops" style="max-height: 520px;">
                  <!-- run ajax code -->
                </div>
              </div>
              <!--  -->
            </div>

            <div class="tab-pane fade" id="bags" role="tabpanel" aria-labelledby="bags-tab">
              <!--  -->
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="input-group input-group-outline col-4">
                        <input type="text" class="form-control" placeholder="search by device tag ID..." id="searchBags">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-1 p-3 w-100 row m-0 auto" id="displayBags" style="max-height: 520px;">
                  <!-- run ajax code -->
                </div>
              </div>
              <!--  -->
            </div>

            <div class="tab-pane fade" id="ups" role="tabpanel" aria-labelledby="ups-tab">
              <!--  -->
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="input-group input-group-outline col-4">
                        <input type="text" class="form-control" placeholder="search by device tag ID..." id="searchUPS">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-1 p-3 w-100 row m-0 auto" id="displayUPS" style="max-height: 520px;">
                  <!-- run ajax code -->
                </div>
              </div>
              <!--  -->
            </div>

            <div class="tab-pane fade" id="keyboards" role="tabpanel" aria-labelledby="keyboards-tab">
              <!--  -->
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="input-group input-group-outline col-4">
                        <input type="text" class="form-control" placeholder="search by device tag ID..." id="searchKeyboards">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-1 p-3 w-100 row m-0 auto" id="displayKeyboards" style="max-height: 520px;">
                  <!-- run ajax code -->
                </div>
              </div>
              <!--  -->
            </div>

            <div class="tab-pane fade" id="mice" role="tabpanel" aria-labelledby="mice-tab">
              <!--  -->
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="input-group input-group-outline col-4">
                        <input type="text" class="form-control" placeholder="search by device tag ID..." id="searchMice">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-1 p-3 w-100 row m-0 auto" id="displayMice" style="max-height: 520px;">
                  <!-- run ajax code -->
                </div>
              </div>
              <!--  -->
            </div>

            <div class="tab-pane fade" id="dockingstations" role="tabpanel" aria-labelledby="dockingstations-tab">
              <!--  -->
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="input-group input-group-outline col-4">
                        <input type="text" class="form-control" placeholder="search by device tag ID..." id="searchDockingStations">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-1 p-3 w-100 row m-0 auto" id="displayDockingStations" style="max-height: 520px;">
                  <!-- run ajax code -->
                </div>
              </div>
              <!--  -->
            </div>

            <div class="tab-pane fade" id="printers" role="tabpanel" aria-labelledby="printers-tab">
              <!--  -->
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="input-group input-group-outline col-4">
                        <input type="text" class="form-control" placeholder="search by device tag ID..." id="searchPrinters">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-1 p-3 w-100 row m-0 auto" id="displayPrinters" style="max-height: 520px;">
                  <!-- run ajax code -->
                </div>
              </div>
              <!--  -->
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-info shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3" id="registered_devices-table">Registered Devices</h6>
            </div>
          </div>
          <div class="pt-3 px-4  mb-2">
            <div class="row">
              <div class="col-6">
                <div class="input-group input-group-outline col-4">
                  <input type="text" class="form-control" placeholder="search by staff name or device tag ID..." id="searchRegisteredDevices">
                </div>
              </div>
            </div>
          </div>
          <div class="card-body  pt-3 p-3  overflow-auto"   style="max-height: 500px;">
            <ul class="list-group">
              <div class="row" id="displayRegisteredDevices">
                <!-- RUN AJAX code -->
              </div>
            <ul>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3" id="unregistered_devices-table">Unregistered Devices</h6>
            </div>
          </div>
          <div class="pt-3 px-4 mb-2">
            <div class="row">
              <div class="col-6">
                <div class="input-group input-group-outline col-6">
                  <input type="text" class="form-control" placeholder="search by device name or device tag ID..." id="searchUnregisteredDevices">
                </div>
              </div>
            </div>
          </div>
          <div class="card-body  pt-3 p-3 overflow-auto"  style="max-height: 500px;">
            <ul class="list-group ">
              <div class="row"  id="displayUnregisteredDevices">
                <!-- RUN AJAX code -->
              </div>
            <ul>
          </div>
        </div>
      </div>
    </div>

    <?php
    include_once "../class.views/class.dashboard-footer.php";
    ?>