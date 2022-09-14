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
    myHeader('Admin | Manage Student');
    Adminsidebar();
    errorDialogue();
?>

<div class="page-content col-md-9 col-lg-10">
    <section class="container" style="padding:5%">
        <div class="title py-3 d-flex justify-content-between">
            <h3>Manage Student</h3>
            <button class="toggleBtn "><i class="fa fa-plus me-2" aria-hidden="true"></i>Add new</button>
        </div>      
        <div class="mt-1 list-session border table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Name</td>
                        <td>username</td>                        
                        <td>RegNo</td>
                        <td>Email Address</td>
                        <td>phone</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql = "SELECT * FROM  student lIMIT 10";
                        $stmt = mysqli_prepare($conn,$sql);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result)>0){
                            // meaning there is active data then display the data
                            $count=0;
                            while($row = mysqli_fetch_array($result)){
                                $count++;
                               echo "
                                    <tr>
                                        <td>{$count}</td>
                                        <td>{$row['Name']}</td>
                                        <td>{$row['username']}</td>
                                        <td>{$row['reg_no']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['phone']}</td>
                                        <td><a onclick='' href='../form_data/deletedata.php?tbl=student&id={$row['id']}'><button class='btn btn-danger' ><i class='fa fa-trash' aria-hidden='true'></i></button></a>
                                            <a onclick='' href='../form_data/updatedata.php?tbl=student&id=$row[id]'><button class='btn btn-warning' ><i class='fa fa-edit' aria-hidden='true'></i></button></a>                                         
                                        </td>
                                    </tr>
                               ";
                            };
                        }else{
                            // no data in the data base
                            echo "Add a new Student";
                        }
                    ?>                    
                </tbody>

            </table>
        </div>

        <div class="addSession mt-2">
            <form action="../form_data/add_student.php" method="POST">
                <fieldset class=" p-4">
                    <div class="d-flex align-items-center">
                        <legend class="mb-0">Add New Student</legend>
                        <div class="closeBtn rounded-2">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>                        
                    </div>
                    <div class="form-group me-md-3 mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="student_name" id="name" required>
                    </div>   
                    <div class="form-group me-md-3 mb-3">
                        <label for="name" >Gender</label>
                        <div class="radio-group p-3" >
                            <label for="male" class="radio me-3">Male</label>
                            <input type="radio" name="student_gender" id="male" value="male" checked required>
                            <label for="female" class="radio ms-3 me-3">Female</label>
                            <input type="radio" name="student_gender" id="female" value="female" required>                            
                        </div>
                    </div>   
                    <div class="form-group me-md-3 mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="student_username" id="username" required>
                    </div>   
                    <div class="form-group me-md-3 mb-3">
                        <label for="password">Password</label>
                        <input type="text" name="student_password" id="password" required>
                    </div>                       
                    <div class="form-group me-md-3 mb-3">
                        <label for="regNo">Registration Number</label>
                        <input type="text" name="reg_no" id="regNo" required>
                    </div>   
                    <div class="form-group me-md-3 mb-3">
                        <label for="phone">Phone Number</label>
                        <input type="tel" name="student_phone" id="phone">
                    </div>                                                                                   
                          <!--retrieve databse value into select  -->  
                    <div class="form-group me-md-3 mb-3">
                        <label for="email">Email Address</label>
                        <input type="email" name="student_email" id="email" >
                    </div>  
                    <div class="btn-group">
                        <button class="btn btn-outline-primary" name="addStudent" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Submit</button>
                    </div>                                                                                                                                                                                                      
                </fieldset>
            </form>
        </div>

    </section>
    <footer></footer>    
</div>


<?php
footer();
?>
