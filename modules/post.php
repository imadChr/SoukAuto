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
                        include("view/header.php");
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
                        include("view/header.php");
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
                        include("view/header.php");
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
                        include("view/header.php");
                        include("view/post/market.php");
                        include("view/footer.php");
                        exit();
                    }
                    break;
            }
        }
        break;
    case "post": {
            $post_id = $_GET['id'];
            $post = $db->query("SELECT * from post inner join car on post.car_id = car.car_id inner join brand on car.brand_id = brand.brand_id inner join model on car.model_id = model.model_id inner join images on images.post_id = post.post_id  where post.post_id = $post_id LIMIT 1")->fetchArray();
            $images = $db->query("SELECT * from images where post_id = ? and image_order > 1 order by image_order asc", $post_id)->fetchAll();
            $comments = $db->query("SELECT * FROM comments inner join users on comments.user_id = users.user_id WHERE post_id = ? ORDER BY comment_id desc", $post_id)->fetchAll();
            include("view/header.php");
            include("view/post/post.php");
            include("view/footer.php");
            exit();
        }
        break;
    case "sell": {
            $brands = $db->query("SELECT * FROM brand ORDER BY brand")->fetchAll();
            include("view/post/sell.php");
            include("view/footer.php");
            exit();
        }
        break;

    case "getmodels": {
            $brand_id = $vars["brand_id"];
            // Query the database to get the list of models that belong to the selected brand
            $models = $db->query("SELECT model_id, model_name from model WHERE brand_id=? GROUP BY model_name order by model_name asc", $brand_id)->fetchAll();
            // Create an HTML string that contains the list of models
            $models_html = "";
            foreach ($models as $row) {
                $model_name = $row["model_name"];
                $model_id = $row["model_id"];
                $models_html .= "<option value='" . $model_id . "'>" . $model_name . "</option>";
            }
            // Return the HTML string as the response
            echo $models_html;

            exit();
        }
        break;
    case "addPost": {
            $title = $vars["title"];
            $description = $vars["description"];
            $price = $vars["price"];
            $user_id = $appuser["user_id"];
            $brand_id = $vars["brand_id"];
            $model_id = $vars["model_id"];
            $fuel = $vars["fuel"];
            $year = $vars["year"];
            $mileage = $vars["mileage"];
            $wilaya = $vars["wilaya"];
            $pictures = $_FILES['pictures'];

            $car_id = $db->query("INSERT INTO car (brand_id, model_id, fuel, year, mileage) VALUES (?,?,?,?,?)", $brand_id, $model_id, $fuel, $year, $mileage)->lastInsertId();
            if (!$car_id) {
                // Display error message or redirect to an error page
                die("Error adding car");
            }
            // Add the post
            $post_id = $db->query("INSERT INTO post (title, description, price, user_id, car_id, wilaya) VALUES (?,?,?,?,?,?)", $title, $description, $price, $user_id, $car_id, $wilaya)->lastInsertId();
            if (!$post_id) {
                // Display error message or redirect to an error page
                die("Error adding post");
            }
            // Move the pictures to the upload directory
            if (!are_valid_pictures($pictures)) {
                // Display error message or redirect to an error page
                die("Invalid pictures");
            }
            $images_path = move_pictures_to_upload_directory($pictures);
            if (!$images_path) {
                // Display error message or redirect to an error page
                die("Error moving pictures to upload directory");
            }
            // Insert the images to the database
            $order = 1;
            foreach ($images_path as $path) {
                $sql = "INSERT INTO images (post_id, image_order, url) VALUES ('$post_id', '$order', '$path')";
                $db->query($sql);
                $order++;
            }

            // Redirect to the post page
            header("Location: index.php?action=post&id=$post_id");
            exit;
        }
        break;
    case "deletecomment": {
            $comment_id = $vars["comment_id"];
            $post_id = $vars["post_id"];
            $db->query("DELETE FROM comments WHERE comment_id = ?", $comment_id);
            // header("Location: index.php?action=post&id=$post_id");
            exit;
        }
        break;
    case "addcomment": {
            $message = $vars["message"];
            $user_id = $appuser["user_id"];
            $post_id = $vars["post_id"];
            $last_id = $db->query("INSERT INTO comments (message, user_id, post_id) VALUES (?,?,?)", $message, $user_id, $post_id)->lastInsertId();
            $row = $db->query("SELECT * FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comment_id = ?", $last_id)->fetchArray();

            echo '
                <div class="comment" id="comment-' . $row['comment_id'] . '">
                    <div class="date">
                        <p>' . date('d/m/Y', strtotime($row['date_posted'])) . '</p>
                    </div>
                    <div class="name">
                        <h3>' . $row['firstname'] . '</h3>
                    </div>
                    <p>' . $row['message'] . '</p>
                    <!-- Delete button -->
                    ';
            if (isset($appuser['user_id']) && $appuser['user_id'] == $row['user_id']) {
                echo '<button type="button" class="btn" onclick="deletecomment(' . $row['comment_id'] . ', ' . $post['post_id'] . ')">Delete</button>';
            }
            echo '
                </div>
            ';
            exit;
        }
        break;
    case "addFavorites": {
            $post_id = $vars["post_id"];
            $user_id = $appuser["user_id"];
            $db->query("INSERT INTO favorites (user_id, post_id) VALUES (?,?)", $user_id, $post_id);
            echo 'added';
            exit;
        }
        break;
    case "deleteFavorites": {
            $post_id = $vars["post_id"];
            $user_id = $appuser["user_id"];
            $db->query("DELETE FROM favorites WHERE user_id = ? AND post_id = ?", $user_id, $post_id);
            echo 'deleted';
            exit;
        }
        break;
    case "getSellerInfo": {
            $seller_id = $vars["seller_id"];
            $seller_info = $db->query("SELECT * FROM users WHERE user_id = ?", $seller_id)->fetchArray();
            echo json_encode($seller_info);
            exit;
        }
        break;
}
