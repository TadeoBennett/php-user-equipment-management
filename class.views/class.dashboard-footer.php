<footer class="footer py-4  ">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="copyright text-center text-sm text-muted text-lg-start">
          Copyright © <script>
            document.write(new Date().getFullYear())
          </script>,
          Belize Tourism Board
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="https://belizetourismboard.org/" class="nav-link text-muted" target="_blank">Belize Tourism Board</a>
          </li>
          <li class="nav-item">
            <a href="https://www.travelbelize.org/" class="nav-link text-muted" target="_blank">About Belize</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
</div>
</main>

<!--   Core JS Files   -->
<script src="../includes/js/core/popper.min.js"></script>
<script src="../includes/js/core/bootstrap.min.js"></script>
<!-- <script src="../includes/js/plugins/perfect-scrollbar.min.js"></script> -->
<script src="../includes/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../includes/js/plugins/chartjs.min.js"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../includes/js/material-dashboard.min.js?v=3.0.0"></script>

<script src="../includes/js/navbaritems-activechange.js"></script>

<script>
  // checking if the edit user page is open and disable form if there is no user set to edit
  if (document.getElementById("edituserlink").classList.contains('active')) {
    //makes the repeat password group not show
    document.getElementById("repeatpwd-formgroup").style.display = "none";
    <?php if (!isset($_SESSION["userEditDetails"])) {
      echo 'element = document.getElementById("user-edit-add-fieldset"); element.disabled = true;';
    } ?>

  }
  
  // checking if the add user page is open and 
  if (document.getElementById("adduserlink").classList.contains('active')) {
    //makes the delete user option not show
    document.getElementById("deleteuseroption").style.display = "none";
    document.getElementById("makeadminoption").style.display = "none";
  }

  // checking if the add device page is open and 
  if (document.getElementById("adddevicelink").classList.contains('active')) {
    //makes the delete device option not show
    if(!!document.getElementById("deletedeviceoption")){
      document.getElementById("deletedeviceoption").style.display = "none";
    }
    if(!!document.getElementById("deleteFormSection")){
      document.getElementById("deleteFormSection").style.display = "none"
    }
    
  }

  // checking if the edit device page is open and disable form if there is no device set to edit
  if (document.getElementById("editdevicelink").classList.contains('active')) {
    //makes the helpful information paragraph not show
    document.getElementById("helpfulinfo").style.display = "none";
    <?php if (!isset($_SESSION["deviceEditDetails"])) {
      echo 'element = document.getElementById("device-edit-add-fieldset"); element.disabled = true;';
      echo 'element = document.getElementById("device-edit-add-specs"); element.disabled = true;';
    } ?>
  }

</script>

<script>
  //display alerts when user enters the edit pages without selecting what device or user to edit
  window.onload = function() {
    alertUser()
  };
  let editFlag1 = <?php if (isset($_SESSION["userEditDetails"])) {
                    echo 'true';
                  } else {
                    echo 'false';
                  } ?>;
  let editFlag2 = <?php if (isset($_SESSION["deviceEditDetails"])) {
                    echo 'true';
                  } else {
                    echo 'false';
                  } ?>;

  function alertUser() {
    if (document.title == "Edit User" && editFlag1 == false) { //if you do not have the session variable necessary to edit
      editflag1 = <?php if ($_SESSION["userRecord"]["User_level_id"] != 1) {
                    echo 'false';
                  } else {
                    echo 'true';
                  } ?>; //get the user level id
      if (editflag1) { //you are an "admin"
        alert("Choose a USER to Edit from the users table");
      } else { //you are a basic user with rights of "everyone"
        alert('Go to your profile and select "Edit"');
      }
    } else if (document.title == "Edit Device" && editFlag2 == false) { // if you do not have the session variable necessary to edit
      alert("Choose a DEVICE to Edit from the devices table");
    }
  }
</script>

<script src="../includes/js/accordion-navbar.js"></script>
<script src="../includes/js/load-tables.js"></script>
<script src="../includes/js/specsform-display.js"></script>

<?php include "../includes/notifications.php"; ?>

</body>

</html>