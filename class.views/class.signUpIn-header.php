<?php
  include "../functions/function.dbh.php";
  if (session_status() == PHP_SESSION_NONE) { //check if session was already started
    session_start();
  }
?>
<!-- be able to use the database connection -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory</title>

  <link rel="icon" type="image/png" href="../images/btb icon.ico">
  <link rel="stylesheet" href="../includes/css/sign-in&sign-up.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- SWEET ALERT -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <div class="content">
    <div id="container">
      <div class="column column-1">
        <h1>Belize Inventory</h1>
