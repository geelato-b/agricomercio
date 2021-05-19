<?php
if(isset($_GET['order_id'])){
        include "db_conn.php";
        $order_id = htmlentities($_GET['order_id']);
         $sql_del = "DELETE FROM `orders` WHERE order_id = ? ; ";
        $stmt_del = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt_del, $sql_del)){
            header("location: ../index.php?error=9"); //delete failed
            exit();
            }
        mysqli_stmt_bind_param($stmt_del,"s",$order_id);
        mysqli_stmt_execute($stmt_del);
        header("location: ../seller/confirm_order.php?success_delete");
        
        
    }