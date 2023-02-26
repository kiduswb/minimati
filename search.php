<?php

	/*
     * Minimati - Lightweight and Open-Source Blogging CMS
     * Written by Kidus Bewket (https://kidus.ca)
     * Released under the MIT License
     */

	session_start();
	require_once 'Minimati.php';

	if (!isset($_SESSION['minimati_admin'])) redir("login.php");
    // Failsafe
    if(!isset($_GET['query'])) redir("edit.php");

    if(!isset($_SESSION['search_page'])) $_SESSION['search_page'] = 1;
    $total_cnt = article_count($_GET['query']);

    $limit = 20;
	$page = $_SESSION['search_page'];

	if($page) $start = ($page - 1) * $limit;
	else $start = 0;

	if ($page == 0) $page = 1;
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_cnt / $limit);
	$lpm1 = $lastpage - 1;

    $search_results = fetch_articles($start, $limit, $_GET['query']);
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
	<title>Searching for '{query}' - Minimati</title>
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

    <div class="container">
        <div class="row">
            <?php if(article_count($_GET['query'])) { ?>
                <div class="col-lg-12 py-2 mx-auto">
                    <div class="py-3">
                        <h3 class="text-center">Search results for '<?php echo $_GET['query']; ?>'</h3>
                        <a href="edit.php">&larr; Return to Article List</a>
                    </div>
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
                                foreach($search_results as $ar) {
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
							<a href="pagination_search.php?p=1" class="btn btn-outline-primary">&larr; Prev Page</a>
_END;
                        }

                        if($page != $lastpage) {
                            echo <<<_END
							<a href="pagination_search.php?n=1" class="btn btn-outline-primary">Next Page &rarr;</a>
_END;
                        }
                    ?>
			    </div>
            <?php } else {
                echo <<<_END
                <div class="col-lg-12 py-4 mx-auto">
					<div class="alert alert-info">
					<i class="fa fa-info-circle"></i>
					No results found.</div>
				</div>
_END;
            } ?>
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