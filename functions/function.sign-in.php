<?php
if(isset($_POST["sign-in-submit"])){
  require_once '../functions.php';
  require_once './function.dbh.php';

  $email = $_POST["em"];
  $password = $_POST["pwd"];

  session_start();
  if (isset($_SESSION['firstname'])) {
    session_unset();
  }
  session_destroy();

  //function does a check on email and password
  $userSignIn = signIn($conn, $email, $password);

  if($userSignIn == "emailError"){
    header("Location: ../views/view.sign-in.php?error=emailError");
    exit();
  }else if($userSignIn == "passwordMatchError"){
    header("Location: ../views/view.sign-in.php?error=passwordMatchError");
    exit();
  }else if($userSignIn == "success"){
    header("Location: ../index.php?signin=success");
    exit();
  }

  //USER SIGNED IN

} else {
  header("Location: ../views/view.sign-in.php");
  exit();
}



