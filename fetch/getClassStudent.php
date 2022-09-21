<?php
    include('../include/dbconnect.php');
    session_start();

if(isset($_GET['getModal'])){
    $sql = "SELECT * FROM class";
    $result = mysqli_query($conn,$sql);
    $classData = [];
    while($row = mysqli_fetch_array($result)){
        array_push($classData,$row);
    }
    echo(json_encode($classData));    
}

    if(isset($_GET['classStudent'])){
            $sql = "SELECT * FROM  class_student 
            INNER JOIN class
            ON classID = class.id
            INNER JOIN student
            ON studentID = student.id
            INNER JOIN session
            ON sessionID = session.id
            WHERE classID = ? AND session.active = 1
            lIMIT 10";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt,"i",$paramClassId);
            $paramClassId = $_GET['classid'];
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $data = [];
            if (mysqli_num_rows($result)>0) {
            // meaning there is active data then display the data
            while ($row = mysqli_fetch_array($result)) {
                array_push($data,$row);
            }
        }
        echo(json_encode($data));
    }
// Update class subject
    if (isset($_GET['classSubject'])) {
        $sql = "SELECT * FROM  class_subject 
            INNER JOIN class
            ON classID = class.id
            INNER JOIN subjects
            ON subjectID = subjects.id
            INNER JOIN teacher
            ON teacherID = teacher.id
            INNER JOIN session
            ON sessionID = session.id
            WHERE classID = ? AND session.active = 1
            lIMIT 10";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $paramClassId);
        $paramClassId = $_GET['classid'];
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        if (mysqli_num_rows($result)>0) {
            // meaning there is active data then display the data
            while ($row = mysqli_fetch_array($result)) {
                array_push($data, $row);
            }
        }
        echo(json_encode($data));
    }
    

    if (isset($_GET['getAllStudents'])) {
        $sql = "SELECT * FROM student";
        $result = mysqli_query($conn, $sql);
        $studentData = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($studentData, $row);
        }
        echo(json_encode($studentData));
    }
// ---------------------------------------------------
// Insert Students to Class
    if(isset($_GET['addStudent_class'])){
        // check if data already exists
        $sql = "SELECT * FROM class_student WHERE studentID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,"i",$paramStudentId);
        $paramStudentId = $_POST['studentId'];    
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result)>0){
            // meaning data already Exists return Error
            echo 'Already Assigned to class';
        }else{
            $sql = "INSERT INTO class_student(classID,studentID,sessionID) VALUES(?,?,?)";
            $stmt = mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($stmt,"iii",$paramClassId,$paramStudentId,$paramSessionId);
            $paramClassId = $_GET['classid'];
            $paramStudentId = $_POST['studentId'];
            $paramSessionId = $_SESSION['activeSession'];
            $result = mysqli_stmt_execute($stmt);
            if($result){
                // meaning the operation was successfull 
                echo 'successful';
            }            
        }
    }
// -----------------------------------------------------
// add Subjects to class

    if (isset($_GET['addSubject_class'])) {
        // check if data already exists
        $sql = "SELECT * FROM class_subject 
        INNER JOIN session 
        ON sessionID = session.id
        INNER JOIN teacher
        ON teacherID = teacher.id
        WHERE subjectID = ? AND teacherID = ? AND session.active = 1 AND classId = ?";
        // meaning data already exists in this particular class as no class can offer thesame subject twice
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iii", $paramSubjectId,$paramTeacherId,$paramClassId);
        $paramSubjectId = $_POST['subjectId'];
        $paramTeacherId = $_POST['teacherId'];
        $paramClassId = $_GET['classid'];        
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result)>0) {
            // meaning data already Exists return Error
            echo 'Subject Cannot be assigned to Same teacher more than once';
        } else {
            $sql = "INSERT INTO class_subject(subjectID,classID,sessionID,teacherID) VALUES(?,?,?,?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iiii",$paramSubjectId,$paramClassId, $paramSessionId, $paramTeacherId);
            $paramSubjectId = $_POST['subjectId'];
            $paramClassId = $_GET['classid'];
            $paramTeacherId = $_POST['teacherId'];
            $paramSessionId = $_SESSION['activeSession'];
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                // meaning the operation was successfull
                echo 'successfully added Subject';
            }
        }
    }

// Get all Subject Data 
    if (isset($_GET['getSubjects'])) {
        $sql = "SELECT * FROM subjects";
        $result = mysqli_query($conn, $sql);
        $subjectData = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($subjectData, $row);
        }
        echo(json_encode($subjectData));
    }

// Get all Teacher Data
    if (isset($_GET['getTeachers'])) {
        $sql = "SELECT * FROM teacher";
        $result = mysqli_query($conn, $sql);
        $teacherData = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($teacherData, $row);
        }
        echo(json_encode($teacherData));
    }
    
// get class student count
    if (isset($_GET['studentCount'])) {
        $sql = "SELECT count(*) AS studentCount FROM class_student WHERE classID =? AND sessionID = ?";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"ii",$paramClassId,$paramSessionId);
        $paramClassId = $_GET['classid'];
        $paramSessionId = $_SESSION['activeSession'];
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $studentCount = [];
        while ($row = mysqli_fetch_array($result)){
            array_push($studentCount, $row);
        }
        echo json_encode($studentCount);
    }
// get class subject count
if (isset($_GET['subjectCount'])) {
    $sql = "SELECT count(*) AS subjectCount FROM class_subject WHERE classID =? AND sessionID = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"ii",$paramClassId, $paramSessionId);
    $paramClassId = $_GET['classid'];
    $paramSessionId = $_SESSION['activeSession'];
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $subjectCount = [];
    while ($row = mysqli_fetch_array($result)){
        array_push($subjectCount, $row);
    }
    echo json_encode($subjectCount);
}
?>