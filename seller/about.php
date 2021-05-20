<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/function.inc.php";   
$status_logged_in = null;
if(isset($_SESSION['usertype']) && isset($_SESSION['userid']) ){
    $status_logged_in = array('status' => true, 'usertype' => $_SESSION['usertype'] );
    
    $USER_ID = $_SESSION['userid'];
    $user_info = GetUserDetails($conn, $USER_ID );
    $user = GetUserName($conn, $USER_ID );
 ?>
<!DOCTYPE html>
<html>
<head>
   <title>Seller</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link rel="stylesheet" href="bootstrap.css"> 
   <link rel="stylesheet" href="style.css"> 
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

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02" >
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
   
      <li class="nav-item active">
        <a class="nav-link" href="userprofile.php">Profile <span class="sr-only">(current)</span></a>
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

<section id="home">
     
  <div class="slide">
              <div class="row">
                  <div class="col">
                  
                      <div class="content-home ">
                          <h1>AgriComercio - Change The Way You Trade</h1>
                          <h2>Right out of the Farm!</h2>
                          <h2>Reap Fresh, Eat Fresh</h2>
                      </div>
                  </div>
                  <div class="col">
                      <img class="img_home" src="../img/Ag1.png" alt="">
                  </div>
              </div>
          </div>

</section>

<section id="about">
    <div class="about-container">
        <div class="about-slider">
            <div class="about-card item">
                    <div class="content">
                    <h1>Objective:</h1>
                    <h2>AgriComercio helps the customers and retailer in buying products from larger numbr of farmers</h2>
                    </div>
                    
                    </div>
            </div>
        </div>  
        <div class="about-slider">
            <div class="about-card item">
                    <div class="content">
                        <h1>Vision:</h1>
                        <h2>To provide a helping hand to the farmers and farm labourers in their lives 
                        through the meduim of technology, thereby, improving the their agricultural market</h2>
                    </div>
            </div>
        </div> 
        <div class="about-slider">
            <div class="about-card item">
                    <div class="content">
                    <h1>Mission:</h1>
                            <h2>To provide technical services to 
                            farmers,merchants, and farm labourers to help them expand their 
                            business and provide them a wider market.</h2> 
                    </div>
                    </div>
            </div>
        </div>
        
                
    </div>


</section>

<div class="caption">
        <h2>Our Team</h2>
    </div> 


<section id="about">
    <div class="about-container">
        <div class="about-slider">
            <div class="about-card item">
            <div class="image">
                <img src="../img/gelai.jpg"  class="card-img-top">
                </div>
                    <div class="content">
                    <h2>Angelica Mae Bonganay</h2>
                    <br>
                    <h5>Developer</h5>
                    <h5>Error Handler</h5>
                    <div>
                            <ul class="social">
                            <li><a href=""><i class="fab fa-facebook-square"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter-square"></i></a></li>
                            <li><a href=""><i class="fab fa-instagram-square"></i></a></li>
                            <li><a href=""><i class="fab fa-google-plus-square"></i></a></li>
                            </ul>
                            </div>
                    </div>
                    
                    </div>
            </div>
        </div>  
        <div class="about-slider">
            <div class="about-card item">
            <div class="image">
                <img src="../img/nat.jpg"  class="card-img-top">
                </div>
                    <div class="content">
                        <h2>Natalie Buenconsejo</h2>
                        <br>
                        <h5>Developer</h5>
                        <h5>Error Handler</h5>
                        <div>
                            <ul class="social">
                            <li><a href=""><i class="fab fa-facebook-square"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter-square"></i></a></li>
                            <li><a href=""><i class="fab fa-instagram-square"></i></a></li>
                            <li><a href=""><i class="fab fa-google-plus-square"></i></a></li>
                            </ul>
                            </div>
                    </div>
            </div>
        </div> 
        <div class="about-slider">
            <div class="about-card item">
            <div class="image">
                <img src="../img/tin.jpg"  class="card-img-top">
                </div>
                    <div class="content">
                            <h2>Christine Joyce Precones</h2>
                            <br> 
                            <h5>Data Handler</h5>
                            <h5>Documentator</h5>
                            
                            <div>
                            <ul class="social">
                            <li><a href=""><i class="fab fa-facebook-square"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter-square"></i></a></li>
                            <li><a href=""><i class="fab fa-instagram-square"></i></a></li>
                            <li><a href=""><i class="fab fa-google-plus-square"></i></a></li>
                            </ul>
                            </div>
                    </div>
                    </div>
            </div>
        </div>
        
                
    </div>


</section>


   <section id="footer">
   <div class="footer-content">
   <img clas ="logo" src="../img/logo1.png" alt="" width="70px" height="70px">
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

<?php    

    }

else{
    header("location: sign_in.php");
    
}

?>

<script src="../js/bootstrap.min.js"></script>
<script src="jquery.js"></script>
<script src="popper.js"></script>
<script src="bootstrap.js"></script>


</body>
</html>

