<?php
// Check if form submitted, insert form data into users table.
if (isset($_POST['Submit'])) {
    $nik = $_POST['nik'];

    // Include database connection file
    include_once("koneksi.php");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Retrieve the 'lokasi_gambar' column data based on 'nik'
    $query = "SELECT lokasi_gambar FROM user WHERE nik='$nik'";
    $result = mysqli_query($mysqli, $query);
    if (!$result) {
        echo "Error: " . $result . "<br>" . mysqli_error($mysqli);
        $mysqli->close();
        exit;
    }

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $lokasi_gambar = $row['lokasi_gambar'];

        // Delete user data from table
        $delete_query = "DELETE FROM user WHERE nik='$nik'";
        $delete_result = mysqli_query($mysqli, $delete_query);
        if (!$delete_result) {
            echo "Error: " . $delete_result . "<br>" . mysqli_error($mysqli);
            $mysqli->close();
            exit;
        }

        // Delete the file in the 'foto/' folder with the same filename as 'lokasi_gambar'
        $foto_path = 'foto/' . $lokasi_gambar;
        if (file_exists($foto_path)) {
            unlink($foto_path);
        }

        echo "<script>alert('Data Terdelete');window.location='registrasi.php';</script>";
    } else {
        echo "No record found for the given 'nik'.";
    }

    // Close connection
    $mysqli->close();
}
?>