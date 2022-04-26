<?php
include_once '../class.views/class.signUpIn-header.php';
$_SESSION["currentPage"] = "sign-up";
?>
<!-- <script text="javascript">
  document.title = "Sign Up";
</script> -->
<h5>Enter your <span>sign-up</span> details below</h5>
<a href="" id="linkto">Already have an account?</a>
<br>
<br>
<form action="../functions/function.sign-up.php" method="post" class="formSignUp">
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="inputID" class="form-label">Employee ID</label>
      <input type="text" class="form-control" id="inputID" required autofocus name="id">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="inputFirstName" class="form-label">First Name</label>
      <input type="text" class="form-control" id="inputFirstName" required autofocus name="fn">
    </div>
    <div class="col-md-6">
      <label for="inputLastName" class="form-label">Last Name</label>
      <input type="text" class="form-control" id="inputLastName" required name="ln">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-6 mb-4">
      <label for="inputjobtitle" class="form-label">Job Title (ex.Director of xxx)</label>
      <input type="text" id="inputjobtitle" class="form-control" required name="jobtitle">
    </div>
    <div class="col-md-6 mb-3">
      <label for="inputDpt" style="margin-bottom: 7px;">Department (ex.Marketing)</label>
      <?php
      include_once "../class.views/class.selectInput-Department.php";
      ?>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-6 mb-4">
      <label for="inputEmail" class="form-label">Email</label>
      <input type="email" id="inputEmail" class="form-control" required name="em" placeholder="name@belizetourismboard.org">
    </div>
    <div class="col-md-6">
      <label for="">Sex</label><br>
      <div class="btn-group" role="group">
        <input type="radio" class="btn-check" name="sex" id="btnmale" checked value="M">
        <label class="btn btn-outline-primary" for="btnmale">Male</label>
        <input type="radio" class="btn-check" name="sex" id="btnfemale" value="F">
        <label class="btn btn-outline-danger" for="btnfemale">Female</label>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-6 mb-4">
      <label for="inputPassword" class="form-label">Password</label>
      <input type="password" id="inputPassword" class="form-control" aria-describedby="passwordHelpBlock" required name="pwd">
      <div id="passwordHelpBlock" class="form-text">
        Your password must be 8-20 characters long
      </div>
    </div>
    <div class="col-md-6">
      <label for="repeatPassword" class="form-label">Repeat Password</label>
      <input type="password" id="repeatPassword" class="form-control" aria-describedby="passwordRepeatHelpBlock" required name="repeatpwd">
      <div id="passwordRepeatHelpBlock" class="form-text">
        Re-type password
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <button type="submit" class="btn btn-warning" name="sign-up-submit">Sign Up</button>
    </div>
  </div>
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
  <title>Sign Up</title>
  <link rel="stylesheet" href="../includes/css/sign-in&sign-up.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
  <div class="content">
    <div id="container">
      <div class="column column-1">
        <h1>Belize Tourism Board</h1>
        <h5>Enter your <span>sign-up</span> details below</h5>
        <a href="./class.sign-in-view.php">Already have an account?</a>
        <br>
        <br>
        <form action="../functions/class.sign-up.php" method="post">
          <div class="row">
            <div class="col-md-6">
              <label for="inputFirstName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="inputFirstName" required autofocus name="fn">
              <div class="invalid-feedback">
                Please enter your first name
              </div>
            </div>
            <div class="col-md-6">
              <label for="inputLastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="inputLastName" required name="ln">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <label for="inputUsername" class="form-label">User Name</label>
              <input type="text" class="form-control" id="inputUsername" aria-describedby="usernameHelpBlock" required name="usern">
              <div id="usernameHelpBlock" class="form-text">Username must be 4-8 characters</div>
            </div>
            <div class="col-md-6">
              <label for="inputEmail" class="form-label">Email</label>
              <input type="email" id="inputEmail" class="form-control" required name="em">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <label for="inputPassword" class="form-label">Password</label>
              <input type="password" id="inputPassword" class="form-control" aria-describedby="passwordHelpBlock" required name="pwd">
              <div id="passwordHelpBlock" class="form-text">
                Your password must be 8-20 characters long
              </div>
            </div>
            <div class="col-md-6">
              <label for="repeatPassword" class="form-label">Repeat Password</label>
              <input type="password" id="repeatPassword" class="form-control" aria-describedby="passwordRepeatHelpBlock" required name="repeatpwd">
              <div id="passwordRepeatHelpBlock" class="form-text">
                Re-type password
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col">
              <button type="submit" class="btn btn-warning" name="sign-up-submit">Sign Up</button>
            </div>
          </div>
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