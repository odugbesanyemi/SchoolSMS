<!-- this function will add the session data to the database -->
<!-- it first checks if the name submitted is already in the database,if not it adds the information to the database -->
<?php
session_start();
include ("../include/dbconnect.php");
$error = [];
$message = [];
if(isset($_POST['addAdmin'])){
    //meaning the addAdmin was clicked
    // check if name first exist in the databse
    $sql = "SELECT * FROM admin WHERE username =?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$paramName);
    $paramName = $_POST['admin_username'];
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
        $sql = "INSERT INTO admin(fullname,username,password,email,profile_pic,active) VALUES(?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,"sssssi",$paramfullName,$paramusername,$paramPassword,$paramemail,$paramprofilepic,$paramactive);
        $paramfullName = $_POST['admin_name'];
        $paramusername = $_POST['admin_username'];
        $passphrase = $_POST['admin_password'];
        $paramPassword = password_hash($passphrase,PASSWORD_DEFAULT);
        $paramemail = $_POST['admin_email'];
        $paramprofilepic = "";
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