<?php
include "db_connection.php";
include "site.php";

$email = $_POST['email'];
$input_password = $_POST['password'];

# Validate username
$sql = "SELECT `users`.`user_id`, `users`.`user_type`,`users`.`password` FROM `vrstorygram`.`users` WHERE `users`.`email`='$email'";

$result = $conn->query($sql);
if ($result) {
  $row = $result->fetch_row();
  $userID = $row[0];
  $userType = $row[1];
  $password = $row[2];
} else {
  print("Nothing in query");
}

redirect($userID);
?>
