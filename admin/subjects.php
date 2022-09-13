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
    myHeader('Admin | Manage Subjects');
    Adminsidebar();
    errorDialogue();
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
    <section class="container" style="padding:5%">
        <div class="title py-3 d-flex justify-content-between">
            <h3>Manage Subjects</h3>
            <button class="toggleBtn "><i class="fa fa-plus me-2" aria-hidden="true"></i> Add new</button>
        </div>        
        <div class="mt-1 list-session border table-responsive">

            <table class="table">
                <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Subject name</td>                       
                        <td>Date Created</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql = "SELECT * FROM  subjects lIMIT 10";
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
                                        <td>{$row['name']}</td>
                                        <td>{$row['date_added']}</td>
                                        <td><a onclick='' href='../form_data/deletedata.php?tbl=subjects&id={$row['id']}'><button class='btn btn-danger' ><i class='fa fa-trash' aria-hidden='true'></i></button></a>
                                            <a onclick='' href='../form_data/updatedata.php?tbl=subjects&id=$row[id]'><button class='btn btn-warning' ><i class='fa fa-edit' aria-hidden='true'></i></button></a>                                         
                                        </td>
                                    </tr>
                               ";
                            };
                        }else{
                            // no data in the data base
                            echo "Add new Subjects";
                        }
                    ?>                    
                </tbody>

            </table>
        </div>

        <div class="addSession mt-2 show">
            <form action="../form_data/add_subjects.php" method="POST">
                <fieldset class=" p-4">
                    <div class="d-flex align-items-center">
                        <legend class="mb-0">Add New Subject</legend>
                        <div class="closeBtn rounded-2">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>                        
                    </div>
                    <hr class="mb-5">
                    <div class="form-group me-md-3 mb-3">
                        <label for="name">Subject Name</label>
                        <input type="text" name="subject_name" id="name" required>
                    </div>                       
                    <div class="btn-group">
                        <button class="btn btn-outline-primary" name="addSubject" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Submit</button>
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
