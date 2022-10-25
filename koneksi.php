<?php

$server 	= "127.0.0.1"; //nama server db
$username	= "root"; //username server
$pass		= ""; //pass db
$db 		= "skripsi"; //sesuaikan nama databasenya
$koneksi = mysqli_connect($server, $username, $pass, $db); //pastikan urutan pemanggilan variabel nya sama.
echo "<div id='failedMessage'>koneksi ok.</div>";
//untuk cek jika koneksi gagal ke database
if(mysqli_connect_errno()) {
	echo "Koneksi gagal : ".mysqli_connect_error();
}