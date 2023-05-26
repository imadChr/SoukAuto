<?php

function user_get_logged_user()
{
	global $db, $appuser;

	$appuser = 0;
	if (isset($_COOKIE['app_email']) and isset($_COOKIE['firstname']) and isset($_COOKIE['user_id'])  and strlen($_COOKIE['app_email']) > 0) {
		$items = $db->query("SELECT * from users where email = ?", $_COOKIE['app_email'])->fetchAll();
		if (count($items) > 0) {
			$appuser = $items[0];
		}
	}
	return $appuser;
}

function user_process_login($vars)
{
	global $db;

	$ret['status'] = 0;
	$ret['error'] = '';

	$vars['email'] = trim(($vars['email']));

	if (strlen($ret['error']) == 0 and strlen($vars['email']) == 0) {
		$ret['error'] = "You need to provide an email.";
		return $ret;
	}

	if (strlen($ret['error']) == 0 and strlen($vars['password']) == 0) {
		$ret['error'] = "The password should be filled.";
		return $ret;
	}

	if (strlen($ret['error']) > 0) return  $ret;

	//search for it in the database ?
	$items = $db->query("SELECT * from users where email = ?", $vars['email'])->fetchAll();
	if (count($items) == 0) {
		$ret['error'] = "Wrong email or password.";
		return $ret;
	} else {
		if (!password_verify($vars['password'], $items[0]['password'])) {
			$ret['error'] = "Wrong email or password.";
			return $ret;
		}
	}

	setcookie("app_email", $vars['email'], time() + (3600 * 24), "/");
	setcookie("user_id", $items[0]['user_id'], time() + (3600 * 24), "/");
	setcookie("firstname", $items[0]['firstname'], time() + (3600 * 24), "/");
	setcookie("app_pass", password_hash($vars['password'], PASSWORD_DEFAULT), time() + (3600 * 24), "/");

	$ret['status'] = 1;
	$ret['error'] = '';
	return $ret;
}

function user_process_signup($vars)
{
	global $db;

	$ret['status'] = 0;
	$ret['error'] = '';

	$vars['email'] = trim(($vars['email']));

	if (empty($vars['firstname'])) {
		$ret['error'] = "Please enter your first name.";
		return $ret;
	} else if (!preg_match('/^([a-zA-Z]+ ?){1,3}$/', $vars['firstname'])) {
		$ret['error'] = "Please enter a valid first name using only letters.";
		return $ret;
	}

	if (empty($vars['lastname'])) {
		$ret['error'] = "Please enter your last name.";
		return $ret;
	} else if (!preg_match('/^[a-zA-Z]+$/', $vars['lastname'])) {
		$ret['error'] = "Please enter a valid last name using only letters.";
		return $ret;
	}

	if (empty($vars['email'])) {
		$ret['error'] = "Please enter your email address.";
		return $ret;
	} else if (!filter_var($vars['email'], FILTER_VALIDATE_EMAIL)) {
		$ret['error'] = "Please enter a valid email address.";
		return $ret;
	}

	if (empty($vars['password'])) {
		$ret['error'] = "Please enter a password.";
		return $ret;
	} else if (strlen($vars['password']) < 8) {
		$ret['error'] = "Password must be at least 8 characters long.";
		return $ret;
	}

	if (empty($vars['phonenumber'])) {
		$ret['error'] = "Please enter your phone number.";
		return $ret;
	} else if (!preg_match('/^\d+$/', $vars['phonenumber'])) {
		$ret['error'] = "Please enter a valid phone number using only digits.";
		return $ret;
	}

	if (strlen($ret['error']) > 0) {
		return $ret;
	}

	//search if user already exists
	$items = $db->query("SELECT * FROM users WHERE email = ?", $vars['email'])->fetchAll();
	if (count($items) > 0) {
		$ret['error'] = "There is already an account with this email address";
		return $ret;
	}
	//Else, there is no users in the db with the same email
	$vars['password'] = password_hash($vars['password'], PASSWORD_DEFAULT);
	$db->query(" INSERT INTO users (firstname, lastname, email, password, phonenumber , wilaya) VALUES (?, ?, ?, ?, ?, ?)", $vars['firstname'], $vars['lastname'], $vars['email'], $vars['password'], $vars['phonenumber'], $vars['wilaya']);

	//log the user directly by setting their cookies..
	setcookie("app_email", $vars['email'], time() + (3600 * 24), "/");
	setcookie("app_pass", $vars['password'], time() + (3600 * 24), "/");
	$ret['status'] = 1;
	$ret['error'] = '';
	return $ret;
}
