<?php
if(isset($_POST['order_id'])){
        include "db_conn.php";
        $order_id = htmlentities($_POST['order_id']);
        $new_order_status = htmlentities($_POST['confirm_order']);
    
         $sql_upd = "UPDATE `orders`
                        SET  tracking_order_status = ?
                    WHERE order_id = ?;";
        $stmt_upd = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
        header("location: ../index.php?error=8"); //update failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_upd,"ss",$new_order_status, $order_id);
        mysqli_stmt_execute($stmt_upd);
        header("location: ../receiveorder.php?success_update=1");
        
    }
