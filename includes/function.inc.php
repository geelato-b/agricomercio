<?php
function createUser($conn, $username, $password, $usertype){
    $err;
    $sql ="INSERT INTO `users` (`user_name`, `Password`, `user_type`);
    VALUES (?,?,?)";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
      return false;
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $username, $password, $usertype);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    return true;

}
function cidExists($conn, $usrname){
    $sql = "SELECT * FROM `users`  WHERE `user_name` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../form.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $usrname);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
         return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
 }
 function passExists($conn, $psword){
    $sql = "SELECT * FROM `users`  WHERE `password` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../form.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $psword);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
         return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
 }

function passMatch($psword, $cpsword) {
    $result;
    if($psword !== $cpsword) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $password ){
    $err;
    $sql="SELECT * FROM `users` 
    WHERE  `user_name` = ?
    AND `password`= ?;
    ";

$stmt=mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: sign_in.php?error=stmtfailed");
        exit();
    }

        mysqli_stmt_bind_param($stmt, "ss" , $username, $password);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $err=  false;
            return $err;   
        }
        mysql_stmt_close($stmt);
}


function GetUserDetails($conn, $userid ){
    $err;
    $sql="SELECT * FROM `user_info` 
    WHERE  user_ref_num = ?;
    ";

$stmt=mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: index.php?error=stmtfailed");
        exit();
    }

        mysqli_stmt_bind_param($stmt, "s" , $userid);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $err=  false;
            return $err;   
        }
        mysql_stmt_close($stmt);
}


function GetUserName($conn, $userid ){
    $err;
    $sql= "SELECT * FROM `users` 
    WHERE  user_ref_num = ?;";


$stmt=mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: index.php?error=stmtfailed");
        exit();
    }

        mysqli_stmt_bind_param($stmt, "s" , $userid);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $err=  false;
            return $err;   
        }
        mysql_stmt_close($stmt);
}



function AddItem($conn,$USER_ID,$p_item_name,$p_item_desc,$p_item_price){
    $err;
    $sql ="INSERT INTO `items` (`item_name`, `item_desc`, `item_price`,`user_id`)
    VALUES (?,?,?,?) ; ";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
      return false;
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $p_item_name,$p_item_desc,$p_item_price, $USER_ID);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    return true;

}



function getCartSummary($conn, $user_id){
    $sql_cart_list = "SELECT c.user_id
                           , sum(i.item_price * c.item_qty) total_price
                           , sum(c.item_qty) total_qty
                        FROM cart c
                        JOIN items i
                          ON c.item_id = i.item_id
                       WHERE c.user_id = ? 
                          AND c.status = 'P'
                          AND c.cart_status = 'C'
                    GROUP BY c.user_id; ";
                      $stmt=mysqli_stmt_init($conn);
    
                    if (!mysqli_stmt_prepare($stmt, $sql_cart_list)){
                        header("location: index.php?error=stmtfailed");
                        exit();
                    }
        mysqli_stmt_bind_param($stmt, "s" ,$user_id);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $arr = array();            //initialize an empty array
        if($row = mysqli_fetch_assoc($resultData)){
            array_push($arr,$row);            
        }
        return $arr;               //this is the return value
        mysqli_stmt_close($stmt);  //close the mysqli_statement
}


function getOrderSummary($conn ){
    $sql_order_list = "SELECT
                           sum(i.item_price * o.item_qty) total_price
                           , sum(o.item_qty) total_qty
                        FROM orders o
                        JOIN items i
                          ON o.item_id = i.item_id
                       WHERE o.status = 'C'
                          AND o.tracking_order_status = 'C';";
                      $stmt=mysqli_stmt_init($conn);
    
                    if (!mysqli_stmt_prepare($stmt, $sql_order_list)){
                        header("location: index.php?error=stmtfailed");
                        exit();
                    }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $arr = array();            //initialize an empty array
        if($row = mysqli_fetch_assoc($resultData)){
            array_push($arr,$row);            
        }
        return $arr;               //this is the return value
        mysqli_stmt_close($stmt);  //close the mysqli_statement
}

function getCatList($conn){
    $err;
    $sql = "SELECT * FROM category";
    
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: products.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $arr = array();
    while($row = mysqli_fetch_assoc($resultData)){
            array_push($arr,$row);
    }
    return $arr;
    mysql_stmt_close($stmt);

}

function getItemListPerCat($conn,$cat_id){
    $err;
    $sql = "SELECT i.item_id
                 , i.item_name
                 , i.item_desc
                 , i.cat_id
                 , i.item_price
                 , i.item_img
                 ,ct.cat_desc
             FROM items i
             JOIN category ct
               ON i.cat_id = ct.cat_id
            WHERE i.cat_id = ?
              AND i.item_status = 'A';";
    
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: product.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s" ,$cat_id); 
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $arr = array();
    while($row = mysqli_fetch_assoc($resultData)){
            array_push($arr,$row);
    }
    return $arr;
    mysql_stmt_close($stmt);

}

function checkImage($img_file, $target_dir, $targetimagename){
    $stat = array(
        'fileSizeOk' => '',
        'fileExists' => '',
        'fileType'   => ''
    );

    $tmp_filename = $img_file['tmp_name'];
    $file_size = $img_file['size'];
    $img_size = getimagesize($img_file['tmp_name']);
    $img_mime = $img_size['mime'];
    $acceptable_files = array('image/jpeg','image/png','image/jpg');

    if (! in_array($img_mime, $acceptable_files)) {
        $stat['fileType'] = "This file is not an image .[jpg / png ]only";
    }
    if ($img_size === false || $file_size >500000) {
        $stat['fileSizeOk'] = "image size is not acceptable";
    }
    if (file_exists($target_dir."/".$targetimagename)) {
        $stat['fileExists'] = "file Exists. Change the Item Name.";
    }

    return $stat;
}



