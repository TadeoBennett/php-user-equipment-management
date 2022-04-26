<?php
session_start();
if (isset($_SESSION["userRecord"])){
  if($_SESSION["userRecord"]["User_level_id"] != 1){
    header("Location: ../index.php");
    exit();
  }
}