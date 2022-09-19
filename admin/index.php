<?php
    session_start();
    if($_SESSION['logged_in']==true && $_SESSION['usertype']=="admin"){
        // meaning the user is logged in
        
    }else{
        // not logged in return user to login page
        header("location:../auth.php");
        array_push($error,"Unauthorised Access!");
        $_SESSION['error'] = $error;
    }
    include('../include/dbconnect.php');
    include "../include/components.php";
    myHeader('Dashboard');
    adminsidebar();
    errorDialogue();
?>

<div class="page-content">
    <section class="container" style="padding:5%">
        <div class= "jumbotron py-3">
            <h2>Welcome Admin</h2>
            <p>Good day!</p>        
        </div>

    </section>
    <footer></footer>    
</div>


<?php
footer();
?>
