<?php

switch($vars['action']) {

    case "feeslist":{ 
        $fees = $db->query('SELECT * FROM fees WHERE Class_Id IN (SELECT Class_Id FROM class WHERE School_Id=?);', $_COOKIE["school_id"])->fetchAll();
        include("view/header.php");
        include("view/sidebar.php");
        include("view/fees/list.php");
        include("view/footer.php");
        exit;}break;

    case "deletefee":{ 
        $id = $_GET['id'];
        $db->query("DELETE FROM fees WHERE Fees_Id=(?)", $id);
        header("location: index.php?action=feelist");
        exit;}break; 


    
    }
