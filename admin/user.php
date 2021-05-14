<!DOCTYPE html>
<?php 
session_start();
include_once ('../includes/db_conn.php');
$searchkey="";
if(isset($_GET['searchkey'])){
  $searchkey = htmlentities($_GET['searchkey']);

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

<section id= "search">
        <div class = "container-fluid">
            <form action="user.php" method="GET" class="d-flex">
                <input id="searchbar" name="searchkey" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
            </form>

        </div>
    </section>

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
</div>


<main>
        <div class="main__container">
          <div class="container_fluid">
          <div class="row" id="contentPanel">
                  <div class="col-12">
                  <?php

                  if(isset($_GET['block_user'])){
                    $sql_upd = "UPDATE `users`
                                    SET status = 'Blocked'
                                    WHERE status <> 'Blocked'
                                 AND user_id = ? ;";
                    $stmt_upd = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
                    header("location: ?error=8"); //update failed
                    exit();
                    }
                    mysqli_stmt_bind_param($stmt_upd,"s",$userid);
                    mysqli_stmt_execute($stmt_upd);
                    header("location: ?user.php successfullyblocked");
                }
                else{ 

                  if($searchkey == ""){
                  $sql = " SELECT `user_id`,
                   `user_ref_num`, 
                  `user_type`, 
                  `user_name`, 
                  `password`, 
                  `status` 
                  FROM `users`
                  WHERE status = 'Active';";
                  $stmt=mysqli_stmt_init($conn);
                  if (!mysqli_stmt_prepare($stmt, $sql)){
                  echo "Statement Failed.";
                  exit();
                    }
                  }
                  else{
                    $sql = "SELECT
                                  `user_id`, 
                                  `user_ref_num`,
                                  `user_type`, 
                                  `user_name`, 
                                  `password`, 
                                  `status` 
                                  FROM `users`
                                  WHERE status = 'Active'
                                  AND user_name = ?
                                  OR user_id = ?
                                  ;";

                             $stmt=mysqli_stmt_init($conn);
                             if (!mysqli_stmt_prepare($stmt, $sql)) {
                               echo "Statement Failed. Record Not Found.";
                               exit();
                             }

                  mysqli_stmt_bind_param($stmt, "ss" , $searchkey , $searchkey);
                  }
                 
                  mysqli_stmt_execute($stmt);
                  $resultData = mysqli_stmt_get_result($stmt);
                  $arr=array();
                  while($row = mysqli_fetch_assoc($resultData)){
                  array_push($arr,$row);
                  }
                  if(!empty($arr)){
                    echo "<table class='table'>";
                    echo "<thead>";
                    echo "<th>". "User Id" . "</th>";
                    echo "<th>". "User Reference Number" . "</th>";
                    echo "<th> username</th>";
                    echo "<th> password </th>";
                    echo "<th> status </th>";
                    
                    echo "</thead>";
                     
                      foreach($arr as $key => $row){
                      echo "<tr>";
                      
                      echo "<td>" . $row ['user_id']         . "</td>";
                      echo "<td>" . $row ['user_ref_num']         . "</td>";
                      echo "<td>" . $row ['user_name']   . "</td>";
                      echo "<td>" . $row ['password']          .  " </td> ";
                      echo "<td>"
                      ?>
                      <a href ="?block_user" class="btn btn-lg btn-success">block</a>
                    <?php
                      echo "</td>" ;

                      echo "</tr>";
                      }
                      echo "<tr >";
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
    
</body>
</html>

<?php
                }
                ?>