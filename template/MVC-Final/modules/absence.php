<?php
switch ($vars['action']) {
    case "absencelist":{
            include("view/header.php");
            include("view/sidebar.php");
            include("view/absence/list.php");
            include("view/footer.php");
            exit;
        }

}


