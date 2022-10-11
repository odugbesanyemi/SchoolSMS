<?php 
// Header function
    function myHeader($title){
        echo(" 
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'> 
                <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>                               
                <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>                
                <link rel='stylesheet' href='../style/main.css'>
                <link href='https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css' rel='stylesheet'>
                <link href = 'https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css' rel= 'stylesheet'>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
                <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>    
                <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
                <title>{$title}</title>
            </head>
            <body class=''>
                <nav class='navbar bg-white navbar-white'>
                    <div class='container-fluid'>
                        <div class='d-flex flex-row justify-content-between align-items-center w-100'>
                            <div>
                                <a class='navbar-brand d-flex align-items-center'><img src='../assets/images/kingsmeadlogo.jpg' alt='' width='50'><span class='d-none d-md-block mb-0'> KINGSMEAD</span></a>
                            </div>
                            <div class='d-flex flex-row align-items-center justify-content-center w-100'>
                                <div class='nav-toggle px-4'>
                                    <i class='fi fi-rr-menu-burger fs-4'></i>                                
                                </div>
                                <form class='d-flex' role='search'>
                                    <input class='form-control me-2 rounded-1' type='search' placeholder='Search' aria-label='Search'>
                                </form>   
                            </div>
                            <div class='user-info d-flex flex-row align-items-center w-100'>
                                <div class='notification position-relative ms-auto mx-4'>
                                    <div data-bs-toggle = 'dropdown'>
                                        <i class='fi fi-rr-bell fs-4'></i>
                                        <p class='position-absolute bg-warning rounded rounded-circle mb-0 text-white px-1 top-0 start-100 translate-middle'><small>23</small></p>
                                    </div>
                                    <ul class='dropdown-menu'>
                                        <li class =''></li>
                                    </ul>                                    
                                </div>
                                <div class='message position-relative' role='button'>
                                    <div class='' data-bs-toggle ='dropdown'>
                                        <i class='fi fi-rr-comment-alt fs-4'></i>
                                        <p class='position-absolute bg-primary rounded rounded-circle mb-0 text-white px-1 top-0 start-100 translate-middle'><small>23</small></p>
                                    </div>
                                    <ul class='dropdown-menu'>
                                        <li class ='d-flex flex-row align-items-center'>
                                            <img src='../assets/images/kingsmeadlogo.jpg' alt='' class='me-2 rounded rounded-circle' width='30' height = '30'>
                                            <p class = 'text-secondary'>lorem ipsum dolor liter</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class='user-data btn-group'>
                                    <img src='../admin/img/krunal-mistry-becBmRX__C4-unsplash.jpg' alt='' role='button' data-bs-toggle='dropdown' class='userprofile rounded-circle mx-4 border' width='50' height='50' >
                                    <ul class='dropdown-menu'>
                                        <li class ='disabled fs-6'>Odugbesan Oluyemi Olalekan</li>
                                        <li> <i class='fi fi-rr-user pe-2'></i> profile</li>
                                        <li><i class='fi fi-rr-interrogation pe-2'></i> Need help?</li>
                                        <li><i class='fi fi-rr-sign-out-alt pe-2'></i>Logout</li>
                                    </ul>
                                </div>
                            </div>                     
                        </div>
                    </div>
                </nav> 
                <section class='content-wrapper d-flex flex-column flex-md-row'>         
        "           
        );
    }
// footer function
    function footer(){
        echo "
            </section>
            </body>
                <script src='https://code.jquery.com/jquery-3.6.1.min.js' integrity='sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=' crossorigin='anonymous'></script>
                <script src='https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js' integrity='sha256-+8RZJua0aEWg+QVVKg4LEzEEm/8RFez5Tb4JBNiV5xA=' crossorigin='anonymous'></script>
                <script src='https://fastly.jsdelivr.net/npm/echarts@5.4.0/dist/echarts.min.js'></script>
                <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>                
                <script type='text/javascript' src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
                <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8' crossorigin='anonymous'></script>    
                <script src ='../js/main.js'></script>
                <script src ='../js/app.js'></script>            
            </html>
        ";
    }
// sidebar function

    function sidebar(){
        echo"
            <aside class='sidebar'>
                <ul class=''>
                    <a href='../root/dashboard' id='ms'><li><i class='fa fa-dashboard' aria-hidden='true'></i> My Dashboard</li></a>
                    <a href='../root/manageSession' id='ms'><li><i class='fa fa-wrench' aria-hidden='true'></i> Manage Session</li></a>
                    <a href='../root/manageAdmin' id=''><li><i class='fa fa-user' aria-hidden='true'></i> Manage Admin</li></a>
                    <a href='../root/settings_sadmin' id='s'><li><i class='fa fa-gear' aria-hidden='true'></i> Settings</li></a>
                    <a href='../form_data/logout'><li><i class='fa fa-sign-out' aria-hidden='true'></i> Logout</li></a>
                </ul>
                <div class='sidebar-footer'></div>
            </aside>
        ";
    }

// adminsidebar function
    function adminsidebar(){
        echo"
            <aside class='sidebar'>
                <ul class=''>
                    <a href='../admin/index' id='ms'><li><i class='fi fi-rr-home' aria-hidden='true'></i> Dashboard</li></a>
                    <a href='../admin/class' id='ms'><li><i class='fi fi-rs-presentation' aria-hidden='true'></i>Class</li></a>
                    <a href='../admin/teachers' id=''><li><i class='fi fi-rr-id-badge' aria-hidden='true'></i> Teachers</li></a>
                    <a href='../admin/students' id='s'><li><i class='fi fi-rr-graduation-cap' aria-hidden='true'></i> Students</li></a>
                    <a href='../admin/Subjects'><li><i class='fi fi-rr-books' aria-hidden='true'></i>Subjects</li></a>
                    <a href='../admin/manageTerms'><li><i class='fi fi-rr-business-time' aria-hidden='true'></i>Manage Term</li></a>
                    <a href='../admin/payments'><li><i class='fi fi-rr-receipt' aria-hidden='true'></i>Payments</li></a>
                    <a href='../admin/Finance'><li><i class='fi fi-rr-money-check' aria-hidden='true'></i>Finance</li></a>
                    <a href='../admin/parents'><li><i class='fi fi-rr-briefcase' aria-hidden='true'></i>Parents</li></a>
                    <a href='../admin/adminMessages'><li><i class='fi fi-rs-paper-plane' aria-hidden='true'></i> Messages</li></a>
                    <a href='../admin/staff_Management'><li><i class='fi fi-rr-briefcase' aria-hidden='true'></i> Staff</li></a>
                    <a href='../admin/events'><li><i class='fi fi-rs-calendar-check' aria-hidden='true'></i> Manage Events</li></a>
                    <a href='../admin/settings'><li><i class='fi fi-rr-settings'></i>Settings</li></a>
                    <a href='../form_data/logout'><li><i class='fi fi-rs-sign-out-alt' aria-hidden='true'></i> Logout</li></a>
                </ul>
                <div class='sidebar-footer'></div>
            </aside>
        "; 
    } 
//---------------------------------------------------------------------------------------------------------
    $error = [];
    $message = [];

// this function will return data in an array from the table requested
    function getTable($table, $conn){
        $sql = "SELECT * FROM  $table ";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }
// this function would check for the global session variable to see if message is empty or error is empty then return an error dialogue
    function errorDialogue(){
        if (isset($_SESSION['error'])&& $_SESSION['error']!==""){
            // meaning there is an error then print the error out
            $error = $_SESSION['error'];
            for ($i=0; $i < count($error) ; $i++) { 
                echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Error!</strong> $error[$i]
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>            
                ";

            }
            $_SESSION['error']="";
        }
        if(isset($_SESSION['message'])&& $_SESSION['message']!==""){
            // meaning there is a message available
            $message = $_SESSION['message'];
            for ($i=0; $i < count($message) ; $i++) { 
                echo "
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Success!</strong> $message[$i]
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>            
                ";

            }
            $_SESSION['message']="";        
        }
    }

?>


