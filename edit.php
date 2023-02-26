<?php

	/*
     * Minimati - Lightweight and Open-Source Blogging CMS
     * Written by Kidus Bewket (https://kidus.ca)
     * Released under the MIT License
     */

	session_start();
	require_once 'Minimati.php';

	if (!isset($_SESSION['minimati_admin'])) redir("login.php");

	if(isset($_POST['change'])) {
		$newarticle = new Article($_GET['ID']);
		$newarticle->title = addslashes($_POST['title']);
		$newarticle->subtitle = addslashes($_POST['subtitle']);
		$newarticle->content = addslashes($_POST['content']);

		delete($newarticle->ID);
		if(publish($newarticle)) {
			$newec = edit_count() + 1;
			sql_query("UPDATE `admin` SET `edits`=$newec");
			redir("edit.php?ID=$newarticle->ID&s=1");
		} else {
			redir("edit.php?ID=$newarticle->ID&e=1");
		}
	}

	if(!isset($_SESSION['edit_page'])) $_SESSION['edit_page'] = 1;
    $total_cnt = article_count();

    $limit = 20;
	$page = $_SESSION['edit_page'];

	if($page) $start = ($page - 1) * $limit;
	else $start = 0;

	if ($page == 0) $page = 1;
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_cnt / $limit);
	$lpm1 = $lastpage - 1;

    $articles = fetch_articles($start, $limit, null);
	$ar = null;

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
	<script src="https://cdn.jsdelivr.net/gh/jitbit/HtmlSanitizer@master/HtmlSanitizer.js"></script>
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
		<?php if(!isset($_GET['ID']) and article_count()) { ?>
		<div class="row">
			<div class="col-lg-12 py-2 mx-auto">
				<form action="search.php" method="GET">
					<div class="form-group">
						<div class="input-group col-md-6 col-sm-12 mx-auto">
							<input type="text" name="query" required class="form-control" placeholder="Search for articles..." aria-describedby="button-addon2">
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
							</div>
						</div>
					</div>
				</form>
				<?php
					if(isset($_GET['ds'])) {
						echo <<<_END
							<div class="alert alert-success">Article deleted successfully.</div>
_END;
					} 
				?>
				<table class="table articles">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Date/Time</th>
							<th scope="col">Title</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($articles as $ar) {
								$date = $ar->get_date();
								echo <<<_END
								<tr>
									<td>$date</td>
									<td>$ar->title</td>
									<td><a href="edit.php?ID=$ar->ID" class="btn btn-sm btn-outline-primary">Edit</a></td>
								</tr>
_END;
							}
						?>
					</tbody>
				</table>
			</div>
			
			<!-- Pagination -->
			<div class="col-lg-12 py-3 mx-auto">
				<?php 
                        if($page > 1) {
                            echo <<<_END
							<a href="pagination_edits.php?p=1" class="btn btn-outline-primary">&larr; Prev Page</a>
_END;
                        }

                        if($page != $lastpage) {
                            echo <<<_END
							<a href="pagination_edits.php?n=1" class="btn btn-outline-primary">Next Page &rarr;</a>
_END;
                        }
                    ?>
			</div>

		</div>
		<?php }

		if(!article_count()) {
			echo <<<_END
			<div class="row">
				<div class="col-lg-12 py-2 mx-auto">
					<div class="alert alert-info">
					<i class="fa fa-info-circle"></i>
					No articles published yet. 
					Feel free to create your first one.</div>
				</div>
			</div>
_END;
		}

		 elseif(isset($_GET['ID'])) { 
			$ar = new Article($_GET['ID']);	
		?>
		<div class="row">
			<div class="col-lg-9 py-2 mx-auto">
                <form action="edit.php?ID=<?php echo $_GET['ID']; ?>" method="POST">
                    <div class="form-group">
                        <h4 class="text-center">Edit Article</h4>
						<a href="edit.php">&larr; Return to Article List</a>
                    </div>
                    <?php
						if (isset($_GET['e'])) echo <<<_END
                            <div class="form-group">
                                <div class="alert alert-warning">
								<i class="fa fa-warning"></i>
								Error - Unable to save changes, please check your database settings.</div>
                            </div>
_END;

						else if (isset($_GET['s'])) echo <<<_END
                            <div class="form-group">
                                <div class="alert alert-success">
								<i class="fa fa-check-circle"></i>
								Changes saved successfully.</div>
                            </div>
_END;
					?>
                    <div class="form-group">
                        <input type="text" value="<?php echo $ar->title; ?>" class="form-control" required name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $ar->subtitle; ?>" class="form-control" required name="subtitle" placeholder="Subtitle">
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
					<a class="btn btn-outline-danger" href="fulldelete.php?ID=<?php echo $_GET['ID']; ?>">Confirm Delete</a>
				</div>
			</div>
		</div>
	</div>

	<script>
        CKEDITOR.replace('content');
    </script>
	<?php 
		if(isset($_GET['ID'])) {
			$ar->content = str_replace(array("\r", "\n"), '', $ar->content);
			echo <<<_SCRIPT
				<script>CKEDITOR.instances['content'].setData(HtmlSanitizer.SanitizeHtml('$ar->content'))</script>
_SCRIPT;
		}
	?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/main.js"></script>

</body>
</html>