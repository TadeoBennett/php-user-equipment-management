<?php
include_once "../functions.php";
include_once "./function.dbh.php";
if (isset($_POST["add-device-submit"])) {
    $device_type = $_POST["devicetype"];
    $device_name = $_POST["devicename"];
    $device_asset_tag = $_POST["asset_tag"];
    $device_date_received = $_POST["devicedatereceived"];
    $device_yearswarranty = $_POST["yrswt"];
    $device_registrantID = $_POST["registrant"]; //will get the registrant ID
    $device_date_assigned = $_POST["currentDate"];
    $filename= NULL;
    $device_registerflag = 0;
    $status = 1;

    if (session_status() == PHP_SESSION_NONE) { //check if session was already started; I put it again below
        session_start();
    }

    //if these variables are 0, place them as null in the DB
    if($device_yearswarranty == 0){$device_yearswarranty = NULL;}
    if($device_registrantID == 0){$device_registrantID = NULL;}
    if($device_asset_tag == 0 || empty($device_asset_tag) || trim($device_asset_tag) == ""){$device_asset_tag = NULL;}else{
        //check if the asset tag exists
        $tagExists = tagExists($conn, $device_asset_tag);
        
        if($tagExists != false){//if it exists redirect back to add-device page
            $_SESSION["failure"]["description"] = "addDevice-tagexists-error";
            header("Location: ../views/view.add-device.php");
            exit();
        }else{ //if it does not exist then add that asset tag
            addAssetTag($conn, $device_asset_tag);
        }
    }

    if (!($_FILES['registrant-form']['size'] == 0)) { //if the file input is not empty
        //making the appropriate file name
        $filename = makeFileName($conn, $device_registrantID, $device_asset_tag);

        if ($filename == "unknownForm") {
            $filename = NULL;
        }else{
            $target_dir = "../includes/pdfForms/";
            $file = $_FILES['registrant-form']['name'];
            $path = pathinfo($file);
            $ext = $path['extension'];
            $temp_name = $_FILES['registrant-form']['tmp_name'];
            $path_filename_ext = $target_dir.$filename.".".$ext;
            move_uploaded_file($temp_name,$path_filename_ext);

            if ($device_registrantID != NULL && $device_asset_tag != NULL) {
                $device_registerflag = 1; //device was registered with an asset tag and user
            }
        }
    }

    //if device was not registered, do not save the date
    if (is_null($device_registrantID)) {
        $device_date_assigned = NULL;
    }

    $deviceAdded = addDevice($conn, $device_type, $device_date_received, $device_name, $device_asset_tag, $device_registerflag, $device_date_assigned, $filename, $device_yearswarranty, $device_registrantID, $status);
    
    
    if($deviceAdded ==  "stmterror"){
        $_SESSION["failure"]["description"] = "stmt0-addDevice-error";
        header("Location: ../views/view.notifications.php?error=stmterror0");
        exit();
    }else if($deviceAdded == "success"){//device has been added 

        if (session_status() == PHP_SESSION_NONE) { //check if session was already started
            session_start();
        }
        // -------------------- Add the Device Specs For that specific device type --------------------//
        if (isset($_POST["add-spec-type"]) && ($_POST["add-spec-type"] == 2 || $_POST["add-spec-type"] == 3)) {  //the device is a laptop or desktop
	    
	    $id = NULL;
            if(isset($_SESSION["recently_added_device_id"])){
                $id = $_SESSION["recently_added_device_id"];
            }
            $make = $_POST["make"];
            $model = $_POST["comp_model"];
            $serial = $_POST["comp_serial"];
            $processor = $_POST["processor"];
            $ram = $_POST["ram"];
            $hdd = $_POST["hdd"];
            $specsEdited = addComputerSpecs($conn, $id, $make, $model, $serial, $processor, $ram, $hdd);
        }elseif (isset($_POST["add-spec-type"]) && $_POST["add-spec-type"] == 1) {  //the device is a monitor
	    
	    if(isset($_SESSION["recently_added_device_id"])){
                $id = $_SESSION["recently_added_device_id"];
            }
            $size = $_POST["size"];
            $model = $_POST["screen_model"];
            $serial = $_POST["screen_serial"];
            $specsEdited = addScreenSpecs($conn, $id, $size, $model, $serial);
        }elseif (isset($_POST["add-spec-type"]) && $_POST["add-spec-type"] == 4) { //the device is a UPS
	    
	    if(isset($_SESSION["recently_added_device_id"])){
                $id = $_SESSION["recently_added_device_id"];
            }
            $model = $_POST["ups_model"];
            $serial = $_POST["ups_serial"];
            $specsEdited = addUPSSpecs($conn, $id, $model, $serial);
        }
        //--------------------- Done Editing the Device Specs --------------------------//
        
        $_SESSION["success"]["description"] = "addDevice-add-success";
        header("Location: ../views/view.add-device.php");
        exit();
    }


    // DEVICE HAS BEEN ADDED TO DATABASE (AN OWNER MAY OR MAY NOT HAVE BEEN CHOSEN)

}else{
    header("Location: ../views/view.add-device.php");
    exit();
}
