<?php 
$intentionToEdit = false;
if(isset($_SESSION["deviceEditDetails"]) && $_SESSION["currentPage"] == "edit-device"){
  $intentionToEdit = true;
} 
?>        
         <div class="row mx-2 mb-4">
            <div class="form-group col-md-4 mb-4">
              <label for="deviceType">Device Type</label>
              <?php
                include_once "../class.views/class.selectInput-DeviceType.php";
              ?>
            </div>
            <div class="form-group col-md-4 mb-4">
              <label for="inputDVN">Device Name</label>
              <input type="text" class="form-control border-bottom" id="inputDVN" placeholder="device name..." name="devicename" required
              value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Device_name"];}?>">
            </div>
            <div class="form-group col-md-4 mb-4">
              <label for="inputTAG">Asset Tag #</label>
              <input type="text" class="form-control border-bottom" id="inputTAG" placeholder="device tag id..." name="asset_tag"
              value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Device_AssetTag_id"];}?>"
              <?php if($intentionToEdit){if($_SESSION["deviceEditDetails"]["Device_AssetTag_id"] != NULL){echo ' disabled ';}} //disable inputting tags if one exists on this device?>
              >
            </div>
          </div>

          <div class="row mx-2 mb-4">
            <div class="form-group col-md-4 mb-4">
              <label for="inputDTR" class="form-label">Date Received</label>
              <input type="date" class="form-control border-bottom" id="inputDTR" placeholder="date received..." name="devicedatereceived" required
              value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Device_date_received"];}?>">
            </div>
            <div class="form-group col-md-4 mb-4">
              <label for="Users" class="form-label">Register this device to:</label>
              <?php
                include_once "../class.views/class.selectInput-Registrant.php";
              ?>
              <input type="date" name="currentDate" value="<?php echo date('Y-m-d'); ?>" hidden>
            </div>
            <div class="form-group col-md-4 mb-4">
              <label for="yearsWarranty" class="form-label">Years Warrantee</label><br>
              <div class="col-4">
                <input type="number" title=" " min="0" max="10" id="yearsWarranty" name="yrswt" class="form-control border p-2"  placeholder="0-10"
                value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Device_yearswarranty"];}?>">
              </div>
            </div>
          </div>
        
          <div class="row mx-2 mb-4">
            <div class="form-group col-md-4 mb-5">
              <?php
                include_once "../class.views/class.form-options.php";
              ?>
            </div>
            <div class="col-md-4 mb-4 form-check form-switch mx-3" id="deletedeviceoption">
              <br>
              <input type="checkbox" id="deleteOption" name="devicedeleteoption" value="yes" class="form-check-input">
              <!-- present messagebox to ensure the user confirms to delete -->
              <label for="deleteOption" class="form-check-label text-lg mx-2"><u><strong>Delete</strong></u> this device? </label><br>
            </div>
          </div>

          <div class="row mx-2 mb-4">
            <div class="form-group col-md-6 mb-4" id="helpfulinfo">
              <p>If the device is not registered to any user, you can do so later by going to the <u><a href="./view.tables.php#unregistered_devices-table">unregistered devices table</a></u> and finding the device using the ID below:</p>
              <p>Device Number ID of the recently added device: 
                <?php   
                  if (isset($_SESSION["recently_added_device_tag"])) {
                    echo $_SESSION["recently_added_device_tag"];
                  }else{
                    echo '####';
                  }
                ?></p>
            </div>
          </div>