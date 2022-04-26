</div>
<div id="edit" class="column column-2 p-0 m-0">
  <div>
    <img src="../images/btb-logo.png" alt="BTB logo">
  </div>
</div>
</div>
</div>
</body>

</html>

<script>
  //changing the links and title between the sign up and sign in pages
  const link = document.querySelector('form');
  if (link.classList.contains('formSignIn')) {
    //formSignIn is being shown
    document.getElementById("linkto").href = "../views/view.sign-up.php";
    document.title = "Sign In";
  } else if (link.classList.contains('formSignUp')) {
    document.getElementById("linkto").href = "../views/view.sign-in.php";
    document.title = "Sign Up";
  }
</script>


<?php include "../includes/notifications.php"; ?>

<script >
  // swal({
  //                   title: "SIGN IN FAILED!",
  //                   text: "Email does not exist",
  //                   icon: "error",
  //               });
</script>