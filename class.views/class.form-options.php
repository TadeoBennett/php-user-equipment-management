<label for="registeredFile" class="form-label">Proof of registration</label><br>
<input type="file" id="registeredFile" accept=".pdf" name="registrant-form">

  <?php
  // checking whether file exists or not
  if (isset($_SESSION["deviceEditDetails"])) {
    $file_pointer = '../includes/pdfForms/'.$_SESSION["deviceEditDetails"]["Device_form_name"] . '.pdf';
    
    if (file_exists($file_pointer)) { //checking if the file exists in the pdfForms Folder
      echo '
      <div id="deleteFormSection">
        <a class="btn btn-secondary mt-3" href="'.$file_pointer.'" download>
          <span><span class="material-icons">picture_as_pdf</span>  Download Existing Form</span>
        </a>
        <input name="currentFormLocation" value="'.$file_pointer.'" hidden>
        <div class="form-check form-switch mx-2" id="deletedeviceoption">
          <input type="checkbox" id="deleteOption" name="deleteForm" value="yes" class="form-check-input">
          <label for="deleteOption" class="form-check-label text-lg mx-2"><u><strong>Delete</strong></u> existing form?</label><br>
        </div>
      </div>
      ';
    }
  }// end iif
    
    
  ?>
  <br>