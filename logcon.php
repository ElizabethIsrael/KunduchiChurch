<?php
// Database connection details
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    


    // Sanitize inputs to prevent SQL injection
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Query to check if the user exists with the provided email and password
    $query = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result) {
        // If a user is found, start a session
        if ($result->num_rows > 0) {
            session_start();
            $_SESSION['email'] = $email;
            echo "Login successful. Welcome, " . htmlspecialchars($email) . "!";
            // Redirect to a protected page
            header("Location: admin.php");
            exit(); // Make sure to exit after header redirection
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Query failed: " . $conn->error;
    }

    // Free result memory
    $result->free();
}
else{
    echo "no data submitted";
}

// Close the connection
$conn->close();
?>
