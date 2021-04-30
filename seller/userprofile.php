<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/function.inc.php";
if(isset($_SESSION['usertype'])){
    if($_SESSION['usertype'] == 'Seller'){

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="userprofile.php">Profile <span class="sr-only">(current)</span></a>
      </li>
      </li>
            <li class="nav-item active">
        <a class="nav-link" href="orders.php">Orders</a>
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
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<!-- end of navbar -->

<div class="container">
<div class="card-body">
  <div>
    <br>
    <h1>Profile</h1>
    <br>
    <img width="150px" src="../img/user.png" class="rounded-circle" alt="img">        
    <br>
    <br/>
  </div>
  <form action="includes/updateprofile.php"  method  = "post" class="row g-3">
  <div class="col-md-6">
    <label for="user_name" class="form-label">User Name</label>
    <input type="text" class="form-control" id="user_name" value = "<?php echo $user['user_name']; ?>" >
  </div>
  <div class="col-md-2">
    <label for="user_id" class="form-label">User ID</label>
    <input type="text" class="form-control" id="user_id" value = "<?php echo $user['user_id']; ?>">
  </div>
  <div class="col-md-6">
    <label for="user_fullname" class="form-label">Full Name</label>
    <input type="text" class="form-control" id="user_fullname" value = "<?php echo $user_info['user_fullname']; ?>">
  </div>
  <div class="col-md-2">
    <label for="status" class="form-label">Status</label>
    <input type="text" class="form-control" id="status" value = "<?php echo $user['status']; ?>">
  </div>
  <label for="house_no_street_brgy" class="form-label">Address</label>
  <div class="col-8">
  <label for="house_no_street_brgy" class="form-label">House Number, Street, Barangay</label>
    <input type="text" class="form-control" id="house_no_street_brgy" placeholder="House No. Street Barangay." value = "<?php  echo $user_info['house_no_street_brgy']; ?>">
  </div>
  <div class="col-6">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city" placeholder="City" value = "<?php echo $user_info['city']; ?>">
  </div>
  <div class="col-md-4">
    <label for="province" class="form-label">Province</label>
    <input type="text" class="form-control" id="province" placeholder="Province"  value = "<?php echo $user_info['province']; ?>">
  </div>
  <div class="col-md-2">
    <label for="postal_code" class="form-label">Postal Code</label>
    <input type="text" class="form-control" id="postal_code" value = "<?php echo $user_info['postal_code']; ?>">
  </div>
  </div>
  <div class="col-md-10">
    <button type="submit" class="btn btn-success">Update</button>
  </div><br><br>
</form>

</div>
</div>

<?php    

    }
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

