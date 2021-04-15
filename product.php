
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>AgriComercio</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
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
    <a href="seller_page.php"><li><button class="dropdown-item" type="button">Profile</button></li></a>
    <a href="../form.php"><li><button class="dropdown-item" type="button">Sign Up</button></li></a>
    <a href="../sign_in.php"><li><button class="dropdown-item" type="button">Sign In</button></li></a>
    <a href="../logout.php"><li><button class="dropdown-item" type="button">Log Out</button></li></a>
  </ul>
</div>
   

</div>

<nav class="navbar">
<ul>
<img clas ="logo" src="../img/logo1.png" alt="" width="70px" height="70px">
<h1>AgriComercio</h1>
<br>
<br>

<li><a href="product.php">Product</a></li>
<li><a href="order.php">Orders' Approval</a></li>
<li><a href="order.php">Sales Report</a></li>

</ul>
</nav>

</header>
   
<section id="review">
  
<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/function.inc.php";

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
           ?>
        <form action="seller_page.php" method="post">
            Item name :  <input type="text" name="item_name">
            <br>
            Item Desc :  <input type="text" name="item_desc">
            <br>
            Item Status :  <input type="text" name="item_status">
            <br>
            Item Price :  <input type="text" name="item_price">
            <br>
            <input type="submit">
        </form>
        
    
    <?php }
}
else{
    header("location: index.php");
    
}
    
?>

<?php
        $sql = "SELECT i.item_id
        , i.item_name
        , c.cat_desc
        , i.item_status
        , i.item_price
        FROM `items` i
        JOIN `category` c
        ON i.item_id = c.item_id ;";
  
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
 
   if(!empty($arr))
   {
      echo "<table class='table'>";
      echo "<thead>";
      echo "<th> Item Name </th>";
      echo "<th> Item Description </th>";
      echo "<th> Item Status </th>";
      echo "<th> Price </th>";
      echo "<th> Actions </th>";
      echo "</thead>";
      foreach($arr as $key => $val){
      echo "<tr>";
          echo "<td>" . $val['item_name'] . "</td>";
          echo "<td>" . $val['cat_desc']       . "</td>";
          echo "<td>" . $val['item_status']        . "</td>";
          echo "<td> Php ". number_format($val['item_price'],2) . "</td>";
          echo "<td> <a href='orderform.php?itemid=".$val['item_id']."' class='btn btn-primary'>order this item</a> </td>";
      echo "</tr>";
      }
      echo "<tr >";
          echo "<td colspan=4 class='text-center'><em>End of result</em></td>";
      echo "</tr>";
  echo "</table>";
   }
   else{
       echo "<h4> No Records Found.</h4>";
   }
  ?>


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

        
        
            <script src="../js/bootstrap.bundle.js"></script>
            <script src="../js/jquery.js"></script> 
            <script src="../js/main.js"></script>
</body>
</html>