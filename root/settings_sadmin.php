<?php
    session_start();
    include('include/dbconnect.php');
    include "include/components.php";
    myHeader('Manage Admin');
    sidebar();
    errorDialogue();
?>

<div class="page-content col-md-9 col-lg-10">
    <nav class="navbar bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand"><img src="assets/images/kingsmeadlogo.jpg" alt="" width="50"> School Management System</a>
            <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <section class="container" style="padding:5%">
        <div class= "jumbotron py-3">
            <h2>Super Admin</h2>
            <p>Welcome Back!</p>        
        </div>
        <hr>
        <div class="settings">
            <form action="">
                <div class="form-group">
                    <p>Change Password</p>
                    <input type="password" placeholder="Old Password">
                    <input type="password" placeholder="New Password">                    
                </div>
                <div class="form-group mt-4">
                    <p>Change Theme</p>
                    <input type="color" name="" id="">
                    <input type="color" name="" id="">
                    <input type="color" name="" id="">
                </div>
                <div class="form-group mt-4">
                    <p>Delete Account</p>
                    <button class="btn btn-danger border-0" type="submit" onclick="confirmCommand()">Confirm</button>
                </div>
            </form>
        </div>

    </section>
    <footer></footer>    
</div>


<?php
footer();
?>
