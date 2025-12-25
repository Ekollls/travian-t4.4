<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");




$id = $_POST['did'];



$database->queryFetch("UPDATE vdata SET
	wood  = '".$_POST['wood']."',
	clay  = '".$_POST['clay']."',
	iron  = '".$_POST['iron']."',
	crop  = '".$_POST['crop']."',
	maxstore  = '".$_POST['maxstore']."',
	maxcrop   = '".$_POST['maxcrop']."'
	WHERE wref = '".$id."'");

$adminlog="add resources <a href=\admin.php?p=village&did=$id\>$id</a> ,".time()."";
$database->addPalevo($_SESSION['id'],$adminlog,1);
header("Location: ../../../panel/admin.php?p=village&did=".$id."");
?>