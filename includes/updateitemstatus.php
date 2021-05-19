<?php
if(isset($_POST['item_id'])){
        include "db_conn.php";
        $item_id = htmlentities($_POST['item_id']);
        $new_price = htmlentities($_POST['item_price']);
        $new_item_status = htmlentities($_POST['new_item_status']);
    
         $sql_upd = "UPDATE `items`
                        SET item_price = ?,
                        item_status = ?
                    WHERE item_id = ?;";
        $stmt_upd = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
        header("location: ../seller/index.php?error=8"); //update failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_upd,"sss",$new_price, $new_item_status, $item_id);
        mysqli_stmt_execute($stmt_upd);
        header("location: ../seller/product.php?success_update=1");
        
    }

    