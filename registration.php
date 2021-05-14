<?php //open a php tag
//let’s put security aside first just to shorten the explanation.
//declare a new variable where we will store the POST variable values.
session_start();
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

$sql_check = "SELECT users_name
                    FROM users
                   WHERE users_name = ?
                  ;";
    $stmt_chk = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_chk, $sql_check)){
        header("location: index.php?error=3"); //statement failed
        exit();
    }
    mysqli_stmt_bind_param($stmt_chk,"s",$usrname);
    mysqli_stmt_execute($stmt_chk);
    $chk_result=mysqli_stmt_get_result($stmt_chk);
    $arr=array();
    while($row = mysqli_fetch_assoc($chk_result)){
        array_push($arr,$row);
    }
    if(!empty($arr)){
        $_SESSION['status'] = "Username already exists.";
		header("location:../form.php");
    }else{
    	exit();
    }
	
		
		if($psword == $cpsword){
			
		// Here goes your SQL for INSERT the values will be the variables declared.
			
			
				$sql = "INSERT INTO `users` (`user_name`, `password`, `user_type`)
					VALUES ( '${usrname}', '${psword}', '${usertype}');" ;

					$sql .="INSERT INTO  `user_info` 
					(`user_fullname`,`gender`, `contact_details`, `house_no_street_brgy`, `city`, `province`, `postal_code`, `user_type`) 
		 			VALUES('${fname}', '${gender}', '${contact_no}', '${hnsb}', '${city}', '${prv}', '${pc}', '${usertype}');";
		 			// Check if the query successfully ran.
					if (mysqli_multi_query($conn, $sql)) {
		   			 // if no error. Then new record created.
					$_SESSION['status'] = "<h2>Successfully Registered. You can Log In now!</h2>";
		      		 header("location: ../sign_in.php");
					} 
					else {
		    		// else then error will show up.
		   		 	echo "Error: " . $sql . mysqli_error($conn);
					}
			
		}
		else{
			$_SESSION['status'] = "Password don't match.";
			header("location:../form.php");
			}  	


    
    mysqli_close($conn);
?> 