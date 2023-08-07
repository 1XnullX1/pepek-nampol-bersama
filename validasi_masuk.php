<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <script src="path/to/jquery.min.js"></script>
    <script src="path/to/bootstrap.min.js"></script>
    <script src="validasi.js"></script>
    <script type="text/javascript" src="instascan.min.js"></script>
    <script type="text/javascript" src="vue.min.js"></script>
    <script type="text/javascript" src="adapter.min.js"></script>
    <script>
    window.addEventListener('DOMContentLoaded', (event) => {
        // Fokus ke input box dengan id 'no_id'
        document.getElementById('no_id').focus();
    });

    // Get the current date and time
    var currentDate = new Date();
    var currentDateTimeString = currentDate.toLocaleString();

    // Set the current date and time in the "currentDateTime" element
    var currentDateTimeElement = document.getElementById("currentDateTime");
    currentDateTimeElement.textContent = "Current Date and Time: " + currentDateTimeString;
    </script>
    <style>
    .expired {
        background-color: #ffdddd;
    }

    .expired span {
        color: red;
    }

    .active {
        background-color: #ddffdd;
    }
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <div class="container">
            <main>

                <div class="py-5 text-center">

                    <h2>SCAN ID MASUK</h2>
                    <p class="lead">Silahkan scan untuk access masuk</p>
                    <div id="real-time-clock"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                </div>
                                <!-- <h2>QR Barcode Scanner</h2> -->
                                <video id="preview" width="100%" height="200px"></video>
                                <br>
                                <div class="col-auto">
                                    <label for="no_id2">No Identitas:</label>
                                </div>
                                <div class="col">

                                    <input type="text" class="form-control" id="no_id" name="no_id" required>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" id="submitBtn" name="submit"
                                        class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                        <?php
                        error_reporting(0);
                        
                        $condition_1 = "1";
                        $condition_2 = "2";
                        $condition_3 = "3";
                        $condition_4 = "4";
                        $condition_5 = "5";

                        
                        if (isset($_POST['submit'])) {
                            $no_id = $_POST['no_id'];

                            // Include database connection file
                            include_once("koneksi.php");

                            // Check connection
                            if ($mysqli->connect_error) {
                                die("Connection failed: " . $mysqli->connect_error);
                            }

                        
                            // Check if no_id exists in the user table
$result = mysqli_query($mysqli, "SELECT * FROM user WHERE no_id='$no_id'");
if (mysqli_num_rows($result) > 0) {
    // Fetch user data
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama'];
    $tanggal_berlaku = $row['tanggal_berlaku'];
    $lokasi_gambar = "foto/" . $row['lokasi_gambar'];
    $validation = $row['validation'];

    // Check if validation is "Tidak_Aktif" or tanggal_berlaku is less than the current date
    if ($validation == "Tidak_Aktif" || $tanggal_berlaku < date('Y-m-d')) {
        $condition = $condition_5;
    } else {
        $condition = $condition_3;
    }



    // Output user data
    ?>


                        <div class="card mt-4">
                            <img src="<?php echo $lokasi_gambar; ?>" class="card-img-top" alt="Kartu Masuk"
                                style="max-width: 480x; max-height: 400px;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $nama; ?></h5>
                                <p class="card-text">Tanggal Berlaku: <?php echo $tanggal_berlaku; ?></p>
                                <p class="card-text">Validation: <?php echo $validation; ?></p>
                            </div>
                        </div>


                        <?php
    date_default_timezone_set('Asia/Jakarta'); 

    $date = date('Y-m-d');
    $jam = date('H:i:s');
    $time = new DateTime($jam);
    $time_stamp_in = $time->format('H:i:s');
    $calculation_time = "0";
    $time_formatted = "0";

    // Check if there is an existing record with the same nik, date, and condition = 3
$checkQuery = "SELECT COUNT(*) as count FROM user_log WHERE nik = '$no_id' AND date = '$date' AND `condition` = '3'";
$result = $mysqli->query($checkQuery);
$row = $result->fetch_assoc();
$count = $row['count'];

if ($count > 0) {
    // If a record exists, insert a new entry with the appropriate condition
    $insertQuery = "INSERT INTO user_log (nik, date, time_stamp_in, time_stamp_out, calculation_time, `condition`)
                    VALUES ('$no_id', '$date', '$time_stamp_in', '$time_formatted', '$calculation_time', '4')";
    echo "<div style='text-align: center; color: red;'><h5 class='card-title'>KARTU INI SUDAH DISCAN</h5></div>";
} else {
    // If no record exists, insert a new entry with condition = 3
   

   
    $insertQuery = "INSERT INTO user_log (nik, date, time_stamp_in, time_stamp_out, calculation_time, `condition`)
                    VALUES ('$no_id', '$date', '$time_stamp_in', '$time_formatted', '$calculation_time', '3')";

   
}


    if ($mysqli->query($insertQuery) === TRUE) {
        // echo "Data inserted successfully into user_log table.";
    } else {
        // echo "Error: " . $insertQuery . "<br>" . $mysqli->error;
    }
    } else {
        // Alert if no_id does not exist
        echo "<div class='alert alert-danger mt-4'>No Identitas tidak ditemukan.</div>";
    }

// Close connection
$mysqli->close();

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
        </div>
    </div>

    <script>
    // Mendapatkan tanggal saat ini
    var currentDate = new Date();

    // Mendapatkan tanggal berlaku dari PHP
    var tanggalBerlaku = new Date("<?php echo $tanggal_berlaku; ?>");
    // Mendapatkan validation dari PHP
    var validation = "<?php echo $validation; ?>";


    // Membandingkan tanggal saat ini dengan tanggal berlaku
    if (currentDate > tanggalBerlaku) {
        var cardBody = document.querySelector(".card-body");
        var image = document.createElement("img");

        // Set properties for the image
        image.src = "img/seru.png";
        image.alt = "Expired";
        image.style.width = "20px";
        image.style.height = "20px";

        // Add CSS class to highlight the card body
        cardBody.classList.add("expired");

        // Append the image and text to the card body
        cardBody.appendChild(document.createElement("br"));
        cardBody.appendChild(image);

        var textNode = document.createTextNode("KARTU SUDAH TIDAK BERLAKU");
        var span = document.createElement("span");
        span.style.color = "red";
        span.appendChild(textNode);

        cardBody.appendChild(span);

        // Reload the page after 5 seconds
        setTimeout(function() {
            location.reload();
            window.location = 'validasi_masuk.php';
        }, 5000);
    } else if (currentDate < tanggalBerlaku && validation === "Tidak_Aktif") {
        var cardBody = document.querySelector(".card-body");
        var image = document.createElement("img");

        // Set properties for the image
        image.src = "img/seru.png";
        image.alt = "Expired";
        image.style.width = "20px";
        image.style.height = "20px";


        // Add CSS class to highlight the card body
        cardBody.classList.add("expired");

        // Append the image and text to the card body
        cardBody.appendChild(document.createElement("br"));
        cardBody.appendChild(image);

        var textNode = document.createTextNode("KARTU SUDAH TIDAK BERLAKU");
        var span = document.createElement("span");
        span.style.color = "red";
        span.appendChild(textNode);

        cardBody.appendChild(span);

        // Reload the page after 10 seconds
        setTimeout(function() {
            location.reload();
            window.location = 'validasi_masuk.php';
        }, 5000);

    } else if (currentDate < tanggalBerlaku && validation === "Aktif") {
        var cardBody = document.querySelector(".card-body");

        // menambahkan CSS class untuk highlight the card body
        cardBody.classList.add("active");

        // refres halaman setelah 5 detik
        setTimeout(function() {
            location.reload();
            window.location = 'validasi_masuk.php';
        }, 5000);
    }

    //mengupdate jam waktu secara real-time pada halaman web.
    function updateClock() {
        var now = new Date();
        var date = now.toDateString();
        var time = now.toLocaleTimeString();

        var clock = document.getElementById('real-time-clock');
        clock.innerHTML = date + ' ' + time;

        setTimeout(updateClock, 1000);
    }
    updateClock();
    </script>

    <script src="validasi_keluar.js"></script>
</body>

</html>