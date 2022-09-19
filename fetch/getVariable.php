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

    }
?>