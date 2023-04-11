<?php
include 'nav.php';
require 'connect.php';
session_start();
?>

<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
<title>Hasil Transaksi</title>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-success navbar-dark">
  <a class="navbar-brand" href="#">"NAMA TOKO"</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="">&&&&&&</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">******</a>
      </li>
    </ul>
  </div>  
</nav>
<div class="row" style="margin-top:10px;">
                    <div class="col-12">
                    <body>
  <div style="display: grid; grid-template-columns: 1fr 3fr; grid-gap: 10px; padding: 45px">
        <?php 

        $select = "SELECT * FROM `keranjang` JOIN `barang`  JOIN 'pengguna' JOIN 'Transaksi' ON barang.id_barang = keranjang.id_barang WHERE `id_barang` = '$id_barang'";
        $stmt = $conn -> query($select);
        foreach ($stmt->fetchAll() as $row) {
          $nama_pengguna=($row['nama_pengguna']);
          $nama=($row['nama_barang']);
          $harga=($row['harga_barang']);
          $id_toko=($row['id_toko']);
          $id_transaksi=($row['id_transaksi']);
          $id_barang=($row['id_barang']);
        
          $deskripsi=($row['desc_barang']);
          $qty=($row['qty_barang']);
          $nama_toko = ($row['nama_toko']);

          $output =
          '
          <div>
            <ul class="list-group">

          <li class="list-group-item">Nama Pengguna : '.$nama_pengguna.'

          </li>
          <li class="list-group-item">Id Barang : '.$id_barang.'
          
          </li>
          <li class="list-group-item">Nama : '.$nama.' 

          </li>
          <li class="list-group-item">Id Transaksi : '.$id_transaksi.'

          </li>
          <li class="list-group-item">Kategori : '.$kategori.'

          </li>
          <li class="list-group-item">Deskripsi : 
          <p>
          '.$deskripsi.'
          </p>
          </li>

          ';
          echo $output;
        }

        ?>
      </ul>




    </div>

  </div>

</body>
                            </tbody>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

