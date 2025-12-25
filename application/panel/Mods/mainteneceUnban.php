<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");



$reason = $_POST['unbanreason'];
$active = '0';
$access = '2';
$actualend = time();

$sql = "SELECT id FROM users ORDER BY ID DESC LIMIT 1";
$loops = $database->queryFetch($sql);

for($i = 0; $i < $loops + 1; $i++)
{
	$query = "SELECT * FROM users WHERE id = ".$i." AND access = ".$access."";
	$row = $database->queryFetch($query);
	$database->queryFetch("UPDATE banlist SET active = '".$active."', end = '".$actualend."' WHERE reason = '".$reason."'");
	
}

header("Location: ../../../panel/admin.php?p=ban");
?>