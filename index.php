<?php
  include('Controller/controller.data.config.php');
  // disini untuk menonaktifkan error display pada PHP! jika 1 = tampil, Jika 0 = tidak tampil.
   error_reporting(0);
  
  // Session_Start Untuk menulis cookie session pada browser.
   session_start();
   // Fungsi yg di Declare di Folder Control dalam PHP > controller.data.config.php
   GetLoginAccess($mysqli);
  ?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $_TITLE_NAME;?></title>
</head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

<!--- Style signin CSS untuk memperbaiki / memperindah tampilan layout pada Form Login -->
<link href="assets/css/signin.css" rel="stylesheet">

<body class="text-center">
    <form class="form-signin" method="POST">
        <img class="mb-4" src="img/dfn.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Silahkan Masuk</h1>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="input" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; Dufan 2016 - 2023</p>
    </form>
</body>
<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>

</html>