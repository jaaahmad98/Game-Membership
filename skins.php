<!DOCTYPE html>
<?php session_start();?>
<html lang="en">
<html>
<head>
    <title>Skins</title>
    <link rel="stylesheet" type="text/css" href="navbar.css">
</head>
<body>
<nav class="navbar fixed-top navbar-transparent">
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
</body>
</html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Limited Edition Skins - Game Membership System</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
  <!-- Custom CSS -->
  <style>
    /* Add your custom styles here */
    body {
      background-color: #141E30;
      background-image: linear-gradient(to bottom right, #141E30, #243B55);
      color: #FFF;
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 900px;
      margin: 0 auto;
      padding: 20px;
    }
    .skin-card {
      background-color: rgba(255, 255, 255, 0.1);
      padding: 30px;
      border-radius: 10px;
      text-align: center;
      margin-bottom: 30px;
      transition: transform 0.3s ease;
    }

  .skin-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        }
    .skin-card img {
      max-width: 100%;
      height: auto;
      border-radius: 5px;
      margin-bottom: 10px;
    }
    .skin-card h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }
    .skin-card p {
      font-size: 14px;
    }
    #no-skins-message {
      display: none; /* Hide the "No skins available" message by default */
    }

/* This is for changing background according to game selected */
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
  <div class="container">
    <h1 class="text-center mb-4">Limited Edition Skins</h1>
    <div id="skin-cards" class="row">
    </div>
    <p id="no-skins-message" class="text-center">No skins available.</p>
  </div>
 


  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $.ajax({
        url: "skins-process.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
          var skins = response;
          if (skins.length === 0) {
            $("#no-skins-message").show();
          } else {
            for (var i = 0; i < skins.length; i++) {
              var skin = skins[i];
              var skinCard = createSkinCard(skin);
              $("#skin-cards").append(skinCard);
            }
          }
    
        // Set the body background based on the game interest
        var gameId = response.gameId;
        console.log(gameId); // Add this line to check the value in the browser console
        $("body").removeClass("background-valorant background-apex background-counterstrike");
        if (gameId === "1") {
            $("body").addClass("background-valorant");
        } else if (gameId === "2") {
            $("body").addClass("background-apex");
        } else if (gameId === "3") {
            $("body").addClass("background-counterstrike");
        }
        },
        error: function(xhr, status, error) {
          console.log(error);
          $("#no-skins-message").text("Error loading skins.").show();
        }
      });
    });

    function createSkinCard(skin) {
      var skinCard = '<div class="col-md-4">' +
                     '<div class="skin-card">' +
                     '<img src="' + skin.SkinImage + '" alt="' + skin.SkinName + '">' +
                     '<h3>' + skin.SkinName + '</h3>' +
                     '<p>' + skin.SkinDescription + '</p>' +
                     '</div>' +
                     '</div>';

      var hoverAudio  = new Audio('uploads/hoversound_01.mp3');
      var cardElement = $(skinCard);

        // Add event listeners for hover
        cardElement.on('mouseenter', function() {
          // Play the hover sound when mouse enters the card
          hoverAudio.play();
        });

        cardElement.on('mouseleave', function() {
          // Pause and reset the hover sound when mouse leaves the card
          hoverAudio.pause();
          hoverAudio.currentTime = 0;
        });

      return skinCard;
    }
  </script>
</body>
</html>
