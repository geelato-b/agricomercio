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
    AND `password`= ?
    AND `status`= 'Active';
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
   
    return $stat;
}

function setisEmpty(){
    $bool_empty = false;
    $args = func_get_args();
      for($i = 0; $i < func_num_args(); $i++){
         if($args[$i] == "" ){
             $bool_empty = true;
             break;
         }     
      }
     return $bool_empty;
 }
 
 function nf2($amt){
     return "Php ". number_format($amt,2);
 }
 function pcpcs($amt){
     return ($amt > 1 ? ' pcs' : 'pc');
 }
 function showMenu($conn, $cat = null, $searchkey = null){
   if($searchkey === null){
        if($cat === null) {
             //declare the SQL
            $sql = "SELECT i.item_id
                      , i.minimum_qty
                      , i.item_name
                      , i.item_short_code
                      , c.cat_desc
                      , i.item_price
                      , i.item_img
                   FROM `items` i
                   JOIN `category` c
                     ON i.cat_id = c.cat_id ;";
         
         $stmt=mysqli_stmt_init($conn);
         if (!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit();
          }
       }
       else
       {  //check if $cat has value
             $sql = "SELECT i.item_id
                      , i.minimum_qty
                      , i.item_name
                      , i.item_short_code
                      , c.cat_desc
                      , i.item_price
                      , i.item_img
                   FROM `items` i
                   JOIN `category` c
                     ON i.cat_id = c.cat_id 
                 WHERE c.cat_id = ?;";
         
         $stmt=mysqli_stmt_init($conn);
         if (!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit();
          }
         mysqli_stmt_bind_param($stmt, "s" , $cat);
       }
   }
   else{ //check if searchkey variable is not NULL
         $sql = "SELECT i.item_id
                      , i.minimum_qty
                      , i.item_name
                      , i.item_short_code
                      , c.cat_desc
                      , i.item_price
                      , i.item_img
                   FROM `items` i
                   JOIN `category` c
                     ON i.cat_id = c.cat_id
                  WHERE i.item_name LIKE ?
                     OR i.item_short_code = ?
                     OR c.cat_desc like ?
                     OR i.item_price = ?;";
         $stmt=mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)){
             echo "Something went wrong.";
             exit();
          }
         $itemname="%{$searchkey}%"; 
         mysqli_stmt_bind_param($stmt, "ssss" , $itemname, $searchkey, $itemname, $searchkey);
         
     }
          mysqli_stmt_execute($stmt);
     
        $resultData = mysqli_stmt_get_result($stmt);
     if(!empty($resultData)){
         $arr = array();
         while($row = mysqli_fetch_assoc($resultData)){
             array_push($arr,$row);
         }
         return $arr;
     }
     else{
         return false;
     }
         
 }


function getSalesPerfCat($conn, $cat_id = null, $date = null){
    if($date == null && $cat_id != null){
         $sql="SELECT c.date_ordered
                   , sum(i.item_price * c.item_qty ) total_net_sale
                   , count(c.item_id) total_item_ordered
                from `cart` c
                join `items` i
                  on (c.item_id = i.item_id)
               WHERE i.cat_id = ?
                 AND c.cart_status = 'X'
                 AND c.status IN ('C','X')
                 GROUP BY c.date_ordered 
                 ORDER BY c.date_ordered DESC
                 LIMIT 30;
        ";
        $params = array();
        array_push($params, $cat_id);
        
        return query($conn, $sql, $params );
    } 
    else if($date != null && $cat_id != null) {
            $sql="SELECT  c.date_ordered 
                   , sum(i.item_price * c.item_qty ) total_net_sale
                   , count(c.item_id) total_item_ordered
                from `cart` c
                join `items` i
                  on (c.item_id = i.item_id)
               WHERE i.cat_id = ?
                 AND c.date_ordered = ?
                 AND c.cart_status = 'X'
                 AND c.status IN ('C','X')
                 GROUP BY c.date_ordered 
                 ORDER BY c.date_ordered DESC
                 LIMIT 30;
        ";
        $params = array();
        array_push($params, $cat_id, $date);
        
        return query($conn, $sql, $params );
    }
    else{
         $sql="SELECT ct.cat_desc
                   , c.date_ordered 
                   , sum(i.item_price * c.item_qty ) total_net_sale
                   , count(c.item_id) total_item_ordered
                from `cart` c
                join `items` i
                  on (c.item_id = i.item_id)
                join `category` ct
                  on (i.cat_id = ct.cat_id)
               WHERE c.date_ordered > CURRENT_DATE - 31
                 AND c.cart_status = 'X'
                 AND c.status IN ('C','X')
                 GROUP BY c.date_ordered , ct.cat_desc
                 ORDER BY c.date_ordered DESC
                 LIMIT 30;
        ";
        
        return query($conn, $sql);
    }
       
        
    }
    
    function getSalesPerfItem($conn, $item_id = NULL, $date = array()){
        
        if($item_id == NULL){
            $sql="SELECT c.date_ordered
                        , ct.cat_desc
                        , i.item_name
                        , sum(i.item_price * c.item_qty ) total_net_sale
                        , count(c.item_id) total_item_ordered
                        from `cart` c
                        join `items` i
                        on (c.item_id = i.item_id)
                        JOIN `category` ct
                          ON (i.cat_id = ct.cat_id)
                        WHERE i.item_id = ?
                        AND c.cart_status = 'X'
                        AND c.status IN ('C','X')
                        GROUP BY i.item_name, c.date_ordered, ct.cat_desc
                       ORDER BY c.date_ordered DESC, i.cat_id ASC, i.item_name ASC
                       ;";
           $params = array();
           array_push($params, $item_id);
        }
        else{
     
            $datefilter=null;
            $params = array();
            switch(count($date)){
                case 1: 
                    $datefilter=" AND c.date_ordered = ? ";
                    array_push($params, $item_id, $date[0]);
                    break;
                case 2: 
                    $datefilter=" AND c.date_ordered between ? AND ? ";
                    array_push($params, $item_id, $date[0], $date[1]);
                    break;
                case 0: break;
                default: 
                    $datefilter=" AND c.date_ordered IN ( ";
                    $x=1;
                    foreach($date as $d){ 
                       if($x === 1){
                          $datefilter .= "?";    
                       }else{
                           $datefilter .= ",?";
                       }
                       array_push($params,$item_id,$d);
                    $x++;
                    }
                    $datefilter.= ") ";
                    break;
            }
           
            $sql="SELECT c.date_ordered
                        , i.item_name
                        , ct.cat_desc
                        , sum(i.item_price * c.item_qty ) total_net_sale
                        , count(c.item_id) total_item_ordered
                        from `cart` c
                        join `items` i
                        on (c.item_id = i.item_id)
                        JOIN `category` ct
                          ON (i.cat_id = ct.cat_id)
                        WHERE i.item_id = ?
                        {$datefilter}
                        AND c.cart_status = 'X'
                        AND c.status IN ('C','X')
                        GROUP BY c.date_ordered, i.item_name , ct.cat_desc
                        ORDER BY c.date_ordered DESC, i.cat_id ASC, i.item_name ASC
                        ;";
        }
        
        return query($conn, $sql, $params);
    }



    function getCategories($conn){
        $sql = "SELECT * FROM `category`";
        $stmt=mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit;
        }
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
            $resArr = array();
          if(!empty($resultData)){
            while($row = mysqli_fetch_assoc($resultData)){
                array_push($resArr, $row);
            }
            return $resArr;
          }
            else{
                return false;
          }
            mysql_stmt_close($stmt);
    }
    
function displayItemInfo($conn, $value = "", $category = array()){
    if(sizeof($category) > 0){
        $catStr = "0";
        foreach($category as $cat){
            $catStr .= "," . $cat;
        }
        $sql="SELECT * from items WHERE cat_id in ( {$catStr} ) AND item_name like ? ;";
    }else{
        $sql="SELECT * from items WHERE item_name like ? ;";
    }
    
    $stmt=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location:index.php?error=stmtfailed");
        exit();
    }
    $value = "%{$value}%" ;
        mysqli_stmt_bind_param($stmt, "s" , $value);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $arr = array();
        while($row = mysqli_fetch_assoc($resultData)){
            array_push($arr,$row);            
        }
        return $arr;
        mysqli_stmt_close($stmt); 
}

function getOrderList($conn, $status = null, $userid = NULL, $date_ordered = null){
if($userid === null){
    if($status !== null){
          $sql_cart_list = "SELECT c.order_ref_num
                           , c.status
                           , c.date_ordered
                           , c.last_update_date
                           , c.total_amt_to_pay
                           , sum(c.item_qty) total_item_qty
                        FROM cart c
                           , items i
                       WHERE c.item_id = i.item_id
                          AND c.status IN (?)
                          AND c.confirm = 'Y'
                          group by c.order_ref_num
                           , c.status
                           , c.date_ordered
                           , c.total_amt_to_pay
                           , c.last_update_date
                        ORDER BY c.date_ordered; ";
     $stmt=mysqli_stmt_init($conn);
    
                    if (!mysqli_stmt_prepare($stmt, $sql_cart_list)){
                        return false;
                        exit();
                    }
                        mysqli_stmt_bind_param($stmt, "s" ,$status);
    }
    else{
      $sql_cart_list = "SELECT c.order_ref_num
                           , c.status
                           , c.date_ordered
                           , c.total_amt_to_pay
                           , sum(c.item_qty) total_item_qty
                        FROM cart c
                           , items i
                       WHERE c.item_id = i.item_id
                          AND c.status IN ('C','X')
                          AND c.confirm = 'Y'
                          group by c.order_ref_num
                           , c.status
                           , c.date_ordered
                           , c.total_amt_to_pay
                        ORDER BY c.date_ordered ASC; ";
     $stmt=mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql_cart_list)){
                        return false;
                        exit();
                    }
    }
              
    
}
    else{
    if($status === null){
      $sql_cart_list = "SELECT c.order_ref_num
                           , c.status
                           , c.date_ordered
                           , c.total_amt_to_pay
                           , sum(c.item_qty) total_item_qty
                        FROM cart c
                           , items i
                       WHERE c.item_id = i.item_id
                          AND c.user_id = ? 
                          AND c.status IN ('C','X')
                          AND c.confirm = 'Y'
                          group by c.order_ref_num
                           , c.status
                           , c.date_ordered
                           , c.total_amt_to_pay
                        ORDER BY c.date_ordered; ";
     $stmt=mysqli_stmt_init($conn);
    
                    if (!mysqli_stmt_prepare($stmt, $sql_cart_list)){
                        return false;
                        exit();
                    }
                        mysqli_stmt_bind_param($stmt, "s" ,$userid);
    }
    else
    {
      $sql_cart_list = "SELECT c.order_ref_num
                           , c.status
                           , c.date_ordered
                           , c.total_amt_to_pay
                           , sum(c.item_qty) total_item_qty
                        FROM cart c
                           , items i
                       WHERE c.item_id = i.item_id
                          AND c.user_id = ? 
                          AND c.status IN ( ? )
                          AND c.confir = 'Y'
                          group by c.order_ref_num
                           , c.status
                           , c.date_ordered
                           , c.total_amt_to_pay
                        ORDER BY c.date_ordered; ";
     $stmt=mysqli_stmt_init($conn);
    
                    if (!mysqli_stmt_prepare($stmt, $sql_cart_list)){
                        return false;
                        exit();
                    }
                        mysqli_stmt_bind_param($stmt, "ss" ,$userid,$status);
    }
}

  
                     
                        mysqli_stmt_execute($stmt);

                        $resultData = mysqli_stmt_get_result($stmt);
    if(!empty($resultData)){
        $arr = array();
        while($row = mysqli_fetch_assoc($resultData)){
            array_push($arr,$row);
        }
        return $arr;
    }
    else{
        return false;
    }
    
}


