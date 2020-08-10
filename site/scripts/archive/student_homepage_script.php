<?php

// I don't think I'm using this file.


include "db_connection.php";

function getName($userID) {
    global $conn;
    $sql = "SELECT `users`.`first_name`, `users`.`last_name` FROM `vrstorygram`.`users` WHERE `users`.`user_id`='$userID'";
    $result = $conn->query($sql);
    if ($result) {
      $row = $result->fetch_row();
      echo $row[0] . " " . $row[1];
    } else {
        print("Nothing in query");
    }
}

// Recreates storygram scene and stores the string as a cookie
// Not In Use
function loadStorygramData($UniqueStorygramID, $path_to_file="") {

  $sql = "SELECT `storygrams`.`title`,
  `storygrams`.`description`,
  `storygrams`.`fileName`,
  FROM `vrstorygram`.`storygrams` WHERE `storygrams`.`UniqueStoryramID`='$UniqueStorygramID';";

  $storygram = $conn->query($sql)->fetch_row();
  $sg_title = $storygram[1];
  $sg_description = $storygram[2];
  $sg_fileName = $storygram[3];

  $hotspotHTML = loadHotspotData($UniquStorygramID);

  $sceneHTML = loadStorygramScene($path_to_file, $hotspotHTML); // This is a string of html for Scene

  setcookie("sceneHTML",$sceneHTML);

  consolePrint("Cookie Was Set!");

  //echo "<script>openEditStorygram($StorygramID);</script>";


}

// Not In Use
function loadHotspotData($UniqueStorygramID) {
  $sql = "SELECT `storygram_hotspots`.`UniqueHotspotID`,
  `storygram_hotspots`.`hotspotString`,
  `storygram_hotspots`.`UniqueStorygramID`,
  FROM `vrstorygram`.`storygram_hotspots` WHERE `storygram_hotspots`.`UniqueStorygramID`='$UniqueStorygramID';";

  $result = $conn->query($sql);
  $numRow = $result->num_rows;
  $hotspotHTML = "";
  if ($result) {
    for ($n=0;$n<$numRow;$n++) {
      $row = $result->fetch_row();
      $hotspotHTML = $hotspotHTML.$row[1];
    }
  } else {
    print($conn->error);
  }
  return $hotspotHTML;
}

// Not In Use
function loadStorygramScene($path_to_file, $hotspotHTML) {
  $camera = "<a-camera position='0 0 0' near='0.1' far='100'><a-cursor></a-cursor>></a-camera>";
  $sky = "<a-sky class='storygramSky' src='$path_to_file' radius='100'></a-sky>";
  $scene = "<a-scene class='storygramScene' embedded>" . $camera . $sky . $hotSpotHTML . "</a-scene>";
  $html = "<div class='userStorygrams'>".$scene."</div>";

  return $html;
}

/* TODO: DELETE THIS
# I stopped here. Need to create way for user to upload photos first. Also need to figure out how to store the photos. 
# Function used in userAccount_Student.php line 21.
# I don't think I'm using this function.
function printStoryGrams($userID) {
  global $conn;
  $sql = "SELECT `data_storygram_photos`.`user_id`, `data_storygram_photos`.`vr_photo`, `data_storygram_photos`.`comment`, `data_storygram_photos`.`date` FROM `vrstorygram`.`data_storygram_photos`";
  $result = $conn->query($sql);
  while ($row = $result->fetch_row()) {
    $photo = $row[0];
    $comment = $row[1];
    echo 
    "<div style='display: grid; grid-template-column: 40% 60%;'> 
      <div style='border-style: solid; border-color: red; ></div>
      <div style='display: grid; grid-template-rows: 25% 75%;'>
        <div>$comment</div>
        <div></div>
      </div>
    </div>";
  }
}
*/
?>



