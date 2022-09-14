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

<div class="page-content col-md-9 col-lg-10">
    <section class="container" style="padding:5%">
        <div class="title py-3 d-flex justify-content-between">
            <h3>Manage Terms</h3>
            <button class="toggleBtn "><i class="fa fa-plus me-2" aria-hidden="true"></i> Add new</button>
        </div>      
        <div class="mt-1 list-session border table-responsive">

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
                        $sql = "SELECT *,term.id FROM  term
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
                                        <td>{$row['active']}</td>
                                        <td><a onclick='' href='../form_data/deletedata.php?tbl=term&id={$row['id']}'><button class='btn btn-danger' ><i class='fa fa-trash' aria-hidden='true'></i></button></a>
                                            <a onclick='' href='../form_data/updatedata.php?tbl=term&id=$row[id]'><button class='btn btn-warning' ><i class='fa fa-edit' aria-hidden='true'></i></button></a>                                         
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

        <div class="addSession mt-2">
            <form action="../form_data/add_term.php" method="POST">
                <fieldset class=" p-4">
                    <div class="d-flex align-items-center">
                        <legend class="mb-0">Add New Term</legend>
                        <div class="closeBtn rounded-2">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>                        
                    </div>
                    <div class="form-group me-md-3 mb-3">
                        <label for="name">Term Name</label>
                        <input type="text" name="term_name" id="name" required>
                    </div>   
                          <!--retrieve databse value into select  -->
                    <div class="form-group me-md-3 mb-3">
                        <label for="session">Session</label>
                        <select name="session" id="session">
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
                        <input type="date" name="end_Date" id="end_Date" >
                    </div> 
                    <div class="form-group me-md-3 mb-3">
                        <div class="form-check form-switch">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Active</label>                            
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="admin_active">
                        </div>
                    </div> 
                    <div class="btn-group">
                        <button class="btn btn-outline-primary" name="addTerm" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Submit</button>
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
