<!DOCTYPE html>

<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
</head>

<body>

  <header>
    <div class="logo_div"><a href="index.php"><img src="/img/LOGO.jpg" alt="VRStoryGram Logo" id="logo"></a></div>
    <div class="nav_1_div"><a href="inc/readme.php">What is VRStoryGram</a></div>
    <div class="nav_2_div"><a href="inc/about.php">Meet The Team</a></div>
    <div class="nav_3_div"><a href="inc/createAccount.php">Create</a></div>
    <div class="nav_4_div"><a href="inc/login.php">Login</a></div>
  </header>

  <div class="content_div">
    <div class="index_content_div">
      <div class="featured_content"> <a-scene embedded> <a-entity geometry="primitive: plane; width: 4; height: auto" position="0 2 -2" text="value: Coming Soon!; align: center;"></a-entity><a-box position="-1 0.5 -3" rotation="0 45 0" color="#4CC3D9"></a-box>
      <a-sphere position="0 1.25 -5" radius="1.25" color="#EF2D5E"></a-sphere>
      <a-cylinder position="1 0.75 -3" radius="0.5" height="1.5" color="#FFC65D"></a-cylinder>
      <a-plane position="0 0 -4" rotation="-90 0 0" width="4" height="4" color="#7BC8A4"></a-plane></a-scene> </div>

      <div class="newest_content">
        <h1>Latest StoryGrams</h1>
        <div class="latest_item_div">
          <div class="latest_item_1"> <a-scene></a-scene> </div>
          <div class="latest_item_2"> <a-scene></a-scene> </div>
          <div class="latest_item_3"> <a-scene></a-scene> </div>
          <div class="latest_item_4"> <a-scene></a-scene> </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    
  </footer>

</body>
</html>
