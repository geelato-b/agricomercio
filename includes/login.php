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
             $_SESSION['userid'] = $user_info['user_ref_num'];
             header("location: ../seller/");
             break;

        case 'Customer':
            $_SESSION['usertype'] = 'Customer';
            $_SESSION['userid'] = $user_info['user_ref_num'];
            header("location: ../index.php");
            break; 

       case 'Admin':
            $_SESSION['usertype'] = 'Admin';
            $_SESSION['userid'] = $user_info['user_ref_num'];
            header("location: ../admin/admin.php");
            break;        
     }
         
  }
else{


   
   header("location: ../sign_in.php");

   


 

}
}
?>














