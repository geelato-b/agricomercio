<?php //open a php tag
//let’s put security aside first just to shorten the explanation.
//declare a new variable where we will store the POST variable values.
session_start();
include_once "function.inc.php";
$usrname= $_POST['usrname'];
$psword= $_POST['psword'];
$cpsword= $_POST['cpsword'];
$usertype =$_POST['usertype'];
$fname =$_POST['fname'];
$gender =$_POST['gender'];
$contact_no = $_POST['contact_no'];
$hnsb =$_POST['hnsb'];
$city =$_POST['city'];
$prv =$_POST['prv'];
$pc =$_POST['pc'];
$status =$_POST['status'];
$user_ref_number = random_int(1000, 99999999999) . rand(1000, 999999) . hex2bin($usrname);
$res= NULL;


/* if you can observe, the ‘fname’ and ‘lname’ inside the POST is the “name” attribute
in the input tags in the form*/
/* Let’s define our database parameters below, let’s use the lecture database*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agricomercio";//databasename
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
 
if(cidExists($conn, $usrname)!== false){
    $_SESSION['status'] = "Username already exist.";
    header("location:../form.php?error=Username is already taken");
    exit();

}
if(passExists($conn, $psword)!== false){
    $_SESSION['status'] = "Password already exist.";
    header("location:../form.php?error=Password is already taken");
    exit();

}
if(passMatch($psword, $cpsword)!== false){
    
    $_SESSION['status'] = "Password don't match.";
    header("location:../form.php?error=Password don't match");
        
    
}
else{

$sql = "INSERT INTO `users` ( `user_ref_num`, `user_name`, `password`, `status`, `user_type`)
VALUES ( '{$user_ref_number}', '${usrname}', '${psword}', 'Active', '${usertype}');" ;

$sql .="INSERT INTO  `user_info` 
(  `user_ref_num`, `user_fullname`,`gender`, `contact_details`, `house_no_street_brgy`, `city`, `province`, `postal_code`, `user_type`) 
 VALUES('{$user_ref_number}','${fname}', '${gender}', '${contact_no}', '${hnsb}', '${city}', '${prv}', '${pc}', '${usertype}');";


if (mysqli_multi_query($conn, $sql)) {
     $_SESSION['status'] = "<h2>Successfully Registered. You can Log In now!</h2>";
    header("location: ../sign_in.php");
    } else {
    echo "Error: " . $sql . mysqli_error($conn);
    }
    
}

mysqli_close($conn);
?> 
