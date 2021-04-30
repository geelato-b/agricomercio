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
        <div class = "cart_label"> 
              <?php

               echo "<table class='table'>";
               echo "<th> Items</th>";
               echo "<th> Quantity </th>";
               echo "<th>  Price </th>";
               echo "</table>";

              ?>
        </div>

        <?php
        while($row = mysqli_fetch_assoc($resultData)){ 
            echo "<table class='table'>";
        ?>
    <div class="cart-info">

        <tr>
        <?php echo "<td>"  ?>
            <div class="cart_card">
                <div class="image">
                    <img src="img/<?php echo $row['item_img'];?>" alt="">
                </div>
                <div class="card-title">
                    <p ><?php echo $row['item_name']?>
                    Php <?php  echo number_format($row['item_price'],2); ?> 
                    
                </div>       

            </div>
            <?php echo "</td>"  ?>
       <td>
                <form action="includes/updatecart.php" method="post">
                            <input hidden type="text" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                            <input type="number" class="cart-qty" name="item_qty" value="<?php echo $row['item_qty']; ?>">
                            <button class="btn btn-success"> <i class="fas fa-check"></i> </button>
                            <a href="includes/deletecartitem.php?cartid=<?php echo $row['cart_id']; ?>" class="btn-cart">
                            <i class="fas fa-trash-alt"></i></i>
                            </a>
                </form>
                 
        </td> 
        <td>
           Php <?php echo number_format($row['subtotal_price'],2); ?>
        </td>
        </tr>
        <?php
            echo "</tr>";
            echo "</table>";
        ?>
    </div>

    <?php } ?>
    <p class="cart-sum">
    <?php $summary = getCartSummary($conn, $_SESSION['userid']); 
            foreach($summary as $key => $nval){
                    echo "Total Qty: ". $nval['total_qty'] . " pcs "; 
                    echo "<br>";
                    echo "Total Price: Php ". number_format($nval['total_price'],2);    
                    } 
                    echo "<br>";                    
        ?> 
         <a class="cart_check_out" href="">Check Out</a>
    </p>    
</section>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.js"></script> 
    <script src="js/main.js"></script>
    
</body>
</html>