<?php
function createUser($conn, $username, $password, $usertype){
    $err;
    $sql ="INSERT INTO `users` (`user_name`, `Password`, `user_type`);
    VALUES (?,?,?)";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
      return false;
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $username, $password, $usertype);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    return true;

}
function uidExists($conn, $username, $password ){
    $err;
    $sql="SELECT * FROM `users` 
    WHERE  `user_name` = ?
    AND `password`= ?;
    ";

$stmt=mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: sign_in.php?error=stmtfailed");
        exit();
    }

        mysqli_stmt_bind_param($stmt, "ss" , $username, $password);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $err=  false;
            return $err;   
        }
        mysql_stmt_close($stmt);
}
