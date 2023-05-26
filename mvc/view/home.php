<section class="banner_main">
    <div class="text-bg">
        <h1>Welcome to SoukAuto</h1>
        <span>"You need Auto! there is SoukAuto!"</span>
        <p>Your platform for buying and selling and renting cars</p>
    </div>
    <div class="text_img">
        <figure>
            <img src="assets/images/mazda.png" alt="#" />
        </figure>
    </div>
</section>

<form method="post" action="index.php?action=list&see=search" class="search">
    <input type="text" name="keyword" placeholder="Search..." class="search-filter">
    <ion-icon name="search-sharp" class="search-logo"></ion-icon>
</form>
<!-- end banner -->

<!-- wedo  section -->
<div class="wedo">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <a href="#posts">
                        <p>Explore</p>
                        <ion-icon class="arrow1" name="chevron-down-outline"></ion-icon>
                        <ion-icon class="arrow2" name="chevron-down-outline"></ion-icon>
                    </a>
                </div>
            </div>
        </div>
        <div class="row" id="posts">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <?php
                    if (count($posts) > 0) {
                        foreach ($posts as $row) {
                    ?>
                            <div class="col-md-6 margin_bottom">
                                <a href="Pages/post.php?id=<?php echo $row['post_id']; ?>">
                                    <div class="work">
                                        <figure><img src="assets/<?php echo $row['url']; ?>" height="300" width="600" alt="#" /></figure>
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
        <a href="index.php?action=list">See More</a>
    </div>
</div>