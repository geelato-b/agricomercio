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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

</head>
<body>

<header id="header">
    <nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
        <div class="right">
                <img clas ="logo" src="img/logo2.png" alt="" width="100px" height="100px">
                <br>
            </div>
        </a>
        <button  class="navbar-toggler " type="button " data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a href="form.php"><button class="dropdown-item" type="button">Sign Up</button></a>
                        <a href="sign_in.php"><button class="dropdown-item" type="button">Sign In</button></a>
                    <?php }
                    ?>
                
                </ul>
            </div>
        </div>
        
        </div>
    </div>
    </nav>
</header>

    <section id="home">
    <?php
                if(isset($status_logged_in)){ ?>
                    <h3 class="display-3">Welcome User!</h3>
                <?php }
                ?>
       
        <div class="slide">
            <div class="row">
                <div class="col">
                    <div class="content-home ">
                    
                        <h1>AgriComercio - Change The Way You Trade</h1>
                        <h2>Right out of the Farm!</h2>
                        <h2>Reap Fresh, Eat Fresh</h2>
                        <?php
                if(isset($status_logged_in)){
                          switch($status_logged_in['usertype']){
                              case 'Customer':
                          ?>
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
                     <a href="sign_in.php"><button class="btn-home">Sign In &#8594;</button></a>
                <?php }
                ?>
                
                           
                    </div>
                </div>
                <div class="col">
                    <img class="img_home" src="img/Ag1.png" alt="">
                </div>
            </div>
        </div>
    
       
    </section>


    <div class="caption">
        <h2>"Finest Product, Finest Agriculture"</h2>
        <a href="product.php" class="btn-promo">Shop Now 🛍</a>
    
    </div> 


<section id="product-category">
<div class="caption">
        <h2>Category</h2>
        
    </div>
    <div class="category-cont">
    <?php
            $categories = getCatList($conn);
                    foreach($categories as $key => $val ){ ?>
        <div class="category-slider">
            <div class="category-card">
                
                    <div class="category-img">
                    <a href="itemlist.php?category=<?php echo $val['cat_id']; ?>&catname=<?php echo $val['cat_desc']; ?>">
                        <img src="img/<?php echo $val['cat_img'];?>" alt="" width="200px" height="200px"></a>
                        </div>
                        <div class="content-cat">
                        <h4><?php echo $val['cat_desc'];?></h4>
                        </div>
                       
    
            </div> 
            <?php }  ?>          
        </div>       
    </div>
</section> 

     <section id="promo">

    <div class="row">
        <div class="col">
            <img src="img/p1.jpg" alt="">
        </div>
        <div class="col">
            <img src="img/p2.jpg" alt="">
        </div>
    </div>
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
        $sql="SELECT i.item_id,
        i.item_img,
        i.item_name, 
        i.item_status,
        i.item_desc, 
        c.cat_desc, 
        i.item_price 
        FROM items i 
        JOIN category c 
        ON i.cat_id = c.cat_id
        WHERE i.item_id BETWEEN 5 AND 12;";

  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
     echo "Statement Failed.";
     exit();
  }

   mysqli_stmt_execute($stmt);
  //get the results of the executed statement and put it into a variable
   $resultData = mysqli_stmt_get_result($stmt);
  //declare a container array.
   $arr=array();
   while($row = mysqli_fetch_assoc($resultData)){
      
       array_push($arr,$row);
   }
      ?>
      
<section id="product">
<h1 class="heading">Feature Products</h1>
    <div class="product-container">
    



        <?php
        foreach($arr as $key => $val){
        ?>

        <div class="product-slider">
            <div class="product-card item">
                <div class="image">
                <img src="img/<?php echo $val['item_img'] ?>" alt="" class="card-img-top">
                </div>

                    <div class="content">
                        <h3><?php echo $val['item_name'] ?></h3>
                        <h4><?php echo $val['item_desc'] ?></h4>
                        <div class="price"><p> Php <?php echo number_format($val['item_price'],2)  ?></p>
                        </div>
                        
                        <?php
                        if(isset($status_logged_in)){
                          switch($status_logged_in['usertype']){
                              case 'Customer':
                          ?>
                            <form action="includes/processorder.php" method= "GET">
                            <input hidden type="text" name="item_id"  value = "<?php echo $val['item_id']; ?>">
                            <label for="Quantity">Quantity</label>
                            <input  type="number" value = "1" min="1" name="item_qty">
                            <button type="submit" class = "btn-addcart">
                            <i class="fas fa-cart-arrow-down"></i>
                            </button>
                            </form>
                           
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
                    <h3>Sign In to Add Item to Cart</h3>
                <?php }
                ?>
                   
                    </div>
            </div>
        </div>

                    <?php
                        }
                        ?>
    </div>
</section>

    

    <section id="home-two">
       
       <div class="slide">
           <div class="row">
               <div class="col-2">
                   <div class="content text-center text-md-left pl-md-3 ml-md-3">
                   <img class="img" src="img/cf4.png" alt="">
                   </div>
               </div>
               <div class="col-2">
               <h1>The best grain, the finest roast, the most powerful flavor.</h1>
               <a href="product.php"><button class="bttn">Shop Now</button></a>

               </div>
           </div>
       </div>
   
      
   </section>

  
   <div class="caption">
        <h2>Our Customer Review</h2>
        
    </div>

   <section id="about">
    <div class="about-container">
        <div class="about-slider">
            <div class="about-card item">
            <div class="image">
                <img src="img/gelai.jpg"  class="card-img-top">
                </div>
                    <div class="content">
                    <h2>Kim Jennie</h2>
                    <h4><p><i class="fas fa-quote-left"></i>Its convinient and easy to use.<i class="fas fa-quote-right"></i></p></h4>
            
                    </div>
                    
                    </div>
            </div>
        </div>  
        <div class="about-slider">
            <div class="about-card item">
            <div class="image">
                <img src="img/nat.jpg"  class="card-img-top">
                </div>
                    <div class="content">
                        <h2>Kim Jisoo</h2>
                        <br>
                        <h4><p><i class="fas fa-quote-left"></i>I have been buying things from agricomercio 
                    for a couple of weeks What I like about them is that you can really save money 
                    especially during special days <i class="fas fa-quote-right"></i></p></h4>
                        
                        
                    </div>
            </div>
        </div> 
        <div class="about-slider">
            <div class="about-card item">
            <div class="image">
                <img src="img/tin.jpg"  class="card-img-top">
                </div>
                    <div class="content">
                            <h2>Lalisa</h2>
                            <br> 
                           <h4>  <p><i class="fas fa-quote-left"></i>The products are fresh and organic<i class="fas fa-quote-right"></i></p></h4>
                    </div>
                    </div>
            </div>
        </div>
        
                
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
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

    

</body>
</html>
