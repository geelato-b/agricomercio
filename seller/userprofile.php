<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/function.inc.php";   

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
        <a class="nav-link" href="../index.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="userprofile.php">Profile <span class="sr-only">(current)</span></a>
      </li>
      </li>
            <li class="nav-item active">
        <a class="nav-link" href="orders.php">Orders</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../product.php">Products</a>
      
      <li class="nav-item active">
        <a class="nav-link" href="../about.php">About</a>
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
    <img width="150px" src="../img/profile.png" class="rounded-circle" alt="img">        
    <br>
    <br/>
  </div>
  <form class="row g-3">
  <div class="col-md-6">
    <label for="user_name" class="form-label">User Name</label>
    <input type="text" class="form-control" id="user_name">
  </div>
  <div class="col-md-2">
    <label for="user_id" class="form-label">User ID</label>
    <input type="text" class="form-control" id="user_id">
  </div>
  <div class="col-md-6">
    <label for="user_fullname" class="form-label">Full Name</label>
    <input type="text" class="form-control" id="user_fullname">
  </div>
  <div class="col-md-2">
    <label for="status" class="form-label">Status</label>
    <input type="text" class="form-control" id="status">
  </div>
  <div class="col-8">
    <label for="house_no_street_brgy" class="form-label">Address</label>
    <input type="text" class="form-control" id="house_no_street_brgy" placeholder="House No. Street Barangay.">
  </div>
  <div class="col-6">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city" placeholder="City">
  </div>
  <div class="col-md-4">
    <label for="province" class="form-label">Province</label>
    <input type="text" class="form-control" id="province" placeholder="Province">
  </div>
  <div class="col-md-2">
    <label for="postal_code" class="form-label">Postal Code</label>
    <input type="text" class="form-control" id="postal_code">
  </div>
  </div>
  <div class="col-md-10">
    <button type="submit" class="btn btn-success">Update</button>
  </div><br><br>
</form>

  <div class="col-md-10">
    <h2>My Products</h2>

<!------------------------------->


<div class="container-fluid">
    <div class="row" id="NavigationPanel">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg bg-light text-white shadow-sm">
            <div class="container-fluid">
             <a href="index.php" class="navbar-brand btn btn-no-border-orange pb-3"> 
                <i class="bi bi-house"></i> 
                </a>
            <button class="navbar-toggler btn btn-outline-orange" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="bi bi-list"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                 <li class="nav-item"> 
                    <!--Navigation button to show the form to add item button-->
                    <a class="nav-link btn btn-no-border-orange"  data-bs-toggle="collapse"  
                         href="#addItemForm"  role="button"  aria-expanded="false" aria-controls="addItemForm"><i class="fas fa-plus-circle"> Add Item </i>
                    </a> 
                    <!--Navigation button to show the form to add item button--->
                 </li>
                </ul>
            </div>
             </div>
         </nav>
         <!--end Navigation Bar -->
    </div>
    <div class="row" id="NotificationPanel">
        <div class="col-3"></div>
        <div class="col-6">
            <?php if(isset($_GET['error'])){
                    
                    switch($_GET['error']){
                        case 1: 
                            if(isset($_GET['itemname'])){
                               echo "<p class='text-danger'>".$_GET['itemname']." Exists.</p>";
                            }
                                break;
                        case 2: echo "<p class='text-danger'>Adding Record Failed.</p>";
                                break;
                        case 3: echo "<p class='text-danger'>Checking Item Failed.</p>";
                                break;
                        case 0:
                            if(isset($_GET['itemname'])){
                               echo "<p class='text-success'>".$_GET['itemname']." has been added.</p>";
                            }
                                break;
                        default: echo "";
                    }
                  } ?>
           
            <div id="addItemForm" class="card collapse mt-3 shadow">
               <div class="card-header">
                   <h3 class="display-6">Add New Item</h3>
               </div>
             <form action="../includes/additem.php" method="POST">
               <div class="card-body">
                  <div class="mb-1">
                      <label for="i_ItemName" class="form-label">Item Name</label>
                      <input name="itemname" id="i_ItemName" type="text" class="form-control">
                  </div>
                  
                  <div class="mb-1">
                      <label for="" class="form-label">Item Price</label>
                      <input name="itemprice" type="Number" class="form-control">
                  </div>
                  <div class="mb-1">
                      <label for="" class="form-label">Item Description</label>
                      <input name="itemdesc" type="text" class="form-control">
                  </div>
                  <div class="mb-1">
                   <label for="SelectCategory" class="form-label">Category</label>
                   <select name="itemcategory" id="" class="form-select">
                    <?php
                      $sql_cat = "SELECT cat_id, cat_desc FROM category WHERE cat_status = 'A';";
                      $result = mysqli_query($conn, $sql_cat);
                      if(mysqli_num_rows($result) > 0){
                          while($row = mysqli_fetch_assoc($result)){
                              echo "<option value='".$row['cat_id']."'>".$row['cat_desc']."</option>";
                          }
                      }
                    ?>
                   </select>                   
                  </div>
                  <div class="mb-1">
                     <label for="" class="form-label">Status</label>
                      <select name="itemstatus" id="" class="form-select">
                          <option value="A">Active</option>
                          <option value="D">Discontinued</option>
                      </select>
                  </div>
               </div>
               <div class="card-footer">
                   <button class="btn btn-outline-primary"> <i class="bi bi-save"></i> Save </button>
               </div>
             </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
    <br><br>
<div class="row" id="contentPanel">
  <div class="col-12">
  <?php
  //declare the SQL
  //Scenario: I wanted to show item_id, item_name, item_short_code
  //          category description, price
  $sql = "SELECT i.item_id
            , i.item_name
            ,i.item_desc
            , c.cat_desc
            , i.item_price
            ,i.item_status
         FROM `items` i
         JOIN `category` c
           ON i.cat_id = c.cat_id;";
  //initialize MYSQL statement connection to the database.
  //$conn is a variable declared inside db_conn.
  $stmt=mysqli_stmt_init($conn);
  //prepare the statement
  if (!mysqli_stmt_prepare($stmt, $sql)){
     echo "Statement Failed.";
     exit();
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
   // if the new array is not empty, display the tabular representation
   // as HTML
   if(!empty($arr)){
      echo "<table class='table'>";
      echo "<thead>";
      echo "<th> Item Name </th>";
      echo "<th> Item Description </th>";
      echo "<th> Category </th>";
      echo "<th> Price </th>";
      echo "<th> Item Status </th>";
      echo "<th> Actions </th>";
      echo "</thead>";
      foreach($arr as $key => $val){
      echo "<tr>";
          echo "<td>" . $val['item_name']       . "</td>";
          echo "<td>" . $val['item_desc']        . "</td>";
          echo "<td>" . $val['cat_desc']        . "</td>";
          echo "<td> Php ". number_format($val['item_price'],2) . "</td>";
          echo "<td>" . $val['item_status'] . "</td>";
          ?>
          <td><a href="includes/deletecartitem.php?cartid=<?php echo $row['cart_id']; ?>" class="btn-cart">
                            <i class="fas fa-trash-alt"></i></i></td>
      <?php 

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

</div>
</div>


<script src="../js/bootstrap.min.js"></script>
<script src="jquery.js"></script>
<script src="popper.js"></script>
<script src="bootstrap.js"></script>


</body>
</html>