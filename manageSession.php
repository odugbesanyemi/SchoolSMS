<?php
    session_start();
    include('include/dbconnect.php');
    include "include/components.php";
    myHeader('Manage Session');
    sidebar();
    errorDialogue();
?>

<div class="page-content col-md-9 col-lg-10">
    <nav class="navbar bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand"><img src="assets/images/kingsmeadlogo.jpg" alt="" width="50"> School Management System</a>
            <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <section class="container">
        <div class= "jumbotron py-3">
            <h2>Super Admin</h2>
            <p>Welcome Back!</p>        
        </div>
        <div class="mt-1 list-session border table-responsive">
            <table class="table table-light table-striped">
                <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Session Name</td>
                        <td>Date Created</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql = "SELECT * FROM  session ";
                        $stmt = mysqli_prepare($conn,$sql);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result)>0){
                            // meaning there is active data then display the data
                            while($row = mysqli_fetch_array($result)){
                               echo "
                                    <tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['session_name']}</td>
                                        <td>{$row['session_date']}</td>
                                        <td><a href='form_data/deletedata.php?tbl=session&id=$row[id]'><button class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button></a></td>
                                    </tr>
                               ";
                            };
                        }else{
                            // no data in the data base
                            echo "Create a new Session";
                        }
                    ?>                    
                </tbody>

            </table>
        </div>

        <div class="addSession mt-2">
            
            <form action="form_data/add_session.php" method="POST">
                <fieldset class="border p-4">
                    <legend>Add New Session</legend>
                    <div class="form-group">
                        <label for="sessionName">Session Name </label>
                        <input type="text" name="session_name" id="sessionName" required>
                        <button class="btn btn-primary" name="addSession">Add</button>
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
