      <div class="row mx-2 mb-4">
        <div class="form-group col-md-4 mb-4">
          <label for="inputID" class="form-label">Employee ID</label>
          <input type="text" class="form-control border-bottom" id="inputID" placeholder="employee id number..." autofocus name="id" required <?php if (isset($_SESSION["userRecord"])){if($_SESSION["userRecord"]["User_level_id"] == 2){echo 'readonly';}} ?>
          value="<?php if(isset($_SESSION["userEditDetails"]) && $_SESSION["currentPage"] == "edit-user"){echo $_SESSION["userEditDetails"]["Employee_id"];}?>">
        </div>
        <div class="form-group col-md-4 mb-4">
          <label for="inputFn" class="form-label">First Name</label>
          <input type="text" class="form-control border-bottom" id="inputFn" placeholder="first name..." autofocus name="fn" required <?php if (isset($_SESSION["userRecord"])){if($_SESSION["userRecord"]["User_level_id"] == 2){echo 'readonly';}}  ?> 
          value="<?php if(isset($_SESSION["userEditDetails"]) && $_SESSION["currentPage"] == "edit-user"){echo $_SESSION["userEditDetails"]["First_name"];}?>">
        </div>
        <div class="form-group col-md-4 mb-5">
          <label for="inputLn">Last Name</label>
          <input type="text" class="form-control border-bottom" id="inputLn" placeholder="last name..." name="ln" required <?php if (isset($_SESSION["userRecord"])){if($_SESSION["userRecord"]["User_level_id"] == 2){echo 'readonly';}}  ?> 
          value="<?php if(isset($_SESSION["userEditDetails"]) && $_SESSION["currentPage"] == "edit-user"){echo $_SESSION["userEditDetails"]["Last_name"];}?>">
        </div>
      </div>

      <div class="row mx-2 mb-4">
        <div class="form-group col-md-6 mb-5">
          <label for="inputJt">Job Title (ex.Director of xxx)</label>
          <input type="text" class="form-control border-bottom" id="inputJt" placeholder="job title..." autofocus name="jt" required
          value="<?php if(isset($_SESSION["userEditDetails"]) && $_SESSION["currentPage"] == "edit-user"){echo $_SESSION["userEditDetails"]["Job_Title"];}?>">
        </div>
        <div class="form-group col-md-6">
          <label for="inputDpt">Department (ex.Marketing)</label>
          <?php
            include_once "../class.views/class.selectInput-Department.php";
          ?>
        </div>
      </div>

      <div class="row mx-2 mb-4">
        <div class="form-group col-md-6 mb-5">
          <label for="inputEm">Email</label>
          <input type="email" class="form-control border-bottom" id="inputEm" placeholder="name@belizetourismboard.org" autofocus name="em" required
          value="<?php if(isset($_SESSION["userEditDetails"]) && $_SESSION["currentPage"] == "edit-user"){echo $_SESSION["userEditDetails"]["Email"];}?>">
        </div>
        <div class="form-group col-md-6">
          <label for="">Sex</label><br>
          <div class="btn-group" role="group">
            <input type="radio" class="btn-check" name="sex" id="btnmale" autocomplete="off" value="M" <?php if(isset($_SESSION["userEditDetails"]) && $_SESSION["currentPage"] == "edit-user"){if($_SESSION["userEditDetails"]["Sex"] == 'M'){echo 'checked';}}?>>
            <label class="btn btn-outline-info" for="btnmale">Male</label>
            <input type="radio" class="btn-check" name="sex" id="btnfemale" autocomplete="off" value="F" <?php if(isset($_SESSION["userEditDetails"]) && $_SESSION["currentPage"] == "edit-user"){if($_SESSION["userEditDetails"]["Sex"] == 'F'){echo 'checked';}}?>>
            <label class="btn btn-outline-primary" for="btnfemale">Female</label>
          </div>
        </div>
      </div>

      <div class="row mx-2 mb-4">
        <div class="form-group col-md-6 mb-4">
          <label for="inputPWD">Password</label>
          <input type="password" class="form-control border-bottom" id="inputPWD" placeholder="<?php if(isset($_SESSION["userEditDetails"]) && $_SESSION["currentPage"] == "edit-user"){echo 'leave empty to use saved password - 8 to 20 characters';}else{echo 'Must be 8-20 characters long';}  ?>" autofocus name="pwd">
        </div>
        <div class="col-md-4 mb-4 mx-4 form-check form-switch" id="makeadminoption">
          <br>
          <input type="checkbox" id="makeadminOption" name="makeadmin" value="yes" class="form-check-input" <?php if(isset($_SESSION["userEditDetails"]) && $_SESSION["currentPage"] == "edit-user"){if($_SESSION["userEditDetails"]["User_level_id"] == '1'){echo 'checked';} if($_SESSION["userEditDetails"]["User_level_id"] != '1'){ echo 'style="display:none;"';} }?>>
          <label for="makeadminOption" class="form-check-label mx-3 text-lg" <?php if(isset($_SESSION["userEditDetails"])){if($_SESSION["userEditDetails"]["User_level_id"] != '1'){ echo 'style="display:none;"';}} ?>> Make this user an <u><strong>administrator</strong></u>?</label><br>
        </div>
        <div class="col-md-4 mb-4 mx-4 form-check form-switch" id="deleteuseroption">
          <br>
          <input type="checkbox" id="deleteOption" name="dltuseroption" value="yes" class="form-check-input" <?php if(isset($_SESSION["userEditDetails"])){if($_SESSION["userEditDetails"]["User_level_id"] != '1'){ echo 'style="display:none;"';}} ?> >
          <!-- present messagebox to ensure the user confirms to delete -->
          <label for="deleteOption" class="form-check-label text-lg" <?php if(isset($_SESSION["userEditDetails"])){if($_SESSION["userEditDetails"]["User_level_id"] != '1'){ echo 'style="display:none;"';}} ?> ><u><strong>Delete</strong></u> this user? </label><br>
        </div>
        <div class="form-group col-md-6" id="repeatpwd-formgroup">
          <label for="repeatPWD">Repeat Password</label>
          <input type="password" class="form-control border-bottom" id="repeatPWD" placeholder="repeat password here" name="repeatpwd" <?php if(!isset($_SESSION["userEditDetails"]) && $_SESSION["currentPage"] == "edit-user"){echo "required";}  ?>>
        </div>
      </div>