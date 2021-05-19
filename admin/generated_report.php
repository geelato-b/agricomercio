<!DOCTYPE html>
<?php 
session_start();
include_once ('../includes/db_conn.php');
include_once  ('../includes/function.inc.php');

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

  <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
  <a href="user.php"><i class="fas fa-users"></i> User Management</a>
  <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> logout </a>

  
  
</div>
<main>
        <div class="main__container">
          <div class="container_fluid">
                          
                <div class="row" id="contentPanel">
                <div class="col-12">
                <?php
                
                                    $sql =" SELECT
                                    i.item_id,
                                    SUM(i.item_price * o.item_qty) Total_Sale,
                                    SUM(o.item_qty) total_item_qty,
                                    u.user_fullname,
                                    o.order_id, 
                                    o.order_number, 
                                    o.item_id, 
                                    o.user_id, 
                                    o.item_qty, 
                                    o.net_amt, 
                                    o.status, 
                                    o.tracking_order_status
                                    FROM items i
                                    JOIN orders o
                                    ON o.item_id = i.item_id 
                                    JOIN user_info u
                                    ON u.user_ref_num = i.user_id 
                                    WHERE o.status = 'C'
                                    AND o.tracking_order_status = 'C'
                                    group by o.user_id;";
                    $stmt=mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)){
                    echo "Statement Failed.";
                    exit();
                    }
                mysqli_stmt_execute($stmt);
                $resultData = mysqli_stmt_get_result($stmt);
                $arr=array();
                while($row = mysqli_fetch_assoc($resultData)){
                array_push($arr,$row);
                }
                ?>
                <div class="sum" style=" text-align-last: left; 
                                        margin-top:-1rem; 
                                        margin-bottom: 
                                        1rem; 
                                        font-weight:bold;
                                        font-size:2rem;
                                        color:green;" > 
                        <?php $summary = getOrderSummary($conn); 
                                foreach($summary as $key => $nval){
                                        echo "Total Sold Items: ". $nval['total_qty'] . " pcs "; 
                                        echo "<br>";
                                        echo "Total Income: Php ". number_format($nval['total_price'],2);    
                                        } 
                                        echo "<br>";                    
                            ?> 
                    </div>   
                <?php
                if(!empty($arr)){
                    echo "<table class='table'>";
                    echo "<thead>";
                    echo "<th> User Id </th>";
                    echo "<th> Seller </th>";
                    echo "<th> Total Items Sold</th>";
                    echo "<th> Total Sale </th>";
                   
                    echo "</thead>";
                    foreach($arr as $key => $val){
                    echo "<tr>";
                    echo "<td>" . $val ['user_id']         . "</td>";
                    echo "<td>" . $val ['user_fullname']         . "</td>";
                    echo "<td>" . $val ['total_item_qty']   . "</td>";
                    echo "<td>" . $val ['Total_Sale']          .  " </td> ";
                    echo "<td>";
                  
                    echo "</tr>";
                    }
                    echo "<tr >";

                  ?>
                    <?php
                    echo "</tr>";
                    echo "</table>";
                    }
                    else{
                    echo "<h4> No Records Found.</h4>";
                    }
                ?>
                    <div
                    class='text-center'><em>End of result</em>
                    </div>
                </div>
                </div>
          </div>          
      </main>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.js"></script> 
    <script src="js/main.js"></script>
    
</body>
</html>

