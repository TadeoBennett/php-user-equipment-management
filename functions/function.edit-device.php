<?php
include_once "../functions.php";
include_once "./function.dbh.php";

if (isset($_POST["edit-device-selected"])) {
    if (session_status() == PHP_SESSION_NONE) { //check if session was already started
      session_start();
    }
    
    //uses the ID of the device and the database connection to create and save an array with the device's details
    $_SESSION["deviceEditDetails"] = returnDeviceDetailsArrayForEditing($conn, $_POST["devicechangeID"]);
    if ($_SESSION["deviceEditDetails"] == false) {
        $_SESSION["failure"]["description"] = "editDevice-noarray-error";
        header("Location: ../views/view.edit-device.php");
        exit();
    }else{
      //edit device page form should be accessible
      header("Location: ../views/view.edit-device.php");
      exit();
    }
  
}else if(isset($_POST["delete-device-selected"])){ /////////////////////////////////MUST EDIT TO HANDLE FORM DELETION AND ARCHIVING; ERROR PRONE
    $deviceID = $_POST["devicechangeID"];
    $deviceTagID = $_POST["deviceTagID"];

    //uses the ID of the user and the database connection to delete the user
    deleteDeviceWithID($conn, $deviceID);

    //if a device was deleted, check if it had a tag and make that tag available
    try{
        $tagupdated = false;
        if($deviceTagID  != NULL){ //old tag was not null then a tag had existed
            $tagupdated = makeTagAvailable($conn, $deviceTagID);
        }
    }catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

    if ($tagupdated == "success") {
        header("Location: ../views/view.notifications.php?deletesuccess&tagupdated");
        exit();
    }else if ($tagupdated == "error"){
        header("Location: ../views/view.notifications.php?deleteerror");
        exit();
    }else{  
        //tag did not need to be updated because it was not null
        header("Location: ../views/view.notifications.php?deletesuccess&tagnotupdated");
        exit();
    }

  
}else if (isset($_POST["edit-device-submit"])) {
    if (session_status() == PHP_SESSION_NONE) { //check if session was already started
        session_start();
    }

    $device_type = $_POST["devicetype"];
    $device_name = $_POST["devicename"];

    $device_asset_tag = "";
    if(!isset($_POST["asset_tag"])){ //if the asset tag was not set, its because it was already set before
        $device_asset_tag = $_SESSION["deviceEditDetails"]["Device_AssetTag_id"];
    }else{
        $device_asset_tag = $_POST["asset_tag"]; //if the tag was passed then a new tag was entered
    }
    $device_date_received = $_POST["devicedatereceived"];
    $device_registrantID = $_POST["registrant"]; //will get the registrant ID
    $device_yearswarranty = $_POST["yrswt"];

    $deleteDevice = "";
    if(isset($_POST["devicedeleteoption"]) && $_POST["devicedeleteoption"] == "yes"){
            $deleteDevice = "yes";
    }

    $deleteForm = "";
    if(isset($_POST["deleteForm"]) && $_POST["deleteForm"] == "yes"){
            $deleteForm = "yes";
    }

    $currentFileName = "";
    if(isset($_POST["currentFormLocation"])){
        $currentFileName = $_POST["currentFormLocation"];
    }
    $path_filename_ext = ""; //used later to check if this file exists to set the registerflag properly

    $device_date_assigned = ""; //will be assigned later after checking if a date already exists or a user/tagId was changed
    $filename= NULL;
    $form_uploaded = false;
    $device_registerflag = 0;
    $formExists = false;
    $status = 1;

    //check it the option to delete was selected first of all
    if($deleteDevice == "yes"){//////////////////////////////////////////////////////////////////////////////////////////////must CHANGE; ERROR PRONE
        $checkdeletion =  deleteDeviceWithID($conn, $_SESSION["deviceEditDetails"]["Device_id"]);
        if($checkdeletion == "error"){
            $_SESSION["failure"]["description"] = "editDevice-deletedevice-error";
            header("Location: ../views/view.edit-device.php?error");
            exit();
        }else if($checkdeletion == "success"){
            //if a device was deleted and it had a tag, make that tag available
            if($_SESSION["deviceEditDetails"]["Device_AssetTag_id"] != NULL){
                makeTagAvailable($conn, $_SESSION["deviceEditDetails"]["Device_AssetTag_id"]);
            }

            $_SESSION["success"]["description"] = "editDevice-delete-success";
            unset($_SESSION["deviceEditDetails"]); //delete the sesssion variable with the details of the user to edit
            header("Location: ../views/view.notifications.php");
            exit();
        }
    }
    

    //check if the option to delete the existing form was selected
    if($deleteForm == "yes"){
        if (unlink($currentFileName)) { //delete file
            echo ''; //do nothing and continue
        } else {
            echo 'There was a error deleting the file ' . $filename;
        }

        deleteForm($conn, $_SESSION["deviceEditDetails"]["Device_id"]); //sets the deviceformname as NULL in the database
    }


    //if these variables are 0, place them as null in the DB
    if($device_yearswarranty == 0){$device_yearswarranty = NULL;}
    if($device_registrantID == 0){$device_registrantID = NULL;}
    if($device_asset_tag == 0 || empty($device_asset_tag) || trim($device_asset_tag) == ""){$device_asset_tag = NULL;}else{
        //an asset tag was read

        if($_SESSION["deviceEditDetails"]["Device_AssetTag_id"]){ //if the asset tag is the same as the asset tag read from the database
            //do nothing and leave the asset tag
        }else{
            //the asset tag is different from the asset tag gotten from the database

            //check if the asset tag exists
            $tagExists = tagExists($conn, $device_asset_tag);
            
            if($tagExists != false){ //if it exists redirect back to edit-device page
                $_SESSION["failure"]["description"] = "editDevice-tagexists-error";
                header("Location: ../views/view.edit-device.php");
                exit();
            }else{ //if it does not exist then add that asset tag
                addAssetTag($conn, $device_asset_tag);
            }
        }
    }


    //if the file input is not empty and a person was specified to give this device to
    if (!($_FILES['registrant-form']['size'] == 0) && !is_null($device_registrantID) && !is_null($device_asset_tag)) {
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
            $formExists = true;
        }
    }
    
    //if user was assigned, asset tag was assigned 
    if ($device_registrantID != NULL && $device_asset_tag != NULL) {

        //check if the file exists in the database
        $filename = makeFileName($conn, $device_registrantID, $device_asset_tag);
        $target_dir = "../includes/pdfForms/";
        //if a form exists with a matching id and asset tag number or a file was uploaded
        if (file_exists($target_dir.$filename.'.pdf') || $formExists == true) {
            $device_registerflag = 1; //device was registered with an asset tag and user
        }else{
            $filename = NULL;
        }
    }

    try{ //attempt to edit the assigned date

        if (is_null($_SESSION["deviceEditDetails"]["User_id"]) && !is_null($device_registrantID)) { //if no user was assigned to this device before and a new user was assigned
            $device_date_assigned = $_POST["currentDate"]; //save the currentDate for new assignment
        }else if($device_registrantID != $_SESSION["deviceEditDetails"]["User_id"]){ //if the user assigned to this device was changed
            $device_date_assigned = $_POST["currentDate"]; //renew the assignment date
        }else if(is_null($_SESSION["deviceEditDetails"]["User_id"]) && is_null($device_registrantID)){  //if no user was assigned to this device before and no new user was assigned
            $device_date_assigned = NULL; //no new assigned date
        }else if(!is_null($_SESSION["deviceEditDetails"]["User_id"]) && is_null($device_registrantID)){ //if a new user was assigned before and no new user was assigned
            $device_date_assigned = $_SESSION["deviceEditDetails"]["Device_assignment_date"]; //keep current(old) assigned date
        }else{
            $device_date_assigned = $_POST["currentDate"]; //by default get the current Date
        }
    }catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

    $deviceEdited = editDeviceWithID($conn, $_SESSION["deviceEditDetails"]["Device_id"], $device_type, $device_date_received, $device_name, $device_asset_tag, $device_registerflag, $device_date_assigned, $filename, $device_yearswarranty, $device_registrantID);

    if($deviceEdited == "stmterror"){
        $_SESSION["failure"]["description"] = "stmt0-editDevice-error";
        header("Location: ../views/view.edit-device.php?error=stmt0");
        exit();
    }else if($deviceEdited == "success"){//device has been edited 
        // -------------------- Edit the Device Specs For that specific device type --------------------//
        if (isset($_POST["add-spec-type"]) && $_POST["add-spec-type"] = 1) {  //the device is a laptop or desktop
	    print("Type 1");	
	    exit();
	    $id = NULL;
            if(isset($_SESSION["recently_added_device_id"])){
                $id = $_SESSION["recently_added_device_id"];
            }
            $make = $_POST["make"];
            $model = $_POST["model"];
            $serial = $_POST["serial"];
            $processor = $_POST["processor"];
            $ram = $_POST["ram"];
            $hdd = $_POST["hdd"];
            $specsEdited = editComputerSpecs($conn, $id, $make, $model, $serial, $processor, $ram, $hdd);
        }elseif (isset($_POST["add-spec-type"]) && $_POST["add-spec-type"]=2) {  //the device is a monitor
	    print("type 2");	
	    exit();
	    if(isset($_SESSION["recently_added_device_id"])){
                $id = $_SESSION["recently_added_device_id"];
            }
            $size = $_POST["size"];
            $model = $_POST["model"];
            $serial = $_POST["serial"];
            $specsEdited = editScreenSpecs($conn, $id, $size, $model, $serial);
        }elseif (isset($_POST["add-spec-type"]) && $_POST["add-spec-type"]=3) { //the device is a UPS
	    print("type 3");
            exit();
	    if(isset($_SESSION["recently_added_device_id"])){
                $id = $_SESSION["recently_added_device_id"];
            }
            $model = $_POST["model"];
            $serial = $_POST["serial"];
            $specsEdited = editUPSSpecs($conn, $id, $model, $serial);
        }
        //--------------------- Done Editing the Device Specs --------------------------//

    }

    $_SESSION["success"]["description"] = "editdevice-edit-success";
    unset($_SESSION["deviceEditDetails"]);
    header("Location: ../views/view.tables.php");
    exit();

    // DEVICE HAS BEEN EDITED ON DATABASE (AN OWNER MAY OR MAY NOT HAVE BEEN CHOSEN)

}else if(isset($_POST["cancel-edit-device-submit"])){
    if (session_status() == PHP_SESSION_NONE) { //check if session was already started
        session_start();
    }
    unset($_SESSION["deviceEditDetails"]);
    header("Location: ../views/view.edit-device.php?deletedEditKey");
    exit();
}else{
    header("Location: ../views/view.edit-device.php");
    exit();
}
