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
                <nav class='navbar bg-dark navbar-dark'>
                    <div class='container-fluid'>
                        <a class='navbar-brand'><img src='../assets/images/kingsmeadlogo.jpg' alt='' width='50' class='rounded rounded-pill'> School Management System</a>
                        <form class='d-flex' role='search'>
                        <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search'>
                        <button class='btn btn-outline-success' type='submit'>Search</button>
                        </form>
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
                <script src ='../js/main.js'></script>
                <script src ='../js/app.js'></script>
                <script src='https://code.jquery.com/jquery-3.6.1.min.js' integrity='sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=' crossorigin='anonymous'></script>
                <script type='text/javascript' src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
                <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8' crossorigin='anonymous'></script>    
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
                    <a href='../admin/index' id='ms'><li><i class='fi fi-rr-home' aria-hidden='true'></i> My Dashboard</li></a>
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


