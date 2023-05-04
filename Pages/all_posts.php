<?php
session_start();
require_once '../utility/db_connection.php';
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
        <link
        href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
        rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" 
        rel="stylesheet" />
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
                                <li><hr class="dropdown-divider" /></li>
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
                    <p class="lead fw-normal text-white-50 mb-0">With <img src="../images/icon.ico" style="height:37px; margin-top: -6px;"></p>
            </div>
        </div>
    </header>
    <!--shopping part-->
        <div class="container cards_landscape_wrap-2 pb-5">
        <div class="row">
            <!--prod 1-->
            <div class="col-md-6 col-lg-3">
                    <div class="card mb-4"> <!--TRY: card-flyer --> 
                    <!-- RENT/SELL badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">RENT</div>
                    <!-- Product image-->
                        <img class="card-img-top " src="../images/car.png" alt="Card image cap">
                    <!--card body-->
                    <div class="card-body">
                            <!-- Product details-->
                        <h5 class="card-title">[year] [car name]</h5>
                        <p class="card-text">[car description]</p>
                            <p class="card-text"><small class="text-muted">[date of post] , [wilaya] </small></p>
                            <!--icons-->
                            
                    </div>
                </div>
            </div>
            <!--prod 2-->
            <?php
            $sql = "SELECT * FROM car_selling_posts";
            $result = mysqli_query($conn, $sql);
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
            <!--prod 3-->
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

                    </div>
                </div>
            </div>
            <!--prod 4-->
            <div class="col-md-6 col-lg-3">
                <div class="card mb-4">
                    <!-- RENT/SELL badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">RENT</div>
                    <!-- Product image-->
                    <img class="card-img-top" src="../images/car.png" alt="Card image cap">
                    <!--card body-->
                    <div class="card-body">
                            <!-- Product details-->
                        <h5 class="card-title">[year] [car name]</h5>
                        <p class="card-text">[car description]</p>
                            <p class="card-text"><small class="text-muted">[date of post] , [wilaya] </small></p>

                    </div>
                </div>
            </div>
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

                    </div>
                </div>
            </div>
            <!-- Add more cards here -->

        </div>
    </div>
        <!-- Pagination -->
        <div class="row mb-5">
            <div class="col-md-4"></div> <!-- empty column on the left -->
            <div class="col-md-4 text-center"> <!-- center column for pagination -->
                <h2 class="heading-section"></h2>
                <div class="block-27">
                    <ul>
                        <li><a href="#">&lt;</a></li>
                        <li class="active"><span>1</span></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
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