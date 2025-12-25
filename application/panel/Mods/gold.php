<?php
session_start();

if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");


$q = "UPDATE users SET gold = gold + ".$_POST['gold']." WHERE id != '0'";
$database->queryFetch($q);

header("Location: ../../../panel/admin.php?p=gold&g");
?>