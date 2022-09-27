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
    <section class="">
        <div class="right-panel" id="panelView">
            <div class="" data-id="class_students">
                <div class="clas-student-head container pb-2 pt-5 px-4">
                    <h4 class="">Finance</h4>
                    <p class="text-secondary text-opacity-50">Monitor how your business is doing</p>
                    <ul class="tab d-flex ps-0" id="tab">
                        <li class="tab-active" id="overview">Overview</li>
                        <li class="" id="overview">Payment Request</li>
                    </ul>                    
                </div>
                <!-- this is where we will view and add students to a class -->
                <div class="container">
                    <div id="tabview">
                        <div class="overview" data-id="overview">
                            <div class="statistics container py-4">
                                <h3 class="fw-light mb-4">Statistics</h3>
                                <div class="row stat-panel">
                                    <div class="stat-tab col-md-4">
                                        <div class="stat-tab-body">
                                            <h3 class="m-0">$ 12,300,000 </h3>                                            
                                        </div>
                                        <div class="stat-tab-footer container bg-light">
                                            <p class="m-0"><i class="fi fi-rr-wallet me-2"></i> Expected termly Income </p>
                                        </div>
                                    </div>
                                    <div class="stat-tab col-md-4">
                                        <div class="stat-tab-body">
                                            <h3 class="m-0">$ 300,000 </h3>                                            
                                        </div>
                                        <div class="stat-tab-footer container bg-light">
                                            <p class="m-0">Current termly Income</p>
                                        </div>                                        
                                    </div>
                                    <div class="stat-tab col-md-4">
                                        <div class="stat-tab-body">
                                            <h3 class="m-0">$ 50,000 </h3>                                            
                                        </div>
                                        <div class="stat-tab-footer container bg-light">
                                            <p class="m-0">Total Term Expenditure</p>
                                        </div>                                        
                                    </div>                                    
                                </div>
                                <div class="row my-4">
                                    <div class="stat-tab">
                                        <canvas id="myChart" width="300" height="200"></canvas>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="addClassStudent" data-bs-backdrop="false" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Student</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-4 pt-1 pb-4">
                                        <form id="add_student_class_form">
                                            <span class="messageCenter"></span>
                                            <div class="form-group">
                                                <label for="classId">Choose Class</label>
                                                <Select id="classId" name="classId" class="w-100"></Select>
                                            </div>
                                            <div class="form-group">
                                                <label for="student">Choose Student</label>
                                                <select name="studentId" id="student_modal" class="w-100"></select>
                                            </div>
                                            <button id="addClassStudentBtn" name='submitBtn' class="btn btn-warning"><i
                                                    class="fi fi-rr-add me-1" aria-hidden="true"></i>Add
                                                Student</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <footer></footer>
</div>



<?php
footer();
?>
