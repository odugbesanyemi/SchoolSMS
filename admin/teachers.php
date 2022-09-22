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
    myHeader('Admin | Manage Teachers');
    Adminsidebar();
    errorDialogue();
?>

<div class="page-content">
    <section class="container" style="padding:5%"> 
        <div class="wrapper">
            <div class="title py-1 d-flex justify-content-between align-items-center">
                <p class="m-0">Manage Teachers</p>
                <button class="toggleBtn" data-bs-toggle="modal" data-bs-target="#addteachers"><i class="fi fi-rr-add me-1" aria-hidden="true"></i> Add new</button>
            </div>                 
            <div class="mt-1 list-session table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>S/N</td>
                            <td>Name</td>
                            <td>Username</td>                        
                            <td>Email Address</td>
                            <td>Phone Number</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM  teacher lIMIT 10";
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
                                            <td>{$row['username']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['phone']}</td>
                                            <td><a onclick='' href='../form_data/deletedata.php?tbl=teachers&id={$row['id']}'><button class='btn btn-danger' ><i class='fa fa-trash' aria-hidden='true'></i></button></a>
                                                <a onclick='' href='../form_data/updatedata.php?tbl=teachers&id=$row[id]'><button class='btn btn-warning' ><i class='fa fa-edit' aria-hidden='true'></i></button></a>                                         
                                            </td>
                                        </tr>
                                ";
                                };
                            }else{
                                // no data in the data base
                                echo "Add a new Teachers";
                            }
                        ?>                    
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="addteachers" data-bs-backdrop="false" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Teacher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 pt-1 pb-4">
                        <form action="../form_data/add_teachers.php" method="POST">
                            <fieldset class="p-2">
                                <div class="form-group me-md-3 mb-3">
                                    <label for="name">Teacher Name</label>
                                    <input type="text" name="name" id="name" required class="w-100">
                                </div>  
                                <div class="form-group me-md-3 mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" required class="w-100">
                                </div>
                                <div class="form-group me-md-3 mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" required class="w-100">
                                </div>
                                <div class="form-group me-md-3 mb-3">
                                    <label for="email">Teacher Email</label>
                                    <input type="email" name="email" id="email" required class="w-100">
                                </div>     
                                <div class="form-group me-md-3 mb-3">
                                    <label for="tel">Phone</label>
                                    <input type="tel" name="tel" id="tel" required class="w-100">
                                </div>                       
                                <div class="btn-group">
                                    <button class="btn btn-outline-primary" name="addteacher" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Submit</button>
                                </div>                                                                                                                                                                                                      
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="addSession mt-2">

        </div>

    </section>
    <footer></footer>    
</div>


<?php
footer();
?>
