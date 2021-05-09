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
        <?php
          if(isset($status_logged_in)){ ?>
              <h3 class="display-5">Welcome User!</h3>
          <?php }
            ?>
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

