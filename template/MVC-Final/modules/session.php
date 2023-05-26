<?php

switch($vars['action']){

    
    case "addsession":{
        $sessions =  $db->query('SELECT * FROM session_ Where Class_Id=$class_id =? ',$_GET['id'])->fetchAll();

        include("view/header.php");
        include("view/sidebar.php");
        include("view/class/addsession.php");  
        include("view/footer.php"); 
        exit;
    }break;
    
}
