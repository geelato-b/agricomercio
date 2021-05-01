<?php
if(isset($_GET['item_id'])){
        include "db_conn.php";
        $item_id = htmlentities($_GET['item_id']);
         $sql_del = "DELETE FROM `items` WHERE item_id = ? ; ";
        $stmt_del = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt_del, $sql_del)){
            header("location: ../index.php?error=9"); //delete failed
            exit();
            }
        mysqli_stmt_bind_param($stmt_del,"s",$item_id);
        mysqli_stmt_execute($stmt_del);
        header("location: ../seller/product.php?success_delete");

    }
