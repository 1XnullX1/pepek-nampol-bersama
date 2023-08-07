<?php
    // Include database connection code
    include_once 'koneksi.php';
    
    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form data
        $no_id = $_POST['no_id'];
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        
        // Prepare SQL statement
        $stmt = $mysqli->prepare("UPDATE admin SET nama=?, username=? WHERE no_id=?");
        $stmt->bind_param("ssi", $nama, $username, $no_id);
        
        // Execute SQL statement
        if ($stmt->execute()) {
            // If update was successful, redirect back to view page
            header("Location: view-admin.php");
            exit();
        } else {
            // If update failed, show error message
            echo "Error updating record: " . $mysqli->error;
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Admin</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/boostrap-datatables.css">
</head>

<body>
    <h1>Update Admin</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <input type="hidden" name="no_id" id="no_id" value="">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" value="">
        <br>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="">
        <br>
        <button type="submit">Update</button>
    </form>
    <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/datatables.net.js"></script>
    <script type="text/javascript" src="assets/js/dataTables.bootstrap4.min.js"></script>
</body>

</html>