<!doctype html>
<html lang="en">
<?php
session_start();
include 'nav.php';
require 'connect.php';
$id_pengguna = $_SESSION['id'];
if ($id_pengguna == ''){
    header('Location: Login.php');
}
?>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  -->
  <title>Invoice</title>
</head>
<style>
  .invoice-box {
    max-width: 3000px;
    margin: auto;
    padding: 30px;


    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: rgb(0, 0, 0);
  }

  .invoice-box table {
    width: 85%;
    line-height: inherit;
    text-align: left;
  }

  .invoice-box table td {
    padding: 5px;
    vertical-align: top;
  }

  .invoice-box table tr td:nth-child(2) {
    text-align: left;
  }

  .invoice-box table tr.top table td {
    padding-bottom: 20px;
  }

  .invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
  }

  .invoice-box table tr.information table td {
    padding-bottom: 20px;
  }

  .invoice-box table td.methodpembayaran {
    padding-bottom: 40px;
    width: 40%;
    font-weight: bold;
  }

  .invoice-box table td.alamat {
    padding-bottom: 40px;
    width: 65%;

  }

  .invoice-box table tr.heading td {
    background: rgb(0, 0, 0);
    border-bottom: 1px solid #ddd;
    font-weight: bold;
    color: white
  }

  .invoice-box table tr.details td {
    padding-bottom: 20px;
  }

  .invoice-box table tr.item td {
    border-bottom: 1px solid #eee;
    color: rgb(119, 187, 17);
    font-weight: bolder;
  }

  .invoice-box table tr.ongkoskirim td {
    border-bottom: 1px solid #eee;
    color: rgb(19, 29, 5);

  }

  .invoice-box table tr.total td {
    font-size: 20px;
    font-weight: bolder;
  }

  .invoice-box table tr.totalakhir td {
    font-size: 20px;
    font-weight: bolder;
    border-bottom: 1px solid #eee;
    padding-top: 10px;
    padding-bottom: 10px;
  }

  @media only screen and (max-width: 20px) {
    .invoice-box table tr.top table td {
      width: 100%;
      display: block;
      text-align: center;
    }

    .invoice-box table tr.information table td {
      width: 100%;
      display: block;
      text-align: center;
    }
  }

  /** RTL **/
  .invoice-box.rtl {
    direction: rtl;
    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
  }

  .invoice-box.rtl table {
    text-align: right;
  }

  .invoice-box.rtl table tr td:nth-child(2) {
    text-align: left;
  }
</style>
</head>

<body>
  <div class="invoice-box" style>
    <table cellpadding="0" cellspacing="0">
      <tr class="information">
        <td colspan="2">
          <table>
            <tr>
              <?php 
              $select = "SELECT * from ordering inner join pengguna where ordering.id_pengguna = $id_pengguna and pengguna.id_pengguna = $id_pengguna order by id desc";
              $stmt = $conn->query($select);
              if($row = $stmt->fetch()){
                $alamat = $row['alamat_pengguna'];
                $id_ordering = $row['id'];
                $nama_pengguna = $row['nama_pengguna'];
                $id_transaksi = $row['Id_transaksi'];
                $id_shipping = $row['Id_shipping'];
              }
              ?>

              <td>
                Invoice ID : <?php echo $id_ordering; ?><br/>
                Buyer Name : <?php echo $nama_pengguna;?> <br />
                Date : <?php echo date("d-m-y") ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="heading">
        <td>Item</td>
        <td>Amount</td>
        <td>Price</td>
      </tr>
      <?php 
      $select = "SELECT * FROM `keranjang` inner join barang WHERE keranjang.id_pengguna = $id_pengguna and keranjang.id_barang = barang.id_barang";
      $stmt = $conn -> query($select);
      foreach ($stmt->fetchAll() as $row) { 
        ?>

        <tr class="item">
          <td><?php echo $row['nama_barang']; ?></td>
          <td><?php echo $row['qty_barangcart']; ?></td>
          <td>Rp. <?php echo $row['harga_barang']*$row['qty_barangcart']; ?></td>
        </tr>

        <?php 
      }

      $total = "SELECT * FROM `keranjang` inner join barang WHERE keranjang.id_pengguna = $id_pengguna and keranjang.id_barang = barang.id_barang";
      $stmt_total = $conn ->query($total);
      $total_pembelian = 0;
      foreach ($stmt_total->fetchAll() as $row) {
        $harga_barang = $row['harga_barang'];
        $qty_barangcart = $row['qty_barangcart'];
        $total_pembelian += $harga_barang * $qty_barangcart;
      }
      $ongkoskirim = "SELECT * FROM shipping where Id_shipping = $id_shipping";
      $stmt = $conn->query($ongkoskirim);
      if($row = $stmt->fetch()){
        $nama_shipping = $row['nama_shipping'];
        $harga_shipping = $row['harga'];
      }

      $methodpembayaran = "SELECT * FROM transaksi where Id_transaksi = $id_transaksi";
      $stmt1 = $conn->query($methodpembayaran);
      if($row = $stmt1->fetch()){
        $nama_transaksi = $row['nama_transaksi'];
      }
      ?>

      <tr class="total">
        <td></td>
        <td>Total Harga</td>
        <td>Rp. <?php echo $total_pembelian ?></td>
      </tr>

      <tr class="ongkoskirim">
        <td></td>
        <td>Ongkos Kirim (<?php echo $nama_shipping ?>)</td>
        <td>Rp. <?php echo $harga_shipping ?></td>
      </tr>
      <tr class="totalakhir">
        <td></td>
        <td>Total Belanja</td>
        <td>Rp. <?php 
        $total_pembelian += $harga_shipping;
        echo $total_pembelian;
        ?></td>
      </tr>
    </table>

    <tr class="informationextra">
      <td colspan="2">
        <table >
          <tr>
            <td class="alamat"style="padding-top: 20px">
              <div style="font-weight: bold">Alamat :</div>
              <?php echo $alamat ?>
            </td>
            <td class="methodpembayaran"style="padding-top: 20px">
              Method Pembayaran<br/>
              <div style="font-weight: lighter;"><?php echo ($nama_transaksi); ?></div><br/>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <h1 style="font-weight: bolder; padding-left: 30vw; color: rgb(119, 187, 17); padding-bottom: 90px">ORDER SUCCESS!</h1>

    <a href="index.php"><button type="button" class="btn btn-primary">Back to Menu</button></a>
    <?php 
    $delete = "DELETE FROM `keranjang` WHERE id_pengguna = $id_pengguna";
    $conn->exec($delete);
     ?>
  </div>
</body>

</html>