<?php
include 'nav.php';
require 'connect.php';
session_start();
// echo $_GET["id_barang"];
$id_barang = $_GET["id_barang"];
$id_pengguna = $_SESSION['id'];
if ($id_pengguna == ''){
  header('Location: Login.php');
}
// echo $id_barang;

if(isset($_POST['keranjang_button'])){
  $check = "SELECT * FROM `keranjang` join barang WHERE keranjang.id_barang = '$id_barang' and barang.id_barang = '$id_barang'";
  $stmt_check = $conn->query($check);
  if($row = $stmt_check->fetch()){
    $qty_barangcart = $row['qty_barangcart'];
    $qty_barang = $row['qty_barang'];
    // echo ($qty_barang);

    $qty_barangcart += 1;

    $update = "UPDATE `keranjang` SET `qty_barangcart`='$qty_barangcart' WHERE id_barang = $id_barang";
    $conn->exec($update);

    
    $qty_barang -= 1;
    $update2 = "UPDATE `barang` SET `qty_barang`= $qty_barang WHERE id_barang = $id_barang";
    $conn->exec($update2);
  }else{
    $again = "SELECT * FROM barang where id_barang = '$id_barang'";
    $stmt = $conn->query($again);
    if($row = $stmt->fetch()){
      $qty_barang = $row['qty_barang'];
      // echo ($qty_barang);
      $insert = "INSERT INTO `keranjang`(`id_keranjang`, `id_pengguna`, `id_barang`, `qty_barangcart`) VALUES (NULL,'$id_pengguna','$id_barang',1)";
      $conn->exec($insert);

      $qty_barang -= 1;
      $update2 = "UPDATE `barang` SET `qty_barang`= $qty_barang WHERE id_barang = $id_barang";
      $conn->exec($update2);
    }
  }
  header("Location: keranjang.php");
  
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
  <div style="display: grid; grid-template-columns: 1fr 3fr; grid-gap: 10px; padding: 45px">
    <?php 

    $select = "SELECT * FROM `barang` JOIN `toko` ON barang.id_toko = toko.id_toko WHERE `id_barang` = ".$id_barang;
    $stmt = $conn -> query($select);
    foreach ($stmt->fetchAll() as $row) {
      $nama=($row['nama_barang']);
      $harga=($row['harga_barang']);
      $id_toko=($row['id_toko']);
      $gambar=($row['gambar']);
      $kategori=($row['kategori_barang']);
      $deskripsi=($row['desc_barang']);
      $qty=($row['qty_barang']);
      $nama_toko = ($row['nama_toko']);

      $output =
      '

      <div class="card col-14" style="width: auto;">
      <img style="object-fit: contain; height: 400px; padding: 15px" src="'.$gambar.'" class="card-img-top">
      <div class="card-body">
      <img style="height: 35px" src="https://www.hecmsenior.com/wp-content/uploads/2021/06/Profile-Pic-Icon.png">
      <a style="color: black; text-decoration: none;" href="toko.php?id_toko='.$id_toko.'" class="card-link">'.$nama_toko.'</a>
      </div>
      </div>

      
      <ul class="list-group">

      <li class="list-group-item">Nama : '.$nama.'

      </li>
      <li class="list-group-item">Harga : '.$harga.'

      </li>
      <li class="list-group-item">Stock Sisa : '.$qty.'

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
    <form action="#" method="POST">
      <?php 
      if($qty==0){
        echo ('<button disabled style="margin: 10px" class="btn btn-success" type="submit" name="keranjang_button">Add to Cart!</button>');
      }else
      echo('<button style="margin: 10px" class="btn btn-success" type="submit" name="keranjang_button">Add to Cart!</button>');
      ?>
      
    </form>
  </ul>
  <!-- <a href="keranjang.php"> -->
    <!-- </a> -->
  </div>

</div>

</body>
</html>