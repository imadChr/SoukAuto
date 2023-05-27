<section class="banner_main">
    <div class="container mt-1">
        <br><br>
        <div class="row">
            <div class="col-lg-6 text_img">
                <div class="text-bg">
                    <span class="flex">" Get Behind the Wheel of Your Dreams with <mark style="color:#205375; background:none;">SoukAuto</mark>! "</span>
                    <p>Your destination for purchasing & renting cars.</p>
                </div>

                <br>
                <div class="text-center">
                    <div class="d-inline-block">
                        <a class="button1 mx-3" href="index.php?action=list">BUY</a>
                        <a class="button1 mx-3" href="index.php?action=list">RENT</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text_img">
                <figure>
                    <img src="assets/images/mazda.png" alt="#" />
                </figure>
            </div>
        </div>
    </div>
</section>


<section>
    <br><br>
    <form method="post" action="index.php?action=list&see=search" class="search mt-4">
        <input type="text" name="keyword" placeholder="Search..." class="search-filter">
        <ion-icon name="search-sharp" class="search-logo"></ion-icon>
    </form>
</section>

<!-- end banner -->

<!-- wedo section -->
<div class="wedo">
    <!-- DISCOVER SALE -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <a href="#posts">
                        <p>Purchase Your Dream Car</p>
                        <ion-icon class="arrow1" name="chevron-down-outline"></ion-icon>
                        <ion-icon class="arrow2" name="chevron-down-outline"></ion-icon>
                    </a>
                </div>
            </div>
        </div>
        <div class="row" id="posts">
            <div class="col-md-12">
                <div class="row">
                    <?php
                    if (count($posts) > 0) {
                        foreach ($posts as $row) {
                    ?>

                            <div class="col-md-4 margin_bottom">
                                <a href="Pages/post.php?id=<?php echo $row['post_id']; ?>">
                                    <div class="work text-center square-image">
                                        <img src="assets/<?php echo $row['url']; ?>" class="rounded img-fluid square-image" alt="#">
                                    </div>
                                    <div class="work_text">
                                        <h3><?php echo $row['title']; ?><br /><span class="blu"><?php echo $row['price']; ?></span></h3>
                                    </div>
                                </a>
                            </div>

                    <?php
                        }
                    } else {
                        echo "<h1> No posts yet </h1>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <br><br>

    <!-- DISCOVER RENT-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <a href="#posts">
                        <p>Or Just Rent it!</p>
                        <ion-icon class="arrow1" name="chevron-down-outline"></ion-icon>
                        <ion-icon class="arrow2" name="chevron-down-outline"></ion-icon>
                    </a>
                </div>
            </div>
        </div>
        <div class="row" id="posts">
            <div class="col-md-12">
                <div class="row">
                    <?php
                    if (count($posts) > 0) {
                        foreach ($posts as $row) {
                    ?>

                            <div class="col-md-4 margin_bottom">
                                <a href="Pages/post.php?id=<?php echo $row['post_id']; ?>">
                                    <div class="work text-center square-image">
                                        <img src="assets/<?php echo $row['url']; ?>" class="rounded img-fluid square-image" alt="#">
                                    </div>
                                    <div class="work_text">
                                        <h3><?php echo $row['title']; ?><br /><span class="blu"><?php echo $row['price']; ?></span></h3>
                                    </div>
                                </a>
                            </div>

                    <?php
                        }
                    } else {
                        echo "<h1> No posts yet </h1>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>