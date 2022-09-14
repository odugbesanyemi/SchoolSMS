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
    $sql = "SELECT * FROM class WHERE id = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$paramclassid);
    $paramclassid = $_GET['classid'];
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
    $class_data = [];
    while($row = mysqli_fetch_assoc($query)){
        array_push($class_data,$row);
    }
?>

<div class="page-content col-md-9 col-lg-10">
    <div class="class-dashboard title py-3 d-flex justify-content-between">
        <div class=""><h3 class="m-0"><?php echo $class_data[0]['className'] ?></h3><p class="small m-0">Techer: Mrs. Adegbola</p></div>
        <div class="class-details d-flex flex-row align-items-center justify-content-center text-center">
            <div class="px-3 border-end">
                <h5>150</h5>
                <p class="small">Students</p>
            </div>
            <div class="px-3">
                <h5>150</h5>
                <p class="small">subjects</p>
            </div>
              
        </div>
    </div>       
    <section class="row g-0">
        <div class="left-panel col-md-1 d-flex flex-md-column justify-content-start border-end" id="tabPanel">
            <button class="btn p-4 inview" id="class_students">
                <i class="fi fi-br-user-add"></i> <br>
            </button> 
            <button class="btn p-4" id="class_subjects">
                <i class="fi fi-rr-books"></i> <br>
            </button> 
            <button class="btn p-4" id="class_payments">
                <i class="fi fi-rs-receipt"></i> <br>
            </button>    
            <button class="btn p-4" id="class_settings">
                <i class="fi fi-rr-settings-sliders"></i> <br>
            </button>                                   
        </div>
        <div class="right-panel col-md-11" id="panelView">                
            <div class="" data-id="class_students">
                <div class="clas-student-head container pb-2 pt-5 px-5">
                    <h4 class="mb-3">Students</h4>
                    <p class="text-secondary text-opacity-50">Here, you can view, manage and add students enrolled to this selected class.</p>
                </div>
                <!-- this is where we will view and add students to a class -->
                <div class="container">
                    <ul class="tab d-flex" id="tab">
                        <li class="tab-active" id="overview">Overview</li>
                        <li><i class="fi fi-br-plus-small" id="addstudent"></i> Add Student</li>
                    </ul>
                    <div id="tabview">
                        <div class="overview" data-id="overview">
                            <div class="container p-4" >
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <td>S/N</td>
                                                <td>Name</td>
                                                <td>Reg No</td>                        
                                                <td>gender</td>
                                                <td>username</td>
                                                <td>actions</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sql = "SELECT * FROM  class_student 
                                                INNER JOIN class
                                                ON class_student.classID = class.id
                                                INNER JOIN student
                                                ON class_student.studentID = student.id
                                                lIMIT 10";
                                                $stmt = mysqli_prepare($conn,$sql);
                                                mysqli_stmt_execute($stmt);
                                                $result = mysqli_stmt_get_result($stmt);
                                                if(mysqli_num_rows($result)>0){
                                                    // meaning there is active data then display the data
                                                    $count=0;
                                                    while($row = mysqli_fetch_array($result)){
                                                        $count++;
                                                    echo "
                                                            <a href='classinfo.php?id={$row['id']}'>
                                                            <tr>
                                                                <td>{$count}</td>
                                                                <td>{$row['Name']}</td>
                                                                <td>{$row['reg_no']}</td>
                                                                <td>{$row['gender']}</td>
                                                                <td>{$row['username']}</td>
                                                                <td class='d-flex flex-row'><a onclick='' href='../form_data/deletedata.php?tbl=class&id={$row['id']}'><button class='btn btn-danger' ><i class='fa fa-trash' aria-hidden='true'></i></button></a>
                                                                </td>
                                                            </tr>
                                                            </a>
                                                    ";
                                                    };
                                                }else{
                                                    // no data in the data base
                                                }
                                            ?>                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="collapse " data-id="addstudent"></div>                        
                    </div>

                </div>
            </div>
            <div class="collapse" data-id="class_subjects">
                
            </div>
            <div class="collapse" data-id="class_payments"></div>            
            <div class="collapse" data-id="class_settings">
                <div class="clas-student-head container pb-2 pt-5 px-5">
                    <h4 class="mb-3">Settings</h4>
                    <p class="text-secondary text-opacity-50">Here, you can configure the data displayed. change Session and term displayed.</p>
                </div>
                <!-- this is where we will view and add students to a class -->
                <div class="container">
 
                </div>                
            </div>            
        </div>
    </section>
    <footer></footer>    
</div>


<?php
footer();
?>
