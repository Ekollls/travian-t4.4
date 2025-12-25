<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");





$id = $_POST['id'];



$database->queryFetch("UPDATE users SET
	sit1 = '".$_POST['sitter1']."',
	sit2 = '".$_POST['sitter2']."'
	WHERE id = $id");

header("Location: ../../../panel/admin.php?p=player&uid=".$id."");
?>