<?php

switch ($vars['action']) {
    case "list": {
            $posts_per_page = 6;
            $current_page = isset($vars['page']) ? $vars['page'] : 1;
            $offset = ($current_page - 1) * $posts_per_page;
            $brands = $db->query("SELECT * FROM brand ORDER BY brand")->fetchAll();
            switch ($vars['see']) {
                default: {
                        $query = "SELECT * FROM ( post inner join car on post.car_id = car.car_id ) inner join images on images.post_id = post.post_id where image_order = 1 ORDER BY date desc";
                        $posts = $db->query($query)->fetchAll();
                        $total_pages = ceil(count($posts) / $posts_per_page);
                        $query .= " LIMIT ?, ?";
                        $posts = $db->query($query, $offset, $posts_per_page)->fetchAll();
                        include("view/header2.php");
                        include("view/post/market.php");
                        include("view/footer.php");
                        exit();
                    }
                    break;
                case ("search"): {
                        $keyword = "%" . $vars["keyword"] . "%";
                        $brand_id = $vars["brand_id"];
                        $wilaya = $vars["wilaya"];
                        $country_id = $vars["country_id"];
                        $priceMin = $vars["priceMin"];
                        $priceMax = $vars["priceMax"];
                        $mileageMin = $vars["mileageMin"];
                        $mileageMax = $vars["mileageMax"];
                        $yearMin = $vars["yearMin"];
                        $yearMax = $vars["yearMax"];

                        $search_query = "SELECT p.*, c.*, i.*
                        FROM post p 
                        INNER JOIN car c ON p.car_id = c.car_id 
                        INNER JOIN images i ON i.post_id = p.post_id 
                        INNER JOIN brand b ON b.brand_id = c.brand_id 
                        INNER JOIN model m ON m.model_id = c.model_id 
                        WHERE i.image_order = 1
                        AND (p.title LIKE ? OR p.description LIKE ? OR b.brand LIKE ? OR m.model_name LIKE ? or ? = '')
                        AND (c.brand_id = ? OR ? = '')
                        AND (p.wilaya = ? OR ? = '')
                        AND (b.Country = ? OR ? = '')
                        AND ((p.price >= ? AND p.price <= ?) OR (? = '' AND ? = ''))
                        AND ((c.mileage >= ? AND c.mileage <= ?) OR (? = '' OR ? = ''))
                        AND ((YEAR(c.year) >= ? AND YEAR(c.year) <= ?) OR (? = '' OR ? = ''))
                        ORDER BY p.date DESC";

                        $total_posts = $db->query(
                            $search_query,
                            $keyword,
                            $keyword,
                            $keyword,
                            $keyword,
                            $keyword,
                            $brand_id,
                            $brand_id,
                            $wilaya,
                            $wilaya,
                            $country_id,
                            $country_id,
                            $priceMin,
                            $priceMax,
                            $priceMin,
                            $priceMax,
                            $mileageMin,
                            $mileageMax,
                            $mileageMin,
                            $mileageMax,
                            $yearMin,
                            $yearMax,
                            $yearMin,
                            $yearMax
                        )->fetchAll();
                        $total_pages = count($total_posts) / $posts_per_page;
                        $search_query .= " LIMIT ?, ?";
                        $posts = $db->query($search_query, $keyword, $keyword,  $keyword, $keyword, $keyword, $brand_id, $brand_id, $wilaya, $wilaya, $country_id, $country_id, $priceMin, $priceMax, $priceMin, $priceMax, $mileageMin, $mileageMax, $mileageMin, $mileageMax, $yearMin, $yearMax, $yearMin, $yearMax, $offset, $posts_per_page)->fetchAll();
                        include("view/header2.php");
                        include("view/post/market.php");
                        include("view/footer.php");
                        exit();
                    }
                    break;
                case ("myposts"): {
                        $query = "SELECT * FROM ( post inner join car on post.car_id = car.car_id ) inner join images on images.post_id = post.post_id where image_order = 1 and post.user_id = ? ORDER BY date desc";
                        $posts = $db->query($query, $appuser['user_id'])->fetchAll();
                        $total_pages = ceil(count($posts) / $posts_per_page);
                        $query .= " LIMIT ?, ?";
                        $posts = $db->query($query, $appuser['user_id'], $offset, $posts_per_page)->fetchAll();
                        include("view/header2.php");
                        include("view/post/market.php");
                        include("view/footer.php");
                        exit();
                    }
                    break;

                case ("favourites"): {
                        $query = "SELECT * FROM ( post inner join car on post.car_id = car.car_id ) inner join images on images.post_id = post.post_id where image_order = 1 and post.post_id in (select post_id from favourite where user_id = ?) ORDER BY date desc";
                        $posts = $db->query($query, $appuser['user_id'])->fetchAll();
                        $total_pages = ceil(count($posts) / $posts_per_page);
                        $query .= " LIMIT ?, ?";
                        $posts = $db->query($query, $appuser['user_id'], $offset, $posts_per_page)->fetchAll();
                        include("view/header2.php");
                        include("view/post/market.php");
                        include("view/footer.php");
                        exit();
                    }
                    break;
            }
        }
        break;
    case "sell": {
            $brands = $db->query("SELECT * FROM brand ORDER BY brand")->fetchAll();
            $models = $db->query("SELECT * FROM model ORDER BY model_name")->fetchAll();
            include("view/post/sell.php");
            include("view/footer.php");
            exit();
        }
    case "addPost": {
            $brand_id = $vars['brand_id'];
            $model_id = $vars['model_id'];
            $year = $vars['year'];
            $mileage = $vars['mileage'];
            $fuel = $vars['fuel'];
            $price = $vars['price'];
            $description = $vars['description'];
            $wilaya = $vars['wilaya'];
            $title = $vars['title'];
            $user_id = $appuser['user_id'];
            $date = date("Y-m-d H:i:s");
            $car_id = $db->query("INSERT INTO car (brand_id, model_id, year, mileage, fuel) VALUES (?, ?, ?, ?, ?)", $brand_id, $model_id, $year, $mileage, $fuel)->lastInsertId();
            $post_id = $db->query("INSERT INTO post (user_id, car_id, price, description, wilaya, title, date) VALUES (?, ?, ?, ?, ?, ?, ?)", $user_id, $car_id, $price, $description, $wilaya, $title, $date)->lastInsertId();
            $images = $_FILES['images'];
            $image_order = 1;
            foreach ($images['name'] as $key => $image) {
                $image_name = $images['name'][$key];
                $image_tmp_name = $images['tmp_name'][$key];
                $image_size = $images['size'][$key];
                $image_error = $images['error'][$key];
                $image_type = $images['type'][$key];
                $image_ext = explode('.', $image_name);
                $image_actual_ext = strtolower(end($image_ext));
                $allowed = array('jpg', 'jpeg', 'png');
                if (in_array($image_actual_ext, $allowed)) {
                    if ($image_error === 0) {
                        if ($image_size < 10000000) {
                            $image_name_new = uniqid('', true) . "." . $image_actual_ext;
                            $image_destination = '../assets/images/' . $image_name_new;
                            move_uploaded_file($image_tmp_name, $image_destination);
                            $db->query("INSERT INTO images (post_id, url, image_order) VALUES (?, ?, ?)", $post_id, $image_name = $image_name_new, $image_order);
                            $image_order++;
                        } else {
                            $_SESSION['message'] = "Your file is too big!";
                            header("Location: index.php?action=sell");
                            exit();
                        }
                    } else {
                        $_SESSION['message'] = "There was an error uploading your file!";
                        header("Location: index.php?action=sell");
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "You cannot upload files of this type!";
                    header("Location: index.php?action=sell");
                    exit();
                }
            }
            header("Location: index.php?action=list&see=myposts");
        }
}
