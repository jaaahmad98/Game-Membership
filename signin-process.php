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

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare the SQL statement with placeholders
    $sql = "SELECT * FROM users WHERE Email = ? AND Password = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind the parameters to the placeholders
    $stmt->bind_param("ss", $email, $password);
    
    // Execute the prepared statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found
        $row = $result->fetch_assoc();
        $userId = $row["UserId"];
        $role = $row["Role"];

        if ($role == 'admin') {
            // Admin sign-in
            $_SESSION["adminId"] = $userId;
            header("Location: admin_page.php");
            exit();
        } else {
            // Regular user sign-in
            $_SESSION["userId"] = $userId;
            header("Location: welcome.html");
            exit();
        }
    } else {
        // Invalid email or password
        echo "<script>alert('Invalid email or password.');</script>";
        echo "<script>window.location.replace('signin.html');</script>";
        exit();
    }
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();
?>
