<?php
ob_start();
session_start();
include 'nav.php';
require 'connect.php';
$id_pengguna = $_SESSION['id'];
if ($id_pengguna == ''){
	header('Location: Login.php');
}
// echo $id_pengguna;
// header("Location: keranjang.php");
// $test = "SELECT * FROM `keranjang`inner join barang WHERE keranjang.id_barang = '1' and barang.id_barang = '1' ";
// $stmt_test = $conn->query($test);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<title>Keranjang</title>

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
</head>



<body>

	<section class="konten">
		<div class="container">
			<h1>Keranjang Belanja</h1> <br>
			<?php 
			$select = "SELECT * FROM `keranjang` inner join barang WHERE keranjang.id_pengguna = $id_pengguna and keranjang.id_barang = barang.id_barang";
			$stmt = $conn -> query($select);
			foreach ($stmt->fetchAll() as $row) { ?>
				<div style="display: grid; grid-template-columns: 1fr 4fr;padding-bottom: 10px;">
					<div>
						<div class="card col-14" style="height: 301px; width: 285px; border-radius: 0px">
							<img style="object-fit: contain; height: 250px; width: auto; padding: 15px;"
							src="<?php echo $row['gambar']; ?>" class="card-img-top">
						</div>
					</div>

					<div>
						<ul class="list-group" style="border-radius: 0px">

							<li class="list-group-item">Nama : <?php echo $row['nama_barang']; ?>
						</li>

						<li class="list-group-item">Harga : <?php echo $row['harga_barang']; ?>
					</li>

					<li class="list-group-item">Kuantitas Pembelian : <?php echo $row['qty_barangcart']; ?>
				</li>

				<li class="list-group-item" style="padding: 30px">
					<form action="#" method="POST">
						<div class="row">
							<div class="col-2">
								<div class="row">
									<div class="col">
										<!-- <input type="hidden" name="id" value="<?php echo $row['id_barang']; ?>"> -->
										<button style="width: 100px" class="form-control btn-success"
										name="add_barang" id="add_barang"
										value="<?php echo $row['id_barang'];?>">ADD</button> <br>
										<button style="width: 100px" class="form-control btn-danger"
										name="remove_barang" id="remove_barang" type="submit"
										value="<?php echo $row['id_barang'];?>">REMOVE</button>
									</div>
								</div>

							</div>
							<div class="col">
								SISA STOCK :
								<input class="form-control" type="number" name="sisa_stock" id="sisa_stock"
								style="width: 90px" disabled value="<?php echo $row['qty_barang']; ?>">
							</div>

						</div>
					</form>
				</li>
			</div>

		</div>
		<?php
	}

	if(isset($_POST['add_barang'])){
		$id = $_POST['add_barang'];
		$check = "SELECT * FROM `keranjang`inner join barang WHERE keranjang.id_barang = '$id' and barang.id_barang = '$id' ";
		$stmt_check = $conn->query($check);
		if($row = $stmt_check->fetch()){
			$qty_barang = $row['qty_barang'];
			if($qty_barang <= 0){
				echo("[ STOCK DI TOKO HABIS ]");

			}else{
				$qty_barang -= 1;

				$update = "UPDATE `barang` SET `qty_barang`='$qty_barang' WHERE id_barang = $id";
				$conn->exec($update);

				$qty_barangcart = $row['qty_barangcart'];
				$qty_barangcart += 1;

				$update = "UPDATE `keranjang` SET `qty_barangcart`='$qty_barangcart' WHERE id_barang = $id";
				$conn->exec($update);
				header("Location:keranjang.php");

			}
		}

	}

	if(isset($_POST['remove_barang'])){
		$id = $_POST['remove_barang'];
		$check = "SELECT * FROM `keranjang`inner join barang WHERE keranjang.id_barang = '$id' and barang.id_barang = '$id' ";
		$stmt_check = $conn->query($check);
		if($row = $stmt_check->fetch()){
			$qty_barangcart = $row['qty_barangcart'];
			if($qty_barangcart <= 1){
				$update = "DELETE from `keranjang` where `qty_barangcart`= 1 and id_barang = $id";
				$conn->exec($update);
			}else{
				$qty_barangcart -= 1;

				$update = "UPDATE `keranjang` SET `qty_barangcart`='$qty_barangcart' WHERE id_barang = $id";
				$conn->exec($update);
			}
			$qty_barang = $row['qty_barang'];
			$qty_barang += 1;

			$update = "UPDATE `barang` SET `qty_barang`='$qty_barang' WHERE id_barang = $id";
			$conn->exec($update);
			header("Location:keranjang.php");
		}
	}
	?>

	<div>
		<?php 
		$total = "SELECT * FROM `keranjang` inner join barang WHERE keranjang.id_pengguna = $id_pengguna and keranjang.id_barang = barang.id_barang";
		$stmt_total = $conn ->query($total);
		$total_pembelian = 0;
		foreach ($stmt_total->fetchAll() as $row) {
			$harga_barang = $row['harga_barang'];
			$qty_barangcart = $row['qty_barangcart'];
			$total_pembelian += $harga_barang * $qty_barangcart;
		}
		?>
		<form action="#" method="POST">
			<div class="row">
				<div class="col-7">
					TOTAL PEMBELIAN :
					<input class="form-control" type="number" name="" style="width: 135px" disabled
					value="<?php echo $total_pembelian; ?>"><br>
				</div>
				<div class="col">
					<select id="pengiriman" name="pengiriman" class="form-select form-select-sm"
					aria-label=".form-select-sm example" required>
					<option value="0" selected>Pilih Jenis Pengiriman</option>
					<?php 
					$select = "SELECT * FROM shipping";
					$stmt_select = $conn -> query($select);
					foreach ($stmt_select->fetchAll() as $row) {
						$nama_shipping = $row['nama_shipping'];
						$id = $row['Id_shipping'];
						$harga = $row['harga'];
						echo('<option value="'.$id.'">'.$nama_shipping.' - Rp'.$harga.'</option>');
					}
					?>
				</select>
			</div>
			<div class="col">
				<select name="pembayaran" class="form-select form-select-sm"
				aria-label=".form-select-sm example" required>
				<option value="0" selected>Pilih Metode Pembayaran</option>
				<?php 
				$select = "SELECT * FROM transaksi";
				$stmt_select = $conn -> query($select);
				foreach ($stmt_select->fetchAll() as $row) {
					$nama_shipping = $row['nama_transaksi'];
					$id = $row['Id_transaksi'];
					echo('<option value="'.$id.'">'.$nama_shipping.'</option>');
				}
				?>
			</select>
		</div>
		<button class="form-control btn-warning" style="width: 50%" type="submit" name="check_out">Check
		Out!</button>
		<?php 
		if(isset($_POST['check_out'])){
			$pengiriman = $_POST['pengiriman'];
					// echo $pengiriman;
			$pembayaran = $_POST['pembayaran'];
					// echo $pembayaran;
			if($total_pembelian==0){
				echo('<div style="padding-left:225px; font-weight:bolder;"> !!! Keranjang masih Kosong !!! </div>');
			}
			else if($pembayaran==0 or $pengiriman ==0){
				echo('<div style="padding-left:165px; font-weight:bolder;"> !!! Isi Pilihan Pengiriman dan Pembayaran !!! </div>');
			}else{
				$info = "SELECT * FROM pengguna WHERE id_pengguna = $id_pengguna";
				$stmt = $conn->query($info);
				if($row = $stmt->fetch()){
					$alamat = $row['alamat_pengguna'];
				}

				echo('<div style="padding-left:265px; font-weight:bolder;">GOOD JOB!</div>');
				$insert = "INSERT INTO `ordering`(`id`, `id_pengguna`, `Id_transaksi`, `Id_shipping`, `lokasi_pengiriman`, `total_harga`) VALUES (NULL,$id_pengguna,$pembayaran,$pengiriman,'$alamat',$total_pembelian)";
				$conn->exec($insert);

				header("Location: invoice.php");
			}

		}
		?>
	</div>
</form>
</div>
</body>

</html>
<?php ob_end_flush(); ?>