<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");



$duration = $_POST['duration'] * 3600;
$start = $_POST['start'];
$startts = strtotime($start);
$endts = $startts + $duration;
$reason = $_POST['reason'];
$admin = $session;
$active = '1';
$access = '2';

$sql = "SELECT id FROM users ORDER BY ID DESC LIMIT 1";
$loops = $database->queryFetch($sql);

for($i = 0; $i < $loops + 1; $i++)
{
	$query = "SELECT * FROM users WHERE id = ".$i." AND access = ".$access."";
	$row = $database->queryFetch($query);
	$database->queryFetch("INSERT INTO banlist (`uid`, `name`, `reason`, `time`, `end`, `admin`, `active`) VALUES (".$row['id'].", '".$row['username']."' , '$reason', '$startts', '$endts', '$admin', '1')");
	
}

header("Location: ../../../panel/admin.php?p=ban");
?>