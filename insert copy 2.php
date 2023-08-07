<?php

function copyFileToUpload($source_dir, $target_dir) {
    // Get the list of files in the source directory
    $files = glob($source_dir . "*");

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

// Continue with the rest of the code...

$target_file = $target_dir . basename($_FILES["fileimg"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));




// Move the uploaded file to the target directory with the updated filename
$target_file_with_extension = $target_dir . $filename_with_extension;
if (move_uploaded_file($_FILES["fileimg"]["tmp_name"], $target_file_with_extension)) {
    // Update the $filename variable with the correct value
    $filename = htmlspecialchars(basename($_FILES["fileimg"]["name"])) . ".png";
    echo "The file " . $filename . " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

// $filename = basename($_FILES["fileimg"]["name"]);
// $fileName = date('Ymd_His') . '.png';
// Add the ".png" extension to the filename and convert it to a string
//$no_id = $_GET['no_id'];

// mew
// $filename_with_extension = basename($_FILES["fileimg"]["name"]);

// Check if form submitted, insert form data into users table.
if (!isset($_POST['Submit'])) {

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
    if (mysqli_num_rows($result) == 0) {
        // Insert user data into table with the filename including ".png" extension
        $result = mysqli_query($mysqli, "INSERT INTO user (jenis_id, no_id, nama, alamat, tanggal_mulai, tanggal_berlaku, status_user, validation, lokasi_gambar) 
        VALUES ('$jenis_id','$no_id', '$nama', '$alamat', ' $tanggal_hari_ini', '$tanggal_berlaku', '$status_user', '$validation','$filename_with_extension')");        
        if ($result) {
            echo $result;
            // Call the function to delete files in 'foto_dumb' folder
            include_once("delete_files.php");
            echo "<script>alert('New record created successfully');window.location='registrasi.php';</script>";
        } else {
            echo "Error: " . $result . "<br>" . mysqli_error($mysqli);
        }
    } else {
        // Alert if no_id already exists
        echo "<script>alert('No Identitas sudah');window.location='registrasi.php';</script>";
    }

    // Close connection
    $mysqli->close();
}
?>