<!-- this function will add the session data to the database -->
<!-- it first checks if the name submitted is already in the database,if not it adds the information to the database -->
<?php
session_start();
include ("../include/dbconnect.php");
$error = [];
$message = [];
if(isset($_POST['addStudent'])){
    //meaning the addAdmin was clicked
    // check if name first exist in the databse
    $sql = "SELECT * FROM student WHERE username =?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$paramName);
    $paramName = $_POST['student_username'];
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
        $sql = "INSERT INTO student(Name,gender,username,password,reg_no,phone,email) VALUES(?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,"sssssss",$paramfullName,$paramGender,$paramusername,$paramPassword,$paramreg_no,$paramphone,$paramemail);
        $paramfullName = $_POST['student_name'];
        $paramGender = $_POST['student_gender'];
        $paramusername = $_POST['student_username'];
        $passphrase = $_POST['student_password'];
        $paramPassword = password_hash($passphrase,PASSWORD_DEFAULT);
        $paramreg_no = stdregprefix.$_POST['reg_no'];
        $paramphone = $_POST['student_phone'];
        $paramemail = $_POST['student_email'];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        array_push($message,"Student Added Successfully");
        $_SESSION['message']=$message;
        header("location:".$_SERVER['HTTP_REFERER']);
        
    }
}

?>