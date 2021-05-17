<?php
if(isset($_POST['item_id'])){
        include "db_conn.php";
        session_start();
        $user_id = $_SESSION['userid'];
        $item_id = htmlentities($_POST['item_id']);
        $user_ref_num = htmlentities($_POST['user_ref_num']);
        $item_qty = htmlentities($_POST['item_qty']);
        $net_amt = htmlentities($_POST['net_amt']);
        $order_number = htmlentities($_POST['order_number']);
       
        $sql_ins = "INSERT INTO `orders`(`user_id`, `item_id`, `item_qty`, `net_amt`, `order_number`, `user_ref_num`) 
        VALUES (?,?,?,?,?,?)";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
        header("location: ../checkout.php?error=7"); //insert failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_ins,"ssssss",$user_id,$item_id, $item_qty, $net_amt, $order_number, $user_ref_num);
        mysqli_stmt_execute($stmt_ins);
        header("location: ../seller/receiveorder.php?=$item_id"); 
      
    }