<?php
session_start();
include_once "includes/db_conn.php";
include_once "includes/function.inc.php";
if(isset($_SESSION['user_type'])){
    if($_SESSION['user_type'] == 'Seller'){
    
    $USER_ID = $_SESSION['user_id'];
    
    echo $USER_ID;   
        $user_info = GetUserDetails($conn, $USER_ID );
        
        
        
        
        echo $user_info['user_fullname'];
        echo $user_info['contact_details'];
        echo $user_info['house_no_street_brgy'];
        echo $user_info['user_fullname'];
        echo $user_info['user_fullname'];
      
      
      if(isset($_POST['item_name'])){
          $p_item_name = htmlentities($_POST['item_name']);
          $p_item_desc = htmlentities($_POST['item_desc']);
          $p_item_price = htmlentities($_POST['item_price']);
          
         if( AddItem($conn,$USER_ID,$p_item_name,$p_item_desc,$p_item_price) !== false) {
             
             echo "item has been added";
         }
          else{
              echo "something wong";
          }
      }
           ?>
        <form action="seller_page.php" method="post">
            Item name :  <input type="text" name="item_name">
            <br>
            Item Desc :  <input type="text" name="item_desc">
            <br>
            Item Price :  <input type="text" name="item_price">
            <br>
            <input type="submit">
        </form>
        
    
    <?php }
}
else{
    header("location: index.php");
    
}
    
    
    
    

?>