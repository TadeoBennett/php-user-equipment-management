<?php
if(isset($_POST["edit-user-selected"])){
  require_once '../functions.php';
  require_once './function.dbh.php';
  if (session_status() == PHP_SESSION_NONE) { //check if session was already started
    session_start();
  }

  //uses the ID of the user and the database connection to create and save an array with the user's details
  $_SESSION["userEditDetails"] = returnUserDetailsArrayForEditing($conn, $_POST["userchangeID"]);
  if ($_SESSION["userEditDetails"] == false) {
    header("Location: ../views/view.edit-user.php?error=noarray");
    exit();
  }else{
    //edit user page form should be accessible
    header("Location: ../views/view.edit-user.php");
    exit();
  }


}else if(isset($_POST["delete-user-selected"])){
  require_once '../functions.php';
  require_once './function.dbh.php';
  //uses the ID of the user and the database connection to delete the user
  deleteUserWithID($conn, $_POST["userchangeID"]);

  header("Location: ../views/view.notifications.php?deletesuccess");
  exit();

}else if(isset($_POST["edit-user-submit"])){
  require_once '../functions.php';
  require_once './function.dbh.php';

  $employeeid = $_POST["id"];
  $firstname = $_POST["fn"];
  $lastname = $_POST["ln"];
  $job_title = $_POST["jt"];
  $department_id = $_POST["dpt"];
  $email = $_POST["em"];
  $sex = $_POST["sex"];
  $password = $_POST["pwd"];
  $makeadmin = $_POST["makeadmin"];
  $deleteUser = "";
  if(isset($_POST["dltuseroption"])){
    $deleteUser = $_POST["dltuseroption"];
  }
  $user_level = NULL; //will be changed later

  if (session_status() == PHP_SESSION_NONE) { //check if session was already started
    session_start();
  }

  //check if the option to delete was selected first of all
  if($deleteUser == "yes"){
    $checkdeletion =  deleteUserWithID($conn, $_SESSION["userEditDetails"]["Users_id"]);
    if($checkdeletion == "error"){
        header("Location: ../views/view.notifications.php?deleteerror");
        exit();
    }else if($checkdeletion == "success"){
        unset($_SESSION["userEditDetails"]); //delete the sesssion variable with the details of the user to edit
        header("Location: ../views/view.notifications.php?deletesuccess");
        exit();
    }
  }

  //changing to the appropriate user level wanted
  if($makeadmin == "yes"){
    $userLevel = 1;
  }else{
    $userLevel = 2;
  }

  //validate employee id
  if(!validateEmployeeId($employeeid)){
    header("Location: ../views/view.add-user.php?error=invalidID");
    exit();
  }

  //validate firstname and lastname
  if(!validateFirstname($firstname) ||  !validateLastName($lastname)){
    header("Location: ../views/view.add-user.php?error=emptyNameFields");
    exit();
  }

  //make username
  $username = makeUsername($firstname, $lastname);

  $passwordChangeFlag = false;

  if(strlen($password) != 0){ //a new password was entered so check its validity
    //check if password is the right length
    if(!validatePasswordLength($password)){
      //email should not be added if it exists
      header("Location: ../views/view.edit-user.php?error=passwordLengthError");
      exit();
    }
    $passwordChangeFlag = true;
  }

    //----------------user has no erros in their inputs----------------//
    $userEdit = editUserWithID($conn, $_SESSION["userEditDetails"]["Users_id"], $employeeid, $username, $firstname, $lastname, $email, $department_id, $job_title, $sex, $userLevel, $password, $passwordChangeFlag);

    if ($userEdit == "stmterror") {
      header("Location: ../views/view.notifications.php?error=stmtFailed");
      exit();
    } else if ($userEdit == "success") {
      unset($_SESSION["userEditDetails"]);
      header("Location: ../views/view.notifications.php?edituser=success");
      exit();
    }else if ($userEdit == "stmterror1") {
      header("Location: ../views/view.notifications.php?error=stmtFailed1");
      exit();
    } else if ($userEdit == "stmterror2") {
      header("Location: ../views/view.notifications.php?error=stmtFailed2");
      exit();
    }
  
    //USER EDITED ON DATABASE

}else if(isset($_POST["cancel-edit-user-submit"])){ // the cancel button on the edit user form is pressed
  if (session_status() == PHP_SESSION_NONE) { //check if session was already started
    session_start();
  }
  unset($_SESSION["userEditDetails"]);
  header("Location: ../views/view.edit-user.php?deletedEditKey");
  exit();
}else{
  header("Location: ../views/view.edit-user.php?default");
  exit();
}