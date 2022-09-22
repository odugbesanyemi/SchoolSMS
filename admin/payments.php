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
    myHeader('Admin | Manage Payments');
    Adminsidebar();
    errorDialogue();
?>

<div class="page-content">
    <section class="container" style="padding:5%">
        <div class="wrapper">
            <div class="title py-1 d-flex justify-content-between align-items-center">
                <p class="m-0">Manage Payments</p>
                <button class="toggleBtn" data-bs-toggle="modal" data-bs-target="#addpayment"><i class="fi fi-rr-add me-1" aria-hidden="true"></i> Add new</button>
            </div>     
            <div class="mt-1 list-sessiontable-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>S/N</td>
                            <td>Payment Type</td>                       
                            <td>Description</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM  payment lIMIT 10";
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
                                            <td>{$row['type']}</td>
                                            <td>{$row['description']}</td>
                                            <td>
                                                <div class='btn-group'>
                                                    <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                        Actions
                                                    </button>
                                                    <ul class='dropdown-menu'>
                                                        <li><a onclick='' class='dropdown-item' href='../form_data/deletedata?tbl=payment&id={$row['id']}'><i class='fi fi-rs-trash me-2'></i>Delete</a></li>
                                                        <li><a onclick='' class='dropdown-item' href='../form_data/updatedata?tbl=payment&id=$row[id]'><i class='fi fi-rr-pencil me-2'></i>edit</a></li>                                         
                                                        <li><a onclick='' class='dropdown-item' href='classinfo?classid=$row[id]'><i class='fi fi-rs-eye me-2'></i>view</a></li>                                         
                                                    </ul>
                                                </div>                                             
                                            </td>
                                        </tr>
                                ";
                                };
                            }else{
                                // no data in the data base
                                echo "Add new Payments";
                            }
                        ?>                    
                    </tbody>

                </table>
            </div>
        </div>
        <div class="modal fade" id="addpayment" data-bs-backdrop="false" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 pt-1 pb-4">
                        <form action="../form_data/add_payments.php" method="POST">
                            <fieldset class=" p-2">
                                <div class="form-group me-md-3 mb-3">
                                    <label for="type">Payment Type</label>
                                    <input type="text" name="payment_type" id="type" required class="w-100" placeholder="i.e Tuition, Transportation">
                                </div>   
                                <div class="form-group me-md-3 mb-3">
                                    <label for="desc">Payment Description</label>
                                    <textarea name="payment_desc" id="desc" cols="30" rows="3" required class="w-100" placeholder="...Usually Paid every Term."></textarea>
                                </div>                                                          
                                <div class="btn-group">
                                    <button class="btn btn-outline-primary" name="addPayment" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Submit</button>
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
