<?php
error_reporting(E_ERROR | E_PARSE);
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
    if (!is_uploaded_file($pictures["tmp_name"]) || !in_array($pictures["type"], ["image/png", "image/jpeg", "image/jpg"])) {
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
        move_uploaded_file($tmp_name, $target_file);
        $images_path[] = $target;
    }
    return $images_path;
}


function insert_images($post_id, $targets)
{
    global $conn;
    // Insert each image into the database.
    $order = 1;
    foreach ($targets as $path) {
        $sql = "INSERT INTO images (post_id, image_order, url) VALUES ('$post_id', '$order', '$path')";
        if (!mysqli_query($conn, $sql)) {
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

    if (validate_inputs($email, $password)) {

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
                return true;
            } else {
                $_SESSION['message'] = "Invalid email address or password";
                header("Location: ../Pages/login.php");
                exit;
            }
        } else {
            $_SESSION['message'] = "Invalid email address or password";
            header("Location: ../Pages/login.php");
            exit;
        }
    }
}


function deletePost($user_id, $post_id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM car_selling_posts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $post_id, $user_id);

    return $stmt->execute();
}

function insert_new_user($firstname, $lastname, $email, $hashed_password, $number, $wilaya)
{
    global $conn;
    $sql = "INSERT INTO users (firstname, lastname, email, password, PhoneNumber , wilaya) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $firstname, $lastname, $email, $hashed_password, $number, $wilaya);
    return $stmt->execute();
}


function check_for_existing_user($email)
{
    global $conn;

    // Get the user with the given email address.
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('s', $email);

    $stmt->execute();

    $result = $stmt->get_result();

    // Return true if the user exists, false otherwise.
    return ($result->num_rows > 0);
}



function create_user($firstname, $lastname, $email, $password, $number, $wilaya)
{
    global $conn;

    // Check if user exists
    $user_exists = check_for_existing_user($email);

    if ($user_exists) {
        $_SESSION['message'] = 'User already exists';
        $_SESSION['message_type'] = 'error';
        header("Location: ../Pages/signup.php");
        exit();
    }

    // Create new user
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $success = insert_new_user($firstname, $lastname, $email, $hashed_password, $number, $wilaya);

    if ($success) {
        $_SESSION['message'] = 'New user created successfully';
        $_SESSION['message_type'] = 'success';
        login($email, $password);
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['message'] = 'Error creating user: ' . $conn->error;
        $_SESSION['message_type'] = 'error';
        header("Location: ../Pages/signup.php");
    }
}

function validate_user_input($firstname, $lastname, $email, $password, $number)
{
    if (empty($firstname)) {
        return "Please enter your first name.";
    } else if (!preg_match('/^([a-zA-Z]+ ?){1,3}$/', $firstname)) {
        return "Please enter a valid first name using only letters.";
    }

    if (empty($lastname)) {
        return "Please enter your last name.";
    } else if (!preg_match('/^[a-zA-Z]+$/', $lastname)) {
        return "Please enter a valid last name using only letters.";
    }

    if (empty($email)) {
        return "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Please enter a valid email address.";
    }

    if (empty($password)) {
        return "Please enter a password.";
    } else if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }

    if (empty($number)) {
        return "Please enter your phone number.";
    } else if (!preg_match('/^\d+$/', $number)) {
        return "Please enter a valid phone number using only digits.";
    }

    return true;
}

// Call the appropriate function based on the "action" parameter
if ($_REQUEST["action"] == "getModels") {
    get_models();
}
if ($_REQUEST["action"] == "addtofavorites") {
    addToFavorites($_POST["post_id"]);
}

// Function to fetch models based on selected brand
function get_models()
{
    $brand_id = $_POST["brand_id"];
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


function addtoFavorites($post_id)
{
    $user_id = $_SESSION['user_id'];
    global $conn;
    // Create an associative array to store the response
    $response = array();

    // check if the post is already in the user's favorites
    $sql = "SELECT * FROM favorites WHERE post_id = $post_id AND user_id = $user_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        // add the post to the user's favorites
        $sql = "INSERT INTO favorites (post_id, user_id) VALUES ($post_id, $user_id)";
        if (mysqli_query($conn, $sql)) {
            $response['status'] = 'added';
            $response['message'] = 'Post added to favorites';
            
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to add post to favorites';
        }
    } else {
        // remove the post from the user's favorites
        $sql = "DELETE FROM favorites WHERE post_id = $post_id AND user_id = $user_id";
        if (mysqli_query($conn, $sql)) {
            $response['status'] = 'removed';
            $response['message'] = 'Post removed from favorites';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to remove post from favorites';
        }
    }
    // Send the JSON response back to the client
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}


