<?php
switch ($vars['action']) {
    case "admin": {
            $posts = $db->query("SELECT * FROM post inner join users on post.user_id=users.user_id where approved = 0")->fetchAll();
            include "view/admin/admin.php";
            exit;
        }
        break;
    case "approvePost": {
            $post_id = $vars['post_id'];
            $db->query("UPDATE post SET approved = 1 WHERE post_id = ?", $post_id);
            echo 'approved';
            exit;
        }
    case "deletePost": {
            $post_id = $vars['post_id'];
            $db->query("DELETE FROM post WHERE post_id = ?", $post_id);
            echo 'deleted';
            exit;
        }
}
