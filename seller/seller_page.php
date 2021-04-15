<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/function.inc.php";
if(isset($_SESSION['usertype'])){
    if($_SESSION['usertype'] == 'Seller'){
    
    $USER_ID = $_SESSION['userid'];
    
        $user_info = GetUserDetails($conn, $USER_ID );
        
        
       ?>

        
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriComercio</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/fontawesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
    
<header id="header">

<div class="right">
    
<img clas ="logo" src="../img/logo1.png" alt="" width="70px" height="70px">   
</div>
        <div class="nav-bar">
            <ul>
            <li><a href="product.php">Product</a></li>
            <li><a href="order.php">Orders' Approval</a></li>
            <li><a href="order.php">Sales Report</a></li>
            </ul>
        </div>

<div class="left">

<div class="dropdown">

  <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
  <div class="fas fa-user"></div>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <a href="seller_page.php"><li><button class="dropdown-item" type="button">Profile</button></li></a>
    <a href="../form.php"><li><button class="dropdown-item" type="button">Sign Up</button></li></a>
    <a href="../sign_in.php"><li><button class="dropdown-item" type="button">Sign In</button></li></a>
    <a href="../logout.php"><li><button class="dropdown-item" type="button">Log Out</button></li></a>
  </ul>
</div>
   

</div>



</header>

<section id = "profile">

<div class = "profile-container">
    <div class = "row">
        <div class = "col-md-12">
            <div class = "card">
                <div class = "card-body">
                <h1>User Profile</h1>
                <hr>
                <form action="../form.php" method  = "GET">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" value = "<?php   echo $user_info['user_fullname']; ?>" disabled>
                        <label for="">Contact</label>
                        <input type="text" class="form-control" value = "<?php  echo $user_info['contact_details']; ?>" disabled>
                    
                    
                        <label for="">Address</label>
                        <input type="text" class="form-control" placeholder = "House Number, Street, Barangay" value = "<?php echo $user_info['house_no_street_brgy']; ?>" disabled>
                        <br>
                        <input type="text" class="form-control" placeholder = "City" value = "<?php echo $user_info['city']; ?>" disabled>
                        <br>
                        <input type="text" class="form-control" placeholder = "Province" value = "<?php echo $user_info['province']; ?>" disabled>
                        <br>
                        <input type="text" class="form-control" placeholder = "Postal Code" value = "<?php echo $user_info['postal_code']; ?>" disabled>
                        <br>

                    </div>
                </form>
                </div>

            </div>
            

           
        </div>

    </div>

</div>


</section>   
    

<section id="footer">
   <div class="footer-content">
   <img clas ="logo" src="../img/logo1.png" alt="" width="70px" height="70px">
       <h3>AgriComercio</h3>
       <p>Change The Way You Trade</p>
       <ul class="socials">
       <li><a href=""><i class="fab fa-facebook-square"></i></a></li>
       <li><a href=""><i class="fab fa-twitter-square"></i></a></li>
       <li><a href=""><i class="fab fa-instagram-square"></i></a></li>
       <li><a href=""><i class="fab fa-google-plus-square"></i></a></li>
       </ul>
   </div>
    <div class="credit text-center">&#169; copyright @ 2021 by ShareQlang</div>
</section>



    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.js"></script> 
    <script src="../js/main.js"></script>
    
</body>
</html>


<?php    

    }
}
else{
    header("location: ../sign_in.php");
    
}
    
    
    
    

?>