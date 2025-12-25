<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");





$id = $_POST['id'];


$dur = $_POST['protect'] * 86400;
$protection = (time() + $dur);

$database->queryFetch("UPDATE users SET
	protect = '".$protection."'
	WHERE id = $id");

header("Location: ../../../panel/admin.php?p=player&uid=".$id."");
?>