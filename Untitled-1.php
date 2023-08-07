
<!doctype html>
<html lang="en">
  <head>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
      <h2>Registrasi ID</h2>
      <p class="lead">Silahkan memasukan data diri untuk access masuk</p>
    </div>
      
    <div class="col-md-12 col-lg-12">
  <form class="needs-validation" id="myForm" method="post" action="insert.php" onsubmit="return validateForm()">
    <div class="row g-3">

      <div class="col-7">
        <label for="no_id" class="form-label">Nomor Identitas</label>
        <div class="input-group has-validation">
          <input type="text" class="form-control" id="no_id" name="no_id" placeholder="NOMOR IDENTITAS" required>
          <div class="invalid-feedback">
            Nomor ID dibutuhkan.
          </div>
        </div>
      </div>

      <div class="col-7">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
        <div class="invalid-feedback">
          Silahkan untuk mengisi nama.
        </div>
      </div>

      <div class="col-7">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required></textarea>
        <div class="invalid-feedback">
          Silahkan untuk mengisi alamat.
        </div>
      </div>

      <div class="col-7">
        <label for="no_telphone" class="form-label">Nomor Telepon</label>
        <input type="text" class="form-control" id="no_telphone" name="no_telphone" placeholder="Nomor Telepon" required>
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
        <input type="text" class="form-control" id="status_user" name="status_user" placeholder="Status User" required>
        <div class="invalid-feedback">
          Silahkan untuk mengisi status user.
        </div>
      </div>

      <div class="col-7">
        <label for="validation" class="form-label">Validation</label>
        <input type="text" class="form-control" id="validation" name="validation" placeholder="Validation" required>
        <div class="invalid-feedback">
          Silahkan untuk mengisi validation.
        </div>
      </div>

    </div>

    <hr class="my-4">
    

    <button class="w-50 btn btn-primary btn-lg" type="submit" name="submit">SUBMIT</button>
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
$result = $mysqli->query("SELECT * FROM user");

if ($result->num_rows > 0) {
  echo "<div class='table-responsive'>
  <table class='table-responsive'>";
  echo "<tr><th>No ID</th><th>Nama</th><th>Alamat</th><th>No Telepon</th><th>Tanggal Berlaku</th><th>Status User</th><th>Validation</th></tr>";
  // output data of each row
  while ($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["no_id"] . "</td><td>" . $row["nama"] . "</td><td>" . $row["alamat"] . "</td><td>" . $row["no_telphone"] . "</td><td>" . $row["tanggal_berlaku"] . "</td><td>" . $row["status_user"] . "</td><td>" . $row["validation"] . "</td></tr>";
  }
  echo "</table>";
} else {
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
