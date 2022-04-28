<?php
//session variable should exist since it was checked before including this page
$devicetype_id = $_SESSION["deviceEditDetails"]["Device_Type_id"];
$device_id = $_SESSION["deviceEditDetails"]["Device_id"];
// $getScreenSpecs = false;
// $getComputerSpecs = false;
// $getUPSSpecs = false;
switch($devicetype_id){
    case 1:     //monitor
        $getScreenSpecs = returnScreenSpecs($conn, $device_id);
        break;
    case 2:     //laptops
        $getComputerSpecs = returnComputerSpecs($conn, $device_id);
        break;
    case 3:     //desktops
        $getComputerSpecs = returnComputerSpecs($conn, $device_id);
        break;
    case 4:     //UPS
        $getUPSSpecs = returnUPSSpecs($conn, $device_id);
        break;
    default:
        //exit loading this page if the device does not have specs to edit(does not have id 1,2,3 or 4)
}
$make = "";
$model = "";
$serial = "";
$processor = "";
$ram = "";
$hdd = "";
$size = "";

?>

<?php  if($devicetype_id == 1 || $devicetype_id == 2 || $devicetype_id == 3 || $devicetype_id == 4){  ?>

<div class="col-lg-4 mt-3">
      <fieldset id="device-edit-add-specs">
        <div class="card">
          <legend>
            <h5 class="card-header"><u>Edit</u> Device <u>Specifications</u></h5>
          </legend>
          <div class="card-body pt-0">
            <input type="text" hidden value="<?php echo $device_id ?>" name="id">
            <?php
            if(isset($getScreenSpecs)){
              if ($getScreenSpecs == false) { //no values were returned so default all to NULL
                $size = NULL;
                $model = NULL;
                $serial = NULL;
              }else{
                $specs = mysqli_fetch_assoc($getScreenSpecs);
                $size = $specs["Size"];
                $model = $specs["Model"];
                $serial = $specs["Serial"];
              }
              echo '
                <input type="text" hidden name="add-screen-specs" value="1">
                <label for="inputSize">Size</label>
                <input id="inputSize" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Size..." value="'. $size .'" name="size">
                <label for="inputModel">Model</label>
                <input id="inputModel" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Model..." value="'. $model .'" name="model">
                <label for="inputSerial">Serial</label>
                <input id="inputSerial" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Serial..." value="'. $serial .'" name="serial">
              ';

            }elseif(isset($getComputerSpecs)){
              if ($getComputerSpecs == false) { //no values were returned so default all to NULL
                $make = NULL;
                $model = NULL;
                $serial = NULL;
                $processor = NULL;
                $ram = NULL;
                $hdd = NULL;
              }else{
                $specs = mysqli_fetch_assoc($getComputerSpecs);
                $make = $specs["Make"];
                $model = $specs["Model"];
                $serial = $specs["Serial"];
                $processor = $specs["Processor"];
                $ram = $specs["RAM"];
                $hdd = $specs["HDD"];
              }
              
              echo '
                <input type="text" hidden name="add-computer-specs" value="1">
                <label for="inputMake">Make</label>
                <input id="inputMake" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Make..." value="'. $make .'" name="make">
                <label for="inputModel">Model</label>
                <input id="inputModel" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Model..." value="'. $model .'" name="model">
                <label for="inputSerial">Serial</label>
                <input id="inputSerial" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Serial..." value="'. $serial .'" name="serial">
                <label for="inputProcessor">Processor</label>
                <input id="inputProcessor" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Processor..." value="'. $processor .'" name="processor">
                <label for="inputRAM">RAM</label>
                <input id="inputRAM" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device RAM..." value="'. $ram .'" name="ram">
                <label for="inputHDD">HDD</label>
                <input id="inputHDD" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device HDD..." value="'. $hdd .'" name="hdd">
              ';
            }elseif(isset($getUPSSpecs)){
              if ($getUPSSpecs == false) { //no values were returned so default all to NULL
                $model = NULL;
                $serial = NULL;
              }else{
                $specs = mysqli_fetch_assoc($getUPSSpecs);
                $model = $specs["Model"];
                $serial = $specs["Serial"];
              }

              echo '
              `<input type="text" hidden name="add-ups-specs" value="1">
                <label for="inputModel">Model</label>
                <input id="inputModel" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Model..." value="'. $model .'" name="model">
                <label for="inputSerial">Serial</label>
                <input id="inputSerial" type="text" class="form-control border-bottom mb-4 p-0" placeholder="Device Serial..." value="'. $serial .'" name="serial">
              ';
            }
            ?>
          </div>
        </div>
      </fieldset>
    </div>

<?php }  ?>
