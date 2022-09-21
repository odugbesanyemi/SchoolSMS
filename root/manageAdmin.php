<?php
    session_start();
    include('../include/dbconnect.php');
    include "../include/components.php";
    myHeader('Manage Admin');
    sidebar();
    errorDialogue();
?>

<div class="page-content">

    <section class="container" style="padding:5%">
        <div class= "jumbotron py-3">
            <h2>Super Admin</h2>
            <p>Welcome Back!</p>        
        </div>
        <div class="wrapper">
            <div class="title py-1 d-flex justify-content-between align-items-center">
                <p class="m-0">Admin</p>
                <button class="toggleBtn "><i class="fi fi-rr-add me-1" aria-hidden="true"></i> Add new</button>
            </div>     
            <div class="mt-1 list-session table-responsive">
                <table class="table table-light table-striped">
                    <thead>
                        <tr>
                            <td>S/N</td>
                            <td>Fullname</td>
                            <td>Username</td>
                            <td>Email</td>
                            <td>Active</td>
                            <td>Date Added</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM  admin";
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
                                            <td>{$row['fullname']}</td>
                                            <td>{$row['username']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['active']}</td>
                                            <td>{$row['date_joined']}</td>
                                            <td><a onclick='confirmCommand()' href='form_data/deletedata.php?tbl=admin&id=$row[id]'><button class='btn btn-danger' ><i class='fa fa-trash' aria-hidden='true'></i></button></a>
                                                <a onclick='confirmCommand()' href='form_data/updatedata.php?tbl=session&id=$row[id]'><button class='btn btn-warning' ><i class='fa fa-edit' aria-hidden='true'></i></button></a>                                         
                                            </td>
                                        </tr>
                                ";
                                };
                            }else{
                                // no data in the data base
                                echo "Add a new Admin";
                            }
                        ?>                    
                    </tbody>

                </table>
            </div>
        </div>                    
        <div class="addSession mt-2">
            <form action="../form_data/add_admin.php" method="POST">
                <fieldset class=" p-4 border-1">
                    <legend class="mb-4">Add New Admin</legend>
                    <div class="form-group me-md-3 mb-3">
                        <label for="name">Full Name</label>
                        <input type="text" name="admin_name" id="name" required>
                    </div>         
                    <div class="form-group me-md-3 mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="admin_username" id="username" required>
                    </div>   
                    <div class="form-group me-md-3 mb-3">
                        <label for="email">Email Address</label>
                        <input type="email" name="admin_email" id="email" required>
                    </div> 
                    <div class="form-group me-md-3 mb-3">
                        <label for="password">Create Password</label>
                        <input type="password" name="admin_password" id="password" required>
                    </div> 
                    <div class="form-group me-md-3 mb-3">
                        <div class="form-check form-switch">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Active</label>                            
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="admin_active">
                        </div>
                    </div> 
                    <div class="btn-group">
                        <button class="btn btn-outline-primary" name="addAdmin" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Submit</button>
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
