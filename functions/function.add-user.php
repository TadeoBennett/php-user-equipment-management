<?php
if(isset($_POST["add-user-submit"])){
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
    $repeatpassword = $_POST["repeatpwd"];
    $user_level = 2; //every user signing up is a basic user(everyone); not an admin
    $status = 1; //user exists
    
    if (session_status() == PHP_SESSION_NONE) { //check if session was already started
      session_start();
    }

  //validate employee id
  if(!validateEmployeeId($employeeid)){
    $_SESSION["failure"]["description"] = "staffID-adduser-error";
    header("Location: ../views/view.add-user.php?toolong");
    exit();
  }

  //validate firstname and lastname
  if(!validateFirstname($firstname) ||  !validateLastName($lastname)){
    $_SESSION["failure"]["description"] = "names-adduser-error";
    header("Location: ../views/view.add-user.php");
    exit();
  }

  //make username
  $username = makeUsername($firstname, $lastname);

  //check if email exists
  if(emailExists($conn, $email)){
    $_SESSION["failure"]["description"] = "email-exists-adduser-error";
    //email should not be added if it exists
    header("Location: ../views/view.add-user.php");
    exit();
  }

  //check if password is the right length
  if(!validatePasswordLength($password)){
    $_SESSION["failure"]["description"] = "password-length-adduser-error";
    //email should not be added if it exists
    header("Location: ../views/view.add-user.php");
    exit();
  }

  //check if password is valid
  if(!validateSignUpPasswords($password, $repeatpassword)){
    $_SESSION["failure"]["description"] = "password-repeat-adduser-error";
    header("Location: ../views/view.add-user.php");
    exit();
  }

    //----------------user has no erros in their inputs----------------//
    $userCreation = signUp($conn, $employeeid, $username, $firstname, $lastname, $email, $department_id, $job_title, $sex, $user_level, $password, $status);

    if ($userCreation == "stmterror") {
      $_SESSION["failure"]["description"] = "stmt-adduser-error";
      header("Location: ../views/view.add-user.php?error=stmtFailed");
      exit();
    } else if ($userCreation == "success") {
      $_SESSION["success"]["description"] = "adduser-add-success";
      header("Location: ../views/view.add-user.php");
      exit();
    }
  
    //USER ADDED TO DATABASE

}else{
    header("Location: ../views/view.tables.php");
    exit();
}