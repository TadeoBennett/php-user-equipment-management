<?php

// -----------------------------FUNCTIONS TO SIGN UP USER-------------------------------//
//returns true if employee id is valid
function validateEmployeeId($employeeid){
  if(strlen($employeeid) < 4 || strlen($employeeid) > 4){
    return false;
  }
  return true;
}

//returns true if first/lastname is valid
function validateFirstName($firstname)
{

  if (empty($firstname) || trim($firstname) == "") {
    return false;
  }
  return true;
}


function validateLastName($lastname)
{
  if (empty($lastname)  || trim($lastname) == "") {
    return false;
  }
  return true;
}

//returns a new username
function makeUsername($firstname, $lastname)
{
  $username = $firstname[0];
  $username .= $lastname;
  return $username;
}

//return true if email is valid
function validateSignUpEmail($email)
{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false; //email invalid
  } else {
    return true; //email valid
  }
}

//returns true if the password and repeated passwords are the same(valid)
function validateSignUpPasswords($password, $passwordRepeated)
{
  if ($password != $passwordRepeated) {
    return false;
  } else {
    return true;
  }
}

//return true if the password length is valid
function validatePasswordLength($password)
{
  if (strlen($password) < 8 || strlen($password) > 20) {
    return false;
  } else {
    return true;
  }
}

//returns a randomly generated string of characters
function generatePassword(): string
{
  $keyspace = '!@#$%*abcdefghijklmnopqrstuvwxyz1234567890';
  $length = 10;
  $newPassword = '';
  $keysize = strlen($keyspace) - 1;
  for ($i = 0; $i < $length; ++$i) {
    $newPassword .= $keyspace[random_int(0, $keysize)]; //securely gets random values
  }
  return $newPassword;
}

//returns false if the email is unique
function emailExists($conn, $email)
{
  $sql = "SELECT * FROM users WHERE email = ? && Status = 1;"; //uses prepared statements
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    $result = "stmterror";
    return $result;
  }
  mysqli_stmt_bind_param($stmt, "s", $email);
  if (!($stmt->execute())) { 
    return "stmterror";
  }

  $resultData = mysqli_stmt_get_result($stmt);
  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row; //an email already exists
  } else {
    return false; //it is unique and can be added to the DB
  }
  mysqli_stmt_close($stmt);
}


//returns true if the asset tag exists 
function tagExists($conn, $device_asset_tag)
{
  $sql = "SELECT Device_AssetTag_id FROM `asset tags` WHERE Device_AssetTag_id = ?;"; //uses prepared statements
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    $result = "stmterror";
    return $result;
  }
  mysqli_stmt_bind_param($stmt, "i", $device_asset_tag);
  if (!($stmt->execute())) { 
    return "stmterror";
  }

  $resultData = mysqli_stmt_get_result($stmt);
  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row; //an asset tag exists
  } else {
    return false; //asset tag is unique
  }
  mysqli_stmt_close($stmt);
}

function addAssetTag($conn, $device_asset_tag){
  $sql = "INSERT INTO `asset tags` VALUES (?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "stmterror";
  }
  mysqli_stmt_bind_param($stmt, "i", $device_asset_tag);
  if (!($stmt->execute())) { 
    echo "stmterror";
  }
  mysqli_stmt_close($stmt);
}

//returns "success" if a user is successfully created
function signUp($conn, $employeeid, $username, $firstname, $lastname, $email, $department_id, $job_title, $sex, $user_level, $password, $status)
{
  $sql = "INSERT INTO `Users` (Users_id, Employee_id, User_name, First_name, Last_name, Email, Department_id, Job_Title, Sex, User_level_id, Password, Status) VALUES(DEFAULT,?,?,?,?,?,?,?,?,?,?,?);";
  //INSERT INTO Users (User_name, First_name, Last_name, Email, Department_id, Job_Title, Sex, User_level_id, Password, Status) VALUES("JDoe", "John", "Doe", "johndoe@gmail.com", 2, "Director of Issues", "M", 2, "$2y$10$v0WzraBnOkxkcrf/AVloGurk71/9gy9nz4HMUdSIFw1AEmAd/OHk6", 1);
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    $result = "stmterror";
    return $result;
  }
  $password = password_hash($password, PASSWORD_DEFAULT);
  mysqli_stmt_bind_param($stmt, "issssissisi", $employeeid, $username, $firstname, $lastname, $email, $department_id, $job_title, $sex, $user_level, $password, $status);
  if (!($stmt->execute())) { 
    return "stmterror";
  }
  mysqli_stmt_close($stmt);
  $result = "success";
  return $result;
}

// -----------------------------FUNCTIONS TO SIGN IN USER-------------------------------//

//returns true if email input is valid
function validateSignInEmail($email)
{
  return validateSignUpEmail($email);
}

//returns "success" if user login details are valid
function signIn($conn, $email, $password)
{
  $databaseRecord = emailExists($conn, $email);
  if ($databaseRecord == false) { //if email does not exist
    return "emailError";
  }

  if (password_verify($password, $databaseRecord["Password"]) === false) {
    //if the password does not match with the password in database record
    return "passwordMatchError";
  } else {
    if (session_status() == PHP_SESSION_NONE) { //check if session was already started
      session_start();
    }
    $_SESSION["userRecord"] = $databaseRecord;

    return "success";
  }
}

// -----------------------------FUNCTIONS TO ADD A DEVICE AND UPDATE ASSET TAG-------------------------------//

//returns the appropriate file name given a registrant/user ID
function makeFileName($conn, $device_registrantID, $device_asset_tag){
  $sql = "SELECT Employee_id, First_name, Last_name FROM Users WHERE Users_id = " . $device_registrantID;
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      //make the filename with the names selected
      $row = mysqli_fetch_assoc($result);
      $filename = makeUsername($row["First_name"], $row["Last_name"]);
      $filename .=  "_" . $row["Employee_id"] . "_" . $device_asset_tag . "_"  . "Form";
      return $filename;
  }else{
      $filename = "unknownForm";
      return $filename;
  }
}

//return "success" if the device has been added
function addDevice($conn, $device_type, $date_received, $device_name, $device_asset_tag, $device_registerflag, $device_date_assigned, $filename, $device_yearswarranty, $device_registrantID, $status){

  $sql = "INSERT INTO `Devices` (Device_id, Device_Type_id, Device_date_received, Device_name, Device_AssetTag_id, Device_registerflag, Device_assignment_date, Device_form_name, Device_yearswarranty, User_id, Status) VALUES (DEFAULT,?,?,?,?,?,?,?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    $result = "stmterror";
    return $result;
  }
  mysqli_stmt_bind_param($stmt, "issiissiii", $device_type, $date_received, $device_name, $device_asset_tag, $device_registerflag, $device_date_assigned, $filename, $device_yearswarranty, $device_registrantID, $status);
  if (!($stmt->execute())) { 
    return "stmterror";
  }
  mysqli_stmt_close($stmt);

  //create a session variable to store the asset tag ID of the recently added device to be shown to the user on the add device page
  if (session_status() == PHP_SESSION_NONE) { //check if session was already started
    session_start();
  }
  $_SESSION["recently_added_device_id"] = mysqli_insert_id($conn);
  $_SESSION["recently_added_device_tag"] = $device_asset_tag;

  $result = "success";
  return $result;
}

//returns "success" if the computer specs were added for a device successully
function addComputerSpecs($conn, $id, $make, $model, $serial, $processor, $ram, $hdd){

  $sql = "INSERT INTO `computer specs` VALUES (?, ?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    $result = "stmterror";
    return $result;
  }
  mysqli_stmt_bind_param($stmt, "issssss", $id, $make, $model, $serial, $processor, $ram, $hdd);
  if (!($stmt->execute())) { 
    return "stmterror";
  }
  mysqli_stmt_close($stmt);
  $result = "success";
  return $result;
}

//returns "success" if the screen specs were added for a device successully
function addScreenSpecs($conn, $id, $size, $model, $serial){
  $sql = "INSERT INTO `screen specs` VALUES (?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    $result = "stmterror";
    return $result;
  }
  mysqli_stmt_bind_param($stmt, "isss", $id, $size, $model, $serial);
  if (!($stmt->execute())) { 
    return "stmterror";
  }
  mysqli_stmt_close($stmt);
  $result = "success";
  return $result;
}

//returns "success" if the ups specs were added for a device successully
function addUPSSpecs($conn, $id, $model, $serial){

  $sql = "INSERT INTO `ups specs` VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    $result = "stmterror";
    return $result;
  }
  mysqli_stmt_bind_param($stmt, "iss", $id, $model, $serial);
  if (!($stmt->execute())) { 
    return "stmterror";
  }
  mysqli_stmt_close($stmt);
  $result = "success";
  return $result;
}

//Updates the asset tag if one was assigned to a user
function updateAssetTagAvailability($conn, $device_asset_tag){
  //if the asset tag is not 0 then update the availabilty of that asset tag to not available to any device.
  if ($device_asset_tag != 0 || $device_asset_tag != NULL) {
    $sql = "UPDATE `asset tags` SET Device_AssetTag_availability = 0 WHERE Device_AssetTag_id = " . $device_asset_tag . ";";
    if ($conn->query($sql) === true) {
      
      $result = "asset_tag_updated";
      return $result;
    } else {
      
      $result = "asset_tag_update_error"; //. $conn->error;
      return $result;
    }
  }
}

// -----------------------------FUNCTIONS TO EDIT A DEVICE AND EDIT A USER-------------------------------//

//function that returns "success" when successfully setting a device's status to 0
function deleteDeviceWithID($conn, $device_id){
  $sql = "UPDATE devices SET Status = 0 WHERE Device_id = $device_id;";
  if ($conn->query($sql) === true) {
    
    return "success";
  } else {
    
    return "error"; //. $conn->error;
  }
}

//function that returns "success" when successfully setting a user's status to 0
function deleteUserWithID($conn, $user_id){
  $sql = "UPDATE users SET Status = 0 WHERE Users_id = $user_id;";
  if ($conn->query($sql) === true) {
    
    return "success";
  } else {
    
    return "error"; //. $conn->error;
  }
}

//returns "success" if a user's details were successfully edited
function editUserWithID($conn, $user_id_to_edit, $employeeid, $username, $firstname, $lastname, $email, $department_id, $job_title, $sex, $user_level, $password, $passwordChangeFlag){
  if ($passwordChangeFlag == true) { //password was changed 
    $sql = "UPDATE users SET Employee_id = ?, User_name = ?, First_name = ?, Last_name = ?, Email = ?, Department_id = ?,
    Job_Title = ?, Sex = ?, User_level_id = ?, Password = ?  WHERE Users_id = $user_id_to_edit;";
    
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      return "stmterror";
    }

    $password = password_hash($password, PASSWORD_DEFAULT); //hashing new password
    mysqli_stmt_bind_param($stmt, "issssissis", $employeeid, $username, $firstname, $lastname, $email, $department_id, $job_title, $sex, $user_level, $password);
    if ($stmt->execute()) { 
      return "stmterror";
    }
    mysqli_stmt_close($stmt);
    return "success";

  }else{ //password was not changed
    $sql = "UPDATE users SET Employee_id = ?, User_name = ?, First_name = ?, Last_name = ?, Email = ?, Department_id = ?,
    Job_Title = ?, Sex = ?, User_level_id = ? WHERE Users_id = $user_id_to_edit;";
    
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      return "stmterror1";
    }

    mysqli_stmt_bind_param($stmt, "issssissi", $employeeid, $username, $firstname, $lastname, $email, $department_id, $job_title, $sex, $user_level);
    if (!($stmt->execute())) { 
      return "stmterror2";
    }
    mysqli_stmt_close($stmt);

    return "success";
  }
}

//returns "success" if a device's details were successfully edited
function editDeviceWithID($conn, $device_id_to_edit, $device_type, $device_date_received, $device_name, $device_asset_tag, $device_registerflag, $device_date_assigned, $filename, $device_yearswarranty, $device_registrantID){
  $sql = "UPDATE devices SET Device_Type_id = ?, Device_date_received = ?, Device_name = ?, Device_AssetTag_id = ?, 
  Device_registerflag = ?, Device_assignment_date = ?, Device_form_name = ?, Device_yearswarranty = ?, User_id = ?
  WHERE Device_id = $device_id_to_edit;";

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    return "stmterror";
  }

  mysqli_stmt_bind_param($stmt, "issiissii",  $device_type, $device_date_received, $device_name, $device_asset_tag, $device_registerflag, $device_date_assigned, $filename, $device_yearswarranty, $device_registrantID);
  if (!($stmt->execute())) { 
    return "stmterror";
  }
  mysqli_stmt_close($stmt);

  //create the session variable to hold the id of the device to edit
  if (session_status() == PHP_SESSION_NONE) { //check if session was already started
    session_start();
  }
  $_SESSION["recently_added_device_id"] = $device_id_to_edit;

  return "success";
}

//returns the query result(select important details from users table for editing)
function returnUserDetailsArrayForEditing($conn, $user_id){
  $sql = "SELECT Users_id, Employee_id, User_name, First_name, Last_name, Email, Department_id, Job_Title, Sex, User_level_id FROM users WHERE Users_id = $user_id";

  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row;
  }else{
    return false;
  }

}

//returns the query result(select important details from devices table for editing)
function returnDeviceDetailsArrayForEditing($conn, $device_id){
  if($device_id == NULL){
    return false;
  }else{
    $sql = "SELECT Device_id, Device_Type_id, Device_name, Device_AssetTag_id, Device_date_received, Device_assignment_date, Device_yearswarranty, Device_form_name, User_id FROM devices WHERE Device_id = " . $device_id;
  
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row;
    }else{
      return false;
    }
  }

}

//returns query result(all relevant details that belong to each user)
function returnAllUsers($conn){
  $sql = "SELECT Users_id, Employee_id, User_name, First_name, Last_name, Email, Department_id, Job_Title, Sex, User_level_id, CONCAT(First_name, ' ',Last_name) AS full_name FROM users";
  
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return $result;
  }else{
    return false;
  }
}

//returns query result(all relevant details that belong to each device)
function returnAllDevices($conn){
  $sql = "SELECT Device_id, Device_Type_id, Device_name, Device_AssetTag_id, Device_date_received, Device_yearswarranty, Device_form_name, User_id  FROM devices";
  
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return $result;
  }else{
    return false;
  }
}

//returns query result(all from device types: device type id and name)
function returnAllDeviceTypes($conn){
  $sql = "SELECT * FROM `device type` ORDER BY Device_Type_name";
  
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return $result;
  }else{
    return false;
  }
}

//returns query result(device asset tag ids that are available and exists with a status of 1)
// function returnAllAvailableAssetTags($conn){
//   $sql = "SELECT Device_AssetTag_id FROM `asset tags` WHERE Status = 1 && Device_AssetTag_availability = 1 ORDER BY Device_AssetTag_id";
  
//   $result = mysqli_query($conn, $sql);
//   if (mysqli_num_rows($result) > 0) {
//     return $result;
//   }else{
//     return false;
//   }
// }

//returns success if the tagID provided was made available
function makeTagAvailable($conn, $tagID){
  if($tagID == NULL){
    throw new Exception("Exception occured in maketagavailable");
  }
  $sql = "UPDATE `asset tags` SET Device_AssetTag_availability = 1 WHERE Device_AssetTag_id = $tagID;";
  if ($conn->query($sql) === true) {
    
    return "success";
  } else {
    
    return "error"; //. $conn->error;
  }
}

//returns success if the pdfForm was removed from the appropriate directory
function deleteForm($conn, $device_id){
  $sql = "UPDATE devices SET Device_form_name = NULL WHERE Device_id = $device_id";
  if ($conn->query($sql) === true) {
    
    return "success";
  } else {
    
    return "error"; //. $conn->error;
  }
}

//returns the query result and will be turnt rows/array of values after the instance where this function is called
function returnComputerSpecs($conn, $device_id){
  $sql = "SELECT * FROM `computer specs` WHERE Device_id = $device_id";
  
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return $result;
  }else{
    return false;
  }
  
}

//returns the query result and will be turnt rows/array of values after the instance where this function is called
function returnScreenSpecs($conn, $device_id){
  $sql = "SELECT * FROM `screen specs` WHERE Device_id = $device_id";
  
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return $result;
  }else{
    return false;
  }
  
}

//returns the query result and will be turnt rows/array of values after the instance where this function is called
function returnUPSSpecs($conn, $device_id){
  $sql = "SELECT * FROM `ups specs` WHERE Device_id = $device_id";
  
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return $result;
  }else{
    return false;
  }
  
}


//returns "success" after successfully edtiing a specified devices specifications
function editComputerSpecs($conn, $id, $make, $model, $serial, $processor, $ram, $hdd){

  $sql = "UPDATE `computer specs` SET Make = ?, Model = ?, Serial = ?, Processor = ?, RAM = ?, HDD = ? WHERE Device_id = $id;"; //uses prepared statements

  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    throw new Exception("stmt error1 when updating device specs; prepare stmt");
  }
  mysqli_stmt_bind_param($stmt, "ssssss", $make, $model, $serial, $processor, $ram, $hdd);
  if (!($stmt->execute())) { 
    throw new Exception("stmt error2 when updating device specs; binding param");
  }

  mysqli_stmt_close($stmt);
  
  return "success";

}

//returns "success" after successfully edtiing a specified devices specifications
function editScreenSpecs($conn, $id, $size, $model, $serial){
  
  $sql = "UPDATE `screen specs` SET Size = ?, Model = ?, Serial = ? WHERE Device_id = $id;"; //uses prepared statements

  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)){
    throw new Exception("stmt error1 when updating device specs; prepare stmt");
  }
  mysqli_stmt_bind_param($stmt, "sss", $size, $model, $serial);
  if (!($stmt->execute())) { 
    throw new Exception("stmt error2 when updating device specs; binding param");
  }

  mysqli_stmt_close($stmt);
  return "success";
}

//returns "success" after successfully edtiing a specified devices specifications
function editUPSSpecs($conn, $id, $model, $serial){

  $sql = "UPDATE `ups specs` SET Model = ?, Serial = ? WHERE Device_id = $id;"; //uses prepared statements

  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)){
    throw new Exception("stmt error1 when updating device specs; prepare stmt");
  }
  mysqli_stmt_bind_param($stmt, "ss", $model, $serial);
  if (!($stmt->execute())) { 
    throw new Exception("stmt error2 when updating device specs; binding param");
  }

  mysqli_stmt_close($stmt);
  return "success";
}


































// -----------------------------ON PAGE FUNCTIONS-------------------------------//

//returns array of all department names
function returnDepartmentName($conn, $department_id){
  $sql = "SELECT Department_name FROM departments WHERE Department_id = " . $department_id;
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row["Department_name"];
  }else{
      return "";
  }
}

//returns device details of user with a specific id
function returnCurrentUserDevices_Query($conn, $user_id){
  $sql = "SELECT Device_id, Device_Type_id, Device_date_received, Device_name, Device_AssetTag_id FROM devices WHERE User_id = " . $user_id . "";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      return $result;
  }else{
      return "";
  }
}

//returns an integer count of all users
function returnCountAllUsers($conn){
  $sql_countUsers = "SELECT COUNT(Users_id) AS count FROM users WHERE Status = 1;";
  $result = mysqli_query($conn, $sql_countUsers);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row["count"];
  }else{
    return "####";
  }
}

//returns an integer count of all device types
function returnCountAllDeviceTypes($conn){
  $sql_countDeviceTypes = "SELECT COUNT(Device_Type_id) AS count FROM `device type`;";
  $result = mysqli_query($conn, $sql_countDeviceTypes);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row["count"];
  }else{
    return "####";
  }
}

//returns an integer count of all registered devices
function returnCountAllRegisteredDevices($conn)
{
  $sql_countRegisteredDevices = "SELECT COUNT(Device_Type_id) AS count FROM `devices` WHERE Device_registerflag = 1 && Status = 1;";
  $result = mysqli_query($conn, $sql_countRegisteredDevices);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row["count"];
  } else {
    return "####";
  }
}

//returns an integer count of all registered devices
function returnCountAllUnregisteredDevices($conn)
{
  $sql_countUnregisteredDevices = "SELECT COUNT(Device_Type_id) AS count FROM `devices` WHERE Device_registerflag = 0 OR Device_registerflag = NULL  && Status = 1;";
  $result = mysqli_query($conn, $sql_countUnregisteredDevices);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row["count"];
  } else {
    return "####";
  }
}

//returns an integer count of all registered devices for a specific user
function returnCountUserRegisteredDevices($conn, $userid){
  $sql_countUserRegisteredDevices = "SELECT COUNT(Device_Type_id) AS count FROM `devices` WHERE Device_registerflag = 1 && User_id = $userid  && Status = 1;";
  
  $result = mysqli_query($conn, $sql_countUserRegisteredDevices);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row["count"];
  } else {
    return "None";
  }
}











