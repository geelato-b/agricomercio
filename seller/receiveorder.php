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
            
            <li class="nav-item active">
                <a class="nav-link" href="receiveorder.php">Orders</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="about.php">About</a>
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
<p>
  <a class="btn btn-danger" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
  Order History
  </a>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
  <?php
  $sql_order_list = "SELECT 
                           o.order_number
                        ,o.order_status
                        , SUM(o.item_qty) total_item_qty
                        , SUM(i.item_price * o.item_qty) total_net_amt
                        FROM orders o
                        JOIN items i
                        ON o.item_id = i.item_id
                        WHERE o.user_id = ? 
                        AND o.status = 'C'
                        AND o.order_status = 'C'
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
               <h3 class="display-5">Order History</h3>
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
                        <td><?php echo $row['total_net_amt']; ?></td>
                        <td>
                        <?php echo $row['order_status'] == 'P' ? 'Pending for Delivery' : 'Delivered' ;?>
                        </td>
                    </tr>
                <?php }?>

                </table>
            
  </div>
</div>


</section>

</section> 
<main>
        <div class="main__container">
          <div class="container_fluid">
          <div class="row" id="contentPanel">
                  <div class="col-12">
                  
                  <?php
                  
                  
                    $sql = " SELECT i.item_id 
                                ,c.order_number
                                ,i.item_name
                                ,i.item_img
                                ,i.item_desc
                                ,i.item_price
                                ,c.order_number
                                ,c.user_id
                                ,(i.item_price * c.item_qty) net_amt
                                ,c.cart_id
                                ,c.item_qty
                                ,i.user_id
                                ,c.status
                                ,c.cart_status
                                    FROM `items` i
                                    JOIN `cart` c
                                    ON i.item_id = c.item_id
                                    WHERE i.user_id=?
                                    AND c.status ='C'
                                    AND c.cart_status ='C';";

                  $stmt=mysqli_stmt_init($conn);
                  if (!mysqli_stmt_prepare($stmt, $sql)){
                  echo "Statement Failed.";
                  exit();
                  }
                  mysqli_stmt_bind_param($stmt, "s" ,$_SESSION['userid']);
                  mysqli_stmt_execute($stmt);
                  $resultData = mysqli_stmt_get_result($stmt);
                  $arr=array();
                  while($row = mysqli_fetch_assoc($resultData)){
                  array_push($arr,$row);
                  }
                  if(!empty($arr)){

                    ?>
                    <div class="container-fluid">
                      <div class="row px-3">
                        
                          <?php
                        foreach($arr as $key => $row){ ?>
                        <div class="col-3">
                          <br>
                            <div class="card">
                                <img src="../img/<?php echo $row['item_img']; ?>" alt="1 x 1" width="100px" class="card-img-top">
                                <div class="card-body">

                                    <h5 class="card-title"><?php echo $row['item_name']?></h5>
                                   
                                    <em class="card-text" > 
                                        <?php echo ($row['item_desc']);?>
                                        <br>
                                        Php <?php echo number_format ($row['item_price'],2);?>
                                        <br><br>
                                        <label style = "color:red;" for="">Quantity : </label>
                                       <?php echo ($row['item_qty']);?>
                                        <br>
                                        <label style = "color:red;" for="">Total Price : </label>
                                       Php <?php echo number_format($row['net_amt'],2); ?> 
                                     </em>
                                </div>
                                <div class="card-footer">
                                <form action="../includes/order.php" method= "post">
                                    <input hidden type="text" name="order_number"  value = "<?php echo $row['order_number']; ?>">     
                                    <input hidden type="text" name="user_id"  value = "<?php echo $_SESSION['userid']; ?>">
                                    <input hidden type="text" name="item_id"  value = "<?php echo $row['item_id'] ?>">
                                    <input hidden type="number" name="item_qty" value = "<?php echo $row['item_qty']; ?>" >
                                    <input hidden type="number" name="net_amt" value = "<?php echo $row['net_amt']; ?>" >
                                    <div class="input-group" >
                                        <button  type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i></button>  
                                    </div>  
                                </form>

                              </div>
                        </div>
                   </div>
                      <?php 
                
                        echo "</tr>";
                      }
                  echo "</table>";
                   }
                ?>  
                  </div>
                  </div>

                  <div class="d-grid gap-2 col-6 mx-auto" style="margin-top:2rem;">
                    <a href="confirm_order.php" type="button" class="btn btn-success" type="button">Confirm</a>
                 </div>
                  
          </div>

          
      </main>

      <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.js"></script> 
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.js"></script>

</body>
</html>