<?php

	/*
     * Minimati - Lightweight and Open-Source Blogging CMS
     * Written by Kidus Bewket (https://kidus.ca)
     * Released under the MIT License
     */

	session_start();
	require_once 'Minimati.php';

	if (!isset($_SESSION['minimati_admin'])) redir("login.php");

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
	<title>Minimati - Dashboard</title>
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
					<li class="nav-item active">
						<a class="nav-link" href=".">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="create.php">Publish New Article</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="edit.php">Edit Articles</a>
					</li>
					<li class="nav-item">
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
		<!-- Stats -->
		<div class="row">
			<div class="col-lg-6 py-3">
				<div class="card bg-info text-white">
					<div class="card-body m-3">
						<i class="fa fa-file-alt stats-icon p-3"></i>
						<h3 class="py-3">38 Articles Published</h3>
						<div class="text-right">
							<a href="create.php" class="btn btn-lg btn-outline-light">Publish New &nbsp;&rarr;</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 py-3">
				<div class="card bg-warning text-white">
					<div class="card-body m-3">
						<i class="fa fa-pencil-alt stats-icon p-3"></i>
						<h3 class="py-3">387 Total Edits</h3>
						<div class="text-right">
							<a href="edit.php" class="btn btn-lg btn-outline-light">View All &nbsp;&rarr;</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Latest Articles -->
		<div class="row">
			<div class="col-lg-12 py-4 mx-auto">
				<div class="card">
					<div class="card-header text-white bg-primary">
						<h3>Recently Published</h3>
					</div>
					<div class="card-body">
						<table class="table">
							<thead class="thead-dark">
								<tr>
								<th scope="col">Date/Time</th>
								<th scope="col">Title</th>
								<th scope="col">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>22-Feb-2022, 11:59PM</td>
									<td>Incredibly long sample blog title that needs to be shor...</td>
									<td><a href="edit.php?ID=ID" class="btn btn-sm btn-outline-primary">Edit</a></td>
								</tr>
							</tbody>
						</table>
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