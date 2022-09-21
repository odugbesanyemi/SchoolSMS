<?php
    session_start();
    include('../include/dbconnect.php');
    include("../include/components.php");
    errorDialogue();
    $error = [];
    if ($_SESSION['logged_in']==true && $_SESSION['usertype']=="admin") {
        // meaning the user is logged in
    } else {
        // not logged in return user to login page
        header("location:../auth.php");
        array_push($error, "Unauthorised Access!");
        $_SESSION['error'] = $error;
    }
    if (!isset($_GET['classid'])) {
        array_push($error, 'Fatal Error, Contact the Administrator');
        $_SESSION['error']=$error;
        header("location:./");
    }
    myHeader('Admin | Manage class');
    Adminsidebar();


    // get data from the classid get property
    $sql = "SELECT * FROM class WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $paramclassid);
    $paramclassid = $_GET['classid'];
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
    $class_data = [];
    if (mysqli_num_rows($query) == 0) {
        die("No data Found!!");
    } else {
        while ($row = mysqli_fetch_array($query)) {
            array_push($class_data, $row);
        }
    }

    ?>

<div class="page-content">
    <div class="class-dashboard title py-3 d-flex justify-content-between">
        <div class="">
            <h3 class="m-0"><?php echo $class_data[0]['className'] ?>
            </h3>
            <p class="small m-0">Techer: Mrs. Adegbola</p>
        </div>
        <div class="class-details d-flex flex-row align-items-center justify-content-center text-center">
            <div class="px-3 border-end">
                <h5>150</h5>
                <p class="small">Students</p>
            </div>
            <div class="px-3">
                <h5>150</h5>
                <p class="small">subjects</p>
            </div>

        </div>
    </div>
    <section class="row g-0">
        <div class="left-panel col-md-1 d-flex flex-md-column justify-content-start border-end" id="tabPanel">
            <button class="btn p-4 inview" id="class_students">
                <i class="fi fi-br-user-add"></i> <br>
            </button>
            <button class="btn p-4" id="class_subjects">
                <i class="fi fi-rr-books"></i> <br>
            </button>
            <button class="btn p-4" id="class_payments">
                <i class="fi fi-rs-receipt"></i> <br>
            </button>
        </div>
        <div class="right-panel col-md-11" id="panelView">
            <div class="" data-id="class_students">
                <div class="clas-student-head container pb-2 pt-5 px-5">
                    <h4 class="">Students</h4>
                    <p class="text-secondary text-opacity-50">Here, you can view, manage and add students enrolled to
                        this selected class.</p>
                </div>
                <!-- this is where we will view and add students to a class -->
                <div class="container">
                    <ul class="tab d-flex ps-0 mx-3" id="tab">
                        <li class="tab-active" id="overview">Overview</li>
                    </ul>
                    <div id="tabview">
                        <div class="overview" data-id="overview">
                            <div class="container">
                                <div class="wrapper">
                                    <div class="title py-1 d-flex justify-content-between align-items-center">
                                        <p class="m-0"></p>
                                        <button class="toggleBtn" data-bs-toggle="modal"
                                            data-bs-target="#addClassStudent"><i class="fi fi-rr-add me-1"
                                                aria-hidden="true"></i> Add new</button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>S/N</td>
                                                    <td>Name</td>
                                                    <td>Reg No</td>
                                                    <td>gender</td>
                                                    <td>username</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody id="students">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="addClassStudent" data-bs-backdrop="false" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Student</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-4 pt-1 pb-4">
                                        <form id="add_student_class_form">
                                            <span class="messageCenter"></span>
                                            <div class="form-group">
                                                <label for="classId">Choose Class</label>
                                                <Select id="classId" name="classId" class="w-100"></Select>
                                            </div>
                                            <div class="form-group">
                                                <label for="student">Choose Student</label>
                                                <select name="studentId" id="student_modal" class="w-100"></select>
                                            </div>
                                            <button id="addClassStudentBtn" name='submitBtn' class="btn btn-warning"><i
                                                    class="fi fi-rr-add me-1" aria-hidden="true"></i>Add
                                                Student</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="collapse" data-id="class_subjects">
                <div class="clas-student-head container pb-2 pt-5 px-5 ">
                    <h4 class="">Subjects</h4>
                    <p class="text-secondary text-opacity-50">Add Subjects offered by the class</p>
                </div>
                <!-- this is where we will view and add students to a class -->
                <div class="container">
                    <ul class="tab d-flex ps-0 mx-3" id="tab">
                        <li class="tab-active" id="overview">Overview</li>
                    </ul>
                    <div id="tabview">
                        <div class="overview" data-id="overview">
                            <div class="container">
                                <div class="wrapper">
                                    <div class="title py-1 d-flex justify-content-between align-items-center">
                                        <p class="m-0"></p>
                                        <button class="toggleBtn" data-bs-toggle="modal"
                                            data-bs-target="#addClassSubject"><i class="fi fi-rr-add me-1"
                                                aria-hidden="true"></i> Add new</button>
                                    </div>
                                    <div class="">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>S/N</td>
                                                    <td>Subject</td>
                                                    <td>Teacher</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody id="subjects">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="addClassSubject" data-bs-backdrop="false" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Subject</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-4 pt-1 pb-4">
                                        <form id="add_subject_class_form">
                                            <span class="messageCenter"></span>
                                            <div class="form-group">
                                                <label for="classId">Add Subject</label>
                                                <Select id="subjectId" name="subjectId" class="w-100"></Select>
                                            </div>
                                            <div class="form-group">
                                                <label for="student">Choose Teacher</label>
                                                <select name="teacherId" id="teacherId" class="w-100"></select>
                                            </div>
                                            <button id="addSubjectStudentBtn" name='submitBtn'
                                                class="btn btn-warning"><i class="fi fi-rr-add me-1"
                                                    aria-hidden="true"></i>Continue</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="collapse" data-id="class_payments"></div>
        </div>
    </section>

    <footer></footer>
</div>

<script>
// ----------------------------------------------------------------------------
    // fetch the  class from the Fetch API and render result in the modal dialog class select
    let classSelect = document.querySelector('#classId')
    let studentSelect = document.querySelector("#student_modal")
    const queryString = window.location.search
    const urlParams = new URLSearchParams(queryString)
    const classID = urlParams.get('classid')
    fetch('../fetch/getClassStudent.php?getModal')
        .then((response) => (response.json()
            .then((data) => {
                for (const x of data) {
                    let option = document.createElement('option')
                    option.textContent = x.className
                    option.value = x.id
                    classSelect.append(option)
                }
                let options = classSelect.querySelectorAll(':scope option')
                for (const x of options) {
                    if (x.value == classID) {
                        x.selected = true
                    }
                }
                classSelect.disabled = true
            })
        ))
        .catch((error) => (console.log(error)))

// ------------------------------------------------------------------------------ 
        // update All Students Table
    let studentsTable = document.querySelector('#students')
    let updateStudentTable = () => {
        fetch(`../fetch/getClassStudent.php?classStudent&classid=${classID}`)
            .then(response => response.json())
            .then(data => {
                let count = 0
                studentsTable.textContent = ""
                for (const x of data) {
                    count++
                    let tr = document.createElement('tr')
                    tr.innerHTML =
                        `
                            <td>${count}</td>
                            <td>${x['Name']}</td>
                            <td>${x['reg_no']}</td>
                            <td>${x['gender']}</td>
                            <td>${x['username']}</td>
                            <div class='btn-group'>
                                <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    Actions
                                </button>
                                <ul class='dropdown-menu'>
                                    <li><a onclick='' class='dropdown-item' href='../form_data/deletedata?tbl=class&id={$row['id']}'><i class='fi fi-rs-trash me-2'></i>Delete</a></li>
                                </ul>
                            </div>                                
                    `
                    studentsTable.appendChild(tr)
                }
            })
            .catch(error => console.log(error))
    }
    updateStudentTable()
    //-------------------------------------------------------------------------
    // update Subject_Class Table
    let subjectTable = document.querySelector('#subjects')
    let updateSubjectTable = () => {
        fetch(`../fetch/getClassStudent.php?classSubject&classid=${classID}`)
            .then(response => response.json())
            .then(data => {
                let count = 0
                subjectTable.textContent = ""
                for (const x of data) {
                    count++
                    let tr = document.createElement('tr')
                    tr.innerHTML =
                        `
                            <td>${count}</td>
                            <td>${x['title']}</td>
                            <td>${x['name']}</td>
                            <div class='btn-group'>
                                <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    Actions
                                </button>
                                <ul class='dropdown-menu'>
                                    <li><a onclick='' class='dropdown-item' href='../form_data/deletedata?tbl=class&id={$row['id']}'><i class='fi fi-rs-trash me-2'></i>Delete</a></li>
                                </ul>
                            </div>                                
                    `
                    subjectTable.appendChild(tr)
                }
            })
            .catch(error => console.log(error))
    }
    updateSubjectTable()
//------------------------------------------------------------------------------    
    // fetch student Modal data 
    let modalStudent = document.querySelector('#student_modal')
    fetch('../fetch/getClassStudent.php?getAllStudents')
        .then((response) => (response.json()
            .then((data) => {
                for (const x of data) {
                    let option = document.createElement('option')
                    option.textContent = `${x.Name} - ${x.reg_no}`
                    option.value = x.id
                    modalStudent.append(option)
                }
            })
        ))
        .catch(error => console.log(error))
    //------------------------------------------------------------------------- 
    // fetch subjects Modal information
    let subjectList = document.querySelector('#subjectId')
    let teacherList = document.querySelector('#teacherId')
    // subject List
    fetch('../fetch/getClassStudent.php?getSubjects')
        .then((response) => (response.json())
            .then((data) => {
                for (const x of data) {
                    let option = document.createElement('option')
                    option.textContent = `${x.title} `
                    option.value = x.id
                    subjectList.append(option)
                }
            })
        )
        .catch((error) => (console.log(error)))
    //--------------------------------------------------------------------------
    // Teacher List
    fetch('../fetch/getClassStudent.php?getTeachers')
        .then((response) => (response.json())
            .then((data) => {
                for (const x of data) {
                    let option = document.createElement('option')
                    option.textContent = `${x.name} - ${x.email}`
                    option.value = x.id
                    teacherList.append(option)
                }
            })
        )
        .catch((error) => (console.log(error)))
    // -------------------------------------------------------------------------
    // add student to class submit function
    let formElement = document.querySelector('#add_student_class_form')
    let submitBtn = document.querySelector('#addClassStudentBtn')
    let messageCenter = document.querySelector('.messageCenter')
    submitBtn.onclick = (e) => {
        e.preventDefault()
        let formData = new FormData(formElement)
        fetch(`../fetch/getClassStudent.php?addStudent_class&classid=${classID}`, {
            method: 'POST',
            body: formData
        }).then(response => response.text()).then(response => {
            // THIS SHOULD RETURN A SUCCESS MESSAGE
            document.body.insertAdjacentHTML('beforeend', `
                <div class='alert alert-white alert-dismissible fade show position-fixed' role='alert'>
                    <strong>New Notification!</strong> ${response}
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>  
            `),
                updateStudentTable()
        }).catch(error => {
            console.log(error)
        })
    }
    // -------------------------------------------------------------------------
    // Add subject Data 
    let subjectForm = document.querySelector('#add_subject_class_form')
    let subjectSubmit = document.querySelector('#addSubjectStudentBtn')
    subjectSubmit.onclick = (e) => {
        e.preventDefault()
        let formData = new FormData(subjectForm)
        fetch(`../fetch/getClassStudent.php?addSubject_class&classid=${classID}`, {
            method: 'POST',
            body: formData
        }).then(response => response.text()).then(response => {
            // THIS SHOULD RETURN A SUCCESS MESSAGE
            document.body.insertAdjacentHTML('beforeend', `
                <div class='alert alert-white alert-dismissible fade show position-fixed' role='alert'>
                    <strong>New Notification!</strong> ${response}
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>  
            `),
                updateSubjectTable()
        }).catch(error => {
            console.log(error)
        })
    }
    
</script>

<?php
    footer();
