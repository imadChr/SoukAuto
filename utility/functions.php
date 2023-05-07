<?php
session_start();
require_once "db_connection.php";
$user_id = $_SESSION['user_id'];
function add_car($brand_id, $model_id, $fuel, $year, $mileage)
{
    global $conn;

    // Validate input data
    if (!is_numeric($year) || !is_numeric($mileage)) {
        return false;
    }

    $stmt_car = $conn->prepare("INSERT INTO car (brand_id, model_id , fuel, year, mileage ) VALUES (?, ?, ?, ?, ?)");
    $stmt_car->bind_param("iisii", $brand_id, $model_id, $fuel, $year, $mileage);

    if (!$stmt_car->execute()) {
        // Log or display error message
        error_log("Error inserting new car: " . $stmt_car->error);
        $_SESSION['message'] = "Error inserting new car";
        return false;
    }

    $inserted_id = $stmt_car->insert_id;
    $stmt_car->close();
    return $inserted_id;
}

function add_post($title, $description, $price, $user_id, $car_id, $wilaya)
{
    global $conn;

    // Validate input data
    if (!is_numeric($price)) {
        return false;
    }

    $stmt_post = $conn->prepare("INSERT INTO post (user_id, car_id , title, description, price, wilaya ) VALUES (?, ?, ?, ?, ?,?)");
    $stmt_post->bind_param("iissis", $user_id, $car_id, $title, $description, $price, $wilaya);

    if (!$stmt_post->execute()) {
        // Log or display error message
        error_log("Error inserting new car selling post: " . $stmt_post->error);
        $_SESSION['message'] = "Error inserting new car selling post";
        return false;
    }

    $inserted_id = $stmt_post->insert_id;
    $stmt_post->close();
    return $inserted_id;
}



function are_valid_pictures($pictures)
{
    if (!is_uploaded_file($pictures["tmp_name"]) || !in_array($pictures["type"], ["image/png", "image/jpeg", "image/jpg"]) || !isset($pictures["tmp_name"])) {
        return false;
    }
    return true;
}


function move_pictures_to_upload_directory($pictures)
{
    $target_dir = "../images/uploads/";
    $dir = "images/uploads/";
    $images_path = array();
    foreach ($pictures["tmp_name"] as $index => $tmp_name) {
        $target_file = $target_dir . basename($pictures["name"][$index]);
        $target = $dir . basename($pictures["name"][$index]);
        if (!move_uploaded_file($tmp_name, $target_file)) {
            error_log("Error uploading file");
            return false;
        }
        $images_path[] = $target;
    }
    return $images_path;
}

function insert_images($post_id, $targets)
{
    global $conn;
    $order = 1;
    foreach ($targets as $path) {
        $sql = "INSERT INTO images (post_id, image_order, url) VALUES ('$post_id', '$order', '$path')";
        if (!mysqli_query($conn, $sql)) {
            error_log("Error inserting image: " . mysqli_error($conn));
            return false;
        }
        $order++;
    }
    return true;
}




function logout()
{
    // Unset all of the session variables
    $_SESSION = array();
    // Destroy the session
    session_destroy();
    // Redirect to login page
    header("location: ../index.php");
    exit();
}

function validate_inputs($email, $password)
{
    if (empty($email)) {
        $_SESSION['message'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format";
    }
    if (empty($password)) {
        $_SESSION['message'] = "Password is required";
    }

    return true;
}


function login($email, $password)
{

    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row["password"];

        if (password_verify($password, $stored_password)) {
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["firstname"] = $row["firstname"];
            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION['message'] = "Invalid email address or password";
            header("Location: ../Pages/login.php");
            exit;
        }
    } else {
        $_SESSION['message'] = "Invalid email address or password";
        header("Location: login.php");
        exit;
    }
    return true;
}




function deletePost($user_id, $post_id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM car_selling_posts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $post_id, $user_id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function insert_new_user($firstname, $lastname, $email, $hashed_password, $number)
{
    global $conn;
    $sql = "INSERT INTO users (firstname, lastname, email, password, PhoneNumber) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $firstname, $lastname, $email, $hashed_password, $number);
    $success = $stmt->execute();
    $stmt->close();

    return $success;
}


function check_for_existing_user($email)
{
    global $conn;

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Handle query preparation errors
    if (!$stmt) {
        throw new Exception("Query preparation error: " . $conn->error);
    }

    $stmt->bind_param('s', $email);

    // Handle query execution errors
    if (!$stmt->execute()) {
        throw new Exception("Query execution error: " . $stmt->error);
    }

    $result = $stmt->get_result();

    return ($result->num_rows > 0);
}



function create_user($firstname, $lastname, $email, $password, $number)
{
    global $conn;
    $user_exists = check_for_existing_user($email);

    if ($user_exists) {
        $_SESSION['message'] = 'User already exists';
        $_SESSION['message_type'] = 'error';
        header("Location: ../pages/signup.php");
        exit();
    }

    // Create new user
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $success = insert_new_user($firstname, $lastname, $email, $hashed_password, $number);

    if ($success) {
        $_SESSION['message'] = 'New user created successfully';
        $_SESSION['message_type'] = 'success';
        login($email, $password);
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['message'] = 'Error creating user: ' . $conn->error;
        $_SESSION['message_type'] = 'error';
        header("Location: ../pages/signup.php");
    }
}

function validate_user_input($firstname, $lastname, $email, $password, $number)
{
    $errors = [];

    if (empty($firstname)) {
        $_SESSION['message'] = 'Please enter your first name.';
    } else if (!preg_match('/^([a-zA-Z]+ ?){1,3}$/', $firstname)) {
        $_SESSION['message'] = 'Please enter a valid first name using only letters.';
    }

    if (empty($lastname)) {
        $_SESSION['message'] = 'Please enter your last name.';
    } else if (!preg_match('/^[a-zA-Z]+$/', $lastname)) {
        $_SESSION['message'] = 'Please enter a valid last name using only letters.';
    }

    if (empty($email)) {
        $_SESSION['message'] = 'Please enter your email address.';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Please enter a valid email address.';
    }

    if (empty($password)) {
        $_SESSION['message'] = 'Please enter a password.';
    } else if (strlen($password) < 8) {
        $_SESSION['message'] = 'Password must be at least 8 characters long.';
    }

    if (empty($number)) {
        $_SESSION['message'] = 'Please enter your phone number.';
    } else if (!preg_match('/^\d+$/', $number)) {
        $_SESSION['message'] = 'Please enter a valid phone number using only digits.';
    }

    return true;
}

function display_errors($errors)
{
    foreach ($errors as $error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
}

function generatePaginationLink($page, $current_page)
{
    $class = ($page == $current_page) ? 'active' : '';
    return "<li class='page-item $class'><a class='page-link' href='all_posts.php?page=$page'>$page</a></li>";
}

function addFavourite($user_id, $post_id)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO favourites (user_id, post_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $post_id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}


// Function to fetch models based on selected brand
function get_models()
{
    $brand_id = $_POST["brand_id"];
    // Connect to the database
    global $conn;
    // Query the database to get the list of models that belong to the selected brand
    $sql = "SELECT model_id, model_name from model WHERE brand_id='$brand_id' GROUP BY model_name order by model_name asc";
    $result = mysqli_query($conn, $sql);

    // Create an HTML string that contains the list of models
    $models_html = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $model_name = $row["model_name"];
        $model_id = $row["model_id"];
        $models_html .= "<option value='" . $model_id . "'>" . $model_name . "</option>";
    }
    // Return the HTML string as the response
    echo $models_html;
}

// Call the appropriate function based on the "action" parameter
if ($_REQUEST["action"] == "getModels") {
    get_models();
}
if ($_REQUEST["action"] == "addtofavorites") {
    addToFavorites($_POST["post_id"]);
}

function addToFavorites($post_id)
{
    $user_id = $_SESSION['user_id'];
    global $conn;
    // check if the post is already in the user's favorites
    $sql = "SELECT * FROM favorites WHERE post_id = $post_id AND user_id = $user_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        // add the post to the user's favorites
        $sql = "INSERT INTO favorites (post_id, user_id) VALUES ($post_id, $user_id)";
        mysqli_query($conn, $sql);

        echo 'added';
    } else {
        // remove the post from the user's favorites
        $sql = "DELETE FROM favorites WHERE post_id = $post_id AND user_id = $user_id";
        mysqli_query($conn, $sql);

        echo 'removed';
    }
}
