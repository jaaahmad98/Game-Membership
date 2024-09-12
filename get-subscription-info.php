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

// Fetch the user's current subscription tier from the memberships table
$userId = $_SESSION["userId"];

$stmt = $conn->prepare("SELECT Memberships.TierId, Tiers.TierName
                        FROM Memberships
                        JOIN Tiers ON Memberships.TierId = Tiers.TierId
                        WHERE Memberships.UserId = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentTier = $row["TierName"];

        // Return the current subscription tier as JSON response
        header("Content-Type: application/json");
        echo json_encode(array("success" => true, "currentTier" => $currentTier));
    } else {
        // User's subscription not found in the database
        echo json_encode(array("success" => false, "message" => "Subscription not found."));
    }
} else {
    // Error executing the database query
    echo json_encode(array("success" => false, "message" => "Error: " . $conn->error));
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
