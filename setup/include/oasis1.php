<?php
set_time_limit(0);
ini_set('memory_limit', '-1');

		include ("../../application/config.php");
include ("../../application/Database/db_MYSQL.php");
		populateOasisdata();
        	function populateOasisdata() {
		global $database;

		$q2 = "SELECT id,oasistype FROM wdata where oasistype != 0";
		$res2=$database->query($q2);
		foreach($res2 as $row) {
            $database->query("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
            $database->starttransaction();
		//	$wid = $row['id'];
		//	$basearray = $database->getOMInfo($wid);
			//We switch type of oasis and instert record with apropriate infomation.
			$q = "INSERT INTO `odata` (`wref`, `type`, `conqured`, `wood`, `iron`, `clay`, `maxstore`, `crop`, `maxcrop`, `lastupdated`, `loyalty`, `owner`) VALUES ('".$row['id']."','".$row['oasistype']."','0','400000','400000','400000','400000','400000','400000','" . time() . "','100','4')";
            $database->query($q);
			$q = "INSERT INTO `units` (`vref`) values ('".$row['id']."')";
			$database->query($q);
			populateOasis($row['id'],$row['oasistype']);
            $database->commitq();
		}
	}





	function populateOasis($wid,$type) {
 global $database;
        $speed=OASISX;
			switch($type) {
                
				case 1:
				case 2:
					//+25% lumber per hour
					$q = "UPDATE units SET u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
                $database->query($q);
					break;
				case 3:
					//+25% lumber and +25% crop per hour
					$q = "UPDATE units SET u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."', u8 = u8 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
					$database->query($q);
					break;
				case 4:
				case 5:
					//+25% clay per hour
					$q = "UPDATE units SET u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
					$database->query($q);
					break;
				case 6:
					//+25% clay and +25% crop per hour
					$q = "UPDATE units SET u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."', u8 = u8 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
					$database->query($q);
					break;
				case 7:
				case 8:
					//+25% iron per hour
					$q = "UPDATE units SET u1 = u1 + '".$speed*rand(15,40)."', u2 = u2 + '".$speed*rand(10,20)."', u4 = u4 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
					$database->query($q);
					break;
				case 9:
					//+25% iron and +25% crop
					$q = "UPDATE units SET u1 = u1 + '".$speed*rand(15,40)."', u2 = u2 + '".$speed*rand(10,20)."', u4 = u4 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
					$database->query($q);
					break;
				case 10:
				case 11:
					//+25% crop per hour
					$q = "UPDATE units SET u3 = u3 + '".$speed*rand(0,20)."', u7 = u7 + '".$speed*rand(0,10)."', u8 = u8 + '".$speed*rand(0,10)."' WHERE vref = '" . $wid . "'";
					$database->query($q);
					break;
				case 12:
					//+50% crop per hour
					$q = "UPDATE units SET u3 = u3 + '".$speed*rand(0,20)."', u7 = u7 + '".$speed*rand(0,10)."', u8 = u8 + '".$speed*rand(0,10)."', u9 = u9 + '".$speed*rand(0,10)."' WHERE vref = '" . $wid . "'";
					$database->query($q);
					break;
			}

	}





		header("Location: ../index.php?s=6");
