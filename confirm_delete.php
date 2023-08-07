<?php
include('koneksi.php');
    if(isset($_POST['Delete'])) {
      $nik = $_POST['nik'];
      // Add confirm box
      echo "<script>
              if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
                window.location.href = 'confirm_delete.php?nik=$nik';
              } else {
                window.location.href = 'registrasi.php';
              }
            </script>";
    }
    
    if(isset($_GET['nik'])) {
      $nik = $_GET['nik'];
      
      $result = mysqli_query($mysqli, "DELETE FROM user WHERE nik='$nik' ");
      if ($result) {
        echo "<script>
                alert('Data terhapus!');
                window.location.href = 'registrasi.php';
              </script>";
      } else {
        echo "Error: " . $result . "<br>" . mysqli_error($mysqli);
      }
    }
    
?>

    