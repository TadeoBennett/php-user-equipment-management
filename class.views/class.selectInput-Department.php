<select name="dpt" id="inputDpt" class="form-select p-2" aria-label="device type selection" required>
  <?php
  $sql = "SELECT Department_id, Department_name FROM Departments WHERE Status = 1 ORDER BY Department_name";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<option value="' . $row["Department_id"] .  '"';
      if(isset($_SESSION["userEditDetails"]) && $_SESSION["currentPage"] == "edit-user"){if($row["Department_id"] == $_SESSION["userEditDetails"]["Department_id"]){echo 'selected';}}
      echo '>' . $row["Department_name"] . '</option>';
    }
  } else {
    echo '<option value="' . 0 .  '">none to select</option>';
  }
  ?>
</select>


