<select name="registrant" id="Users" class="form-select p-2"  aria-label="device user selection">
    <option value="0">unregistered</option>
    <?php
        $getUsers = returnAllUsers($conn);

        if($getUsers == false){
            //do nothing
        } else {
            while($Users = mysqli_fetch_assoc($getUsers)){
                echo '<option value="' . $Users["Users_id"] .  '"';
                if(isset($_SESSION["deviceEditDetails"]) && $_SESSION["currentPage"] == "edit-device"){if($Users["Users_id"] == $_SESSION["deviceEditDetails"]["User_id"]){echo 'selected';}}
                echo '>' . $Users["full_name"] . '</option>';
            }
        }
    ?>
</select>