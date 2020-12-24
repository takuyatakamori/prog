const $start = document.getElementById('start_btn');
const $video = document.getElementById('video_area');

$start.addEventListener('click', () => {
    navigator.mediaDevices.getUserMedia({ video: true, audio: false })
    .then(stream => $video.srcObject = stream)
    .catch(err => alert(`${err.name} ${err.message}`));
}, false);

function copyFrame() {
    var canvas_capture_image = document.getElementById('capture_image');
    var cci = canvas_capture_image.getContext('2d');
    var va = document.getElementById('video_area');
    $("#kimetsu").empty();
    canvas_capture_image.width = va.videoWidth;
    canvas_capture_image.height = va.videoHeight;
    cci.drawImage(va, 0, 0);

    processImage();
}