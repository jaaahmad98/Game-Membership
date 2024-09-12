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

// Retrieve the user ID from the session
$userId = $_SESSION["userId"]; // Replace with the actual session variable name

// Retrieve the user's chosen game from the memberships table based on user ID
$query = "SELECT GameId FROM memberships WHERE UserId = $userId";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $userChosenGame = $row["GameId"];

  // Retrieve the limited edition skins specific to the user's chosen game
  $query = "SELECT * FROM skins WHERE GameId = $userChosenGame";
  $result = $conn->query($query);

  $skins = array();
  if ($result->num_rows > 0 ) {
    while ($row = $result->fetch_assoc()) {
      $skins[] = array(
        "SkinName" => $row["SkinName"],
        "SkinImage" => $row["SkinImage"],
        "SkinDescription" => $row["SkinDescription"]
      );
    }
  }

   // Create the final response array with the gameInterest and skins
   $response = array(
    "gameId" => $userChosenGame,
    "skins" => $skins
);

  // Return the JSON response
  header('Content-Type: application/json');
  echo json_encode($skins);
} else {
  echo "No chosen game found.";
}

// Close the connection
$conn->close();
?>
