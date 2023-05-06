<?php
session_start();
require_once '../utility/db_connection.php';

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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" 
        rel="stylesheet">
    <!-- Iconbox -->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <link
        href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
        rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" 
        rel="stylesheet" />
        <script src="https://use.fontawesome.com/72b693e5a2.js"></script>
        <!-- date picker -->
        <script src="
        https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js
        "></script>
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
                <img src="../images/logo.png" class="logo"><a class="navbar-brand" href="../index.php"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
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
                    </ul> -->
                <form class="d-flex ms-auto">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                            favorites
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span> <!--add number of cars in favorite-->
                    </button>
                </form>
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
                            <input type="range" class="form-range" id="price" step="100000"  min="1000000" max="10000000">
                            <div class="price-range-values"></div>
                            <div class="d-flex justify-content-between">
                                <span>1,000,000</span>
                                <span>10,000,000</span>
                            </div>
                            <input type="range" class="form-range" id="price2" step="100000"  min="1000000" max="10000000">
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
                    <div class="col-md-6 col-lg-3">
                    <div class="container">
                        <div class="card mb-4">
                            <!-- RENT/SELL badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">RENT</div>
                            <!-- Product image-->
                            <img class="card-img-top " src="../images/car.png" alt="Card image cap">
                            <!--card body-->
                            <div class="card-body">
                                <!-- Product details-->
                                <h3 class="card-title">[year] [car name]</h3>
                                <h5 style="color:#ED6C15;">[price] DA</h5>
                                <p class="card-text">[car description]</p>
                                <p class="card-text"><small class="text-muted">[date of post] , [wilaya] </small></p>
                                <!--icons-->
                                <button class="e-button btn-sm expand-btn" role="button">
                                    <span class="e-button-text"><ion-icon name="heart-outline"></ion-icon> Add To Favorites</span> 
                                </button>
                                  
                                <button class="e-button btn-sm expand-btn" role="button">
                                    <span class="e-button-text"><ion-icon name="person-outline"></ion-icon> Contact Seller</span> 
                                </button>
                                  
                                <button class="e-button btn-sm expand-btn" role="button">
                                    <span class="e-button-text"><ion-icon name="add-outline"></ion-icon> Show more</span> 
                                </button>
                            </div>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })


            //item in favorite list (change later)
            const button = document.querySelector('.e-button');
            let isFavorite = false;

            button.addEventListener('click', () => {
            const icon = button.querySelector('ion-icon');
            isFavorite = !isFavorite;
            if (isFavorite) {
                icon.setAttribute('name', 'heart-dislike-outline');
            } else {
                icon.setAttribute('name', 'heart-outline');
            }
            });

            //togle filter button
            $(document).ready(function(){
                $(".toggle-filter-btn").click(function(){
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
        </script> 

    </body>
</html>