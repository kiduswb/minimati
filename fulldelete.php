<?php
    require_once "Minimati.php";
    full_delete($_GET['ID']);
    redir("edit.php?ds=1");
?>