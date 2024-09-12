<?php
// Establish a database connection (replace the placeholders with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gameInterest = $_POST["game-interest"];
    $membershipTier = $_POST["membership-tier"];

    // File upload handling
    $targetDir = "uploads/"; // Directory to store the uploaded files
    $targetFile = $targetDir . basename($_FILES["profile-picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image or a fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["profile-picture"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if the file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, the file already exists.";
        $uploadOk = 0;
    }

    // Check file size (limit to 1MB)
    if ($_FILES["profile-picture"]["size"] > 1000000) {
        echo "Sorry, the file is too large. Please upload a file up to 1MB in size.";
        $uploadOk = 0;
    }

    // Allow only specific file formats
    if (
        $imageFileType != "jpg" &&
        $imageFileType != "jpeg" &&
        $imageFileType != "png" &&
        $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // If the file upload is valid, move the file to the target directory
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $targetFile)) {
            // Insert user data into the database
            $sql = "INSERT INTO users (Name, Email, Password, ProfilePicture)
                    VALUES ('$name', '$email', '$password', '$targetFile')";

            if ($conn->query($sql) === TRUE) {
                // Retrieve the newly created user's UserId
                $userId = $conn->insert_id;

                // Retrieve the GameId based on the selected game interest
                $gameId = 0;
                if ($gameInterest == "valorant") {
                    $gameId = 1;
                } elseif ($gameInterest == "apex-legends") {
                    $gameId = 2;
                } elseif ($gameInterest == "csgo") {
                    $gameId = 3;
                }

                // Retrieve the TierId based on the selected membership tier
                $tierId = 0;
                if ($membershipTier == "standard") {
                    $tierId = 1;
                } elseif ($membershipTier == "premium") {
                    $tierId = 2;
                } elseif ($membershipTier == "vip") {
                    $tierId = 3;
                }

                // Insert membership data into the memberships table
                $membershipSql = "INSERT INTO memberships (UserId, GameId, TierId)
                                  VALUES ($userId, $gameId, $tierId)";

                if ($conn->query($membershipSql) === TRUE) {
                    echo "<script>alert('Successfully signed up.');</script>";
                } else {
                    echo "Error creating membership: " . $conn->error;
                }

                // Redirect to the desired page
                echo "<script>window.location.href = 'signin.html';</script>";
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close the database connection
$conn->close();
?>
