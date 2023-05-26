<?php

function user_get_logged_user(){
    global $db,$appuser;
    
    $appuser=0;
    if (isset($_COOKIE['app_email']) and isset($_COOKIE['schoolname']) and isset($_COOKIE['school_id'])  and strlen($_COOKIE['app_email'])>0){		
		$items = $db->query("SELECT * FROM School WHERE (School_Mail) = ? and Password_Manager= ?",$_COOKIE['app_email'], $_COOKIE['app_pass'])->fetchAll();
		if (count($items)>0){
			$appuser=$items[0];	
		}
	}
    return $appuser;
    
}
    
function user_process_login($vars){
    global $db;

	$ret['status']=0;
	$ret['error']='';
	
	$vars['email']=trim(($vars['email']));
	
    if (strlen($ret['error'])==0 and strlen($vars['email'])==0) {
        $ret['error']="You need to provide an email.";
        return $ret;
    }

    if (strlen($ret['error'])==0 and strlen($vars['pass'])==0) {
        $ret['error']="The password should be filled.";
        return $ret;
    }

    if (strlen($ret['error'])>0)return  $ret;
    
    //search for it in the database ?
	$items = $db->query("SELECT * FROM School WHERE (School_Mail) = ? and Password_Manager= ?",$vars['email'], md5($vars['pass']))->fetchAll();
	if (count($items)==0){
	        $ret['error']=LANG_INCORRECT_EMAIL_PASSWORD;
	        return $ret;
	}
	//For the sake of simplicity, log the user directly by setting their cookies..
	setcookie("app_email", $vars['email'], time()+(3600*24),"/");
	setcookie("school_id",$items[0]['School_Id'],time()+(3600*24),"/");
	setcookie("schoolname",$items[0]['School_Name'],time()+(3600*24),"/");
	setcookie("app_pass", md5($vars['pass']), time()+(3600*24),"/");
	
	$ret['status']=1;
	$ret['error']='';
	return $ret;
}

function user_process_signup($vars){
	global $db;
	
	$ret['status']=0;
	$ret['error']='';
	
	$vars['email']=trim(($vars['email']));
	
    if (strlen($ret['error'])==0 and strlen($vars['email'])==0) {
        $ret['error']=LANG_YOU_NEED_TO_PROVIDE_EMAIL;
        return $ret;
    }
    if (strlen($ret['error'])==0 and strlen($vars['name'])==0) {
        $ret['error']="You need to type in your name.";
        return $ret;
    }

    if (strlen($ret['error'])==0 and strlen($vars['pass'])==0) {
        $ret['error']="The password should be filled.";
        return $ret;
    }

    if (strlen($ret['error'])>0)return  $ret;
    //search for it in the database ?
	$items = $db->query("SELECT * FROM School WHERE (School_Mail) = ?",$vars['email'])->fetchAll();
	if (count($items)>0){
	        $ret['error']="There is already an account with this email address";
	        return $ret;
	}
	if($vars['agree-term']==='on'){
		$c = 1 ;
	}
	else {$c=0;}
	//Else, there is no users in the db with the same email
    $db->query("INSERT INTO School (School_Name, School_Mail,Owner_FirstName ,Owner_LastName, Password_Manager ,School_Address , Session_System) VALUES ( ?, ?, ? ,?,?,?,?)", $vars['name'], $vars['email'],$vars['ownerFName'],$vars['ownerLName'], md5($vars['pass']) ,$vars['location'],$c);
				
	//log the user directly by setting their cookies..
	setcookie("app_email", $vars['email'], time()+(3600*24),"/");
	setcookie("app_pass", md5($vars['pass']), time()+(3600*24),"/");
	$ret['status']=1;
	$ret['error']='';
	return $ret;
}

?>
