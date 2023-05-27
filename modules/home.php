<?php

switch ($vars['action']) {
    case "home": {
            $posts = $db->query("SELECT * FROM ( post join car on post.car_id = car.car_id ) join images on images.post_id = post.post_id where image_order = 1 order by post.post_id desc limit 3")->fetchAll();
            include("view/header.php");
            include("view/home.php");
            include("view/footer.php");
            exit();
        }
        break;
}
