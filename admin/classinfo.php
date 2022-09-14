<?php
    session_start();
    $error = [];
    if($_SESSION['logged_in']==true && $_SESSION['usertype']=="admin"){
        // meaning the user is logged in
        
    }else{
        // not logged in return user to login page
        header("location:../auth.php");
        array_push($error,"Unauthorised Access!");
        $_SESSION['error'] = $error;
    }
    include('../include/dbconnect.php');
    include ("../include/components.php");
    myHeader('Admin | Manage class');
    Adminsidebar();
    errorDialogue();

    // get data from the classid get property
    $sql = "SELECT * FROM class WHERE id = {$_GET['classid']}";
    $query = mysqli_query($conn,$sql);
    $class_data = [];
    while($row = mysqli_fetch_assoc($query)){
        array_push($class_data,$row);
    }
?>

<div class="page-content col-md-9 col-lg-10">
    <nav class="navbar bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand"><img src="../assets/images/kingsmeadlogo.jpg" alt="" width="50"> School Management System</a>
            <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <section class="row g-0">
        <div class="left-panel col-md-1 d-flex flex-md-column justify-content-center">
           <button class="btn p-4">
            <i class="fi fi-br-user-add"></i> <br>
            </button> 
            <button class="btn p-4">
            <i class="fi fi-rr-books"></i> <br>
            </button> 
            <button class="btn p-4">
            <i class="fi fi-rs-receipt"></i> <br>
            </button>                         
        </div>
        <div class="right-panel col-md-11">
            <div class="class-dashboard title py-3 d-flex justify-content-between">
                <div class=""><h3><?php echo $class_data[0]['className'] ?></h3><p class="small">Techer: Mrs. Adegbola</p></div>
                <div class="class-details d-flex flex-row align-items-center justify-content-center text-center">
                    <div class="px-3 border-end">
                        <h5>150</h5>
                        <p class="small">Students</p>
                    </div>
                    <div class="px-3 border-end">
                        <h5>150</h5>
                        <p class="small">subjects</p>
                    </div>
                    <div class="mx-3">
                        <h5>15</h5>
                        <p class="small">payments type</p>
                    </div>                
                </div>
            </div>        
            <div class="class-students">
                <!-- this is where we will view and add students to a class -->
            </div>
            <div class="class-subjects"></div>
            <div class="class-payments"></div>            
        </div>

    </section>
    <footer></footer>    
</div>


<?php
footer();
?>
