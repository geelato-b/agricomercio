<?php
if(isset($_POST['login'])){
    include_once ('db_conn.php');
    include_once ('function.inc.php');
    session_start();
  
  $p_username = htmlentities($_POST['username']);
  $p_password = htmlentities($_POST['password']);
   

  if(uidExists($conn, $p_username, $p_password)!==false){
    
     $user_info = uidExists($conn, $p_username, $p_password);
     switch($user_info['user_type'])
     {
         case 'Seller':
             $_SESSION['usertype'] = 'Seller';
             $_SESSION['userid'] = $user_info['user_id'];
             header("location: ../seller_page.php");
             break;
     }
         
     

 
  }
else{?>
    
    <h1><?php echo "Sign Up to log in";?></h1>
    <a href="../form.php"><button class="btttn">Register</button></a>


    <?php

}
}
?>








