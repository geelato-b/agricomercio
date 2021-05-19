<?php 
session_start();
include_once ('../includes/db_conn.php');
include_once  ('../includes/function.inc.php');
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

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/fontawesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

</head>
<body>

<header id="header">

<div class="right">
    <div class="fas fa-bars" id="bars"></div>

</div>
<div class="left">
        <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="fas fa-user"></div>
                </button>
                
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <a href="../logout.php"><li><button class="dropdown-item" type="button">Log Out</button></li></a>
                </ul>
        </div>

</div>
</header>

<!-- Side navigation -->

<body>
<div class="sidenav">
  <div class="sidenav-title">
    <div class="sidenav_image">
      <img src="../img/logo1.png" alt=""width = "90px ">
      <h1>AgriComercio</h1>
    </div>
  </div>

  <a href="index.php"><i class="fas fa-truck"></i> Delivery </a>
  <a href="order_history.php"><i class="fas fa-clipboard-list"></i> Delivered Items </a>
  <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> logout </a>

  
</div>

<main>

<section id="cart-page">
    <?php $summary = getCartSummary($conn, $_SESSION['userid']); 
                            foreach($summary as $key => $nval){
                            echo "(". $nval['total_qty'] . " pcs )";    
                            }
                            
                            ?> 

    <?php
        $sql_cart_list = "SELECT o.order_id
                        , i.item_name
                        , i.item_img
                        , i.item_price
                        , o.item_qty
                        , o.user_id
                        , o.tracking_order_status
                        , (i.item_price * o.item_qty) subtotal_price
                        , uf.user_fullname
                        , uf.house_no_street_brgy
                        , uf.city
                        , uf.province
                        , uf.postal_code
                        , uf.contact_details
                        FROM orders o
                        JOIN items i
                        ON o.item_id = i.item_id
                        JOIN user_info uf
                        ON o.user_ref_num = uf.user_ref_num
                        WHERE o.status = 'C'
                        AND o.tracking_order_status= 'C'; ";
                        $stmt=mysqli_stmt_init($conn);
        
                if (!mysqli_stmt_prepare($stmt, $sql_cart_list)){
                    header("location: index.php?error=stmtfailed");
                    exit();
                    }
                   
                    mysqli_stmt_execute($stmt);

                    $resultData = mysqli_stmt_get_result($stmt);
                    
    ?>


        
       <table class='table'>
               <thead>
                    <th> Customer Info</th>
                   <th> Items</th>
                   <th> Quantity </th>
                   <th> Total Net Amount </th>
               </thead>
    <tbody>
        <?php
        while($row = mysqli_fetch_assoc($resultData)){ ?>
        <tr>
        <td>
        <div class="cart_card">
                    <h3><?php echo $row['user_fullname']?></h3>
                    <br>
                    <p class="lead" style="font-weight:bold;"> 
                     <label for="">Address:</label>
                     <br>
                     <?php echo $row['house_no_street_brgy']?></h2>, 
                     <?php echo $row['city']?></h2>,
                     <?php echo $row['province']?></h2>,
                     <?php echo $row['postal_code']?></h2>
                    </p>
                    <br>
                    <p class="lead" style="font-weight:bold; ;"> 
                     <label for="">Contact details:</label>
                     <br>
                     <?php echo $row['contact_details']?> 
                     
                    </p>
                </div>  
          </div>
           </td>
          <td>
            <div class="cart_card card">
                <div class="image"><img src="../img/<?php echo $row['item_img'];?>" class="card-img-top" alt="1x1"></div>
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
                            <input hidden type="text" name="order_id" value="<?php echo $row['order_id']; ?>">
                             <?php  echo $row['item_qty']; ?> pcs 
                            <input type="Hidden" name="confirm_order" value="<?php echo $row['tracking_order_status'] == 'P' ? 'C' : 'P' ; ?>">
                            <p class="lead" style="color:red; font-size:2rem;"><?php echo $row['tracking_order_status'] == 'P' ? 'For Delivery' : 'Delivered' ; ?></p>
                            </a>
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
</section>



</main>

<script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.js"></script> 
    <script src="js/main.js"></script>
    
</body>
</html>

