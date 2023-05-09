<?php
require_once '../utility/db_connection.php';
require_once '../utility/functions.php';
$user_id = $_SESSION['user_id'];

// set the number of posts per page
$posts_per_page = 9;

// get the current page number from query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// calculate the offset for the posts query
$offset = ($current_page - 1) * $posts_per_page;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (strcmp($_POST["action"], "favorite") == 0) {
        $sql = "SELECT * FROM ( post inner join car on post.car_id = car.car_id ) inner join images on images.post_id = post.post_id inner join favorites on favorites.post_id = post.post_id  where image_order = 1 and favorites.user_id = $user_id ORDER BY date LIMIT $offset, $posts_per_page";
    } else 
    if (strcmp($_POST["action"], "myposts") == 0) {
        $sql = "SELECT * FROM ( post inner join car on post.car_id = car.car_id ) inner join images on images.post_id = post.post_id where image_order = 1 and post.user_id = $user_id ORDER BY date LIMIT $offset, $posts_per_page";
    } else exit;
} else {
    $sql = "SELECT * FROM ( post inner join car on post.car_id = car.car_id ) inner join images on images.post_id = post.post_id where image_order = 1 ORDER BY date LIMIT $offset, $posts_per_page";
}
// query the database to get the posts for the current page
$result = mysqli_query($conn, $sql);

// get the total number of posts
$total_posts = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM post"));
$total_favorites = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM favorites WHERE user_id = " . $_SESSION['user_id']));

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <!-- Iconbox -->

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- date picker -->
    <link href="
        https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css
        " rel="stylesheet">
    <!-- style css -->
    <link rel="stylesheet" href="../css/all_posts.css">
</head>


<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="../index.php">
                <img src="../images/logo.png" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex ms-auto" method="post" action="">
                    <input type="hidden" name="action" value="favorite">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Favorites
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $total_favorites ?></span>
                    </button>
                </form>
                <br>
                <a href="all_posts.php">
                    <button class="btn btn-outline-dark">
                        <i class="bi-cart-fill me-1"></i>
                        All Posts
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $total_posts ?></span>
                    </button>
                </a>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop For Your Dream Car</h1>
                <p class="lead fw-normal text-white-50 mb-0">With <img src="../images/icon.ico" style="height:37px; margin-top: -6px;"></p>
            </div>
        </div>
    </header>

    <!--Filter nav-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- Filter Toggle Button -->
                <div class="d-flex justify-content my-3 ml-3">
                    <button type="button" class="btn btn-outline-primary toggle-filter-btn">
                        <ion-icon name="funnel-outline"></ion-icon>
                    </button>
                </div>

                <!-- Filter Form -->
                <form class="filter-form d-none">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <!-- Brand -->
                            <label for="brand">Brand:</label>
                            <select class="form-control" id="brand">
                                <option>Toyota</option>
                                <option>Honda</option>
                                <option>Nissan</option>
                                <option>Hyundai</option>
                                <option>Kia</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Wilaya -->
                            <label for="wilaya">Wilaya:</label>
                            <select class="form-control" id="wilaya">
                                <option>Algiers</option>
                                <option>Oran</option>
                                <option>Constantine</option>
                                <option>Batna</option>
                                <option>Setif</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Country -->
                            <label for="country">Country:</label>
                            <select class="form-control" id="country">
                                <option>Japan</option>
                                <option>Korea</option>
                                <option>Germany</option>
                                <option>USA</option>
                                <option>France</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Price range -->
                        <div class="col-md-4 mb-3">
                            <label for="price ">Price:</label>
                            <input type="range" class="form-range" id="price" step="100000" min="1000000" max="10000000">
                            <div class="price-range-values"></div>
                            <div class="d-flex justify-content-between">
                                <span>1,000,000</span>
                                <span>10,000,000</span>
                            </div>
                            <input type="range" class="form-range" id="price2" step="100000" min="1000000" max="10000000">
                        </div>
                        <!-- Mileage Range -->
                        <div class="col-md-4 mb-3">
                            <label for="mileage">Mileage:</label>
                            <input type="range" class="form-range" id="mileage" step="5000" min="0" max="500000">
                            <div class="d-flex justify-content-between">
                                <span>0</span>
                                <span>500,000</span>
                            </div>
                            <input type="range" class="form-range" id="mileage2" step="5000" min="0" max="500000">
                        </div>
                        <!-- year Range -->
                        <div class="col-md-4 mb-3">
                            <label for="year">Year:</label>
                            <input type="text" class="form-control datepicker-year" class="year" name="year" placeholder="From" min="1970" max="2023">
                            <br>
                            <input type="text" class="form-control datepicker-year" class="year" name="year" placeholder="To" min="1970" max="2023">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--shopping part-->
    <div class="container cards_landscape_wrap-2 pb-5">
        <div class="row">
            <!--prod 1-->
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="container">
                            <div class="card mb-4">
                                <!-- RENT/SELL badge-->
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sell</div>
                                <!-- Product image-->
                                <img class="card-img-top" src="../<?php echo $row['url']; ?>" alt="Card image cap">
                                <!--card body-->
                                <div class="card-body">
                                    <!-- Product name-->
                                    <h5 class="card-title"><?php echo $row['year'], '   ', $row['title'] ?></h5>
                                    <p class="card-text"><?php echo $row['price'] ?> DA</p>
                                    <p class="card-text"><?php echo $row['description'] ?></p>
                                    <p class="card-text"><small class="text-muted"><?php echo $row['date'] ?> , <?php echo $row['wilaya'] ?></small></p>
                                    <!--buttons-->
                                    <?php
                                    $sql_favorites = "SELECT * FROM favorites WHERE user_id = ? AND post_id = ?";
                                    $stmt_favorites = mysqli_prepare($conn, $sql_favorites);
                                    mysqli_stmt_bind_param($stmt_favorites, 'ii', $user_id, $row['post_id']);
                                    mysqli_stmt_execute($stmt_favorites);
                                    $result_favorites = mysqli_stmt_get_result($stmt_favorites);
                                    if ($result_favorites->num_rows > 0) {
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
    </div>


    <!-- Pagination -->
    <div class="row mb-5">
        <div class="col-md-4"></div>
        <div class="col-md-4 text-center">
            <h2 class="heading-section"></h2>

            <div class="block-27">
                <ul>
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $current_page) {
                            echo "<li class='active'><a href='all_posts.php?page=" . $i . "'>" . $i . "</a></li>";
                        } else {
                            echo "<li><a  href='all_posts.php?page=" . $i . "'>" . $i . "</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>



<!-- Bootstrap JavaScript files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
<script src="https://use.fontawesome.com/72b693e5a2.js"></script>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })


    //item in favorite list (change later)
    // const button = document.querySelector('.e-button');
    // let isFavorite = false;

    // button.addEventListener('click', () => {
    //     const icon = button.querySelector('ion-icon');
    //     isFavorite = !isFavorite;
    //     if (isFavorite) {
    //         icon.setAttribute('name', 'heart-dislike-outline');
    //     } else {
    //         icon.setAttribute('name', 'heart-outline');
    //     }
    // });

    //togle filter button
    $(document).ready(function() {
        $(".toggle-filter-btn").click(function() {
            $(".filter-form").toggleClass("d-none");
        });
    });

    //date picker
    $(function() {
        $('.datepicker-year').datepicker({
            format: 'yyyy',
            viewMode: 'years',
            minViewMode: 'years',
            startDate: '1970',
            endDate: '2023'
        });

        $('#year').on('changeDate', function() {
            const year = $(this).datepicker('getDate').getFullYear();
            console.log(year);
        });
    });


    function addToFavorites(post_id) {
        // send an AJAX request to the server to add or remove the post from the user's favorites
        $.ajax({
            url: '../utility/functions.php?action=addtofavorites',
            method: 'post',
            data: {
                post_id: post_id
            },
            success: function(response) {
                // update the UI to reflect the changes
                if (response == 'added') {
                    // the post was added to the user's favorites
                    alert('Post added to favorites');
                    const icon = document.querySelector('.e-button ion-icon');
                    icon.setAttribute('name', 'heart-dislike-outline');
                    icon.classList.add('favorite');
                } else if (response == 'removed') {
                    // the post was removed from the user's favorites
                    alert('Post removed from favorites');
                    const icon = document.querySelector('.e-button ion-icon');
                    icon.setAttribute('name', 'heart-outline');
                    icon.classList.remove('favorite');
                }
            },
            error: function() {
                alert('An error occurred');
            }
        });
    }

    const button = document.querySelector('.e-button');
    let isFavorite = false;

    button.addEventListener('click', () => {
        const icon = button.querySelector('ion-icon');
        isFavorite = !isFavorite;
        if (isFavorite) {
            addToFavorites(post_id);
            icon.setAttribute('name', 'heart-dislike-outline');

        } else {
            icon.setAttribute('name', 'heart-outline');
        }
    });
</script>


</html>