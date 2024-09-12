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

// Function to delete a user from the database
function deleteUser($userId) {
    global $conn;

    // Delete the user from the memberships table
    $deleteMembershipStmt = $conn->prepare("DELETE FROM memberships WHERE UserId = ?");
    $deleteMembershipStmt->bind_param("i", $userId);
    $deleteMembershipStmt->execute();
    $deleteMembershipStmt->close();

    // Delete the user from the users table
    $deleteUserStmt = $conn->prepare("DELETE FROM users WHERE UserId = ?");
    $deleteUserStmt->bind_param("i", $userId);
    $deleteUserStmt->execute();
    $deleteUserStmt->close();
}

// Fetch the user list from the database
$sql = "SELECT UserId, Email, Name, ProfilePicture, Role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - User List</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
        .admin-page {
            padding: 50px;
        }
        .user-list-table {
            width: 100%;
        }
        .user-list-table th,
        .user-list-table td {
            padding: 10px;
            text-align: center;
        }
        .user-list-table th {
            background-color: #f8f5f5;
        }
        .delete-button {
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="logo.png" alt="Logo" width="50" height="50">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link logout-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Admin Page Section -->
    <section class="admin-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h2 class="mb-4 text-center">User List</h2>
                    <table class="table user-list-table">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Profile Picture</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                // Output data for each user
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["UserId"] . "</td>";
                                    echo "<td>" . $row["Email"] . "</td>";
                                    echo "<td>" . $row["Name"] . "</td>";
                                    echo "<td>" . $row["ProfilePicture"] . "</td>";
                                    echo "<td>" . $row["Role"] . "</td>";
                                    echo "<td>";
                                    if ($row["Role"] === "admin") {
                                        // Display a disabled delete button for admin users
                                        echo "<button class='btn btn-danger delete-button' disabled>Delete</button>";
                                    } else {
                                        // Display the delete button for non-admin users
                                        echo "<button class='btn btn-danger delete-button' onclick='deleteUser(" . $row["UserId"] . ")'>Delete</button>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                // No users found
                                echo "<tr><td colspan='6'>No users found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript function to handle user deletion -->
    <script>
        function deleteUser(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                // Send an AJAX request to delete the user
                $.ajax({
                    url: "delete_user.php",
                    type: "POST",
                    data: { userId: userId },
                    success: function(response) {
                        if (response === "User deleted successfully.") {
                            // Reload the page to reflect the updated list
                            location.reload();
                        } else {
                            alert("Failed to delete the user.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert("An error occurred while deleting the user.");
                    }
                });
            }
        }
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
