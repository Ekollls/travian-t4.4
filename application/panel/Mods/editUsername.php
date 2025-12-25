<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");




$uid = $_POST['uid'];




$database->queryFetch("UPDATE users SET username = '".$_POST['username']."' WHERE id = ".$uid."");

header("Location: ../../../panel/admin.php?p=player&uid=".$uid."");
?>