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
    <div class="createAccount_content_div">

      <div class="new_account_div">
        <h1>Create VRStoryGram Account</h1>
          <form action="/scripts/createAccount_Scripts.php" method="POST">
            First Name:<input type="text" name="firstName" required><br>
            Last Name:<input type="text" name="lastName" required><br>
        
            Password:<input type="password" name='password' value=""><br>
          <!--  Varify Password:<input type="password" name="passwordVarify"><br> -->
            Email:<input type="text" name="email"><br>
            City:<input type="text" name="city"><br>
            State:<input type="text" name="state"><br>
            Describe Your Roll:<div class="userType_Radio_Input"><div><input type="radio" name="userType" value="student">Student</div>
            <div><input type="radio" name="userType" value="educator">Educator</div></div>
            <div></div><input type="submit" value="Submit">
          </form>
      </div>

      <div class="go_to_login_div">
        <a href="login.php"><h1>Login</h1></a>
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
