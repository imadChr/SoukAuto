<?php

switch($vars['action']){
    case "main":{
        //errors !!!
       $studentscount = $db->query('SELECT COUNT(*) AS total_instances FROM student WHERE Supervisor_Id IN (SELECT Supervisor_Id FROM supervisor WHERE School_Id=?) ORDER BY Student_Id DESC LIMIT 15', $_COOKIE["school_id"])->fetchAll();
       $teacherscount = $db->query('SELECT COUNT(*) AS total_instances FROM teacher WHERE School_Id =?',$_COOKIE['school_id'])->fetchAll();
       $classescount = $db->query('SELECT COUNT(*) AS total_instances FROM class WHERE School_Id =?',$_COOKIE['school_id'])->fetchAll();
       $modulescount = $db->query('SELECT COUNT(*) AS total_instances FROM module WHERE School_Id =?',$_COOKIE['school_id'])->fetchAll();
        $recentstudents = $db->query('SELECT * FROM student  WHERE Supervisor_Id IN (SELECT Supervisor_Id FROM supervisor WHERE School_Id=?) ORDER BY Student_Id DESC LIMIT 15', $_COOKIE["school_id"])->fetchAll();
        $allteachers = $db->query('SELECT * FROM teacher WHERE School_Id =? ', $_COOKIE["school_id"])->fetchAll();

        include("view/header.php");
        include("view/sidebar.php");
        include("view/main.php");
        include("view/footer.php");
        exit;
    }break;

    
}
