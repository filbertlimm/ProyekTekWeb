<?php
include 'nav.php';
require 'connect.php';
session_start();
$id_pengguna = $_SESSION['id'];
if ($id_pengguna == ''){
    header('Location: Login.php');
}
// echo $_GET["id_toko"];
$id_toko = $_GET["id_toko"];
// echo $id_toko;
$info_toko = "SELECT * FROM `toko` WHERE `id_toko`=".$id_toko;
$stmt = $conn->query($info_toko);
if($row = $stmt->fetch()){
  $nama_toko = $row['nama_toko'];
  $deskripsi_toko = $row['deskripsi_toko'];
}

?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->

<title>Detail</title>

</head>
<body>
 <div class="container mt-3" >
  <div class="card p-3 text-center">
    <div class="d-flex flex-row justify-content-center mb-3">
      <div class="image"> <img style="height: 140px;" src="https://www.hecmsenior.com/wp-content/uploads/2021/06/Profile-Pic-Icon.png" class="rounded-circle"> <span><i class='bx bxs-camera-plus'></i></span> 

        <div>
          <h4 class="mb-0"><?php echo $nama_toko ?></h4>
          <br>
          <h6 style="font-weight: lighter;" class="mb-0"><?php echo $deskripsi_toko ?></h6>
        </div>

      </div>
    </div>
  </div>

  <div>
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; grid-gap: 2px;">

      <?php
      $select = "SELECT * FROM `barang` WHERE `id_toko` =".$id_toko;
      $stmt = $conn -> query($select);
      foreach ($stmt->fetchAll() as $row) {
        $id_barang=($row['id_barang']);
        $nama=($row['nama_barang']);
        $harga=($row['harga_barang']);
        $id_toko=($row['id_toko']);
        $gambar=($row['gambar']);
        $output =
        '
        <div class="card col-14" style="width: auto; margin: 15px;">
        <a href="detail.php?id_barang='.$id_barang.'">
        <img style="object-fit: contain; height: 280px; padding: 15px" src="'.$gambar.'" class="card-img-top">

        </a>
        <div class="card-body">
        <h5 class="card-title" name="name" >'.$nama.'</h5>
        </div>
        <ul class="list-group list-group-flush">
        <li class="list-group-item">Rp. '.$harga.'</li>
        </ul>
        <div class="card-body">
        <img style="height: 35px" src="https://www.hecmsenior.com/wp-content/uploads/2021/06/Profile-Pic-Icon.png">
        <a style="color: black; text-decoration: none;" href="#" class="card-link">'.$nama_toko.'</a>
        </div>
        </div>

        ';
        echo $output;
      }

      ?>


    </div>
  </div>

</body>
</html>