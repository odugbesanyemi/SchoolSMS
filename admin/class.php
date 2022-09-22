<?php
    session_start();
    include ("../include/components.php");    
    errorDialogue();    
    $error = [];
    if($_SESSION['logged_in']==true && $_SESSION['usertype']=="admin"){
        // meaning the user is logged in
        
    }else{
        // not logged in return user to login page
        header("location:../auth");
        array_push($error,"Unauthorised Access!");
        $_SESSION['error'] = $error;
    }
    include('../include/dbconnect.php');

    myHeader('Admin | Manage class');
    Adminsidebar();

?>

<div class="page-content">
    <section class="container" style="padding:5%">
        <div class="wrapper">
            <div class="title py-1 d-flex justify-content-between align-items-center">
                <p class="m-0">Manage Classes</p>
                <button class="toggleBtn" data-bs-toggle="modal" data-bs-target="#addclass"><i class="fi fi-rr-add me-1" aria-hidden="true"></i> Add new</button>
            </div>
            <div class="table-responsive">        
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <td>S/N</td>
                            <td>Class Name</td>
                            <td>Roll No</td>                        
                            <td>Date Created</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM  class lIMIT 10";
                            $stmt = mysqli_prepare($conn,$sql);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            if(mysqli_num_rows($result)>0){
                                // meaning there is active data then display the data
                                $count=0;
                                while($row = mysqli_fetch_array($result)){
                                    $count++;
                                echo "
                                        <a href='classinfo?id={$row['id']}'>
                                        <tr>
                                            <td>{$count}</td>
                                            <td>{$row['className']}</td>
                                            <td>{$row['roll_no']}</td>
                                            <td>{$row['dateCreated']}</td>
                                            <td>
                                                    <div class='btn-group'>
                                                        <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                            Actions
                                                        </button>
                                                        <ul class='dropdown-menu'>
                                                            <li><a onclick='' class='dropdown-item' href='../form_data/deletedata?tbl=class&id={$row['id']}'><i class='fi fi-rs-trash me-2'></i>Delete</a></li>
                                                            <li><a onclick='' class='dropdown-item' href='../form_data/updatedata?tbl=class&id=$row[id]'><i class='fi fi-rr-pencil me-2'></i>edit</a></li>                                         
                                                            <li><a onclick='' class='dropdown-item' href='classinfo?classid=$row[id]'><i class='fi fi-rs-eye me-2'></i>view</a></li>                                         
                                                        </ul>
                                                    </div>                                            
                                            </td>
                                        </tr>
                                        </a>
                                ";
                                };
                            }else{
                                // no data in the data base
                                echo "Add a new Class";
                            }
                        ?>                    
                    </tbody>
                </table>
            </div>       
        </div>
        <div class="modal fade" id="addclass" data-bs-backdrop="false" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Class</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 pt-1 pb-4">
                        <form action="../form_data/add_class" method="POST">
                            <fieldset class="p-2">
                                <div class="form-group me-md-3 mb-3">
                                    <label for="name">Class Name</label>
                                    <input type="text" name="class_name" class="w-100" id="name" required >
                                </div>   
                                <div class="form-group me-md-3 mb-3">
                                    <label for="roll_no">Roll_no</label>
                                    <input type="number" name="roll_no" id="roll_no" required class="w-100" >
                                </div>                       
                                <div class="btn-group">
                                    <button class="btn btn-outline-primary" name="addClass" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Submit</button>
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
