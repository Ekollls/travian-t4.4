<?php
include ("../../application/config.php");
include ("../../application/Database/db_MYSQL.php");
set_time_limit(0);
ini_set('memory_limit', '-1');
//кол-inо чуд
$amt = 13;
$speed = round(SPEED/100);
//серая зона
$nareadis=22;
$database->query("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
$database->starttransaction();
$xyas=(1+(2*WORLD_MAX));

for($i=0; $i<$xyas; $i++){
    $q="INSERT into wdata values ";
$y=(WORLD_MAX-$i);

	for($j=0; $j<$xyas; $j++){
	$x=((WORLD_MAX*-1)+$j);

	//choose a field type
	if($x == 0 && $y == 0 || $x==1 && $y==1){
		$typ='3';
		$otype='0';
	}else{
	$rand=rand(1, 1000);
		if("10" >= $rand){
		$typ='1';
		$otype='0';
		} else if("90" >= $rand){
		$typ='2';
		$otype='0';
		} else if("400" >= $rand){
		$typ='3';
		$otype='0';
		} else if("480" >= $rand){
		$typ='4';
		$otype='0';
		} else if("560" >= $rand){
		$typ='5';
		$otype='0';
		} else if("570" >= $rand){
		$typ='6';
		$otype='0';
		} else if("600" >= $rand){
		$typ='7';
		$otype='0';
		} else if("630" >= $rand){
		$typ='8';
		$otype='0';
		} else if("660" >= $rand){
		$typ='9';
		$otype='0';
		} else if("740" >= $rand){
		$typ='10';
		$otype='0';
		} else if("820" >= $rand){
		$typ='11';
		$otype='0';
		} else if("900" >= $rand){
		$typ='12';
		$otype='0';
		} else if("908" < $rand){
            $typ='3';
            $otype='0';

		}
	}
	//image pick
//	if($otype=='0'){
		$image="t".rand(0,9)."";
	//} else {
	//	$image="o".$otype."";
	//}
//
		//into database
		$q .= "(0,'".$typ."','".$otype."','".$x."','".$y."',0,'".$image."',0,'',0,''),";

	}
    $q = (substr($q, 0, -1));

    $database->query($q);
}
$database->commitq();


$database->setFieldTaken($database->getBaseID(0,0)); //забиinаем клетку 0/0
$database->setFieldTaken($database->getBaseID(1,1)); //забиinаем клетку 1/1

    //ебашим стольню натар на 1|0
function generateBase($kid, $uid, $username)
{
    global $database;

    $wid = $database->getBaseID(1,0);
    $database->setFieldTaken($wid);
    $database->addVillage($wid, $uid, $username, 1, 888);
    $database->addResourceFields($wid, $database->getVillageType($wid));
    $database->addUnits($wid);
    $database->addTech($wid);
    $database->addABTech($wid);
    return $wid;
}


/**
 * Creating account & capital village
 */
$username = "Natars";
$password = md5("superparoldlyanatar");
$email = "natars@noreply.com";
$tribe = 5;
$desc = "********************
					[#natars]
				********************";

$q = "INSERT INTO users (id,username,password,email,timestamp,tribe,protect,desc2) VALUES (3, '" . $username . "', '" . $password . "', '" . $email . "', " . time() . ", 5,0,'" . $desc . "')";
$database->query($q);
unset($q);
$uid = 3;
$wid = generateBase(0, $uid, $username);
$frandom0 = rand(0,4);$frandom1 = rand(0,3);$frandom2 = rand(0,4);$frandom3 = rand(0,3);


$database->addHeroFace($uid,$frandom0,$frandom1,$frandom2,$frandom3,$frandom3,$frandom2,$frandom1,$frandom0,$frandom2);
$database->addHero($uid);
$database->addHeroinventory($uid);
$spe = 8888;

$q3 = "UPDATE units SET u1 = " . (34700 * $spe) . ", u2 = " . (29531 * $spe) . ", u3 = " . (18747 * $spe) . ", u4 = " . (7 * $spe) . ", u5 = " . (34401 * $spe) . ", u6 = " . (21602 * $spe) . ", u7 = " . (2034 * $spe) . ", u8 = " . (10 * $spe) . " , u9 = " . (1 * $spe) . ", u10 = " . (9 * $spe) . " WHERE vref = " . $wid . "";
$database->query($q3);

//добаinляем чуды
$kid=0;
$wwids=array($database->getBaseID(-100,100),
     $database->getBaseID(-100,-100),
     $database->getBaseID(100,-100),
     $database->getBaseID(100,100),
    $database->getBaseID(100,0),
    $database->getBaseID(-100,0),
    $database->getBaseID(0,100),
    $database->getBaseID(0,-100));
foreach($wwids as $wid){
    $database->setFieldTaken($wid);
    $coo=$database->getWInfo($wid);
    $time = time();
    $q = "INSERT  into vdata (`wref`,`owner`,`name`,`capital`,`pop`,`cp`,`celebration`,`type`,`wood`,`clay`,`iron`,`maxstore`,`crop`,`maxcrop`,`lastupdate`,`loyalty`,`exp1`,`exp2`,`exp3`,`created`,`natar`,`vx`,`vy`,`vtype`) values ('$wid','3','WW village',0,233,0,0,0,80000.00,80000.00,80000.00,80000,80000.00,80000,1314974534,100,0,0,0,$time,1,".$coo['x'].",".$coo['y'].",".$coo['fieldtype'].")";
    $database->query($q);
    $q = "INSERT  into fdata (`vref`,`f1`,`f1t`,`f2`,`f2t`,`f3`,`f3t`,`f4`,`f4t`,`f5`,`f5t`,`f6`,`f6t`,`f7`,`f7t`,`f8`,`f8t`,`f9`,`f9t`,`f10`,`f10t`,`f11`,`f11t`,`f12`,`f12t`,`f13`,`f13t`,`f14`,`f14t`,`f15`,`f15t`,`f16`,`f16t`,`f17`,`f17t`,`f18`,`f18t`,`f19`,`f19t`,`f20`,`f20t`,`f21`,`f21t`,`f22`,`f22t`,`f23`,`f23t`,`f24`,`f24t`,`f25`,`f25t`,`f26`,`f26t`,`f27`,`f27t`,`f28`,`f28t`,`f29`,`f29t`,`f30`,`f30t`,`f31`,`f31t`,`f32`,`f32t`,`f33`,`f33t`,`f34`,`f34t`,`f35`,`f35t`,`f36`,`f36t`,`f37`,`f37t`,`f38`,`f38t`,`f39`,`f39t`,`f40`,`f40t`,`f99`,`f99t`,`wwname`) values ($wid,0,1,0,4,0,1,0,3,0,2,0,2,0,3,0,4,0,4,0,3,0,3,0,4,0,4,0,1,0,4,0,2,0,1,0,2,20,17,20,11,20,15,20,10,10,22,10,25,0,0,0,0,10,19,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,16,0,0,0,40,'WW')";
    $database->query($q);
    $database->addUnits($wid);
    $database->addTech($wid);
    $database->addABTech($wid);

    $database->query("UPDATE units SET u1 = " . (rand(2000, 4000) * $speed) . ", u2 = " . (rand(3000, 4000) * $speed) . ", u3 = " . (rand(4600, 5600) * $speed) . ", u4 = " . (rand(50, 150) * $speed) . ", u5 = " . (rand(2400, 3800) * $speed) . ", u6 = " . (rand(3000, 4000) * $speed) . ", u7 = " . (rand(1000, 1800) * $speed) . ", u8 = " . (rand(200, 600) * $speed) . " , u9 = " . (rand(2, 10) * $speed) . ", u10 = " . (rand(2, 10) * $speed) . " WHERE vref = " . $wid . "");

}






function exist($x,$y,$_kk,$kk,$_ii,$ii){
    global $database;
    $maparray0="";
    for($i=$_ii;$i<=$ii;$i++){
        for($k=$_kk;$k<=$kk;$k++){
            $xx=$database->WPosition($x,$k);
            $yy=$database->WPosition($y,$i);
            $id=$database->getBaseID($xx,$yy);
            $maparray0 .= '\''.$id.'\',';
            if(in_array($xx,array(-2,-1,0,1,2)) && in_array($yy,array(-2,-1,0,1,2)) || (($xx==100 || $xx==-100 || $xx==0) && ($yy==0 || $yy==100 || $yy=-100))){
                return true;
            }
        }
    }

    $maparray0 = (substr($maparray0, 0, -1));
    if(count($database->query("SELECT id FROM wdata WHERE `type_of`!='' and `occupied`='0' and `id` IN(".$maparray0.")"))){
        return true;
    }
    return false;
}
$maparray="";
for($i=-3;$i<=2;$i++){
    for($k=-3;$k<=3;$k++){
        $id=$database->getBaseID($database->WPosition(0,$k),$database->WPosition(0,$i));
        $maparray .= '\''.$id.'\',';
    }
}
$maparray = (substr($maparray, 0, -1));
$wdata=$database->query("SELECT x,y FROM wdata WHERE `occupied` = '0' and `oasistype`= '0' and `id` NOT IN (".$maparray.") ORDER BY RAND() LIMIT ".round((WORLD_MAX*(WORLD_MAX*2))));
$coor_exist=array();
foreach($wdata as $w){
    $coor_around=array();
    $coor_around['00']=$database->getBaseID($database->WPosition($w['x'],0),$database->WPosition($w['y'],0));

    $database->starttransaction();
    $maparray0='';
    $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];
    $mapa = sqrt(($w['x']*$w['x'])+($w['y']*$w['y']));
    if ($mapa<=$nareadis) {
        $oas50=array(2,3,5,6,8,9,12);
        $identif=array_rand($oas50,1);
        $otype=$oas50[$identif];
    }

    switch($otype) {
        case 1:
        case 2:
        case 3:
            $type=rand(0,7);

            switch($type){
                case 0:
                    if(exist($w['x'],$w['y'],0,0,0,0)){
                        break;
                    }
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");

                    break;
                case 1:
                    if(exist($w['x'],$w['y'],0,1,-1,0)){
                        break;
                    }
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$w['y']."'");
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                    break;
                case 2:
                    if(exist($w['x'],$w['y'],0,1,0,0)){
                        break;
                    }
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$w['y']."'");
                    break;
                case 3:
                    if(exist($w['x'],$w['y'],0,0,-1,0)){
                        break;
                    }
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                    break;
                case 4:
                    if(exist($w['x'],$w['y'],0,1,-1,0)){
                        break;
                    }
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$w['y']."'");
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                    break;
                case 5:
                    if(exist($w['x'],$w['y'],0,0,-2,0)){
                        break;
                    }
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_120' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                    break;
                case 6:
                    if(exist($w['x'],$w['y'],0,2,0,0)){
                        break;
                    }
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$w['y']."'");
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_0' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$w['y']."'");
                    break;
                case 7:
                    if(exist($w['x'],$w['y'],0,1,-1,0)){
                        break;
                    }
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$w['y']."'");
                    if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(1,2,3))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='forest',";}else{$quero="`adv`='1',`type_of`='forest',";}
                    $database->query("UPDATE wdata SET $quero  `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                    break;

            }


            break;
        case 4:
        case 5:
        case 6:
        $type=rand(0,7);

        switch($type){
            case 0:
                if(exist($w['x'],$w['y'],0,0,0,0)){
                    break;
                }
                if ($mapa>$nareadis) {
                    $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif]; 
                }
                else{
                    $oas50=array(2,3,5,6,8,9,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif]; 
                }
                if(in_array($otype,array(4,5,6))){
                    $quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";
                }else{
                    $quero="`adv`='1',`type_of`='clay',";
                }
                $database->query("UPDATE wdata SET $quero `image` ='o".$otype."' , `oasisimg` = '".$type."', `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                break;
            case 1:
                if(exist($w['x'],$w['y'],0,1,0,0)){
                    break;
                }
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$w['y']."'");


                break;
            case 2:
                if(exist($w['x'],$w['y'],0,0,-1,0)){
                    break;
                }
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){ $quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                break;
            case 3:
            case 7:
            if(exist($w['x'],$w['y'],0,1,-2,0)){
                break;
            }
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_120' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$w['y']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `image` ='o".$otype."' ,`partimg` = '60_120' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                break;
            case 4:
            case 5:
            case 6:
            if(exist($w['x'],$w['y'],0,1,-1,0)){
                break;
            }
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$w['y']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(4,5,6))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='clay',";}else{$quero="`adv`='1',`type_of`='clay',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                break;


        }
            break;
        case 7:
        case 8:
        case 9:
        $type=rand(0,7);
        switch($type){
            case 0:
                if(exist($w['x'],$w['y'],0,1,0,0)){
                    break;
                }
                $quero="`type_of`='hill',";
                $database->query("UPDATE wdata SET $quero `image` ='o".$otype."' , `oasisimg` = '".$type."', `partimg` = '0_60' WHERE `id` = '".$coor_around['00']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `image` ='o".$otype."' , `oasisimg` = '".$type."', `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$w['y']."'");
                break;
            case 1:
                if(exist($w['x'],$w['y'],0,3,-1,0)){
                    break;
                }
                $quero="`type_of`='hill',";
                //$database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                $quero="`type_of`='hill',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_0' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_60' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                $quero="`type_of`='hill',";
               // $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_0' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_60' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                break;
            case 2:
                if(exist($w['x'],$w['y'],0,3,-1,0)){
                    break;
                }
                $quero="`type_of`='hill',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_0' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_60' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                $quero="`type_of`='hill',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_0' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_60' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                break;
            case 3:
                if(exist($w['x'],$w['y'],0,3,-3,0)){
                    break;
                }
                $quero="`type_of`='hill',";
             //   $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
              //  $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_120' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-2)."'");
               // $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_180' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_120' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                $quero="`type_of`='hill',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_180' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                $quero="`type_of`='hill',";
               // $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_0' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_60' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_120' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                $quero="`type_of`='hill',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_180' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                //$database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_0' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$w['y']."'");
              //  $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_60' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
               // $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_120' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
              //  $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_180' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                break;
            case 4:
                if(exist($w['x'],$w['y'],0,3,-2,0)){
                    break;
                }
                $quero="`type_of`='hill',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_120' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-2)."'");
              //  $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `image` ='o".$otype."' ,`partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `image` ='o".$otype."' ,`partimg` = '60_120' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                $quero="`type_of`='hill',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_0' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `image` ='o".$otype."' ,`partimg` = '120_60' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `image` ='o".$otype."' ,`partimg` = '120_120' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                $quero="`type_of`='hill',";
              //  $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `image` ='o".$otype."' ,`partimg` = '180_0' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$w['y']."'");
              //  $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_60' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
              //  $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_120' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                break;
            case 5:
                if(exist($w['x'],$w['y'],0,4,-1,0)){
                    break;
                }
                $quero="`type_of`='hill',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_0' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_60' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_0' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$w['y']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `image` ='o".$otype."' ,`partimg` = '180_60' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                $quero="`type_of`='hill',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '240_0' WHERE `x` = '".$database->WPosition($w['x'],4)."' and `y` = '".$w['y']."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `image` ='o".$otype."' ,`partimg` = '240_60' WHERE `x` = '".$database->WPosition($w['x'],4)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                break;
            case 6:
                if(exist($w['x'],$w['y'],0,2,-3,0)){
                    break;
                }
                $quero="`type_of`='hill',";
              //  $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_120' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                //$database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_180' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_120' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_180' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                $quero="`type_of`='hill',";
                //$database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_0' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                //$database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."', `image` ='o".$otype."' ,`partimg` = '120_60' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
               // $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_120' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_180' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                break;
            case 7:
                if(exist($w['x'],$w['y'],0,1,0,0)){
                    break;
                }
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(7,8,9))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='hill',";}else{$quero="`adv`='1',`type_of`='hill',";}
                $database->query("UPDATE wdata SET $quero `image` ='o".$otype."' , `oasisimg` = '".$type."', `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                break;
        }
            break;
        case 10:
        case 11:
        case 12:
        $type=rand(0,7);

        switch($type){
            case 0:
                if(exist($w['x'],$w['y'],0,0,0,0)){
                    break;
                }
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `image` ='o".$otype."' , `oasisimg` = '".$type."', `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                break;
            case 1:
                if(exist($w['x'],$w['y'],0,1,-1,0)){
                    break;
                }
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                break;
            case 2:
                if(exist($w['x'],$w['y'],0,3,-2,0)){
                    break;
                }
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_120' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_120' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_0' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_60' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_120' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_0' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_60' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_120' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                break;
            case 3:
                if(exist($w['x'],$w['y'],0,3,-3,0)){
                    break;
                }
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_120' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_180' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_120' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_180' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_0' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_60' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_120' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_180' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_0' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_60' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_120' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_180' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                break;
            case 4:
                if(exist($w['x'],$w['y'],0,2,-2,0)){
                    break;
                }
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_120' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_120' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_0' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_60' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_120' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
              break;
            case 5:
                if(exist($w['x'],$w['y'],0,4,-4,0)){
                    break;
                }
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_120' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_180' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_240' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-4)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_120' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_180' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_240' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-4)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_0' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_60' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_120' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_180' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_240' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-4)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_0' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_60' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_120' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_180' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_240' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-4)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '240_0' WHERE `x` = '".$database->WPosition($w['x'],4)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '240_60' WHERE `x` = '".$database->WPosition($w['x'],4)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '240_120' WHERE `x` = '".$database->WPosition($w['x'],4)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '240_180' WHERE `x` = '".$database->WPosition($w['x'],4)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '240_240' WHERE `x` = '".$database->WPosition($w['x'],4)."' and `y` = '".$database->WPosition($w['y'],-4)."'");

                break;
            case 6:
                if(exist($w['x'],$w['y'],0,3,-3,0)){
                    break;
                }
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_60' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_120' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '0_180' WHERE `x` = '".$w['x']."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_60' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_120' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '60_180' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_0' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_60' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_120' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '120_180' WHERE `x` = '".$database->WPosition($w['x'],2)."' and `y` = '".$database->WPosition($w['y'],-3)."'");
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_0' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],0)."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_60' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-1)."'");
                $quero="`type_of`='lake',";
                $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_120' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-2)."'");
              //  $database->query("UPDATE wdata SET $quero `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '180_180' WHERE `x` = '".$database->WPosition($w['x'],3)."' and `y` = '".$database->WPosition($w['y'],-3)."'"); break;
            case 7:
                if(exist($w['x'],$w['y'],0,1,0,0)){
                    break;
                }
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `image` ='o".$otype."' , `oasisimg` = '".$type."', `partimg` = '0_0' WHERE `id` = '".$coor_around['00']."'");
                if ($mapa>$nareadis) {  $oas50=array(1,3,4,6,7,9,10,11,12);
                    $identif=array_rand($oas50,1);
                    $otype=$oas50[$identif];}else{        $oas50=array(2,3,5,6,8,9,12);         $identif=array_rand($oas50,1);         $otype=$oas50[$identif]; } if(in_array($otype,array(10,11,12))){$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='lake',";}else{$quero="`adv`='1',`type_of`='lake',";}
                $database->query("UPDATE wdata SET $quero `image` ='o".$otype."' , `oasisimg` = '".$type."', `partimg` = '60_0' WHERE `x` = '".$database->WPosition($w['x'],1)."' and `y` = '".$w['y']."'");
                break;
        }
            break;
    }
$database->commitq();
}
for($i=1;$i<=($amt-8);$i++) {
    $kid += 1;
    if($kid ==4){
        $kid=1;}

    $wid = $database->generateBase($kid);
    $database->setFieldTaken($wid);
    $coo=$database->getWInfo($wid);
    $time = time();
    $q = "INSERT  into vdata (`wref`,`owner`,`name`,`capital`,`pop`,`cp`,`celebration`,`type`,`wood`,`clay`,`iron`,`maxstore`,`crop`,`maxcrop`,`lastupdate`,`loyalty`,`exp1`,`exp2`,`exp3`,`created`,`natar`,`vx`,`vy`,`vtype`) values ('$wid','3','WW village',0,233,0,0,0,80000.00,80000.00,80000.00,80000,80000.00,80000,1314974534,100,0,0,0,$time,1,".$coo['x'].",".$coo['y'].",".$coo['fieldtype'].")";
    $database->query($q);
    $q = "INSERT  into fdata (`vref`,`f1`,`f1t`,`f2`,`f2t`,`f3`,`f3t`,`f4`,`f4t`,`f5`,`f5t`,`f6`,`f6t`,`f7`,`f7t`,`f8`,`f8t`,`f9`,`f9t`,`f10`,`f10t`,`f11`,`f11t`,`f12`,`f12t`,`f13`,`f13t`,`f14`,`f14t`,`f15`,`f15t`,`f16`,`f16t`,`f17`,`f17t`,`f18`,`f18t`,`f19`,`f19t`,`f20`,`f20t`,`f21`,`f21t`,`f22`,`f22t`,`f23`,`f23t`,`f24`,`f24t`,`f25`,`f25t`,`f26`,`f26t`,`f27`,`f27t`,`f28`,`f28t`,`f29`,`f29t`,`f30`,`f30t`,`f31`,`f31t`,`f32`,`f32t`,`f33`,`f33t`,`f34`,`f34t`,`f35`,`f35t`,`f36`,`f36t`,`f37`,`f37t`,`f38`,`f38t`,`f39`,`f39t`,`f40`,`f40t`,`f99`,`f99t`,`wwname`) values ($wid,0,1,0,4,0,1,0,3,0,2,0,2,0,3,0,4,0,4,0,3,0,3,0,4,0,4,0,1,0,4,0,2,0,1,0,2,20,17,20,11,20,15,20,10,10,22,10,25,0,0,0,0,10,19,0,0,0,0,0,0,10,23,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,16,0,0,0,40,'World Wonder')";
    $database->query($q);
    $database->addUnits($wid);
    $database->addTech($wid);
    $database->addABTech($wid);

    $database->query("UPDATE units SET u1 = " . (rand(2000, 4000) * $speed) . ", u2 = " . (rand(3000, 4000) * $speed) . ", u3 = " . (rand(4600, 5600) * $speed) . ", u4 = " . (rand(50, 150) * $speed) . ", u5 = " . (rand(2400, 3800) * $speed) . ", u6 = " . (rand(3000, 4000) * $speed) . ", u7 = " . (rand(1000, 1800) * $speed) . ", u8 = " . (rand(200, 600) * $speed) . " , u9 = " . (rand(2, 10) * $speed) . ", u10 = " . (rand(2, 10) * $speed) . " WHERE vref = " . $wid . "");

}






		header("Location: ../index.php?s=4");

