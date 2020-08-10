<?php

include "site.php";
include "db_connection.php";

$StorygramID = $_GET['StorygramID'];
$x_coordinate = $_POST['x_coordinate'];
$y_coordinate = $_POST['y_coordinate'];
$z_coordinate = $_POST['z_coordinate'];
$description = $_POST['description'];
$fileName = $_FILES['photo']['name'];
consolePrint("File Name: ".$fileName);
$fileData = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
$fileType = $_FILES['photo']['type'];


// TODO: Having issues saving hotspot string to database. May need to store coordinates then build scene with those coordinates.
$sql = "INSERT INTO `vrstorygram`.`storygram_hotspots` (`x_coordinate`,`y_coordinate`,`z_coordinate`, `UniqueStorygramID`, `description`, `fileName`, `fileData`, `fileType`) VALUES ('$x_coordinate','$y_coordinate','$z_coordinate', '$StorygramID', '$description', '$fileName', '$fileData', '$fileType');";

$result = $conn->query($sql);

if ($result) {
    redirect($StorygramID, true);
} else {
  print($conn->error);
}

?>