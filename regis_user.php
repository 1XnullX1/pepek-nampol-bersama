
<!doctype html>
<html lang="en">
  <head>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <script src="path/to/jquery.min.js"></script>
  <script src="path/to/bootstrap.min.js"></script>
  <script src="validasi.js"></script>
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
      <h2>Input User</h2>
      <p class="lead">Silahkan memasukan data diri untuk access masuk</p>
    </div>
      
    <div class="col-md-12 col-lg-12">
  <form class="needs-validation" id="myForm" method="post" action="insert.php" onsubmit="return validateForm()">
    <div class="row g-3">

    <div class="col-7">
        <input type="text" class="form-control" id="nik" name="nik" placeholder="nik" readonly>
        <div class="invalid-feedback">
          p
        </div>
      </div>

      <div class="col-7">
        <label for="no_id" class="form-label">Nomor Identitas</label>
        <div class="input-group has-validation">
          <input type="text" class="form-control" id="no_id" name="no_id" placeholder="NOMOR IDENTITAS" required oninput="validateNoId(this)">
          <div class="invalid-feedback">
            Nomor ID dibutuhkan.
          </div>
        </div>
      </div>

      <div class="col-7">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required oninput="validateAlphabet(this)">
        <div class="invalid-feedback">
          Silahkan untuk mengisi nama.
        </div>
      </div>

      <div class="col-7">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" oninput="limitTextarea(this, 100)" required></textarea>
        <div class="invalid-feedback">
          Silahkan untuk mengisi alamat.
        </div>
      </div>

      <div class="col-7">
        <label for="no_telphone" class="form-label">Nomor Telepon</label>
        <input type="text" class="form-control" id="no_telphone" name="no_telphones" placeholder="Nomor Telepon" required oninput="validateNoId(this)">
        <div class="invalid-feedback">
          Silahkan untuk mengisi nomor telepon.
        </div>
      </div>

      <div class="col-7">
        <label for="tanggal_berlaku" class="form-label">Tanggal Berlaku</label>
        <input type="date" class="form-control" id="tanggal_berlaku" name="tanggal_berlaku" placeholder="Tanggal Berlaku" required>
        <div class="invalid-feedback">
          Silahkan untuk mengisi tanggal berlaku.
        </div>
      </div>


      <div class="col-7">
  <label for="status_user" class="form-label">Status User</label>
  <select class="form-control" id="status_user" name="status_user" required>
    <option value="" disabled selected>Status User</option>
    <option value="Karyawan">Karyawan</option>
    <option value="Outsourcing">Outsourcing</option>
    <option value="Tenan">Tenan</option>
  </select>
  <div class="invalid-feedback">
    Silahkan untuk memilih validation.
  </div>
</div>

<div class="col-7">
  <label for="validation" class="form-label">Validation</label>
  <select class="form-control" id="validation" name="validation" required>
    <option value="" disabled selected>Select Validation</option>
    <option value="Aktif">Aktif</option>
    <option value="Tidak_Aktif">Tidak Aktif</option>
  </select>
  <div class="invalid-feedback">
    Silahkan untuk memilih validation.
  </div>
</div>


    </div>

    <hr class="my-1">
    

    <div style="display: inline-block; margin-bottom: 20px;">
  <button class="w-100 btn btn-primary btn-lg" type="submit" name="submit">SUBMIT</button>
</div>
<div style="display: inline-block; margin-bottom: 20px;">
  <hr>
  <button class="w-100 btn btn-primary btn-lg" type="submit" name="update" onclick="setFormAction('update.php')">UPDATE</button>
</div>
<div style="display: inline-block; margin-bottom: 20px;">
  <hr>
  <button class="w-100 btn btn-primary btn-lg" type="submit" name="Delete" onclick="setFormAction('confirm_delete.php')">DELETE</button>
</div>

<div class="col-7">
  <div class="input-group">
    <input type="text" class="form-control" id="no_telphone" name="no_telphone" placeholder="Nomor ID Atau Nama" >
    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
  </div>
</div>




    <script>
function setFormAction(action) {
  document.getElementById("myForm").action = action;
}
</script>
  </form>
</div>
<hr>  

<div class="col-md-12 col-lg-12">
        <!-- Form code goes here -->
        <style>
  .table-responsive {
    height: 300px;
    overflow-y: scroll;
  }
</style>
<?php 
require('koneksi.php');

// Execute SQL query to retrieve all users from the database
$result = $mysqli->query("SELECT * FROM user");

// If the query returns at least one row, display the data in a table
if ($result->num_rows > 0) {
  echo "<div class='table-responsive'>
        <table class='table'>
        <tr><th>No ID</th><th>Nama</th><th>Alamat</th><th>No Telepon</th><th>Tanggal Berlaku</th><th>Status User</th><th>Validation</th><th>Select</th></tr>";
  
  // Output data of each row
  while ($row = $result->fetch_assoc()) {
      // Display data for each user in a row of the table
      echo "<tr><td>" . $row["no_id"] . "</td><td>" . $row["nama"] . "</td><td>" . $row["alamat"] . "</td><td>" . $row["no_telphone"] . "</td><td>" . $row["tanggal_berlaku"] . "</td><td>" . $row["status_user"] . "</td><td>" . $row["validation"] . "</td><td><button class='btn-primary btn-xs' onclick='selectUser(". $row["nik"] . ", \"" . $row["no_id"] . "\",\"" . $row["nama"] . "\", \"" . $row["alamat"] . "\", \"" . $row["no_telphone"] . "\", \"" . $row["tanggal_berlaku"] . "\", \"" . $row["status_user"] . "\", \"" . $row["validation"] . "\")'>Select</button></td></tr>";
  }
  
  echo "</table></div>";
  echo "<script>
function selectUser(nik,no_id,nama,alamat,no_telphone,tanggal_berlaku,status_user,validation) {
  document.getElementById('nik').value = nik;
  document.getElementById('no_id').value = no_id;
  document.getElementById('nama').value = nama;
  document.getElementById('alamat').value = alamat;
  document.getElementById('no_telphone').value = no_telphone;
  document.getElementById('tanggal_berlaku').value = tanggal_berlaku;
  document.getElementById('status_user').value = status_user;
  document.getElementById('validation').value = validation;

  
  var options = document.getElementById('status_user').options;
  if (status_user === 'Karyawan') {
    document.getElementById('status_user').selectedIndex = Karyawan;
  } else if (status_user === 'Outsourcing'){
    document.getElementById('status_user').selectedIndex = Outsourcing;
  } else {
    document.getElementById('status_user').selectedIndex = 3;
  }
  
  var options = document.getElementById('validation').options;
  if (validation === 'Aktif') {
    document.getElementById('validation').selectedIndex = Aktif;
  } else if (validation === 'Tidak_Aktif'){
    document.getElementById('validation').selectedIndex = Tidak_Aktif;
  } 
}

</script>";

}
 else {
  echo "No results found.";
}
?>




        
    </div>
    </div>
    
</div>

    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017–2022 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>


    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    

  </body>
</html>
