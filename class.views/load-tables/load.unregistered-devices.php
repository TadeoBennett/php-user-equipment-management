<?php
include "../../functions/function.dbh.php";

if (isset($_POST["load"]) || isset($_POST["search"])) {

  $sql = "";//created variable to hold the query

  if(isset($_POST["load"])){ //if a post variable called load was sent then the query will be the following...
    //show all devices query
    $sql = "SELECT Device_id, Device_name, Device_AssetTag_id, User_id FROM devices WHERE Device_registerflag = 0 && Status = 1 ORDER BY Device_name LIMIT 15;";
  }else if(isset($_POST["search"])) { //if a post variable called search was sent then the query will be the following...
    //getting value of the search
    $unRegDeviceID = $_POST["search"];

    if(is_numeric($unRegDeviceID)){ //searching for device using asset tag id
      $unRegDeviceID = intval($unRegDeviceID);
      $sql = "SELECT Device_id, Device_name, Device_AssetTag_id, User_id FROM devices WHERE Device_registerflag = 0 && Status = 1 &&  Device_AssetTag_id LIKE '$unRegDeviceID%'  ORDER BY Device_AssetTag_id  LIMIT 10";
    }else{ //searching for device using device name
      //search query
      $sql = "SELECT Device_id, Device_name, Device_AssetTag_id, User_id FROM devices WHERE Device_registerflag = 0 && Status = 1 &&  Device_name LIKE '$unRegDeviceID%'  ORDER BY Device_name  LIMIT 10";
    }
  }

  //execute query
  $result = mysqli_query($conn, $sql);

  //create ul to display results
  if (mysqli_num_rows($result) > 0){ //there are monitors to show
    
      while ($row = mysqli_fetch_assoc($result)) { ?>
        <!-- calling javascript function called fill_searchMonitors in class.load-tables.js by passing the fetched result as a parameter-->
        <div hidden onclick='fill_searchUnregisteredDevices("<?php echo $row['full_name']; ?>")'></div>
        <?php
        $user = $row["User_id"];
        $assettag = $row["Device_AssetTag_id"];
        if ($user == NULL || $user == "" || strlen($user) == 0) { $user = "no"; }else{$user = "yes";}
        if ($assettag == NULL || $assettag == "" || strlen($assettag) == 0) { $assettag = "####"; }
        echo '
            <div class="col-lg-6">
              <li class="list-group-item border-0 d-flex p-3 mb-2 bg-gray-200 border-radius-lg">
                    <div class="col-6">
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-sm">' . $row["Device_name"] . '</h6>
                        <span class="mb-2 text-xs">Asset Tag ID: <span class="text-dark font-weight-bold ms-sm-2">' . $assettag . '</span></span>
                        <span class="text-xs">User assigned: <span class="text-dark ms-sm-2 font-weight-bold">' . $user . '</span></span>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="ms-auto text-end">
                        <form  action="../functions/function.edit-device.php" method="post">
                          <input name="devicechangeID" value="'.$row["Device_id"].'" hidden>
                          <input name="deviceTagID" value="'.$row["Device_AssetTag_id"].'" hidden>
                          <button class="btn btn-link text-dark px-3 mb-0" name="edit-device-selected"><i class="material-icons text-sm me-2">edit</i>Edit</button>
                          <button class="btn btn-link text-danger text-gradient px-3 mb-0" name="delete-device-selected" style="display: inline"><i class="material-icons text-sm me-2">delete</i>Delete</button>
                          </form>
                      </div>
                    </div>
                </li>
            </div>';
      }
  }else{
    echo '<p>No unregistered device(s) to show</p>';
  }
}