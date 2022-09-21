<?php
    include('../include/dbconnect.php');
    if(isset($_GET['select'])){
        $sql = "SELECT * FROM session";
        $result = mysqli_query($conn,$sql);
        $sessionArray = [];
        while($row = mysqli_fetch_array($result)){
            array_push($sessionArray,$row);
        }
        echo json_encode($sessionArray) ;        
    }

    if(isset($_GET['sessionId'])){
        $sql = "SELECT * FROM term WHERE sessionID = ?";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"i",$paramID);
        $paramID = $_GET['sessionId'];
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $termData = [];
        while($row = mysqli_fetch_array($result)){
            array_push($termData,$row);
        }
        echo json_encode($termData);
    }
?>