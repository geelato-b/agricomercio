<?php
$servername="localhost";
$dbusername="root";
$dbpassword="";
$dbname="agricomercio";
 

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn){
    die("Maintenance Mode". msqli_connect_error());
}
else{
    echo "";
}