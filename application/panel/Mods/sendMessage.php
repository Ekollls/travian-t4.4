<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
include_once("../../config.php");
include_once("../../DB.php");
include_once("../../Database/db_MYSQL.php");






$query = "INSERT INTO mdata (target, owner, topic, message, viewed, time) VALUES ('$uid', 1, '$topic', '$message', 0, '".time()."')";

$database->queryFetch($query);

header("Location: ../../../panel/admin.php?p=Newmessage&uid=".$uid."&msg=ok");
?>