<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/datatable.css">
    <style>
    #previewGambar {
        width: 400px;
        max-width: 100%;
        height: auto;
    }

    /* Styling untuk modal */
    /*
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
    
    .table-responsive {
        height: 300px;
        overflow-y: scroll;
    }
    */
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">USER PANEL</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="registrasi.php">Registrasi ID</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="update_user.php">Update ID</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cetak_id.php">CETAK ID</a>
                    </li>
                    <a class="nav-link" href="analisis.php">Analisis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="img/dfn.png" alt="" width="72" height="57">
                <h2>Registrasi ID</h2>
                <p class="lead">Silahkan memasukan data diri untuk access masuk</p>
            </div>

            <div class="col-md-12 col-lg-12">
                <form class="needs-validation" id="myForm" method="post" enctype="multipart/form-data"
                    action="insert.php" onsubmit="return validateForm()">

                    <div class="row g-3">
                        <div class="col-5">
                            <label for="nik" class="form-label">No Urut</label>
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="" readonly>
                            <div class="invalid-feedback">
                                p
                            </div>
                            <label for="jenis_id" class="form-label">Jenis ID</label>
                            <select class="form-control" id="jenis_id" name="jenis_id" required
                                onchange="enableNoIdField()">
                                <option value="" disabled selected>Jenis ID</option>
                                <option value="KTP">KTP</option>
                                <option value="SIM">SIM</option>
                                <option value="PASPORT">Pasport</option>
                                <option value="ID_TERSEDIA">ID_TERSEDIA</option>
                            </select>
                            <div class="invalid-feedback">
                                Silahkan untuk memilih jenis ID.
                            </div>

                            <label for="no_id" class="form-label">Nomor Identitas</label>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control" id="no_id" name="no_id"
                                    placeholder="NOMOR IDENTITAS" required oninput="validateNoIdInput() ">

                                <div class="invalid-feedback">
                                    Nomor ID dibutuhkan.
                                </div>
                            </div>

                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required
                                oninput="validateAlphabet(this)">
                            <div class="invalid-feedback">
                                Silahkan untuk mengisi nama.
                            </div>

                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                                oninput="limitTextarea(this, 100)" required></textarea>
                            <div class="invalid-feedback">
                                Silahkan untuk mengisi alamat.
                            </div>


                            <label for="tanggal_mulai_label" class="form-label">Tanggal Berlaku</label>
                            <input type="text" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                value="<?php echo date('Y-m-d'); ?>" required readonly>
                            <div class="invalid-feedback">
                                Silahkan untuk mengisi tanggal berlaku.
                            </div>


                            <label for="tanggal_berlaku" class="form-label">Tanggal Kadaluarsa</label>
                            <input type="date" class="form-control" id="tanggal_berlaku" name="tanggal_berlaku"
                                placeholder="Tanggal Berlaku" required>
                            <div class="invalid-feedback">
                                Silahkan untuk mengisi tanggal berlaku.
                            </div>


                            <label for="status_user" class="form-label">Status User</label>
                            <select class="form-control" id="status_user" name="status_user" required>
                                <option value="" disabled selected>Status User</option>
                                <option value="Karyawan">Karyawan</option>
                                <option value="Outsourcing">Outsourcing</option>
                                <option value="Tenan">Tenan</option>
                            </select>
                            <div class="invalid-feedback">
                                Silahkan untuk memilih status user.
                            </div>

                            <div class="form-group">
                                <label for="foto" class="form-label">FOTO</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="fileToUpload" name="fileToUpload"
                                        accept="image/*" style="display: none;">

                                    <!-- <span class="input-group-text">atau</span> -->
                                    <button type="button" class="btn btn-primary" onclick="openModal()">
                                        Buka Webcam
                                    </button>

                                </div>
                                <div class="invalid-feedback">
                                    Silakan pilih foto.
                                </div>
                            </div>

                            <label for="validation" class="form-label">Validation</label>
                            <select class="form-control" id="validation" name="validation">
                                <option value="" disabled selected>Select Validation</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak_Aktif">Tidak Aktif</option>
                            </select>
                            <div class="invalid-feedback">
                                Silahkan untuk memilih validation.
                            </div>
                        </div>

                        <div class="col-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <img id="previewGambar" src="default/dft.png" alt="Preview Gambar"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-1">

                    <div style="display: inline-block; margin-bottom: 20px;">
                        <button class="w-100 btn btn-primary btn-lg" type="submit" name="submit">SUBMIT</button>
                    </div>
                    <!-- <div style="display: inline-block; margin-bottom: 20px;">
                        <hr>
                        <button class="w-100 btn btn-primary btn-lg" type="submit" name="update"
                            onclick="setFormAction('update.php')">UPDATE</button>
                    </div> -->

                    <div style="display: inline-block; margin-bottom: 20px;">
                        <hr>
                        <button class="w-100 btn btn-primary btn-lg" type="submit" name="clear"
                            onclick="handleClearClick(event)">CLEAR</button>
                    </div>

                    <script>
                    function setFormAction(action) {
                        document.getElementById("myForm").action = action;
                    }
                    </script>
                </form>
            </div>
            <hr>
            <div class="col-md-12 col-lg-12">

                <?php 
require('koneksi.php');

// Execute SQL query to retrieve all users from the database
$result = $mysqli->query("SELECT * FROM user order by nik desc");

// If the query returns at least one row, display the data in a table
if ($result->num_rows > 0) {
  echo "<div class='table-responsive'>
        <table class='table' id='datatables'>
        <thead>
        <tr>
        <th>Jenis Id</th>
        <th>No ID</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Kadaluarsa</th>
        <th>Status User</th>
        <th>Validation</th>
        <th>Select</th>
        <th>Delete</th>
        </tr>
        </thead>
        <tbody>";
  
  // Output data of each row
  while ($row = $result->fetch_assoc()) {
    // Display data for each user in a row of the table
    echo "<tr>
              <td>" . $row["jenis_id"] . "</td>
              <td>" . $row["no_id"] . "</td>
              <td>" . $row["nama"] . "</td>
              <td>" . $row["alamat"] . "</td>
              <td>" . $row["tanggal_mulai"] . "</td>
              <td>" . $row["tanggal_berlaku"] . "</td>
              <td>" . $row["status_user"] . "</td>
              <td>" . $row["validation"] . "</td>
              <td>
                  <button class='btn-primary btn-xs' onclick='selectUser(". $row["nik"] . ", \"" . $row["jenis_id"] . "\",\"" . $row["no_id"] . "\",\"" . $row["nama"] . "\", \"" . $row["alamat"] . "\", \"" . $row["tanggal_mulai"] . "\",\"" . $row["tanggal_berlaku"] . "\", \"" . $row["status_user"] . "\", \"" . $row["validation"] . "\", \"" . $row["lokasi_gambar"] . "\")'>Select</button>
              </td>
              <td>
                  <button class='btn-primary btn-xs' onclick='confirmDelete(" . $row["nik"] . ")'>DELETE</button>
              </td>
          </tr>";
}
  
  echo "</tbody></table></div>";
}
 else {
  echo "No results found.";
}
?>
            </div>
    </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017–2022 Company Name</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>

        </ul>
    </footer>

    <!-- Modal -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Kamera Webcam</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <video id="videoElement" width="640" height="640" autoplay></video>
                    <button class="btn btn-primary w-100" id="capture">Capture</button>
                    <!--<button onclick="closeModal()">Tutup Kamera</button>-->
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="validasi.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/datatable.js"></script>

    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        $("#datatables").DataTable();

        $('#capture').click(function() {
            captureImage();
        });

        validate_nomor();
    });

    /* SELECT USER */
    function selectUser(nik, jenis_id, no_id, nama, alamat, tanggal_mulai, tanggal_berlaku, status_user, validation,
        lokasi_gambar) {
        document.getElementById('nik').value = nik;
        document.getElementById('jenis_id').value = jenis_id;
        document.getElementById('no_id').value = no_id;
        document.getElementById('nama').value = nama;
        document.getElementById('alamat').value = alamat;
        // document.getElementById('tanggal_mulai').value = tanggal_mulai;
        document.getElementById('tanggal_berlaku').value = tanggal_berlaku;
        document.getElementById('status_user').value = status_user;
        document.getElementById('validation').value = validation;

        var lokasi_gambar = 'foto/' + lokasi_gambar;
        document.getElementById('previewGambar').src = lokasi_gambar;

        // Enable no_id field if jenis_id is not empty
        var noIdField = document.getElementById('no_id');
        var jenisIdSelect = document.getElementById('jenis_id').value;
        noIdField.disabled = jenisIdSelect === '';

        // Set the selected options for status_user and validation
        var statusUserSelect = document.getElementById('status_user');
        switch (status_user) {
            case 'Karyawan':
                statusUserSelect.value = 'Karyawan';
                break;
            case 'Outsourcing':
                statusUserSelect.value = 'Outsourcing';
                break;
            case 'Tenan':
                statusUserSelect.value = 'Tenan';
                break;
            default:
                statusUserSelect.selectedIndex = 0;
        }

        var jenisIdSelect = document.getElementById('jenis_id');
        switch (jenis_id) {
            case 'KTP':
                jenisIdSelect.value = 'KTP';
                break;
            case 'SIM':
                jenisIdSelect.value = 'SIM';
                break;
            case 'PASPORT':
                jenisIdSelect.value = 'PASPORT';
                break;
            case 'ID_TERSEDIA':
                jenisIdSelect.value = 'ID_TERSEDIA';
                break;
            default:
                jenisIdSelect.selectedIndex = 0;
        }
    }

    /* PREVIEW IMAGES */
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('previewGambar').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('fileToUpload').addEventListener('change', function() {
        previewImage(this);
    });

    /* CLEAR FORM */
    function clearForm() {
        document.getElementById('nik').value = '';
        document.getElementById('jenis_id').value = '';
        document.getElementById('no_id').value = '';
        document.getElementById('nama').value = '';
        document.getElementById('alamat').value = '';
        document.getElementById('tanggal_mulai').value = getTodayDate();
        document.getElementById('tanggal_berlaku').value = '';
        document.getElementById('status_user').selectedIndex = 0;
        document.getElementById('validation').selectedIndex = 0;
        // document.getElementById('fileToUpload').value = '';
        document.getElementById('previewGambar').src = 'default/dft.png';
        document.getElementById('lokasi_gambar').src = '';
    }

    // Menghubungkan fungsi "clearForm" dengan tombol "CLEAR"
    document.querySelector('button[name="clear"]').addEventListener('click', clearForm);

    function setDefaultImages() {
        var imgElement = document.getElementById("lokasi_gambar");
        imgElement.src = "default/dft.png";
    }

    window.addEventListener("DOMContentLoaded", setDefaultImages);

    /* DISABLED TANGGAL SEBELUM HARI INI */
    function disablePastDates() {
        // Dapatkan tanggal saat ini.
        const today = new Date();

        // Tambahkan 1 hari untuk mendapatkan tanggal berikutnya.
        today.setDate(today.getDate() + 1);

        // Format tanggal berikutnya 'YYYY-MM-DD'
        const nextDayFormatted = today.toISOString().split('T')[0];

        // dapatkan element by its ID
        const inputTanggal = document.getElementById('tanggal_berlaku');

        // Atur atribut 'min' menjadi tanggal berikutnya setelah hari ini.
        inputTanggal.setAttribute('min', nextDayFormatted);
    }


    // Panggil fungsi untuk menonaktifkan tanggal-tanggal sebelumnya saat halaman dimuat.
    disablePastDates();

    // Panggil fungsi enableNoIdField saat halaman dimuat (untuk mengatur status read-only pertama kali)
    enableNoIdField();

    /* VALIDASI MAX LENGTH IDENTITAS */
    /*
    function validateNoIdLength(input) {
        const maxLength = 16; // Set the maximum length for no_id field
        const value = input.value.trim();
        const isValidLength = value.length <= maxLength;

        if (isValidLength) {
            input.setCustomValidity(''); // Clear the validation message
        } else {
            input.setCustomValidity('No ID must not exceed ${maxLength} characters.');
        }
    }
    */

    /* VALIDASI NUMBER */
    function allowOnlyNumericInput(event) {
        const charCode = event.which ? event.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            event.preventDefault();
        }
    }

    function enableNoIdField() {
        var jenisIdSelect = document.getElementById("jenis_id");
        var noIdInput = document.getElementById("no_id");

        if (jenisIdSelect.value === "") {
            noIdInput.setAttribute("readonly", "readonly");
        } else {
            noIdInput.removeAttribute("readonly");
        }

        var jenisIdElement = document.getElementById("jenis_id");
        var noIdElement = document.getElementById("no_id");

        var selectedValue = jenisIdElement.value;
        var maxLength = 0;

        switch (selectedValue) {
            case "KTP":
                maxLength = 16;
                break;
            case "SIM":
                maxLength = 14;
                break;
            case "PASPORT":
                maxLength = 9;
                break;
            case "ID_TERSEDIA":
                maxLength = 6;
                break;
            default:
                maxLength = 0;
                break;
        }

        noIdElement.maxLength = maxLength;

        // Adjust the input value if changing from a different ID type
        if (selectedValue !== previousSelectedValue) {
            noIdElement.value = noIdElement.value.slice(0, maxLength);
        }

        previousSelectedValue = selectedValue;
    }

    function validateNoIdInput() {
        var inputElement = document.getElementById("no_id");
        var inputValue = inputElement.value;
        var sanitizedValue = inputValue.replace(/[^0-9]/g, ''); // Menghapus karakter selain angka
        inputElement.value = sanitizedValue;
    }


    // /* VALIDASI JENIS ID */

    /* OPEN MODAL */
    function openModal() {
        //document.getElementById("myModal").style.display = "block";
        $("#myModal").modal('show');
        // Access the webcam video element
        const videoElement = document.getElementById("videoElement");

        // Check if the browser supports mediaDevices and getUserMedia
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            // Get user media (i.e., the webcam stream)
            navigator.mediaDevices
                .getUserMedia({
                    video: true
                })
                .then((stream) => {
                    videoElement.srcObject = stream;
                })
                .catch((error) => {
                    console.error("Error accessing webcam:", error);
                });
        } else {
            console.error("Webcam not supported in this browser.");
        }
    }

    /* CLOSE MODAL */
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    // Global variable to store the value of the "NOMOR IDENTITAS" input
    let noIdValue = "";

    // /* VALIDASI IDENTITAS */
    // function validateNoIdInput(inputElement) {
    //     noIdValue = inputElement.value;
    //     // Additional validation logic, if needed
    // }

    /* CAPTURE IMAGE TO save_image.php */
    function captureImage() {
        // Access the "NOMOR IDENTITAS" input element
        const no_id = $("#no_id");

        // Check if the input is empty
        if (no_id.val() === "") {
            //alert("Please enter the NOMOR IDENTITAS before capturing the image.");
            no_id.focus();
            $("#myModal").modal('hide');
            return;
        }

        // Access the webcam video element

        // Create a canvas element to capture the webcam image
        const video = document.getElementById("videoElement");
        const canvas = document.createElement("canvas");
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const context = canvas.getContext("2d");
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Get the captured image as a data URL
        const imageDataURL = canvas.toDataURL("image/png");

        // Display the captured image in the preview
        $("#previewGambar").attr("src", imageDataURL);

        // Access the value of the "NOMOR IDENTITAS" input using the global variable
        const noIdInputValue = no_id.val();

        /* UPLOAD VIA AJAX
        var fd = new FormData();
        fd.append('imageData', '');
        fd.append('noId', noIdInputValue);
        $.ajax({
            type: 'POST',
            url: 'save_image.php',
            data: fd,
            enctype: 'multipart/form-data',
            beforeSend: function(xhr) {},
            success: function() {},
            complete: function(xhr) {
                alert('Success');
                closeModal();
            },
            error: function() {
                alert('Gagal');
            }
        });
        */

        /* UPLOAD VIA DOM */
        const formData = new FormData();
        formData.append("imageData", imageDataURL);
        formData.append("noId", noIdInputValue);
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "save_image.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Handle success response from the server, if needed
                console.log("Image uploaded successfully!");
            } else {
                // Handle error response from the server, if needed
                console.error("Image upload failed:", xhr.responseText);
            }
        };
        xhr.send(formData);

        $("#myModal").modal('hide');

        const videoElement = document.getElementById("videoElement");
        const stream = videoElement.srcObject;
        if (stream) {
            const tracks = stream.getTracks();
            tracks.forEach((track) => track.stop());
            videoElement.srcObject = null;
        }

    }

    /* CONFIRM DELETE */
    function confirmDelete(nik) {
        if (confirm("Are you sure you want to delete this user?")) {
            // If user confirms, redirect to confirm_delete.php with the 'nik' parameter
            window.location.href = "confirm_delete.php?nik=" + nik;
        }
    }

    function handleClearClick(event) {
        event.preventDefault(); // Mencegah form submit ke other_action.php

        // Eksekusi AJAX atau Fetch untuk menjalankan fungsi di delete_files.php
        fetch('delete_files.php', {
                method: 'POST',
                // Tambahkan data atau konfigurasi lain yang diperlukan untuk delete_files.php
                // Contoh: body: JSON.stringify({ action: 'clear_files' }),
                headers: {
                    'Content-Type': 'application/json' // Tambahkan header jika menggunakan JSON
                }
            })
            .then(response => {
                // Handle response jika diperlukan
            })
            .catch(error => {
                // Handle error jika terjadi kesalahan dalam proses
            });
    }

    // function enableNoIdField() {
    //     var jenisIdSelect = document.getElementById("jenis_id");
    //     var noIdInput = document.getElementById("no_id");

    //     if (jenisIdSelect.value === "" || jenisIdSelect.value === "ID_TERSEDIA") {
    //         noIdInput.setAttribute("readonly", "readonly");
    //     } else {
    //         noIdInput.removeAttribute("readonly");
    //     }
    // }
    </script>
</body>

</html>