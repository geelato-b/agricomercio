<?php
include_once ('includes/db_conn.php');
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
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
    
<header id="header">
    <div class="right">
        <img clas ="logo" src="img/logo1.png" alt="" width="70px" height="70px">
        
    </div>

    <div class="nav-bar">
            <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="about.php">About</a></li>
            </ul>
        </div>

    <div class="left">
        

            <a href="profile.php"><div class="fas fa-user"></div></a>
            <a href="cart.php"><div class="fas fa-shopping-cart"></div></a>

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
                <form action="form.php" method  = "GET">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" value = "" disabled>
                        <label for="">Username</label>
                        <input type="text" class="form-control" value = "" disabled>
                        <label for="">Password</label>
                        <input type="password" class="form-control" value = "" disabled>
                        <label for="">Address</label>
                        <input type="text" class="form-control" placeholder = "House Number, Street, Barangay" value = "" >
                        <br>
                        <input type="text" class="form-control" placeholder = "City" value = "" >
                        <br>
                        <input type="text" class="form-control" placeholder = "Province" value = "">
                        <br>
                        <input type="text" class="form-control" placeholder = "Postal Code" value = "" >
                        <br>
                        <button type="submit" name="submit" value="submit" class ="sbt">Submit</button>
                       

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