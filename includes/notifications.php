<!-- for the success notifications -->
    <?php if(isset($_SESSION["success"])){ ?>
        <script> console.log("success");</script>
        <!-- signin success -->
        <?php if(isset($_SESSION["success"]["description"]) && ($_SESSION["success"]["description"] == "user-signup-sucess")){  ?>
        <script>
            swal({
                title: "SIGN UP SUCCESSFUL!",
                text: "This user has been added so you can now login as this user.",
                icon: "success",
            });
        </script>
        <?php }//end if ?>
        <!-- delete success -->
        <?php if(isset($_SESSION["success"]["description"]) && ($_SESSION["success"]["description"] == "edituser-delete-sucess")){  ?>
        <script>
            swal({
                title: "DELETE USER SUCCESS!",
                text: "User has been deleted.",
                icon: "success",
            });
        </script>
        <?php }//end if ?>
        <!-- edit success -->
        <?php if(isset($_SESSION["success"]["description"]) && ($_SESSION["success"]["description"] == "edituser-edit-success")){  ?>
        <script>
            swal({
                title: "EDIT USER SUCCESS!",
                text: "User has been edited.",
                icon: "success",
            });
        </script>
        <?php }//end if ?>
        



    <?php
        unset($_SESSION["success"]); //delete success session variable to no longer show notifications
    }//end if success session variable exists
    ?>

<!-- // ----------------------------------------------------------------------- -->

    <!-- for the failure notifications -->
    <?php if(isset($_SESSION["failure"])){ ?>
        <script> console.log("failure");</script>
        <!-- signin failures -->
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "email-signin-error")){  ?>
            <script>
                swal({
                    title: "SIGN IN FAILED!",
                    text: "Email does not exist.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "password-signin-error")){  ?>
            <script>
                swal({
                    title: "SIGN IN FAILED!",
                    text: "Password does not exist.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>

        <!-- ----------------- signup failures --------------------- -->
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "staffID-signup-error")){  ?>
            <script>
                swal({
                    title: "SIGN UP FAILED!",
                    text: "Employee/Staff ID does meet required character length(4).",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "names-signup-error")){  ?>
            <script>
                swal({
                    title: "SIGN UP FAILED!",
                    text: "Neither first name or last name fields must be empty.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "email-exists-signup-error")){  ?>
            <script>
                swal({
                    title: "SIGN UP FAILED!",
                    text: "The entered email already exists.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "password-length-signup-error")){  ?>
            <script>
                swal({
                    title: "SIGN UP FAILED!",
                    text: "The password length must be 8 to 20 characters long.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "password-repeat-signup-error")){  ?>
            <script>
                swal({
                    title: "SIGN UP FAILED!",
                    text: "The entered passwords did not match.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "stmt-signup-error")){  ?>
            <script>
                swal({
                    title: "SIGN UP FAILED!",
                    text: "STMT Error Occured. Could not add this user.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>

        <!-- ----------------- edit-user failures --------------------- -->
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "edituser-noarray-error")){  ?>
            <script>
                swal({
                    title: "RETURN DETAILS FAILED!",
                    text: "No array error. Could not return details for this user.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "edituser-deleteuser-error")){  ?>
            <script>
                swal({
                    title: "DELETE USER FAILED!",
                    text: "Could not delete user",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "staffID-edituser-error")){  ?>
            <script>
                swal({
                    title: "EDIT USER FAILED!",
                    text: "Employee/Staff ID does meet required character length(4).",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "names-edituser-error")){  ?>
            <script>
                swal({
                    title: "EDIT USER FAILED!",
                    text: "Neither first name or last name fields must be empty.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "password-length-edituser-error")){  ?>
            <script>
                swal({
                    title: "EDIT USER FAILED!",
                    text: "The password length must be 8 to 20 characters long.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "stmt0-edituser-error")){  ?>
            <script>
                swal({
                    title: "EDIT USER FAILED!",
                    text: "STMT-0 Error Occured. Could not edit this user.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "stmt1-edituser-error")){  ?>
            <script>
                swal({
                    title: "EDIT USER FAILED!",
                    text: "STMT-1 Error Occured. Could not edit this user.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "stmt2-edituser-error")){  ?>
            <script>
                swal({
                    title: "EDIT USER FAILED!",
                    text: "STMT-2 Error Occured. Could not edit this user.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        <?php if(isset($_SESSION["failure"]["description"]) && ($_SESSION["failure"]["description"] == "stmt3-edituser-error")){  ?>
            <script>
                swal({
                    title: "EDIT USER FAILED!",
                    text: "STMT-3 Error Occured. Could not edit this user.",
                    icon: "error",
                });
            </script>
        <?php }//end if ?>
        
        
        
        <?php
        unset($_SESSION["failure"]); //delete success session variable to no longer show notifications
    }//end if success session variable exists
    ?>
