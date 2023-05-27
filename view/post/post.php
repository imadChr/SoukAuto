<head>
    <title><?php echo $post['title'] ?></title>
    <link rel="stylesheet" href="assets/css/post.css">
</head>
<div class="car-container">
    <h1 class="car-title"><?php echo $post['title']; ?></h1>
    <p class="car-description"><?php echo $post['description']; ?></p>
    <h2 class="car-price">Price: <?php echo $post['price']; ?>DA</h2>

    <div class="image-container">
        <img class="big-image" src="assets/<?php echo $post['url']; ?>" alt="Main Picture">
        <div class="small-images">
            <?php
            foreach ($images as $image) {
                echo '<div class="column">';
                echo '<img src="assets/' . $image['url'] . '" alt="Small Picture">';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <ul class="car-info">
        <li><strong><br>Specifications<br><br></strong></li>
        <li><strong>Brand:</strong> <?php echo $post['brand']; ?></li>
        <li><strong>Brand:</strong> <?php echo $post['post_id']; ?></li>

        <li><strong>Model:</strong> <?php echo $post['model_name']; ?></li>
        <li><strong>Fuel Type:</strong> <?php echo $post['fuel']; ?></li>
        <li><strong>Year:</strong> <?php echo $post['year']; ?></li>
        <li><strong>Mileage:</strong> <?php echo $post['mileage']; ?> km</li>
        <li><strong>Wilaya:</strong> <?php echo $post['wilaya']; ?></li>
        <li><strong>Date of post:</strong> <?php echo date('d/m/Y', strtotime($post['date'])); ?></li>
    </ul>
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