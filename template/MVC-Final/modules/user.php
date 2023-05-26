<?php

switch($vars['action']){
    
    case "signup":{
        include("view/headerlog.php");
        include("view/user/signup.php");
        exit;
    }break;
    
    case "do_signup":{
         $ret=user_process_signup($vars);
         
         if ($ret['status']==1){
            header("location: index.php?action=login"); 
         }else{
            header("location: index.php?action=signup&error_message=".urlencode($ret['error']));
         }
         exit;
    }break;
    
    case "login":{
        include("view/headerlog.php");
        include("view/user/login.php");
        exit;
    }break;    

    case "do_login":{
        print_r($vars);
         $ret=user_process_login($vars);
        print_r($ret); 
         if ($ret['status']==1){
            header("location: index.php?action=main"); 
         }else{
            header("location: index.php?action=login&error_message=".urlencode($ret['error']));
         }
         
         exit;        
    }break;    
    
    case "logout":{
	    setcookie("app_email", "" , -1,"/");
	    setcookie("app_pass", "", -1,"/");        
	    header("location: index.php?action=login"); 
	    exit;
    }break;    
    
}
?>