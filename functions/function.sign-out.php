<?php

if(isset($_POST["sign-out-submit"])){
  //delete sessions to remove all session variables
  session_start();
  session_unset();
  session_destroy();
  header("Location: ../views/view.sign-in.php");
  exit(); //stops script from running
}else{
  header("Location: ../views/view.profile.php");
  exit();
}