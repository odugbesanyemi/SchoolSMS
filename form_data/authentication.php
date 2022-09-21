<?php
session_start();
include ("../include/dbconnect.php");
$error = [];
$message = [];

if(isset($_POST['signinBtn'])){
    // check for active session
    $sql = "SELECT * FROM session WHERE active = 1 ORDER BY active DESC";
    $result = mysqli_query($conn,$sql);
    $activeSession = "";
    while($row = mysqli_fetch_array($result)){
        $activeSession = $row['id'];
    }
    //meaning the usertype has been selected and continue btn clicked on
    // check if username first exist in the databse
    $userType = $_POST['userType'];
    $sql = "SELECT * FROM $userType  WHERE username = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$paramName);
    $paramName = $_POST['username'];
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result)>0){
        // meaning data exists
        // check if password matches the database password
        $userPassword = $_POST['userpassword'];
        while($row = mysqli_fetch_array($result)){
            $dbPassword = $row['password'];
            $passcheck = password_verify($userPassword,$dbPassword);
            if ($passcheck) {
                // meaning the password matched 
                // direct user to right page
                // set session variables
                $_SESSION['logged_in']= true;
                $_SESSION['userid']=$row['id'];
                $_SESSION['usertype']=$userType;
                array_push($message,"successful Login");
                $_SESSION['message'] = $message;
                $_SESSION['activeSession']= $activeSession;
                header("location:../".$userType."/");  
            
            }
            else if($row['active']==0){
                // meaning the user is not active 
                array_push($error,"Contact the Administrator");
                $_SESSION['error']= $error;
                header("location:".$_SERVER['HTTP_REFERER']);  
            }
            else {
                // meaning wrong password
                // tell user to try again
                array_push($error,"Password does not match");
                $_SESSION['error']=$error;
                header("location:".$_SERVER['HTTP_REFERER']);                
            }
        }
        
    }else{
        // meaning there is no such data in the database
        // send the user an error response
        array_push($error,"Something went wrong!");
        $_SESSION['error']=$error;
        header("location:".$_SERVER['HTTP_REFERER']);
        
    }
}

?>