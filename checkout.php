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
                        $sql_cart_count = "SELECT COUNT(*) cartcount FROM `cart` 
                                            WHERE status = 'P'
                                            AND cart_status = 'C'
                                            AND user_id = ?;";
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
                        
                    </thead>
                <?php while($row = mysqli_fetch_assoc($resultData)){ ?>
                    <tr>
                        <td><?php echo $row['order_number']; ?></td>
                        <td><?php echo $row['total_item_qty']; ?></td>
                        <td><?php echo $row['total_net_amt']; ?></td>
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

                    $resultData = mysqli_stmt_get_result($stmt);
                    
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
