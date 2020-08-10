<?php

// Azure Connection
$server = "vrstorygram-mysqldbserver.mysql.database.azure.com";
$user = "mysqldbuser@vrstorygram-mysqldbserver";
$db_Name = "vrstorygram-mysqldbserver";
$pw = "PUT8gaCHYo";

try {
  $conn=mysqli_init(); 
  mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL); 
  mysqli_real_connect($conn, "vrstorygram-mysqldbserver.mysql.database.azure.com", "mysqldbuser@vrstorygram-mysqldbserver", $pw, "vrstorygram", 3306);
}
catch (PDOException $e) {
    print("DB not connected.\n");
  }

?>
