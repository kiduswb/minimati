<?php
	session_start();
  	require_once "Minimati.php";
	if (!isset($_SESSION['minimati_admin'])) {
    	redir("login.php");
	} else {
    	full_delete(intval($_GET['ID']));
    	redir("edit.php?ds=1");
	}
?>
