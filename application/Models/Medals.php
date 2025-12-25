<?php
/*
    By iRedux - https://www.facebook.com/opito8
*/
include("application/Ranking.php");

Class Medals{
    function __construct(){
        
    }
    
    function getP($type){
        global $database;

        switch($type){
            case 1:$b='clp';break;
            case 2:$b='ap';break;
            case 3:$b='dp';break;
            case 4:$b='RR';break;
        }

		$q = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY ".$b." DESC Limit 10");
        return $q;
    }

    function addMedal($user, $cat, $plat, $week, $points, $img){
        global $database;
        $database->query("INSERT into medal(userid, categorie, plaats, week, points, img) values('".$user."', '".$cat."', '".($plat)."', '".$week."', '".$points."', '".$img."')");
    }

    public function dMedals(){
        global $database;
        $result = $database->query("SELECT max(week) as max FROM medal where allycheck=0");
		if(count($result)) {
			$row=$result[0];
			$week=($row['max']+1);
		} else {
			$week=1;
		}
		
        for($x=1;$x<=4;$x++){
            switch($x){
                case 1:$b='clp';$p=10;break;
                case 2:$b='ap';$p=1;break;
                case 3:$b='dp';$p=2;break;
                case 4:$b='RR';$p=4;break;
			}
			
			$i=0;
            foreach($this->getP($x) as $row){
				
                $i++; $img="t".$x."_".($i)."";
                if($row[$b] != 0){
                    $database->query("INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '".$p."', '".($i)."', '".$week."', '".$row[$b]."', '".$img."')");
                }
            }
        }
		$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY ap DESC Limit 10");
		foreach($result as $row){
            $result2 = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY dp DESC Limit 10");
            foreach($result2 as $row2){
                if($row['id']==$row2['id']){

                $query3="SELECT count(*) as sum FROM medal WHERE userid='".$row['id']."' AND categorie = 5";
                $result3=$database->query($query3);
                $row3=$result3[0];
                    if($row3['sum']<='2'){
                        $img="t22".$row3['sum']."_1";
                            switch ($row3['sum']) {
                                case "0":
                                    $tekst="";
                                    break;
                                case "1":
                                    $tekst="2 ";
                                    break;
                                case "2":
                                    $tekst="3";
                                    break;
                            }
                        $quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '5', '0', '".$week."', '".$tekst."', '".$img."')";
                        $database->query($quer);
                    }
                }
            }
        }

	    $result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY ap DESC Limit 10");
        foreach($result as $row){

            $query1="SELECT count(*) FROM medal WHERE userid='".$row['id']."' AND categorie = 1 AND plaats<=3";
            $result1=$database->query($query1);
            $row1=$result1[0];

            if($row1[0]=='3'){
                $img="t120_1";
                $quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '6', '0', '".$week."', '3', '".$img."')";
                $database->query($quer);
            }

            if($row1[0]=='5'){
                $img="t121_1";
                $quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '6', '0', '".$week."', '5', '".$img."')";
                $database->query($quer);
            }
            
            if($row1[0]=='10'){
                $img="t122_1";
                $quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '6', '0', '".$week."', '10', '".$img."')";
                $database->query($quer);
            }

        }

        $result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY ap DESC Limit 10");
        foreach($result as $row){

            $query1="SELECT count(*) as sum FROM medal WHERE userid='".$row['id']."' AND categorie = 1 AND plaats<=10";
            $result1=$database->query($query1);
            $row1=$result1[0];

            if($row1['sum']=='3'){
                $img="t130_1";
                $quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '12', '0', '".$week."', '3', '".$img."')";
                $database->query($quer);
            }

            if($row1['sum']=='5'){
                $img="t131_1";
                $quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '12', '0', '".$week."', '5', '".$img."')";
                $database->query($quer);
            }

            if($row1['sum']=='10'){
                $img="t132_1";
                $quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '12', '0', '".$week."', '10', '".$img."')";
                $database->query($quer);
            }

        }

        $result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY dp DESC Limit 10");
        foreach($result as $row){
            $query1="SELECT count(*) as sum FROM medal WHERE userid='".$row['id']."' AND categorie = 2 AND plaats<=3";
            $result1=$database->query($query1);
             $row1=$result1[0];

            if($row1['sum']=='3'){
                $img="t140_1";
                $quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '7', '0', '".$week."', '3', '".$img."')";
                $database->query($quer);
            }

            if($row1['sum']=='5'){
                $img="t141_1";
                $quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '7', '0', '".$week."', '5', '".$img."')";
                $database->query($quer);
            }

            if($row1['sum']=='10'){
                $img="t142_1";
                $quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '7', '0', '".$week."', '10', '".$img."')";
                $database->query($quer);
            }

        }
	//je staat voor 3e / 5e / 10e keer in de top 3 verdedigers
	//Pak de top10 verdedigers
	$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY dp DESC Limit 10");
	foreach($result as $row){

			$query1="SELECT count(*) as sum FROM medal WHERE userid='".$row['id']."' AND categorie = 2 AND plaats<=10";
			$result1=$database->query($query1);
			 $row1=$result1[0];


		//2x in gestaan, dit is 3e dus lintje (brons)
		if($row1['sum']=='3'){
			$img="t150_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '13', '0', '".$week."', '3', '".$img."')";
			$database->query($quer);
		}
		//4x in gestaan, dit is 5e dus lintje (zilver)
		if($row1['sum']=='5'){
			$img="t151_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '13', '0', '".$week."', '5', '".$img."')";
			$database->query($quer);
		}
		//9x in gestaan, dit is 10e dus lintje (goud)
		if($row1['sum']=='10'){
			$img="t152_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '13', '0', '".$week."', '10', '".$img."')";
			$database->query($quer);
		}

	}

	//je staat voor 3e / 5e / 10e keer in de top 3 klimmers
	//Pak de top10 klimmers
	$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY Rc DESC Limit 10");
	foreach($result as $row){

			$query1="SELECT count(*) as sum FROM medal WHERE userid='".$row['id']."' AND categorie = 3 AND plaats<=3";
			$result1=$database->query($query1);
			$row1=$result1[0];


		//2x in gestaan, dit is 3e dus lintje (brons)
		if($row1['sum']=='3'){
			$img="t100_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '8', '0', '".$week."', '3', '".$img."')";
			$database->query($quer);
		}
		//4x in gestaan, dit is 5e dus lintje (zilver)
		if($row1['sum']=='5'){
			$img="t101_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '8', '0', '".$week."', '5', '".$img."')";
			$database->query($quer);
		}
		//9x in gestaan, dit is 10e dus lintje (goud)
		if($row1['sum']=='10'){
			$img="t102_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '8', '0', '".$week."', '10', '".$img."')";
			$database->query($quer);
		}
	}//je staat voor 3e / 5e / 10e keer in de top 3 klimmers
	//Pak de top10 klimmers
	$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY Rc DESC Limit 10");
	foreach($result as $row){

			$query1="SELECT count(*) as sum FROM medal WHERE userid='".$row['id']."' AND categorie = 3 AND plaats<=10";
			$result1=$database->query($query1);
			 $row1=$result1[0];


		//2x in gestaan, dit is 3e dus lintje (brons)
		if($row1['sum']=='3'){
			$img="t110_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '14', '0', '".$week."', '3', '".$img."')";
			$database->query($quer);
		}
		//4x in gestaan, dit is 5e dus lintje (zilver)
		if($row1['sum']=='5'){
			$img="t111_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '14', '0', '".$week."', '5', '".$img."')";
			$database->query($quer);
		}
		//9x in gestaan, dit is 10e dus lintje (goud)
		if($row1['sum']=='10'){
			$img="t112_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '14', '0', '".$week."', '10', '".$img."')";
			$database->query($quer);
		}
	}

	//je staat voor 3e / 5e / 10e keer in de top 3 klimmers
	//Pak de top3 rank climbers
	$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY clp DESC Limit 10");
	foreach($result as $row){

			$query1="SELECT count(*) as sum FROM medal WHERE userid='".$row['id']."' AND categorie = 10 AND plaats<=3";
			$result1=$database->query($query1);
			 $row1=$result1[0];


		//2x in gestaan, dit is 3e dus lintje (brons)
		if($row1['sum']=='3'){
			$img="t200_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '11', '0', '".$week."', '3', '".$img."')";
			$database->query($quer);
		}
		//4x in gestaan, dit is 5e dus lintje (zilver)
		if($row1['sum']=='5'){
			$img="t201_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '11', '0', '".$week."', '5', '".$img."')";
			$database->query($quer);
		}
		//9x in gestaan, dit is 10e dus lintje (goud)
		if($row1['sum']=='10'){
			$img="t202_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '11', '0', '".$week."', '10', '".$img."')";
			$database->query($quer);
		}
	}
	//je staat voor 3e / 5e / 10e keer in de top 10klimmers
	//Pak de top3 rank climbers
	$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY clp DESC Limit 10");
	foreach($result as $row){

			$query1="SELECT count(*) as sum FROM medal WHERE userid='".$row['id']."' AND categorie = 10 AND plaats<=10";
			$result1=$database->query($query1);
			 $row1=$result1[0];


		//2x in gestaan, dit is 3e dus lintje (brons)
		if($row1['sum']=='3'){
			$img="t210_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '16', '0', '".$week."', '3', '".$img."')";
			$database->query($quer);
		}
		//4x in gestaan, dit is 5e dus lintje (zilver)
		if($row1['sum']=='5'){
			$img="t211_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '16', '0', '".$week."', '5', '".$img."')";
			$database->query($quer);
		}
		//9x in gestaan, dit is 10e dus lintje (goud)
		if($row1['sum']=='10'){
			$img="t212_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '16', '0', '".$week."', '10', '".$img."')";
			$database->query($quer);
		}
	}

	//je staat voor 3e / 5e / 10e keer in de top 10 overvallers
	//Pak de top10 overvallers
	$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY RR DESC Limit 10");
	foreach($result as $row){

			$query1="SELECT count(*) as sum FROM medal WHERE userid='".$row['id']."' AND categorie = 4 AND plaats<=3";
			$result1=$database->query($query1);
			$row1=$result1[0];


		//2x in gestaan, dit is 3e dus lintje (brons)
		if($row1['sum']=='3'){
			$img="t160_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '9', '0', '".$week."', '3', '".$img."')";
			$database->query($quer);
		}
		//4x in gestaan, dit is 5e dus lintje (zilver)
		if($row1['sum']=='5'){
			$img="t161_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '9', '0', '".$week."', '5', '".$img."')";
			$database->query($quer);
		}
		//9x in gestaan, dit is 10e dus lintje (goud)
		if($row1['sum']=='10'){
			$img="t162_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '9', '0', '".$week."', '10', '".$img."')";
			$database->query($quer);
		}
	} //je staat voor 3e / 5e / 10e keer in de top 10 overvallers
	//Pak de top10 overvallers
	$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY RR DESC Limit 10");
	foreach($result as $row){

			$query1="SELECT count(*) as sum FROM medal WHERE userid='".$row['id']."' AND categorie = 4 AND plaats<=10";
			$result1=$database->query($query1);
			 $row1=$result1[0];


		//2x in gestaan, dit is 3e dus lintje (brons)
		if($row1['sum']=='3'){
			$img="t170_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '15', '0', '".$week."', '3', '".$img."')";
			$database->query($quer);
		}
		//4x in gestaan, dit is 5e dus lintje (zilver)
		if($row1['sum']=='5'){
			$img="t171_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '15', '0', '".$week."', '5', '".$img."')";
			$database->query($quer);
		}
		//9x in gestaan, dit is 10e dus lintje (goud)
		if($row1['sum']=='10'){
			$img="t172_1";
			$quer="INSERT into medal(userid, categorie, plaats, week, points, img) values('".$row['id']."', '15', '0', '".$week."', '10', '".$img."')";
			$database->query($quer);
		}
	}

	//Zet alle waardens weer op 0

	 $database->query("UPDATE users SET ap=0, dp=0,Rc=0,clp=0, RR=0 ,herxp=0,merch=0 WHERE id >5");


	//Start alliance Medals wooot

	//Aanvallers v/d Week
	$result = $database->query("SELECT * FROM alidata ORDER BY ap DESC Limit 10");
	$i=0;     foreach($result as $row){
	$i++;    $img="a2_".($i)."";
	$quer="INSERT into medal(userid, categorie, plaats, week, points, img,allycheck) values('".$row['id']."', '1', '".($i)."', '".$week."', '".$row['ap']."', '".$img."','1')";
	$database->query($quer);
	}

	//Verdediger v/d Week
	$result = $database->query("SELECT * FROM alidata ORDER BY dp DESC Limit 10");
	$i=0;     foreach($result as $row){
	$i++;    $img="a3_".($i)."";
	$quer="INSERT into medal(userid, categorie, plaats, week, points, img,allycheck) values('".$row['id']."', '2', '".($i)."', '".$week."', '".$row['dp']."', '".$img."','1')";
	$database->query($quer);
	}

	  //Overvallers v/d Week
	$result = $database->query("SELECT * FROM alidata ORDER BY RR DESC Limit 10");
	$i=0;     foreach($result as $row){
	if($row['RR'] >= 0){
	$i++;    $img="a4_".($i)."";
	$quer="INSERT into medal(userid, categorie, plaats, week, points, img,allycheck) values('".$row['id']."', '4', '".($i)."', '".$week."', '".$row['RR']."', '".$img."','1')";
	$database->query($quer);
	}
	}

	//Rank climbers of the week
	$result = $database->query("SELECT * FROM alidata ORDER BY clp DESC Limit 10");
	$i=0;     foreach($result as $row){
	$i++;    $img="a1_".($i)."";
	$quer="INSERT into medal(userid, categorie, plaats, week, points, img,allycheck) values('".$row['id']."', '3', '".($i)."', '".$week."', '".$row['clp']."', '".$img."','1')";
	$database->query($quer);
	}



	 $database->query("UPDATE alidata SET ap=0, dp=0, RR=0, clp=0 WHERE id >0");

    }


}

$medals = new Medals;

