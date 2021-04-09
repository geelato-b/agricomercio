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
                    <span class="details">Email</span>
                    <input type="text"  name ="email" placeholder="Enter Your Email" required>
                </div>
                <div class="input-box">
                    <span class="details">Contact Number</span>
                    <input type="text" placeholder="Enter Your Number" required>
                </div>

                <div class="input-box">
                <span class="details">Password</span>
                    <input type="password" id="psword" name ="psword" placeholder="Enter Your password" required>
                </div>
               
            
            </div>
            <div class="gender-details">
                <span class="gender-title">Gender</span>
                <div class="category">
                <label for="gender">Gender:</label>
                    <select class="form-select" id="age" name="gender">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="L">LGBTQ+</option>
                    <option value="X">Rather Not Say</option>
                    </select>
                </div>
            </div>

            <div class="usertype">
                <span class="usertype-details">User Type</span>
                <div class="category_two">
                <label for="usertype">usertype:</label>
                <select id="age" name="usertype"  class="form-select">
                <option value="Customer">Customer</option>
                <option value="Seller">Seller</option>
                </select>
                </div>
            </div>
            <div class="button">
                <input type="submit" name="" value="Register" name= "submit_reg">

            </div>

            <div class="sign_in">
                <a  href="sign_in.php">Already have an account</a>
            </div>

            
        </form>
    </div>


    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.js"></script> 
    <script src="js/main.js"></script>
    
</body>
</html>