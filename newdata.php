<?php
  include('Controller/controller.data.config.php');
  // disini untuk menonaktifkan error display pada PHP! jika 1 = tampil, Jika 0 = tidak tampil.
   error_reporting(1);
  // Session_Start Untuk menulis cookie session pada browser.
   session_start();
   // Fungsi yg di Declare di Folder Control dalam PHP > controller.data.config.php
   ProtectAccessAdmin($mysqli);
   InsertUserAdminRole($mysqli);
   UpdateUSerAdminRole($mysqli);
   DeleteUserAdminRole($mysqli)
   
  ?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Checkout example for Bootstrap</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/boostrap-datatables.css">
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">ADMIN PANEL</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="newdata.php">Registrasi Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registrasi_admin.php">Registrasi ID</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cetak_id_admin.php">CETAK ID</a>
                    </li>
                    <a class="nav-link" href="analisis_admin.php">Analisis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="assets/js/bootstrap.min.js"></script>

    <div class="container">


        <div class="container">
            <div class="py-5 text-center">

                <img class="d-block mx-auto mb-4" src="img/dfn.png" alt="" width="72" height="72">
                <h2>Dufan Ancol</h2>
                <p class="lead">Register Account.</p>
            </div>

            <div class="row">
                <div class="col-md-8 order-md-2 mb-8">
                    <?php CallingViewAdminRole($mysqli); ?>
                </div>
                <div class="col-md-4 order-md-1">
                    <h4 class="mb-3">Insert Account</h4>
                    <form class="needs-validation" method="POST" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Nomor </label>
                                <input type="text" class="form-control" id="nik" placeholder="" value="" readonly>
                                <div class="invalid-feedback">
                                    none
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Nomor ID</label>
                                <input type="text" class="form-control" id="no_id" name="no_id" placeholder="" value=""
                                    required>
                                <div class="invalid-feedback">
                                    Nomor ID diperlukan.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Nama</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"
                                    required>
                                <div class="invalid-feedback" style="width: 100%;">
                                    Nama diperlukan.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Alamat</label>
                            <div class="input-group">
                                <textarea type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Alamat" required></textarea>
                                <div class="invalid-feedback" style="width: 100%;">
                                    Alamat diperlukan.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="telphone">Nomer Telphone</label>
                            <input type="text" class="form-control" id="no_telphone" name="no_telphones"
                                placeholder="Nomer Telphone">
                            <div class="invalid-feedback">
                                Nomer Telphone diperlukan.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" id="username" name="usernames"
                                placeholder="Username" required>
                            <div class="invalid-feedback">
                                Silahkan masukan username.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                            <div class="invalid-feedback">
                                Silahkan masukan password.
                            </div>
                        </div>
                        <hr class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-lg btn-block" type="submit"
                                    name="register">Register</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary   btn-lg btn-block" type="submit"
                                    name="update">Update</button>
                            </div>
                        </div>

                        <hr class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-secondary btn-lg btn-block" type="submit"
                                    name="delete">Delete</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-secondary   btn-lg btn-block" type="submit"
                                    name="Clear">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <footer class="my-5 pt-5 text-muted text-center text-small">
                <p class="mb-1">&copy; 2017-2018 Company Name</p>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Privacy</a></li>
                    <li class="list-inline-item"><a href="#">Terms</a></li>
                    <li class="list-inline-item"><a href="#">Support</a></li>
                </ul>
            </footer>
        </div>

        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
        </script>
        <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/datatables.net.js"></script>
        <script type="text/javascript" src="assets/js/dataTables.bootstrap4.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
        </script>
</body>

</html>