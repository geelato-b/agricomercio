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

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
<header id="header">
    <nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
        <div class="right">
        <img clas ="logo" src="img/logo2.png" alt="" width="100px" height="100px">
                
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span   class="navbar-toggler-icon"><i style= "color:black; " class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="product.php">Products</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="services.php">Services</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="About.php">About Us</a>
            </li>
            
        </ul>

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
                
                    <?php
                    if(isset($status_logged_in)){
                            switch($status_logged_in['usertype']){
                                case 'Customer':
                            ?>
                            <a href="customer_page.php"><li><button class="dropdown-item" type="button">Profile</button></li></a>
                            <a href="logout.php"><li><button class="dropdown-item" type="button">Log Out</button></li></a>
                    <?php        break;
                                case 'Admin': 
                                header("location: admin/admin.php");
                                    break;
                                case 'Seller':
                                header("location: seller/index.php");
                                break;
                            }
                    }
                    else{ ?>
                        <a href="form.php"><li><button class="dropdown-item" type="button">Sign Up</button></li></a>
                        <a href="sign_in.php"><li><button class="dropdown-item" type="button">Sign In</button></li></a>
                    <?php }
                    ?>
                
                </ul>
            </div>
        </div>
        
        </div>
    </div>
    </nav>
</header>
<section id="sign-in">  
    <div class="slide">
        <div class="row">
            <div class="col">
            
            <img class="sigin_img" src="img/bg.svg" alt="">
            </div>
            <div class="col">
            
                <div class="form-box">
                    <div class="button-box">
                    
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
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

    
</body>
</html>





