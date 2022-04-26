<?php
if(isset($_POST["sign-in-submit"])){
  require_once '../functions.php';
  require_once './function.dbh.php';

  $email = $_POST["em"];
  $password = $_POST["pwd"];

  //function does a check on email and password
  $userSignIn = signIn($conn, $email, $password);

  if (session_status() == PHP_SESSION_NONE) { //check if session was already started
    session_start();
  }
  
  if($userSignIn == "emailError"){
    $_SESSION["failure"]["description"] = "email-signin-error";
    header("Location: ../views/view.sign-in.php");
    exit();
  }else if($userSignIn == "passwordMatchError"){
    $_SESSION["failure"]["description"] = "password-signin-error";
    header("Location: ../views/view.sign-in.php");
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



