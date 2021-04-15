<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/function.inc.php";


    
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>AgriComercio</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
<header id="header">

<div class="right">
    
<img clas ="logo" src="../img/logo1.png" alt="" width="70px" height="70px">   
</div>
        <div class="nav-bar">
            <ul>
            <li><a href="product.php">Product</a></li>
            <li><a href="order.php">Orders' Approval</a></li>
            <li><a href="order.php">Sales Report</a></li>
            </ul>
        </div>

<div class="left">

<div class="dropdown"> 
  <a href="seller_page.php"><div class="fas fa-user"></div></a>
  
</div>
   

</div>

</header> 


<main>


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
           ?>

       
    
    <?php }
}
else{
    header("location: index.php");
    
}

?>

<div class="main__container">

    <form id = "addItem" action="product.php" method="post">
            Item name :  <input type="text" name="item_name" required>
            <br>
            Item Desc :  <input type="text" name="item_desc" required>
            <br>
            Item Status :  <input type="text" name="item_status" >
            <br>
            Item Price :  <input type="text" name="item_price" required>
            <br>
            <button type="submit" name="Add" value="add" class="add_btn">Add Item</button>
    </form>
        
          <div class="container_fluid">
          <div class="row" id="contentPanel">
            <div class="col-10">
<?php
        $sql="SELECT i.item_id
        , i.item_name
        , c.cat_desc
        , i.item_price
     FROM `items` i
     JOIN `category` c
       ON i.item_id = c.item_id;";

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
      //echo "<th> Item Status </th>";
      echo "<th> Price </th>";
      echo "<th> Actions </th>";
      echo "</thead>";
      foreach($arr as $key => $val){
      echo "<tr>";
          echo "<td>" . $val['item_name'] . "</td>";
          echo "<td>" . $val['cat_desc']       . "</td>";
          //echo "<td>" . $val['item_status']        . "</td>";
          echo "<td> Php ". number_format($val['item_price'],2) . "</td>";
          echo "<td> <a href='orderform.php?itemid=".$val['item_id']."' class='btn btn-primary'>Delete</a> </td>";
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

</div>
                  </div>
          </div>
</main>




   

  

        
            <script src="../js/bootstrap.bundle.js"></script>
            <script src="../js/jquery.js"></script> 
            <script src="../js/main.js"></script>
</body>
</html>