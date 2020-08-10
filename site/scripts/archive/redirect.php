<?php


function redirect($ID, $Storygram = false) {
  include "db_connection.php";
  include "fetch_storygrams.php";

  if (!$Storygram) {

    $sql = "SELECT `users`.`user_type` FROM `vrstorygram`.`users` WHERE `users`.`user_id`='$ID'";
    $result = $conn->query($sql);
    if ($result) {
      $row = $result->fetch_row();
      $userType = $row[0];
    } else {
      print("Nothing in query");
    }
    
    if ($userType === "student") {
      header("Location: /inc/userAccount_Student.php?userID=$ID");
    }
    elseif ($userType === "educator") {
      header("Location: /inc/userAccount_Educator.php?userID=$ID");
    }
    elseif ($userType === "admin") {
      header("Location: /inc/userAccount_Admin.php?userID=$ID");
    }
  } else {
    consolePrint("Redirect: ".$ID);
    header("Location: /inc/editStorygram.php?StorygramID=$ID");
  }

}

?>