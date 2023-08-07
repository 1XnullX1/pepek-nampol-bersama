<?php

$target_dir = "foto/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$filename = basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
  echo "<script>alert('Sorry file already exists.'); window.location='registrasi.php';</script>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 1048576) {
  echo "<script>alert('Maaf File Foto Anda Terlalu Besar diatas 1 MB'); window.location='registrasi.php';</script>";
  $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
  echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); window.location='registrasi.php';</script>";
  $uploadOk = 0;
}
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

    // Check if form submitted, insert form data into users table.
    if(!isset($_POST['Submit'])) {

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

        $jenis_id = $_POST['jenis_id'];
        $no_id = $_POST['no_id'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $tanggal_hari_ini = $_POST['tanggal_hari_ini'];
        $tanggal_berlaku = $_POST['tanggal_berlaku'];
        $status_user = $_POST['status_user'];
        $validation = $_POST['validation'];
        $fileToUpload = $_POST['fileToUpload'];
        
        // Include database connection file
        include_once("koneksi.php");
        
        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

           
        // Check if no_id exists in the user table
        $result = mysqli_query($mysqli, "SELECT * FROM user WHERE no_id='$no_id'");
        if(mysqli_num_rows($result) == 0) {
            // Insert user data into table
            $result = mysqli_query($mysqli, "INSERT INTO user (jenis_id, no_id, nama, alamat, tanggal_mulai, tanggal_berlaku, status_user, validation, lokasi_gambar) 
            VALUES ('$jenis_id','$no_id', '$nama', '$alamat', ' $tanggal_hari_ini', '$tanggal_berlaku', '$status_user', '$validation','$filename')");
            if ($result) {
                echo $result;
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