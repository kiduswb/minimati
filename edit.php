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
	<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
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
					<?php
						if(isset($_GET['ID'])) echo '<li class="nav-item">';
						else echo '<li class="nav-item active">';
					?>
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
		<?php if(!isset($_GET['ID'])) { ?>
		<div class="row">
			<div class="col-lg-12 py-2 mx-auto">
				<form action="search.php" method="POST">
					<div class="form-group">
						<div class="input-group col-6 mx-auto">
							<input type="text" class="form-control" placeholder="Search for articles..." aria-describedby="button-addon2">
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
							</div>
						</div>
					</div>
				</form>
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
						<tr>
							<td>22-Feb-2022, 11:59PM</td>
							<td>Incredibly long sample blog title that needs to be shor...</td>
							<td><a href="edit.php?ID=ID" class="btn btn-sm btn-outline-primary">Edit</a></td>
						</tr>
						<tr>
							<td>22-Feb-2022, 11:59PM</td>
							<td>Incredibly long sample blog title that needs to be shor...</td>
							<td><a href="edit.php?ID=ID" class="btn btn-sm btn-outline-primary">Edit</a></td>
						</tr>
						<tr>
							<td>22-Feb-2022, 11:59PM</td>
							<td>Incredibly long sample blog title that needs to be shor...</td>
							<td><a href="edit.php?ID=ID" class="btn btn-sm btn-outline-primary">Edit</a></td>
						</tr>
						<tr>
							<td>22-Feb-2022, 11:59PM</td>
							<td>Incredibly long sample blog title that needs to be shor...</td>
							<td><a href="edit.php?ID=ID" class="btn btn-sm btn-outline-primary">Edit</a></td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- Pagination -->
			<div class="col-lg-12 py-3 mx-auto">
				<a href="#" class="btn btn-outline-primary">&larr; Prev Page</a>
				<a href="#" class="btn btn-outline-primary">Next Page &rarr;</a>
			</div>
		</div>
		<?php } elseif(isset($_GET['ID'])) { ?>
		<div class="row">
			<div class="col-lg-9 py-2 mx-auto">
                <form action="edit.php" method="POST">
                    <div class="form-group">
                        <h4 class="text-center">Edit Article</h4>
                    </div>
                    <?php
						if (isset($_GET['e'])) echo <<<_END
                            <div class="form-group">
                                <div class="alert alert-warning">Error - Unable to save changes, please check your database settings.</div>
                            </div>
_END;

						else if (isset($_GET['s'])) echo <<<_END
                            <div class="form-group">
                                <div class="alert alert-success">Changes saved successfully.</div>
                            </div>
_END;
					?>
                    <div class="form-group">
                        <input type="text" class="form-control" required name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" required name="subtitle" placeholder="Subtitle">
                    </div>
                    <div class="form-group">
                        <textarea name="content" id="content" required class="form-control"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-outline-primary col-6" name="change">
                            Save Changes
                        </button>
                    </div>
                </form>
				<div class="text-center">
					<button data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-danger col-6">
						Delete Article
					</button>
				</div>
            </div>
		</div>
		<?php } ?>
	</div>

	<footer class="footer">
		<div class="container">
			<span class="text-muted">
				<a href="https://github.com/kiduswb/minimati">Minimati</a> -
				Open-source built with <i class="fa fa-heart text-danger"></i>
			</span>
		</div>
	</footer>

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Do you really want to delete this article?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
					<a class="btn btn-outline-danger" href="edit.php?delete=1&ID=ID">Confirm Delete</a>
				</div>
			</div>
		</div>
	</div>

	<script>
        CKEDITOR.replace('content');
    </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/main.js"></script>

</body>
</html>