<?php

	/*
     * Minimati - Lightweight and Open-Source Blogging CMS
     * Written by Kidus Bewket (https://kidus.ca)
     * Released under the MIT License
     */

	session_start();
	require_once 'Minimati.php';

	if (!isset($_SESSION['minimati_admin'])) redir("login.php");

	if(isset($_POST['publish'])) {
		$article = new Article(0);

        $article->ID = rand() % 9999;
        $article->slug = slugify($_POST['title']);
        $article->title = addslashes($_POST['title']);
        $article->subtitle = addslashes($_POST['subtitle']);
        $article->content = addslashes($_POST['content']);
        $article->timestamp = time();

		$upload_dir = fetch_upload_dir();

        mkdir($upload_dir.$post->ID);
        $target_file = $upload_dir."$article->ID/" . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        $article->photo = $_FILES['photo']['name'];

        if(publish($article)) {
			header("Location: create.php?s=1");
		} else {
			header("Location: create.php?e=1");
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
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
	<link rel="icon" href="assets/img/icon.png">
	<title>Minimati - Publish New Article</title>
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
					<li class="nav-item active">
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
        <div class="row">
            <div class="col-lg-9 py-2 mx-auto">
                <form action="create.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <h4 class="text-center">Publish New Article</h4>
                    </div>
                    <?php
						if (isset($_GET['e'])) echo <<<_END
                            <div class="form-group">
                                <div class="alert alert-warning">Error - Unable to publish, please check your database settings.</div>
                            </div>
_END;

						else if (isset($_GET['s'])) echo <<<_END
                            <div class="form-group">
                                <div class="alert alert-success">Article published successfully.</div>
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
                    <div class="form-group">
                        <label class="text-muted">Article Image</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-outline-primary col-6" name="publish">
                            Publish Article <i class="fa fa-arrow-up-right-from-square"></i>
                        </button>
                    </div>
                </form>
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

    <script>
        CKEDITOR.replace('content');
    </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/main.js"></script>

</body>
</html>