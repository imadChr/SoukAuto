<?php
if (!isset($vars['action'])) {
    $vars['action'] = 'home';
}

switch ($vars['action']) {

    case "signup": {
            include("view/user/signup.php");
            exit;
        }
        break;

    case "do_signup": {
            $ret = user_process_signup($vars);
            if ($ret['status'] == 1) {
                header("location: index.php?action=login");
            } else {
                $_SESSION['error_message'] = $ret['error'];
                header("location: index.php?action=signup&error_message=" . urlencode($ret['error']));
            }
            exit;
        }
        break;

    case "login": {
            include("view/user/login.php");
            exit;
        }
        break;

    case "do_login": {
            $ret = user_process_login($vars);
            if (isset($vars['redirect'])) {
                header("location: index.php?" . $vars['redirect']);
                exit;
            }
            if ($ret['status'] == 1) {
                header("location: index.php?action=home");
            } else {
                $_SESSION['error_message'] = $ret['error'];
                header("location: index.php?action=login&error_message=" . urlencode($ret['error']));
            }
            exit;
        }
        break;

    case "logout": {
            setcookie("app_email", "", -1, "/");
            setcookie("app_pass", "", -1, "/");
            header("location: index.php?action=login");
            exit;
        }
        break;
}
