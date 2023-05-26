<?php

switch($vars['action']){

    case "listteacher":{
        $teachers = $db->query('SELECT * FROM teacher WHERE School_Id =?',$_COOKIE['school_id'])->fetchAll();
        include("view/header.php");
        include("view/sidebar.php");
        include("view/teacher/list.php");
        include("view/footer.php");
        exit;
    }break;

    case "updateteacher":{

        $teachertoedit = $db->query('SELECT * FROM teacher WHERE Teacher_Id = $_GET["id"];')->fetchAll();
        include("view/header.php");
        include("view/sidebar.php");
        include("view/teacher/list.php");
        include("view/footer.php");
        exit;
    }break;

    case "deleteteacher":{
        $db->query('DELETE FROM `teacher` WHERE Teacher_Id=?',$_GET['id']);
        header("location: index.php?action=listteacher");   
        
        exit;
    }break;

    case "addteteacher":{
        if (isset($_POST['submit']) == true) {
            $firstname=$_POST['Teacher_FirstName'];
            $lastname=$_POST['Teacher_LastName'];
            $mail=$_POST['Teacher_Mail'];
    
            $db->query("INSERT INTO teacher (Teacher_FirstName, Teacher_LastName, Teacher_Mail) VALUES (?, ?, ?)", $firstname, $lastname, $mail);
    
            header("location: index.php?action=listteacher");
            exit;
        }
    
        include("view/header.php");
        include("view/sidebar.php");
        include("view/teacher/add.php");
        include("view/footer.php");
        exit;
    }


    
}
