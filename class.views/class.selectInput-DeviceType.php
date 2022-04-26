<select name="devicetype" id="deviceType" class="form-select p-2"  aria-label="device type selection" autofocus required>
    <?php
    $getDevices = returnAllDeviceTypes($conn);

    if ($getDevices == false) {
        echo '<option value="None to select. Add a device type in the database"';
    } else {
        while ($Devices = mysqli_fetch_assoc($getDevices)) {
            echo '<option value="' . $Devices["Device_Type_id"] .  '"';
            if(isset($_SESSION["deviceEditDetails"]) && $_SESSION["currentPage"] == "edit-device"){if($Devices["Device_Type_id"] == $_SESSION["deviceEditDetails"]["Device_Type_id"]){echo 'selected';}}
            echo '>' . $Devices["Device_Type_name"] . '</option>';
        }
    }
    ?>
</select>
