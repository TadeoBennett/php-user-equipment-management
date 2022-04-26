<?php
include "../../functions/function.dbh.php";
if (session_status() == PHP_SESSION_NONE) { //check if session was already started
  session_start();
}

if (isset($_POST["load"]) || isset($_POST["search"])) {

  $sql = "";//created variable to hold the query

  if(isset($_POST["load"])){
    //show all devices query
    $sql = "SELECT Device_id, Device_name, Device_AssetTag_id, User_id FROM devices WHERE Device_Type_id = 4  && Status = 1  ORDER BY Device_AssetTag_id LIMIT 15;";

  }else if(isset($_POST["search"])) { //if a post variable called search was sent then the query will be the following...
    //getting value of the search
    $UPSID = $_POST["search"];

    //search query
    $sql = "SELECT Device_id, Device_name, Device_AssetTag_id, User_id FROM devices WHERE Device_Type_id = 4 && Device_AssetTag_id LIKE '$UPSID%' && Status = 1  LIMIT 10;";
  }

  //execute query
  $result = mysqli_query($conn, $sql);

  //create ul to display results
  if (mysqli_num_rows($result) > 0){ //there are laptops to show
      while ($row = mysqli_fetch_array($result)) { ?>
        <!-- calling javascript function called fill_searchUPS in class.load-tables.js by passing the fetched result as a parameter-->
        <div hidden onclick='fill_searchUPS("<?php echo $row['Device_AssetTag_id']; ?>")'></div>
        <?php
        $user = $row["User_id"];
        $assettag = $row["Device_AssetTag_id"];
        if ($user == NULL || $user == "" || strlen($user) == 0) { $user = "unregistered"; }else{$user = "yes";}
        if ($assettag == NULL || $assettag == "" || strlen($assettag) == 0) { $assettag = "####"; }
        echo '
        <ul class="list-group col-lg-4">
          <div class="row">
            <div>
              <li class="list-group-item border-0 d-flex p-3 mb-2 bg-gray-200 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-1 text-sm">' . $row["Device_name"] . '</h6>
                  <span class="mb-2 text-xs">Device Asset Tag ID: <span class="text-dark font-weight-bold ms-sm-2">' . $assettag . '</span></span>
                  <span class="text-xs">User assigned: <span class="text-dark ms-sm-2 font-weight-bold">' . $user . '</span></span>
                </div>
                <div class="ms-auto text-end">
                  <form  action="../functions/function.edit-device.php" method="post">
                    <input name="devicechangeID" value="'.$row["Device_id"].'" hidden>';
                    if (isset($_SESSION["userRecord"])) {
                      if($_SESSION["userRecord"]["User_level_id"] == 1){
                        echo '<button class="btn btn-link text-dark px-3 mb-0" name="edit-device-selected"><i class="material-icons text-sm me-2">edit</i>Edit</button>';
                      }
                    }
                  echo '
                  </form>
                </div>
              </li>
            </div>
          </div>
        </ul>';
      }
  }else{
    echo '<p>No UPSs to show</p>';
  }
}