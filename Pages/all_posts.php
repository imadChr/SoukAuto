<?php
require_once '../utility/db_connection.php';
require_once '../utility/functions.php';

// set the number of posts per page
$posts_per_page = 9;

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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
        crossorigin="anonymous">    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">  
    <!-- Iconbox -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- style css -->
    <link rel="stylesheet" href="../css/all_posts.css">
</head>


<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
                <img src="../images/logo.png" class="logo"><a class="navbar-brand" href="../index.php"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
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
                        favorites
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
                    <p class="lead fw-normal text-white-50 mb-0">With <img src="../images/icon.ico" style="height:37px; margin-top: -6px;"></p>
            </div>
        </div>
    </header>
    <!--filter-->
    <div class="input-group input-daterange btn-sm">
  <select class="form-control" id="yearFrom">
    <option value="">From year</option>
    <!-- Add options for year range here -->
    <?php
    $currentYear = date('Y');
    for ($i = $currentYear; $i >= 1900; $i--) {
      echo "<option value='$i'>$i</option>";
    }
    ?>
  </select>
  <div class="input-group-addon">to</div>
  <select class="form-control" id="yearTo">
    <option value="">To year</option>
    <!-- Add options for year range here -->
    <?php
    $currentYear = date('Y');
    for ($i = $currentYear; $i >= 1900; $i--) {
      echo "<option value='$i'>$i</option>";
    }
    ?>
  </select>
</div>
    <!--shopping part-->
    <div class="container cards_landscape_wrap-2"> //class pb-5 
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

                        <!-- Bootstrap JS -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-nmW8uO7vmJ2fB6C9j6U3bIggEoGJ4oAXKj0p0zJL+RRbiRj75h42M9XSDP+oOksM" crossorigin="anonymous"></script>

                    </div>
                </div>
                <!-- Pagination -->
                <div class="row mb-5">
                    <div class="col-md-4"></div> <!-- empty column on the left -->
                    <div class="col-md-4 text-center"> <!-- center column for pagination -->
                        <h2 class="heading-section"></h2>
                        <div class="block-27">
                            <ul class="pagination justify-content-center">
                                <li><a href="#">&lt;</a></li>
                                <?php
                                // Define variables for the number of total pages and the current page
                                $total_pages = 5;
                                $current_page = 1;

                                // Generate the pagination links using a loop
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    if ($i == $current_page) {
                                        echo "<li class='active'><span>" . $i . "</span></li>";
                                    } else {
                                        echo "<li><a href='#'>" . $i . "</a></li>";
                                    }
                                }
                                ?>
                                <li><a href="#">&gt;</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4"></div> <!-- empty column on the right -->
                </div>


                <!-- Bootstrap JavaScript files -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                </script>    
</body>

</html>