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

    <nav class="navbar">
        <ul>

        <li><a href="index.php">Home</a></li>
        <li><a href="product.php">Product</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="about.php">About</a></li>
        </ul>
    </nav>

</header>

<section id="cart-page">
    <?php $summary = getCartSummary($conn, $_SESSION['userid']); 
                            foreach($summary as $key => $nval){
                            echo "(". $nval['total_qty'] . " pcs )";    
                            }
                            
                            ?> 

    <?php
        $sql_cart_list = "SELECT c.cart_id
                        , i.item_name
                        , i.item_img
                        , i.item_price
                        , c.item_qty
                        , c.user_id
                        , c.cart_status
                        , (i.item_price * c.item_qty) subtotal_price
                        FROM cart c
                        JOIN items i
                        ON c.item_id = i.item_id
                        WHERE c.user_id = ? 
                        AND c.status = 'P'; ";
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
                <form action="includes/updatecart.php" method="post">
                            <input hidden type="text" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                            <input type="number" class="cart-qty" name="item_qty" min="1" value="<?php echo $row['item_qty']; ?>">
                            <input type="Hidden" name="confirm_cart" value="<?php echo $row['cart_status'] == 'P' ? 'C' : 'P' ; ?>">
                            <p class="lead"><?php echo $row['cart_status'] == 'P' ? 'For Confirmation' : 'Confirmed' ; ?></p>
                            <button class="btn btn-success"> <i class="fas fa-clipboard-check"></i>  <?php echo $row['cart_status'] == 'P' ? 'Confirm' : 'Unconfirm' ; ?> </button>
                            <a href="includes/deletecartitem.php?cartid=<?php echo $row['cart_id']; ?>" class="btn-cart">
                            <i class="fas fa-trash-alt"></i>
                            </a>
                </form>

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
    <div class="cart-sum">
        <?php $summary = getCartSummary($conn, $_SESSION['userid']); 
                foreach($summary as $key => $nval){
                        echo "Total Qty: ". $nval['total_qty'] . " pcs "; 
                        echo "<br>";
                        echo "Total Price: Php ". number_format($nval['total_price'],2);    
                        } 
                        echo "<br>";                    
            ?> 

                        <?php
                            if(isset($status_logged_in)){
                            switch($status_logged_in['usertype']){
                                case 'Customer':
                          ?>
                            <div class="checkout">
                                <a  style = " font-size: 3rem;" class="btn btn-success"  href="checkout.php" role="button">
                                Check Out
                                </a>
                            </div>   
                           
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
                <br>
                    <h3>Sign In to see cart items</h3>
                <?php }
                ?>

        
             
      
        
    </div>   
</section>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.js"></script> 
    <script src="js/main.js"></script>
    
</body>
</html>
