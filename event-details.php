<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['eventId'])) {
    $eventId = $_GET['eventId'];

    // Fetch the event details from the events table based on the event ID
    $sql = "SELECT * FROM events WHERE EventID = $eventId";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error: " . $sql . "<br>" . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $eventName = $row['EventName'];
        $eventImage = $row['EventImage'];
        $eventDescription = $row['EventDescription'];
    } else {
        echo "Event not found.";
    }
} else {
    echo "Invalid event ID.";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Details</title>
    <link rel="stylesheet" type="text/css" href="event.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #141E30;
            color: #FFF;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #243B55;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
        }

        .event-details {
            text-align: center;
        }

        .event-details img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .event-details p {
            font-size: 18px;
            line-height: 1.5;
        }

        .back-button {
            text-align: center;
            margin-top: 20px;
        }

        .back-button a {
            text-decoration: none;
            color: #FFF;
            background-color: #E42C3C;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $eventName; ?></h1>
        <div class="event-details">
            <img src="<?php echo $eventImage; ?>" alt="Event Image">
            <p><?php echo $eventDescription; ?></p>
        </div>
        <div class="back-button">
            <a href="events.php">Back to Events</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
