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
    myHeader('Dashboard | Admin');
    adminsidebar();
    errorDialogue();
?>

<div class="page-content">
    <section class="" style="padding:3%">
        <div class= "jumbotron">
            <h4>Dashboard</h4>
            <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>      
        </div>
        <div class="row">
            <div class="col-md-8 middle_section">
                <div class="row gy-4">
                    <div class="col">
                        <div class="dashboard-card d-flex p-3 bg-success bg-opacity-25 rounded rounded-4 justify-content-around">
                            <div class="d-flex  flex-column justify-content-center align-item-center">
                                <h3 class="mb-0">255</h3>
                                <p class="mb-0">Students</p>   
                            </div>
                            <div class="px-3 my-auto">
                                <i class="fi fi-rr-graduation-cap fs-2"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="dashboard-card d-flex justify-content-around p-3 bg-primary bg-opacity-25 rounded rounded-4">
                            <div class="d-flex flex-column align-item-center justify-content-center ">
                                <h3 class="mb-0">24k</h3>
                                <p class="mb-0">Total Income</p>   
                            </div>
                            <div class="px-3 my-auto">
                                <i class="fi fi-rr-graduation-cap fs-2"></i>
                            </div>
                        </div>
                    </div>                 
                    <div class="col">
                        <div class="dashboard-card d-flex justify-content-around  p-3 bg-warning bg-opacity-25 rounded rounded-4">
                            <div class="d-flex flex-column align-item-center justify-content-center ">
                                <h3 class="mb-0">10k</h3>
                                <p class="mb-0">Expected Revenue</p>   
                            </div>
                            <div class="px-3 my-auto">
                                <i class="fi fi-rr-graduation-cap fs-2"></i>
                            </div>
                        </div>
                    </div>                                      
                </div>
                <div class="py-3">
                    <div class="wrapper rounded-4 border-0 shadow shadow-sm">
                        <div class="wrapper-title py-3 px-4">
                            <h6 class="mb-0">Reports <Span class="fw-light"> / Term</Span> </h6>                         
                        </div>
                        <div class="wrapper-content">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
                <div class="py-3">
                    <div class="wrapper rounded-4 border-0 shadow shadow-sm">
                        <div class="wrapper-title py-3 px-4">
                            <h6 class="mb-0">Recent Payments <Span class="fw-light"> / Monthly</Span> </h6>                         
                        </div>
                        <div class="wrapper-content">
                            <div class="table-responsive w-100">
                                <table class="table table-white">
                                    <thead>
                                        <tr class="w-100">
                                            <td>#</td>
                                            <td>Student Name</td>
                                            <td>Payment Type</td>
                                            <td>Price</td>
                                            <td>Status</td>
                                            <td>Payment Date</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Odugbesan Oluyemi</td>
                                            <td>Tuition</td>
                                            <td>45000</td>
                                            <td class="">completed</td>
                                            <td>12/10/2022</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 right_section">
                <div class="py-2">
                    <div class="wrapper rounded-4 border-0 shadow shadow-sm">
                        <div class="wrapper-title py-3 px-4">
                            <h6 class="mb-0">Payments Traffic <Span class="fw-light"> / Term</Span> </h6>                         
                        </div>
                        <div class="wrapper-content">
                            <div>
                                <div id="traffic-pie-chart" class="py-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <div class="wrapper rounded-4 border-0 shadow shadow-sm">
                        <div class="wrapper-title py-3 px-4">
                            <h6 class="mb-0">Events <Span class="fw-light"> / Term</Span> </h6>                         
                        </div>
                        <div class="wrapper-content">
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <div class="wrapper rounded-4 border-0 shadow shadow-sm">
                        <div class="wrapper-title py-3 px-4">
                            <h6 class="mb-0">News & Updates <Span class="fw-light"> / Term</Span></h6>                         
                        </div>
                        <ul class="wrapper-content p-3">
                            <li class="d-flex flex-row mb-3">
                                <img src="../assets/images/Kingsmeadlogo.jpg" class="pe-2" width="50" height="40" alt="">
                                <div class="news-desc-content">
                                    <p class="mb-0 text-primary ">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                    <small class="text-secondary">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde doloremque ex ea quia distinctio, ad atque vero molestiae eaque, dicta a architecto perferendis quasi, quos aliquid? Rem, earum! Delectus, nulla.
                                    </small><br>
                                    <a href="#" class="">read more <i class="fi fi-rr-menu-dots"></i></a>
                                </div>
                            </li>
                            <li class="d-flex flex-row">
                                <img src="../assets/images/Kingsmeadlogo.jpg" class="pe-2" width="50" height="40" alt="">
                                <div class="news-desc-content">
                                    <p class="mb-0 text-primary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                    <small class="text-secondary">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde doloremque ex ea quia distinctio, ad atque vero molestiae eaque, dicta a architecto perferendis quasi, quos aliquid? Rem, earum! Delectus, nulla.
                                    </small><br>
                                    <a href="#">read more <i class="fi fi-rr-menu-dots"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer></footer>    
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<?php
footer();
?>
