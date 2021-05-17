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

  <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
  <a href="user.php"><i class="fas fa-users"></i> User Management</a>
  <a href="../logout.php"><i class="fas fa-angle-left"></i> logout</a>

  
</div>

<main>
    <div class="row" id=cards>
      <div class="column">
        <div class="card1">
          <a href="user.php">Users</a>
        </div>
      </div>
      <div class="column">
        <div class="card2">
        <a href="seller.php">Seller</a>
        </div>
      </div>
      <div class="column">
        <div class="card3">
        <a href="customer.php">Customer</a>
        </div>
      </div>


      <div class="row" id="cards">
       <div class="box_cards">
         <h2>Generated Report</h2>
          
            <div class="card5">
            <a href="generated_report.php">Income</a>
            </div>
        
       </div>
</div>
      
     
</main>





<script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.js"></script> 
    <script src="js/main.js"></script>
    
</body>
</html>

