<?php
$servername = "127.0.0.1";
$dBUsername = "root";
$dBPassword = "";
$dBname = "userdeviceinventory";



$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

