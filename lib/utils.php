<?php

function get_input_vars()
{
    global $_SERVER;
    $REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
    global $_POST;
    global $_GET;
    //set_magic_quotes_runtime (0);

    $vars = $_POST;
    foreach ($vars as $k => $v) {
        if (is_array($v)) continue;
        //if (get_magic_quotes_gpc())
        $v = stripslashes($v);
        $vars[$k] = trim($v);
    }

    $vars2 = $_GET;
    foreach ($vars2 as $k => $v) {
        if (is_array($v)) continue;
        //if (get_magic_quotes_gpc()) 
        $v = stripslashes($v);
        $vars[$k] = trim($v);
    }

    return $vars;
}
function are_valid_pictures($pictures)
{
    if (!is_uploaded_file($pictures["tmp_name"]) || !in_array($pictures["type"], ["image/png", "image/jpeg", "image/jpg"])) {
        return false;
    }
    return true;
}

function move_pictures_to_upload_directory($pictures)
{
    $target_dir = "images/uploads/";
    $images_path = array();
    foreach ($pictures["tmp_name"] as $index => $tmp_name) {
        $target_file = $target_dir . basename($pictures["name"][$index]);
        move_uploaded_file($tmp_name, $target_file);
        $images_path[] = $target_file;
    }
    return $images_path;
}

function parse_mdy_time($str)
{
    if (empty($str)) return 0;
    $d = explode("/", $str);
    if (count($d) != 3) return 0;
    if (is_numeric($d[0]) && is_numeric($d[1]) && is_numeric($d[2]))
        return mktime(0, 0, 0, $d[0], $d[1], $d[2]);
    return 0;
}
