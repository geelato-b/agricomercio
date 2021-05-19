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
<?php
    if(isset($_GET['process_checkout'])){
        
        $order_number = uniqid() . random_int(10000,99999);
        
        $sql_upd = "UPDATE `cart`
                        SET status = 'C'
                          , order_number = ?
                    WHERE cart_status = 'C'
                    AND status <> 'C'
                      AND user_id = ? ;";
        $stmt_upd = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
        header("location: ?error=8"); //update failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_upd,"ss",$order_number,$_SESSION['userid']);
        mysqli_stmt_execute($stmt_upd);
        header("location: ?checkedout=1");

    }
    else if(isset($_GET['checkedout'])){
         $sql_order_list = "SELECT 
                           c.order_number
                           ,c.cart_status
                        , SUM(c.item_qty) total_item_qty
                        , SUM(i.item_price * c.item_qty) total_net_amt
                        FROM cart c
                        JOIN items i
                        ON c.item_id = i.item_id
                        WHERE c.user_id = ? 
                        AND c.status = 'C'
                        AND c.cart_status = 'C'
                        AND c.order_number IS NOT NULL
                        GROUp BY c.order_number; ";
                        $stmt=mysqli_stmt_init($conn);
        
                if (!mysqli_stmt_prepare($stmt, $sql_order_list)){
                    header("location: ?error=failedcheckout");
                    exit();
                    }
                    mysqli_stmt_bind_param($stmt, "s" ,$_SESSION['userid']);
                    mysqli_stmt_execute($stmt);

                    $resultData = mysqli_stmt_get_result($stmt); ?>
        <div class="container">
            <div class="row">
               <h1 class="display-5">Summary of Orders</h1>
                <table class="table table-hover">
                    <thead>
                        <th>Order Number</th>
                        <th>Total Item Qty</th>
                        <th>Total Net Amt</th>
                        <th>Status</th>
                       
                    </thead>
                <?php while($row = mysqli_fetch_assoc($resultData)){ ?>
                    <tr>
                        <td><?php echo $row['order_number']; ?></td>
                        <td><?php echo $row['total_item_qty']; ?></td>
                        <td> Php <?php echo number_format($row['total_net_amt'],2); ?></td>
                        <td><?php echo $row['cart_status'] == 'C' ? 'Check Out and Waiting for Delivery' : 'Delivered' ;?></td>
                    </tr>

                <?php }?>
                </table> 
            </div>
        </div>
       
    <?php }
    else{ ?>

    
        
<section id="checkout-page">

    <?php
        $sql_cart_list = "SELECT c.cart_id
                        ,i.item_id
                        , i.item_name
                        , i.item_img
                        , i.item_price
                        , c.item_qty
                        , c.user_id
                        , (i.item_price * c.item_qty) subtotal_price
                        FROM cart c
                        JOIN items i
                        ON c.item_id = i.item_id
                        WHERE c.user_id = ? 
                        AND c.status = 'P'
                        AND c.cart_status = 'C'; ";
                        $stmt=mysqli_stmt_init($conn);
        
                if (!mysqli_stmt_prepare($stmt, $sql_cart_list)){
                    header("location: index.php?error=stmtfailed");
                    exit();
                    }
                    mysqli_stmt_bind_param($stmt, "s" ,$_SESSION['userid']);
                    mysqli_stmt_execute($stmt);

                    $resultData = mysqli_stmt_get_result($stmt)          
                    
    ?>


        <div class = "checkout_label"> 
            <h4 class="text-center text-info p-2">Confirm your order!</h4>
            
            
            <table class="table table-hover">
                <thead>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Total Amount</th>
                </thead>
                
                <tbody>
   <?php
        while($row = mysqli_fetch_assoc($resultData)){  ?>
                <tr>

                <td>
                    <div class="Checkout_card">

                        <div class="card-title">
                            <?php echo $row['item_name']?>
                        </div>       

                    </div>
                </td>
               <td>
                    <div class="Checkout_card">
                    <p ><?php echo $row['item_qty']?> pcs     
                    </div>        
                </td> 
                <td>
                    <div class="Checkout_card">
                        Php <?php echo number_format($row['subtotal_price'],2); ?>
                    </div>
                </td>


                </tr>

    <?php } ?>
                </tbody>
            </table>
                           
        </div>
               
    <div class="checkout-sum">
        <?php $summary = getCartSummary($conn, $_SESSION['userid']); 
                foreach($summary as $key => $nval){
                        echo "Total Qty: ". $nval['total_qty'] . " pcs "; 
                        echo "<br>";
                        echo "Total Price: Php ". number_format($nval['total_price'],2);    
                        } 
                        echo "<br>";                    
            ?> 
        <a href="?process_checkout" class="btn btn-lg btn-success">Confirm</a>
    </div>   
</section>
   
    <?php }
    ?>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.js"></script> 
    <script src="js/main.js"></script>
</body>
</html>
