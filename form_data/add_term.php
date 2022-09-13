<?php
session_start();
include ("../include/dbconnect.php");
$error = [];
$message = [];
if(isset($_POST['addTerm'])){
    //meaning the addTerm was clicked
    // check if name first exist in the databse
    $sql = "SELECT * FROM term WHERE termName =? AND sessionID = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"si",$paramName,$paramsessionID);
    $paramName = $_POST['term_name'];
    $paramsessionID = $_POST['session'];
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
        $sql = "INSERT INTO term(termName,sessionID,end_date,active) VALUES(?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,"sssi",$paramName,$paramsession,$paramend_date,$paramactive);
        $paramName = $_POST['term_name'];
        $paramsession = $_POST['session'];
        $paramend_date = $_POST['end_Date'];
        if($_POST['admin_active']=="on"){
            $paramactive = 1;            
        }else{
            $paramactive = 0;              
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        array_push($message,"Admin Added Successfully");
        $_SESSION['message']=$message;
        header("location:".$_SERVER['HTTP_REFERER']);
    }
}

?>