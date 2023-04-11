<?php 
include "connect.php";
require "nav.php";

session_start();
$id_pengguna = $_SESSION['id'];
if ($id_pengguna == ''){
    header('Location: Login.php');
}
// echo $id_pengguna;
?>

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
    <div class="card bg-dark text-white" style="display: grid; grid-template-columns: 1fr 1fr 1fr;" >
        <div></div>
        <section class="vh-100 gradient-custom">



            <div class="card-body p-5 text-center">
                <form method="POST">
                    <div class="mb-md-5 mt-md-4 pb-5">

                        <h2 class="fw-bold mb-2 text-uppercase">Register Toko</h2><br>

                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="nama_toko">Nama Toko</label>
                            <input type="text" id="nama_toko" class="form-control form-control-lg" name="nama_toko" />
                        </div>

                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="deskripsi">Deskripsi Toko</label>
                            <textarea id="deskripsi" class="form-control" name="deskripsi"></textarea>

                        </div>

                        <button class="btn btn-outline-light btn-lg px-5" type="submit" name="register">Buka Toko!</button>                    
                    </div>
                </form>
            </div>

        </section>
        <div></div>
    </div>

    <?php
    if(isset($_POST['register'])) {
        $errMsg = '';
            // Get data from FROM
        $nama_toko = $_POST['nama_toko'];
        $deskripsi = $_POST['deskripsi'];

        if($nama_toko== '')
            $errMsg = 'Isi Nama Toko';
        if($deskripsi == '')
            $errMsg = 'Isi Deskripsi';

        $insert = ("INSERT INTO `toko`(`id_toko`, `id_pengguna`, `nama_toko`, `deskripsi_toko`) VALUES (NULL,$id_pengguna,'$nama_toko','$deskripsi')");
        $conn->exec($insert);

        $update = ("UPDATE `pengguna` SET `status_toko`= 1 WHERE id_pengguna = $id_pengguna");
        $conn->exec($update);

        header('Location: profile.php');

    }

    ?>
