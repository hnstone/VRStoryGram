<?php
header("Location: /inc/login.php");
include "db_connection.php";

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$password = $_POST['password'];
$email = $_POST['email'];
$city = $_POST['city'];
$state = $_POST['state'];
$userType = $_POST['userType'];

$date = date_create();
$registerDate = date_timestamp_get($date);
#echo $registerDate;

# Check if user email already exists
$sql = "SELECT COUNT(*) FROM `vrstorygram`.`users` WHERE email='$email'";
if ( mysqli_fetch_all($conn->query($sql)) != 1) {
  print("User account already exists.");
}

$sql = "SELECT `site_data`.`latest_user_id` FROM `vrstorygram`.`site_data`";
$latestUserID = $conn->query($sql)->fetch_row()[0];
$userID = $latestUserID + 1;

$sql = "UPDATE `vrstorygram`.`site_data` SET `latest_user_id`='$userID' WHERE `latest_user_id`=$latestUserID";
$conn->query($sql);

$sql = "INSERT INTO `vrstorygram`.`users`
(`first_name`,
`last_name`,
`city`,
`state`,
`class_id`,
`user_id`,
`user_type`,
`email`,
`password`)
VALUES
('$firstName',
'$lastName',
'$city',
'$state',
0,
'$userID',
'$userType',
'$email',
'$password');";

if ($conn->query($sql) == True) {
  print("Connection Done");
}

?>
