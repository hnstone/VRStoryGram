<?php

    function consolePrint($myString) {
        echo "<script> console.log(\"$myString\"); </script>";
    }
    
    # Get the storygrams for $userID and print html for each storygram. Used in userAccount_Student page. 
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
                //$fileType = $storygram_row[5];

                // TODO: check to see if code below crates the directory or if directory needs to already exists.
                $path_to_file = "../img/userData/" . $userID . "/" . $fileName;  // This is path to SKY (360 Photo)
                //consolePrint("Path_to_file: ".$path_to_file);

                $root = $_SERVER["DOCUMENT_ROOT"];
                $dir = $root . "/img/userData/".$userID;
                //$path_to_file = $dir."/".$fileName;
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }

                file_put_contents($path_to_file, $fileData);
            
                $hotSpots = getStorygramHotspots($StorygramID, $userID); // This function should return a string of ring-plane pairs and functionality for each hotspot

             
                $htmlString = $htmlString.getStorygramString($path_to_file, $hotSpots, $title, $description, $StorygramID);// returns a string of the <a-scene> element;
            }
        
        } else {
            print($conn->error);
        }
        //consolePrint("Storygram ID: ".$StorygramID);
        echo $htmlString; # echo $htmlString with all storygram entry data.
    }

    // Create and returns an html string containing all of a particular storygrams ($StorygramID) hotspot entries.
    function getStorygramHotspots($StorygramID, $userID) {
        include "db_connection.php";

        $sql = "SELECT `storygram_hotspots`.`UniqueHotspotID`,
        `storygram_hotspots`.`hotspotString`,
        `storygram_hotspots`.`description`,
        `storygram_hotspots`.`fileName`,
        `storygram_hotspots`.`fileData`,
        `storygram_hotspots`.`fileType`,
        `storygram_hotspots`.`x_coordinate`,
        `storygram_hotspots`.`y_coordinate`,
        `storygram_hotspots`.`z_coordinate`,
        `storygram_hotspots`.`x_rotation`,
        `storygram_hotspots`.`y_rotation`,
        `storygram_hotspots`.`z_rotation`
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
                $x_rotation = $storygram_row[9];
                $y_rotation = $storygram_row[10];
                $z_rotation = $storygram_row[11];

                // These two lines add the 2D photo to userID directory on server
                $path_to_file = "../img/userData/" . $userID . "/" . $fileName;  // This is path to hotspot photo (plane [2D] Photo)
                file_put_contents($path_to_file, $fileData);

                $planeID = "plane".$HotspotID; 
                $ringID = "ring".$HotspotID; 

            


                $plane = "<a-plane id='$planeID' class='$HotspotID' height='10' width='10' position='".$x_coordinate." ".$y_coordinate." ".$z_coordinate."' rotation='".$x_rotation." ".$y_rotation." ".$z_rotation."' visible='false' data-raycastable ></a-plane>";
                $ring = "<a-circle id='$ringID' class='$HotspotID' material='color:#FF0000' radius='1' position='".$x_coordinate." ".$y_coordinate." ".$z_coordinate."' rotation='".$x_rotation." ".$y_rotation." ".$z_rotation."' data-raycastable></a-circle>";
                
                

                $htmlString = $htmlString.$plane.$ring;
                consolePrint("HTMLString: ".$htmlString);

            }
        } else {
            print($conn->error);
        }


        return $htmlString; // This will be a string of hotspots
    }

    // Creates and returns an html string containing a user storygram to be displayed on their user page. (i.e. user storygram entry) This will be concatenated with the other storygram entries to be displayed on the user homepage.
    function getStorygramString($path_to_file, $hotSpots, $SG_title, $SG_description, $StorygramID) {
        $id = "scene".$StorygramID;
        $camera = "<a-camera position='0 0 0' near='0.1' far='100' fov='90'><a-entity cursor='rayOrigin: mouse' raycaster='objects: [data-raycastable]' far='90'></a-entity></a-camera>";
        $sky = "<a-sky class='storygramSky' src='$path_to_file' radius='100'></a-sky>";
        $scene = "<a-scene class='storygramScene' id='$id' embedded>" . $camera . $sky . $hotSpots . "</a-scene>";
        $title = "<p1 class='storygramTitle'>$SG_title</p1>";
        $description = "<p2 class='storygramDescription'>$SG_description</p2>";
        $title_description_div = "<div class='title_description_div'>" . $title . $description . "</div>";
        $button = "<button onclick='openEditStorygram($StorygramID);' class='storygramEdit'> Edit Storygram </button>"; // TODO: Need to create openEditSotrygram() function
        $html = "<div class='userStorygrams'>" . $scene . $title_description_div . $button . "</div>";
        return $html;
    }

?>