//import * as THREE from 'https://threejs.org/build/three.js';

function toggleStorygramSubmit($n) {
    if ($n==='1') {
        document.getElementById("StorygramSubmissionWindow").style.display = "block";
        document.getElementById("EditSubmissionWindow").style.display = "none";
        document.getElementById("input1").value = "";
        document.getElementById("input2").value = "";
        document.getElementById("input3").value = "";
    } else if ($n==='2') {
        document.getElementById("StorygramSubmissionWindow").style.display = "none";
    } else if ($n==='3') {
        document.getElementById("EditSubmissionWindow").style.display = "block";
        document.getElementById("StorygramSubmissionWindow").style.display = "none";
        document.getElementById("first").value = "";
        document.getElementById("last").value = "";
        document.getElementById("city").value = "";
        document.getElementById("state").value = "";
        document.getElementById("email").value = "";
        document.getElementById("password").value = "";
    } else if ($n==='4') {
        document.getElementById("EditSubmissionWindow").style.display = "none";
    }
}

function getCookie(input) {
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var name = cookies[i].split('=')[0].toLowerCase();
        var value = cookies[i].split('=')[1].toLowerCase();
        if (name === input) {
          return value;
        }
    }
}

function openEditStorygram(StorygramID) {
    var editWindow = window.open("../inc/editStorygram.php?StorygramID="+StorygramID);
}

function degrees(radians) {
    return radians * (180 / Math.PI);
} 

// Get rotation and location of plane and ring objects. TODO: Maybe set invisible input items to be retrived by php
function createHotspot() {

    var camera = document.querySelector("a-camera");
    var rot = new THREE.Euler();
    rot.copy(camera.object3D.rotation);
    var vec = Object.values(rot);
    //console.log("Vec: " + vec[0] + ", " + vec[1] + ", " + vec[2]);

    // Rotation Coordinates (radians) to Rectangular Coordinates
    var coordinates = setVector(vec[0], vec[1]);  // May think about adding z rotation. Still working on it.

    var testPlane = document.getElementById('testPlane');
    testPlane.setAttribute('position', {x:coordinates.x, y:coordinates.y, z:coordinates.z});
    console.log("Coordinates of TestPLane: " + coordinates.x + " " + coordinates.y + " " + coordinates.z);
    testPlane.object3D.lookAt(0,0,0);

    var x_rotation = testPlane.object3D.rotation.x;
    var y_rotation = testPlane.object3D.rotation.y;
    var z_rotation = testPlane.object3D.rotation.z;
    //console.log("Rotation of TestPLane (rad): " + x_rotation + " " + y_rotation + " " + z_rotation);
    //console.log("Rotation of TestPLane (deg): " + degrees(x_rotation) + " " + degrees(y_rotation) + " " + degrees(z_rotation));

    document.getElementById('x_coordinate').value = coordinates.x;
    document.getElementById('y_coordinate').value = coordinates.y;
    document.getElementById('z_coordinate').value = coordinates.z;
    document.getElementById('x_rotation').value = degrees(x_rotation);
    document.getElementById('y_rotation').value = degrees(y_rotation);
    document.getElementById('z_rotation').value = degrees(z_rotation);

}

// This function returns a vector in rectangular coordinates. It take in angular coordinates from the camera rotation.
function setVector(x, y) { // note: parameters are angles in radians around each axie. z is always zero.
    var x0 = (Math.sin(y) * -20); //Math.cos(x - Math.PI/2)) * -20;
    var y0 = (Math.sin(x) * 20);
    var z0 = (Math.cos(y) * Math.cos(x)) * -20;
    return new THREE.Vector3(x0,y0,z0);
}

function setEventListeners() {

    var planes = document.getElementsByTagName('a-plane');
    var rings = document.getElementsByTagName('a-circle');
    var i;
    for (i=0;i<planes.length-1;i++) {

        let plane = document.getElementById(planes[i].id);
        let ring = document.getElementById(rings[i].id);
        console.log("PLane ID: " + planes[i].id);

        plane.addEventListener('click', function(){ eventAction(plane, ring); });
        ring.addEventListener('click', function(){ eventAction(plane, ring); });

        plane.object3D.lookAt(0,0,0);
        ring.object3D.lookAt(0,0,0);
    }
}

function eventAction(plane, ring) {
    console.log('Plane Attribute: ' + plane.getAttribute('visible','value'));
    if (plane.getAttribute('visible','value')) {
        plane.setAttribute('visible', false);
        ring.setAttribute('visible', true);

    } else {
        plane.setAttribute('visible', true);
        ring.setAttribute('visible', false);
    }
}