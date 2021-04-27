<!DOCTYPE html>
<?php 
session_start();
include_once ('../includes/db_conn.php');
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
        <div class="search-container">
            <input type="search" placeholder="" id="search">
              <label for="search" class="fas fa-search"></label>
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

  <a href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
  <a href="user.php"><i class="fas fa-users"></i> User Management</a> 
</div>


<main>
        <div class="main__container">
          <div class="container_fluid">
          <div class="row" id="contentPanel">
                  <div class="col-12">
                  <?php
                  //declare the SQL
                  //Scenario: I wanted to show item_id, item_name,
                  //item_short_code
                  // category description, price
                  $sql = " SELECT `user_id`, 
                  `user_type`, 
                  `user_name`, 
                  `password`, 
                  `status` 
                  FROM `users`
                  WHERE 1;";
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
                    echo "<th>". "User Id" . "</th>";
                    echo "<th> username</th>";
                    echo "<th> password </th>";
                    
                    echo "</thead>";
                     
                      foreach($arr as $key => $val){
                      echo "<tr>";
                      
                      echo "<td>" . $val ['user_id']         . "</td>";
                      echo "<td>" . $val ['user_name']   . "</td>";
                      echo "<td>" . $val ['password']          .  " </td> ";
                      echo "<td>
                    
                      <a href='orderform.php?itemid=".$val['user_id']."'
                      class='btn btn-primary'>blocked</a> </td>";
                      echo "</tr>";
                      }
                      echo "<tr >";

                    ?>
                      <?php
                      echo "</tr>";
                      echo "</table>";
                      }
                      else{
                      echo "<h4> No Records Found.</h4>";
                      }
                  ?>

                      <div
                      class='text-center'><em>End of result</em>
                      </div>


                  
                                          
                  
                    
                  </div>
                  </div>
          </div>

          
      </main>





    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.js"></script> 
    <script src="js/main.js"></script>
    
</body>
</html>

