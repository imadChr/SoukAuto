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
                <button type="button" class="btn btn-outline-primary">
                    <ion-icon name="funnel-outline"></ion-icon>
                </button>
            </div>
            <!-- Search Bar -->
            <div class="bg-white p-3 rounded ml-auto">
                <form method="post" action="index.php?action=list&see=search">
                    <div class="input-group">
                        <input type="text" name="keyword" placeholder="Search" aria-describedby="button-addon1" class="d-inline form-control form-control bg-light search">
                        <div class="input-group-append">
                            <button id="button-addon1 " type="submit" class="btn btn-link d-inline text-primary"><ion-icon name="search-outline"></ion-icon></button>
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
                                <option value="">Select a wilaya</option>
                                <option value="Adrar">Adrar</option>
                                <option value="Chlef">Chlef</option>
                                <option value="Laghouat">Laghouat</option>
                                <option value="Oum El Bouaghi">Oum El Bouaghi</option>
                                <option value="Batna">Batna</option>
                                <option value="Béjaïa">Béjaïa</option>
                                <option value="Biskra">Biskra</option>
                                <option value="Béchar">Béchar</option>
                                <option value="Blida">Blida</option>
                                <option value="Bouira">Bouira</option>
                                <option value="Tamanrasset">Tamanrasset</option>
                                <option value="Tébessa">Tébessa</option>
                                <option value="Tlemcen">Tlemcen</option>
                                <option value="Tiaret">Tiaret</option>
                                <option value="Tizi Ouzou">Tizi Ouzou</option>
                                <option value="Algiers">Algiers</option>
                                <option value="Djelfa">Djelfa</option>
                                <option value="Jijel">Jijel</option>
                                <option value="Sétif">Sétif</option>
                                <option value="Saïda">Saïda</option>
                                <option value="Skikda">Skikda</option>
                                <option value="Sidi Bel Abbès">Sidi Bel Abbès</option>
                                <option value="Annaba">Annaba</option>
                                <option value="Guelma">Guelma</option>
                                <option value="Constantine">Constantine</option>
                                <option value="Médéa">Médéa</option>
                                <option value="Mostaganem">Mostaganem</option>
                                <option value="M'Sila">M'Sila</option>
                                <option value="Mascara">Mascara</option>
                                <option value="Ouargla">Ouargla</option>
                                <option value="Oran">Oran</option>
                                <option value="El Bayadh">El Bayadh</option>
                                <option value="Illizi">Illizi</option>
                                <option value="Bordj Bou Arreridj">Bordj Bou Arreridj</option>
                                <option value="Boumerdès">Boumerdès</option>
                                <option value="El Tarf">El Tarf</option>
                                <option value="Tindouf">Tindouf</option>
                                <option value="Tissemsilt">Tissemsilt</option>
                                <option value="El Oued">El Oued</option>
                                <option value="Khenchela">Khenchela</option>
                                <option value="Souk Ahras">Souk Ahras</option>
                                <option value="Tipaza">Tipaza</option>
                                <option value="Mila">Mila</option>
                                <option value="Aïn Defla">Aïn Defla</option>
                                <option value="Naâma">Naâma</option>
                                <option value="Aïn Témouchent">Aïn Témouchent</option>
                                <option value="Ghardaïa">Ghardaïa</option>
                                <option value="Relizane">Relizane</option>
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
                    <!-- apply changes button -->
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