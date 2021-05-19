<?php

if(isset($_POST['AddItem'])){
include_once "db_conn.php";
include_once "function.inc.php";
    session_start();
    $user_id = $_SESSION['userid'];
    $itemname = htmlentities($_POST['itemname']);
    $itemdesc = htmlentities($_POST['itemdesc']);
    $itemPrice = htmlentities($_POST['itemprice']);
    $itemcat  = htmlentities($_POST['itemcategory']);
    $itemstat = htmlentities($_POST['itemstatus']);
    
    // file upload initialization--------------------------------->

    $filecheckstat = true;
    $image_temp_file = $_FILES["itemimagefile"]["tmp_name"];
    $baseitem_img = basename($_FILES["itemimagefile"]["name"]);
    $ext = strtolower(pathinfo($baseitem_img, PATHINFO_EXTENSION));
    $target_dir = '../img';
    $target_filename = strtolower($itemname).".".$ext;

    $check = getimagesize($image_temp_file) ;
    $filecheckstat = $check !== false ? true : false;

    $file_stat = checkImage($_FILES["itemimagefile"], $target_dir, $target_filename) ;
    $file_err_count=0;
    $err_msg = null;

    foreach ($file_stat as $key => $stat) {
        if ($stat != '') {
            $error_msg .= ($file_err_count+1). ": ". $stat ."<br>";
            $file_err_count++;
        }
    }
    if ($error_msg !== null) {
        header("location: ../seller/product.php?error={$error_msg}");
        exit();
    }

    //file uplload initialization------------------------------->


    $sql_check = "SELECT item_id 
                    FROM items
                   WHERE item_name = ?;";
    $stmt_chk = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_chk, $sql_check)){
        header("location: index.php?error=3"); //statement failed
        exit();
    }
    mysqli_stmt_bind_param($stmt_chk,"s",$itemname);
    mysqli_stmt_execute($stmt_chk);
    $chk_result=mysqli_stmt_get_result($stmt_chk);
    $arr=array();
    while($row = mysqli_fetch_assoc($chk_result)){
        array_push($arr,$row);
    }
    
        $sql_ins = "INSERT INTO `items`
                  (`item_name`,`cat_id`, `item_desc`, `item_status`, `item_price`, `user_id`, `item_img` ) 
                   VALUES (?,?,?,?,?,?,?);";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
        header("location: ../seller/product.php?error=2&itemname={$itemname}"); //insert failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_ins,"sssssss",$itemname,$itemcat,$itemdesc,$itemstat,$itemPrice,$user_id,$target_filename);
        mysqli_stmt_execute($stmt_ins);

        if (!$file_err_count) {
            //upload file

            if (move_uploaded_file($image_temp_file, $target_dir."/".$target_filename)) {
                echo "The file ". htmlspecialchars( basename($_FILES["fileToUpload"]["name"])). "file has been uploaded.";
            }else{
                header("localtion: ../seller/product.php?error=99"); //file upload failed
                exit();
            }
        }

        header("location:  ../seller/product.php?.php?error=0&Item Added &itemname={$itemname}"); //successful
        exit();

    
}
