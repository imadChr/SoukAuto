<?php 
switch($vars['action']) {

    case "resourceslist":{ 
        include("view/header.php");
        include("view/sidebar.php");
        include("view/resource/list.php");
        include("view/footer.php");
        }
    }