<?php
$servername="localhost";
$dbusername="root";
$dbpassword="";
$dbname="agricomercio";
 

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn){
    die("Connection failed". msqli_connect_error());
}
else{
    echo "";
}