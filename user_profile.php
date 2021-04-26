<?php
session_start();
include_once "includes/db_conn.php";
include_once "includes/function.inc.php";
if(isset($_SESSION['usertype'])){
    if($_SESSION['usertype'] == 'Customer'){

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


<section id = "profile">

<div class = "profile-container">
    <div class = "row">
        <div class = "col-md-12">
            <div class = "card">
                <div class = "card-body">
                <h1>User Profile</h1>
                <hr>
                <form action="includes/updateprofile.php"  method  = "post">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" value = "<?php   echo $user_info['user_fullname']; ?>">
                        <label for="">Contact</label>
                        <input type="text" class="form-control" value = "<?php  echo $user_info['contact_details']; ?>">
                        <label for="">Address</label>
                        <input type="text" class="form-control" placeholder = "House Number, Street, Barangay" value = "<?php echo $user_info['house_no_street_brgy']; ?>" >
                        <br>
                        <input type="text" class="form-control" placeholder = "City" value = "<?php echo $user_info['city']; ?>" >
                        <br>
                        <input type="text" class="form-control" placeholder = "Province" value = "<?php echo $user_info['province']; ?>">
                        <br>
                        <input type="text" class="form-control" placeholder = "Postal Code" value = "<?php echo $user_info['postal_code']; ?>">
                        <br>
                        <button class="update_prof">Update</button>

                    </div>
                </form>
                
                </div>

            </div>
            

           
        </div>

    </div>

</div>

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


        
  
