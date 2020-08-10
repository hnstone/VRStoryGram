<?php

    function consolePrint($myString) {
            echo "<script> console.log(\"$myString\"); </script>";
    }

    function redirect($ID, $Storygram = false) {
        include "db_connection.php";
        //include "fetch_storygrams.php";
      
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

    function getName($userID) {
        include "db_connection.php";
        $sql = "SELECT `users`.`first_name`, `users`.`last_name` FROM `vrstorygram`.`users` WHERE `users`.`user_id`='$userID'";
        $result = $conn->query($sql);
        if ($result) {
          $row = $result->fetch_row();
          echo $row[0] . " " . $row[1];
        } else {
            print("Nothing in query");
        }
    }

    function getStorygrams($userID) {
        include "db_connection.php";
    
        $sql = "SELECT `storygrams`.`UniqueStorygramID`,
            `storygrams`.`title`,
            `storygrams`.`description`,
            `storygrams`.`fileName`,
            `storygrams`.`fileData`,
            `storygrams`.`fileType`,
            `storygrams`.`fileSize`
            FROM `vrstorygram`.`storygrams` WHERE `storygrams`.`userID`='$userID';";
    
        $result = $conn->query($sql);
        $numRows = $result->num_rows;
        $htmlString = ""; 
        if ($result) {
            for ($n=0;$n<$numRows;$n++) {
                $storygram_row = $result->fetch_row();
    
                $StorygramID = $storygram_row[0]; // unique id
                $title = $storygram_row[1]; // storygram title
                $description = $storygram_row[2]; // storygram description
                $fileName = $storygram_row[3]; 
                $fileData = $storygram_row[4]; // file for 360 photo aka <a-sky>
    
                // TODO: check to see if code below crates the directory or if directory needs to already exists.
                $path_to_file = "../img/userData/" . $userID . "/" . $fileName;  // This is path to SKY (360 Photo)
    
                $root = $_SERVER["DOCUMENT_ROOT"];
                $dir = $root . "/img/userData/".$userID;
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }
    
                file_put_contents($path_to_file, $fileData);    
                 
                $htmlString = $htmlString.getStorygramString($path_to_file, $title, $description, $StorygramID);// returns a string of the <a-scene> element;
            }
            
        } else {
            print($conn->error);
        }
        
        echo $htmlString; # echo $htmlString with all storygram entry data.
    }

        // Creates and returns an html string containing a user storygram to be displayed on their user page. (i.e. user storygram entry) This will be concatenated with the other storygram entries to be displayed on the user homepage.
    function getStorygramString($path_to_file, $SG_title, $SG_description, $StorygramID) {
        $scene = sceneHTML($StorygramID);
        $title = "<p1 class='storygramTitle'>$SG_title</p1>";
        $description = "<p2 class='storygramDescription'>$SG_description</p2>";
        $title_description_div = "<div class='title_description_div'>" . $title . $description . "</div>";
        $button = "<button onclick='openEditStorygram($StorygramID);' class='storygramEdit'> Edit Storygram </button>"; // TODO: Need to create openEditSotrygram() function
        $html = "<div class='userStorygrams'>" . $scene . $title_description_div . $button . "</div>";
        return $html;
    }

    function sceneHTML($StorygramID, $ifCursor=false) {

        include "db_connection.php";
        
        //consolePrint("StorygramID: ".$StorygramID); 
        $sql = "SELECT 
            `storygrams`.`fileName`,
            `storygrams`.`userID`
            FROM `vrstorygram`.`storygrams` 
            WHERE `storygrams`.`UniqueStorygramID`='$StorygramID';";
        
        $result = $conn->query($sql);
        
        $sceneHTML = "";
        
        if ($result) {
            $row = $result->fetch_row();
            $fileName = $row[0];
            $userID = $row[1];
        
            $path_to_file = "../img/userData/" . $userID . "/" . $fileName; // file for sky
        
            $cursor = ($ifCursor ? "<a-cursor></a-cursor>" : "" );
            $camera = "<a-camera position='0 0 0' near='0.1' far='100' fov='90'><a-entity cursor='rayOrigin: mouse' raycaster='objects: [data-raycastable]' far='90'>".$cursor."</a-entity></a-camera>";
            $sky = "<a-sky class='storygramSky' src='$path_to_file' radius='99'></a-sky>";
        
            $hotSpots = getHotspots($StorygramID, $userID);
            $id = "scene".$StorygramID;
        
            $sceneHTML = "<a-scene class='storygramScene' id='$id' embedded>".$camera.$sky.$hotSpots."<a-plane visible='false' id='testPlane'></a-plane></a-scene>";
        } else {
            print($conn->error);
        }
                
        return $sceneHTML;
        
    }

    // Create and returns an html string containing all of a particular storygrams ($StorygramID) hotspot entries.
    function getHotspots($StorygramID, $userID) {
        include "db_connection.php";

        $sql = "SELECT `storygram_hotspots`.`UniqueHotspotID`,
            `storygram_hotspots`.`hotspotString`,
            `storygram_hotspots`.`description`,
            `storygram_hotspots`.`fileName`,
            `storygram_hotspots`.`fileData`,
            `storygram_hotspots`.`fileType`,
            `storygram_hotspots`.`x_coordinate`,
            `storygram_hotspots`.`y_coordinate`,
            `storygram_hotspots`.`z_coordinate`
            FROM `vrstorygram`.`storygram_hotspots` WHERE `storygram_hotspots`.`UniqueStorygramID`='$StorygramID';";

        $result = $conn->query($sql);
        $numRows = $result->num_rows;
        $htmlString = "";
        if ($result) {
            for ($n=0;$n<$numRows;$n++) {
                $storygram_row = $result->fetch_row();

                $HotspotID = $storygram_row[0];
                $HotspotString = $storygram_row[1];
                $description = $storygram_row[2]; // may not need to store this
                $fileName = $storygram_row[3];
                $fileData = $storygram_row[4];
                $fileType = $storygram_row[5]; // not necessary
                $x_coordinate = $storygram_row[6];
                $y_coordinate = $storygram_row[7];
                $z_coordinate = $storygram_row[8];


                // These two lines add the 2D photo to userID directory on server
                $path_to_file = "../img/userData/" . $userID . "/" . $fileName;  // This is path to hotspot photo (plane [2D] Photo)
                consolePrint("Path to File: ".$path_to_file);
                file_put_contents($path_to_file, $fileData);

                $planeID = "plane".$HotspotID; 
                $ringID = "ring".$HotspotID; 

                $image = "<a-image height='15' width='20' position='0 10 0' src='$path_to_file'></a-image>";
                $text = "<a-text value='$description' height='5' width='20' color='#000000' align='center'></a-text>";
                $plane = "<a-plane id='$planeID' class='$HotspotID' height='5' width='20' position='".$x_coordinate." ".$y_coordinate." ".$z_coordinate."' visible='false' data-raycastable >".$image.$text."</a-plane>";
                
                $ring = "<a-circle id='$ringID' class='$HotspotID' radius='1' position='".$x_coordinate." ".$y_coordinate." ".$z_coordinate."' material='color:#FF0000' data-raycastable></a-circle>";
                $htmlString = $htmlString.$plane.$ring;

            }
        } else {
            print($conn->error);
        }

        return $htmlString; // This will be a string of hotspots
    }

?>