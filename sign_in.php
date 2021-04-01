<?php
include_once ('includes/db_conn.php');
include_once ('includes/function.inc.php');
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
        <div class="fas fa-bars" id="bars"></div>
        
    </div>

    <div class="left">
        <div class="search-container">
            <label for="search" class="fas fa-search"></label>
            <input type="search" placeholder="" id="search">
            

        
        </div>

            <a href="profile.php"><div class="fas fa-user"></div></a>
            <a href="cart.php"><div class="fas fa-shopping-cart"></div></a>

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


<section id="sign-in">  
    <div class="slide">
        <div class="row">
            <div class="col-2">
                <img src="img/bg.svg" alt="">
            </div>
            
            <div class="col-2">
                <div class="form-box">
                    <div class="button-box">
                        <div id="btn"></div>
                        <div class="login">
                            <h3>Log In</h3>
                        </div>
                    </div>
    
                    <form action="includes/login.php" method="POST" id="login" class="input-group" >
                        <input type="text" name="username" class="input-field" placeholder="Username" required>
                        
                        <input type="Password" name="password" class="input-field" placeholder="Password" required>
                        <button type="submit" name="login"value="login" class="submit-btn">Log In</button>
                        <br>
                        <div>
                            <br><br>
                        <a  href="form.php">Don't have an account yet?</a>
                
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





