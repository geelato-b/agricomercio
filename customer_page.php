<?php
session_start();
include_once "includes/db_conn.php";
include_once "includes/function.inc.php";
if(isset($_SESSION['usertype'])){
    if($_SESSION['usertype'] == 'Customer'){
    
    $USER_ID = $_SESSION['userid'];
    
        $users = GetUserName($conn, $USER_ID );
        
        
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
</header>

<section id = "custpage">
<div class= "user-prof">
        <div class="card">
            <img src="img/user.png" class="img_profile" alt="...">
            <div class="card-body">
                <form action="form.php" method  = "GET">
                            <div class="form-group">
                                    <label hidden for="">UserName</label>
                                <a href="user_profile.php"> <input type="text" class="form-content" value = "<?php   echo $users['user_name']; ?>" disabled> </a>            
                            </div>
                </form>
            </div>
        </div>    
</div>
    

</section>


<section id="profile_order">
        <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link" id="nav-pay-tab" data-bs-toggle="tab" data-bs-target="#nav-pay" type="button" role="tab" aria-controls="nav-pay" aria-selected="false"> <i class="fas fa-wallet"></i>  To Pay </button>
            <button class="nav-link" id="nav-ship-tab" data-bs-toggle="tab" data-bs-target="#nav-ship" type="button" role="tab" aria-controls="nav-ship" aria-selected="false"> <i class="fas fa-truck-loading"></i>   To Ship</button>
            <button class="nav-link" id="nav-receive-tab" data-bs-toggle="tab" data-bs-target="#nav-receive" type="button" role="tab" aria-controls="nav-receive" aria-selected="false"> <i class="fas fa-truck"></i>  To Receive</button>
            <button class="nav-link" id="nav-complete-tab" data-bs-toggle="tab" data-bs-target="#nav-complete" type="button" role="tab" aria-controls="nav-complete" aria-selected="false"> <i class="fas fa-check-square"></i> Complete</button>
            <button class="nav-link" id="nav-canceled-tab" data-bs-toggle="tab" data-bs-target="#nav-canceled" type="button" role="tab" aria-controls="nav-canceled" aria-selected="false"> <i class="fas fa-window-close"></i> Canceled</button>
        </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-pay" role="tabpanel" aria-labelledby="nav-pay-tab">bjdbcjdbcj</div>
        <div class="tab-pane fade" id="nav-ship" role="tabpanel" aria-labelledby="nav-ship-tab">jdbcjdbcd</div>
        <div class="tab-pane fade" id="nav-receive" role="tabpanel" aria-labelledby="nav-receive-tab">idiosnc</div>
        <div class="tab-pane fade" id="nav-complete" role="tabpanel" aria-labelledby="nav-complete-tab">88888</div>
        <div class="tab-pane fade" id="nav-canceled" role="tabpanel" aria-labelledby="nav-canceled-tab">00000</div>
        </div>

</section>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.js"></script> 
    <script src="js/main.js"></script>
    
</body>
</html>


<?php    

    }
}
else{
    header("location: sign_in.php");
    
}
    
    
    
    

?>
