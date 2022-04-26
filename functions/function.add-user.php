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

  //check if email exists
  if(emailExists($conn, $email)){
    //email should not be added if it exists
    header("Location: ../views/view.add-user.php?error=emailExists");
    exit();
  }

  //check if password is the right length
  if(!validatePasswordLength($password)){
    //email should not be added if it exists
    header("Location: ../views/view.add-user.php?error=passwordLengthError");
    exit();
  }

  //check if password is valid
  if(!validateSignUpPasswords($password, $repeatpassword)){
    header("Location: ../views/view.add-user.php?error=passwordDontMatch");
    exit();
  }

    //----------------user has no erros in their inputs----------------//
    $userCreation = signUp($conn, $employeeid, $username, $firstname, $lastname, $email, $department_id, $job_title, $sex, $user_level, $password, $status);

    if ($userCreation == "stmterror") {
      header("Location: ../views/view.notifications.php?error=stmtFailed");
      exit();
    } else if ($userCreation == "success") {
      header("Location: ../views/view.notifications.php?addeduser=success");
      exit();
    }
  
    //USER ADDED TO DATABASE

}else{
    header("Location: ../views/view.tables.php");
    exit();
}