<?php
session_start();
include_once "includes/db_conn.php";
include_once "includes/function.inc.php";   
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriComercio</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

</head>
<body>
    

<header id="header">

<div class="right">
    <img clas ="logo" src="img/logo1.png" alt="" width="70px" height="70px">
    <div class="fas fa-bars" id="bars"></div>
</div>

<div class="left">

        <div class="dropdown">
        <a href="cart.php"><div class="fas fa-shopping-cart"></div>
            <?php 
                        $sql_cart_count = "SELECT COUNT(*) cartcount FROM `cart` WHERE status = 'P' AND user_id = ?;";
                        $stmt=mysqli_stmt_init($conn);
    
                    if (!mysqli_stmt_prepare($stmt, $sql_cart_count)){
                        header("location: index.php?error=stmtfailed");
                        exit();
                    }
                        mysqli_stmt_bind_param($stmt, "s" ,$_SESSION['userid']);
                        mysqli_stmt_execute($stmt);

                        $resultData = mysqli_stmt_get_result($stmt);

                        if($row = mysqli_fetch_assoc($resultData)){ ?>
                            <span class="badge bg-danger"><?php echo $row['cartcount']; ?></span>
                        <?php }
                       
                        ?>
            
            </a>
            
                <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="fas fa-user"></div>
                </button>
                
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <a href="customer_page.php"><li><button class="dropdown-item" type="button">Profile</button></li></a>
                    <a href="form.php"><li><button class="dropdown-item" type="button">Sign Up</button></li></a>
                    <a href="sign_in.php"><li><button class="dropdown-item" type="button">Sign In</button></li></a>
                    <a href="logout.php"><li><button class="dropdown-item" type="button">Log Out</button></li></a>
                </ul>
        </div>

</div>

<nav class="navbar">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="product.php">Product</a></li>
<li><a href="services.php">Services</a></li>
<li><a href="about.php">About</a></li>
</ul>
</nav>

</header>

<body>
<section id="home">
       
       <div class="slide">
           <div class="row">
               <div class="col-2">
                   <div class="content text-center text-md-left pl-md-3 ml-md-3">
                       
                       <h1>AgriComercio - Change The Way</h1>
                       <h1>You Trade.</h1>
                       <h2>Right out of the Farm!</h2>
                       <h2>Reap Fresh, Eat Fresh</h2>
               
                            <a href="sign_in.php"><button class="btn">Sign In &#8594;</button></a>
                   </div>
               </div>
               <div class="col-2">
                   <img class="img" src="img/Ag1.png" alt="">
               </div>
           </div>
       </div>
   
      
   </section>


   <section id="Agricomercio">
       <div class="Agri">
       <h1>What is AgriComercio?</h1>
        <h2>AgriComercio is a E-commerce Website that focuses on selling Agri-Goods</h2>
        <h2>AgriComercio helps the customers and retailer in buying products from larger numbr of farmers</h2>
       </div>
    
   
   </section>


   <section id="mission">
    <h1>Mission:</h1>
   <h2>To provide technical services to 
   farmers,merchants, and farm labourers to help them expand their 
   business and provide them a wider market.</h2>
   
   </section>


   <section id="vision">
    <h1>Vision:</h1>
   <h2>To provide a helping hand to the farmers and farm labourers in their lives 
   through the meduim of technology, thereby, improving the their agricultural market</h2>
   
   </section>


   <section id="footer">
   <div class="footer-content">
   <img clas ="logo" src="img/logo1.png" alt="" width="70px" height="70px">
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






<script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.js"></script> 
    <script src="js/main.js"></script>
    
</body>
</html>