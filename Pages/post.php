<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/post.css">
</head>
<?php
// Include database connection file


session_start();
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'se_project';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}


// Check if post_id parameter is set
if (!isset($_GET['id'])) {
    die('Post ID parameter is missing');
}

$post_id = $_GET['id'];

// Prepare statement
$stmt = $conn->prepare("SELECT * FROM car_selling_posts WHERE id = ?");
$stmt->bind_param("i", $post_id);

// Execute statement
$stmt->execute();
$result = $stmt->get_result();

// Check if post exists
if ($result->num_rows == 0) {
    die('Post not found');
}

// Get post data
$post = $result->fetch_assoc();

// Close statement and database connection
$stmt->close();
$conn->close();

// Output post data
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $post['title']; ?></title>
</head>

<body>
    <h1><?php echo $post['title']; ?></h1>
    <p><?php echo $post['description']; ?></p>
    <p>Price: <?php echo $post['price']; ?>$</p>
    <img src="../<?php echo $post['image_url']; ?>" alt="<?php echo $post['title']; ?>">
</body>

</html>