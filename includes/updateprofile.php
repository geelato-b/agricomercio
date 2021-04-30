<?php
if(isset($_POST['user_info_id'])){
        include "db_conn.php";
        $user_info_id = htmlentities($_POST['user_info_id']);
        $user_fullname = htmlentities($_POST['user_fullname']);
        $contact_details = htmlentities($_POST['contact_details']);
        $house_no_street_brgy = htmlentities($_POST['house_no_street_brgy']);
        $city = htmlentities($_POST['city']);
        $province = htmlentities($_POST['province']);
        $postal_code= htmlentities($_POST['postal_code']);

         $sql_upd = "UPDATE `user_info` 
                     SET    `user_fullname`= ?
                            ,`contact_details`= ?
                            ,`house_no_street_brgy`= ?
                            ,`city`= ?
                            ,`province`=?
                            ,`postal_code`=? 
                             WHERE `user_info_id`= ?";

        $stmt_upd = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
        //header("location: ../index.php?error=8"); 
        echo "update failed";
        }
        mysqli_stmt_bind_param($stmt_upd,"sssssss", $user_info_id, $user_fullname,  $contact_details, $house_no_street_brgy, $city,  $province,  $postal_code);
        mysqli_stmt_execute($stmt_upd);
        header("location: ../user_profile.php?success_update=1");
        
    }
    ?>