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
                        $brand_id = $vars["request_brand"];
                        $wilaya = $vars["request_wilaya"];
                        $country_id = $vars["request_country"];
                        $priceMin = $vars["request_priceMin"];
                        $priceMax = $vars["request_priceMax"];
                        $mileageMin = $vars["request_mileageMin"];
                        $mileageMax = $vars["request_mileageMax"];
                        $yearMin = $vars["request_yearMin"];
                        $yearMax = $vars["request_yearMax"];
                    
                        
                        $sql_query1 = "SELECT * FROM post p INNER JOIN car c ON p.car_id = c.car_id 
                        INNER JOIN images i ON i.post_id = p.post_id 
                        INNER JOIN brand b ON b.brand_id = c.brand_id  where i.image_order = 1 AND b.Country = '$country_id' ";   
                        
                        $sql_query = "SELECT *
                        FROM post p 
                        INNER JOIN car c ON p.car_id = c.car_id 
                        INNER JOIN images i ON i.post_id = p.post_id 
                        INNER JOIN brand b ON b.brand_id = c.brand_id 
                        INNER JOIN model m ON m.model_id = c.model_id 
                        where i.image_order = 1";


                        if($brand_id !== 'ALL')
                        {
                            $sql_query .= " AND b.brand_id = '$brand_id' ";
                        }

                        if($country_id !== 'ALL')
                        {
                            $sql_query .= " AND b.Country = '$country_id' ";
                        }

                        if($wilaya !== 'ALL')
                        {
                            $sql_query .= " AND p.wilaya = '$wilaya' ";
                        }

                        if (isset($_POST['request_priceMin'])) {
                            $sql_query .= " AND  p.price >= '$priceMin' ";
                        }

                        if (isset($_POST['request_priceMax'] )) {
                            $sql_query .= " AND  p.price <= '$priceMax' ";
                        }

                        // if (isset($_POST['request_mileageMin'])) {
                        //     $sql_query .= " AND  c.mileage >= '$mileageMin' ";
                        // }

                        if (isset($_POST['request_yearMax'] )) {
                            $sql_query .= " AND  c.year <= '$yearMax' ";
                        }

                        if (isset($_POST['request_yearMin'])) {
                            $sql_query .= " AND  c.year >= '$yearMin' ";
                        }

                        // if (isset($_POST['request_mileageMax'] )) {
                        //     $sql_query .= " AND  c.mileage <= '$mileageMax' ";
                        // }
                        $posts = $db->query($sql_query)->fetchAll();
                        ?>

            <div class="row">
                <!--prod 1-->
                <?php
                if (count($posts)) {
                    foreach ($posts as $row) {
                ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="container">
                                <div class="card mb-4">
                                    <!-- Price badge-->
                                    <div class="badge bg-dark text-white position-absolute" style="top: 1rem; right: 1rem;">Sell</div>
                                    <!-- Product image-->

                                    <img class="card-img-top" src="assets/<?php echo $row['url']; ?>" alt="Card image cap">
                                    <!--card body-->
                                    <div class="card-body">
                                        <!-- Product name-->
                                        <h5 class="card-title"><?php echo $row['year'], '   ', $row['title'] ?></h5>
                                        <p class="card-text"><?php echo $row['price'] ?> DA</p>
                                        <p class="card-text"><?php echo $row['description'] ?></p>
                                        <p class="card-text"><small class="text-muted"><?php echo $row['date'] ?> , <?php echo $row['wilaya'] ?></small></p>

                                        <!--buttons-->
                                        <?php
                                        if (is_array($appuser)) {
                                            $favorited = $db->query("SELECT * FROM favorites WHERE user_id = ? AND post_id = ?",  $appuser['user_id'], $row['post_id'])->fetchAll();
                                            if (count($favorited) > 0) {
                                        ?>
                                                <button class="e-button btn-sm expand-btn" onclick="addToFavorites(<?php echo $row['post_id']; ?>)">
                                                    <span class="e-button-text"><ion-icon name="heart-outline"></ion-icon> Delete From Favorites</span>
                                                </button>
                                            <?php
                                            } else { ?>
                                                <button class="e-button btn-sm expand-btn" onclick="addToFavorites(<?php echo $row['post_id']; ?>)">
                                                    <span class="e-button-text"><ion-icon name="heart-outline"></ion-icon> Add To Favorites</span>
                                                </button>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <button class="e-button btn-sm expand-btn" role="button">
                                            <span class="e-button-text"><ion-icon name="person-outline"></ion-icon> Contact Seller</span>
                                        </button>
                                        <a href="post.php?id=<?php echo $row['post_id'] ?>">
                                            <button class="e-button btn-sm expand-btn">
                                                <span class="e-button-text"><ion-icon name="add-outline"></ion-icon> Show more</span>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<h1 class='text-center'>No Posts Found</h1>";
                }
                ?>
            </div>

                        <?php
                        // $search_query = "SELECT p.*, c.*, i.*
                        // FROM post p 
                        // INNER JOIN car c ON p.car_id = c.car_id 
                        // INNER JOIN images i ON i.post_id = p.post_id 
                        // INNER JOIN brand b ON b.brand_id = c.brand_id 
                        // INNER JOIN model m ON m.model_id = c.model_id 
                        // WHERE i.image_order = 1
                        // AND (p.title LIKE ? OR p.description LIKE ? OR b.brand LIKE ? OR m.model_name LIKE ? or ? = '')
                        // AND (c.brand_id = ? OR ? = '')
                        // AND (p.wilaya = ? OR ? = '')
                        // AND (b.Country = ? OR ? = '')
                        // AND ((p.price >= ? AND p.price <= ?) OR (? = '' AND ? = ''))
                        // AND ((c.mileage >= ? AND c.mileage <= ?) OR (? = '' OR ? = ''))
                        // AND ((YEAR(c.year) >= ? AND YEAR(c.year) <= ?) OR (? = '' OR ? = ''))
                        // ORDER BY p.date DESC";

                        // $total_posts = $db->query(
                        //     $search_query,
                        //     $keyword,
                        //     $keyword,
                        //     $keyword,
                        //     $keyword,
                        //     $keyword,
                        //     $brand_id,
                        //     $brand_id,
                        //     $wilaya,
                        //     $wilaya,
                        //     $country_id,
                        //     $country_id,
                        //     $priceMin,
                        //     $priceMax,
                        //     $priceMin,
                        //     $priceMax,
                        //     $mileageMin,
                        //     $mileageMax,
                        //     $mileageMin,
                        //     $mileageMax,
                        //     $yearMin,
                        //     $yearMax,
                        //     $yearMin,
                        //     $yearMax
                        // )->fetchAll();
                        // $total_pages = count($total_posts) / $posts_per_page;
                        // $search_query .= " LIMIT ?, ?";
                        // $posts = $db->query($search_query, $keyword, $keyword,  $keyword, $keyword, $keyword, $brand_id, $brand_id, $wilaya, $wilaya, $country_id, $country_id, $priceMin, $priceMax, $priceMin, $priceMax, $mileageMin, $mileageMax, $mileageMin, $mileageMax, $yearMin, $yearMax, $yearMin, $yearMax, $offset, $posts_per_page)->fetchAll();
                        // include("view/header2.php");
                        // include("view/post/market.php");
                        // include("view/footer.php");
                        // exit();
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
