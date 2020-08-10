<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>

  <header>
    <div class="logo_div"><a href="/index.php"><img src="/img/LOGO.jpg" alt="VRStoryGram Logo" id="logo"></a></div>
    <div class="nav_1_div"><a href="readme.php">What is VRStoryGram</a></div>
    <div class="nav_2_div"><a href="about.php">Meet The Team</a></div>
    <div class="nav_3_div"><a href="createAccount.php">Create</a></div>
    <div class="nav_4_div"><a href="login.php">Login</a></div>
  </header>

  <div class="content_div">
    <div class="login_content_div">
      <div class="form_div">
        <form action="/scripts/login_script.php" method="POST">
          Email:<input type="text" name="email"><br>
          Password:<input type="password" name="password"><br>
          <input type="submit" value="Submit">
        </form>
      </div>
    </div>
  </div>

  <footer>
    <div class="social_media_div">
      <h2>Get Social!</h2>
      <div class="social_media_icon_div">
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-youtube"></a>
        <a href="#" class="fa fa-instagram"></a>
        <a href="#" class="fa fa-twitter"></a>
      </div>
    </div>
  </footer>

</body>
</html>
