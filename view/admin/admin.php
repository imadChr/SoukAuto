<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="assets/css/admin.css" rel="stylesheet">
    <title>SoukAuto Admin Dashboard</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h5 class="text-bg"><span>ADMIN DASHBOARD</span></h5>
            </div>
            <a href="index.php"><button class="btn">Go Back</button>
        </div>
        <?php if (count($posts) > 0) { ?>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="alert alert-warning">
                        <strong>Warning!</strong> There are <?php echo count($posts); ?> posts waiting for approval.
                    </div>
                </div>
            </div>
            <br>

            <div class="table-responsive">
                <table class="table table-bordered table-hover custom-table">
                    <thead>
                        <tr style="background-color: #4e88af; color: #fff;">
                            <th class="no-content-size">User ID</th>
                            <th>Post Date</th>
                            <th>Post Link</th>
                            <th class="centered-buttons no-content-size">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post) { ?>
                            <tr id="post-<?php echo $post['post_id']; ?>">
                                <td class="no-content-size"> <?php echo $post['firstname']; ?> </td>
                                <td> <?php echo $post['date']; ?></td>
                                <td><a href="index.php?action=post&id=<?php echo $post['post_id']; ?>">View Post</a></td>
                                <td class="centered-buttons no-content-size">
                                    <button class="btn btn-success mx-1" onclick="approvePost(<?php echo $post['post_id']; ?>)"><i class="ion-checkmark"></i></button>
                                    <button class="btn btn-danger mx-1" onclick="deletePost(<?php echo $post['post_id']; ?>)"><i class="ion-close"></i></button>
                                </td>
                            </tr>
                        <?php                    } ?>
                    </tbody>
                </table>
            </div>
        <?php        } else { ?>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="alert alert-success">
                        <strong>Success!</strong> There are no posts waiting for approval.
                    </div>
                </div>
            </div>
        <?php        } ?>

    </div>

</body>
<script>
    function approvePost(post_id) {
        $.ajax({
            url: 'index.php?action=approvePost',
            type: 'POST',
            data: {
                post_id: post_id,
            },
            success: function(response) {
                if (response == 'approved') {
                    //delete the post from the table 
                    $('#post-' + post_id).remove();
                }

            }
        });
    }

    function deletePost(post_id) {
        $.ajax({
            url: 'index.php?action=deletePost',
            type: 'POST',
            data: {
                post_id: post_id,
            },
            success: function(response) {
                alert(response);

                //delete the post from the table 
                $('#post-' + post_id).remove();
            }
        });
    }
</script>


</html>