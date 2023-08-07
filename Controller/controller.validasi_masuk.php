<?php
$MYSQL_CONFIG_HOST = "localhost";
$MYSQL_CONFIG_LOGIN = "root";
$MYSQL_CONFIG_PASSWORD = "";
$MYSQL_CONFIG_DATABASE_NAME= "skripsi";

$mysqli = mysqli_connect($MYSQL_CONFIG_HOST, $MYSQL_CONFIG_LOGIN, $MYSQL_CONFIG_PASSWORD, $MYSQL_CONFIG_DATABASE_NAME);
if (!$mysqli) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}

// Seo Page Controller.
$_TITLE_NAME = "DUFAN IMPIAN JAYA ANCOL";


function PreviewData($mysqli) {
    if (isset($_POST['submit'])) {
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
            } else {
                // Alert if no_id does not exist
                echo "<div class='alert alert-danger mt-4'>No Identitas tidak ditemukan.</div>";
            }
            $jam_tanggal_masuk = date('Y-m-d H:i:s');
$status = "1";
            $insertQuery = "INSERT INTO user_log (nik, date, time_stamp_in, condition)
            VALUES ('$no_id', '$date', '$time_stamp_in', '$condition')";

// if ($mysqli->query($insertQuery) === TRUE) {
//     echo "Data inserted successfully into user_log table.";
// } else {
//     echo "Error: " . $insertQuery . "<br>" . $mysqli->error;
// }

            // Close connection
            $mysqli->close();
        }
    }
}



?>