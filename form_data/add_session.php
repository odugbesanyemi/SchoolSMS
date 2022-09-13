<!-- this function will add the session data to the database -->
<!-- it first checks if the name submitted is already in the database,if not it adds the information to the database -->
<?php
session_start();
include ("../include/dbconnect.php");
$error = [];
$message = [];
if(isset($_POST['addSession'])){
    //meaning the addsession was clicked
    // check if name first exist in the databse
    $sql = "SELECT * FROM session WHERE session_name =?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$paramName);
    $paramName = $_POST['session_name'];
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
        $sql = "INSERT INTO session(session_name) VALUES(?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,"s",$paramName);
        $paramName = $_POST['session_name'];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        array_push($message,"Session Added Successfully");
        $_SESSION['message']=$message;
        header("location:".$_SERVER['HTTP_REFERER']);
        
    }
}

?>