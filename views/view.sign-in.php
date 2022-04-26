<?php
include_once '../class.views/class.signUpIn-header.php';
$_SESSION["currentPage"] = "sign-in";
?>
<!-- <script language="javascript">
  document.title = "Sign In";
</script> -->
<h5>Enter your <span>sign-in</span> details below</h5>
<a href="" id="linkto">Don't have an account?</a>
<br>
<br>
<br>
<form action="../functions/function.sign-in.php" method="post" class="formSignIn">
  <div class="col-lg-8">
    <label for="inputEmail" class="form-label">Email</label>
    <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelpBlock" required autofocus name="em">
  </div>
  <br>
  <div class="col-lg-8">
    <label for="inputPassword" class="form-label">Password</label>
    <input type="password" id="inputPassword" class="form-control" required name="pwd">
  </div>
  <br>
  <button type="submit" class="btn btn-warning" name="sign-in-submit">Sign in</button>
</form>
<?php
include_once '../class.views/class.signUpIn-footer.php';
?>












<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign in</title>
  <link rel="stylesheet" href="../includes/css/sign-in&sign-up.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
  <div class="content">
    <div id="container">
      <div class="column column-1">
        <h1>Belize Tourism Board</h1>
        <h5>Enter your <span>sign-in</span> details below</h5>
        <a href="./class.sign-up-view.php">Don't have an account?</a>
        <br>
        <br>
        <br>
        <form action="../functions/class.sign-in.php" method="post">
          <div class="col-lg-8">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelpBlock" required autofocus name="em">
          </div>
          <br>
          <div class="col-lg-8">
            <label for="inputPassword" class="form-label">Password</label>
            <input type="password" id="inputPassword" class="form-control" required name="pwd">
          </div>
          <br>
          <button type="submit" class="btn btn-warning" name="sign-in-submit">Sign in</button>
        </form>
      </div>
      <div id="edit" class="column column-2 p-0 m-0">
        <div>
          <img src="../images/btb-logo.png" alt="BTB logo">
        </div>
      </div>
    </div>
  </div>
</body>

</html> -->