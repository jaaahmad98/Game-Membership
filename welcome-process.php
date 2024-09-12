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

// Prepare and execute a parameterized query to fetch the user information
$stmt = $conn->prepare("SELECT Users.UserId, Users.Name, Users.Email, Users.ProfilePicture, Games.GameName, Tiers.TierName
                        FROM Users 
                        JOIN Memberships ON Users.UserId = Memberships.UserId
                        JOIN Games ON Memberships.GameId = Games.GameId
                        JOIN Tiers ON Memberships.TierId = Tiers.TierId
                        WHERE Users.UserId = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["Name"];
        $email = $row["Email"];
        $profilePicture = $row["ProfilePicture"];
        $gameInterest = $row["GameName"];
        $tier = $row["TierName"];

        // Update the session variables with the user information
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["profilePicture"] = $profilePicture;

        // Create an array with the user information
        $userInfo = array(
            "userId" => $userId,
            "name" => $name,
            "email" => $email,
            "profilePicture" => $profilePicture,
            "gameInterest" => $gameInterest,
            "tier" => $tier
        );

        // Return the user information as JSON response
        header("Content-Type: application/json");
        echo json_encode($userInfo);
    } else {
        // User not found in the database, redirect to the sign-in page
        echo "User not found";
        exit();
    }
} else {
    // Error executing the database query
    echo "Error: " . $conn->error;
    exit();
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
