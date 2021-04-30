<?php
echo "This is a test change";
echo "This is a test change again";
if(isset($_POST['item_id'])){
include_once "../includes/db_conn.php";
    $itemname = htmlentities($_POST['item_name']);
    $itemprice = htmlentities($_POST['item_price']);
    $itemstatus = htmlentities($_POST['item_status']);
    $item_desc = htmlentities($_POST['item_desc']);
    $cat_id = htmlentities($_POST['cat_id']);
    
    $sql_check = "SELECT item_id 
                    FROM items
                   WHERE item_name = ?
                     ;";
    $stmt_chk = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_chk, $sql_check)){
        header("location: ../seller/userprofile.php?error=3"); 
        echo "statement failed";
        exit();
    }
    mysqli_stmt_bind_param($stmt_chk,"s",$itemname);
    mysqli_stmt_execute($stmt_chk);
    $chk_result=mysqli_stmt_get_result($stmt_chk);
    $arr=array();
    while($row = mysqli_fetch_assoc($chk_result)){
        array_push($arr,$row);
    }
    if(!empty($arr)){
        // header("location: ../seller/userprofile.php?error=1&itemname={$itemname}"); 
        echo "item exist";
        exit();
    }
    else{
        $sql_ins = "INSERT INTO `items`
                  (`item_name`,`item_price`,'item_desc', `cat_id`, `item_status`) 
                   VALUES (?,?,?,?,?);";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
        // header("location: userprofile.php?error=2"); //
            echo "insert failed";
        exit();
        }
        mysqli_stmt_bind_param($stmt_ins,"sssss",$itemname,$itemprice,$item_desc,$itemstatus,$cat_id);
        mysqli_stmt_execute($stmt_ins);
        header("location: ../seller/userprofile.php?error=0&itemname={$itemname}"); //successful
        exit();
    }
}
        
      
  

      
