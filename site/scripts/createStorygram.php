<?php

include "db_connection.php";
include "site.php";

$userID = $_POST['userID'];
$title = $_POST['title'];
$description = $_POST['description'];
$fileName = $_FILES['photo']['name'];
$fileData = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
$fileType = $_FILES['photo']['type'];
$fileSize = $_FILES['photo']['size']; # in bytes

$sql = "INSERT INTO `vrstorygram`.`storygrams` (`userID`,`title`,`description`,`fileName`, `fileData`, `fileType`, `fileSize`) VALUES ('$userID','$title','$description','$fileName','$fileData','$fileType','$fileSize');";
$result = $conn->query($sql);

if ($result) {
  redirect($userID);
} else {
  header('Content-type: text/plain'); # this line is for being able to use '\n' in print fucntions.
  print("FAILED TO CREATE STORYGRAM.\n");
  print("UserID: " . $userID . "\n");
  print("Title: " . $title . "\n");
  print("Description: " . $description . "\n");
  print("Name: " . $fileName . "\n");
  print("Type: " . $fileType . "\n");
  print("size: " . $fileSize . "\n");
  print("tmpName: " . $_FILES['photo']['tmp_name'] . "\n");
  print("error: " . $_FILES['photo']['error'] . "\n");
  #phpinfo();
  #print(getType($_FILES["file"]));
  print($conn->error);
}
?>