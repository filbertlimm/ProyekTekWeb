<?php
include 'nav.php';
require 'connect.php';

session_start();
$id_pengguna = $_SESSION['id'];
if ($id_pengguna == ''){
		header('Location: Login.php');
}

// echo ($id_pengguna);

// header("Location: menu.php?kategori=games");

If(isset($_GET["kategori"])){
	$kategori = $_GET["kategori"];
}else{
	$kategori = "%a%";
}



$select = "SELECT * FROM `barang` JOIN `toko` ON barang.id_toko = toko.id_toko WHERE kategori_barang LIKE '$kategori'";

if(isset($_POST['search'])){
	$search_input = $_POST['search_input'];
	$select = "SELECT * FROM `barang` JOIN `toko` ON barang.id_toko = toko.id_toko WHERE nama_barang LIKE '%".$search_input."%'";
}

if(isset($_POST['low'])){
	$search_input = $_POST['search_input'];
	$select = "SELECT * FROM `barang` JOIN `toko` ON barang.id_toko = toko.id_toko WHERE nama_barang LIKE '%$search_input%' and kategori_barang LIKE '$kategori' ORDER BY harga_barang ASC ";
}

if(isset($_POST['high'])){
	$search_input = $_POST['search_input'];
	$select = "SELECT * FROM `barang` JOIN `toko` ON barang.id_toko = toko.id_toko WHERE nama_barang LIKE '%$search_input%' and kategori_barang LIKE '$kategori' ORDER BY harga_barang DESC ";
}
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

<title>Menu</title>
</head>
<body>
	<div class="container" style="padding: 30px;">

		<form action="#" method="POST">
			<div class="row">
				<div class="col-10">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_input">
				</div>
				<div class="col-1">
					<button class="btn btn-outline-success" type="submit" name="search">Search</button>									
				</div>
				<div class="col-1">
					<div>
						<div class="dropdown">
							<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
								Sort by Price
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li>			
									<button class="btn" type="submit" name="low">Lowest to High</button>
								</li>
								<li>			
									<button class="btn" type="submit" name="high">Highest to Low</button>
								</li>					
							</ul>
						</div>
					</div>
				</div>
			</div>
		</form>

		<!-- <form action="#" method="POST">
			
		</form> -->


	</div>

	<div style="padding: 50px">
		<div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; grid-gap: 5px;">


			<?php
			$stmt = $conn -> query($select);
			foreach ($stmt->fetchAll() as $row) {
				$id_barang=($row['id_barang']);
				$nama=($row['nama_barang']);
				$harga=($row['harga_barang']);
				$id_toko=($row['id_toko']);
				$gambar=($row['gambar']);
				$nama_toko = ($row['nama_toko']);
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
				<a style="color: black; text-decoration: none;" href="toko.php?id_toko='.$id_toko.'" class="card-link">'.$nama_toko.'</a>
				</div>
				</div>

				';
				echo $output;
			}

			?>


		<!-- 	<div class="card col-14" style="width: auto; margin: 15px;">
				<a href="detail.php?id_barang=3 ">
					<img style="object-fit: contain; height: 280px; padding: 15px" src="https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/369/0736974_PE740838_S5.jpg" class="card-img-top">

				</a>
				<div class="card-body">
					<h5 class="card-title" name="name" >Kursi</h5>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">Rp. 100.000</li>
				</ul>
				<div class="card-body">
					<img style="height: 35px" src="https://www.hecmsenior.com/wp-content/uploads/2021/06/Profile-Pic-Icon.png">
					<a style="color: black; text-decoration: none;" href="#" class="card-link">Toko Budi Bejoh</a>
				</div>
			</div> -->


			
		</div>
		
	</div>

</body>

</html>
