<?php
include "../../functions/function.dbh.php";
include "../../functions.php";

if (isset($_POST["load"]) || isset($_POST["search"])) {

  $sql = "";//created variable to hold the query
  
  if(isset($_POST["load"])){ //if a post variable called load was sent then the query will be the following...
    //show all devices query
    $sql = "SELECT users.Users_id, users.Email, users.Department_ID, users.Job_Title, users.Sex, users.User_level_id, departments.Department_name, CONCAT(users.First_name,  ' ', users.Last_name) AS name
    FROM users
    INNER JOIN departments ON users.Department_id = departments.Department_id
    WHERE users.Status = 1 LIMIT 10;";
  }else if(isset($_POST["search"])) { //if a post variable called search was sent then the query will be the following...
    $name = $_POST["search"];
    //show all devices query
    $sql = "SELECT users.Users_id, users.Email, users.Department_ID, users.Job_Title, users.Sex, users.User_level_id, departments.Department_name, CONCAT(users.First_name,  ' ', users.Last_name) AS name
    FROM users
    INNER JOIN departments ON users.Department_id = departments.Department_id
    WHERE CONCAT(users.First_name, ' ', users.Last_name) LIKE '$name%' && users.Status = 1;";
  }


  //execute query
  $result = mysqli_query($conn, $sql);

  //create ul to display results
  if (mysqli_num_rows($result) > 0) { //there are laptops to show
    while ($row = mysqli_fetch_array($result)) { ?>
      <!-- calling javascript function called fill_searchUPS in class.load-tables.js by passing the fetched result as a parameter-->
      <div hidden onclick='fill_searchUsers("<?php echo $row['name']; ?>")'></div>

<?php
      $sex = $row["Sex"];
      $userlevel = $row["User_level_id"];
      echo '
        <tr>
          <td>
            <div class="d-flex px-2 py-1">
              <div>
                <img src="../images/'; if($sex == 'M'){echo 'male';}else{echo 'female';} echo '-profile.jpg" class="avatar avatar-sm me-3 border-radius-sm" alt="user1">
              </div>
              <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm">' . $row["name"] . '</h6>
                <p class="text-xs text-secondary mb-0">' . $row["Email"] . '</p>
              </div>
            </div>
          </td>
          <td>
            <p class="text-xs font-weight-bold mb-0  text-wrap">' . $row["Job_Title"] . '</p>
          </td>
          <td>
            <p class="text-xs font-weight-bold mb-0  text-wrap">' . $row["Department_name"] . '</p>
          </td>';
      if ($sex == 'M') {
        echo '
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-info">Male</span>
            </td>';
      } else {
        echo '
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-light">Female</span>
            </td>';
      }
      echo '
          <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">' . returnCountUserRegisteredDevices($conn, $row["Users_id"]) . '</span>
          </td>';
      if (session_status() == PHP_SESSION_NONE) { //check if session was already started
        session_start();
      }
      if(isset($_SESSION["userRecord"])){
        if ($_SESSION["userRecord"]["User_level_id"] == 1) {
          echo '
            <td class="align-middle text-center">
              <form action="../functions/function.edit-user.php" method="post">
                <input type="checkbox" name="affirm" value="" required class="mx-3">
                <input name="userchangeID" value="'.$row["Users_id"].'" hidden>
                <button class="btn btn-secondary text-danger text-gradient mb-0" name="delete-user-selected"><i class="material-icons text-sm">delete</i>Delete</button>
                <button class="btn btn-secondary text-dark text-gradient mb-0" name="edit-user-selected"><i class="material-icons text-sm">edit</i>Edit</button>
              </form>
            </td>
          </tr>';
        }//--
      }
    }
  } else {
    echo '<p>No Users to show</p>';
  }
}
