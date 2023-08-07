<?php 
require('koneksi.php');

if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
    $result = $mysqli->query("SELECT * FROM user WHERE no_id LIKE '%$search_term%' OR nama LIKE '%$search_term%'");
} else {
    $result = $mysqli->query("SELECT * FROM user");
}

if ($result->num_rows > 0) {
    echo "<div class='table-responsive'>
        <table class='table'>
            <thead>
                <tr>
                    <th>No ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Tanggal Berlaku</th>
                    <th>Status User</th>
                    <th>Validation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["no_id"] . "</td>
                <td>" . $row["nama"] . "</td>
                <td>" . $row["alamat"] . "</td>
                <td>" . $row["no_telphone"] . "</td>
                <td>" . $row["tanggal_berlaku"] . "</td>
                <td>" . $row["status_user"] . "</td>
                <td>" . $row["validation"] . "</td>
                <td><a href='modify-form.php?id=" . $row["no_id"] . "'>Edit</a></td>
            </tr>";
    }
    echo "</tbody></table></div>";
} else {
    echo "No results found.";
}
    
?>

<form action="" method="get">
    <div class="mb-3">
        <label for="search" class="form-label">Search by No ID or Nama</label>
        <input type="text" class="form-control" id="search" name="search" placeholder="Search">
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
</form>
