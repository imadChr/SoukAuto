<?php

switch ($vars['action']) {
    case "home": {
            $sale = $db->query("SELECT * FROM ( post join car on post.car_id = car.car_id ) join images on images.post_id = post.post_id where image_order = 1 and post.approved = 1 and post.type = 'sell' order by post.post_id desc limit 3")->fetchAll();
            $rent = $db->query("SELECT * FROM ( post join car on post.car_id = car.car_id ) join images on images.post_id = post.post_id where image_order = 1 and post.approved = 1 and post.type = 'rent' order by post.post_id desc limit 3")->fetchAll();
            include("view/header.php");
            include("view/home.php");
            include("view/footer.php");
            exit();
        }
        break;
}
