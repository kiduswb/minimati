<?php 
	session_start();

	if(isset($_GET['p'])) {
		$_SESSION['edit_page'] -= 1;
	} elseif (isset($_GET['n'])) {
		$_SESSION['edit_page'] += 1;
	}

	header("Location: edit.php");
?>