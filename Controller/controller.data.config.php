<?php

$MYSQL_CONFIG_HOST = "localhost";
$MYSQL_CONFIG_LOGIN = "root";
$MYSQL_CONFIG_PASSWORD = "";
$MYSQL_CONFIG_DATABASE_NAME= "skripsi";

$mysqli = mysqli_connect($MYSQL_CONFIG_HOST, $MYSQL_CONFIG_LOGIN, $MYSQL_CONFIG_PASSWORD, $MYSQL_CONFIG_DATABASE_NAME);
if (!$mysqli) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}

// Seo Page Controller.
$_TITLE_NAME = "DUFAN IMPIAN JAYA ANCOL";


// Create Login Function for Index.php Login Selection by roles.

function GetLoginAccess($mysqli) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($mysqli, $_POST['username']);
        $password = mysqli_real_escape_string($mysqli, $_POST['password']);
        $hashedPassword = md5($password); // Encrypt the input password using MD5

        $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$hashedPassword' AND (role ='1' OR role = '2')";
        $result = mysqli_query($mysqli, $sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            if ($row['role'] == '1') {
                header("Location: newdata.php");
                exit();
            } else if ($row['role'] == '2') {
                header("Location: registrasi.php");
                exit();
            }
        } else {
            echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
        }
    }
}


function ProtectAccessAdmin($mysqli){
    if(!isset($_SESSION["username"]) || !isset($_SESSION["role"])) {
        header("Location: index.php");
        exit();
    }
    
    $username = $_SESSION["username"];
    $role = $_SESSION["role"];
    
    // check user role in database
    $sql = "SELECT * FROM admin WHERE username = '$username' AND role = '$role'";
    $result = mysqli_query($mysqli, $sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['role'] == '1') {
            // user with role 1 has access to the protected content
        } else {
            // user with role 2 or other roles does not have access to the protected content
            echo "<script>alert('Anda tidak memiliki akses untuk melihat file ini | Force Logout'); window.location.href='logout.php';</script>";
            exit();
        }
    } else {
        // if the user's role cannot be found in the database, log them out
        header("Location: logout.php");
        exit();
    }
}

function ProtectAccessUser($mysqli){
    if(!isset($_SESSION["username"]) || !isset($_SESSION["role"])) {
        header("Location: login.php");
        exit();
    }
    
    $username = $_SESSION["username"];
    $role = $_SESSION["role"];
    
    // check user role in database
    $sql = "SELECT * FROM admin WHERE username = '$username' AND role = '$role'";
    $result = mysqli_query($mysqli, $sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['role'] == '1') {
            // user with role 1 has access to the protected content
        } else {
            // user with role 2 or other roles does not have access to the protected content
            echo "<script>alert('Anda tidak memiliki akses untuk melihat file ini | Force Logout'); window.location.href='logout.php';</script>";
            exit();
        }
    } else {
        // if the user's role cannot be found in the database, log them out
        header("Location: logout.php");
        exit();
    }
}

function InsertUserAdminRole($mysqli){
    if(isset($_POST['register'])) {
        $no_id = $_POST['no_id'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telpon = $_POST['no_telphones'];
        $username = $_POST['usernames'];
        $password = md5($_POST['password']);

        // Check if any required field is empty
        if (empty($no_id) || empty($nama) || empty($alamat) || empty($telpon) || empty($username) || empty($password)) {
            echo "<script>alert('Please fill in all the required fields');window.location='newdata.php';</script>";
            return;
        }
           
        // Check if no_id exists in the admin table
        $result = mysqli_query($mysqli, "SELECT * FROM admin WHERE no_id='$no_id'");
        if(mysqli_num_rows($result) == 0) {
            // Insert user data into table
            $result = mysqli_query($mysqli, "INSERT INTO admin (no_id, nama, alamat, no_telphone, username, password, role) 
            VALUES ('$no_id', '$nama', '$alamat', '$telpon', '$username', '$password', '2')");
            if ($result) {
                echo $result;
                echo "<script>alert('New record created successfully');window.location='newdata.php';</script>";
            } else {
                echo "Error: " . $result . "<br>" . mysqli_error($mysqli);
            }
        } else {
            // Alert if no_id already exists
            echo "<script>alert('No Identitas sudah ada');window.location='newdata.php';</script>";
        }
        
        // Close connection
        $mysqli->close();
    }
}


function UpdateUserAdminRole($mysqli) {
    if (isset($_POST['update'])) {
        $no_id = $_POST['no_id'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telpon = $_POST['no_telphones'];
        $username = $_POST['usernames'];
        $password = md5($_POST['password']);

        // Check if no_id exists in the admin table
        $result = mysqli_query($mysqli, "SELECT * FROM admin WHERE no_id='$no_id'");
        if (mysqli_num_rows($result) > 0) {
            // Update user data in the table
            $query = "UPDATE admin SET nama='$nama', alamat='$alamat', no_telphone='$telpon', username='$username', password='$password' WHERE no_id='$no_id'";
            $result = mysqli_query($mysqli, $query);
            if ($result) {
                echo "<script>alert('Record updated successfully');window.location='newdata.php';</script>";
            } else {
                echo "Error: " . $result . "<br>" . mysqli_error($mysqli);
            }
        } else {
            // Alert if no_id doesn't exist
            echo "<script>alert('No Identitas tidak ditemukan');window.location='newdata.php';</script>";
        }
        // Close connection
        $mysqli->close();
    }
}
 

function DeleteUserAdminRole($mysqli) {
    if (isset($_POST['delete'])) {
        $no_id = $_POST['no_id'];

        // Check if no_id exists in the admin table
        $result = mysqli_query($mysqli, "SELECT * FROM admin WHERE no_id='$no_id'");
        if (mysqli_num_rows($result) > 0) {
            // Delete the record from the table
            $query = "DELETE FROM admin WHERE no_id='$no_id'";
            $result = mysqli_query($mysqli, $query);
            if ($result) {
                echo "<script>alert('Record deleted successfully');window.location='newdata.php';</script>";
            } else {
                echo "Error: " . $result . "<br>" . mysqli_error($mysqli);
            }
        } else {
            // Alert if no_id doesn't exist
            echo "<script>alert('No Identitas tidak ditemukan');window.location='newdata.php';</script>";
        }
        $mysqli->close();
    }
}



function CallingViewAdminRole($mysqli){
    $html = '<table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">No ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nomor ID</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>';   
    
    $result = $mysqli->query("SELECT * FROM admin WHERE role != 1");
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>
        <th scope="row">' . $row['no_id'] . '</th>
        <td>' . $row['nama'] . '</td>
        <td>' . $row['username'] . '</td>

        <td>
            <button class="btn btn-info btn-sm" onclick="selectUser(\'' . $row['nik'] . '\', \'' . $row["no_id"] . '\',\'' . $row["nama"] . '\', \'' . $row["alamat"] . '\', \'' . $row["no_telphone"] . '\', \'' . $row["username"] . '\', \'' . $row["password"] . '\')">Select</button>
        </td>
    </tr>';

    echo "<script>
    function selectUser(nik,no_id,nama,alamat,no_telphone,username,password) {
      document.getElementById('nik').value = nik;
      document.getElementById('no_id').value = no_id;
      document.getElementById('nama').value = nama;
      document.getElementById('alamat').value = alamat;
      document.getElementById('no_telphone').value = no_telphone;
      document.getElementById('username').value = username;
      document.getElementById('password').value = password;
    }
    
    </script>";

    }
    
    $html .= '</tbody></table>';
    
    echo $html;
}