<?php
// Database connection
$db = new mysqli('localhost', 'phpmyadmin', 'T3st4321', 'test');

// Check connection
if ($db->connect_error) {
    error_log("Connection failed: " . $db->connect_error);
    exit();
}

// Fetch user details from the POST request
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password']; // This should be the password entered by the user
$confirmpassword = $_POST['confirm_password'];

// checking if all inputs are empty
if (empty($username) && empty($password) && empty($email) && empty($confirmpassword)) {
    // Encode the error message to ensure it's URL-safe
    $errorMessage = urlencode("Username can't be empty!");
    $errorMessage2 = urlencode("Password can't be empty!");
    $errorMessage3 = urlencode("Email can't be empty!");
    $errorMessage4 = urlencode("Confirm password can't be empty!");
    // Redirect to index.php with the error message as a query parameter
    header("Location: signuppage.php?username_error=" . $errorMessage . "&password_error=" . $errorMessage2 . "&email_error=" . $errorMessage3 . "&confirmpassword_error=" .$errorMessage4);
    http_response_code(302);
    exit();
}
// checking if confirm password and password is the same
if  ($confirmpassword !== $password){
    http_response_code(302);
    $errorMessage = urlencode("Passwords are not the same!");
    header("location: signuppage.php?confirmpassword_error=$errorMessage");
    exit(400);

}
//check if empty
if (empty($username)) {
    // Encode the error message to ensure it's URL-safe
    $errorMessage = urlencode("Username can't be empty!");
    // Redirect to index.php with the error message as a query parameter
    header("Location: signuppage.php?username_error=" . $errorMessage);
    http_response_code(302);
    exit();
}

// checking if password is empty
if (empty($password)) {
    // Encode the error message to ensure it's URL-safe
    $errorMessage = urlencode("Password can't be empty!");
    // Redirect to index.php with the error message as a query parameter
    header("Location: signuppage.php?password_error=" . $errorMessage);
    http_response_code(302);
exit();
}

//check if empty
if (empty($email)) {
    // Encode the error message to ensure it's URL-safe
    $errorMessage = urlencode("Email can't be empty!");
    // Redirect to index.php with the error message as a query parameter
    header("Location: signuppage.php?email_error=" . $errorMessage);
    http_response_code(302);
exit();
}

// checking if email is valid
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMessage = urlencode("Please fill in a valid email!");
    header("Location: signuppage.php?email_error=" . $errorMessage);
}

//checking if confirmpassword is empty
if (empty($confirmpassword)) {
    // Encode the error message to ensure it's URL-safe
    $errorMessage = urlencode("confirm password can't be empty!");
    // Redirect to index.php with the error message as a query parameter
    header("Location: signuppage.php?confirmpassword_error=" . $errorMessage);
    http_response_code(302);
    exit();
}

// Generate a random salt
try {
    $salt = bin2hex(random_bytes(16));
} catch (Exception $e) {
    $errorMessage = urlencode("Salt has failed try agian later");
    header("Location: signuppage.php?Salt_Error=" . $errorMessage);
    http_response_code(302);
exit();
}

// Generate a 16-byte salt
error_log("Salt completed");
// Hash the password with the salt

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
var_dump($password, $salt, $hashedPassword);
// Insert the user into the database
$sql = "INSERT INTO test (username, email ,password) VALUES ('$username', '$email', '$hashedPassword')";
if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();