<?php

$server 	= "127.0.0.1"; //nama server db
$username	= "root"; //username server
$pass		= ""; //pass db
$db 		= "skripsi"; //sesuaikan nama databasenya
$mysqli = mysqli_connect($server, $username, $pass, $db);
// $koneksi = mysqli_connect($server, $username, $pass, $db); //pastikan urutan pemanggilan variabel nya sama.

//untuk cek jika koneksi gagal ke database

if (!$mysqli) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}
 