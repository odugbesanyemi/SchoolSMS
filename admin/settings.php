<?php
    session_start();
    include("../include/components.php");
    errorDialogue();
    $error = [];
    if ($_SESSION['logged_in']==true && $_SESSION['usertype']=="admin") {
        // meaning the user is logged in
    } else {
        // not logged in return user to login page
        header("location:../auth");
        array_push($error, "Unauthorised Access!");
        $_SESSION['error'] = $error;
    }
    include('../include/dbconnect.php');

    myHeader('Admin | Manage class');
    Adminsidebar();
?>
<div class="page-content">
    <div class="" data-id="class_settings">
        <div class="clas-student-head container pb-2 pt-5 px-5">
            <h4 class="mb-3">Settings</h4>
            <p class="text-secondary text-opacity-50">Here, you can configure the data displayed. change Session and term displayed.</p>
        </div>
        <!-- this is where we will view and add students to a class -->
        <div class="container px-5">
            <div class="wrapper">
                <div class="d-flex align-items-center">
                    <p class="text-mute m-0 w-75">Change Session</p>
                    <select class="form-select w-25" id="sessionSelect" aria-label="Default select example">
                    </select>                              
                </div>
                <div class="d-flex align-items-center">
                    <p class="text-mute m-0 w-75">Choose Term</p>
                    <select class="form-select w-25" id="termSelect" aria-label="Default select example">
                    </select>                        
                </div>                                          
            </div>
        </div>                
    </div>      
</div>
<script>
    // lets use the fetch API to get the data for the session
    let sessionArray=[]
    let mySession = document.querySelector('#sessionSelect')
    let term = document.querySelector('#termSelect')
    fetch("../fetch/getVariable.php?select",{
        method:"POST",
    })
    .then((response)=>{response.json().then((data)=>{
        for(x of data){
            let option = document.createElement('option')
            option.id = x.id
            option.textContent = x.session_name
            mySession.append(option)
        }
    })})
    .catch((error)=>{ 
        console.log(`this is the ${error}`)
    })

    term.onchange = (e)=>{
        e.preventDefault()
        fetch(`../fetch/getVariable.php?sessionId=${}`,{
            method:'POST'
        }).then(response => response.json()
        .then(term=>{
            console.log(term)
        })
        )
        .catch(error=>console.log(error))
    }


</script>