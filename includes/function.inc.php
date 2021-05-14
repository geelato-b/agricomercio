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
    WHERE  user_id = ?;
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
    $sql= "SELECT `user_id`, `user_name`, `status` FROM `users` 
    WHERE  user_id = ?;
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

function getCartSummary($conn, $user_id){
    $sql_cart_list = "SELECT c.user_id
                           , sum(i.item_price * c.item_qty) total_price
                           , sum(c.item_qty) total_qty
                        FROM cart c
                        JOIN items i
                          ON c.item_id = i.item_id
                       WHERE c.user_id = ? 
                          AND c.status = 'P'
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


