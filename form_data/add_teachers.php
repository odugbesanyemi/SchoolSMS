<?php
session_start();
include ("../include/dbconnect.php");
$error = [];
$message = [];
if(isset($_POST['addteacher'])){
    //meaning the addAdmin was clicked
    // check if name first exist in the databse
    $sql = "SELECT * FROM teacher WHERE username = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$paramName);
    $paramName = $_POST['username'];
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result)>0){
        // meaning data exists
        array_push($error,"Data already Exists");
        $_SESSION['error']= $error;
        header("location:".$_SERVER['HTTP_REFERER']);
    }else{
        // meaning there is no such data in the database
        // send the data to the database
        $sql = "INSERT INTO teacher(`name`,username,`password`,phone,email) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,"sssss",$paramfullName,$paramusername,$paramPassword,$paramphone,$paramemail);
        $paramfullName = $_POST['name'];
        $paramusername = $_POST['username'];
        $passphrase = $_POST['password'];
        $paramPassword = password_hash($passphrase,PASSWORD_DEFAULT);
        $paramphone = $_POST['tel'];
        $paramemail = $_POST['email'];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        array_push($message,"Teacher Added Successfully");
        $_SESSION['message']=$message;
        header("location:".$_SERVER['HTTP_REFERER']);
    }
}

?>