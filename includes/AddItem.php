<?php
if(isset($_POST['itemstatus'])){
include_once "db_conn.php";
    session_start();
    $user_id = $_SESSION['userid'];
    $itemname = htmlentities($_POST['itemname']);
    $itemdesc = htmlentities($_POST['itemdesc']);
    $itemPrice = htmlentities($_POST['itemprice']);
    $itemcat  = htmlentities($_POST['itemcategory']);
    $itemstat = htmlentities($_POST['itemstatus']);
    
    $sql_check = "SELECT item_id 
                    FROM items
                   WHERE item_name = ?
                     AND user_id = ? ;";
    $stmt_chk = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_chk, $sql_check)){
        header("location: index.php?error=3"); //statement failed
        exit();
    }
    mysqli_stmt_bind_param($stmt_chk,"ss",$itemname,$_SESSION['userid']);
    mysqli_stmt_execute($stmt_chk);
    $chk_result=mysqli_stmt_get_result($stmt_chk);
    $arr=array();
    while($row = mysqli_fetch_assoc($chk_result)){
        array_push($arr,$row);
    }
    if(!empty($arr)){
        header("location: ../seller/product.php?error=1&itemname={$itemname}"); 
        exit();
    }
    else{
        $sql_ins = "INSERT INTO `items`
                  (`item_name`, `item_desc`, `item_price`, `cat_id`, `item_status`, `user_id`) 
                   VALUES (?,?,?,?,?,?);";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
        header("location: ../seller/product.php?error=2&itemname={$itemname}"); //insert failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_ins,"ssssss",$itemname,$itemdesc,$itemPrice,$itemcat,$itemstat, $user_id);
        mysqli_stmt_execute($stmt_ins);
        header("location:  ../seller/product.php?.php?Item Added &itemname={$itemname}"); //successful
        exit();
    }
}
