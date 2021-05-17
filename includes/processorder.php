<?php
if(isset($_GET['item_id'])){
        include "db_conn.php";
        session_start();
        $user_id = $_SESSION['userid'];
        $item_id = htmlentities($_GET['item_id']);
        $item_qty = htmlentities($_GET['item_qty']);
        
         $sql_ins = "INSERT INTO `cart`
                  (`item_id`, `user_id`, `item_qty` ) 
                   VALUES ( ?,?,?) ;";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
        header("location: ../index.php?error=7"); //insert failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_ins,"sss",$item_id, $user_id, $item_qty);
        mysqli_stmt_execute($stmt_ins);
        echo "Item Added to Cart";
        header("location: ../product.php ");
        
    }