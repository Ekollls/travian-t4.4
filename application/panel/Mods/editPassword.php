<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");





$id = $_POST['uid'];
$q=$database->queryFetch("SELECT username from `users` WHERE `id`='".$id."'");
//$dbarray=mysql_fetch_array($q);
$pass = md5($_POST['newpw'].mb_convert_case($q['username'],MB_CASE_LOWER,"UTF-8"));


$database->queryFetch("UPDATE users SET
	password = '".$pass."'
	WHERE id = $id");

header("Location: ../../../panel/admin.php?p=player&uid=".$id."");
?>