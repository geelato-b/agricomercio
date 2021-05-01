<?php
session_start();
include_once "includes/db_conn.php";
include_once "includes/function.inc.php"; 
$searchkey="";
if (isset($_GET['searchkey'])){
    $searchkey=htmlentities($_GET['searchkey']);  
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


    <section id= "search">
        <div class = "container-fluid">
            <form action="product.php" method="GET" class="d-flex">
                <input id="searchbar" name="searchkey" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
            </form>

        </div>
    </section>



<?php    
  
 if(isset($_SESSION['usertype'])){
    if($_SESSION['usertype'] == 'Seller'){
    
    $USER_ID = $_SESSION['userid'];
    
      
        $user_info = GetUserDetails($conn, $USER_ID );
      if(isset($_POST['item_name'])){
          $p_item_name = htmlentities($_POST['item_name']);
          $p_item_desc = htmlentities($_POST['item_desc']);
          $p_item_status = htmlentities($_POST['item_status']);
          $p_item_price = htmlentities($_POST['item_price']);
          
         if( AddItem($conn,$USER_ID,$p_item_name,$p_item_desc,$p_item_status,$p_item_price) !== false) {
             
             echo "Item has been added.";
         }
          else{
              echo "Oops!Something's wrong.";
          }
      }
    }
}

?>
        
<?php
        //check if searchkey has no value
    if($searchkey == "") {
        //declare the SQL
       $sql = "SELECT i.item_id
                 , i.item_name
                  ,item_desc
                 , c.cat_desc
                 , i.item_price
                 , i.item_img
              FROM `items` i
              JOIN `category` c
                ON i.cat_id = c.cat_id ;";
    
        //initialize connection to the database.
    $stmt=mysqli_stmt_init($conn);
        //prepare the statement
     if (!mysqli_stmt_prepare($stmt, $sql)){
    echo "Statement Failed.";
    exit();
     }
    }
        //check if searchkey has value
    else{
        
            $sql = "SELECT i.item_id
                , i.item_name
                , i.item_img
                ,i.item_desc
                , c.cat_desc
                , i.item_price
                ,i.item_status
             FROM `items` i
             JOIN `category` c
               ON i.cat_id = c.cat_id
               WHERE i.item_name= ?
               OR c.cat_desc= ?;";
    
               $stmt=mysqli_stmt_init($conn);
               if (!mysqli_stmt_prepare($stmt, $sql)) {
                 echo "Statement Failed.";
                 exit();
               }
               mysqli_stmt_bind_param($stmt, "ss" , $searchkey , $searchkey);         
             }
      //it will execute the statement
       
       mysqli_stmt_execute($stmt);
      //get the results of the executed statement and put it into a variable
       $resultData = mysqli_stmt_get_result($stmt);
      //declare a container array.
       $arr=array();
       while($row = mysqli_fetch_assoc($resultData)){
           //we will do the transfer of data to another array to test 
           //if there is a result.
           array_push($arr,$row);
       }
     if(!empty($arr)){
        
         ?>
         
    
<section id="product">
    <div class="product-container">
        <?php
        foreach($arr as $key => $val){
        ?>

        <div class="product-slider">
            <div class="product-card item">
                <div class="image">
                <img src="img/<?php echo $val['item_img'] ?>" alt="1 x 1" class="card-img-top">
                </div>

                    <div class="content">
                        <h3><?php echo $val['item_name'] ?></h3>
                        <h4><?php echo $val['item_desc'] ?></h4>
                        <div class="price"><p> Php <?php echo number_format($val['item_price'],2)  ?></p>
                        </div>

                        <form action="includes/processorder.php" method= "GET">
                        <input hidden type="text" name="item_id"  value = "<?php echo $val['item_id']; ?>">
                        <label for="Quantity">Quantity</label>
                        <input  type="number" value = "1" min="1" name="item_qty">
                        <button type="submit" class = "btn-addcart">
                        <i class="fas fa-cart-arrow-down"></i>
                        </button>
                        </form>
                    </div>
            </div>
        </div>

                    <?php
                        }
                    }
                
                        ?>
    </div>
</section>

<section id="footer">
   <div class="footer-content">
   <img clas ="logo" src="img/logo1.png" alt="" width="70px" height="70px">
       <h3>AgriComercio</h3>
       <p>Change The Way You Trade</p>
       <ul class="socials">
       <li><a href=""><i class="fab fa-facebook-square"></i></a></li>
       <li><a href=""><i class="fab fa-twitter-square"></i></a></li>
       <li><a href=""><i class="fab fa-instagram-square"></i></a></li>
       <li><a href=""><i class="fab fa-google-plus-square"></i></a></li>
       </ul>
   </div>
    <div class="credit text-center">&#169; copyright @ 2021 by ShareQlang</div>
</section>
        
            <script src="js/bootstrap.bundle.js"></script>
            <script src="js/jquery.js"></script> 
            <script src="js/main.js"></script>
</body>
</html>