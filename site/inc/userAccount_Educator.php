<!DOCTYPE html>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/userAccount_style.css">
</head>

<body>

  <div class="one"> <div class="one_one"><p1>VR StoryGram Educator</p1></div> <div class="one_icon"><img src="/img/default_profile.png"></div> </div>
  <div class="two"> <div class="two_image"><img src="/img/default_profile.png"></div> <div class="two_space1"></div>  <div class="two_username"><p1><?php include "login_script.php"; $user_name = $_GET["name"]; echo $user_name; ?></p1></div> <div class="two_bio"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p></div>
  <div class="two_edit"><button type="button">Edit Profile</button></div> </div>

  <div class="three"> <div class="three_assignments"><p1>Assignments</p1></div> <div class="three_one"> <div class="assignment_1"></div> <div class="assignment_2"></div> <div class="assignment_3"></div> <div class="assignment_4"></div> </div>  </div>
  <div class="four"> <div class="four_myStories"><p1>My StoryGrams</p1> </div> <div class="four_one"> <div class="story_1"></div> <div class="story_2"></div> <div class="story_3"></div> <div class="story_4"></div>      </div>  </div>

</body>
</html>
