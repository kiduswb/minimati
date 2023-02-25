<?php 
	session_start();

	if(isset($_GET['p'])) {
		$_SESSION['search_page'] -= 1;
	} elseif (isset($_GET['n'])) {
		$_SESSION['search_page'] += 1;
	}

	header("Location: search.php?query=$query");
?>