<?php

include "fetch_storygrams.php";

function sceneHTML($StorygramID) {

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

        $camera = "<a-camera position='0 0 0' near='0.1' far='100' fov='90'><a-entity cursor='rayOrigin: mouse' raycaster='objects: [data-raycastable]' far='90'><a-cursor></a-cursor></a-entity></a-camera>";
        $sky = "<a-sky class='storygramSky' src='$path_to_file' radius='99'></a-sky>";

        $hotSpots = getHotspots($StorygramID, $userID);
        $id = "scene".$StorygramID;

        $sceneHTML = "<a-scene class='storygramScene' id='$id' embedded>".$camera.$sky.$hotSpots."<a-plane visible='false' id='testPlane'></a-plane></a-scene>";



    } else {
        print($conn->error);
    }

    //consolePrint("sceneHTML: ".$sceneHTML);

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
                $ring = "<a-circle id='$ringID' class='$HotspotID' radius='1' position='".$x_coordinate." ".$y_coordinate." ".$z_coordinate."' rotation='".$x_rotation." ".$y_rotation." ".$z_rotation."' material='color:#FF0000' data-raycastable></a-circle>";
                //consolePrint("Plane: ".$plane);
                $htmlString = $htmlString.$plane.$ring;

        }
    } else {
        print($conn->error);
    }

    return $htmlString; // This will be a string of hotspots
}


?>