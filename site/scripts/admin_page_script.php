<?php
    include "db_connection.php";
    include "/inc/userAccount_Admin.php";

    $userID = $_POST['userID'];

    $sql = "SELECT  `users`.`first_name`,     
    `users`.`last_name`,     
    `users`.`city`,     
    `users`.`state`,     
    `users`.`class_id`,     
    `users`.`user_id`,    
    `users`.`user_type`,     
    `users`.`email`,     
    `users`.`password` 
    FROM `vrstorygram`.`users` WHERE `users`.`user_id`='$userID'";

    $result = $conn->query($sql);
    if ($result) {
      $row = $result->fetch_row();
      $first = $row[0];
      $last = $row[1];
      $city = $row[2];
      $state = $row[3];
      $classID = $row[4];
      $userID = $row[5];
      $userType = $row[6];
      $password = $row[8];
    } else {
        print("Nothing in query");
    }

    #include("../inc/userAccount_Admin.php");
?>