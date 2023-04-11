<!DOCTYPE HTMl>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

<section class="vh-100 gradient-custom">
<div class="container py-5 h-100">
<div class="row d-flex justify-content-center align-items-center h-100">
<div class="col-12 col-md-8 col-lg-6 col-xl-5">
<div class="card bg-dark text-white" style="border-radius: 1rem;">
<?php
if(isset($errMsg)){
    echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
}
?>
<div class="card-body p-5 text-center">
<form method="POST">
<div class="mb-md-5 mt-md-4 pb-5">

<h2 class="fw-bold mb-2 text-uppercase">Register</h2>

<div class="form-outline form-white mb-4">
<input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" />
<label class="form-label" for="typeEmailX">Email</label>
</div>

<div class="form-outline form-white mb-4">
<input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" />
<label class="form-label" for="typePasswordX">Password</label>
</div>

<div class="form-outline form-white mb-4">
<input type="text" id="typeUsernamex" class="form-control form-control-lg" name="user_name" />
<label class="form-label" for="typeUsernamex">Nama Lengkap</label>
</div>

<div class="form-outline form-white mb-4">
<input type="text" id="typeAddressx" class="form-control form-control-lg" name="address" />
<label class="form-label" for="typeAddressx">Address</label>
</div>

<div class="form-outline form-white mb-4">
<input type="text" id="typeUserphoneNumx" class="form-control form-control-lg" name="user_phonenum" />
<label class="form-label" for="typeUserphoneNumx">Phone Number</label>
</div>
<p class="mb-0">Done register? now check your account <a href="Login.php" class="text-white-50 fw-bold">login</a></p>

<button class="btn btn-outline-light btn-lg px-5" type="submit" name="register">Sign Up</button>                    
</div>
</form>

</div>
</div>
</div>
</div>
</section>
<?php
include "connect.php";

if(isset($_POST['register'])) {
    $errMsg = '';
    
    // Get data from FROM
    $id = NULL;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['user_name'];
    $address = $_POST['address'];
    $user_phonenum = $_POST['user_phonenum'];
    
    if($email== '')
    $errMsg = 'Enter your fullname';
    if($password == '')
    $errMsg = 'Enter password';
    if($username == '')
    $errMsg = 'Enter username';
    if($address == '')
    $errMsg = 'Enter your address';
    if($user_phonenum == '')
    $errMsg = 'Enter your phone num';
    
    if($errMsg == ''){
        try {
            $stmt = $conn->prepare('INSERT INTO pengguna (id_pengguna, email_pengguna, password_pengguna, nama_pengguna,alamat_pengguna,nomortelp_pengguna) VALUES (:id,:email, :password, :username, :address, :user_phonenum)');
            $stmt->execute(array(
                ':id' => $id,
                ':email' => $email,
                ':password' => $password,
                ':username' => $username,
                ':address' => $address,
                'user_phonenum' => $address
            ));
            header('Location: Login.php?action=joined');
            exit;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}

if(isset($_GET['action']) && $_GET['action'] == 'joined') {
    $errMsg = 'Registration successfull. Now you can <a href="login.php">login</a>';
}
?>
