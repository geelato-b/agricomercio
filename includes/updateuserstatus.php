<?php
if(isset($_POST['user_id'])){
        include "db_conn.php";
        $user_id = htmlentities($_POST['user_id']);
        $new_user_status = htmlentities($_POST['block_user']);
    
         $sql_upd = "UPDATE `users` 
                        SET status = ?
                    WHERE user_id  = ?;";
        $stmt_upd = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
        header("location: ../admin/index.php?error=8"); //update failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_upd,"ss", $new_user_status, $user_id );
        mysqli_stmt_execute($stmt_upd);
        header("location: ../admin/user.php?updated");
        
    }
