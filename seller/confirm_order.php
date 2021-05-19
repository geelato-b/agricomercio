<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/function.inc.php";   
$status_logged_in = null;
if(isset($_SESSION['usertype']) && isset($_SESSION['userid']) ){
    $status_logged_in = array('status' => true, 'usertype' => $_SESSION['usertype'] );
    
    $USER_ID = $_SESSION['userid'];
    $user = GetUserName($conn, $USER_ID );
}
 ?>

<!DOCTYPE html>
<html>
<head>
   <title>Seller</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link rel="stylesheet" href="bootstrap.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <a class="nav-link" href="index.php">
        <input style="border:none;
                      background:transparent;
                      color:white;
                     font-size:2rem;
                      font-weight:bold;
                      width:8rem;
                      ext-decoration: none;" type="text" class="form-control" id="user_name" value = "<?php echo $user['user_name']; ?>"disabled >
          <span class="sr-only">(current)</span>
    </a>
  
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="userprofile.php">Profile</a>
            </li>
            </li>
                    <li class="nav-item active">
                <a class="nav-link" href="receiveorder.php">Orders</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../about.php">About</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="product.php">Items</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../logout.php">Log Out</a>
            </li>
            </ul>
        </div>
</nav>
<!-- end of navbar -->
<section>
<?php
    if(isset($_GET['process_order'])){
        $sql_upd = "UPDATE `orders`
                        SET status = 'C'
                    WHERE  user_id = ? ;";
        $stmt_upd = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
        header("location: ?error=8"); //update failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_upd,"s",$_SESSION['userid']);
        mysqli_stmt_execute($stmt_upd);
        header("location: ?confirm_order=1");
    }
    else if(isset($_GET['confirm_order'])){
         $sql_order_list = "SELECT 
                           o.order_number
                        ,o.tracking_order_status
                        , SUM(o.item_qty) total_item_qty
                        , SUM(i.item_price * o.item_qty) total_net_amt
                        FROM orders o
                        JOIN items i
                        ON o.item_id = i.item_id
                        WHERE o.user_id = ? 
                        AND o.status = 'C'
                        AND o.tracking_order_status = 'P'
                        AND o.order_number IS NOT NULL
                        GROUp BY o.order_number; ";
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
                        <td><?php echo $row['total_item_qty'];  ?>pcs</td>
                        <td><?php echo $row['total_net_amt']; ?></td>
                        <td>
                        <?php echo $row['tracking_order_status'] == 'P' ? 'Pending for Delivery' : 'Delivered' ;?>
                        </td>
                    </tr>
                <?php }?>

                </table>
                
            </div>
            <a href="index.php" type = "button" class= "btn btn-success">Home</a>
        </div>
    <?php }
    else{ 
     ?>

</section>
  
        
<section id="order-page">

    <?php
        $sql_cart_list = "SELECT o.order_id
                        ,i.item_id
                        , i.item_name
                        , i.item_img
                        , i.item_price
                        , o.item_qty
                        , o.user_id
                        , (i.item_price * o.item_qty) subtotal_price
                        FROM orders o
                        JOIN items i
                        ON o.item_id = i.item_id
                        WHERE o.user_id = ? 
                        AND o.status = 'P'
                        AND o.tracking_order_status = 'P'; ";
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
            <h4 class="text-center text-info p-2">Confirm your Items!</h4>
            
            
            <table class="table table-hover">
                <thead>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Total Amount</th>
                    <th>Delete</th>
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
                <td>
                    <div class="Checkout_card">
                    <form action="../includes/deleteorderitem.php" method="get">
                        <input hidden type="text" name="order_id" value="<?php echo $row['order_id']; ?>" >
                        <div class="input-group">  
                            <button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"></i></i> </button>
                        </div>
                    </form>
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
        <a href="?process_order" class="btn btn-lg btn-success">Confirm</a>
    </div>   
</section>
   
    <?php }
    ?>

 <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.js"></script> 
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.js"></script>
    
</body>
</html>