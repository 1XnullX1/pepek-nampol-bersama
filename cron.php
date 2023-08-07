<?php
// Connect to database
require('koneksi.php');

// Check for errors
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Update expired user data
$current_date = date("Y-m-d");
$result = mysqli_query($mysqli, "UPDATE user SET validation = 'Tidak_Aktif' WHERE tanggal_berlaku < '$current_date'");
if($result){
    echo'berhasil update';
}
else{
    echo'gagal jing';
}
// Close database connection
$mysqli->close();
?>
<meta http-equiv="refresh" content="10">
