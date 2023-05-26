<head>
    <title>Market</title>
</head>
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop For Your Dream Car</h1>
            <p class="lead fw-normal text-white-50 mb-0">With <img src="assets/images/icon.ico" style="height:37px; margin-top: -6px;"></p>
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
                <form class="filter-form d-none" method="post" action="index.php?action=list&see=search">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <!-- Brand -->
                            <label for="brand">Brand:</label>
                            <select class="form-control" id="brand" name="brand_id">
                                <option value="">All</option>
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
                                <option value="">All</option>
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
                                <option value="">All</option>
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
                            <label for="priceMin">Price Range:</label>
                            <div class="row">
                                <div class="col">
                                    <input type="number" class="form-control" id="priceMin" name="priceMin" placeholder="Min" step="100">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" id="priceMax" name="priceMax" placeholder="Max" step="100">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Mileage Range -->
                            <label for="mileageMin">Mileage Range:</label>
                            <div class="row">
                                <div class="col">
                                    <input type="number" class="form-control" id="mileageMin" name="mileageMin" placeholder="Min" step="1000">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" id="mileageMax" name="mileageMax" placeholder="Max" step="1000">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Year Range -->
                            <label for="yearMin">Year Range:</label>
                            <div class="row">
                                <div class="col">
                                    <input type="number" class="form-control" id="yearMin" name="yearMin" placeholder="Min">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" id="yearMax" name="yearMax" placeholder="Max">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container cards_landscape_wrap-2 pb-5">
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
                                echo "<li class='active'><a href='#'>" . $i . "</a></li>";
                            } else {
                                echo "<li><a class='page-link' href='#'>" . $i . "</a></li>";
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