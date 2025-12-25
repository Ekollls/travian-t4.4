<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");








$sql = "SELECT id FROM users ORDER BY ID DESC LIMIT 1";
$loops = mysql_result($database->queryFetch($sql), 0);

$plusdur = $_POST['plus'] * 86400;

for($i = 0; $i < $loops + 1; $i++)
{
	$query = "SELECT * FROM users WHERE id = ".$i."";
	$result = $database->queryFetch($query);
	while($row = mysql_fetch_assoc($result))
	{
		if($row['plus'] < time()) { $plusbefore = time(); $addplus = $plusbefore + $plusdur; } elseif($row['plus'] > time()) { $plusbefore = $row['plus']; $addplus = $plusbefore + $plusdur; }
		$database->queryFetch("UPDATE users SET
			plus = '".$addplus."'
			WHERE id = '".$row['id']."'");
	}
}

header("Location: ../../../panel/admin.php?p=givePlus&g");
?>