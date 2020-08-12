
<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' href='/css/editStorygram.css'>
    <?php include '../scripts/site.php';?>
    <script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
    <script type="module">import * as THREE from 'https://threejs.org/build/three.js';</script>
    <script src="/scripts/site.js"></script>
</head>

<body>

    <div class='content' id='content'>
        <?php 
            $StorygramID = $_GET['StorygramID'];
            echo sceneHTML($StorygramID, true); 
        ?>
    </div>

    <div class="formDiv">
        <form action='../scripts/editStorygram_script.php?StorygramID=<?php echo $StorygramID;?>' enctype="multipart/form-data" method='post'>
            <div class='div1'><label>Description</label><textarea type='text' class='description_input' name='description'></textarea></div>
            <div class='div2'><label>File Submission</label><input type='file' name='photo'></div>
            <input type='hidden' name='x_coordinate' id='x_coordinate' value=''>
            <input type='hidden' name='y_coordinate' id='y_coordinate' value=''>
            <input type='hidden' name='z_coordinate' id='z_coordinate' value=''>
            <button type='submit' onclick='createHotspot();'>Create new Hotspot!</button>
        </form>

    </div>

<script>setEventListeners();</script>
</body>
</html>