<?php
    include "db_connection.php";

    $sql = "SELECT `users`.`first_name`,
    `users`.`last_name`,
    `users`.`city`,
    `users`.`state`,
    `users`.`class_id`,
    `users`.`user_id`,
    `users`.`user_type`,
    `users`.`email`,
    `users`.`password`  
    FROM `vrstorygram`.`users` WHERE email=;";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "Name: " . $row["name"]. "<br>";
        }
    }


?>