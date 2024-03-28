<?php
// Database connection
$db = new mysqli('localhost', 'phpmyadmin', 'T3st4321', 'test');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Fetch user details from the POST request
$username = $_POST['username'];
$password = $_POST['password']; // This should be the password entered by the user

// Generate a random salt
$salt = bin2hex(random_bytes(16)); // Generate a 16-byte salt

// Hash the password with the salt
$hashedPassword = password_hash($password . $salt, PASSWORD_DEFAULT);

// Insert the user into the database
$sql = "INSERT INTO test (username, password, salt) VALUES ('$username', '$hashedPassword', '$salt')";
if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();
?>

