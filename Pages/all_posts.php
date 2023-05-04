<?php
require_once '../utility/db_connection.php';
<<<<<<< Updated upstream

// set the number of posts per page
$posts_per_page = 8;
=======
require_once '../utility/functions.php';

// set the number of posts per page
$posts_per_page = 9;
>>>>>>> Stashed changes

// get the current page number from query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// calculate the offset for the posts query
$offset = ($current_page - 1) * $posts_per_page;

// query the database to get the posts for the current page
$sql = "SELECT * FROM car_selling_posts ORDER BY created_at  LIMIT $offset, $posts_per_page";
$result = mysqli_query($conn, $sql);

// get the total number of posts
$total_posts = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM car_selling_posts"));

// calculate the total number of pages
$total_pages = ceil($total_posts / $posts_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Market</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Iconbox -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
<<<<<<< Updated upstream
=======
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
>>>>>>> Stashed changes
    <!-- style css -->
    <link rel="stylesheet" href="../css/all_posts.css">
</head>


<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
<<<<<<< Updated upstream
            <img><a class="navbar-brand" href="#!">[logo]</a>
=======
            <img><a class="navbar-brand" href="../index.php">[logo]</a>
>>>>>>> Stashed changes
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop For Your Dream Car</h1>
                <p class="lead fw-normal text-white-50 mb-0">With SoukAuto</p>
            </div>
        </div>
    </header>
    <!--shopping part-->
<<<<<<< Updated upstream
    <div class="container">
=======
    <div class="container cards_landscape_wrap-2">
>>>>>>> Stashed changes
        <div class="row">
            <!--product-->
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card mb-4">
                            <!-- RENT/SELL badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sell</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="../<?php echo $row['image_url']; ?>" alt="Card image cap">
                            <!--card body-->
                            <div class="card-body">
                                <!-- Product name-->
                                <h5 class="card-title"><?php echo $row['year'], $row['title'] ?></h5>
                                <p class="card-text"><?php echo $row['description'] ?></p>
                                <p class="card-text"><?php echo $row['price'] ?> DA</p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
<<<<<<< Updated upstream

            <!-- Pagination -->
            <div class="d-flex justify-content-center my-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $current_page) {
                                echo "<li class='page-item active'><a class='page-link' href='all_posts.php?page=" . $i . "'>" . $i . "</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='all_posts.php?page=" . $i . "'>" . $i . "</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>

            <!-- End of container -->
=======
            <!--prod 5-->
            <div class="col-md-6 col-lg-3">
                <div class="card mb-4">
                    <!-- RENT/SELL badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">SALE</div>
                    <!-- Product image-->
                    <img class="card-img-top" src="../images/mazda.png" alt="Card image cap">
                    <!--card body-->
                    <div class="card-body">
                        <!-- Product details-->
                        <h5 class="card-title">[year] [car name]</h5>
                        <p class="card-text">[car description]</p>
                        <p class="card-text"><small class="text-muted">[date of post] , [wilaya] </small></p>
>>>>>>> Stashed changes

            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-nmW8uO7vmJ2fB6C9j6U3bIggEoGJ4oAXKj0p0zJL+RRbiRj75h42M9XSDP+oOksM" crossorigin="anonymous"></script>

        </div>
    </div>
<<<<<<< Updated upstream
=======
    <!-- Pagination -->
    <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-3">
        <?php
        // Only display pagination if there is more than 1 page
        if ($total_pages > 1) {
            echo "<ul class='pagination'>";

            // Previous page link
            $prev_page = $current_page - 1;
            $prev_disabled = ($current_page == 1) ? 'disabled' : '';
            echo "<li class='page-item $prev_disabled'><a class='page-link' href='all_posts.php?page=$prev_page' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";

            // Display page links
            if ($total_pages <= 7) {
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo generatePaginationLink($i, $current_page);
                }
            } else {
                $start = max(1, $current_page - 2);
                $end = min($total_pages, $start + 4);
                if ($start > 1) {
                    echo generatePaginationLink(1, $current_page);
                    if ($start > 2) {
                        echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                    }
                }
                for ($i = $start; $i <= $end; $i++) {
                    echo generatePaginationLink($i, $current_page);
                }
                if ($end < $total_pages) {
                    if ($end < $total_pages - 1) {
                        echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                    }
                    echo generatePaginationLink($total_pages, $current_page);
                }
            }

            // Next page link
            $next_page = $current_page + 1;
            $next_disabled = ($current_page == $total_pages) ? 'disabled' : '';
            echo "<li class='page-item $next_disabled'><a class='page-link' href='all_posts.php?page=$next_page' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";

            echo "</ul>";
        }
        ?>
    </nav>

    <!-- Bootstrap JavaScript files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> Stashed changes
</body>

</html>