<!DOCTYPE HTMl>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>
<body>
	<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
		<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
			<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
		</symbol>
		<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
			<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
		</symbol>
		<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
			<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
		</symbol>
	</svg>

	<section class="vh-80 gradient-custom">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-12 col-md-8 col-lg-6 col-xl-5">
					<div class="card bg-dark text-white" style="border-radius: 1rem;">
						<div class="card-body p-5 text-center">
							<form method="POST">
								<div class="mb-md-5 mt-md-4 pb-5">

									<h2 class="fw-bold mb-2 text-uppercase">Login</h2>
									<p class="text-white-50 mb-5">Please enter your login and password!</p>

									<div class="form-outline form-white mb-4">
										<input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" />
										<label class="form-label" for="typeEmailX">Email</label>
									</div>

									<div class="form-outline form-white mb-4">
										<input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" />
										<label class="form-label" for="typePasswordX">Password</label>
									</div>

									<!-- <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p> -->

									<button class="btn btn-outline-light btn-lg px-5" type="submit" name="login">Login</button>

									<div style="margin-top: 20px;">
										<p class="mb-0">Don't have an account? <a href="register.php" class="text-white-50 fw-bold">Sign Up</a></p>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php
		include 'connect.php';
		session_start();

		if(isset($_POST['login'])) {
			$errMsg = '';
			echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';

  // Get data from FORM
			$email = $_POST['email'];
			$password = $_POST['password'];

			if($email == ''){
				$errMsg = 'Enter email!';
				echo '<div class="alert alert-danger d-flex align-items-center" role="alert" style="bottom:160px; width:30%; margin-left: 35%">
				<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
				<div>
				'.$errMsg.'
				</div>
				</div>';
			}
			else if($password == ''){
				$errMsg = 'Enter password!';
				echo '<div class="alert alert-danger d-flex align-items-center" role="alert" style="bottom:160px; width:30%; margin-left: 35%">
				<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
				<div>
				'.$errMsg.'
				</div>
				</div>';
			}

			if($errMsg == '') {
				try {
					$stmt = $conn->prepare('SELECT * FROM pengguna WHERE email_pengguna = :email');
					$stmt->execute(array(
						':email' => $email
					));
					$data = $stmt->fetch(PDO::FETCH_ASSOC);

					if($data == false){
						$errMsg = "User $email not found.";
						echo '<div class="alert alert-danger d-flex align-items-center" role="alert" style="bottom:160px; width:30%; margin-left: 35%">
						<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
						<div>
						'.$errMsg.'
						</div>
						</div>';
					}
					else {

						if($password == $data['password_pengguna']) {
							$_SESSION['id'] = $data['id_pengguna'];
							$_SESSION['fullname'] = $data['nama_pengguna'];
							// $_SESSION['password'] = $data['password_pengguna'];

					        header('Location: index.php');
					        exit;
						}
						else{
							$errMsg = "Password not match!!";
							echo '<div class="alert alert-danger d-flex align-items-center" role="alert" style="bottom:160px; width:30%; margin-left: 35%">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
							<div>
							'.$errMsg.'
							</div>
							</div>';
							
						}
					}
				}
				catch(PDOException $e) {
					$errMsg = $e->getMessage();
					echo '<div class="alert alert-danger d-flex align-items-center" role="alert" style="bottom:160px; width:30%; margin-left: 35%">
					<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
					<div>
					'.$errMsg.'
					</div>
					</div>';
				}
			}
		}
// if(isset($errMsg)){
// }
		?>
	</body>
	</html