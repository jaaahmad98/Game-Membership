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
$stmt = $conn->prepare("SELECT u.UserId, u.Name, u.Email, m.GameId, m.TierId
                        FROM users AS u
                        JOIN memberships AS m ON u.UserId = m.UserId
                        WHERE u.UserId = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userInfo = array(
            "userId" => $row["UserId"],
            "name" => $row["Name"],
            "email" => $row["Email"],
            "gameInterest" => $row["GameId"],
            "tierId" => $row["TierId"]
        );

        // Return the user information as JSON response
        header("Content-Type: application/json");
        echo json_encode($userInfo);
    } else {
        // User not found in the database, redirect to the sign-in page
        echo "User not found.";
    }
} else {
    // Error executing the database query
    echo "Error: " . $conn->error;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
