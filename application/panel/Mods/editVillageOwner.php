<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");





$id = $_POST['did'];



$database->queryFetch("UPDATE vdata SET
	owner = '".$_POST['newowner']."'
	WHERE wref = $id");

header("Location: ../../../panel/admin.php?p=player&uid=".$_POST['newowner']."");
?>