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
$min = 400;
$max = 400;
$hammadde = rand($min, $max)*(SPEED);
			$q = "INSERT INTO `odata` (`wref`, `type`, `conqured`, `wood`, `iron`, `clay`, `maxstore`, `crop`, `maxcrop`, `lastupdated`, `loyalty`, `owner`) VALUES ('".$row['id']."','".$row['oasistype']."','0','".$hammadde."','".$hammadde."','".$hammadde."','".$hammadde."','".$hammadde."','".$hammadde."','" . time() . "','".$hammadde."','4')";

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

					//+50% lumber per hour

					$q = "UPDATE units SET u1 = u1 + '".$speed*rand(50,120)."',u2 = u2 + '".$speed*rand(15,40)."',u3 = u3 + '".$speed*rand(15,40)."',u4 = u4 + '".$speed*rand(15,40)."',u5 = u5 + '".$speed*rand(15,40)."',u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."',u8 = u8 + '".$speed*rand(15,40)."',u9 = u9 + '".$speed*rand(15,40)."',u10 = u10 + '".$speed*rand(9,20)."',u11 = u11 + '".$speed*rand(6,19)."' WHERE vref = '" . $wid . "'";
                    $q2 = "UPDATE units SET u1 = u1 + '".$speed*rand(50,120)."',u2 = u2 + '".$speed*rand(15,40)."',u3 = u3 + '".$speed*rand(15,40)."',u4 = u4 + '".$speed*rand(15,40)."',u5 = u5 + '".$speed*rand(15,40)."',u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."',u8 = u8 + '".$speed*rand(15,40)."',u9 = u9 + '".$speed*rand(15,40)."',u10 = u10 + '".$speed*rand(9,20)."',u11 = u11 + '".$speed*rand(6,19)."' WHERE vref = '" . $wid . "'";
					$database->query($q2); 
                $database->query($q);

					break;

				case 3:

					//+50% lumber and +50% crop per hour

					$q = "UPDATE units SET u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."', u8 = u8 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
                    $q2 = "UPDATE units SET u1 = u1 + '".$speed*rand(50,120)."',u2 = u2 + '".$speed*rand(15,40)."',u3 = u3 + '".$speed*rand(15,40)."',u4 = u4 + '".$speed*rand(15,40)."',u5 = u5 + '".$speed*rand(15,40)."',u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."',u8 = u8 + '".$speed*rand(15,40)."',u9 = u9 + '".$speed*rand(15,40)."',u10 = u10 + '".$speed*rand(9,20)."',u11 = u11 + '".$speed*rand(6,19)."' WHERE vref = '" . $wid . "'";
					$database->query($q2); 
					$database->query($q);

					break;

				case 4:

				case 5:

					//+50% clay per hour

					$q = "UPDATE units SET u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
                     $q2 = "UPDATE units SET u1 = u1 + '".$speed*rand(50,120)."',u2 = u2 + '".$speed*rand(15,40)."',u3 = u3 + '".$speed*rand(15,40)."',u4 = u4 + '".$speed*rand(15,40)."',u5 = u5 + '".$speed*rand(15,40)."',u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."',u8 = u8 + '".$speed*rand(15,40)."',u9 = u9 + '".$speed*rand(15,40)."',u10 = u10 + '".$speed*rand(9,20)."',u11 = u11 + '".$speed*rand(6,19)."' WHERE vref = '" . $wid . "'";
					$database->query($q2);
					$database->query($q);

					break;

				case 6:

					//+50% clay and +50% crop per hour

					$q = "UPDATE units SET u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."', u8 = u8 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
                     $q2 = "UPDATE units SET u1 = u1 + '".$speed*rand(50,120)."',u2 = u2 + '".$speed*rand(15,40)."',u3 = u3 + '".$speed*rand(15,40)."',u4 = u4 + '".$speed*rand(15,40)."',u5 = u5 + '".$speed*rand(15,40)."',u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."',u8 = u8 + '".$speed*rand(15,40)."',u9 = u9 + '".$speed*rand(15,40)."',u10 = u10 + '".$speed*rand(9,20)."',u11 = u11 + '".$speed*rand(6,19)."' WHERE vref = '" . $wid . "'";
					$database->query($q2);
					$database->query($q);

					break;

				case 7:

				case 8:

					//+50% iron per hour

					$q = "UPDATE units SET u1 = u1 + '".$speed*rand(50,120)."', u2 = u2 + '".$speed*rand(10,20)."', u4 = u4 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
                    
					$database->query($q);

					break;

				case 9:

					//+50% iron and +50% crop

					$q = "UPDATE units SET u1 = u1 + '".$speed*rand(50,120)."', u2 = u2 + '".$speed*rand(10,20)."', u4 = u4 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
                    $q2 = "UPDATE units SET u1 = u1 + '".$speed*rand(50,120)."',u2 = u2 + '".$speed*rand(15,40)."',u3 = u3 + '".$speed*rand(15,40)."',u4 = u4 + '".$speed*rand(15,40)."',u5 = u5 + '".$speed*rand(15,40)."',u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."',u8 = u8 + '".$speed*rand(15,40)."',u9 = u9 + '".$speed*rand(15,40)."',u10 = u10 + '".$speed*rand(9,20)."',u11 = u11 + '".$speed*rand(6,19)."' WHERE vref = '" . $wid . "'";
					$database->query($q2);
					$database->query($q);

					break;

				case 10:

				case 11:

					//+50% crop per hour

					$q = "UPDATE units SET u3 = u3 + '".$speed*rand(0,20)."', u7 = u7 + '".$speed*rand(0,10)."', u8 = u8 + '".$speed*rand(0,10)."' WHERE vref = '" . $wid . "'";
                    $q2 = "UPDATE units SET u1 = u1 + '".$speed*rand(50,120)."',u2 = u2 + '".$speed*rand(15,40)."',u3 = u3 + '".$speed*rand(15,40)."',u4 = u4 + '".$speed*rand(15,40)."',u5 = u5 + '".$speed*rand(15,40)."',u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."',u8 = u8 + '".$speed*rand(15,40)."',u9 = u9 + '".$speed*rand(15,40)."',u10 = u10 + '".$speed*rand(9,20)."',u11 = u11 + '".$speed*rand(6,19)."' WHERE vref = '" . $wid . "'";
					$database->query($q2);
					$database->query($q);

					break;

				case 12:

					//+100% crop per hour

					$q = "UPDATE units SET u3 = u3 + '".$speed*rand(0,20)."', u7 = u7 + '".$speed*rand(0,10)."', u8 = u8 + '".$speed*rand(0,10)."', u9 = u9 + '".$speed*rand(0,10)."' WHERE vref = '" . $wid . "'";
                    $q2 = "UPDATE units SET u1 = u1 + '".$speed*rand(50,120)."',u2 = u2 + '".$speed*rand(15,40)."',u3 = u3 + '".$speed*rand(15,40)."',u4 = u4 + '".$speed*rand(15,40)."',u5 = u5 + '".$speed*rand(15,40)."',u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."',u8 = u8 + '".$speed*rand(15,40)."',u9 = u9 + '".$speed*rand(15,40)."',u10 = u10 + '".$speed*rand(9,20)."',u11 = u11 + '".$speed*rand(6,19)."' WHERE vref = '" . $wid . "'";
					$database->query($q2);
					$database->query($q);

					break;

			}



	}











		header("Location: ../index.php?s=6");

