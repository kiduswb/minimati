<?php

	/*
     * Minimati - Lightweight and Open-Source Blogging CMS
     * Written by Kidus Bewket (https://kidus.ca)
     * Released under the MIT License
     */

	session_start();
	require_once 'Minimati.php';

	if (!isset($_SESSION['minimati_admin'])) redir("login.php");

	if(isset($_POST['updatedir'])) {
		if(!is_dir($_POST['dir'])) redir("settings.php?de=1");
		else {
			update_upload_dir($_POST['dir']);
			redir("settings.php?ds=1");
		}
	}

	if(isset($_POST['updatepass'])) {
		if(!admin_login($_POST['oldpassword'])) redir("settings.php?pe=1");
		else if($_POST['newpassword'] != $_POST['newpassword2']) redir("settings.php?ne=1");
		else {
			update_password($_POST['newpassword']);
			redir("settings.php?ps=1");
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
	<title>Minimati - Settings</title>
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="container">
			<a class="navbar-brand" href="."><img src="assets/img/icon.png" width="30" height="30" class="d-inline-block align-top"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href=".">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="create.php">Publish New Article</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="edit.php">Edit Articles</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="settings.php">Settings</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="login.php?logout=1">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container py-4">
		<div class="row">
			<div class="col-lg-12 py-3">
				<h2 class="text-center">Settings</h2>
			</div>

			<!-- Change Password -->
			<div class="col-lg-6 py-2">
				<div class="card shadow mb-3">
					<div class="card-body">
						<h4>Update Password</h4><hr>
						<form action="settings.php" method="POST">
							<?php
								if (isset($_GET['pe'])) echo <<<_END
									<div class="form-group">
										<div class="alert alert-warning">Error - Old password not valid.</div>
									</div>
_END;

								else if (isset($_GET['ne'])) echo <<<_END
									<div class="form-group">
										<div class="alert alert-warning">Error - Passwords don't match.</div>
									</div>
_END;
								else if (isset($_GET['ps'])) echo <<<_END
									<div class="form-group">
										<div class="alert alert-success">Password updated successfully.</div>
									</div>
_END;
							?>
							<div class="form-group">
								<input type="password" class="form-control" name="oldpassword" required placeholder="Old Password">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="newpassword" required placeholder="New Password">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="newpassword2" required placeholder="Confirm New Password">
							</div>
							<div class="form-group">
								<button type="submit" name="updatepass" class="btn btn-outline-primary">Update Password</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Change Upload Directory -->
			<div class="col-lg-6 py-2">
				<div class="card shadow mb-3">
					<div class="card-body">
						<h4>Update Image Upload Directory</h4><hr>
						<form action="settings.php" method="POST">
							<?php
								if (isset($_GET['de'])) echo <<<_END
									<div class="form-group">
										<div class="alert alert-warning">Error - Directory not found.</div>
									</div>
_END;
								else if (isset($_GET['ds'])) echo <<<_END
									<div class="form-group">
										<div class="alert alert-success">Image upload directory changed successfully.</div>
									</div>
_END;
							?>
							<div class="form-group">
								Current Directory is <code><?php echo fetch_upload_dir(); ?></code>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" required placeholder="Enter New Directory" name="dir">
							</div>
							<div class="form-group">
								<button type="submit" name="updatedir" class="btn btn-outline-primary">Update Directory</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

    <footer class="footer">
      	<div class="container">
       		<span class="text-muted">
				<a href="https://github.com/kiduswb/minimati">Minimati</a> - 
				Open-source built with <i class="fa fa-heart text-danger"></i>
			</span>
      	</div>
    </footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/main.js"></script>

</body>
</html>