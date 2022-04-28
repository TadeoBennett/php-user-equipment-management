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
    $_SESSION["failure"]["description"] = "edituser-noarray-error";
    header("Location: ../views/view.tables.php");
    exit();
  }else{
    //edit user page form should be accessible
    header("Location: ../views/view.edit-user.php");
    exit();
  }


}else if(isset($_POST["delete-user-selected"])){
  require_once '../functions.php';
  require_once './function.dbh.php';

  if (session_status() == PHP_SESSION_NONE) { //check if session was already started
    session_start();
  }

  //uses the ID of the user and the database connection to delete the user
  deleteUserWithID($conn, $_POST["userchangeID"]);

  $_SESSION["success"]["description"] = "edituser-delete-success";
  header("Location: ../views/view.tables.php");
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
  $makeadmin = "";
  if(isset($_POST["makeadmin"])){
    if($_POST["makeadmin"] == "yes"){
      $makeadmin = "yes";
    }
  }
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
        $_SESSION["failure"]["description"] = "edituser-deleteuser-error";
        header("Location: ../views/view.edit-user.php");
        exit();
    }else if($checkdeletion == "success"){
        $_SESSION["success"]["description"] = "edituser-delete-success";
        unset($_SESSION["userEditDetails"]); //delete the sesssion variable with the details of the user to edit
        header("Location: ../views/view.tables.php");
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
    $_SESSION["failure"]["description"] = "staffID-edituser-error";
    header("Location: ../views/view.edit-user.php");
    exit();
  }

  //validate firstname and lastname
  if(!validateFirstname($firstname) ||  !validateLastName($lastname)){
    $_SESSION["failure"]["description"] = "names-edituser-error";
    header("Location: ../views/view.edit-user.php");
    exit();
  }

  //make username
  $username = makeUsername($firstname, $lastname);

  $passwordChangeFlag = false;

  if(strlen($password) != 0){ //a new password was entered so check its validity
    //check if password is the right length
    if(!validatePasswordLength($password)){
      $_SESSION["failure"]["description"] = "password-length-edituser-error";
      //email should not be added if it exists
      header("Location: ../views/view.edit-user.php");
      exit();
    }
    $passwordChangeFlag = true;
  }

    //----------------user has no erros in their inputs----------------//
    $userEdit = editUserWithID($conn, $_SESSION["userEditDetails"]["Users_id"], $employeeid, $username, $firstname, $lastname, $email, $department_id, $job_title, $sex, $userLevel, $password, $passwordChangeFlag);

    if ($userEdit == "stmterror") {
      $_SESSION["failure"]["description"] = "stmt0-edituser-error";
      header("Location: ../views/view.edit-user.php?error=stmtFailed");
      exit();
    } else if ($userEdit == "success") {
      $_SESSION["success"]["description"] = "edituser-edit-success";
      unset($_SESSION["userEditDetails"]);
      header("Location: ../views/view.tables.php");
      exit();
    }else if ($userEdit == "stmterror1") {
      $_SESSION["failure"]["description"] = "stmt1-edituser-error";
      header("Location: ../views/view.edit-user.php?error=stmtFailed1");
      exit();
    } else if ($userEdit == "stmterror2") {
      $_SESSION["failure"]["description"] = "stmt2-edituser-error";
      header("Location: ../views/view.edit-user.php?error=stmtFailed2");
      exit();
    }else if ($userEdit == "stmterror3") {
      $_SESSION["failure"]["description"] = "stmt3-edituser-error";
      header("Location: ../views/view.edit-user.php?error=stmtFailed3");
      exit();
    }
  
    //USER EDITED ON DATABASE

}else if(isset($_POST["cancel-edit-user-submit"])){ // the cancel button on the edit user form is pressed
  if (session_status() == PHP_SESSION_NONE) { //check if session was already started
    session_start();
  }
  unset($_SESSION["userEditDetails"]);
  header("Location: ../views/view.edit-user.php");
  exit();
}else{
  header("Location: ../views/view.edit-user.php");
  exit();
}