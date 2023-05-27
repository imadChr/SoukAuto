<head>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Market</title>
</head>
<header>
    <img src="assets/images/sell_header.png" class="img-fluid" alt="Responsive image">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between">
            <!-- Toggle Button -->
            <div class="d-flex justify-content my-3">
                <button type="button" class="btn btn-outline-primary toggle-filter-btn">
                    <ion-icon name="funnel-outline"></ion-icon>
                </button>
            </div>
            <!-- Search Bar -->
            <div class="bg-white p-3 rounded ml-auto">
                <form method="post" action="index.php?action=list&see=search">
                    <div class="input-group">
                        <input type="text" name="keyword" placeholder="Search" aria-describedby="button-addon1" class="form-control border-0 bg-light">
                        <div class="input-group-append">
                            <button id="button-addon1" type="submit" class="btn btn-link text-primary"><ion-icon name="search-outline"></ion-icon></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- filtering section -->
        <div class="row">
            <div class="col-md-12">
                <form class="filter-form d-none" method="post" action="index.php?action=list">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <!-- Brand -->
                            <label for="brand">Brand:</label>
                            <select class="form-control" id="brand_id" name="brand_id">
                                <option value="ALL">All</option>
                                <?php
                                foreach ($brands as $row) {
                                    echo '<option value="' . $row['brand_id'] . '">' . $row['brand'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Wilaya -->
                            <label for="wilaya">Wilaya:</label>
                            <select class="form-control" id="wilaya" name="wilaya">
                                <option value="ALL">All</option>
                                <option value="Algiers">Algiers</option>
                                <option value="Oran">Oran</option>
                                <option value="Constantine">Constantine</option>
                                <option value="Batna">Batna</option>
                                <option value="Setif">Setif</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Country -->
                            <label for="country">Country:</label>
                            <select class="form-control" id="country" name="country_id">
                                <option value="ALL">All</option>
                                <option value="1">USA</option>
                                <option value="2">Japan</option>
                                <option value="3">Germany</option>
                                <option value="4">South Korea</option>
                                <option value="5">Italy</option>
                                <option value="6">France</option>
                                <option value="7">Sweden</option>
                                <option value="8">United Kingdom</option>
                                <option value="11">Australia</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <!-- Price Range -->
                            <label for="price">Price Range:</label>
                            <div class="row">
                                <div class="col">
                                    <input type="number" min='0' class="form-control" id="priceMin" name="priceMin" placeholder="Min" step="10000" value="0">
                                </div>
                                <div class="col">
                                    <input type="number" min='0' class="form-control" id="priceMax" name="priceMax" placeholder="Max" step="10000" value="10000000">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Mileage Range -->
                            <label for="mileage">Mileage Range:</label>
                            <div class="row">
                                <div class="col">
                                    <input type="number" min="0" class="form-control" id="mileageMin" name="mileageMin" placeholder="Min" step="10000" value="0">
                                </div>
                                <div class="col">
                                    <input type="number" min="0" class="form-control" id="mileageMax" name="mileageMax" placeholder="Max" step="10000" max="100000000000000" value="100000000">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Year Range -->
                            <label for="yearMin">Year Range:</label>
                            <div class="row">
                                <div class="col">
                                    <input type="number" class="form-control" id="yearMin" name="yearMin" placeholder="Min" min="1950" value="1950">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" id="yearMax" name="yearMax" placeholder="Max" min="1950" value="2023">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary d-flex justify-content-center">Discard Filters</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container cards_landscape_wrap-2 pb-5" id='filter'>
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
                                    <div class="badge text-white position-absolute"> <?php echo $row['price'] ?> DA</div>
                                    <!-- Product image-->
                                    <div class="card-img-top">
                                        <img class="card-img-top" src="assets/<?php echo $row['url']; ?>" alt="Card image cap">
                                    </div>
                                    <!--card body-->
                                    <div class="card-body">
                                        <!-- Product name-->
                                        <h5 class="card-title"><?php echo $row['year'], '   ', $row['title'] ?></h5>
                                        <p class="card-text desc"><?php echo $row['description'] ?></p>
                                        <p class="card-text"><small class="text-muted"><?php echo $row['date'] ?> , <?php echo $row['wilaya'] ?></small></p>

                                        <!--buttons-->
                                        <?php
                                        if (is_array($appuser)) {
                                            $favorited = $db->query("SELECT * FROM favorites WHERE user_id = ? AND post_id = ?",  $appuser['user_id'], $row['post_id'])->fetchAll();
                                        ?>
                                            <button class="e-button btn-sm expand-btn" data-post-id="<?php echo $row['post_id']; ?>" onclick="<?php echo count($favorited) > 0 ? 'deleteFavorites(' . $row['post_id'] . ')' : 'addFavorites(' . $row['post_id'] . ')'; ?>">
                                                <span class=" e-button-text"><ion-icon name="<?php echo count($favorited) > 0 ? 'heart-dislike-outline' : 'heart-outline'; ?>"></ion-icon> <?php echo count($favorited) > 0 ? 'Delete From Favorites' : 'Add To Favorites'; ?></span>
                                            </button>
                                        <?php } ?>
                                        <button class="e-button btn-sm expand-btn" onclick="contactSeller(<?php echo $row['user_id'] ?>)" role="button">
                                            <span class="e-button-text"><ion-icon name="person-outline"></ion-icon> Contact Seller</span>
                                        </button>
                                        <a href="index.php?action=post&id=<?php echo $row['post_id']; ?>">
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
        <div class="row mb-5">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <h2 class="heading-section"></h2>
                <div class="block-27">
                    <ul class="pagination">
                        <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $current_page) {
                                echo "<li class='active'><a href=''>" . $i . "</a></li>";
                            } else {
                                echo "<li><a class='page-link' href=''>" . $i . "</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://unpkg.com/notyf/notyf.min.css" />
<script src="https://unpkg.com/notyf/notyf.min.js"></script>
<script>
    var notyf = new Notyf();

    function addFavorites(post_id) {
        $.ajax({
            url: 'index.php?action=addFavorites',
            method: 'POST',
            data: {
                post_id: post_id
            },
            success: function(response) {
                // update the button text and onclick attribute
                if (response == 'added') {
                    var button = $('button[data-post-id="' + post_id + '"]');
                    button.find('.e-button-text').html('<ion-icon name="heart-dislike-outline"></ion-icon> Delete From Favorites');
                    button.attr('onclick', 'deleteFavorites(' + post_id + ')');

                    // display a notification message
                    notyf.success('Post added to favorites');
                }
            }
        });
    }

    function deleteFavorites(post_id) {
        $.ajax({
            url: 'index.php?action=deleteFavorites',
            type: 'POST',
            data: {
                post_id: post_id
            },
            success: function(response) {
                // update the button text and onclick attribute
                if (response == 'deleted') {
                    var button = $('button[data-post-id="' + post_id + '"]');
                    button.find('.e-button-text').html('<ion-icon name="heart-outline"></ion-icon> Add To Favorites');
                    button.attr('onclick', 'addFavorites(' + post_id + ')');

                    // display a notification message
                    notyf.error('Post deleted from favorites');
                }
            }
        });
    }

    //event listener to #contactseller
    function contactSeller(seller_id) {
        // send an AJAX request to get the phone number and first name of the seller
        $.ajax({
            url: 'index.php?action=getSellerInfo',
            type: 'POST',
            data: {
                seller_id: seller_id
            },
            success: function(response) {
                // display the phone number and first name in a SweetAlert2 popup
                response = JSON.parse(response);
                Swal.fire({
                    title: 'Contact Seller',
                    html: '<div class="btn-popup" ><i class="fas fa-user"></i> Name: ' + response['firstname'] + '</div><br><div class="btn-popup"><i class="fas fa-envelope"></i> Email: ' + response['email'] + '</div><br><div class="btn-popup" style="background-color:#ED6C15;><i class="fas fa-phone"></i> Phone number: ' + response['phonenumber'] + '</div>',
                    showConfirmButton: true,
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !Swal.isLoading()
                });
            }
        });
    }
</script>
<script type='text/javascript'>
    function fetchData(changingID) {
        var brand = $('#brand_id').val();
        var country = $('#country').val();
        var wilaya = $('#wilaya').val();
        var priceMin = $('#priceMin').val();
        var priceMax = $('#priceMax').val();
        var mileagaMin = $('#mileageMin').val();
        var mileageMax = $('#mileageMax').val();
        var yearMin = $('#yearMin').val();
        var yearMax = $('#yearMax').val();


        $.ajax({
            url: 'index.php?action=list&see=filter',
            type: 'POST',
            data: {
                request_brand: brand,
                request_country: country,
                request_wilaya: wilaya,
                request_priceMin: priceMin,
                request_priceMax: priceMax,
                // request_mileageMin: mileageMin,
                // request_mileageMax: mileageMax,
                request_yearMin: yearMin,
                request_yearMax: yearMax
            },
            beforeSend: function() {
                $("#filter").html("<span>Working...</span>");
            },
            success: function(data) {
                $("#filter").html(data);
            }
        });
    }

    $(document).ready(function() {
        $('#country').on('keyup change', function() {
            fetchData('#country');
        });

        $('#brand_id').on('keyup change', function() {
            fetchData('#brand_id');
        });

        $('#priceMin').on('keyup change', function() {
            fetchData('#priceMin');
        });

        $('#priceMax').on('keyup change', function() {
            fetchData('#priceMax');
        });

        $('#wilaya').on('keyup change', function() {
            fetchData('#wilaya');
        });

        $('#mileageMax').on('keyup change', function() {
            fetchData('#mileageMax');
        });

        $('#mileageMin').on('keyup change', function() {
            fetchData('#mileageMin');
        });

        $('#yearMin').on('keyup change', function() {
            fetchData('#yearMin');
        });

        $('#yearMax').on('keyup change', function() {
            fetchData('#yearMax');
        });

    });
</script>