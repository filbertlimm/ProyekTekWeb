<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">THE ONLINE SHOP</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="profile.php">Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php">Menu</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="keranjang.php">Keranjang</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Kategori
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="index.php">All</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="index.php?kategori=<?php echo "games"?>">Games</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="index.php?kategori=<?php echo "aksesoris"?>">Accessories</a></li>
					</ul>
				</li>
				<li class="nav-item" style="margin-left: 50vw;">	
					<a href="Logout.php" style="text-decoration: none; color: black;">
						<button class="	form-control">Logout</button>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>