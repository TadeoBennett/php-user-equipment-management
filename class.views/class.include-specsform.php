<?php   
if (session_status() == PHP_SESSION_NONE) { //check if session was already started
  session_start();
}
$intentionToEdit = false;
if(isset($_SESSION["deviceEditDetails"]) && $_SESSION["currentPage"] == "edit-device"){
  $intentionToEdit = true;
} 

?>


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
                <input id="inputSize" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Size..." name="size" value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Size"];}  ?>">
                <label for="inputModel">Model</label>
                <input id="inputModel" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Model..." name="screen_model" value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Model"];}  ?>">
                <label for="inputSerial">Serial</label>
                <input id="inputSerial" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Serial..." name="screen_serial" value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Serial"];}  ?>">
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
                <input id="inputMake" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Make..." name="make" value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Make"];}  ?>">
                <label for="inputModel">Model</label>
                <input id="inputModel" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Model..."  name="comp_model" value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Model"];}  ?>">
                <label for="inputSerial">Serial</label>
                <input id="inputSerial" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Serial..." name="comp_serial" value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Serial"];}  ?>">
                <label for="inputProcessor">Processor</label>
                <input id="inputProcessor" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Processor..." name="processor" value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Processor"];}  ?>">
                <label for="inputRAM">RAM</label>
                <input id="inputRAM" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device RAM..." name="ram" value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["RAM"];}  ?>">
                <label for="inputHDD">HDD</label>
                <input id="inputHDD" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device HDD..." name="hdd" value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["HDD"];}  ?>">
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
                <input id="inputModel" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Model..." name="ups_model" value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Model"];}  ?>">
                <label for="inputSerial">Serial</label>
                <input id="inputSerial" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Serial..." name="ups_serial" value="<?php if($intentionToEdit){echo $_SESSION["deviceEditDetails"]["Serial"];}  ?>">
              </div>
            </div>
          </fieldset>
        </div>