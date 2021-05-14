<?php
session_start();
include_once "includes/db_conn.php";
include_once "includes/function.inc.php";   
$status_logged_in = null;
if(isset($_SESSION['usertype']) && isset($_SESSION['userid']) ){
    $status_logged_in = array('status' => true, 'usertype' => $_SESSION['usertype'] );
    
    $USER_ID = $_SESSION['userid'];
    $user_info = GetUserDetails($conn, $USER_ID );
    $user = GetUserName($conn, $USER_ID );
}
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

<section id = "profile">
<div class="container">
<div class="card-body">
  <div>
    <br>
    <br>
    <img width="150px" src="img/user.png" class="rounded-circle" alt="img">        
    <br>
    <br/>
  </div>
  <form action="includes/updateprofile.php"  method  = "post" class="row g-3">
  <div class="col-md-6">
    <label for="user_name" class="form-label">User Name</label>
    <input type="text" class="form-control" id="user_name" value = "<?php echo $user['user_name']; ?>" disabled>
  </div>
  <div class="col-md-6">
    <label for="user_name" class="form-label">Status</label>
    <input type="text" class="form-control" id="user_name" value = "<?php echo $user['status']; ?>" disabled>
  </div>
  <div class="col-md-6">
    <label for="user_fullname" class="form-label">Full Name</label>
    <input type="text" class="form-control" id="user_fullname" value = "<?php echo $user_info['user_fullname']; ?>"disabled>
  </div>
  <div class="col-md-6">
    <label for="user_name" class="form-label">Contacts</label>
    <input type="text" class="form-control" id="user_name" value = "<?php echo $user_info['contact_details']; ?>" disabled>
  </div>
  
  <label for="house_no_street_brgy" class="form-label">Address</label>
  <div class="col-8">
  <label for="house_no_street_brgy" class="form-label">House Number, Street, Barangay</label>
    <input type="text" class="form-control" id="house_no_street_brgy" placeholder="House No. Street Barangay." value = "<?php  echo $user_info['house_no_street_brgy']; ?>"disabled>
  </div>
  <div class="col-6">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city" placeholder="City" value = "<?php echo $user_info['city']; ?>"disabled>
  </div>
  <div class="col-md-4">
    <label for="province" class="form-label">Province</label>
    <input type="text" class="form-control" id="province" placeholder="Province"  value = "<?php echo $user_info['province']; ?>"disabled>
  </div>
  <div class="col-md-2">
    <label for="postal_code" class="form-label">Postal Code</label>
    <input type="text" class="form-control" id="postal_code" value = "<?php echo $user_info['postal_code']; ?>" disabled>
  </div>
  </div>
</form>

</div>
</div>


</section>


<script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.js"></script> 
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

    
</body>
</html>


<?php    


?>


        
  
