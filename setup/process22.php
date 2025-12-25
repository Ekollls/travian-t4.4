<?php

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

if(file_exists("../application/config.php") && !isset($_POST['subconst'])) {
    include_once("../application/config.php");
    include_once("../application/Database/db_MYSQL.php");
}
class Process {

	function __construct() {
		if(isset($_POST['subconst'])) {
			$this->constForm();
            //header("Location: index.php?s=2");
		} else
			if(isset($_POST['substruc'])) {
				$this->createStruc();
			} else
				if(isset($_POST['subwdata'])) {
					$this->createWdata();
				}  else {
							header("Location: index.php");
						}
	}

	function constForm() {
		$myFile = "../application/config.php";
		$fh = fopen($myFile, 'w') or die("<br/><br/><br/>Can't open file:application/config.php");
		$text = file_get_contents("data/constant_format.tpl");
		$text = preg_replace("'%SSERVER%'", $_POST['sserver'], $text);
		$text = preg_replace("'%SUSER%'", $_POST['suser'], $text);
		$text = preg_replace("'%SPASS%'", $_POST['spass'], $text);
		$text = preg_replace("'%SDB%'", $_POST['sdb'], $text);
		$text = preg_replace("'%ARANK%'", $_POST['admin_rank'], $text);
		$text = preg_replace("'%DEMOLISH%'", $_POST['demolish'], $text);
		$text = preg_replace("'%VILLAGE_EXPAND%'", $_POST['village_expand'], $text);
		$text = preg_replace("'%TS_THRESHOLD%'", $_POST['ts_threshold'], $text);
        $text = preg_replace("'%MAX_FILES%'", $_POST['MAX_FILES'], $text);
        $text = preg_replace("'%MAX_FILESH%'", $_POST['MAX_FILESH'], $text);
        $text = preg_replace("'%IMGQUALITY%'", $_POST['IMGQUALITY'], $text);
        $text = preg_replace("'%MOMENT_TRAIN%'", $_POST['MOMENT_TRAIN'], $text);
        $text = preg_replace("'%QUEST%'", $_POST['QUEST'], $text);
        $text = preg_replace("'%SELL_CP%'", 'False', $text);
        $text = preg_replace("'%SELL_RES%'", 'False', $text);
        $text = preg_replace("'%COSTRES%'", '10', $text);
        $text = preg_replace("'%DEFGOLD%'", $_POST['defgold'], $text);
        $text = preg_replace("'%HOWRES%'", '10000', $text);
        $text = preg_replace("'%COSTCP%'", '20', $text);
        $text = preg_replace("'%HOWCP%'", '2500', $text);
        $text = preg_replace("'%AUCTIME%'", $_POST['auctime'], $text);
        $text = preg_replace("'%PRHOUR%'", $_POST['phour'], $text);
		fwrite($fh, $text);
		fclose($fh);

		$p_query = file_get_contents("data/sql.sql");
		$mysqli = new mysqli($_POST['sserver'],$_POST['suser'],$_POST['spass'],$_POST['sdb']);
		$mysqli->set_charset("utf8");

		$sql = "DROP TABLE IF EXISTS `a2b`,`odemeler`,`paketler`, `abdata`, `achiev`, `activate`, `adventure`, `alidata`, `ali_invite`, `ali_log`, `ali_permission`, `antimult`, `artefacts`, `attacks`, `auction`, `banlist`, `bdata`, `buygold`, `confs`, `critical_log`, `demolition`, `diplomacy`, `enforcement`, `farmlist`, `fdata`, `hero`, `heroface`, `heroinventory`, `heroitems`, `links`, `log`, `map_control`, `market`, `mdata`, `medal`, `movement`, `ndata`, `newproc`, `news`, `odata`, `online`, `palevo`, `password`, `prisoners`, `queue`, `raidlist`, `referals`, `research`, `roullet`, `route`, `sitters`, `spravka`, `tdata`, `training`, `units`, `users`, `vdata`, `wdata`, `config`, `codes`, `payments`, `autorenewals`, `quests`, `deleted`, `ignore`, `plusaddons`, `storage`, `support`;";
		@$mysqli->query($sql);

		$big = $mysqli->multi_query($p_query);
		if ($big) {
			do {
				if ($result = $mysqli->store_result()) {
					$result->free();
				}
				$mysqli->more_results();
			} while ($mysqli->next_result());
		}
		else{
			echo "merde:" . $mysqli->error . "<br>";
			var_dump($mysqli);	
		}

		
		$sql = "INSERT INTO config VALUES(NULL,".time().",".time().",0,1,'','".$_POST['servername']."',".$_POST['defgold'].",".$_POST['auctime'].",'gpack/img_ltr/',".$_POST['opening'].",".$_POST['oasisx'].",".$_POST['speed'].",".$_POST['MOMENT_TRAIN'].",".$_POST['ARTEFACTS'].",".$_POST['WW_PLAN'].",".$_POST['cranny'].",".max($_POST['adv'],1).",".round($_POST['speed']/80).",".$_POST['storage_multiplier'].",".$_POST['incspeed'].",".$_POST['beginner'].",".$_POST['tradercap'].",".$_POST['plus_time'].",".$_POST['plus_production'].",'".$_POST['homepage']."','admin@turkeytravian.com',10,100,5,1,25,400,80,50,1000,2500,4900,75,150,250,180000000,560000000,1800000000,'ar',0,0)";
		$mysqli->query($sql) or die(mysqli_error($mysqli));

		
		header("Location: index.php?s=3");

	
	}

	function createStruc() {
        $p_query = file_get_contents("data/sql.sql");
		$mysqli = new mysqli(SQL_SERVER,SQL_USER,SQL_PASS,SQL_DB);

        //mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS);
		//
		/* query all tables */

		$sql = "DROP TABLE `a2b`, `odemeler`,`paketler`,`abdata`, `achiev`, `activate`, `adventure`, `alidata`, `ali_invite`, `ali_log`, `ali_permission`, `antimult`, `artefacts`, `attacks`, `auction`, `banlist`, `bdata`, `buygold`, `confs`, `critical_log`, `demolition`, `diplomacy`, `enforcement`, `farmlist`, `fdata`, `hero`, `heroface`, `heroinventory`, `heroitems`, `links`, `log`, `map_control`, `market`, `mdata`, `medal`, `movement`, `ndata`, `newproc`, `news`, `odata`, `online`, `palevo`, `password`, `prisoners`, `queue`, `raidlist`, `referals`, `research`, `roullet`, `route`, `sitters`, `spravka`, `tdata`, `training`, `units`, `users`, `vdata`, `wdata`, `config`, `codes`, `payments`, `autorenewals`, `quests`, `deleted`, `ignore`, `plusaddons`;";

		//@$database->queryFetch($sql);
		$mysqli->query($sql);
        $p_query = 'START TRANSACTION;' . $p_query . '; COMMIT;';

            $query_split = preg_split ("/[;]+/", $p_query);
            foreach ($query_split as $command_line) {
                $command_line = trim($command_line);
                if ($command_line != '') {
                    $query_result = $mysqli->query($command_line);
                    if ($query_result == 0) {
                        break;
                    }
                }
            }

			$mysqli->query("INSERT INTO config VALUES(".time().",".time().",0,1,'')");
		if($query_result) {
			header("Location: index.php?s=3");
		} else {
			header("Location: index.php?s=2&c=1");
		}
	}

	function createWdata() {
		header("Location: include/wdata.php");
	}

}
;

$process = new Process;


