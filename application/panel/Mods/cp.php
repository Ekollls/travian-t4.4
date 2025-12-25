<?php
session_start();
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");

if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

$id = $_POST['id'];

$database->queryFetch("UPDATE users SET cp = cp + ".$_POST['cp']." WHERE id = ".$id."");
header("Location: ../../../panel/admin.php?p=player&uid=".$id."");
