<?php
if(isset($_POST["sign-up-submit"])){
  require_once '../functions.php';
  require_once './function.dbh.php';

  //saving variables from the sign up from
  $employeeid = $_POST["id"];
  $firstname = $_POST["fn"];
  $lastname = $_POST["ln"];
  $job_title = $_POST["jobtitle"];
  $department_id = $_POST["dpt"];
  $email = $_POST["em"];
  $sex = $_POST["sex"];
  $password = $_POST["pwd"];
  $passwordRepeated = $_POST["repeatpwd"];
  $user_level = 2; //every user signing up is a basic user(everyone); not an admin
  $status = 1; //user exists
  
  if (session_status() == PHP_SESSION_NONE) { //check if session was already started
    session_start();
  }

  //validate employee id
  if(!validateEmployeeId($employeeid)){
    $_SESSION["failure"]["description"] = "staffID-signup-error";
    header("Location: ../views/view.sign-up.php");
    exit();
  }

  //validate firstname and lastname
  if(!validateFirstname($firstname) ||  !validateLastName($lastname)){
    $_SESSION["failure"]["description"] = "names-signup-error";
    header("Location: ../views/view.sign-up.php");
    exit();
  }

  //make username
  $username = makeUsername($firstname, $lastname);

  //check if email exists
  if(emailExists($conn, $email)){
    $_SESSION["failure"]["description"] = "email-exists-signup-error";
    //email should not be added if it exists
    header("Location: ../views/view.sign-up.php");
    exit();
  }

  //check if password is the right length
  if(!validatePasswordLength($password)){
    $_SESSION["failure"]["description"] = "password-length-signup-error";
    header("Location: ../views/view.sign-up.php");
    exit();
  }

  //check if password is valid
  if(!validateSignUpPasswords($password, $passwordRepeated)){
    $_SESSION["failure"]["description"] = "password-repeat-signup-error";
    header("Location: ../views/view.sign-up.php");
    exit();
  }

  //----------------user has no erros in their inputs----------------//
  $userCreation = signUp($conn, $employeeid, $username, $firstname, $lastname, $email, $department_id, $job_title, $sex, $user_level, $password, $status);

  if ($userCreation == "stmterror") {
    $_SESSION["failure"]["description"] = "stmt-signup-error";
    header("Location: ../views/view.sign-up.php");
    exit();
  } else if ($userCreation == "success") {
    $_SESSION["success"]["description"] = "user-signup-sucess";
    header("Location: ../views/view.sign-in.php");
    exit();
  }

  //USER ADDED TO DATABASE

}else{
  header("Location: ../views/view.sign-up.php");
  exit();
}