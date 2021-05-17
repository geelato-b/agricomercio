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
  }
$searchkey="";
if(isset($_GET['searchkey'])){
  $searchkey = htmlentities($_GET['searchkey']);

}

?>


<!DOCTYPE html>
<html>
<head>
   <title>Seller</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link rel="stylesheet" href="../css/bootstrap.css"> 
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

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

      <li class="nav-item active">
        <a class="nav-link active" href="userprofile.php">Profile</a>
      </li>
       <li class="nav-item active">
        <a class="nav-link active" href="receiveorder.php">Orders</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link active" href="about.php">About</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link active" href="product.php">Items</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link active" href="../logout.php">Log Out</a>
      </li>
    </ul>
    <form action="product.php" method="GET">
        <div class="input-group">
            <input id="searhbar" name="searchkey" class="form-control" type="text" placeholder="Search">
            <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
            </div>
    </form>
  </div>
</nav>

<!-- end of navbar -->

<main>          
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
                               echo "<p class='alert-alert-danger'>".$_GET['itemname']." Exists.</p>";
                            }
                                break;
                        case 2: echo "<p class='alert-alert-danger'>Adding Record Failed.</p>";
                                break;
                        case 3: echo "<p class='alert-alert-danger'>Checking Item Failed.</p>";
                                break;
                        case 0:
                            if(isset($_GET['itemname'])){
                               echo "<p class='alert-alert-success'>".$_GET['itemname']." has been added.</p>";
                            }
                                break;
                        default: echo "";
                    }
                  } ?>
           
            <div id="addItemForm" class="card collapse mt-3 shadow">
               <div class="card-header">
                   <h3 class="display-6">Add New Item</h3>
               </div>
             <form action="../includes/AddItem.php" method="POST" enctype="multipart/form-data">
               <div class="card-body">
                  <div class="mb-1">
                      <label for="i_ItemName" class="form-label">Item Name</label>
                      <input name="itemname" id="i_ItemName" type="text" class="form-control">
                  </div>
                  <div class="mb-1">
                      <label for="" class="form-label">Image</label>
                      <input name="itemimagefile" type="file" class="form-control">
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
                   <button class="btn btn-outline-primary" name="AddItem" type="submit"> <i class="bi bi-save"></i> Save </button>
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
  if ($searchkey == "") {
    $sql = "SELECT i.item_id
            , i.item_name
            ,i.item_img
            ,i.item_desc
            , c.cat_desc
            , i.item_price
            ,i.item_status
         FROM `items` i
         JOIN `category` c
           ON i.cat_id = c.cat_id
           WHERE i.user_id = ? ;";
  //initialize MYSQL statement connection to the database.
  //$conn is a variable declared inside db_conn.
  $stmt=mysqli_stmt_init($conn);
  //prepare the statement
  if (!mysqli_stmt_prepare($stmt, $sql)){
     echo "Statement Failed.";
     exit();
  }
  mysqli_stmt_bind_param($stmt, "s" ,$_SESSION['userid']);
  }
  else{
        $sql = "SELECT i.item_id
            , i.item_name
            ,i.item_img
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
    <div class="container-fluid">
      <div class="row px-3">
        
          <?php
        foreach($arr as $key => $val){ ?>
        <div class="col-3">
          <br>
            <div class="card">
                <img src="../img/<?php echo $val['item_img']; ?>" alt="1 x 1" width="100px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $val['item_name']?></h5>
                    <em class="card-text" > Php <?php echo number_format($val['item_price'],2); ?> </em>
                </div>
                <div class="card-footer">
                    <form action="../includes/DeleteSellerItem.php" method="get">
                        <input hidden type="text" name="item_id" value="<?php echo $val['item_id']; ?>" >
                        <div class="input-group">  
                            <button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"></i></i> </button>
                        </div>
                    </form>
              </div>
        </div>
   </div>
      <?php 

        echo "</tr>";
      }
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




</div>
</div>


<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>


</body>
</html>
