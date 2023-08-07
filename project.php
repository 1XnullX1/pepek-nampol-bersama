<?php
include("koneksi.php");

$result = $mysqli->query("SELECT * FROM user");

?>




<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

<div class="container">





<?php if ($result->num_rows > 0) {
    echo "<div class='table-responsive'>
          <table class='table'>
          <tr><th>No ID</th><th>Nama</th><th>Alamat</th><th>No Telepon</th><th>Tanggal Berlaku</th><th>Status User</th><th>Validation</th><th>Select</th></tr>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Display data for each user in a row of the table
        echo "<tr><td>" . $row["no_id"] . "</td><td>" . $row["nama"] . "</td><td>" . $row["alamat"] . "</td><td>" . $row["no_telphone"] . "</td><td>" . $row["tanggal_berlaku"] . "</td><td>" . $row["status_user"] . "</td><td>" . $row["validation"] . "</td><td><button class='btn-primary btn-xs' onclick='selectUser(". $row["nik"] . ", \"" . $row["no_id"] . "\",\"" . $row["nama"] . "\", \"" . $row["alamat"] . "\", \"" . $row["no_telphone"] . "\", \"" . $row["tanggal_berlaku"] . "\", \"" . $row["status_user"] . "\", \"" . $row["validation"] . "\")'>Select</button></td></tr>";
    }
    
    echo "</table></div>";
}
?>

<body>

<script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
