<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Membership System - Plan</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <style>
    /* Add your custom styles here */
    body {
      background-color: #fff;
      color: #ff4654;
      font-family: Arial, sans-serif;
      background-image: url('image/csgo-background.png');
      opacity: 85%;
    }

    .navbar {
      background-color: #161c24;
      padding: 15px 0;
    }

    .navbar-brand img {
      width: 50px;
      height: auto;
      display: block;
    }

    .navbar-nav .nav-link {
      color: #fff;
      font-weight: bold;
      margin-left: 15px;
      transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #ccc;
    }

    .plan {
      padding: 20px 0;
    }

    .plan-content {
      background-color: #2c2f33;
      border-radius: 10px;
      padding: 40px;
    }

    .plan-card {
      border: none;
      border-radius: 10px;
      padding: 20px;
      font-size: 16px;
      line-height: 1.4;
      text-align: center;
      height: 100%;
      transition: all 0.3s ease;
      background-color: #36393f;
      color: #fff;
      transition: transform 0.3s;
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
    }
    
    .plan-card::before {
      content: "";
      position: absolute;
      top: 30%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 0;
      height: 0;
      background-color: rgba(255, 255, 255, 0.5);
      border-radius: 50%;
      opacity: 0;
      transition: all 0.3s ease;
    }

    .plan-card:hover {
      background-color: #fff;
      color: #000;
      transform: translateY(-10px);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      animation: flip 0.6s forwards;
    }
    
    .plan-card:hover h5 {
      color: #000;
      animation: flip 0.6s forwards;
    }

    .plan-card .content {
      flex-grow: 1;
    }

    .plan-card h5 {
      margin-bottom: 20px;
      font-size: 20px;
      font-weight: bold;
      color: #fff;
    }

    .plan-card p {
      margin-bottom: 10px;
    }

    .plan-card .price {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 30px;
      color: #fff;
    }

    .plan-card .btn {
      display: inline-block;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      background-color: #ff4654;
      /* Red color */
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      text-decoration: none;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .plan-card .btn:hover {
      background-color: #e52a36;
      /* Darker red color on hover */
    }
    .plan-card:hover .content img {
    transform: scale(1.30);
  }

  .plan-card:hover .price {
    color: #000;
  }

  #playMusicButton {
    position: fixed;
    top: 50%;
    right: 10px;
    transform: translateY(-50%) rotate(90deg);
    z-index: 9999;
    padding: 10px;
    background-color: #ff4654;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
  }

</style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
    <a class="navbar-brand" href="index.html">
  <img src="logo.png" alt="Logo" width="50" height="50">
    </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="plan.php" >Plan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="info.html">Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signin.html" onclick="playSoundEffect2('sign-in.mp3')">Sign In</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Plan Section -->
  <section class="plan">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="plan-content">
            <h2 class="mb-4 text-white">Choose a Plan</h2>
            <div class="row">
              <div class="col-md-4">
                <div class="plan-card mb-4" onclick="playSoundEffect()">
                  <div class="content">
                  <img src="image/standard-logo.png" alt="Standard Logo" width="100" height="100">
                    <h5 class="mb-3 text-center">Standard</h5>
                    <p>Participate in club giveaways</p>
                    <p>Early updates and newsletters about club news and leaks</p>
                    <p>Get a free skin</p>
                    <p>5% discount + 1.5X rewards</p>
                    <br><br>
                    <p class="price">Rm29.99/month</p>
                    <a href="signin.html" class="btn">Get Standard</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="plan-card mb-4" onclick="playSoundEffect()">
                  <div class="content">
                  <img src="image/premium-logo.png" alt="Premium Logo" width="100" height="100">
                    <h5 class="mb-3 text-center">Premium</h5>
                    <p>All benefits from the previous tier</p>
                    <p>Participate in club giveaways and win small rewards</p>
                    <p>Get exclusive free skins</p>
                    <p>Participate in exclusive events</p>
                    <p>5% discount + 2X rewards</p>
                    <p class="price">Rm49.99/month</p>
                    <a href="signin.html" class="btn">Get Premium</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="plan-card mb-4" onclick="playSoundEffect()">
                  <div class="content">
                  <img src="image/Ultra-logo.png" alt="Ultra Logo" width="100" height="100">
                    <h5 class="mb-3 text-center">Ultra</h5>
                    <p>All benefits from the previous tiers</p>
                    <p>Participate in club giveaways and win big rewards</p>
                    <p>25% discount + 3X rewards</p>
                    <p>Get limited genuine free skins</p>
                    <p>Extra experience level</p>
                    <p class="price">RM89.99/month</p>
                    <a href="signin.html" class="btn">Get Ultra</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<audio id="soundEffect" src="sound/click.mp3"></audio>
<audio id="soundEffect2" src="sound/sign-in.mp3"></audio>
<audio id="backgroundMusic" src="sound/Menu-effect.mp3" autoplay loop></audio>
<script>
  // Get the audio elements
  const backgroundMusic = document.getElementById('backgroundMusic');
  const soundEffect = document.getElementById('soundEffect');
  const soundEffect2 = document.getElementById('soundEffect2');

  // Function to play the sound effect
  function playSoundEffect() {
    soundEffect.play();
  }

  function playSoundEffect2() {
    soundEffect2.play();
  }

  // Function to toggle the background music
  function toggleBackgroundMusic() {
    if (backgroundMusic.paused) {
      backgroundMusic.play();
      playMusicButton.innerText = 'Pause Background Music';
    } else {
      backgroundMusic.pause();
      playMusicButton.innerText = 'Play Background Music';
    }
  }
</script>
  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/js/bootstrap.min.js"></script>
</body>
</html>