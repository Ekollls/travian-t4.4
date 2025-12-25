<?php
//echo "<br/>databasein ".microtime();
include(realpath(__DIR__)."/config.php");
//echo "<br/>config ".microtime();
//include("application/DB.php");
//echo "<br/>DB ".microtime();
include(realpath(__DIR__)."/Database/db_MYSQL.php");
//echo "<br/>end db ".microtime();
