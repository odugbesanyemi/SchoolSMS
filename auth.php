<?php
    session_start();
    include('include/dbconnect.php');
    include "include/components.php";
    myHeader('Manage Admin');
    errorDialogue();
?>

<div class="page-content col-md-12 col-lg-12">

    <section class="container" style="padding:5%">
        <div class= "jumbotron py-3 text-center">
            <h2>Sign In</h2>
            <p>Welcome!</p>        
        </div>
        <div class="auth-field ">
            <form action="form_data/authentication.php" method="POST">
                <div class="auth-btn-group">
                    <div class="usertoggle">
                        <input type="radio" name="userType" id="admin" checked required value="admin">                        
                        <label for="admin">Admin</label>
                    </div>
                    <div class="usertoggle">
                        <input type="radio" name="userType" id="teacher" required value="teacher">                        
                        <label for="teacher">Teacher</label>
                    </div>
                    <div class="usertoggle">
                        <input type="radio" name="userType" id="student" required value="student">                        
                        <label for="student">Student</label>
                    </div>                    
                    <div class="usertoggle">
                        <input type="radio" name="userType" id="parent" required value="parent">                        
                        <label for="parent">Parent</label>
                    </div>                 
                </div>
                <div class="auth-input-group">
                    <div class="form-group">
                        <input type="text" placeholder="username" name="username" required>                
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="*******" name="userpassword" required>                
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="" id="rememberMe">
                        <label for="rememberMe" class="remember"><p>Remember Me</p></label>
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn customBtn border-0" type="submit" name="signinBtn">Continue <i class="fa fa-long-arrow-right"></i></button>
                    </div>                    
                </div>
            </form>
        </div>
    <div class="text-center py-3">
        <small>All rights Reserved Kingsmead College</small>
        <p class="text-mute"><small>Developed and maintained by Tecxha IT Solutions</small></p>
    </div>
    </section>
    <footer></footer>    
</div>


<?php
footer();
?>
