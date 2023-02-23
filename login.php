<?php

	/*
     * Minimati - Lightweight and Open-Source Blogging CMS
     * Written by Kidus Bewket (https://kidus.ca)
     * Released under the MIT License
     */

	session_start();
	require_once 'Minimati.php';

	// Logout Function
	if (isset($_GET['logout'])) {
		unset($_SESSION['minimati_admin']);
		redir("login.php?ls=1");
	}

	if (isset($_POST['login'])) {
		$password = $_POST['password'];
		if (admin_login($password)) {
			$_SESSION['minimati_admin'] = 1;
			redir(".");
		} else {
			redir("login.php?e=1");
		}
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/flatly/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="icon" href="assets/img/icon.png">
	<title>Minimati - Login</title>
</head>

<body>

	<div class="container-fluid py-5">
		<div class="row">
			<div class="col-lg-3 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<form action="login.php" method="post">
							<div class="form-group py-1 text-center">
								<img src="assets/img/icon.png" class="w-25 img-fluid" alt="Minimati">
							</div>
							<?php
								if (isset($_GET['e'])) echo <<<_END
									<div class="form-group">
										<div class="alert alert-warning">Error - Invalid Password</div>
									</div>
_END;

								else if (isset($_GET['ls'])) echo <<<_END
									<div class="form-group">
										<div class="alert alert-success">You've been logged out.</div>
									</div>
_END;
							?>
							<div class="form-group">
								<input required class="form-control" type="password" name="password" placeholder="Enter Admin Password">
							</div>
							<div class="form-group">
								<button name="login" class="btn btn-outline-success btn-block">Login <i class="fa fa-sign-in"></i></button>
							</div>
							<div class="form-group">
								<a href="javascript:void();" data-toggle="modal" data-target="#exampleModal">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Forgot Password?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Please refer to the RESET file in your Minimati installation folder for step-by-step 
					directions on how to reset your password.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/main.js"></script>

</body>
</html>