<head>
    <title><?php echo $post['title'] ?></title>
    <!-- Latest compiled JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/post.css">
    <link rel="stylesheet" href="assets/css/lightbox.min.css">
    <style>
        body{
            background-color: white !important;
        }
    </style>
</head>
<div class="car-container" >
    <h1 class="car-title inline-item"><?php echo $post['title']; ?></h1>
    <h2 class="car-price inline-item">Price: <?php echo $post['price']; ?>DA</h2>
    <p class="car-description"><?php echo $post['description']; ?></p>

    <div class="image-container">
        <div class="big">
            <a href="assets/<?php echo $post['url']; ?>" data-lightbox="gallery" data-title="<?php $post['title']; ?>">
                <img class="big-image" src="assets/<?php echo $post['url']; ?>" alt="Main Picture">
            </a>
        </div>
        <div class="small-images">
            <?php
            $index = 0;
            foreach ($images as $image) {
                echo '<div class="column">';
                echo '<a href="assets/' . $image['url'] . '" data-lightbox="gallery" data-title=' . $post['title'] . '>';
                echo '<img src="assets/' . $image['url'] . '" alt="Small Picture">';
                echo '</a>';
                echo '</div>';
                $index++;
            }
            ?>
        </div>
    </div>

    <ul class="car-info">
        <li><strong style="font-size:30px;"><br>Specifications<br></strong></li>
        <div class="row">
            <li class="col-md-6"><strong>Brand:</strong> <?php echo $post['brand']; ?></li>
            <li class="col-md-6"><strong>Model:</strong> <?php echo $post['model_name']; ?></li>
        </div>
        <div class="row">
            <li class="col-md-6"><strong>Mileage:</strong> <?php echo $post['mileage']; ?> km</li>
            <li class="col-md-6"><strong>Fuel Type:</strong> <?php echo $post['fuel']; ?></li>
        </div>
        <div class="row">
            <li class="col-md-6"><strong>Wilaya:</strong> <?php echo $post['wilaya']; ?></li>
            <li class="col-md-6"><strong>Year:</strong> <?php echo $post['year']; ?></li>
        </div>
    </ul>
    <div class="row">
        <div class="col-md-10">
            <button class="btn" onclick="contactSeller(<?php echo $row['user_id'] ?>)" role="button" style="font-size:25px; padding:+1%;background-color:#ed6c15; color:white !important;">
                <span><ion-icon name="person-outline"></ion-icon> Contact Seller</span>
            </button>
        </div>
        <span class="col-md-2" style="color: white; font-size:20px; margin-top:10px;"><?php echo date('d/m/Y', strtotime($post['date'])); ?></span>
    </div>
</div>
<br><br>
<div class="comment-section">
    <div class="wrapper">
        <h2>Add a comment</h2>
        <textarea name="message" id="comment" cols="30" rows="10" class="message" placeholder="Message"></textarea>
        <br>
        <?php if (isset($appuser['user_id'])) { ?>
            <button type="button" class="btn-comment" name="post_comment" onclick="addcomment(<?php echo $appuser['user_id']; ?>, <?php echo $post['post_id']; ?>)">Post Comment</button>
        <?php  } else { ?>
            <a href="index.php?action=login&redirect=action=post?id=<?php echo intval($post_id); ?>">Log in to Post Comment</a>
        <?php } ?>
    </div>
    <div class="comments">
        <?php
        if (count($comments) > 0) {
            foreach ($comments as $row) {
        ?>
                <div class="comment" id="comment-<?php echo $row['comment_id']; ?>">
                    <div class="date">
                        <p><?php echo date('d/m/Y', strtotime($row['date_posted'])); ?></p>
                    </div>
                    <div class="name">
                        <h3><?php echo $row['firstname']; ?></h3>
                    </div>
                    <p><?php echo $row['message']; ?></p>
                    <!-- Delete button -->
                    <?php if (isset($appuser['user_id']) && $appuser['user_id'] == $row['user_id']) { ?>
                        <button type="button" class="btn-comment" onclick="deletecomment(<?php echo $row['comment_id']; ?>,  <?php echo $post['post_id']; ?>)">Delete</button>
                    <?php } ?>
                </div>
            <?php
            }
            ?>
    </div>
<?php  } else {
?>
    <div class="comment">
        <h3 class="no-comment">Be the first to comment!</h3>
    </div>
<?php
        }
?>
</div>

<script>
    function addcomment(user_id, post_id) {
        var message = document.getElementById("comment").value;
        $.ajax({
            url: 'index.php?action=addcomment',
            type: 'POST',
            data: {
                user_id: user_id,
                post_id: post_id,
                message: message
            },
            success: function(response) {
                // remove the deleted comment from the page
                $('#comment').val('');
                // Prepend the new comment
                var newComment = $(response);
                $('.comments').prepend(newComment);

                // Hide the new comment temporarily
                newComment.hide();

                // Slide in the new comment from the side
                newComment.slideDown(400, function() {
                    newComment.css({
                        'margin-left': '',
                        'margin-top': ''
                    });
                });
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

    function deletecomment(comment_id, post_id) {
        $.ajax({
            url: 'index.php?action=deletecomment',
            type: 'POST',
            data: {
                comment_id: comment_id,
                post_id: post_id
            },
            success: function(response) {
                // remove the deleted comment from the page
                $('#comment-' + comment_id).remove();
            }
        });
    }
</script>
<script src="assets/js/lightbox-plus-jquery.min.js"></script>