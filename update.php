<?php
function copyFileToUpload($source_dir, $target_dir) {
    // Get the list of files in the source directory
    $files = glob($source_dir . "*");

     // Check if any files exist in the source directory
     if (empty($files)) {
        // No files in the source directory, so skip the copying process
        return;
    }


    // Loop through each file and copy it to the target directory
    foreach ($files as $file) {
        // Get the file name without the path
        $filename = basename($file);

        // Copy the file to the target directory
        $target_file = $target_dir . $filename;
        copy($file, $target_file);
    }
}

// Set the source and target directories
$source_dir = "foto_dumb/";
$target_dir = "foto/";


// Call the function to copy files from 'foto_dumb' to 'foto' directory
copyFileToUpload($source_dir, $target_dir);

function updateData()
{
    $jenis_id = $_POST['jenis_id'];
    $no_id = $_POST['no_id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal_hari_ini = $_POST['tanggal_mulai'];
    $tanggal_berlaku = $_POST['tanggal_berlaku'];
    $status_user = $_POST['status_user'];
    $validation = $_POST['validation'];
    $filename_with_extension =  $no_id. '.png';


    // Include database connection file
    include_once("koneksi.php");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Check if no_id exists in the user table
    $result = mysqli_query($mysqli, "SELECT * FROM user WHERE no_id='$no_id'");
    if (mysqli_num_rows($result) > 0) {
        // Update user data in the table
        $filename = isset($filename) ? ", lokasi_gambar='$filename'" : "";
        $result = mysqli_query($mysqli, "UPDATE user SET jenis_id='$jenis_id', nama='$nama', alamat='$alamat', tanggal_mulai='$tanggal_hari_ini', tanggal_berlaku='$tanggal_berlaku', status_user='$status_user', validation='$validation', lokasi_gambar ='$filename_with_extension'WHERE no_id='$no_id'");
        if ($result) {
            echo "<script>alert('Record updated successfully'); window.location='registrasi.php';</script>";
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }
    } else {
        // Alert if no_id doesn't exist
        echo "<script>alert('No Identitas not found'); window.location='registrasi.php';</script>";
    }

    // Close connection
    $mysqli->close();
}

if (isset($_POST['update'])) {
    updateData();
}
?>