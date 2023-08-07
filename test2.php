<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop-up Modal dengan Kamera Webcam</title>
    <style>
    /* Styling untuk modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
    </style>
</head>

<body>
    <!-- Tombol untuk membuka modal -->
    <button onclick="openModal()">Buka Kamera</button>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <!-- Konten modal -->
            <h2>Kamera Webcam</h2>
            <video id="videoElement" width="640" height="480" autoplay></video>
            <button onclick="closeModal()">Tutup Kamera</button>
        </div>
    </div>

    <script>
    // Fungsi untuk membuka modal
    function openModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";

        // Memanggil fungsi untuk mengakses kamera
        startCamera();
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";

        // Memanggil fungsi untuk menghentikan kamera
        stopCamera();
    }

    // Fungsi untuk mengakses kamera
    function startCamera() {
        var video = document.getElementById("videoElement");

        // Memeriksa apakah perangkat mendukung akses kamera
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    // Menampilkan stream dari kamera pada elemen video
                    video.srcObject = stream;
                })
                .catch(function(error) {
                    console.error("Error accessing webcam: ", error);
                });
        } else {
            console.error("Browser tidak mendukung akses kamera.");
        }
    }

    // Fungsi untuk menghentikan kamera
    function stopCamera() {
        var video = document.getElementById("videoElement");
        var stream = video.srcObject;

        if (stream) {
            var tracks = stream.getTracks();
            tracks.forEach(function(track) {
                track.stop();
            });

            video.srcObject = null;
        }
    }
    </script>
</body>

</html>