<?php
// Start the session
session_start();

// Connect to the database
$mysqli = new mysqli('localhost', 'phpmyadmin', 'T3st4321', 'test');

// Check for errors
if ($mysqli->connect_error) {
    die("Connection failed: ". $mysqli->connect_error);
}

// Check if the login form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Prepare and execute the query to find the user's hashed password
    $stmt = $mysqli->prepare("SELECT password FROM test WHERE username =?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the username exists and fetch the hashed password
    if ($result->num_rows > 0) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $storedHashedPassword = $row['password'];
    } else {
        echo "No user found with that username.";
        exit;
    }
    // Compare the hashes
    if (password_verify($password, $storedHashedPassword)) {
        // Password is correct, start a session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        echo "Login successful";

        // Redirect to a protected page or dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Incorrect password!";
    }
    // checking if all inputs are empty
    if (empty($username) && empty($password)) {
        // Encode the error message to ensure it's URL-safe
        $errorMessage = urlencode("Username can't be empty!");
        $errorMessage2 = urlencode("Password can't be empty!");
        // Redirect to index.php with the error message as a query parameter
        header("Location: index.php?username_error=" . $errorMessage . "&password_error=" . $errorMessage2);
        http_response_code(302);
        exit();
    }

//check if empty
    if (empty($username)) {
        // Encode the error message to ensure it's URL-safe
        $errorMessage = urlencode("Username can't be empty!");
        // Redirect to index.php with the error message as a query parameter
        header("Location: index.php?username_error=" . $errorMessage);
        http_response_code(302);
        exit();
    }

// checking if password is empty
    if (empty($password)) {
        // Encode the error message to ensure it's URL-safe
        $errorMessage = urlencode("Password can't be empty!");
        // Redirect to index.php with the error message as a query parameter
        header("Location: index.php?password_error=" . $errorMessage);
        http_response_code(302);
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $mysqli->close();
}
?>
