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
	<title>Minimati - My Articles</title>
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
					<li class="nav-item active">
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

    <footer class="footer">
      	<div class="container">
       		<span class="text-muted">
				<a href="https://github/kiduswb/minimati">Minimati</a> - 
				Open-source built with <i class="fa fa-heart text-danger"></i>
			</span>
      	</div>
    </footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/main.js"></script>

</body>
</html>