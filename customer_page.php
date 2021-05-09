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
</header>

<section id = "custpage">
<div class= "user-prof">
        <div class="card">
            <img src="img/user.png" class="img_profile" alt="...">
            <div class="card-body">
                <form action="form.php" method  = "GET">
                            <div class="form-group">
                                    <label hidden for="">UserName</label>
                                <a href="user_profile.php"> <input type="text" class="form-content" value = "<?php   echo $user['user_name']; ?>" disabled> </a>            
                            </div>
                </form>
            </div>
        </div>    
</div>
    

</section>


<section id="profile_order">
        <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link" id="nav-receive-tab" data-bs-toggle="tab" data-bs-target="#nav-receive" type="button" role="tab" aria-controls="nav-receive" aria-selected="true"> <i class="fas fa-truck"></i>  To Receive</button>
            <button class="nav-link" id="nav-complete-tab" data-bs-toggle="tab" data-bs-target="#nav-complete" type="button" role="tab" aria-controls="nav-complete" aria-selected="false"> <i class="fas fa-check-square"></i> Complete</button>
        </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade" id="nav-receive" role="tabpanel" aria-labelledby="nav-receive-tab">
    <?php
    if(isset($_GET['process_checkout'])){
        $sql_upd = "UPDATE `cart`
                        SET status = 'X'
                    WHERE cart_status = 'C'
                      AND status <> 'X'
                      AND user_id = ? ;";
        $stmt_upd = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
        header("location: ?error=8"); //update failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_upd,"s",$_SESSION['userid']);
        mysqli_stmt_execute($stmt_upd);
        header("location: ?customer_page=1");

    }
     
    else{ 
        $sql_cart_list = "SELECT 
                         i.item_name
                        , i.item_img
                        , i.item_price
                        , c.item_qty
                        , c.user_id
                        , c.item_id
                        , c.status
                        , (i.item_price * c.item_qty) subtotal_price
                        FROM cart c
                        JOIN items i
                        ON i.item_id = c.item_id
                        WHERE  c.user_id= ? 
                        AND c.status = 'C'
                        AND c.cart_status = 'C'; ";
                        $stmt=mysqli_stmt_init($conn);
        
                if (!mysqli_stmt_prepare($stmt, $sql_cart_list)){
                    header("location: index.php?error=stmtfailed");
                    exit();
                    }
                    mysqli_stmt_bind_param($stmt, "s" ,$_SESSION['userid']);
                    mysqli_stmt_execute($stmt);
                    $resultData = mysqli_stmt_get_result($stmt);        
    ?>
       <table class='table'>
               <thead>
                   <th> Items</th>
                   <th> Quantity </th>
                   <th> Total Net Amount </th>
               </thead>
    <tbody>
        <?php
        while($row = mysqli_fetch_assoc($resultData)){ ?>
        <tr>
          <td>
            <div class="cart_card card">
                <div class="image"><img src="img/<?php echo $row['item_img'];?>" class="card-img-top" alt=""></div>
                <div class="card-title">
                   
                    <h2><?php echo $row['item_name']?></h2>
                    <p class="lead"> 
                       Php <?php  echo number_format($row['item_price'],2); ?> 
                    </p>
                </div>  
            </div>
           </td>
           <td>
            <div class="cart_card">
                    <?php  echo($row['item_qty']); ?> pcs

            </div>        
           </td> 
           <td>
            <div class="cart_card">
                Php <?php echo number_format($row['subtotal_price'],2); ?>
            </div>
           </td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
                 <div class="d-grid gap-2 col-6 mx-auto" style="margin-top:2rem; padding-bottom:5rem;">
                    <a href="?process_checkout" type="button" class="btn btn-success" type="button">Orders Receive</a>
                 </div>
        </div>
        <div class="tab-pane fade" id="nav-complete" role="tabpanel" aria-labelledby="nav-complete-tab">
        <?php
        $sql_cart_list = "SELECT 
                         i.item_name
                        , i.item_img
                        , i.item_price
                        , c.item_qty
                        , c.user_id
                        , c.item_id
                        , c.status
                        , (i.item_price * c.item_qty) subtotal_price
                        FROM cart c
                        JOIN items i
                        ON i.item_id = c.item_id
                        WHERE  c.user_id= ? 
                        AND c.status = 'X'
                        AND c.cart_status = 'C'; ";
                        $stmt=mysqli_stmt_init($conn);
        
                if (!mysqli_stmt_prepare($stmt, $sql_cart_list)){
                    header("location: index.php?error=stmtfailed");
                    exit();
                    }
                    mysqli_stmt_bind_param($stmt, "s" ,$_SESSION['userid']);
                    mysqli_stmt_execute($stmt);
                    $resultData = mysqli_stmt_get_result($stmt);        
    ?>
       <table class='table'>
               <thead>
                   <th> Items</th>
                   <th> Quantity </th>
                   <th> Total Net Amount </th>
               </thead>
    <tbody>
        <?php
        while($row = mysqli_fetch_assoc($resultData)){ ?>
        <tr>
          <td>
            <div class="cart_card card">
                <div class="image"><img src="img/<?php echo $row['item_img'];?>" class="card-img-top" alt=""></div>
                <div class="card-title">
                   
                    <h2><?php echo $row['item_name']?></h2>
                    <p class="lead"> 
                       Php <?php  echo number_format($row['item_price'],2); ?> 
                    </p>
                </div>  
            </div>
           </td>
           <td>
            <div class="cart_card">
                    <?php  echo($row['item_qty']); ?> pcs

            </div>        
           </td> 
           <td>
            <div class="cart_card">
                Php <?php echo number_format($row['subtotal_price'],2); ?>
            </div>
           </td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
        
        </div>
        
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

?>
