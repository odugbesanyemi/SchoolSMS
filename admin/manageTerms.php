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
    myHeader('Admin | Manage Terms');
    Adminsidebar();
    errorDialogue();
?>

<div class="page-content">
    <section class="container" style="padding:5%">
        <div class="wrapper">
            <div class="title py-1 d-flex justify-content-between align-items-center">
                <p class="m-0">Manage Terms</p>
                <button class="toggleBtn" data-bs-toggle="modal" data-bs-target="#addterms"><i class="fi fi-rr-add me-1" aria-hidden="true"></i> Add new</button>
            </div>       
            <div class="mt-1 list-session table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>S/N</td>
                            <td>Term</td>
                            <td>Session</td>                        
                            <td>Start Date</td>
                            <td>End Date</td>
                            <td>Active</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT *,term.id,term.active as termActive FROM  term
                            INNER JOIN session
                            ON term.sessionID = session.id
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
                                        <tr>
                                            <td>{$count}</td>
                                            <td>{$row['termName']}</td>
                                            <td>{$row['session_name']}</td>
                                            <td>{$row['start_date']}</td>
                                            <td>{$row['end_date']}</td>
                                            <td>{$row['termActive']}</td>
                                            <td>
                                                <div class='btn-group'>
                                                    <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                        Actions
                                                    </button>
                                                    <ul class='dropdown-menu'>
                                                        <li><a onclick='' class='dropdown-item' href='../form_data/deletedata?tbl=term&id={$row['id']}'><i class='fi fi-rs-trash me-2'></i>Delete</a></li>
                                                        <li><a onclick='' class='dropdown-item' href='../form_data/updatedata?tbl=term&id=$row[id]'><i class='fi fi-rr-pencil me-2'></i>edit</a></li>                                         
                                                        <li><a onclick='' class='dropdown-item' href='classinfo?classid=$row[id]'><i class='fi fi-rs-eye me-2'></i>view</a></li>                                         
                                                    </ul>
                                                </div>                                             
                                            </td>
                                        </tr>
                                ";
                                };
                            }else{
                                // no data in the data base
                                echo "Add a new Term";
                            }
                        ?>                    
                    </tbody>

                </table>
            </div>
        </div>
        <div class="modal fade" id="addterms" data-bs-backdrop="false" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Terms</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 pt-1 pb-4">
                        <form action="../form_data/add_term.php" method="POST">
                            <fieldset class=" p-2">
                                <div class="form-group me-md-3 mb-3">
                                    <label for="name">Term Name</label>
                                    <input type="text" name="term_name" id="name" required class="w-100">
                                </div>   
                                    <!--retrieve databse value into select  -->
                                <div class="form-group me-md-3 mb-3">
                                    <label for="session">Session</label>
                                    <select name="session" id="session" class="w-100">
                                        <option selected >Choose Session</option>
                                        <?php 
                                            $sql = 'SELECT * from session';
                                            $result = mysqli_query($conn,$sql);
                                            while($row = mysqli_fetch_array($result)){
                                                echo "
                                                    <option value={$row['id']}> {$row['session_name']} </option>
                                                ";
                                            }
                                        ?>
                                    </select>
                                </div>   
                                <div class="form-group me-md-3 mb-3">
                                    <label for="end_Date">Term End Date</label>
                                    <input type="date" name="end_Date" id="end_Date" class="w-100">
                                </div> 
                                <div class="form-group me-md-3 mb-3">
                                    <div class="form-check form-switch d-flex align-items-center p-0 w-50">
                                    <label class="form-check-label d-block w-75" for="flexSwitchCheckDefault">Set as active</label>                            
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="admin_active">
                                    </div>
                                </div> 
                                <div class="btn-group">
                                    <button class="btn btn-outline-primary" name="addTerm" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Submit</button>
                                </div>                                                                                                                                                                                                      
                            </fieldset>
                        </form>
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
