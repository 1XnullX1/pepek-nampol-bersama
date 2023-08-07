<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/datatable.css">
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
    <script src="assets/js/bootstrap.min.js"></script>

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>CETAK ID</h2>
            </div>


            <!-- <div class="id-card">
                <p><label for="no_id">No ID:</label> <span id="no_id"></span></p>
                <p><label for="nama">Nama:</label> <span id="nama"></span></p>
                <p><label for="tanggal_berlaku">Tanggal Berlaku:</label> <span id="tanggal_berlaku"></span></p>
                <img id="lokasi_gambar" src="" alt="Foto">
            </div> -->

            <?php 
            include "phpqrcode/qrlib.php";
            require('koneksi.php');

            // Execute SQL query to retrieve all users from the database
            $result = $mysqli->query("SELECT * FROM user");
            // If the query returns at least one row, display the data in a table
            if ($result->num_rows > 0) {
            ?>

            <div class='table-responsive'>
                <table class='table' id="datatables">
                    <thead>
                        <tr>
                            <th>No ID</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal Berlaku</th>
                            <th>Status User</th>
                            <th>Validation</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    while ($row = $result->fetch_assoc()) {
                    // Display data for each user in a row of the table
                      echo "<tr>
                              <td>" . $row["no_id"] . "</td>
                              <td>" . $row["nama"] . "</td>
                              <td>" . $row["alamat"] . "</td>
                              <td>" . $row["tanggal_berlaku"] . "</td>
                              <td>" . $row["status_user"] . "</td>
                              <td>" . $row["validation"] . "</td>
                              <td>
                                <button class='btn-primary btn-xs' onclick='selectUser(". $row["nik"] . ", \"" . $row["no_id"] . "\",\"" . $row["nama"] . "\", \"" . $row["alamat"] . "\", \"" . $row["tanggal_berlaku"] . "\", \"" . $row["status_user"] . "\", \"" . $row["validation"] . "\", \"" . $row["lokasi_gambar"] . "\")' data-toggle='modal' data-target='#idCardModal'>Select</button>
                              </td>
                            </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
              }else{
                echo "No Result";
              }
            ?>

            <!-- Modal Dialog -->
            <div class="modal fade" id="idCardModal" tabindex="-1" role="dialog" aria-labelledby="idCardModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="idCardModalLabel">ID Card</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modalContent">
                            <div class="row">
                                <div class="col-md-6">
                                    <img id="lokasi_gambar" src="" alt="Foto" width="150" height="150"></br></br>
                                    <p id="nama">p</p>
                                    <p id="tanggal_berlaku">p</p>
                                </div>
                                <div class="col-md-6">
                                    <img class="qrCodes" id="qrCode" src="" alt="QR Code" width="200" height="200">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" id="printBtn">Cetak</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            // Function to generate and display the QR Code
            function generateQRCode($value) {
              // Set the QR Code options
              $errorCorrectionLevel = 'L'; // L - low, M - medium, Q - quartile, H - high
              $matrixPointSize = 5; // Size of each matrix point

              // Generate the QR Code image
              $tempDir = 'temp/'; // Directory to store temporary QR Code images
              $fileName = $tempDir . uniqid() . '.png'; // Generate a unique file name for the QR Code image
              QRcode::png($value, $fileName, $errorCorrectionLevel, $matrixPointSize, 2);

              // Display the QR Code image
              echo '<img id="qrCode" src="' . $fileName . '" alt="QR Code" width="200" height="200">';
            }
            ?>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

            <script>
            // Fungsi untuk mencetak modal sebagai file PNG
            function printModal() {
                const modalContent = document.getElementById('modalContent');

                // Menggunakan html2canvas untuk membuat screenshot modal
                html2canvas(modalContent).then(function(canvas) {
                    // Membuat link untuk mengunduh file PNG
                    const link = document.createElement('a');
                    link.href = canvas.toDataURL('image/png');
                    link.download = 'id_card.png';

                    // Klik pada link untuk mengunduh file PNG
                    link.click();
                });
            }

            // Event listener untuk tombol cetak
            document.getElementById('printBtn').addEventListener('click', printModal);

            /*
            function selectUser(nik, no_id, nama, alamat, no_telphone, tanggal_berlaku, status_user, validation,
                lokasi_gambar) {
                // Update the modal's content with the selected user's information

                var lokasi_gambar = 'foto/' + lokasi_gambar;
                document.getElementById('lokasi_gambar').src = lokasi_gambar;
                document.getElementById('nama').textContent = "Nama: " + nama;
                document.getElementById('tanggal_berlaku').textContent = "Tanggal Berlaku: " + tanggal_berlaku;
            }
            */

            function selectUser(nik, no_id, nama, alamat, tanggal_berlaku, status_user, validation,
                lokasi_gambar) {
                var lokasi_gambar = 'foto/' + lokasi_gambar;
                document.getElementById("lokasi_gambar").src = lokasi_gambar;
                document.getElementById("nama").innerText = nama;
                document.getElementById("tanggal_berlaku").innerText = tanggal_berlaku;

                // Generate the QR Code
                generateQRCode(no_id);
            }

            function generateQRCode(value) {
                // Make an AJAX request to a PHP file to generate the QR Code
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Update the QR Code image source
                        document.getElementById("qrCode").src = xhr.responseText;
                    }
                };
                xhr.open("GET", "generate_qr_code.php?value=" + value, true);
                xhr.send();
            }
            </script>

            <script src="path/to/jquery.min.js"></script>
            <script src="path/to/bootstrap.min.js"></script>
            <script src="validasi.js"></script>
            <script src="qrcode.min.js"></script>
            <script src="assets/js/datatable.js"></script>

            <script>
            $(document).ready(function() {
                $("#datatables").DataTable();
            });
            </script>
</body>

</html>