<?php
if(isset($_POST['item_id'])){
        include "db_conn.php";
        session_start();
        $user_id = $_SESSION['userid'];
        $item_id = htmlentities($_POST['item_id']);
        $item_qty = htmlentities($_POST['item_qty']);
        $net_amt = htmlentities($_POST['net_amt']);
        $order_number = htmlentities($_POST['order_number']);
       
        $sql_ins = "INSERT INTO `orders`(`user_id`, `item_id`, `item_qty`, `net_amt`, `order_number`) 
        VALUES (?,?,?,?,?)";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
        header("location: ../receiveorder.php?error=7"); //insert failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_ins,"sssss",$user_id,$item_id, $item_qty, $net_amt, $order_number);
        mysqli_stmt_execute($stmt_ins);
        header("location: ../seller/receiveorder.php?=$item_id"); 
      
    }