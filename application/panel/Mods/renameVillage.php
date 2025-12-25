<?php
session_start();
$_SESSION['id']=6;$_SESSION['access']=9;
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");




$did = $_POST['did'];
$name = $_POST['villagename'];



$sql = "UPDATE vdata SET name = '$name' WHERE wref = $did";
$database->queryFetch($sql);

header("Location: ../../../panel/admin.php?p=village&did=".$did."&name=".$name."");
?>