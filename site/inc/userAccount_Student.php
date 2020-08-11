<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/studentAccount_style.css">
  <?php $userID=$_GET['userID']; include "../scripts/site.php"; include "../scripts/student_homepage_script.php";?>
  <script src="/scripts/site.js"></script>
  <!--<script src="https://aframe.io/releases/0.9.0/aframe.min.js"></script>--> 
  <script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>

</head>

<body>

  <header>
    <div class="title"><p1>VRStoryGram:</div>
    <div class="userName_ID"><p1><?php getName($userID); echo " - " . $userID;?><p1></div>
    <div class="createButton"><button type="submit" onclick="toggleStorygramSubmit('1')">Create StoryGram!</button></div>
    <div class="editButton"><button type="submit" onclick="toggleStorygramSubmit('3')">Edit Profile</button></div>
  </header>

  <div class="content">
    <?php getStorygrams($userID);?>
  </div>

  <div class="Storygram_Popup" id="StorygramSubmissionWindow">
    <form action="/scripts/createStorygram.php" enctype="multipart/form-data" method="POST">
      <input type='hidden' value="<?php echo $userID; ?>" name='userID'>
      <div class='one'><a href='#' onclick="toggleStorygramSubmit('2')"><img src="/img/x_out.png"></a></div>
      <div class='two'><label>Title:</label><input type="text" name="title"><br></div>
      <div class='three'><label>Description:</label><textarea type='text' class='description_input' name='description'></textarea><br></div>
      <div class='four'><label>Upload File:</label><input type='file' name='photo' ></div>
      <div class='five'><button type='submit'>Submit</button></div>
    </form>
  </div>


  <div class="Edit_Popup" id="EditSubmissionWindow">
    <form>
      <div class="six"><a href="#" onclick="toggleStorygramSubmit('4')"><img src="/img/x_out.png"></a></div>
      <div class="seven"><label>First:</label><input type="text" id="first"><button>submit</button></div>
      <div class="eight"><label>Last:</label><input type="text" id="last"><button>submit</button></div>
      <div class="nine"><label>City:</label><input type="text" id="city"><button>submit</button></div>
      <div class="ten"><label>State:</label><input type="text" id="state"><button>submit</button></div>
      <div class="eleven"><label>Email:</label><input type="text" id="email"><button>submit</button></div>
      <div class="twelve"><label>Pasword:</label><input type="text" id="password"><button>submit</button></div>
    </form>
  </div>

<script>setEventListeners();</script>
</body>
</html>
