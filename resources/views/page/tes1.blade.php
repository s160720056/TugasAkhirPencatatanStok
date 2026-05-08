<!DOCTYPE html>

<html>

<head>

    <title>Laravel webcam capture image and save from camera - ItSolutionStuff.com</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

     <script src="{{ asset('assets/webcam/webcam.min.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <style type="text/css">

        #results { padding:20px; border:1px solid; background:#ccc; }

    </style>

</head>

<body>

<div class="container">

    <h1 class="text-center">Laravel webcam capture image and save from camera - ItSolutionStuff.com</h1>

    @csrf

    <div class="row">

        <div class="col-md-6">

            <div id="my_camera"></div>

            <br/>
            <!-- Camera source selection -->
            <label for="cameraSelect">Select Camera:</label>
            <select id="cameraSelect" class="form-control"></select>
            <br/>

            <!-- Buttons to start and stop the camera -->
            <input type="button" value="Start Camera" class="btn btn-primary" onClick="start_camera()">
            <input type="button" value="Stop Camera" class="btn btn-secondary" onClick="stop_camera()">
            <br/><br/>

            <input type=button value="Take Snapshot" onClick="take_snapshot()" class="btn btn-success">
            <input type="hidden" name="image_row0" class="image-tag">

        </div>

        <div class="col-md-6">

            <div id="results">Your captured image will appear here...</div>

        </div>

        <div class="col-md-12 text-center">
            <br/>
            <button class="btn btn-success">Submit</button>
        </div>

    </div>

</div>

<script language="JavaScript">
    let row = 0;
    let currentCameraId = null;

    // Function to list available cameras
    function listCameras() {
        navigator.mediaDevices.enumerateDevices()
        .then(function(devices) {
            const cameraSelect = document.getElementById('cameraSelect');
            cameraSelect.innerHTML = ''; // Clear existing options

            devices.forEach(function(device) {
                if (device.kind === 'videoinput') {
                    let option = document.createElement('option');
                    option.value = device.deviceId;
                    option.text = device.label || `Camera ${cameraSelect.length + 1}`;
                    cameraSelect.appendChild(option);
                }
            });

            // Set the first available camera as the default
            if (cameraSelect.options.length > 0) {
                currentCameraId = cameraSelect.options[0].value;
            }
        });
    }

    // Default Webcam settings
    function start_camera() {
        const selectedCamera = document.getElementById('cameraSelect').value;
        currentCameraId = selectedCamera;

        Webcam.set({
            width: 400,
            height: 400,
            image_format: 'jpeg',
            jpeg_quality: 90,
            constraints: {
                deviceId: currentCameraId ? { exact: currentCameraId } : undefined
            }
        });

        Webcam.attach('#my_camera');
    }

    function stop_camera() {
        Webcam.reset();
    }

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            // Create a new div element to contain the captured image
            let newDiv = document.createElement('div');
            newDiv.className = 'captured-image';
            newDiv.id = 'image_row' + row;
            newDiv.innerHTML = `
                <div style="position: relative; width:fit-content;height:fit-content;">
                    <button class="btn btn-danger" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.7;" onclick="delete_image(${row})">Delete</button>
                    <img src="${data_uri}"/>
                    <input type="hidden" name="image_row${row}" class="image-tag" value="${data_uri}">
                </div>
            `;

            // Append the new div to the results section
            document.getElementById('results').appendChild(newDiv);

            // Increment the row number for the next image
            row++;
        });
    }

    function delete_image(row) {
        // Find the image div by row number and remove it
        let imageDiv = document.getElementById('image_row' + row);
        if (imageDiv) {
            imageDiv.remove();
        }
    }


    //select changed rerun camera
    document.getElementById('cameraSelect').addEventListener('change', function() {
        stop_camera();
        start_camera();
    });

    // Load available cameras when the page is loaded
    window.onload = function() {
        listCameras();
    }

    //submit button do axios post
    document.querySelector('.btn-success').addEventListener('click', function() {
        let images = document.querySelectorAll('.image-tag');
        let formData = new FormData();
        images.forEach(function(image) {
            formData.append('images[]', image.value);
        });

        axiosPost('/save-image', formData)
        .then(function(response) {

        })
        .catch(function(error) {

        });
    });
</script>

</body>

</html>
