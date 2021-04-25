<!DOCTYPE html>
<html background="#8ce6ca">
<head>
   <title>Seller</title>
   <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="userprofile.html">Profile <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="products.html">Products</a>
      </li>
            <li class="nav-item active">
        <a class="nav-link" href="orders.html">Orders</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="about.html">About</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="logout.html">Log Out</a>
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
<!-- <form>
                        <table class="table table-striped table-hover">
                          <thead>
                            <br>
                           <h1>Profile</h1>
                          <br>
                          <div class="profile">
                              <img width="150px" src="img/profile.png" class="rounded-circle" alt="img">
                              <br><br>
                              <span class="badge rounded-pill bg-success" style="font-size: 15px;"><font color="white">Status : </font></span>
                              <input type="text" id="status">
                          </div>
                             <br>
                             <br/>
                          </thead>
                          <tbody>
                          <tr>
                            <td>
                               <span class="">User Name : </span>
                               <input type="text" id="user_name" placeholder="User Name">
                            </td>
                            <td>
                              <input type="text" id="user_id" placeholder="User ID">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <input type="text" id="user_fullname" placeholder="Full Name">
                            </td>
                            <td>
                               <input type="text" id="status" placeholder="Status">
                            </td>  
                          </tr>
                          <tr>
                            <td>
                               <input type="text" id="house_no_street_brgy" placeholder="Address">
                            </td> 
                            <td>
                               <input type="text" id="postal_code" placeholder="Postal Code">
                            </td>   
                          </tr>
                          <tr>
                            <td>
                              <input type="text" id="city" placeholder="City" >
                            </td>
                            <td>
                              <input type="text" id="province" placeholder="Province">
                            </td>
                          </tr>
                          <tr>
                            <td>
                               <input type="text" id="contact_details" placeholder="Contact">
                            </td> 
                          </tr>
                          </tbody>
                        </table>
                        <br>
                        <button type="button" class="btn btn-success">Update</button>
   </form>                  -->  
  <div>
    <br>
    <h1>Profile</h1>
    <br>
    <img width="150px" src="img/profile.png" class="rounded-circle" alt="img">        
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
  <div class="col-12">
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
  <div class="col-12">
    <button type="submit" class="btn btn-success">Update</button>
  </div><br><br>
</form>

<form class="row g-3">
  <div class="col-md-10">
    <h2>My Products</h2>

   
  </div>
  <div class="col-md-2">
     <button type="submit" class="btn btn-success">Add Product</button>
  </div>
  <div class="col-md-12">
    
  
  <table class="table table-bordered border-primary">
    <thead>
      <td>
        Image
      </td>
      <td>
        Item Name
      </td>
      <td>
        Item Description
      </td>
      <td>
        Item Price
      </td>
      <td>
        Item Status
      </td>
    </thead>
    <tbody>
      <tr>
        <td>
          <input type="text" class="form-control" id="item_img">
        </td>
        <td>
          <input type="text" class="form-control" id="item_name">
        </td>
        <td>
          <input type="text" class="form-control" id="item_desc">
        </td>
        <td>
          <input type="text" class="form-control" id="item_price">
        </td>
        <td>
          <input type="text" class="form-control" id="item_status">
        </td>
      </tr>
    </tbody>
  </table>
</div>
  <br><br><br><br>
</form>

</div>
</div>





<script src="jquery.js"></script>
<script src="popper.js"></script>
<script src="bootstrap.js"></script>


</body>
</html>