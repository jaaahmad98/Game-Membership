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

// Retrieve the new subscription tier from the form data
$subscriptionTier = $_POST["subscriptionTier"];

$stmt = $conn->prepare("UPDATE Memberships
                        SET TierId = ?
                        WHERE UserId = ?");
$stmt->bind_param("ii", $subscriptionTier, $userId);
$result = $stmt->execute();

if ($result) {
    // Retrieve the new subscription tier name
    $tierStmt = $conn->prepare("SELECT TierName FROM Tiers WHERE TierId = ?");
    $tierStmt->bind_param("i", $subscriptionTier);
    $tierStmt->execute();
    $tierResult = $tierStmt->get_result();

    if ($tierResult && $tierResult->num_rows > 0) {
        $tierRow = $tierResult->fetch_assoc();
        $newTier = $tierRow["TierName"];

        // Return the success response with the new subscription tier as JSON
        echo json_encode(array("success" => true, "message" => "Subscription successfully updated.", "newTier" => $newTier));
    } else {
        // Error retrieving the new subscription tier name
        echo json_encode(array("success" => false, "message" => "Error retrieving new subscription tier."));
    }

    $tierStmt->close();
} else {
    // Error updating the subscription tier
    echo json_encode(array("success" => false, "message" => "Error updating subscription."));
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
