<?php
session_start();
include ("../include/dbconnect.php");
$error = [];
$message = [];
// ---------------------------------//
// delete data from table
// ---------------------------------//

$table = $_GET['tbl'];
$id = $_GET['id'];

$sql = "DELETE FROM `{$table}` WHERE id = ?";
$stmt = mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"i",$paramid);
$paramid = $id;
if(mysqli_stmt_execute($stmt)){
    // on being successful
    array_push($message,"Data Deleted Successfully");
    $_SESSION['message'] = $message;
header("location:".$_SERVER['HTTP_REFERER']);
}else{
    // meaning it wasnt successfull
    array_push($error,"Something went wrong!");
    $_SESSION['error'] = $error;
header("location:".$_SERVER['HTTP_REFERER']);
};


?>