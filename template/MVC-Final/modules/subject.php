<?php

switch($vars['action']){

    case "subjectlist":{
        $subjects = $db->query('SELECT * FROM module WHERE School_Id=?', $_COOKIE["school_id"])->fetchAll();
        include("view/header.php");
        include("view/sidebar.php");
        include("view/subject/list.php");
        include("view/footer.php");
        exit;
    }break;
    case "deletesubject":{
        $db->query('DELETE FROM `module` WHERE Module_Id=?',$_GET['id']);
        header("location: index.php?action=subjectlist");   
        
        
        exit;
    }break;

   


    
}
