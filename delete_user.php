<?php
// Assuming you have a database connection, update the following variables with your database details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the userId parameter is set
if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Delete user from memberships table
    $deleteMembershipsQuery = "DELETE FROM memberships WHERE UserId = ?";
    $deleteMembershipsStmt = $conn->prepare($deleteMembershipsQuery);
    $deleteMembershipsStmt->bind_param("i", $userId);
    $deleteMembershipsStmt->execute();
    $deleteMembershipsStmt->close();

    // Delete user from users table
    $deleteUserQuery = "DELETE FROM users WHERE UserId = ?";
    $deleteUserStmt = $conn->prepare($deleteUserQuery);
    $deleteUserStmt->bind_param("i", $userId);
    $deleteUserStmt->execute();
    $deleteUserStmt->close();

    // Send success response
    echo "User deleted successfully.";
} else {
    // Send error response
    echo "User ID not provided.";
}

// Close the database connection
$conn->close();
?>
