<?php
    // Check if form submitted, insert form data into users table.
    if(!isset($_POST['Submit'])) {
        $nik = $_POST['nik'];
        
        
        // Include database connection file
        include_once("koneksi.php");
        
        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
           
        
        // Update user data into table
        $result = mysqli_query($mysqli, "DELETE FROM user WHERE nik='$nik' ");
        if ($result) {
   
            echo "<script>alert('Data Terdelete');window.location='registrasi.php';</script>";
        
        } else {
            echo "Error: " . $result . "<br>" . mysqli_error($mysqli);
        }



        
        // Close connection
        $mysqli->close();
    }
?>
