<!DOCTYPE html>
<html>
<head>
	<title>Form Login</title>
</head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<body>
	<div class="container col-md-6 mt-4">
		 <form method="POST">
    <img class="mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>

	

 	<button class="w-100 btn btn-lg btn-primary" type="submit" name="enter" value="enter">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
	
  </form>
		</div>
	</div>
  
  <?php
  // if ($_GET['action'] =='not_yet_logged_in')
  // {
  //   echo "<div id ='infoMessage'>Anda Belum Login.</div>";
  // }
  if ($_POST)
  {
    $username = 'XnullX';
    $password = 'XnullX';

    if($_POST['username']==$username &&
    $_POST['password']==$password){
      $_SESSION['loged_in'] = true;
      header('location: koneksi.php');
      echo "<div id='failedMessage'>Ok.</div>";
    }
    else
    {
      echo "<div id ='failedMessage'>Akses ditolak.</div>";
    }
  }
  ?>
  <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>