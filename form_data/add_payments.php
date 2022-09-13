<?php
session_start();
include ("../include/dbconnect.php");
$error = [];
$message = [];
if(isset($_POST['addPayment'])){
    //meaning the addTerm was clicked
    // check if name first exist in the databse
    $sql = "SELECT * FROM payment WHERE type =?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$paramName);
    $paramName = $_POST['type'];
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
        $sql = "INSERT INTO payment(type,description) VALUES(?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,"ss",$paramtype,$paramdesc);
        $paramtype = $_POST['payment_type'];
        $paramdesc = $_POST['payment_desc'];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        array_push($message,"Admin Added Successfully");
        $_SESSION['message']=$message;
        header("location:".$_SERVER['HTTP_REFERER']);
    }
}

?>