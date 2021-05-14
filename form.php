<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriComercio</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
   
    <div class="container">

        <div class="title">Registration</div>
        <div class="registration"></div>
        <form action="includes/registration.php" method="POST">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Full Name</span>
                    <input type="text" id="fname" name ="fname" placeholder="Enter Your Name" required>
                </div>
                <div class="input-box">
                    <span class="details">Username</span>
                    <input type="text"  name ="usrname" placeholder="Enter Your Username" required>
                </div>
                <div class="input-box">
                    <span class="details">Contact Number</span>
                    <input type="text" name="contact_no" placeholder="Enter Your Number" maxlength="11" required >
                </div>

                <div class="input-box">
                <span class="details">Password</span>
                    <input type="password" id="psword" name ="psword" placeholder="Enter Your password" required>
                </div>
                <div class="input-box">
                
                </div>
                <div class="input-box">
                <span class="details">Confirm Password</span>
                    <input type="password" id="cpsword" name ="cpsword" placeholder="Confirm Your password" required>
                </div>
                <div class="input-box">
                <span class="details">Address</span>
                      <input type="text" class="form-control" name ="hnsb" placeholder = "House Number, Street, Barangay" value = "" >
                       
                        <input type="text" class="form-control" name="city" placeholder = "City" value = "" >
                        
                        <input type="text" class="form-control" name = "prv" placeholder = "Province" value = "">
                        
                        <input type="text" class="form-control" name ="pc" placeholder = "Postal Code" value = "" >                     
                </div> 
                <?php
                    if (isset($_SESSION['status'])) {
                    ?>
                    <div class="input-box">
                    <div class="alert alert-warning" role="alert">
                    <?php echo $_SESSION['status']; ?>
                    </div>
                    </div>
                    <?php
                        
                        unset($_SESSION['status']);
                    }
                ?>

            </div>
            
            <div class="gender-deatils">
                <div class="category">
                <label for="gender">Gender:</label>
                    <select id="age" name="gender">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="L">LGBTQ+</option>
                    <option value="X">Rather Not Say</option>
                    </select>
                </div>
            </div>

            <div class="usertype">
                <div class="category_two">
                <label for="usertype">Do you want to sell?</label>
                <select id="age" name="usertype">
                <option value="Customer">No</option>
                <option value="Seller">Yes</option>
                </select>
                </div>
            </div>

            
            <div class="button">
                <input type="submit" name="" value="Register" name= "submit_reg">

            </div>

            <div class="sign_in">
                <center>
                <a  href="sign_in.php" >Already have an account</a>
                </center>
            </div>

            
        </form>
    </div>


    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.js"></script> 
    <script src="js/main.js"></script>
    
</body>
</html>