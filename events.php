<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
    <title>Events</title>
    <link rel="stylesheet" type="text/css" href="navbar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #141E30;
            color: #FFF;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
        }

        .event-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .event {
            background-color: #243B55;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            margin: 10px;
            position: relative;
            overflow: hidden;
            width: calc(45% - 30px); /* Adjust the width as needed */

        }

        .event img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

      .event:hover img {
          transform: scale(1.1);
            }

      .event::before {
              content: "";
              position: absolute;
              top: 0;
              left: -100%;
              width: 100%;
              height: 100%;
              background-color: rgba(0, 128, 128, 0.2);
            transition: left 0.3s ease;
            }

          .event:hover::before {
            left: 0;
            transform: translateX(100%);
          }

          .event::after {
          content: ""; /* Add a pseudo-element for the overlay */
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 128, 128, 0.2);
          z-index: -1; /* Position the overlay behind the content */
          transition: opacity 0.6s ease;
          opacity: 0; /* Initially hide the overlay */
          }

          .event:hover::after {
          opacity: 1; /* Show the overlay on hover */
            }
            
        .event h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .event a {
            color: #FFF;
            background-color: #E42C3C;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        
        .video-section {
            background-color: #222; 
            position: relative;
            width: 100%;
            height: 70vh; /* Adjust the height as needed */
            overflow: hidden;
            z-index: -1;
            box-sizing: border-box;
        }

        #game-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 99.98%;
            height: 100%;
            object-fit: cover;
            border: 5px solid rgba(0, 128, 128, 0.2);
            margin-top: 60px;

        } 

          .video-overlay {
          font-family: 'Roboto', sans-serif;
          font-size: 40px;
          color: #FFF;
          margin: 0;
          padding: 20px;
          background-color: rgba(0, 0, 0, 0.288);
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          display: flex;
          align-items: center;
          justify-content: center;
          }
          .video-overlay p {
          color: #FFF;
          margin: 0;
          padding: 20px;
      }
    
    
    </style>
<!--This is for changing background according to game selected -->
<style>
  
  .background-valorant {
      background-color: #141E30;
      background-image: url("uploads/valorant-background.jpg");
    }

    .background-apex {
      background-color: #fff4f4;
      background-image: url("uploads/apex-background.jpeg")
    }

    .background-counterstrike {
      background-color: #e4e2fc;
      background-image: url("uploads/csgo-background.jpg");
    }
</style>
</head>
<body>
    <!-- Navigation -->
<nav class="navbar fixed-top navbar-transparent" id="navbar">
    <ul>
      <li><a href="welcome.html">Profile</a></li>
      <li><a href="events.php">Events</a></li>
      <li><a href="skins.php">Skins</a></li>
      <li><a href="subscription.html">Subscription</a></li>
    </ul>
    <ul>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
  <!-- Container for display video -->
  <div class="video-section">
        <video id="game-video"  autoplay loop muted plays-inline>
            <!-- Add video sources based on the game -->
            <source src="uploads/valorant-movie.mp4" type="video/mp4">
            <source src="uploads/apex-legends-movie.mp4" type="video/mp4">
            <source src="uploads/csgo-movie.mp4" type="video/mp4">
        </video>
        <div class="video-overlay">
        <p>Events</p>
      </div>
    </div>
 <!-- Container for text -->
    <div class="container">
        <h1>What's New</h1>
         <!-- Container for display event -->
        <div class="event-container">
            <?php

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

            // Fetch the selected game ID from the memberships table based on the user ID
            $userId = $_SESSION['userId'];
            $sql = "SELECT GameId FROM memberships WHERE UserId = $userId";
            $result = $conn->query($sql);

            if (!$result) {
                die("Error: " . $sql . "<br>" . $conn->error);
            }

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $gameId = $row['GameId'];

                // Fetch the events data from the events table based on the selected game ID
                $sql = "SELECT * FROM events WHERE GameId = $gameId";
                $result = $conn->query($sql);

                if (!$result) {
                    die("Error: " . $sql . "<br>" . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='event'>";
                        echo "<img src='" . $row['EventImage'] . "' alt='Event Image'>";
                        echo "<h3>" . $row['EventName'] . "</h3>";
                        echo "<a href='event-details.php?eventId=" . $row['EventID'] . "'>View Details</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No events available for your selected game.</p>";
                }
            } else {
                echo "<p>No events available for your selected game.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/js/bootstrap.min.js"></script>
<script>
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();

    if (scroll > 0) {
      $(".navbar").addClass("navbar-scrolled");
    } else {
      $(".nav").removeClass("navbar-scrolled");
    }

    if (scroll === 0 || scroll + $(window).height() === $(document).height()) {
      $(".navbar").addClass("navbar-transparent");
    } else {
      $(".navbar").removeClass("navbar-transparent");
    }

  });
  </script>
<!-- JS related to anything that change based on game selected -->
<script>
  $(document).ready(function() {
    $.ajax({
      url: "welcome-process.php",
      method: "GET",
      dataType: "json",
      success: function(response) {
        var gameInterest = response.gameInterest;

        var videoMapping = {
        "Valorant": "uploads/valorant-movie.mp4",
        "Apex Legends": "uploads/apex-legends-movie.mp4",
        "CSGO": "uploads/csgo-movie.mp4"
      };

      // Set the body background based on the game interest
      $("body").removeClass("background-valorant background-apex background-counterstrike");
                if (gameInterest === "Valorant") {
                    $("body").addClass("background-valorant");
                } else if (gameInterest === "Apex Legends") {
                    $("body").addClass("background-apex");
                } else if (gameInterest === "CSGO") {
                    $("body").addClass("background-counterstrike");
                }

      // Set the video source based on the game interest
      var videoPath = videoMapping[gameInterest];
      if (videoPath) {
        $("#game-video source").attr("src", videoPath);
        $("#game-video")[0].load();
      }
    
    },
      error: function(xhr, status, error) {
        console.log(error);
      }
      
    });
  });
</script>
