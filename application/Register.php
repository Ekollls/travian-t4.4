<?php
class Registr {
	function register($username, $password, $email, $tribe, $ref) {
		global $database;
		$time = time();
		$starttime= OPENING;
		if($starttime < $time){$timep = $time;}else{$timep = $starttime;}
        $params = array( 'user' => $username, 'pass' => $password, 'email' => $email, 'tribe' =>intval($tribe),'ref' => intval($ref),'timer'=> $timep,'up'=> $timep);
		//$ptime = time() + PROTECTION;
		if(OPENING > time()){ $ptime = OPENING + PROTECTION; }else{ $ptime = time() + PROTECTION;}
		$q = "INSERT INTO users (username,password,email,tribe,lastupdate,regtime,ptime,invited,gold,advtime,msg) VALUES (:user, :pass, :email,  :tribe,  :up, :timer, ".$ptime.", :ref, ".DEFAULT_GOLD.",".$timep.",1)";
		$database->query($q,$params);
		return $database->get_last_id();

	}

	function checkActivate($act) {
	global $database;
		$q = "SELECT * FROM activate where act = :act";
		$params = array('act'=>$act);
      return $database->query($q,$params);
	}
    function checkAccount($name,$email) {
        global $database;
        $q = "SELECT * FROM activate where `username` = :name or `email` = :email";
        $params = array('name'=>$name,'email'=>$email);
        return $database->query($q,$params);
    }

		function activate($username, $password, $email, $tribe, $loc,  $act, $act2,$ref) {
		global $database;
		$params = array('user'=>$username,'pass'=>$password,'email'=>$email,'tribe'=>0,'act'=>$act,'act2'=>$act2,'ref'=>$ref,'time'=>time(),'location'=>0);
		$q = "INSERT INTO activate (username,password,email,tribe,timestamp,act,act2,ref,location) VALUES (:user, :pass, :email, :tribe, :time, :act, :act2,:ref,:location)";
		$database->query($q,$params);
		return $database->get_last_id();
	}

		function unreg($username) {
		global $database;
		$params=array('user'=>$username);
		$q = "DELETE from activate where username = '".$username."'";
		$database->query($q,$params);
	}
}
$regme= new Registr;
