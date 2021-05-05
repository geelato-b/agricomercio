<?php
if(isset($_POST['item_id'])){
        include "db_conn.php";
        session_start();
        $user_id = $_SESSION['userid'];
        $item_id = htmlentities($_POST['item_id']);
        $item_qty = htmlentities($_POST['item_qty']);
        $status='P';
        $sql_ins = "INSERT INTO `orders`(`user_id`, `item_id`, `item_qty`) 
        VALUES (?,?,?)";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
        header("location: ../checkout.php?error=7"); //insert failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_ins,"sss",$item_id,$user_id,$item_qty);
        mysqli_stmt_execute($stmt_ins);
        echo "order confirmed";
        
      
       
    }