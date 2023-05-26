<?php
switch($vars['action']){

case "studentlist":{
    $students = $db->query('SELECT * FROM student WHERE Supervisor_Id IN (SELECT Supervisor_Id FROM supervisor WHERE School_Id=?);', $_COOKIE["school_id"])->fetchAll();
    include("view/header.php");
    include("view/sidebar.php");
    include("view/student/list.php");
    include("view/footer.php");
    exit;
}break;

case "deletestudent":{
    $id = $_GET['id'];
    $db->query("DELETE FROM student WHERE Student_Id=(?)",$id);
    header("location: index.php?action=studentlist");   
    exit;        
}break;

case "updatestudent":{
    $id = $_GET['id'];
    $Query = "SELECT * FROM student WHERE Student_Id = $id";
    $res = $db->query($Query)->fetchArray();
    $Query2 = "SELECT * FROM supervisor WHERE Supervisor_Id = $res[1]";
    $res2 = $db->query($Query2)->fetchArray();
    include("view/header.php");
    include("view/sidebar.php");
    include("view/student/edit.php");
    include("view/footer.php");
    exit;
}break;

case "addstudent":{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Fname = $_POST['Student_FirstName'];
        $Lname = $_POST['Student_LastName'];
        $Student_Mail = $_POST['Student_Mail'];
        $Student_Birthday = $_POST['Student_Birthday'];
        $Student_Phone_number = $_POST['Student_Phone_number'];
        $Student_address = $_POST['Student_address'];

        $db->query("INSERT INTO student (Student_FirstName, Student_LastName, Student_Mail, Student_Birthday, Student_Phone_number, Student_address) VALUES (?, ?, ?, ?, ?, ?)", $Fname, $Lname, $Student_Mail, $Student_Birthday, $Student_Phone_number, $Student_address);

        header("location: index.php?action=studentlist");
        exit;
    }

    include("view/header.php");
    include("view/sidebar.php");
    include("view/student/add.php");
    include("view/footer.php");
    exit;
}break;
}
