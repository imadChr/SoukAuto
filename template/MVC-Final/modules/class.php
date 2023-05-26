<?php

switch ($vars['action']) {

    case "classlist": {
            $classes = $db->query('SELECT * FROM class AS class JOIN teacher ON class.Teacher_Id = teacher.Teacher_Id JOIN module ON class.Module_Id = module.Module_Id')->fetchAll();

            include("view/header.php");
            include("view/sidebar.php");
            include("view/class/list.php");
            include("view/footer.php");
            exit;
        }
        break;


    case "deleteclass": {
            $db->query('DELETE FROM `class` WHERE Class_Id=?', $_GET['id']);
            header("location: index.php?action=classlist");


            exit;
        }
        break;
    case "addclass": {
            $modules =  $db->query('SELECT * FROM module WHERE School_Id=?', $_COOKIE["school_id"])->fetchAll();
            $teachers = $db->query('SELECT * FROM teacher WHERE School_Id =?', $_COOKIE['school_id'])->fetchAll();
            include("view/header.php");
            include("view/sidebar.php");
            include("view/class/add.php");
            include("view/footer.php");
            exit;
        }
        break;

    case "updateclass": {
            $classtoedit = $db->query('SELECT * FROM class WHERE Class_Id=?', $_GET["id"])->fetchArray();
            include("view/header.php");
            include("view/sidebar.php");
            include("view/class/edit.php");
            include("view/footer.php");

            exit;
        }
        break;

    case "doupdateclass": {
            $className = $_POST["className"];
            $idclass = $_POST['id'];
            $price = $_POST["Price"];
            $start = $_POST["startDate"];
            $end =  $_POST["endDate"];
            $numsessions = $_POST["numSessions"];
            $capacity =  $_POST["Capacity"];
            $rq = $db->query('UPDATE class SET class_name = ?, Class_Price = ? ,Starting_Date = ?, Finishing_Date = ?, Class_Capacity = ?, Number_Of_Sections = ? WHERE Class_Id = ?', $className, $price, $start, $end, $capacity, $numsessions, $idclass);
            header("location: index.php?action=classlist");

            exit;
        }
        break;

    case "doaddclass": {

            $className = $_POST["className"];
            $module = $_POST["moduleName"];
            $price = $_POST["Price"];
            $teacher = $_POST["teacherName"];
            $start = $_POST["startDate"];
            $end =  $_POST["endDate"];
            $numsessions = $_POST["numSessions"];
            $capacity =  $_POST["Capacity"];
            $db->query("INSERT INTO `class` (`Class_Id`, `Class_Price`, `Module_Id`, `School_Id`, `Teacher_Id`, `Starting_Date`, `Finishing_Date`, `Class_Capacity`, `Number_Of_Sections`, `class_name`) VALUES (?,?,?,?,?,?,?,?,?,?)", 'NULL', $price, $module, $_COOKIE['school_id'], $teacher, $start, $end, $capacity, $numsessions, $className);
            header("location: index.php?action=classlist");

            exit;
        }
        break;

    case "addstudenttoclass": {
            $students = $db->query('SELECT * FROM student WHERE Supervisor_Id IN (SELECT Supervisor_Id FROM supervisor WHERE School_Id=?);', $_COOKIE["school_id"])->fetchAll();
            include("view/header.php");
            include("view/sidebar.php");
            include("view/class/addstudenttoclass.php");
            include("view/footer.php");


            exit;
        }
        break;

    case "doaddstudenttoclass": {

            $selectedClasses = $_POST['selectedClasses'];
            foreach ($selectedClasses as $class) {
                $qr = $db->query('INSERT INTO `study`(`Class_Id`, `Student_Id`, `Student_Starting_Date`, `Student_Absence`) VALUES (?,?,?,?)', $_POST['classid'], $class, date("Y-m-d"), 0);
            }
            header("location: index.php?action=classlist");

            exit;
        }
        break;

    case "showclassstudents": {
            $classstudents =  $db->query('SELECT * FROM student AS student JOIN study ON student.student_Id = study.Student_Id WHERE study.Class_Id =? ', $_GET['id'])->fetchAll();
            $idclass = $_GET['id'];
            include("view/header.php");
            include("view/sidebar.php");
            include("view/class/showclassstudents.php");
            include("view/footer.php");
            exit;
        }
        break;

    case "deletestudentfromclass": {
            $db->query('DELETE FROM study WHERE Class_Id=? AND Student_Id=?', $_GET['cid'], $_GET['id']);
            $db->query('DELETE FROM absence WHERE Student_Id =?', $_GET['id']);
            header("location: index.php?action=classlist");
            exit;
        }
        break;
}
