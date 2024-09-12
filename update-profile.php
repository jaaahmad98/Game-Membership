<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION["userId"])) {
    // User not logged in, redirect to the sign-in page
    header("Location: signin.html");
    exit();
}

// Fetch the user information from the session variable
$userId = $_SESSION["userId"];

// Retrieve form data
$name = $_POST["name"];
$email = $_POST["email"];
$gameInterest = $_POST["gameInterest"];
$password = $_POST["password"];

// Prepare and execute a parameterized query to update the user information
$stmt = $conn->prepare("UPDATE users
                        SET Name = ?, Email = ?, Password = ?
                        WHERE UserId = ?");
$stmt->bind_param("sssi", $name, $email, $password, $userId);
$result = $stmt->execute();

if ($result) {
    // Update successful

    // Update the game interest in the memberships table
    $stmt = $conn->prepare("UPDATE memberships
                            SET GameId = ?
                            WHERE UserId = ?");
    $stmt->bind_param("ii", $gameInterest, $userId);
    $result = $stmt->execute();

    if ($result) {
        // Game interest updated successfully
        echo "Success"; // Return "Success" as the response
    } else {
        // Error updating game interest
        echo "Error updating game interest.";
    }
} else {
    // Error updating user information
    echo "Error updating profile.";
}

// Close the prepared statements
$stmt->close();

// Close the database connection
$conn->close();
?>
