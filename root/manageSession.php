<?php
    session_start();
    include('../include/dbconnect.php');
    include ("../include/components.php");
    myHeader('Manage Session');
    sidebar();
    errorDialogue();
?>

<div class="page-content ">
    <section class="container"style="padding:5%">
        <div class= "jumbotron py-3">
            <h2>Super Admin</h2>
            <p>Welcome Back!</p>        
        </div>
    <div class="wrapper">
        <div class="title py-1 d-flex justify-content-between align-items-center">
            <p class="m-0">Manage Session</p>
            <button class="toggleBtn "><i class="fi fi-rr-add me-1" aria-hidden="true"></i> Add new</button>
        </div>     
        <div class="mt-1 list-session table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Session Name</td>
                        <td>Date Created</td>
                        <td>Active</td>
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
                            $count=0;
                            while($row = mysqli_fetch_array($result)){
                                $count++;
                               echo "
                                    <tr>
                                        <td>{$count}</td>
                                        <td>{$row['session_name']}</td>
                                        <td>{$row['session_date']}</td>
                                        <td>{$row['active']}</td>
                                        <td><a onclick='confirmCommand()' href='form_data/deletedata.php?tbl=session&id=$row[id]'><button class='btn btn-danger' ><i class='fa fa-trash' aria-hidden='true'></i></button></a>
                                       
                                        </td>
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
    </div>

        <div class="addSession mt-2">
            <form action="form_data/add_session.php" method="POST">
                <fieldset class="border p-4">
                    <legend>Add New Session</legend>
                    <div class="form-group">
                        <label for="sessionName">Session Name </label>
                        <input type="text" name="session_name" id="sessionName" required>
                        <button class="btn btn-primary border-0" name="addSession">Add</button>
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
