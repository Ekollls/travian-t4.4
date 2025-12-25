<?php
ini_set('default_charset', 'UTF-8');

class MYSQL_DB extends DB {

    function modifyFieldLevel($wid, $field, $level, $mode){

        $b = 'f' . $field;

        if (!$mode){return $this->query("UPDATE fdata SET $b=$b-$level WHERE vref=" . $wid);}

        return $this->query("UPDATE fdata SET $b=$b+$level WHERE vref=" . $wid);

    }



    function modifyFieldType($wid, $field, $type)

    {

        $b = 'f' . $field . 't';

        return $this->query("UPDATE fdata SET $b=$type WHERE vref=" . $wid);

    }

function getGlobalMedal($email) {

        $p=array('U'=>$email);

		$q = "SELECT * FROM `".DBSERVIDORES."`.`medalhas` where email = :U order by id desc";

		return $this->query($q,$p);



    }

function insertGlobalMedal($medalname, $descricao, $tempo, $imagem, $email) {



        $p=array('mail'=> $email, 'nome'=>$medalname, 'desc'=>$descricao,'img'=>$imagem);

        $q = "INSERT INTO `".DBSERVIDORES."`.`medalhas` (`id`, `email`, `nome`, `descricao`, `imagem`, `categorie`) VALUES (NULL, :mail , :nome , :desc , :img , '20')";

		$this->query($q,$p);



    }

//INSERT INTO `medalhas` (`id`, `email`, `nome`, `descricao`, `imagem`, `categorie`) VALUES (NULL, 'danilolifecoach@gmail.com', 'Medalha VIP', 'Jogador ajudou o servidor comprando Ouro', 'tvip', '20');

    function vernoticias(){

	$q = "SELECT * from news ORDER BY id";

	return $this->query($q);



	}

    function ADDnotificacao($uid,$tipo,$mensagem){

global $session;

     $time = time();

    switch($tipo){

       

        case 1 : $tempo = ($time+ 10);$gold=30;

        break;

        case 2 : $tempo = ($time + 30);$gold=60;

        break;

        case 3 : $tempo = ($time + 60);$gold=100;

        break;

    }

    $mensagem = utf8_encode($mensagem);

    $this->modifyGold($uid, $gold, 0);

    

    $p=array('autor'=> $uid, 'tempo'=>$tempo, 'servidor'=> SERVER_NAME,'tipo'=>$tipo,'user'=>$session->username);

	$q = "INSERT INTO `".DBSERVIDORES."`.`notificacao` (`id`, `autor`, `tempo`, `tipo`, `mensagem`, `servidor`,`username`) VALUES (NULL, :autor, :tempo, :tipo, '$mensagem' , :servidor, :user)";

	$this->query($q,$p);

  }

    

    function lenotificacoes(){

   	    $p=array('id'=> $id);

	    //$q = "SELECT * FROM `".DBSERVIDORES."`.notificacao WHERE `id` = :id";

        $q = "SELECT * FROM `".DBSERVIDORES."`.notificacao ORDER BY tempo ASC ";

		$answer = $this->query($q);

        return $answer;

    }  

    

    

    function hasHourseById($id, $uid) {

		$p=array('I'=> $id, 'U' => $uid);

		$q = "SELECT * FROM heroitems WHERE type = :I and uid = :U";

		$answer = $this->query($q,$p);

		if($answer) {

		    return true;

		}

		else {

		    return false;

		}

    }

	

	function checkAccountStatus($id) {

		/*

		$p=array('I'=> $id);

		$q = "SELECT * FROM users WHERE id = :I and protect = 0 and type = 0";

		$answer = $this->query($q,$p);

		if($answer) {

			return true;

		}

		else {

		    return false;

		}

	*/

		return false;

	}

	

	function setAccountType($id, $type) {

		if($type == 1) {

			$this->query("UPDATE users set gold=gold-750 WHERE id  = '".$id."'");

		}

		$p=array('I'=> $id, 'T'=> $type);

		$q = "UPDATE users set type = :T WHERE id = :I";

		$this->query($q,$p);

	}

	

	function setAccountStatus() {

		
	}

	

	 function fastTraining($uid,$vref) {
		$this->query("UPDATE  users set gold=gold-".FINISH_ALL_COST." WHERE id  = '".$uid."'");
		
        $time = time() + 3600;
		$this->setCorrectTimestamp($vref);

    }

	

	

	//inоооот..by Brainiac короче



	function FilterIntValue($value)

	{

		$returnValue = null;

		if(!$value)$returnValue = null;

		if(is_numeric($value))

		{

			$returnValue = intval($value);

		}

		else

		{

			$returnValue = null;

		}

		return $returnValue;

	}



function filterVar($value){

	$number=filter_var($value, FILTER_SANITIZE_NUMBER_INT);

	return $number;

	}





	function FilterFloatValue($value)

	{

		$returnValue = null;

		if(!$value)$returnValue = null;

		if(is_numeric($value))

		{

			$returnValue = floatval($value);

		}

		else

		{

			$returnValue = null;

		}

		return $returnValue;

	}



	function FilterStringValue($value)

	{

		$returnValue = null;

		if(!$value)$returnValue = null;

		$value = substr($value, 0, 40);

		$returnValue = htmlspecialchars($value);

		return $returnValue;

	}



	function FilterTextValue($value)

	{

		$returnValue = null;

		if(!$value)$returnValue = null;

		$returnValue = htmlspecialchars($value);

		return $returnValue;

	}







	function checkExist($ref, $mode) {



		if(!$mode) {

			$q = "SELECT username FROM users where username = :ref";

		} else {

			$q = "SELECT email FROM users where email = :ref";

		}

		$p=array('ref'=>$ref);

		$result =  $this->query($q,$p);

		if($result) {

			return true;

		} else {

			return false;

		}

	}





	function updateUserField($ref, $field, $value, $switch=1) {


		if(!$switch) {

			$q = "UPDATE users set ".$field." = :val where username = :ref";

		} else {

			$q = "UPDATE users set ".$field." = :val where id = :ref";

		}

        		$p=array('val'=>$value,'ref'=>$ref);

		$this->query($q,$p);







	}



       	function KillProtect($uid) {



        $q = "UPDATE users set `protect` = '0' where id = :uid";

        $p=array('uid'=>$uid);

	    $this->query($q,$p);

		}



	function getSitee($uid) {



		$q = "SELECT id,username from users where sit1 = :uid1 or sit2 = :uid2";

		$p=array('uid1'=>$uid,'uid2'=>$uid);

		$dbarray=$this->query($q,$p);

	    return $dbarray;

	}









	function removeMeSit($uid, $uid2) {



		$q = "UPDATE users set `sit1` = 0 where id = :uid1 and sit1 = :uid2";

		$p=array('uid1'=>$uid,'uid2'=>$uid2);

	    $this->query($q,$p);

	    $q = "UPDATE users set `sit2` = 0 where id = :uid1 and sit2 = :uid2";

	    		$p=array('uid1'=>$uid,'uid2'=>$uid2);

	    $this->query($q,$p);

    }



    function getUserField($ref, $field, $mode)

    {



        if (!$mode) {

            $q = "SELECT " . $field . " FROM users where id = :ref";

        } else {

            $q = "SELECT " . $field . " FROM users where username = :ref";

        }

        $p = array('ref' => $ref);

        $dbarray = $this->row($q, $p);

        return $dbarray[$field];

    }

    function getQuestUid($ref)

    {

        $q = "SELECT id,quest FROM users where username = :ref";

        $p = array('ref' => $ref);

        return $this->row($q,$p);

    }







 function getUserInfoByVillageID($vid)

    {



        $q = "SELECT u.id, u.tribe, u.alliance,u.cp,u.username,u.protect,u.regtime,v.name as vname FROM users as u  LEFT JOIN vdata as v ON (v.wref = :V) WHERE u.id = v.owner";

        $p = array('V' => $vid);

        return $this->row($q,$p);

    }



    function getUserVillInfoByVillageID($vid)

    {



        $q = "SELECT users.id, users.tribe,village.name,users.username,village.vx,village.vy,village.owner FROM users users LEFT JOIN vdata village ON (village.wref = :V) WHERE users.id = village.owner";

        $p = array('V' => $vid);

        return $this->row($q,$p);

    }



    function getEvasion($vid)

    {

        $q = "SELECT u.evasion,u.goldclub,v.capital,u.id FROM (

        vdata as v

        LEFT JOIN users as u ON u.id = v.owner)

        WHERE v.wref = :vID";

        $p= array('vID'=> $vid);

        return $this->row($q,$p);

    }

    function getMasterB($vid)

    {

        $q = "SELECT u.gold,u.tribe,u.plus,v.owner FROM (

        vdata as v

        LEFT JOIN users as u ON u.id = v.owner)

        WHERE v.wref = :vID";

        $p= array('vID'=> $vid);

        return $this->row($q,$p);

    }

    function getUserInfoByVID($vid)

    {

        $q = "SELECT u.id,u.username,u.b1,u.b2,u.b3,u.b4,u.alliance,u.tribe,u.brewery,u.cp,u.lastupdate as last,v.owner,v.loyalty,f.*,ab.*,v.pop,v.name as vname,v.vx,v.vy,

         h.* FROM ((((

        vdata as v

        LEFT JOIN users as u ON u.id = v.owner)



        LEFT JOIN fdata as f ON f.vref = :vID2)

        LEFT JOIN abdata as ab ON ab.vref = :vID1)

        LEFT JOIN hero as h ON h.uid = v.owner)

        WHERE v.wref = :vID";

        $p= array('vID'=> $vid,

        'vID1'=> $vid,

        'vID2'=> $vid)

        ;



        return $this->row($q,$p);

    }

    function getUserInfoByVIDD($vid) //функ

    {

        $q = "SELECT u.id,u.username,u.b1,u.b2,u.b3,u.b4,u.alliance,u.tribe,u.brewery,u.cp,u.lastupdate as last,u.evasion,u.evasiontime,

        v.owner,v.pop,v.lastupdate,v.maxstore as vmaxstore,v.maxcrop as vmaxcrop,v.capital,v.celebration,v.name as vname,v.type,v.natar,

        IF(v.loyalty IS NULL,o.loyalty, v.loyalty) as loyalty , IF(v.owner IS NULL, o.owner,v.owner) as owner,o.conqured,



        ab.*,

        w.fieldtype,w.oasistype,w.x,w.y,w.occupied,

        un.* FROM (((((

        wdata as w



        LEFT JOIN units as un ON un.vref = :vID)

        LEFT JOIN vdata as v ON v.wref = :vID1)



        LEFT JOIN odata as o ON o.wref = :vID2)

        LEFT JOIN users as u ON u.id = IF(v.owner IS NULL, o.owner,v.owner))

        LEFT JOIN abdata as ab ON ab.vref = :vID3)

        WHERE w.id = :vID4";

        $p= array('vID'=> $vid,

            'vID1'=> $vid,

            'vID2'=> $vid,

            'vID3'=> $vid,

            'vID4'=> $vid)

        ;

        return $this->row($q,$p);

    }

    function getUserInfoByVIDDR($vid) //функ

    {

        $q = "SELECT u.id,u.username,

        v.name as vname, IF(v.owner IS NULL, o.owner,v.owner) as owner,w.oasistype

         FROM (((

        wdata as w

        LEFT JOIN vdata as v ON v.wref = :vID1)

        LEFT JOIN odata as o ON o.wref = :vID2)

        LEFT JOIN users as u ON u.id = IF(v.owner IS NULL, o.owner,v.owner))

        WHERE w.id = :vID4";

        $p= array(

            'vID1'=> $vid,

            'vID2'=> $vid,

            'vID4'=> $vid)

        ;

        return $this->row($q,$p);

    }

    function WowSoQueryV($vid){

        $p= array ('vID'=> $vid);

        return $this->row("SELECT * FROM (((vdata as v LEFT JOIN tdata as t ON t.vref=v.wref) LEFT JOIN fdata as f ON f.vref=v.wref) LEFT JOIN units as un ON un.vref=v.wref) WHERE v.wref=:vID",$p);



    }

    function WowSoQueryH($uid){

        $p= array ('uid'=> $uid);

        return $this->row("SELECT * FROM hero as h LEFT JOIN heroface as hf ON hf.uid=h.uid  WHERE h.uid=:uid",$p);

    }

    function getUserInfoByat($vid)

    {

        $q = "SELECT

        v.owner,v.name as vname,o.owner as oowner,

        w.fieldtype,w.oasistype

          FROM ((

        vdata as v

        LEFT JOIN wdata as w ON w.id = :vID)

        LEFT JOIN odata as o ON o.wref = :vID1)



        WHERE v.wref = :vID2";

        $p= array('vID'=> $vid,

            'vID1'=> $vid,

            'vID2'=> $vid);

        return $this->row($q,$p);

    }

function EnfAll($id) {



    $q = "SELECT ab.a1,ab.a2,ab.a3,ab.a4,ab.a5,ab.a6,ab.a7,ab.a8,u.tribe,en.*,v.owner,u.username FROM (((enforcement as en

         LEFT JOIN vdata as v ON v.wref = en.from)

         LEFT JOIN abdata as ab ON ab.vref = en.from)

         LEFT JOIN users as u ON u.id = v.owner)

        where en.vref = :id";

    $p=array('id'=> $id);

    return $this->query($q, $p);



}

    function getEnf($id) {



        $q = "SELECT u.tribe,en.*,v.owner FROM ((enforcement as en

         LEFT JOIN vdata as v ON v.wref = en.from)

         LEFT JOIN users as u ON u.id = v.owner)

        where en.vref = :id";

$p=array('id'=> $id);

        return $this->query($q, $p);



    }



    function ClaimVillage($vref,$uid){

        $p=array('vID'=> $vref);



        $q = "DELETE FROM units WHERE vref = :vID";

        $this->query($q, $p);

        $this->addUnits($vref);

        $q = "DELETE FROM tdata WHERE `vref` = :vID";

        $this->query($q, $p);

$this->addTech($vref);

        $q = "DELETE FROM abdata WHERE `vref` = :vID";

        $this->query($q, $p);

        $this->addABTech($vref);

        $q = "DELETE FROM enforcement WHERE `from` = :vID";

        $this->query($q, $p);



        $q = "UPDATE odata SET `conqured` = '0',`owner` = '2'  where `conqured` = :vID";

        $this->query($q, $p);

        $q = "DELETE FROM training WHERE vref = :vID";

        $this->query($q, $p);

        $q = "DELETE FROM movement where `from` = :vID and sort_type=3";

        $this->query($q, $p);



        $q = "DELETE FROM movement where `to` = :vID and sort_type=4";

        $this->query($q, $p);

        $p=array('vID'=> $vref,

            'uid'=> $uid);

		// iRedux - Fix
		$this->query("UPDATE vdata SET `exp1`='0',`exp2`='0',`exp3`='0',`loyalty`='0',`owner`=:uid WHERE wref= :vID",$p);



    }

    function getUserInfoByVillageIDAtt($vid)

    {



        $q = "SELECT users.id, users.tribe, users.alliance,users.cp,users.brewery,users.lastupdate FROM users users LEFT JOIN vdata village ON (village.wref = :V) WHERE users.id = village.owner";

        $p = array('V' => $vid);

        return $this->row($q,$p);

    }



    function getUserInfoByOasisID($vid)

    {



        $q = "SELECT users.id, users.tribe, users.alliance,users.cp FROM users users LEFT JOIN odata oasis ON (oasis.wref = :V) WHERE users.id = oasis.owner";

        $p = array('V' => $vid);

        return $this->row($q,$p);

    }



    function getxyart($ids)
    {
        $q = "SELECT x,y,id FROM wdata WHERE id IN (".$ids.")";
        return $this->query($q);
    }


    function getAcOwByVillID($vid)

    {



        $q = "SELECT users.id,users.access,village.name,users.protect,users.regtime,users.username,users.alliance,ptime FROM users users LEFT JOIN vdata village ON (village.wref = :V) WHERE users.id = village.owner";

        $p = array('V' => $vid);

        return $this->row($q,$p);

    }



    function getUserTribeByOasisID($vid)

    {



        $q = "SELECT users.tribe FROM users users LEFT JOIN odata oasis ON (oasis.wref = :V) WHERE users.id = oasis.owner";

        $p = array('V' => $vid);

        return $this->single($q, $p);

    }



    function getUserNameByVilID($vid)

    {



        $q = "SELECT users.username,users.id,users.tribe FROM users users LEFT JOIN vdata village ON (village.wref = :V) WHERE users.id = village.owner";

        $p = array('V' => $vid);

        return $this->row($q,$p);

    }



    function getUserByVilID($vid)

    {



        $q = "SELECT users.id,users.tribe FROM users users LEFT JOIN vdata village ON (village.wref = :V) WHERE users.id = village.owner";

        $p = array('V' => $vid);

        return $this->row($q,$p);

    }



    function getUserforsoc($ID)

    {



        $q = "SELECT users.username, users.alliance, ali.tag, ali.id FROM users users LEFT JOIN alidata ali ON (ali.id = users.alliance) WHERE users.id = :U";

        $p = array('U' => $ID);

        return $this->row($q,$p);

    }



    function getUserTribeByVillageID($vid)

    {



        $q = "SELECT users.tribe FROM users users LEFT JOIN vdata village ON (village.wref = :V) WHERE users.id = village.owner";

        $p = array('V' => $vid);

        return $this->single($q, $p);

    }



    function getUserAlliByVillID($vid)

    {



        $q = "SELECT users.alliance FROM users users LEFT JOIN vdata village ON (village.wref = :V) WHERE users.id = village.owner";

        $p = array('V' => $vid);

        return $this->single($q, $p);

    }



    function getUserTribeIdByVillageID($vid)

    {



        $q = "SELECT users.tribe,users.id FROM users users LEFT JOIN vdata village ON (village.wref = :V) WHERE users.id = village.owner";

        $p = array('V' => $vid);

        return $this->row($q,$p);

    }



    function ThreeExp($vii)

    {



        $q = "SELECT exp1,exp2,exp3 FROM vdata WHERE wref = :V";

        $p = array('V' => $vii);

        return $this->row($q,$p);

    }



    function getUser($vid)

    {



        $q = "SELECT users.id, users.tribe, users.alliance,users.cp FROM users users LEFT JOIN vdata village ON (village.wref = :V) WHERE users.id = village.owner";

        $p = array('V' => $vid);

        return $this->row($q,$p);

    }



    function breweryparty($brewery, $wid,$uid)

    {





        $this->modifyResource($wid, 38700, 16800, 59400, 13400, false);

        $time = time() + 21600;

        $brewinf = "" . $time . "," . $brewery . "";

        $q = "UPDATE users SET `brewery`=:B WHERE `id` = :U";

        $p = array('U' => $uid,

        'B'=> $brewinf);

        $this->query($q, $p);



    }









	function getInvitedUser($uid) {



		$q = "SELECT * FROM users where `invited` = :U";

        $p=array('U'=> $uid);

	    $dbarray=$this->query($q, $p);

		return $dbarray;

	}



	function getVrefField($ref, $field){



		$q = "SELECT ".$field." FROM vdata where wref = :ref";

		$p=array('ref'=>$ref);

	    $dbarray=$this->row($q,$p);

		return $dbarray[$field];

	}





	function getActivateField($ref, $field, $mode) {



		if(!$mode) {

			$q = "SELECT ".$field." FROM activate where id = :ref";

		} else {

			$q = "SELECT ".$field." FROM activate where username = :ref";

		}

        $p=array('ref'=>$ref);

	    $dbarray=$this->row($q,$p);

		return $dbarray[$field];

	}

		function gettwoField($ref, $field) {



			$q = "SELECT ".$field." FROM activate where id = :ref";

        $p=array('ref'=>$ref);

	    return $this->row($q,$p);



		}



	function login($username, $password) {
		$q = $this->queryFetch('SELECT password,username FROM users where `username` = "'.$username.'" OR email = "'.$username.'"');
		/*echo $q['password']; die();
		$q = "SELECT password FROM users where `username` = :name";
		$p=array('name'=>$username);*/
		$pass=$q['password'];


		if($pass == md5($password.mb_convert_case($q['username'],MB_CASE_LOWER,"UTF-8"))) {
			return true;
		}else {
			return false;
		}
	}



	function checkActivate($act) {
		$q = "SELECT * FROM activate where act = :act";
        $p=array('act'=>$act);

       	return $this->row($q,$p);
	}



	function sitterLogin($username, $password) {





		$q = "SELECT sit1,sit2,id FROM users where username = :userna";

		$p=array('userna'=>$username);

	    $dbarray=$this->row($q,$p);

		if($dbarray['sit1'] != 0) {

			$q2 = "SELECT password,username FROM users where id = :si1";

		$p=array('si1'=>$dbarray['sit1']);

	    $dbarray2=$this->row($q2,$p);

		}

		if($dbarray['sit2'] != 0) {

			$q3 = "SELECT password,username FROM users where id = :si2";

		$p=array('si2'=>$dbarray['sit2']);

	    $dbarray3=$this->row($q3,$p);

		}



		if($dbarray['sit1'] != 0 || $dbarray['sit2'] != 0) {



			if($dbarray2['password'] == md5($password.mb_convert_case($dbarray2['username'],MB_CASE_LOWER,"UTF-8"))) {

				return array(true,$dbarray['id'],1,$dbarray2['username']);

			} elseif($dbarray3['password'] == md5($password.mb_convert_case($dbarray3['username'],MB_CASE_LOWER,"UTF-8"))) {

                return array(true,$dbarray['id'],2,$dbarray3['username']);}

		}

        return array(false,$dbarray['id'],0);

	}







	function setDeleting($uid, $mode) {

		$p=array('U'=>$uid);

		// deleting in 3 days
		$time = time() + 72 * 3600;

		if(!$mode) {
			$q = "UPDATE  users set deleting='".$time."' where id=:U";

		} else {

			$q = "UPDATE  users set deleting='0' where `id` = :U";

		}



        $this->query($q, $p);

		return $this->get_last_id();

	}



	function isDeleting($uid) {

		$p=array('U'=>$uid);

		$q = "SELECT deleting FROM users where id = :U";

        return $this->single($q, $p);

	}



	function modifyGold($userid, $amt, $mode) {
		global $session;

		if(!$mode){
			if($session->acData['a5'] < 6){
				$this->UpdateAchievU($userid,"`a5`=a5+2");
			}
		}
		$p=array('uID'=> $userid,

        'A'=>$amt);

		if(!$mode) {

			$q = "UPDATE users set gold = gold - :A where id = :uID";

		} else {

			$q = "UPDATE users set gold = gold + :A where id = :uID";

		}

		$this->query($q, $p);

	}



	/*****************************************

	 Functionretrieve user array via Username or ID

	Mode 0: Search by Username

	Mode 1: Search by ID

	References: Alliance ID

	*****************************************/



	function getUserArray($ref, $mode) {



		if(!$mode) {

			$q = "SELECT * FROM users where username = :ref";

		} else {

			$q = "SELECT * FROM users where id = :ref";

		}

		$p=array('ref'=>$ref);

	    return $this->row($q,$p);

	}

    function getUserSes($name) {

        $p=array('N'=>$name);
        return $this->row("SELECT id,password,email,access,plus,brewery,tribe,silver,lastupdate,alliance,sit1,sit2,regtime,protect,cp,gold,ok,deleting,b1,b2,b3,b4,goldclub,invited,evasion,quest,deleting,advtime,lang,apall,dpall,msg,vid,stime,ptime,tformat FROM users where `username` =:N",$p);

    }



		function getUserSessidFromOnline($ref,$dude) {

		$p=array('R'=> $ref,

        'D'=> $dude);

			$q = "SELECT sessid FROM online where `name` = :R and `id` = :D";

            return $this->single($q, $p);

	}



function InsertUniqueIP($ip,$email){

    $p=array('IP'=> $ip,

    'EM'=>$email);

    $this->query("INSERT INTO `antimult` (`id`,`email`,`ip`,`time`) VALUES ('0',:EM,:IP,'".time()."')",$p);

}

    function CheckUniqueIP($ip){

        $p=array('IP'=>$ip);

        $exist=$this->row("SELECT email FROM `antimult` WHERE `ip`=:IP",$p);

        if(!count($exist)){ return false;}

        if(!count($this->query("SELECT id FROM `users` WHERE `email`='".$exist['email']."'"))){return false;}

        return true;

    }











	function checkactiveSession($sessid) {

		$p=array('SSID'=>$sessid);

		$q = "SELECT sit FROM online where `sessid` = :SSID";

	    $dbarray=$this->query($q,$p);

		if(count($dbarray)) {

			return true;

		} else {

			return false;

		}

	}



	function submitProfile($uid, $gender, $location, $birthday, $des1, $des2) {



		$p=array('uid'=>$uid,'gen'=>$gender,'loca'=>$location,'birth'=>$birthday,'des1'=>$des1,'des2'=>$des2);

		$q = "UPDATE users set gender = :gen, location = :loca, birthday = :birth, desc1 = :des1, desc2 = :des2 where id = :uid";

		$this->query($q,$p);

	}





	function GetOnline($uid,$sessid) {

		$p=array('U'=>$uid,

        'SSID'=>$sessid);

		$q = "SELECT sit FROM online where `uid` = :U and `sessid`=:SSID";

        return $this->single($q, $p);

	}

    function profileoverview($uid) {

        $p=array('U'=>$uid);

        $q = "SELECT location,gender,birthday,desc1,desc2 FROM users where `id` = :U";

        return $this->row($q,$p);

    }

		function GetAOnline2($sessid) {
			
			$p=array('SSID'=>$sessid);

			$q = "SELECT sit FROM online where `sessid`=:SSID";
			return $this->query($q,$p);

		}

			function GetAOnline3($name) {

		$p=array('N'=>$name);

		$q = "SELECT sit FROM online where `name`=:N'";

		return $this->query($q,$p);

	}

				function GetAOnline4($name) {

                    $p=array('N'=>$name);

		$q = "SELECT ip FROM online where `name`=:N'";

                    return $this->query($q,$p);

	}

			function Killsession($ses) {

		$p=array('S'=>$ses);

		$q = "DELETE FROM online where `sessid`=:S";

		$this->query($q,$p);

	}

				function Killsessionip($ip,$name) {

		$p=array('IP'=>$ip,

        'N'=>$name);

		$q = "DELETE FROM online where `ip`=:IP and `name`=:N";

		$this->query($q,$p);

	}





				function culturePoints($uid,$lastup) {

					$p=array('U'=>$uid);

		$time = time()-60; // 1minutes

        $newupdate = time();

		 $q = "SELECT type,celebration,wref FROM vdata WHERE owner = :U";

		$forcp=$this->query($q,$p);

                   $cp=0;

                  foreach($forcp as $celcp){

                  	if($celcp['celebration']<=time() && $celcp['celebration']!=0 and $celcp['type']>0){

				if($celcp['type'] == 1){$cp += 500;}else if($celcp['type'] == 2){$cp += 2000;}

				$this->clearCel($celcp['wref']);

				$lastup=($celcp['lastupdate']==0)?time():$celcp['lastupdate'];

				}

				}

                    $bonuses=$this->allHeroBonuses($this->getHeroInventory($uid));



				if($lastup <= $time and $lastup!=0){

                    $q = "SELECT sum(cp) as sum FROM vdata WHERE owner = :U";



                    $cponly=$this->row($q,$p);

                  $cp += ($bonuses['culture']+$cponly['sum']) * (time()-$lastup)/86400;

                  }

				if($cp>10){

				$q = "UPDATE users set `cp` = cp + '".$cp."' , `lastupdate` = '".$newupdate."' where `id` = :U";

                 $this->query($q,$p);

				}







          }



	function UpdateOnline($mode, $name = "", $uid = 0,$sessid=0) {



		if($mode == "login") {

			$q = "INSERT  INTO online (name, uid, time, sit, sessid, ip) VALUES (:name, '".$uid."', " . time() . ", 0,'".$sessid."','".$_SERVER['REMOTE_ADDR']."')";

		$p=array('name'=>$name);

	    $this->query($q,$p);

	    return $this->get_last_id();

		} else if($mode == "sitter") {

			$q = "INSERT  INTO online (name, uid, time, sit, sessid, ip) VALUES (:name, '".$uid."', " . time() . ", 1,'".$sessid."','".$_SERVER['REMOTE_ADDR']."')";

		$p=array('name'=>$name);

	    $this->query($q,$p);

	    return $this->get_last_id();

		} else {

		$p=array('name'=>$name);
			$q = "DELETE FROM online WHERE name = :name and sessid ='".$sessid."'";

	    $this->query($q,$p);

		}

        return false;

	}





	function generateBase($sector) {

		$nareadis = 22.1 + 2; // iRedux - Fix

		$xm=$ym=0; $queryit='';
		switch($sector){
			case 1: $queryit=" -4 > x and y > ".rand(-1, -20)." and fieldtype = 3 and `type_of`='' and occupied = 0"; $xm=-1;$ym=1; break;
			case 2: $queryit=" -4 < x and y > ".rand(1, 20)." and fieldtype = 3 and `type_of`='' and occupied = 0"; $xm=1;$ym=1; break;
			case 3: $queryit=" 4 < x and y < ".rand(1, 20)." and fieldtype = 3 and `type_of`='' and occupied = 0 "; $xm=1;$ym=-1; break;
			case 4: $queryit=" 4 > x and y < ".rand(-1, -20)." and fieldtype = 3 and `type_of`='' and occupied = 0"; $xm=-1;$ym=-1; break;
		}

		$q = "SELECT id FROM wdata where ".$queryit." AND (SQRT(POW(x,2)+POW(y,2))>" . ($nareadis) . ")";
		$dbarray = $this->query($q);
		$mmasive=array();

		foreach($dbarray as $d){
			array_push($mmasive,$d['id']);

		}

		for($x=0;$x<=WORLD_MAX;$x++){
			for($y=0;$y<=$x;$y++){
				$id=$this->getBaseID($x*$xm,$y*$ym);
				if(in_array($id,$mmasive)){
					if(rand(1,5)==3){
						return $id; break;
					}
				}
			}
		}

		$q = "SELECT id FROM wdata where occupied = 0 and type_of='' LIMIT 0,1";
		return $this->single($q);



	}

    function generateBase2($sector) {

        $queryit='';

        switch($sector){

            case 1: $queryit=" 0 > x and y > 0 and fieldtype = 3 and occupied = 0 and x>-".(WORLD_MAX/RADIUS)." and y<".(WORLD_MAX/RADIUS)." and type_of='' ORDER BY RAND() LIMIT 1";

                break;

            case 2: $queryit=" 0 < x and y > 0 and fieldtype = 3 and occupied = 0 and x<".(WORLD_MAX/RADIUS)." and y<".(WORLD_MAX/RADIUS)." and type_of='' ORDER BY RAND() LIMIT 1";

                break;

            case 3: $queryit=" 0 < x and y < 0 and fieldtype = 3 and occupied = 0 and x<".(WORLD_MAX/RADIUS)." and y>-".(WORLD_MAX/RADIUS)." and type_of='' ORDER BY RAND() LIMIT 1";

                break;

            case 4: $queryit=" 0 > x and y < 0 and fieldtype = 3 and occupied = 0 and x>-".(WORLD_MAX/RADIUS)." and y>-".(WORLD_MAX/RADIUS)." and type_of='' ORDER BY RAND() LIMIT 1";

                break;

        }

        $q = "SELECT id FROM wdata where ".$queryit;

        return $this->single($q);

    }



	function setFieldTaken($id) {

		$p=array('id'=>$id);

        $q = "UPDATE wdata set occupied = 1 where id = :id";

		$this->query($q,$p);

	}







	function addVillage($wid, $uid, $username, $capital,$pop=2,$time=0) {

		if(!$time){$time=time();}

		$total = count($this->getVillagesID($uid));

		if($total >= 1) {
			$vname = new_village." ".($total + 1);
		} else {
			if(DIRECTION == 'rtl'){
				$vname = new_village2." ".$username;
			}else{
				$vname = $username." ".new_village2;
			}

		}

		$coo=$this->getWInfo($wid);

		$p=array('vname'=>$vname);

		$q = "INSERT into vdata (wref, owner, name, capital, pop, cp, celebration, wood, clay, iron, maxstore, crop, maxcrop, lastupdate, created,vx,vy,vtype) values ('".$wid."', '".$uid."', :vname, '".$capital."', '".$pop."', 1, 0, 750, 750, 750, ".STORAGE_BASE.", 750, ".STORAGE_BASE.", '".$time."', '".$time."','".$coo['x']."','".$coo['y']."','".$coo['fieldtype']."')";

		$this->query($q,$p);

	}



    function count_files($dir){

        $c=0; // количестinо файлоin. Считаем с нуля

        $d=dir($dir); //

        while($str=$d->read()){

            if($str[0]!='.'){

                 $c++;

            };

        }

        $d->close(); // закрыinаем директорию

        return $c;

    }

	function addResourceFields($vid, $type) {

		$p=array('V'=>$vid);

		switch($type) {

			case 1:

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values(:V,4,4,1,4,4,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";

				break;

			case 2:

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values(:V,3,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";

				break;

			case 3:

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values(:V,1,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";

				break;

			case 4:

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values(:V,1,4,1,2,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";

				break;

			case 5:

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values(:V,1,4,1,3,1,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";

				break;

			case 6:

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values(:V,4,4,1,3,4,4,4,4,4,4,4,4,4,4,4,2,4,4,1,15)";

				break;

			case 7:

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values(:V,1,4,4,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";

				break;

			case 8:

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values(:V,3,4,4,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";

				break;

			case 9:

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values(:V,3,4,4,1,1,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";

				break;

			case 10:

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values(:V,3,4,1,2,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";

				break;

			case 11:

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values(:V,3,1,1,3,1,4,4,3,3,2,2,3,1,4,4,2,4,4,1,15)";

				break;

			case 12:

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values(:V,1,4,1,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";

				break;

					case 33:                                                                                                                                                                                                           //                                      1  2 3   4 5   6  7  8 9  10 11 12 13 14 15 16 17 18

				$q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t,f1,f2,f3,f4,f5,f6,f7,f8,f9,f10,f11,f12,f13,f14,f15,f16,f17,f18,f19t,f20t,f19,f20,f21t,f22t,f21,f22,f23t,f23,f24t,f24,f39t,f39,f25t,f25,f27t,f27) values(:V,1,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2,20,15,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,10,11,20,20,10,11,20,20,19,20,20,20,16,20,21,20,26,20)";

				break;

		}

		$this->query($q,$p);

	}

	function isVillageOases($wref) {

		$p=array('W'=>$wref);

		$q = "SELECT oasistype FROM wdata where id = :W";

        return $this->single($q, $p);

	}

    function isVillageExist($wref) {

        $p=array('W'=>$wref);

        $q = "SELECT oasistype,fieldtype,occupied FROM wdata where id = :W";

        $ex=$this->row($q, $p);

        if($ex['oasistype']>0 || $ex['fieldtype'] && $ex['occupied']==1){

        return true;

        }else{

           return false;

        }

    }



	public function VillageOasisCount($vref) {

		$p=array('V'=>$vref);

		$q = "SELECT count(*) as sum FROM `odata` WHERE conqured=:V";

        return $this->single($q, $p);

	}





	public function countOasisTroops($vref){

		$p=array('V'=>$vref);

		$troops_o=0;

        $o_unit=$this->row("SELECT * FROM units where `vref`=:V",$p);



		for ($i=1;$i<11;$i++)

		{

			$troops_o+=$o_unit[$i];

		}





		$o_unit2=$this->query("SELECT * FROM enforcement where `vref`=:V",$p);

		foreach ($o_unit2 as $o_unit1)

		{

			for ($i=1;$i<=11;$i++)

			{

				$troops_o+=$o_unit1[$i];

			}

		}

		return $troops_o;

	}













	public function conquerOasis($vref,$wref,$uid) {

		$p=array('V'=>$vref,

        'U'=>$uid,

        'W'=>$wref);

		$q = "UPDATE `odata` SET conqured=:V,loyalty=100,lastupdated='".time()."',owner=:U WHERE wref=:W";

		$this->query($q,$p);

	}



	function modifyOasisLoyalty($wref,$loyality) {

		$p=array('W'=>$wref,

        'L'=>$loyality);

    $q = "UPDATE `odata` SET loyalty=:L WHERE wref=:W";

	$this->query($q,$p);

    }









	function removeOases($wref) {

		$p=array('W'=>$wref);

		$q = "UPDATE odata SET conqured = 0, owner = 4 WHERE wref =:W";

		$this->query($q,$p);

	}



        	function sortOasis($oasisinfo) {

		$crop = $clay = $wood = $iron = 0;



			foreach ($oasisinfo as $oasis) {

			switch($oasis['type']) {

					case 1:

                        $wood += 1;

                        break;

					case 2:

					$wood += 2;

					break;

					case 3:

					$wood += 1;

					$crop += 1;

					break;

					case 4:

                        $clay += 1;

                        break;

					case 5:

					$clay += 2;

					break;

					case 6:

					$clay += 1;

					$crop += 1;

					break;

					case 7:

                        $iron += 1;

                        break;

					case 8:

					$iron += 2;

					break;

					case 9:

					$iron += 1;

					$crop += 1;

					break;

					case 10:

					case 11:

					$crop += 1;

					break;

					case 12:

					$crop += 2;

					break;

				}

			}



		return array($wood,$clay,$iron,$crop);

	}



	function getVillageType($wref) {

		$p=array('W'=>$wref);

		$q = "SELECT fieldtype FROM wdata where id = :W";

        return $this->single($q, $p);

	}



 function getDistance($coorx1, $coory1, $coorx2, $coory2) {

    $max = 2 * WORLD_MAX + 1;

    $x1 = intval($coorx1);

    $y1 = intval($coory1);

    $x2 = intval($coorx2);

    $y2 = intval($coory2);

    $distanceX = min(abs($x2 - $x1), abs($max - abs($x2 - $x1)));

    $distanceY = min(abs($y2 - $y1), abs($max - abs($y2 - $y1)));

    $dist = sqrt(pow($distanceX, 2) + pow($distanceY, 2));

    return round($dist, 1);

}



		function getVillageState($wref) {



		$q = "SELECT oasistype,occupied FROM wdata where id = :W";

		$p=array('W'=>$wref);

		$dbarray = $this->row($q,$p);

		if($dbarray['occupied'] != 0 || $dbarray['oasistype'] != 0) {

			return true;

		} else {

			return false;

		}

	}



    function checkviloas($wref) {

        $p=array('W'=>$wref);

        $q = "SELECT

        IF(v.owner IS NULL, o.owner,v.owner) as owner,w.x,w.y, w.oasistype FROM ((

        wdata as w

        LEFT JOIN vdata as v ON v.wref = w.id)

        LEFT JOIN odata as o ON o.wref = w.id)

        WHERE w.id = :W";

        return $this->row($q,$p);

    }

    function checkviloas2($wref) {

        $p=array('W'=>$wref);

        $q = "SELECT

        o.owner,u.alliance,o.type FROM (

        odata as o

        LEFT JOIN users as u ON u.id = o.owner)

        WHERE o.wref = :W";

        return $this->row($q,$p);

    }



	function getProfileVillages($uid=0) {

        if($uid){

		$p=array('U'=>$uid);

		$q = "SELECT capital,wref,name,pop,created,vx,vy from vdata where owner = :U order by pop desc";

		return $this->query($q,$p);

        }

        return false;

	}







			function getVilKol($uid) {

		$p=array('U'=>$uid);

		$q = "SELECT wref from vdata where owner = :U";

	    $result = $this->query($q,$p);

		return count($result);

	}





	function getProfileMedal($uid) {

        $p=array('U'=>$uid);

		$q = "SELECT id,categorie,plaats,week,img,points from medal where userid = :U and allycheck = 0 order by id desc";

		return $this->query($q,$p);



    }



	function getProfileMedalAlly($uid) {

        $p=array('U'=>$uid);

		$q = "SELECT id,categorie,plaats,week,img,points from medal where `userid` = :U and allycheck = 1 order by id desc";

        return $this->query($q,$p);

    }





	function getVillageID($uid) {

        $p=array('U'=>$uid);

		$q = "SELECT wref FROM vdata WHERE owner = :U";

        return $this->single($q, $p);

	}





	function getVillagesID($uid) {

        $p=array('U'=>$uid);

		$q = "SELECT wref from vdata where owner = :U order by capital DESC,pop DESC";

		$array = $this->query($q,$p);

		$newarray = array();

		for($i = 0; $i < count($array); $i++) {

			array_push($newarray, $array[$i]['wref']);

		}

		return $newarray;

	}



	function getVillID2($uid) {

        $p=array('U'=>$uid);

		$q = "SELECT wref,name,vx,vy from vdata where owner = :U ORDER BY name asc";

        $array = $this->query($q,$p);

		$newarray = $newname = array();

		for($i = 0; $i < count($array); $i++) {

			array_push($newarray, $array[$i]['wref']);

            array_push($newname, $array[$i]);

		}

		return array($newarray,$newname);

	}

    function getVillID($uid) {

        $p=array('U'=>$uid);

        $q = "SELECT wref from vdata where `owner` = :U";

        $array = $this->query($q,$p);

        $newarray = array();

        for($i = 0; $i < count($array); $i++) {

            array_push($newarray, $array[$i]['wref']);

        }

        return $newarray;

    }



	function getVillage($vid) {

        $p=array('V'=>$vid);

		$q = "SELECT * FROM vdata where wref = :V";

        return $this->row($q,$p);



	}

    function getVillagedorf31($vid) {

        if($vid){

            $p=array('V'=>$vid);

            $q = "SELECT name,capital FROM vdata where wref = :V";

            return $this->row($q,$p);

        }

        return false;

    }

    function getVillagedorf34($vid) {

        if($vid){

            //

            $p=array('V'=>$vid);

            $q = "SELECT cp,exp1,exp2,exp3,name,celebration FROM vdata where wref = :V";

            return $this->row($q,$p);

        }

        return false;

    }



	public function getVillageBattleData($vid) {

        $p=array('V'=>$vid);

		$q = "SELECT u.id,u.tribe,v.capital,f.f40 AS wall FROM users u,fdata f,vdata v WHERE u.id=v.owner AND f.vref=v.wref AND v.wref=:V";

        return $this->row($q,$p);

	}





	public function getPopulation($uid) {

        $uid=$this->FilterIntValue($uid);

        $p=array('U'=>$uid);

		$q = "SELECT sum(pop) as sum FROM vdata WHERE owner=:U";

        return $this->single($q, $p);

	}



	function getPop($tid,$level) {

		$name = "bid".$tid;

		global $$name;

		$dataarray = $$name;

		$pop = $dataarray[($level+1)]['pop'];

		$cp = $dataarray[($level+1)]['cp'];

		return array($pop,$cp);

	}





	function getMInfo($id) {

		$q = "SELECT * FROM wdata left JOIN vdata ON vdata.wref = wdata.id where wdata.id = :id";

		$p=array('id'=>$id);

        return $this->row($q,$p);

	}

    function getMInfo2($id) {

        $p=array('I'=>$id);

        $q = "SELECT x,y FROM((

        wdata as w

        LEFT JOIN vdata ON vdata.wref = wdata.id)

         where wdata.id = :I";



        return $this->row($q,$p);

    }

		function getWInfo($id) {

            $p=array('I'=>$id);

		$q = "SELECT * FROM wdata where id = :I";

            return $this->row($q,$p);

	}

		function getMInfoEnforce($id) {

            $p=array('I'=>$id);

		$q = "SELECT owner,wref FROM vdata where wref = :I";

            return $this->row($q,$p);

	}



	function getOMInfo($id) {

        $p=array('I'=>$id);

		$q = "SELECT * FROM wdata left JOIN odata ON odata.wref = wdata.id where wdata.id = :I";

        return $this->row($q,$p);

	}



	function getOasis($vid) {

        $p=array('V'=>$vid);

        $q = "SELECT * FROM odata where conqured = :V";

		return $this->query($q,$p);

	}



	function getOasisInfo($wid) {

		$p=array('W'=>$wid);

		$q = "SELECT * FROM odata where wref = :W";

        return $this->row($q,$p);

	}



	function getVillageField($ref=0, $field) {



        if($ref){

            $p=array('R'=>$ref);

		$q = "SELECT ".$field." FROM vdata where wref = :R";

            return $this->single($q, $p);

        }

    return false;

	}



	function getOasisField($ref, $field) {

        $p=array('R'=>$ref);

		$q = "SELECT ".$field." FROM odata where wref = :R";

        return $this->single($q, $p);

	}





		function getResOasisField($ref) {

            $p=array('R'=>$ref);

		$q = "SELECT wood,clay,iron,crop FROM odata where wref = :R" ;

            return $this->row($q,$p);

	}



	function setVillageField($ref, $field, $value) {

        $p=array('R'=>$ref,

        'V'=>$value);

		$q = "UPDATE vdata set ".$field." = :V where wref = :R";

		$this->query($q,$p);

	}

    function getcapital($uid){

        $p=array('U'=>$uid);

        $q='SELECT wref FROM `vdata` WHERE `owner` = :U AND `capital` = 1';

        return $this->row($q,$p);

    	}

	function setVillageLevel($ref, $field, $value) {

        $p=array('R'=>$ref,

            'V'=>$value);

		$q = "UPDATE fdata set `".$field."` = :V where vref = :R";

		$this->query($q,$p);

	}

		function setVillageLevelBoth($ref, $field) {

            $p=array('R'=>$ref);

		$q = "UPDATE fdata set f" . $field . " = '0' , f" . $field . "t = '0'  where vref = :R";

		$this->query($q,$p);

	}



	function getResourceLevel($vid) {

        $p=array('V'=>$vid);

        $q = "SELECT * from fdata where vref = :V";

        return $this->row($q,$p);

	}

 function checkArtefactsEffects($uid,$vref,$type){

  global $artefactinfo;

      $allsamearts=array();



      if($type==11){

          $p=array('T'=>$type,

              'U'=>$uid);

          $q = "SELECT size from artefacts where owner=:U and type=:T and activated=1";}else{

          $p=array('T'=>$type,

              'U'=>$uid,

              'V'=>$vref);

 $q = "SELECT size from artefacts where (`vref`=:V or (owner=:U and size>1)) and type=:T and activated=1";}

 $getartefacts=$this->query($q,$p);

 if(count($getartefacts)>0){

     if($type==11){return count($getartefacts);}

 foreach($getartefacts as $myart){



    $allsamearts[]+=$artefactinfo[$type][$myart['size']]['value'];

 }

  }

     if($type!=5){

$artvalue=(empty($allsamearts))?$artefactinfo[$type]['default']:(max($allsamearts));

     }else{

         $artvalue=(empty($allsamearts))?$artefactinfo[$type]['default']:(min($allsamearts));

     }

 return $artvalue;





 }

function checkAllArtefactsEffects($uid,$vref){

  global $artefactinfo;

      $allsamearts= $artvalue = array();

    $p=array('V'=>$vref,

    'U'=>$uid);

 $q = "SELECT size,type from artefacts where (`vref`=:V or (`owner`=:U and `size`>'1')) and `activated`='1'";

 $getartefacts=$this->query($q,$p);

 if(count($getartefacts)>0){

 foreach($getartefacts as $myart){

    $allsamearts[$myart['type']][]+=$artefactinfo[$myart['type']][$myart['size']]['value'];

 }

}



 for($i=1;$i<=6;$i++){

if($i!=5){

$artvalue[$i]=(!isset($allsamearts[$i])  or count($allsamearts[$i])==0)?$artefactinfo[$i]['default']:((count($allsamearts[$i])==1)?($allsamearts[$i][0]):(max($allsamearts[$i])));

}else{

    $artvalue[$i]=(!isset($allsamearts[$i])  or count($allsamearts[$i])==0)?$artefactinfo[$i]['default']:((count($allsamearts[$i])==1)?($allsamearts[$i][0]):(min($allsamearts[$i])));

}



}



 return $artvalue;

 }

    function trainingComplete($vref) {

        $time = time();

        $trainlist = $this->getTrainingList($vref); // берем список тренироinок для опр.деры

        if(count($trainlist) > 0){ //если есть че строить..

            foreach($trainlist as $train){ //что б можно было работать с несколькими массиinами если строится более 1 пачки

                if(!MOMENT_TRAIN){

                $timepast = $train['lastupdate'] - $time; //а это типо прошла хотя б секунда с прошлой постройки( т.е. -1..-2 и т.д. будет результ)

                $timepast2 = $time - $train['lastupdate']; //ну эта хуйня короче считает сколько сек прошло с момента последней постройки юнитоin



                if($timepast <= 0 && $train['amt'] > 0 && $timepast2 >= $train['eachtime']) { //услоinия короч

                    $trained = 0; //тренироinано in итоге

                    $avaibleunits=floor($timepast2/$train['eachtime']); //сколько юнитоin помещается in заднице у пэрис хилтон,шучу,не у пэрис хилтон

                    $trained += $avaibleunits; //добаinляем тренироinаных

                    if($trained >= $train['amt']){ //если тренироinаных больше чем тренируется-хinатит это терпеть,затычка in дейстinии

                        $trained = $train['amt'];} //натренироinано-тренироinаным

                    $unit=$train['unit']; //юнит раinен типу юнита типа

                    if($unit!=99){

					if($unit>120 && $unit<=130){$unit=$unit-120;} //
					if($unit>110 && $unit<=120){$unit=$unit-110;} //
					if($unit>100 && $unit<=110){$unit=$unit-100;} //
					if($unit>90 && $unit<=100){$unit=$unit-90;} //
					if($unit>80 && $unit<=90){$unit=$unit-80;} //
					if($unit>70 && $unit<=80){$unit=$unit-70;} //
					if($unit>60 && $unit<=70){$unit=$unit-60;} //
					if($unit>50 && $unit<=60){$unit=$unit-50;} //
                    if($unit>20 && $unit<=30){$unit=$unit-20;}//если это галлы то обрезаем на 20см
                    if($unit>10 && $unit<=20){$unit=$unit-10;}//если это галлы то обрезаем на 10см(а рим не согласен на обрезания *печальный еinрей*

                    }else{$unit=99;}

                    $this->modifyUnit($train['vref'],array($unit),array($trained),1); //добаinляем юнитоin in деру

                    $this->updateTraining($train['id'],$trained,round($trained*$train['eachtime']));

                }

                }else{

                    $trained = $train['amt']; //натренироinано-тренироinаным

                    $unit=$train['unit']; //юнит раinен типу юнита типа

                    if($unit!=99){
					
					if($unit>60 && $unit<=70){$unit=$unit-60;}
					
                    if($unit>50 && $unit<=60){$unit=$unit-50;}
                    
					if($unit>20 && $unit<=30){$unit=$unit-20;}//если это галлы то обрезаем на 20см

                    if($unit>10 && $unit<=20){$unit=$unit-10;}//если это галлы то обрезаем на 10см(а рим не согласен на обрезания *печальный еinрей*

                    }else{$unit=99;}

                    $this->modifyUnit($train['vref'],array($unit),array($trained),1); //добаinляем юнитоin in деру

                    $this->updateTraining($train['id'],$trained,round($trained*$train['eachtime']));

                }

                if($train['amt']==0){$this->deletetraining($train['id']);}

            }//скоро копирайты

        }//строчкой ниже копирайты

    }//inоооот..by Brainiac короче

    function deletetraining($id){

        $q = "DELETE FROM training where id = :I";

        $p=array('I'=>$id);

        $this->query($q,$p);

    }

     function insertQueue($jobID, $type, $start_time, $finish_time, $if1 = 0)

    {



        $sql = "INSERT INTO queue (jobID,type,start,finish,status,if1) VALUES ('" . $jobID . "','" . $type . "','" . $start_time . "', '" . $finish_time . "',0,'" . $if1 . "')";

        $this->query($sql);

        return true;

    }





     function DeleteQueue($sq)

    {



        $sql = "DELETE FROM `queue` WHERE " . $sq;

        $this->query($sql);

    }

    function UpdateQueue($if1,$type)

    {



        $sql = "UPDATE queue SET `finish`='0'  WHERE `if1`='".$if1."' and `type`='".$type."'";

        $this->query($sql);

    }



	function getPalevo($type,$mode,$id) {



		if($mode==0){

            $p=array('T'=>$type);

			$q = "SELECT id,uid,infa from palevo where id != 0 and type=:T ORDER BY id ASC";

		}else{

            $p=array('T'=>$type,'U'=>$id);

			$q = "SELECT id,uid,infa from palevo where id != 0 and type=:T and uid=:U ORDER BY id ASC";

		}

		$dbarray = $this->query($q,$p);

		return $dbarray;

		}





		function getCoor($wref=0) {



            if($wref){

                $p=array('W'=>$wref);

		$q = "SELECT x,y FROM wdata where id = :W";

                return $this->row($q,$p);}

    return false;

		}

		function getCoortype($wref) {

            $p=array('W'=>$wref);

            $q = "SELECT x,y,fieldtype FROM wdata where id = :W";

            return $this->row($q,$p);

		}





        function checkpalaceexist($vill){

        foreach($vill as $vivil){

	    $strutture= $this->getResourceLevel($vivil);

	    if(in_array(26,$strutture)){ return 1;

	    }

	    }

        return 0;

	    }







		function checkVilExist($wref) {

            $p=array('W'=>$wref);

            $q = "SELECT wref FROM vdata where wref = :W";

		$result = $this->query($q,$p);

		if(count($result)) {

		return true;

		} else {

		return false;

		}

		}



		function checkOasisExist($wref) {

            $p=array('W'=>$wref);

            $q = "SELECT wref FROM odata where wref = :W";

		$result = $this->query($q,$p);

		if(count($result)) {

		return true;

		} else {

		return false;

		}

		}

	function getAllProd($res,$fdataarr,$plus,$ocounter) {
		global $bid45;

		$base = $zavod = $zavod2 = $summa = 0;

		$holder = array();

		if($res==1){$firstbuild=1;$secondbuild=5;}

		if($res==2){$firstbuild=2;$secondbuild=6;}

		if($res==3){$firstbuild=3;$secondbuild=7;}

		if($res==4){$firstbuild=4;$secondbuild=8;$thirdbuild=9;}

		global ${'bid'.$firstbuild},${'bid'.$secondbuild},$bid9;

			if($res==4){

		for($i=1;$i<=38;$i++) {

			if($fdataarr['f'.$i.'t'] == $firstbuild) {

				array_push($holder,'f'.$i);

			}

			if($fdataarr['f'.$i.'t'] == $secondbuild) {

				$zavod = $fdataarr['f'.$i];

			}

			if($fdataarr['f'.$i.'t'] == $thirdbuild) {

				$zavod2 = $fdataarr['f'.$i];

			}

		}

		}else{

			for($i=1;$i<=38;$i++) {

			if($fdataarr['f'.$i.'t'] == $firstbuild) {

				array_push($holder,'f'.$i);

			}

			if($fdataarr['f'.$i.'t'] == $secondbuild) {

				$zavod = $fdataarr['f'.$i];

			}

		}

		}for($i=0;$i<=count($holder)-1;$i++) { $base+= ${'bid'.$firstbuild}[$fdataarr[$holder[$i]]]['prod']; }

		// iRedux -> edit this code later
		// For pharos new building
		if($ocounter[$res-1]){
			if($this->getTypeLevel(45, $_SESSION['wid'])){
				$pProduction = ($base + $base * 0.25 * $ocounter[$res-1]) + (($bid45[$this->getTypeLevel(45, $_SESSION['wid'])]['attri'] /100) * ($base + $base * 0.25 * $ocounter[$res-1]));
			}else{
				$pProduction = $base + $base * 0.25 * $ocounter[$res-1];
			}
			//if ($fdata['f' . $i . 't'] == 39){$crop += $bid39[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
		}else{
			$pProduction = $base + $base * 0.25 * $ocounter[$res-1];
		}

		$resurse = $pProduction;
		//$resurse = $base + $base * 0.25 * $ocounter[$res-1];

		if($res==4){

		if($zavod >= 1 || $zavod2 >= 1) {

            if($zavod){$summa+=${'bid'.$secondbuild}[$zavod]['attri'];}

            if($zavod2){$summa+= $bid9[$zavod2]['attri'];}



			$resurse += $base /100 * $summa;

			}

		}else{

		if($zavod >= 1 ) {

			$resurse += $base /100 * (${'bid'.$secondbuild}[$zavod]['attri']);

		}

		}



		if($plus > time()) {

			$resurse *= 1.25;

		}

		$resurse *= SPEED;

		return round($resurse);

	}



        function DelVillageGlobal($vref){

            $p=array('V'=> $vref);

        	$this->clearExpansionSlot($vref);

						$q = "DELETE FROM abdata where vref = :V";

						$this->query($q,$p);

						$q = "DELETE FROM bdata where wid = :V";

						$this->query($q,$p);

						$q = "DELETE FROM enforcement where vref = :V";

						$this->query($q,$p);

						$q = "DELETE FROM enforcement where `from` = :V";

						$this->query($q,$p);

						$q = "DELETE FROM fdata where vref = :V";

						$this->query($q,$p);

						$q = "DELETE FROM market where vref = :V";

						$this->query($q,$p);

						$q = "DELETE FROM research where vref = :V";

						$this->query($q,$p);

						$q = "DELETE FROM tdata where vref = :V";

						$this->query($q,$p);

						$q = "DELETE FROM training where vref =:V";

						$this->query($q,$p);

						$q = "DELETE FROM units where vref =:V";

						$this->query($q,$p);

						$q = "DELETE FROM vdata where wref = :V";

						$this->query($q,$p);

						$q = "DELETE FROM movement where sort_type = 3 and `from` = :V";

						$this->query($q,$p);

            $q = "DELETE FROM movement where sort_type = 4 and `to` = :V";

            $this->query($q,$p);

						$q = "UPDATE odata SET `conqured` = '0',`owner` = '2'  WHERE conqured = :V";

						$this->query($q,$p);

						$q = "UPDATE wdata set occupied = 0 where id = :V";

						$this->query($q,$p);

            $q = "SELECT wref FROM odata where `conqured` = :V";

            $odata=$this->query($q,$p);

            foreach($odata as $o){

            $q = "DELETE FROM movement where sort_type = 3 and `from` = '".$o['wref']."'";

            $this->query($q);

            }

						}



			function getAllianceName($id) {



				if($id!=0){

			$q = "SELECT tag from alidata where id = :id";

			$p=array('id'=>$id);

                    return $this->single($q, $p);}

                return '-';

			}



			function getAlliancePermission($ref, $field, $mode) {

                $p=array('R'=>$ref);

                if(!$mode) {

			$q = "SELECT ".$field." FROM ali_permission where uid = :R";

			} else {

			$q = "SELECT ".$field." FROM ali_permission where username = :R";

			}

                return $this->single($q, $p);

			}



			function getAlliance($id) {



			$q = "SELECT * from alidata where id = :id";

			$p=array('id'=>$id);

                return $this->row($q,$p);

			}





			function setAlliName($aid, $name, $tag) {

                $p=array('A'=>$aid,'T'=>$tag,'N'=>$name);

                $q = "UPDATE alidata set name = :N, tag = :T where id = :A";

			$this->query($q,$p);

			}





			function aExist($ref, $type,$aid=0) {



			if($aid){

                $p=array('A'=>$aid,'R'=>$ref);

			$q = "SELECT ".$type." FROM alidata where ".$type." = :R and id <>:A";

			}else{

                $p=array('R'=>$ref);

			$q = "SELECT ".$type." FROM alidata where ".$type." = :R";

			}

			$result = $this->query($q,$p);

			if(count($result)) {

			return true;

			} else {

			return false;

			}

			}



              function  GetAllyNoticeforAlly($limit,$aid=0){ //shitty

                  $p=array('A'=>$aid);

                $q="SELECT * FROM ndata WHERE ally = :A AND ".$limit." ORDER BY time DESC LIMIT 20";

                  if($aid>0){

                return $this->query($q,$p);

              }

                  return false;

                }



			function modifyPoints($aid=0, $points, $amt=0) {



                if($amt && $aid){

                    $p=array('A'=>$aid);

			$q = "UPDATE users set ".$points." = ".$points." + ".$amt." where id = :A";

			$this->query($q,$p);

                }

			}

    function modifyPointsatt($uid,$amt) {



        if($amt && $uid){

            $p=array('U'=>$uid);

            $q = "UPDATE users set ap = ap + ".$amt.",apall = apall + ".$amt." where id = :U";

            $this->query($q,$p);

        }

    }

    function modifyPointsdef($uid,$amt) {
        if($amt && $uid){

            $p=array('U'=>$uid);

            $q = "UPDATE users set dp = dp + ".$amt.",dpall = dpall + ".$amt." where id = :U";

            $this->query($q,$p);

        }

    }



			function modifyPointsAlly($aid=0, $points, $amt=0) {

                $p=array('A'=>$aid);

								if($aid>0 && $amt){

			$q = "UPDATE alidata set ".$points." = ".$points." + ".$amt." where id = :A";

			$this->query($q,$p);

			}

			}

    function modifyPointsAllyd($aid=0, $amt) {

        $p=array('A'=>$aid);

        if($aid>0 && $amt){

            $q = "UPDATE alidata set Adp = Adp + ".$amt.",dp = dp + ".$amt." where id = :A";

            $this->query($q,$p);

        }

    }

    function modifyPointsAllya($aid=0, $amt) {



        if($aid>0 && $amt){

            $p=array('A'=>$aid);

            $q = "UPDATE alidata set Aap = Aap + ".$amt.",ap = ap + ".$amt." where id = :A";

            $this->query($q,$p);

        }

    }







			function createAlliance($tag, $name, $uid, $max) {

                $p=array('N'=>$name,'T'=>$tag,'U'=>$uid);

			$q = "INSERT into alidata values (0,:N,:T,:U,'','',".$max.",'','','','','','','','')";

			$this->query($q,$p);

			return $this->get_last_id();

			}





			function insertAlliNotice($aid, $notice) {



			$time = time();

                $p=array('A'=>$aid,'N'=>$notice);

			$q = "INSERT into ali_log values (0,:A,:N,".$time.")";

			$this->query($q,$p);

			}



			/*****************************************

			Functiondelete alliance if empty

			References:

			*****************************************/

			function deleteAlliance($aid) {

                $p=array('A'=>$aid);

			$result = $this->query("SELECT * FROM users where alliance = :A",$p);

			$num_rows = count($result);

			if($num_rows == 0) {

			$q = "DELETE FROM alidata WHERE id = :A";

			$this->query($q,$p);

			}

			}



			function readAlliNotice($aid) {

                $p=array('A'=>$aid);

			$q = "SELECT * from ali_log where aid = :A ORDER BY date DESC LIMIT 20";

			return $this->query($q,$p);

			}



			/*****************************************

			 Functioncreate alliance permissions

			References: ID, notice, description

			*****************************************/

			function createAlliPermissions($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7, $opt8) {

                $p=array('rank'=>$rank,'o1'=>$opt1,'o2'=>$opt2,'o3'=>$opt3,'o4'=>$opt4,'o5'=>$opt5,'o6'=>$opt6,'o7'=>$opt7,'o8'=>$opt8,'A'=>$aid,'U'=>$uid);

				$q = "INSERT into ali_permission values(0,:U,:A,:rank,:o1,:o2,:o3,:o4,:o5,:o6,:o7,:o8)";

				$this->query($q,$p);

			}



			/*****************************************

			 Function  update alliance permissions

			References:

			*****************************************/

		function deleteAlliPermissions($uid) {

            $p=array('U'=> $uid);

				$q = "DELETE from ali_permission where uid = :U";

				$this->query($q,$p);

			}

			/*****************************************

			 Function  update alliance permissions

			References:

			*****************************************/

			function updateAlliPermissions($uid, $aid, $rank, $o1, $o2, $o3, $o4, $o5, $o6, $o7) {



				$q = "UPDATE ali_permission SET rank = :rank, opt1 = :o1, opt2 = :o2, opt3 = :o3, opt4 = :o4, opt5 = :o5, opt6 = :o6, opt7 = :o7 where `uid` = :U && alliance =:A";

				$p=array('rank'=>$rank,'o1'=>$o1,'o2'=>$o2,'o3'=>$o3,'o4'=>$o4,'o5'=>$o5,'o6'=>$o6,'o7'=>$o7,'A'=>$aid,'U'=>$uid);

				$this->query($q,$p);

			}



			/*****************************************

			 Function to read alliance permissions

			References: ID, notice, description

			*****************************************/

			function getAlliPermissions($uid, $aid) {

                $p=array('U'=>$uid,'A'=>$aid);

				$q = "SELECT * FROM ali_permission where uid = :U and alliance = :A";

				return $this->row($q,$p);



			}



			/*****************************************

			 Function to update an alliance description and notice

			References: ID, notice, description

			*****************************************/

						function submitAlliProfile($aid, $notice, $desc) {



				$q = "UPDATE alidata SET `notice` = :N, `desc` = :D where `id` = :A";

				$p=array('A'=>$aid,'N'=>$notice,'D'=>$desc);

				$this->query($q,$p);

			}



			function diplomacyInviteAdd($alli1, $alli2, $type) {

                $p=array('A'=>$alli1,'A1'=>$alli2,'T'=>(int)intval($type));

				$q = "INSERT INTO diplomacy (alli1,alli2,type,accepted) VALUES (:A,:A1,:T,0)";

				$this->query($q,$p);

			}



			function diplomacyOwnOffers($sea) {

                $p=array('S'=>$sea);

				$q = "SELECT * FROM diplomacy WHERE alli1 = :S AND accepted = 0";

				return $this->query($q,$p);

			}



			function getAllianceID($name) {

                $p=array('N'=>$name);

				$q = "SELECT id FROM alidata WHERE `tag` =:N";

                return $this->single($q, $p);

			}



			function getDiplomacy($aid) {

                $p=array('A'=>$aid);

				$q = "SELECT * FROM diplomacy WHERE id = :A";

				return $this->query($q,$p);

			}



			function diplomacyCancelOffer($id) {



				$q = "DELETE FROM diplomacy WHERE id = :I";

                $p=array('I'=>$id);

                $this->query($q,$p);

			}



			function diplomacyInviteAccept($id, $sea) {

                $p=array('I'=>$id,'S'=>$sea);

				$q = "UPDATE diplomacy SET accepted = 1 WHERE `id` = :I AND `alli2` = :S";

				$this->query($q,$p);

			}



			function diplomacyInviteDenied($id, $sea) {

                $p=array('S'=>$sea,'I'=>$id);

				$q = "DELETE FROM diplomacy WHERE `id` = :I AND `alli2` = :S";

				$this->query($q,$p);

			}



			function diplomacyInviteCheck($sea) {

                $p=array('S'=>$sea);

			$q = "SELECT * FROM diplomacy WHERE alli2 = :S AND accepted = 0";

			return $this->query($q,$p);

			}

				function diplomacyInviteCheckFixed($sea,$oura) {

                    $p=array('S'=>$sea,'S1'=>$sea,'O'=>$oura,'O1'=>$oura);

				$q = "SELECT * FROM diplomacy WHERE (alli2 = :S and alli1=:O) or (alli1 = :S1 and alli2=:O1)";

				return $this->query($q,$p);

			    }



			function getAllianceDipProfile($aid, $type){



                $alliance=0;

                $p=array('A'=>$aid,'T'=>$type,'A1'=>$aid,'T1'=>$type);

				$q = "SELECT * FROM diplomacy WHERE alli1 = :A AND type = :T AND accepted = '1' OR alli2 = :A1 AND type = :T1 AND accepted = '1'";

				$array = $this->query($q,$p);

                $text='';

				foreach($array as $row){

					if($row['alli1'] == $aid){

						$alliance = $this->getAlliance($row['alli2']);

					}elseif($row['alli2'] == $aid){

						$alliance = $this->getAlliance($row['alli1']);

					}

					$text .= "";

					$text .= "<a href=allianz.php?aid=".$alliance['id'].">".$alliance['tag']."</a><br> ";

				}

				if(strlen($text) == 0){

					$text = "-<br>";

				}

				return $text;

			}



			function getAllianceWar($aid){

                $p=array('A'=>$aid,'A1'=>$aid);

				$q = "SELECT * FROM diplomacy WHERE alli1 = :A AND type = '3' OR alli2 = :A1 AND type = '3' AND accepted = '1'";

				$array = $this->query($q,$p);

                $text='';

				foreach($array as $row){

					if($row['alli1'] == $aid){

						$alliance = $this->getAlliance($row['alli2']);

					}elseif($row['alli2'] == $aid){

						$alliance = $this->getAlliance($row['alli1']);

					}

					$text .= "";

					$text .= "<a href=allianz.php?aid=".$alliance['id'].">".$alliance['tag']."</a><br> ";

				}

				if(strlen($text) == 0){

					$text = "-<br>";

				}

				return $text;

			}



									function getAlliDiS($myaid){

                                        $p=array('A'=>$myaid,'A1'=>$myaid);

				$q = "SELECT type,alli1,alli2 FROM diplomacy WHERE (alli1 = :A or alli2 = :A1) AND (type <3 AND accepted = '1'  or type = 3)";

				return $this->query($q,$p);

			}



			function getmovvill($mywid){

                $p=array('W'=>$mywid,'W1'=>$mywid);

				$q = "SELECT movement.from,movement.to,movement.sort_type,attacks.attack_type FROM movement, attacks where (movement.from = :W or movement.to = :W1) and movement.ref = attacks.id and movement.proc = 0";

				return $this->query($q,$p);

				}

    function getmovvill2($mywid){

        $p=array('W'=>$mywid,'W1'=>$mywid,'W2'=>$mywid);

        $q = "SELECT m.sort_type,a.attack_type, IF(m.from = :W,m.to,m.from) as vref FROM movement as m, attacks as a where (m.from = :W1 or m.to = :W2) and m.ref = a.id and m.proc = 0";



        return $this->query($q,$p);

    }





			function diplomacyExistingRelationships($sea) {

                $p=array('S'=>$sea);

				$q = "SELECT * FROM diplomacy WHERE alli2 = :S AND accepted = 1";

				return $this->query($q,$p);

			}



			function diplomacyExistingRelationships2($sea) {

                $p=array('S'=>$sea);

				$q = "SELECT * FROM diplomacy WHERE alli1 = :S AND accepted = 1";

				return $this->query($q,$p);

			}



			function diplomacyCancelExistingRelationship($id, $sea) {

                $p=array('I'=>$id,'I1'=>$id,'S'=>$sea,'S1'=>$sea);

				$q = "DELETE FROM diplomacy WHERE id = :I AND alli2 = :S OR id = :I1 AND alli1 = :S1";

				$this->query($q,$p);

			}



			function checkDiplomacyInviteAccept($aid, $type) {

                $p=array('A'=>$aid,'A1'=>$aid,'T'=>$type,'T1'=>$type);

				$q = "SELECT * FROM diplomacy WHERE alli1 = :A AND type = :T AND accepted = 1 OR alli2 = :A1 AND type = :T1 AND accepted = 1";

				$result = $this->query($q,$p);

				if($type == 3){

					return true;

				}else{

					if(count($result) < 4) {

						return true;

					} else {

						return false;

					}

				}

			}







			function getUserAlliance($id) {

                $p=array('I'=>$id);

				$q = "SELECT alidata.tag from users join alidata where users.alliance = alidata.id and users.id = :I";

				$tag = $this->single($q,$p);

				if($tag == "") {

					return "-";

				} else {

                    return $tag;

				}

			}



			function modifyResource($vid, $wood, $clay, $iron, $crop, $mode) {

                $p=array('V'=>$vid);

				$q="SELECT wood,clay,iron,crop,maxstore,maxcrop from vdata where wref = :V";

				$checkres= $this->row($q,$p);

                $shit=false;

                if(!$mode){

				$nwood=$checkres['wood']-$wood;

				$nclay=$checkres['clay']-$clay;

				$niron=$checkres['iron']-$iron;

				$ncrop=$checkres['crop']-$crop;

				if($nwood<0 or $nclay<0 or $niron<0 or $ncrop<0){$shit=true;}else{

				$dwood=($nwood<0)?0:$nwood;

				$dclay=($nclay<0)?0:$nclay;

				$diron=($niron<0)?0:$niron;

				$dcrop=($ncrop<0)?0:$ncrop;

				}

				}else{

				$nwood=$checkres['wood']+$wood;

				$nclay=$checkres['clay']+$clay;

				$niron=$checkres['iron']+$iron;

				$ncrop=$checkres['crop']+$crop;

				$dwood=($nwood>$checkres['maxstore'])?$checkres['maxstore']:$nwood;

				$dclay=($nclay>$checkres['maxstore'])?$checkres['maxstore']:$nclay;

				$diron=($niron>$checkres['maxstore'])?$checkres['maxstore']:$niron;

				$dcrop=($ncrop>$checkres['maxcrop'])?$checkres['maxcrop']:$ncrop;

				}

				if(!$shit){
					$positiveCrop = ( round($dcrop) >= 0 ) ? round($dcrop) : 0;
					$q = "UPDATE vdata set `wood` = '".round($dwood)."', `clay` = '".round($dclay)."', `iron` = '".round($diron)."', `crop` = '".round($dcrop)."' where `wref` = :V";

					$this->query($q,$p); return true;
				}
				else
				{
					return false;
				}

			}



			function modifyResourceReturn($vid, $wood, $clay, $iron, $crop) {

                $p=array('V'=>$vid);

				$q="SELECT wood,clay,iron,crop,maxstore,maxcrop from vdata where wref = :V";

				$checkres= $this->row($q,$p);

                $nwood=$checkres['wood']+$wood;

				$nclay=$checkres['clay']+$clay;

				$niron=$checkres['iron']+$iron;

				$ncrop=$checkres['crop']+$crop;

				$dwood=($nwood>$checkres['maxstore'])?$checkres['maxstore']:$nwood;

				$dclay=($nclay>$checkres['maxstore'])?$checkres['maxstore']:$nclay;

				$diron=($niron>$checkres['maxstore'])?$checkres['maxstore']:$niron;

				$dcrop=($ncrop>$checkres['maxcrop'])?$checkres['maxcrop']:$ncrop;

                //$dcrop=($ncrop<0)?0:$dcrop;



				$q = "UPDATE vdata set `wood` = '".round($dwood)."', `clay` = '".round($dclay)."', `iron` = '".round($diron)."', `crop` = '".round($dcrop)."' where `wref` = :V";

				$this->query($q,$p);



				return array($dwood,$dclay,$diron,$dcrop);

			}



			function modifyOasisResource($vid, $wood, $clay, $iron, $crop, $mode) {

                $p=array('V'=>$vid);

			$q="SELECT wood,clay,iron,crop,maxstore,maxcrop from odata where wref = :V";

				$checkres= $this->row($q,$p);

                if(!$mode){

				$nwood=$checkres['wood']-$wood;

				$nclay=$checkres['clay']-$clay;

				$niron=$checkres['iron']-$iron;

				$ncrop=$checkres['crop']-$crop;

				$dwood=($nwood<0)?0:$nwood;

				$dclay=($nclay<0)?0:$nclay;

				$diron=($niron<0)?0:$niron;

				$dcrop=($ncrop<0)?0:$ncrop;

				}else{

				$nwood=$checkres['wood']+$wood;

				$nclay=$checkres['clay']+$clay;

				$niron=$checkres['iron']+$iron;

				$ncrop=$checkres['crop']+$crop;

				$dwood=($nwood>$checkres['maxstore'])?$checkres['maxstore']:$nwood;

				$dclay=($nclay>$checkres['maxstore'])?$checkres['maxstore']:$nclay;

				$diron=($niron>$checkres['maxstore'])?$checkres['maxstore']:$niron;

				$dcrop=($ncrop>$checkres['maxcrop'])?$checkres['maxcrop']:$ncrop;

				}

				$q = "UPDATE odata set wood = ".$dwood.", clay = ".$dclay.", iron = ".$diron.", crop = ".$dcrop." where wref = :V";

				$this->query($q,$p);

			}

			function CheckbuildBeforeUpdate($tbid,$wid){



			$q = "SELECT id FROM bdata  WHERE `field` = '".$tbid."' and `wid`=:W";

                $p=array('W'=>$wid);

			$result=$this->query($q,$p);

			return count($result);

			}





			function UpdateBuildingCata($lvl,$tbid,$wid,$buildtype){

				global ${'bid'.$buildtype},$bid15;

				$time=round(${'bid'.$buildtype}[$lvl]['time']*($bid15[$this->getTypeLevel(15,$wid)]['attri']/100)  / SPEED);

                $p=array('W'=>$wid);

			$q = "UPDATE bdata set level = ".$lvl.",`timestamp`=".$time." WHERE `field` = '".$tbid."' and `wid`=:W";

			$this->query($q,$p);

			}



			function DeleteBuldingCata($tbid,$wid){

                $p=array('W'=>$wid);

			$q = "DELETE FROM bdata WHERE `field` = '".$tbid."' and `wid`=:W";

			$this->query($q,$p);

			}



			function getFieldLevel($vid, $field) {

                $p=array('V'=>$vid);

				$q = "SELECT `f".$field."` FROM fdata where `vref` = :V";

                return $this->single($q, $p);

			}



			function getFieldType($vid, $field) {

                $p=array('V'=>$vid);

				$q = "SELECT f" . $field . "t from fdata where vref = :V";

                return $this->single($q, $p);

			}

			function getFieldTypeLevel($vid, $field) {

                $p=array('V'=>$vid);

				$q = "SELECT f" . $field . "t as type,f".$field." as lvl from fdata where vref = :V";

                return $this->row($q,$p);

			}



			function getVSumField($uid, $field) {

                $p=array('U'=>$uid);

				$q = "SELECT sum(" . $field . ") as sum FROM vdata where owner = :U";

                return $this->single($q, $p);

			}



			function updateVillage($vid) {



				$time = time();

                $p=array('V'=>$vid);

				$q = "UPDATE vdata set lastupdate = ".$time." where wref = :V";

				$this->query($q,$p);

			}

			function updateOasis($vid) {



				$time = time();

                $p=array('V'=>$vid);

				$q = "UPDATE odata set lastupdated = ".$time." where wref = :V";

				$this->query($q,$p);

			}





		    function setVillageName($vid, $name)

    {



        $name = trim($name);

        if (!empty($name)) {

            $q = "UPDATE vdata set name = :N where wref = :V";

            $p = array('V' => $vid, 'N' => $name);

            $this->query($q, $p);

        }

    }



			function modifyPop($vid, $pop=0, $mode) {

                $p=array('V'=>$vid);

                if($pop){

				if(!$mode) {

					$q = "UPDATE vdata set pop = pop + ".$pop." where wref = :V";

				} else {

					$q = "UPDATE vdata set pop = pop - ".$pop." where wref = :V";

				}

				$this->query($q,$p);

            }

    return false;

			}



			function addCP($ref, $cp) {

                $p=array('R'=>$ref);

				$q = "UPDATE vdata set cp = cp + ".$cp." where wref = :R";

				$this->query($q,$p);

			}

						function addCPop($ref, $cp=0,$pop=0) {



                            if(empty($cp)){$cp=0;}

                            if(empty($pop)){$pop=0;}

                            $p=array('R'=>$ref);

				$q = "UPDATE vdata set cp = cp + ".$cp.", pop = pop + ".$pop." where wref = :R";

				$this->query($q,$p);

			}



			function addCel($ref, $cel, $type) {

                $p=array('C'=>$cel,'R'=>$ref,'T'=>$type);
				$q = "UPDATE vdata set `celebration` = :C, `type`= :T where `wref` = :R";
				$this->query($q,$p);


			}

			function getCel() {

				$q = "SELECT * FROM vdata where celebration < ".time()." AND celebration != 0";

				return $this->query($q);

			}



			function clearCel($ref) {

                $p=array('W'=>$ref);

				$q = "UPDATE vdata set celebration = 0, type = 0 where wref = :W";

				$this->query($q,$p);

			}

			function setCelCp($user, $cp) {

                $p=array('U'=>$user);

				$q = "UPDATE users set cp = cp + ".$cp." where id = :U";

				$this->query($q,$p);

			}



			function clearExpansionSlot($id) {

                $p=array('I'=>$id);



				for($i = 1; $i <= 3; $i++) {

					$q = "UPDATE vdata SET `exp".$i."`='0' WHERE `exp".$i."`=:I";

					$this->query($q,$p);

				}

			}



    function getInvitation($uid = 0)

    {

        $p = array('U' => $uid);

        $q = "SELECT * FROM ali_invite where uid = :U";

        return $this->query($q, $p);



    }



			function getInvitation2($uid, $aid) {

                $p=array('U'=>$uid,'A'=>$aid);

				$q = "SELECT * FROM ali_invite where uid = :U and alliance = :A";

				return $this->query($q,$p);

			}



			function getAliInvitations($aid) {

                $p=array('A'=>$aid);

				$q = "SELECT * FROM ali_invite where alliance = :A and accept = 0";

				return $this->query($q,$p);

			}



			function sendInvitation($uid, $alli) {

		$p=array('U'=>$uid,'A'=>$alli);

                $q = "INSERT INTO ali_invite values (0,:U,:A,0)";

				$this->query($q,$p);

			}



			function removeInvitation($id) {

                $p=array('I'=>$id);

				$q = "DELETE FROM ali_invite where id = :I";

				$this->query($q,$p);

			}



    function sendMessage($client, $owner, $topic, $message, $send, $alli, $player, $coor)

    {



        $q = "INSERT INTO mdata values (0,:cli,:ow,:top,:mes,0,:send,:time,0,0,:A,:pla,:coor)";

        $p = array('cli' => $client, 'ow' => $owner, 'top' => $topic, 'mes' => $message, 'send' => $send, 'time' => time(), 'A' => $alli, 'pla' => $player, 'coor' => $coor);

        $this->query($q, $p);

    }







			/***************************

			 Function to get messages

			Mode 1: Get inbox

			Mode 2: Get sent

			Mode 3: Get message

			Mode 4: Set viewed

			Mode 5: Remove message



			References: User ID/Message ID, Mode

			***************************/

		    function getMessage($id, $mode,$uid=0) {



        $p = array('id' => $id);



        switch ($mode) {

            case 1:

                $q = "SELECT * FROM mdata WHERE target = :id and send = 0  ORDER BY time DESC";

                break;

            case 2:

                $q = "SELECT * FROM mdata WHERE owner = :id ORDER BY time DESC";

                break;

            case 3:

                $q = "SELECT * FROM mdata where `id` = :id";

                break;

            case 4:

                if($uid){

                    $p=array('id'=>$id,'U'=>$uid);

                $q = "UPDATE mdata set viewed = 1 where `id` = :id AND target = :U";

                }

                break;

            case 5:

                $q = "UPDATE mdata set deltarget = 1,viewed = 1 where `id` = :id";

                break;



            case 7:

                $q = "UPDATE mdata set delowner = 1 where `id` = :id";

                break;

            case 8:

                $q = "UPDATE mdata set deltarget = 1,delowner = 1,viewed = 1 where `id` = :id";

                break;

            case 9:

                $q = "SELECT * FROM mdata WHERE target = :id and send = 0  and deltarget = 0 ORDER BY time DESC";

                break;

            case 10:

                $q = "SELECT * FROM mdata WHERE owner = :id and delowner = 0 ORDER BY time DESC";

                break;

            case 11:

                $q = "SELECT * FROM mdata WHERE `target` = :id and `viewed`='0' and `deltarget`='0'";

                break;

            case 12:

                $q = "SELECT count(*) as sum FROM mdata WHERE `target` = :id and `viewed`='0' and `deltarget`='0'";

                break;



        }

        if ($mode <= 3 || $mode > 8) {

            return $this->query($q, $p);

        } else {

            $this->query($q, $p);

        }

    }



			function getDelSent($uid) {

                $p=array('U'=> $uid);

				$q = "SELECT * FROM mdata WHERE owner = :U and delowner = 1 ORDER BY time DESC";

				return $this->query($q,$p);

			}



			function getDelInbox($uid) {

                $p=array('U'=> $uid);

				$q = "SELECT * FROM mdata WHERE target = :U and deltarget = 1 ORDER BY time DESC";

				return $this->query($q,$p);

			}







    function removeNotice($id)

    {



        $q = "UPDATE ndata set `del` = '1',`viewed` = '1' where `id` = :id";

        $p = array('id' => $id);

        $this->query($q, $p);

    }

			function buyPlus($plus,$cost,$id,$gold) {



				$donegold=$gold-$cost;

                $time=0;

				$realtime = time();

				if($gold>=$cost){

                    $p=array('I'=>$id);

					$row =  $this->row("SELECT `".$plus."` FROM users WHERE `id` = :I",$p);

					$tip=$row[$plus];

					if ($tip==0 or $tip<$realtime){

						$time=$realtime+PLUS_TIME;

					}

                    if($tip>$realtime){

						$time= $tip+PLUS_TIME;

					}

					$ip=$_SERVER['REMOTE_ADDR'];

					$infa="".$plus.",".$realtime.",".$cost.",".$ip."";

                    $p=array('I'=>$id);

						$q = "UPDATE users SET `".$plus."`='".$time."',`gold`='".$donegold."' where  `id` = :I";

						$this->addPalevo($id,$infa,3);

						$this->query($q,$p);





				}



			}

    function BuyClub($uid,$gold){

        if($gold>=250){

            $this->UpdateAchievU($uid,"`a5`=250");

            $p=array('U'=>$uid);

            $this->query("UPDATE `users` SET `goldclub`='1',`gold` = gold - 250 WHERE `id`=:U",$p);

            $realtime = time();

            $ip=$_SERVER['REMOTE_ADDR'];

            $costres=250;

            $infa="buyclub,".$realtime.",".$costres.",".$ip."";

            $this->addPalevo($uid,$infa,3);

        }

    }



			 function isWinner() {



			 	$ww=$this->query("SELECT vref FROM fdata WHERE `f99` = 100");

        $isThere=count($ww);

		if($isThere > 0)

		{

		header('Location: '.HOMEPAGE.'/winner.php');

		}

		}

    function Winnerkills() {



        $ww=$this->query("SELECT vref FROM fdata WHERE `f99` = 100");

        $isThere=count($ww);

        if($isThere > 0)

        {

            return true;

        }

        return false;

    }





			function buyCp($id) {

                $p=array('I'=>$id);



				$realtime = time();

				$ip=$_SERVER['REMOTE_ADDR'];

					$row = $this->row("SELECT * FROM users WHERE id  = :I",$p);

                    $cost=COSTCP;

					$usergold=$row['gold'];

					if($usergold>=$cost){

						$sumgold=$row['gold']-$cost;

						$sumcp=$row['cp']+HOWCP;

						$this->query("UPDATE users SET gold = '".$sumgold."',cp = '".$sumcp."' WHERE id = :I",$p);

						$infa=$infa="buyCp,".$realtime.",".$cost.",".$ip."";

						$this->addPalevo($id,$infa,3);



					}



			}



			function buyRes($uid,$gold,$wid){



				$realtime = time();

				$ip=$_SERVER['REMOTE_ADDR'];

				$costres=COSTRES;

					if( $gold>=$costres){

                        $p=array('W'=>$wid);

						$res = $this->row("SELECT * FROM vdata WHERE `wref` = :W",$p);

						$vwood=$res['wood'];

						$vclay=$res['clay'];

						$viron=$res['iron'];

						$vcrop=$res['crop'];

						$plusres=HOWRES;

						$rwood=$vwood+$plusres;

						$rclay=$vclay+$plusres;

						$riron=$viron+$plusres;

						$rcrop=$vcrop+$plusres;

						$rgold=$gold-$costres;

						$rgold = intval($rgold);

						$this->query("UPDATE  vdata set `wood`='".$rwood."',`clay`='".$rclay."',`iron`='".$riron."',`crop`='".$rcrop."' WHERE wref  = '".$wid."'");

						$this->query("UPDATE  users set gold=".$rgold." WHERE id  = '".$uid."'");

						$infa="buyres,".$realtime.",".$costres.",".$ip."";

						$this->addPalevo($uid,$infa,3);



					}



			}





			function Chekwwlvl(){



				$q = "SELECT users.id, users.username,users.alliance, fdata.wwname, fdata.f99, vdata.name, fdata.vref

				FROM users

				INNER JOIN vdata ON users.id = vdata.owner

				INNER JOIN fdata ON fdata.vref = vdata.wref

				WHERE fdata.f99t = 40 ORDER BY fdata.f99 Desc ";

				$result=$this->query($q);

				return $result;

			}

    function noticeViewed($id)

    {



        $q = "UPDATE ndata set `viewed` = '1' where `id` = :id";

        $p = array('id' => $id);

        $this->query($q, $p);

    }



			function addNotice($uid, $wref, $aid, $type,  $data, $time = 0,$topic,$data1='') {



				if($time == 0) {

					$time = time();

				}

				if($uid>5){

					$q = "INSERT INTO ndata (uid, toWref, ally, ntype, data, time,topic,data1,del) values ('".$uid."','".$wref."','".$aid."',".$type.",'".$data."',".$time.",:top,'".$data1."',0)";
                    $p=array('top'=>$topic);
					$this->query($q,$p);

				}

			}





    function getNotics($uid,$s,$s1,$filt="") {

        $s=$this->FilterIntValue($s);

        $s1=$this->FilterIntValue($s1);

        $p=array('U'=>$uid);

        $q = "SELECT ntype,id,topic,time,viewed FROM ndata where uid = :U and del = 0 ".$filt." ORDER BY time DESC LIMIT ".$s.",".$s1;

        return $this->query($q,$p);

    }

        function getNotics3($uid,$s,$s1,$filt="") {

        $s=$this->FilterIntValue($s);

        $s1=$this->FilterIntValue($s1);

        $p=array('U'=>$uid);

        $q = "SELECT ntype,id,topic,time,viewed FROM ndata where uid = :U and del = 1 ".$filt." ORDER BY time DESC LIMIT ".$s.",".$s1;

        return $this->query($q,$p);

    }

    function getNoticn($uid,$filter="") {

        $p=array('U'=>$uid);

        $q = "SELECT count(*) as c FROM ndata where uid = :U and del = 0 ".$filter;

        return $this->single($q,$p);

    }

    function getNoticn3($uid,$filter="") {

        $p=array('U'=>$uid);

        $q = "SELECT count(*) as c FROM ndata where uid = :U and del = 1 ".$filter;

        return $this->single($q,$p);

    }

			function getNotice2($id, $field) {

                $p=array('I'=>$id);

				$q = "SELECT ".$field." FROM ndata where `id` = :I";

                return $this->single($q, $p);

			}







						function getNotice5($id) {

                            $p=array('I'=>$id);

				$q = "SELECT * FROM ndata where id = :I";

                            $result=$this->row($q,$p);

                            for($i=49;$i>=1;$i--){

                                $result['topic'] = preg_replace("/REP_С".$i."/",constant('REP_С'.$i),$result['topic']);

                                $result['data'] = preg_replace("/REP_С".$i."/",constant('REP_С'.$i),$result['data']);

                                $result['data']= preg_replace("/Bd_".$i."_Bd/",$this->procResType($i),$result['data']);

                            }

                            return $result;

			}

    function NoticeMessage($uid){

        $p=array('U'=> $uid,'U1'=>$uid);

     return  $this->row("SELECT count(id) as notice,(SELECT count(id) FROM mdata where `target` = :U and `viewed` = '0' and `deltarget` = '0') as mes FROM ndata where uid = :U1 and viewed = 0",$p);

    }

								function getNoticenum($uid) {



				$q = "SELECT count(*) as sum FROM ndata where uid = :U and viewed = 0";

				$p=array('U'=>$uid);

				return $this->single($q,$p);

			}







            function checkExist_activate($ref, $mode) {

                $p=array('R'=>$ref);

		if(!$mode) {

			$q = "SELECT username FROM activate where username = :R LIMIT 1";

		} else {

			$q = "SELECT email FROM activate where email = :R LIMIT 1";

		}

		$result = $this->row($q,$p);

		if($result) {

			return true;

		} else {

			return false;

		}

	}



			function addBuilding($wid, $field, $type, $loop, $time,  $level,$master=0,$new=0) {

		if($new){

            $p=array('T'=>$type,'W'=>$wid);

            $q = "UPDATE fdata SET f" . $field . "t=:T WHERE vref=:W";

				$this->query($q,$p);

        }

                $p=array('T'=>$type,'W'=>$wid,'L'=>$level);

				$q = "INSERT into bdata values (0,:W,'".$field."',:T,'".$loop."','".$time."',:L,'".$master."')";

				 $this->query($q,$p);

			}







			function addDemolition($wid, $field,$fdata) {

		global $building;

                $p=array('F'=>$field,'W'=>$wid);

				$q = "DELETE FROM bdata WHERE `field`=:F AND `wid`=:W";

				$this->query($q,$p);

				$uprequire = $building->resourceRequired($field,$fdata['f'.$field.'t'],0);



				$q = "INSERT INTO demolition VALUES (0,:W,:F,".round((time()+floor($uprequire['time']/2))).")";

				$this->query($q,$p);

				$id=$this->get_last_id();

				return  array($id,round((time()+floor($uprequire['time']/2))));

			}

    public function finishTech($wid) {

        $p=array('W'=>$wid);
        $q = "SELECT * FROM research where vref =:W";
        $tech=$this->query($q,$p);

		$x=0;
        foreach($tech as $data){
			$x++;
            $sort_type = substr($data['tech'],0,1);
            switch($sort_type) {
                case "t":
                    $q = "UPDATE tdata set ".$data['tech']." = 1 where vref = '".$data['vref']."'";
                    break;
                case "a":
                case "b":
                    $q = "UPDATE abdata set ".$data['tech']." = ".$data['tech']." + 1 where vref = '".$data['vref']."'";
                    break;
            }
            $this->query($q);
            $q = "DELETE FROM research where id = '".$data['id']."'";
            $this->query($q);
        }
		$this->DeleteQueue("type='6' and if1='".$wid."'");

		if($x != 0){
			return TRUE;
		}
    }

			function addPalevo($uid,$infa,$type) {

                $p=array('U'=>$uid,'I'=>$infa);

				$q = "INSERT INTO palevo (`id`,`uid`, `infa`,`type`) VALUES (0,:U,:I,'".$type."')";

			$this->query($q,$p);

			}

				function addPalevoLogin($uid,$infa,$type,$browser="",$from="",$sit=0) {

                    $p=array('U'=>$uid,'I'=>$infa,'T'=>$type,'F'=>$from,'B'=>$browser,'S'=>$sit);

				$q = "INSERT INTO palevo (id,uid, infa, type,`from`,browser,sit,time) values (0,:U,:I,:T,:F,:B,:S,'".time()."')";

				$this->query($q,$p);

			}



			function getDemolition($wid = 0) {



				if($wid) {

                    $p=array('W'=>$wid);

					$q = "SELECT * FROM demolition WHERE `vref`=:W";

				} else {

                    $p="";

					$q = "SELECT * FROM demolition WHERE timetofinish<=" . time();

				}

				$result = $this->query($q,$p);

				if(!empty($result)) {

					return $result;

				} else {

					return NULL;

				}

			}



			function finishDemolition($wid) {

                $p=array('W'=>$wid);

				$q = "UPDATE demolition SET timetofinish=" . time() . " WHERE `vref`=:W";

				$this->query($q,$p);

			}



			function delDemolition($wid) {

                $p=array('W'=>$wid);

				$q = "DELETE FROM demolition WHERE `vref`=:W";

				$this->query($q,$p);

			}



			function getJobs($wid) {

                $p=array('W'=>$wid);

				$q = "SELECT * FROM bdata where `wid` = :W ORDER BY master ASC, loopcon ASC, timestamp ASC";

				return $this->query($q,$p);



			}

    function getJobsnoM($wid) {

        $p=array('W'=>$wid);

        $q = "SELECT * FROM bdata where `wid` = :W and `master` = '0' ORDER BY master ASC, loopcon ASC, timestamp ASC";

        return $this->query($q,$p);



    }

    function getJobstype($wid=0) {

        $p=array('W'=>$wid);

            $q = "SELECT type FROM bdata where `wid` = :W ORDER BY timestamp ASC, loopcon ASC";

            return $this->query($q,$p);

    }

						function getJobs1($wid) {

                            $p=array('W'=>$wid);

				$q = "SELECT * FROM bdata where `wid` = :W and level=1 order by timestamp ASC";

				return $this->query($q,$p);

			}









			function getBuildingByField($wid,$field) {

                $p=array('W'=>$wid,'F'=>$field);

				$q = "SELECT * FROM bdata where `wid` = :W and `field` = :F";

				return $this->query($q,$p);

			}



			function getBuildingByType($wid,$type) {

                $p=array('W'=>$wid,'T'=>$type);

				$q = "SELECT * FROM bdata where `wid` = :W and type = :T";

				return $this->query($q,$p);

			}



			function getDorf1Building($wid) {

                $p=array('W'=>$wid);

				$q = "SELECT * FROM bdata where `wid` = :W and field < 19 and master = 0";

				return $this->query($q,$p);

			}



			function getDorf2Building($wid) {

                $p=array('W'=>$wid);

				$q = "SELECT * FROM bdata where `wid` = :W and field > 18 and master = 0";

				return $this->query($q,$p);

			}



    function updateBuildingWithMaster($id, $time,$loop) {

        $p=array('I'=>$id);

        $q = "UPDATE bdata SET master = 0, timestamp = ".$time.",loopcon = '".$loop."' WHERE `id` = :I";

        return $this->query($q,$p);

    }

			function getVillageByName($name) {

                $p=array('N'=>$name);

				$q = "SELECT wref FROM vdata where name = :N limit 1";

                return $this->single($q, $p);

			}

            

            

            function mysql_fetch_all($result)

    {

        $all = array();

        if ($result) {

            while ($row = mysql_fetch_assoc($result)) {

                $all[] = $row;

            }

            return $all;

        }

    }



			/***************************

			 Function to set accept flag on market

			References: id

			***************************/

			function setMarketAcc($id) {



				$q = "UPDATE market set accept = 1 where id = :I";

                $p=array('I'=>$id);

                $this->query($q,$p);

			}





			/***************************

			 Function to get resources back if you delete offer

			References: VillageRef (vref)

			Made by: Dzoki

			***************************/



			function getResourcesBack($vref, $gtype, $gamt) {

                $p=array('V'=>$vref);

				//Xtype (1) = wood, (2) = clay, (3) = iron, (4) = crop

				if($gtype == 1) {

					$q = "UPDATE vdata SET `wood` = `wood` + '".$gamt."' WHERE `wref` = :V";

					$this->query($q,$p);

				} else

					if($gtype == 2) {

					$q = "UPDATE vdata SET `clay` = `clay` + '".$gamt."' WHERE `wref` = :V";

					$this->query($q,$p);

				} else

					if($gtype == 3) {

					$q = "UPDATE vdata SET `iron` = `iron` + '".$gamt."' WHERE `wref` = :V";

					$this->query($q,$p);

				} else

					if($gtype == 4) {

					$q = "UPDATE vdata SET `crop` = `crop` + '".$gamt."' WHERE `wref` = :V";

					$this->query($q,$p);

				}

			}



			/***************************

			 Function to get info about offered resources

			References: VillageRef (vref)

			Made by: Dzoki

			***************************/



			function getMarketField($vref, $field) {
				

                $p=array('V'=>$vref);

				$q = "SELECT ".$field." FROM market where `vref` = :V";

                return $this->single($q, $p);

			}

			function getMarketFieldId($vref,$id) {

                $p=array('V'=>$vref,'I'=>$id);

				$q = "SELECT gamt FROM market where `vref` = :V and `id`=:I";

                return $this->single($q, $p);

			}



			function removeAcceptedOffer($id) {

                $p=array('I'=>$id);

				$q = "DELETE FROM market where id = :I";

                return $this->single($q, $p);

			}



			/***************************

			 Function to add market offer

			Mode 0: Add

			Mode 1: Cancel

			References: Village, Give, Amt, Want, Amt, Time, Alliance, Mode

			***************************/

			function addMarket($vid, $gtype, $gamt=0, $wtype, $wamt=0, $time, $alliance, $merchant, $mode) {



				if(!$mode) {

                    if($gamt && $wamt){

                        $p=array('V'=>$vid,'GT'=>$gtype,'GA'=>$gamt,'WT'=>$wtype,'WA'=>$wamt,'T'=>$time,'A'=>$alliance,'M'=>$merchant);

					$q = "INSERT INTO market values (0,:V,:GT,:GA,:WT,:WA,0,:T,:A,:M)";

					$this->query($q,$p);

					return $this->get_last_id();

                    }

				} else {

                    $p=array('GT'=>$gtype,'V'=>$vid);

					$q = "DELETE FROM market where `id` = :GT and `vref` = :V";

					$this->query($q,$p);

				}

			}



			/***************************

			 Function to get market offer

			References: Village, Mode

			***************************/

			function getMarket($vid=0, $mode) {

                global $session;

                if($vid){
					$vills=implode(",",$session->villages);
					$alliance = $this->getUserAlliByVillID($vid);
					
				if(!$mode) {
					$p=array('V'=>$vid);

					// iRedux - Fix
					foreach($session->villages as $vil){
						if($vil = $vid){
							$q = "SELECT * FROM market where `vref` = :V and accept = 0";
						}
					}
					
					
				} else {
                    $p=array('A'=>$alliance);
					$q = "SELECT * FROM market where `vref` NOT IN (".$vills.") and `alliance` = :A or `vref` NOT IN (".$vills.") and alliance = 0 and accept = 0";

				}

				return $this->query($q,$p);

                }

                return false;

			}



			/***************************

			 Function to get market offer

			References: ID

			***************************/

			function getMarketInfo($id) {

                if($id){

                    $p=array('I'=>$id);



				$q = "SELECT * FROM market where id = :I";

                    return $this->row($q,$p);

                }

                return false;

			}



			function setMovementProc($moveid) {

                $p=array('M'=>$moveid);

				$q = "UPDATE movement set proc = 1 where `moveid` = :M";

				$this->query($q,$p);

			}





			/***************************

			 Function to retrieve used merchant

			References: Village

			***************************/

			function totalMerchantUsed($vid=0) {

                if($vid){

                    $p=array('V'=>$vid,'V1'=>$vid);

				$q = "SELECT sum(merchant) as sum from movement where ((`from` = :V and sort_type = 0) or (sort_type = 2 and `to` = :V1)) and proc = 0";

				$row = $this->row($q,$p);

                    $p=array('V'=>$vid);

                    $q3 = "SELECT sum(merchant) as sum3 from market where `vref` = :V and accept = 0";

                    $row3 = $this->row($q3,$p);

				return $row['sum']+$row3['sum3'];

                }

                return false;

			}



			function getMovement($type, $village=0, $mode) {

				if(!$mode) {

					$where = "from";

				} else {

					$where = "to";

				}

                $p=array('V'=>$village);

				switch($type) {

					case 0:

						$q = "SELECT * FROM movement where `" . $where . "` = :V and  proc = 0 and sort_type = 0 ORDER BY endtime ASC";

						break;

                        case 1:

						$q = "SELECT * FROM movement where  `" . $where . "` = :V and proc = 0 and sort_type = 6 ORDER BY endtime ASC";

						break;

					case 2:

						$q = "SELECT * FROM movement where movement." . $where . " = :V and movement.proc = 0 and movement.sort_type = 2 ORDER BY endtime ASC";

						break;

					case 3:

						$q = "SELECT * FROM movement, attacks where movement." . $where . " = :V and movement.ref = attacks.id and movement.proc = 0 and (movement.sort_type = 3  or movement.sort_type = 9) ORDER BY endtime ASC";

						break;

					case 4:

						$q = "SELECT * FROM movement, attacks where movement." . $where . " = :V and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 4 ORDER BY endtime ASC";

						break;

					case 5:

						$q = "SELECT * FROM movement where movement." . $where . " = :V and sort_type = 5 and proc = 0 ORDER BY endtime ASC";

						break;

					case 6:

						$q = "SELECT * FROM movement,odata, attacks where odata.conqured = :V and movement.to = odata.wref and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 ORDER BY endtime ASC";

						break;

					case 7:

						$q = "SELECT * FROM movement where movement." . $where . " = :V and sort_type = 4 and ref = 0 and proc = 0 ORDER BY endtime ASC";

						break;

					case 8:

						$q = "SELECT * FROM movement, attacks where movement." . $where . " = :V and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 and attacks.attack_type = 1 ORDER BY endtime ASC";

						break;

						case 33:

						$q = "SELECT * FROM movement, attacks where movement." . $where . " = :V and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 and attacks.attack_type=4 ORDER BY endtime ASC";

						break;

					case 34:

                        $p=array('V'=>$village,'V1'=>$village);

						$q = "SELECT * FROM movement, attacks where movement." . $where . " = :V and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 or movement." . $where . " = :V1 and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 4 ORDER BY endtime ASC";

						break;

						case 35:

						$q = "SELECT * FROM movement, attacks where movement." . $where . " = :V and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 and attack_type>2 ORDER BY endtime ASC";

						break;

                    case 88:

                        $p="";

                        $q = "SELECT movement.to FROM movement, attacks where movement." . $where . " IN (".$village.") and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 and attack_type>2 ORDER BY endtime ASC";

                        break;

						case 36:

						$q = "SELECT * FROM movement, attacks where movement." . $where . " = :V and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 and attacks.attack_type < '5' ORDER BY endtime ASC";

						break;

                    case 99:

                        $q = "SELECT w.oasistype,a.attack_type,w.x,w.y,v.name,a.t1,a.t2,a.t3,a.t4,a.t5,a.t6,a.t7,a.t8,a.t9,a.t10,a.t11,m.endtime,m.moveid,m.starttime,m.sort_type,w.id as wref FROM (((movement as m

                         LEFT JOIN attacks as a ON a.id = m.ref)

                         LEFT JOIN wdata as w ON w.id = m.to)

                         LEFT JOIN vdata as v ON v.wref = m.to)



                          where m." . $where . " = :V  and m.proc = 0 and (m.sort_type = 3 or m.sort_type = 9) ORDER BY m.endtime ASC";

                        break;



				}

				return $this->query($q,$p);



			}



			function addA2b($ckey, $timestamp, $to, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type,$add=0) {

		$p=array('C'=>$ckey,'TI'=>$timestamp,'TO'=>$to,'T1'=>$t1,'T2'=>$t2,'T3'=>$t3,'T4'=>$t4,'T5'=>$t5,'T6'=>$t6,'T7'=>$t7,'T8'=>$t8,'T9'=>$t9,'T10'=>$t10,'T11'=>$t11,'TY'=>$type,'A'=>$add);

				$q = "INSERT INTO a2b (ckey,time_check,to_vid,u1,u2,u3,u4,u5,u6,u7,u8,u9,u10,u11,type,`add`) VALUES (:C, :TI, :TO, :T1, :T2, :T3, :T4, :T5, :T6, :T7, :T8, :T9, :T10, :T11, :TY, :A)";

				$this->query($q,$p);

				return $this->get_last_id();

			}



			function getA2b($ckey, $check) {

		$p=array('CK'=>$ckey,'CH'=>$check);

				$q = "SELECT * from a2b where `ckey` = :CK AND `time_check` = :CH";

				$result = $this->row($q,$p);

				if($result) {

					return $result;

				} else {

					return false;

				}

			}



			function addMovement($type, $from, $to, $ref, $time, $endtime, $send = 1, $wood = 0, $clay = 0, $iron = 0, $crop = 0, $merchant = 0)

			{



					if($type<3)

					{

						$q = "SELECT MAX(moveid) AS maxid FROM movement";

						$idMax = $this->single($q);

						$ref = 500000+$idMax;

					}

					elseif($type>4 && $type <9)

					{

						$q = "SELECT MAX(moveid) AS maxid FROM movement";

						$idMax = $this->single($q);

						$ref = 500000+$idMax;

					}

$p=array('T'=>$type,'F'=>$from,'TO'=>$to,'R'=>$ref,'M'=>$merchant,'TI'=>$time,'E'=>$endtime,'S'=>$send,'W'=>$wood,'C'=>$clay,'I'=>$iron,'CR'=>$crop);

					$q = "INSERT INTO movement values (0,:T,:F,:TO,:R,:M,:TI,:E,0,:S,:W,:C,:I,:CR)";

					$this->query($q,$p);

					return $this->get_last_id();



			}



			function addAttack($vid, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type, $ctar1, $ctar2, $spy,$artefact=0,$add=0) {

                $p=array('V'=>$vid,'T1'=>$t1,'T2'=>$t2,'T3'=>$t3,'T4'=>$t4,'T5'=>$t5,'T6'=>$t6,'T7'=>$t7,'T8'=>$t8,'T9'=>$t9,'T10'=>$t10,'T11'=>$t11,'TY'=>$type,'CT'=>$ctar1,'CT1'=>$ctar2,'S'=>$spy,'A'=>$artefact,'AD'=>$add);

				$q = "INSERT INTO attacks values (0,:V,:T1, :T2, :T3, :T4, :T5, :T6, :T7, :T8, :T9, :T10, :T11,:TY,:CT,:CT1,:S,:A,:AD)";

                $this->query($q,$p);

					return $this->get_last_id();

			}



						function modifyAttack($aid, $unit, $amt) {

                            $p=array('A'=>$aid);

				$unit = 't' . $unit;

				$q = "UPDATE attacks set ".$unit." = ".$unit." - ".$amt." where `id` = :A";

				$this->query($q,$p);

			}





			function modifyAttack2($aid, $array_unit, $array_amt) {

                $p=array('A'=>$aid);

				 $i = -1;

                 $units2='';

                 $number = count($array_unit);

                 foreach($array_unit as $unit){

                 $unit = 't' . $unit;

                 ++$i;

                 $units2 .= $unit.' = '.$unit.'-'.$array_amt[$i].(($number > $i+1) ? ', ' : '');

                 }

                 $q = "UPDATE attacks set ".$units2."  where `id` = '".$aid."'";



				 $this->query($q,$p);

			}



			function getRanking() {



				$q = "SELECT id,username,alliance,ap,apall,dp,dpall,access FROM users WHERE tribe<=3 AND access<" . (INCLUDE_ADMIN ? "10" : "8");

				return $this->query($q);

			}





		function getARanking() {



				$q = "SELECT id,name,tag,oldrank,Aap,Adp FROM alidata where id >0 ORDER BY id DESC";

				return $this->query($q);

			}

					function getARanking2() {



				$q = "SELECT id,oldrank FROM alidata where id > 0";

				return $this->query($q);

			}



			function getUserByTribe($tribe){

                $p=array('T'=>$tribe);

				$q = "SELECT count(*) as sum FROM users where `tribe` = :T";

                return $this->single($q,$p);

			}



			function getUserByAlliance($aid){

                $p=array('A'=>$aid);

				$q = "SELECT id FROM users where alliance = :A";

				return $this->query($q,$p);

			}





    function editTableField($table, $field, $value, $refField, $ref) {

        $p=array('V'=>$value,'R'=>$ref);

        $q = "UPDATE ".$table." set $field = :V where ".$refField." = :R";

        return $this->query($q,$p);

    }





    function getAllMember($aid) {

        $p=array('A'=>$aid);

				$q = "SELECT id,username,timestamp FROM users where alliance = :A order  by (SELECT sum(pop) FROM vdata WHERE owner =  users.id) desc";

				return $this->query($q,$p);

			}

    function getAllMemO($aid) {

        $p=array('A'=>$aid,'A1'=>$aid);

        $q = "SELECT SUM(pop) as pop,(SELECT COUNT(id)  FROM users  WHERE alliance = :A) as user FROM (users as u  LEFT JOIN vdata as v ON  v.owner=u.id) WHERE u.alliance = :A1";

        return $this->row($q,$p);



    }



			function getAllMember3($aid) {

                $p=array('A'=>$aid);

				$q = "SELECT vdata.pop FROM vdata vdata  LEFT JOIN users users ON (users.alliance = :A) WHERE vdata.owner = users.id";

				return $this->query($q,$p);

			}

             function getAllMember4() {



				$q = "SELECT vdata.pop,users.alliance FROM vdata vdata  LEFT JOIN users users ON (users.alliance > 0) WHERE vdata.owner = users.id";

				return $this->query($q);

			}





			function addUnits($vid) {

                $p=array('V'=>$vid);

				$q = "INSERT into units (vref) values (:V)";

				$this->query($q,$p);

			}





			function getUnit($vid) {

                $p=array('V'=>$vid);

				$q = "SELECT * FROM `units` where `vref` = :V";

				$result = $this->row($q,$p);

				if (!empty($result)) {

					return $result;

				} else {

					return array();

				}

			}









	function FuckOnline($name,$sessid) {
		$p=array('N'=>$name,'S'=>$sessid);
		$q = "DELETE FROM online WHERE `name` =:N and `sessid`=:S";
		$this->query($q,$p);
	}

	function UpTonline($sessid) {
		$p=array('S'=>$sessid);
		$q = "UPDATE `online` SET `time` = ".time()." WHERE `sessid`=:S";
		$this->query($q,$p);
	}

			function addTech($vid) {



                $p=array('V'=>$vid);

				$q = "INSERT into tdata (vref) values (:V)";

				$this->query($q,$p);

			}



			function addABTech($vid) {

                $p=array('V'=>$vid);

				$q = "INSERT into abdata (vref) values (:V)";

				$this->query($q,$p);

			}



			function getABTech($vid) {

                $p=array('V'=>$vid);

				$q = "SELECT * FROM abdata where `vref` = :V";

                return $this->row($q,$p);

			}



			function addResearch($vid, $tech, $time) {

                $p=array('V'=>$vid,'T'=>$tech);

				$q = "INSERT into research values (0,:V,:T,".$time.")";

				$this->query($q,$p);

                return $this->get_last_id();

			}



			function getResearching($vid) {

                $p=array('V'=>$vid);

				$q = "SELECT * FROM research where `vref` = :V ORDER BY timestamp ASC";

				return $this->query($q,$p);

			}



			function checkIfResearched($vref, $unit) {

                $p=array('V'=>$vref);

				$q = "SELECT ".$unit." FROM tdata WHERE `vref` = :V";

                return $this->single($q, $p);

			}



			function getTech($vid) {

                $p=array('V'=>$vid);

				$q = "SELECT * FROM `tdata` WHERE `vref` = :V";

                return $this->single($q, $p);

			}



			function getTraining($vid) {

                $p=array('V'=>$vid);

				$q = "SELECT * FROM training where vref = :V ORDER BY id";

				return $this->query($q,$p);

			}



			function countTraining($vid) {

                $p=array('V'=>$vid);

				$q = "SELECT id FROM training WHERE vref = :V";

                return $this->single($q,$p);

			}





			function addEnforce($data) {





                $q = "INSERT into enforcement (vref,`from`) values ('" . $data['to'] . "','" . $data['from'] . "')";

				$this->query($q);

				$id = $this->get_last_id();

                 $this->modifyEnforce($id, array("1","2","3","4","5","6","7","8","9","10","11"),

				array($data['t1'],$data['t2'],$data['t3'],$data['t4'],$data['t5'],$data['t6'],$data['t7'],$data['t8'],$data['t9'],$data['t10'],$data['t11']),

				1);

				return $id;

			}



			function updateTraining($id, $trained, $each) {

                $p=array('I'=>$id);

				$q = "UPDATE training set amt = amt - ".$trained.", lastupdate = lastupdate + ".$each." where `id` = :I";

				$this->query($q,$p);

			}

			function updateTraining1($id, $trained, $each) {

                $p=array('I'=>$id);

				$q = "UPDATE training set amt = amt - ".$trained."  where `id` = :I";

				$this->query($q,$p);

			}

			function setCorrectTimestamp($vref) {

				 $p=array('I'=>$vref);

				$q = "UPDATE training set timestamp = timestamp - timestamp , lastupdate = lastupdate - lastupdate where `vref` = :I";

				$this->query($q,$p);

			}





			function modifyUnit($vref, $array_unit, $array_amt, $array_mode){



				$i = -1;

				$units='';

				$number = count($array_unit);

				foreach($array_unit as $unit){

					$unit = 'u' . $unit;

					++$i;

					$units .= $unit.' = '.$unit.' '.(($array_mode == 1)? '+':'-').'  '.$array_amt[$i].(($number > $i+1) ? ', ' : '');

				}

                $p=array('V'=>$vref);

				$q = "UPDATE units set ".$units."  WHERE `vref` = :V";

				 $this->query($q,$p);

			}







			        function checkReinf($id) {

		$enforce=$this->getEnforceArray($id,0);

		$fail=0;

					for($i=1; $i<=11; $i++){

						if($enforce['u'.$i.'']>0){

						$fail=1;

						}

					}

			if($fail==0){

			$this->deleteReinf($id);

                return true;

			}

return false;

	}

               	function deleteReinf($id) {



		if(isset($id) && is_numeric($id))

		{

			$q = "DELETE from enforcement where id = :I";

            $p=array('I'=>$id);

            $this->query($q,$p);

		}

	}









			function modifyEnforce($id, $array_unit, $array_amt, $array_mode){



				$i = -1;

				$units='';

				$number = count($array_unit);

				foreach($array_unit as $unit){

					$unit = 'u' . $unit;



					++$i;

					$units .= $unit.' = '.$unit.' '.(($array_mode == 1)? '+':'-').'  '.$array_amt[$i].(($number > $i+1) ? ', ' : '');

				}

                $p=array('I'=>$id);

				$q = "UPDATE enforcement set ".$units." WHERE `id` = :I";

				$this->query($q,$p);

					//unset($id, $array_unit, $array_amt, $array_mode);

			}



			function getEnforce($vid, $from) {

                $p=array('F'=>$from,'V'=>$vid);

				$q = "SELECT * from enforcement where `from` = :F and vref = :V";

                return $this->row($q,$p);

			}

						function getEnforceId($vid, $from) {

                            $p=array('F'=>$from,'V'=>$vid);

				$q = "SELECT id from enforcement where `from` = :F and vref = :V";

                            return $this->row($q,$p);

			}





			function addEnforce2($data,$dead1,$dead2,$dead3,$dead4,$dead5,$dead6,$dead7,$dead8,$dead9,$dead10,$dead11) {



				$q = "INSERT INTO enforcement (`vref`,`from`) values ('".$data['to']."','".$data['from']."')";

				$this->query($q);

				$id = $this->get_last_id();

					 $this->modifyEnforce($id, array("1","2","3","4","5","6","7","8","9","10","11"),

				array($data['t1'],$data['t2'],$data['t3'],$data['t4'],$data['t5'],$data['t6'],$data['t7'],$data['t8'],$data['t9'],$data['t10'],$data['t11']),

				1);

							 $this->modifyEnforce($id, array("1","2","3","4","5","6","7","8","9","10","11"),

				array($dead1,$dead2,$dead3,$dead4,$dead5,$dead6,$dead7,$dead8,$dead9,$dead10,$dead11),

				0);

				return $id;

			}





			function getEnforceArray($id, $mode) {



				if(!$mode) {

					$q = "SELECT * from enforcement where id = :id";

				} else {

					$q = "SELECT * FROM enforcement where `from` = :id";

				}

                $p = array('id'=>$id);

                return $this->row($q,$p);

			}



			function getEnforceVillage($id, $mode) {

                $p=array('I'=>$id);

				if(!$mode) {

					$q = "SELECT * from enforcement where `vref` = :I";

				} else {

					$q = "SELECT * from enforcement where `from` = :I";

				}

				return $this->query($q,$p);



			}

		public function getUpkeep($arra,$type,$buildarray,$unpack=0) {

         if($unpack==0){

		for($i=1;$i<=10;$i++) {

		$array['u'.(($type-1)*10+$i)]=$arra['u'.$i];

		}

		}else{

			$array=$arra;}



		$upkeep = 0;

		switch($type) {



			case 1:

			$start = 1;

			$end = 10;

			break;

			case 2:

			$start = 11;
			$end = 20;
			break;

			case 3:
			$start = 21;
			$end = 30;
			break;

            case 6:
            $start = 51;
            $end = 60;
			break;
			
            case 7:
            $start = 61;
            $end = 70;
            break;

            default:

                $start = 1;

                $end = 30;

                break;

		}



		for($i=$start;$i<=$end;$i++) {

			$unit = "u".$i;

			global $$unit;

			$dataarray = $$unit;

            if($type==1) {

                for ($j = 19; $j <= 38; $j++) {

                    if ($buildarray['f' . $j . 't'] == 41) {

                        $horsedrinking = $j;

                    }

                }

            }

			if(isset($horsedrinking)){

			if(($i==4 && $buildarray['f'.$horsedrinking] >= 10)

			|| ($i==5 && $buildarray['f'.$horsedrinking] >= 15)

			|| ($i==6 && $buildarray['f'.$horsedrinking] == 20)) {

			$upkeep += ($dataarray['pop']-1) * $array[$unit];

			} else {

			$upkeep += $dataarray['pop'] * $array[$unit];

			}}else{

			$upkeep += $dataarray['pop'] * $array[$unit];

			}



		}

            if(isset($arra['hero'])) {

                $upkeep += $arra['hero'] * 6;

            }



		return $upkeep;

	}



function allMov($vid){
	
    $p=array('V'=>$vid,'V1'=>$vid);

	$q="SELECT movement.from,movement.to,movement.endtime,attacks.attack_type,movement.sort_type FROM movement, attacks where (movement.from = :V or movement.to = :V1 and (attacks.attack_type=1 and movement.sort_type=4 or attacks.attack_type<>1)) and movement.ref = attacks.id and movement.proc = 0 and (attacks.attack_type<=5 or attacks.attack_type=88) ORDER BY endtime ASC";
	return $this->query($q,$p);

}

		function getAllUnits($base,$InVillageOnly=False,$oascrop=0,$owtribe=0,$troops=0,$oaswid=0,$enfoarray=0) {







		if($troops=="0"){

		$ownunitt = $this->getUnit($base);

		}else{ $ownunitt=$troops;}

if($enfoarray=="0"){

		$enfoarray = $this->getEnf($base);

}



		if(!$owtribe){

        $owtribe = $this->getUserTribeByVillageID($base);

        }

            for($i=1;$i<=40;$i++){$ownunit['u'.$i]=0;}

                   for($i=1;$i<=10;$i++) {



            $ownunit['u'.(($owtribe-1)*10+$i)] = $ownunitt['u'.$i];



            }



            $ownunit['hero']=$ownunitt['u11'];



		if(count($enfoarray) > 0) {



			foreach($enfoarray as $enforce) {



				for($i=1;$i<=10;$i++) {

					$ownunit['u'.(($enforce['tribe']-1)*10+$i)] += $enforce['u'.$i];

				}



				$ownunit['hero'] += $enforce['u11'];

			}

		}



if(!$InVillageOnly) {

			$movement = $this->getVillageMovement($base);

			if(!empty($movement)) {

				for($i=1;$i<=10;$i++) {

				$ownunit['u'.(($owtribe-1)*10+$i)] += $movement['u'.$i];

                  }

				$ownunit['hero'] += $movement['hero'];

			}

		}

		if($oascrop==1){



			if($oaswid==0){

		$q = "SELECT wref FROM `odata` WHERE `conqured` = :B";

                $p=array('B'=>$base);

		$oasis = $this->query($q,$p);}else{ $oasis=$oaswid;}

		if(count($oasis)){

		foreach($oasis as $oa){

             		$enforc = $this->getEnf($oa['wref']);



		if(count($enforc) > 0) {

			foreach($enforc as $enforce) {



				for($i=1;$i<=10;$i++) {

					$ownunit['u'.((($enforce['tribe']-1)*10)+$i)] += $enforce['u'.$i];

				}

				$ownunit['hero'] += $enforce['u11'];

			}

		}



             }



             }

             }

		return $ownunit;

	}







			function getVillageMovement($id) {

                $p=array('I'=>$id,'I1'=>$id);

				$q="SELECT * FROM (movement as m

				 LEFT JOIN attacks as a ON a.id = m.ref)

				  where ((m.from = :I and m.sort_type=3) or (m.to = :I1 and m.sort_type=4)) and m.proc = 0";





                $outgoingarray=$this->query($q,$p);

				$movingunits = array();

				                for($i = 1; $i <= 10; $i++) {

                    $movingunits['u'.$i] = 0;

                }

                $movingunits['hero']=0;

				if(count($outgoingarray)) {

					foreach($outgoingarray as $out) {

						for($i = 1; $i <= 10; $i++) {

							$movingunits['u'.$i] += $out['t' . $i];

						}

						$movingunits['hero'] += $out['t11'];

					}

				}

				return $movingunits;

			}



									function getVilMov2($id,$mass) {

                                        $p=array('I'=>$id,'I1'=>$id);

				$q="SELECT * FROM movement, attacks where ((movement.from = :I and movement.sort_type=3) or (movement.to = :I1 and movement.sort_type=4)) and movement.ref = attacks.id and movement.proc = 0";

           $outgoingarray=$this->query($q,$p);

				$movingunits = $mass;

				if(count($outgoingarray)) {

					foreach($outgoingarray as $out) {

						for($i = 1; $i <= 10; $i++) {

							$movingunits['u'.$i] += $out['t' . $i];

						}

						$movingunits['hero'] += $out['t11'];

					}

				}

				return $movingunits;

			}





	/***************************

	 Function to get user alliance name!

	Made by: Dzoki

	***************************/



	function getUserAllianceID($id) {

        $p=array('I'=>$id);

		$q = "SELECT alliance FROM users where id = :I";

        return $this->single($q, $p);

	}



	 function procResType($ref) {

		global $lang;

		switch($ref) {

		case $ref: $build = $lang['buildings'][$ref]; break;

         default: $build = "nothink"; break;

		}

		 return $build;

	}



	/***************************

	 Function to get WW name

	Made by: Dzoki

	***************************/



	function getWWName($vref) {

        $p=array('V'=> $vref);

		$q = "SELECT wwname FROM fdata WHERE vref = :V";

        return $this->single($q, $p);

	}


	/***************************

	 Function to change WW name

	Made by: Dzoki

	***************************/



	function submitWWname($vref, $name) {



		$q = "UPDATE fdata SET `wwname` = :name WHERE `vref` = '".$vref."'";

		$p=array("name"=>$name);

		$this->query($q,$p);

	}



	//medal functions

	function addclimberpop($user=0, $cp) {

        if($user){

            $p=array('U'=>$user);

		$q = "UPDATE users set Rc = Rc + '".$cp."' where id = :U";

		$this->query($q,$p);

        }

	}



	function addclimberrankpop($user=0, $cp) {

        if($user){

            $p=array('U'=>$user);

		$q = "UPDATE users set clp = clp + '".$cp."' where id = :U";

		$this->query($q,$p);

	}

    }

	function removeclimberrankpop($user=0, $cp) {

        if($user){

            $p=array('U'=>$user);

		$q = "UPDATE users set clp = clp - '".$cp."' where id = :U";

		$this->query($q,$p);

	}

    }

	function setclimberrankpop($user=0, $cp) {

        if($user){

            $p=array('U'=>$user);

		$q = "UPDATE users set clp = '".$cp."' where id = :U";

		$this->query($q,$p);

	}

    }

	function updateoldrank($user=0, $cp) {

        if($user){

            $p=array('U'=>$user);

		$q = "UPDATE users set oldrank = '".$cp."' where id = :U";

		$this->query($q,$p);

	}

    }

	function removeclimberpop($user=0, $cp) {

        if($user){

            $p=array('U'=>$user);

		$q = "UPDATE users set Rc = Rc - '".$cp."' where id = :U";

		$this->query($q,$p);

	}

    }

	// ALLIANCE MEDAL FUNCTIONS

	function addclimberpopAlly($user=0, $cp) {

        if($user){

            $p=array('U'=>$user);

		$q = "UPDATE alidata set Rc = Rc + '".$cp."' where id = :U";

		$this->query($q,$p);

	}

    }

	function addclimberrankpopAlly($user=0, $cp) {

        $p=array('U'=>$user);

		$q = "UPDATE alidata set clp = clp + '".$cp."' where id = :U";

		$this->query($q,$p);

    }

	function removeclimberrankpopAlly($user=0, $cp) {

        if($user){

            $p=array('U'=>$user);

		$q = "UPDATE alidata set clp = clp - '".$cp."' where id = :U";

		$this->query($q,$p);

	}

    }

	function updateoldrankAlly($user=0, $cp) {

        $p=array('U'=>$user);

        if($user){

		$q = "UPDATE alidata set oldrank = '".$cp."' where id = :U";

		$this->query($q,$p);

	}

    }

	function removeclimberpopAlly($user=0, $cp) {

        $p=array('U'=>$user);

        if($user){

		$q = "UPDATE alidata set Rc = Rc - '".$cp."' where id = :U";

		$this->query($q,$p);

	}

    }

		function UpdateMaxAlly($alid, $max) {

            $p=array('A'=>$alid);

		$q = "UPDATE alidata set `max` = '".$max."' where id = :A";

		$this->query($q,$p);

	}



	function getTrainingList($vref) {

        $p=array('V'=> $vref);

		$q = "SELECT * FROM training where vref = :V";

		return $this->query($q,$p);

	}



	function GetForAllyTop ($what,$id=0){



		if($id==0){

		$q="SELECT * FROM alidata WHERE `".$what."` >= 0 ORDER BY `".$what."` DESC Limit 10";

            $p="";

		}else{

		$q="SELECT * FROM alidata WHERE `id`=:I";

            $p=array('I'=>$id);

		}

        return $this->query($q,$p);

        }



        	function GetForUserTop($what,$id=0){



		if($id==0){

            $p='';

		$q="SELECT id,username,".$what." FROM users WHERE  id > 5 AND `".$what."` >= 0  ORDER BY `".$what."`  DESC Limit 10";

		}else{

            $p=array('I'=>$id);

		$q="SELECT id,username,".$what." FROM users WHERE `id`=:I";

		}

        return $this->query($q,$p);

        }



                function ActiveAndOnline($timetoxz){



		return $this->single("SELECT COUNT(*) as sum FROM users WHERE ".time()."-timestamp <  '".$timetoxz."'");



        }

	function countUser() {



		$q = "SELECT count(id) as cou FROM users where id > 5";

        return $this->single($q);

	}



	function countAlli() {



		$q = "SELECT count(id) as sum FROM alidata where id != 0";

        return $this->single($q);

	}







	function RemoveXSS($val) {

		return htmlspecialchars($val, ENT_QUOTES);

	}

	function defender_xss($arr){

    return htmlspecialchars($arr, ENT_QUOTES);

}



          			function GetFuckingPlus($uid){

                        $p=array('U'=> $uid);

				 $plus=0;

				 $q = "SELECT plus FROM users WHERE id=:U";

				 $plusT = $this->single($q,$p);

				 if($plusT>time()){$plus=1;}

				 return $plus;

				 }



	function Getowner($vid) {

        $p=array('V'=>$vid);

		$q = "SELECT owner FROM vdata where wref = :V";

        return $this->single($q,$p);

	}





			function getinfoforndata ($whattoask){



		$q="SELECT * FROM ndata WHERE ".$whattoask."";

		return $this->query($q);

		}





	 function getAvailableExpansionTraining($rasa,$vid) {
		global $building, $technology, $session;
        $p=array('V'=>$vid);
		$q = "SELECT exp1,exp2,exp3 FROM vdata WHERE `wref` = :V";

		$row = $this->row($q,$p);

		$maxslot=$settlers=$chiefs=0;

		$residence = $building->getTypeLevel(25);

		if($session->tribe == 7){
			$palace = $building->getTypeLevel(44);
		}else{
			$palace = $building->getTypeLevel(26);
		}
		

		if($row['exp1']!=0){$exp1=1;}else{$exp1=0;}

		if($row['exp2']!=0){$exp2=1;}else{$exp2=0;}

		if($row['exp3']!=0 ){$exp3=1;}else{$exp3=0;}

		$maxslotsexp = $exp1+$exp2+$exp3;
		if($residence > 0) {
			if($residence>=10 and $residence<20){
				$maxslot=1;}elseif($residence==20){
			    $maxslot=2;
				}
				}
			elseif($palace > 0) {

				if($palace>=10 and $palace<15){

				$maxslot=1;}elseif($palace>=15 and $palace<20){

				$maxslot=2;

				}elseif($palace==20){

				$maxslot=3;}





		}

		$maxslots =  $maxslot-$maxslotsexp;

//проinерка in капах

         $q = "SELECT sum(t10) as sum FROM `prisoners` WHERE `from` = :V";

         $row = $this->row($q,$p);

         $settlers += $row['sum'];



         $q = "SELECT sum(t9) as sum FROM `prisoners` WHERE `from` = :V";

         $row = $this->row($q,$p);

         $chiefs += $row['sum'];





         $q = "SELECT sum(u10) as sum FROM units WHERE `vref` = :V";



		$row = $this->row($q,$p);

		$settlers += $row['sum'];



		$q = "SELECT sum(u9) as sum FROM units WHERE `vref` = :V";

		$row = $this->row($q,$p);

		$chiefs += $row['sum'];





//???????? ???????? ?? ????????????????/??????????????

		$current_movement = $this->getMovement(3, $vid, 0);

		if(!empty($current_movement)) {

			foreach($current_movement as $build) {

				$settlers += $build['t10'];

				$chiefs += $build['t9'];

			}

		}



         //?????????????????????? ??????????????/???????????? ?? ????????

		$current_movement = $this->getMovement(4, $vid, 1);

		if(!empty($current_movement)) {

			foreach($current_movement as $build) {

				$settlers += $build['t10'];

				$chiefs += $build['t9'];

			}

		}

                //????????????/?????????? ?? ??????????????????

		$q = "SELECT sum(u10) as sum FROM enforcement WHERE `from` = :V";

		$rows1 = $this->row($q,$p);

        $settlers += $rows1['sum'];





		$q = "SELECT sum(u9) as sum FROM enforcement WHERE `from` = :V";

		$rower = $this->row($q,$p);

		$chiefs += $rower['sum'];



             //????????????/?????????? ?? ????????????.

		$trainlist = $technology->getTrainingList(4);

		if(!empty($trainlist)) {

			foreach($trainlist as $train) {

				if($train['unit'] == ($rasa.'0')) {

					$settlers += $train['amt'];

				}

				if($train['unit'] == (($rasa-1)*10+9) ) {

					$chiefs += $train['amt'];

				}

			}

		}



		$chiefsset=$chiefs * 3;



		$settlerslots = $maxslots * 3 - $settlers - $chiefsset;



		$xz=floor(($settlers + 2) / 3);

		$chiefslots = $maxslots - $chiefs - $xz ;



		if(!$technology->getTech(9)) {

			$chiefslots = 0;

		}



		$slots = array("chiefs" => $chiefslots, "settlers" => $settlerslots);



		return $slots;

	}



    function getOneProfileVillage($wid) {

        $p=array('W'=>$wid);

        $q = "SELECT name,wref from vdata where `wref` = :W order by name desc";

        return $this->query($q,$p);



    }

	function recountPop($vid,$fdata=array()){

		if(!count($fdata)){$fdata = $this->getResourceLevel($vid);}

		$popTot = 0;



		for ($i = 1; $i <= 41; $i++) {

		if($i==41){$i=99; }

			$lvl = $fdata["f".$i];

			$building = $fdata["f".$i."t"];

			if($building){

				$popTot += $this->buildingPOP($building,$lvl);

			}

			if($i==99){ break;}

		}

         $this->setVillageField($vid,"pop",$popTot);



		return $popTot;



	}



	 function bountyprocessOProduction($bountywid) {



		$oinfo=$this->getOasisInfo($bountywid);

		$timepast = time() - $oinfo['lastupdated'];

		$resioasa = round(((40*SPEED) / 3600) * $timepast);

		$this->modifyOasisResource($bountywid,$resioasa,$resioasa,$resioasa,$resioasa,1);

			if($oinfo['loyalty']<100){

				$newloyalty = min(100,$oinfo['loyalty']+2*$timepast/(60*60));

                $p=array('W'=>$bountywid);

		$q = "UPDATE odata SET loyalty = ".$newloyalty." WHERE `wref` = :W";

		$this->query($q,$p);

	}

		$this->updateOasis($bountywid);

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

      function getBaseID($x,$y) {

	return ((WORLD_MAX-$y) * (WORLD_MAX*2+1)) + (WORLD_MAX +$x + 1);

	}

    function getMapCheck($wref) {

        return substr(md5($wref),5,2);

    }

      function procDistanceTime($coor,$thiscoor,$ref,$mode,$vrefka=0,$oas=0) {

		global $bid14;

		if($vrefka==0){$vrefka=$this->getBaseID($coor['x'],$coor['y']);}

		$xdistance = ABS($thiscoor['x'] - $coor['x']);

		if($xdistance > WORLD_MAX) {

			$xdistance = (2 * WORLD_MAX + 1) - $xdistance;

		}

		$ydistance = ABS($thiscoor['y'] - $coor['y']);

		if($ydistance > WORLD_MAX) {

			$ydistance = (2 * WORLD_MAX + 1) - $ydistance;

		}

		$distance = SQRT(POW($xdistance,2)+POW($ydistance,2));

		if(!$mode) {

			if($ref == 1) {

				$speed = 16;

			}

			else if($ref == 2) {

				$speed = 12;

			}

			else if($ref == 3) {

				$speed = 24;

			}

			else {

				$speed = (INCREASE_SPEED * 3) ;

			}

		}else {

			$speed = $ref;

			}

			  if(!$oas){

            $buildarr=$this->getTypeLevel(14,$vrefka);

       if($buildarr != 0 && $distance >= TS_THRESHOLD) {

       $speed = $speed * ($bid14[$buildarr]['attri']/100) ;

        }

           }







		if($speed!=0){

		return round(($distance/$speed) * 3600 / INCREASE_SPEED);

		}else{

		return round($distance * 3600 / INCREASE_SPEED);

		}

	}

    function procDistanceTime2($coor,$thiscoor,$ref,$mode,$vrefka=0,$oas=0) {

        global $bid14,$village;

        if($vrefka==0){$vrefka=$this->getBaseID($coor['x'],$coor['y']);}

        $xdistance = ABS($thiscoor['x'] - $coor['x']);

        if($xdistance > WORLD_MAX) {

            $xdistance = (2 * WORLD_MAX + 1) - $xdistance;

        }

        $ydistance = ABS($thiscoor['y'] - $coor['y']);

        if($ydistance > WORLD_MAX) {

            $ydistance = (2 * WORLD_MAX + 1) - $ydistance;

        }

        $distance = SQRT(POW($xdistance,2)+POW($ydistance,2));

        if(!$mode) {

            if($ref == 1) {

                $speed = 16;

            }

            else if($ref == 2) {

                $speed = 12;

            }

            else if($ref == 3) {

                $speed = 24;

            }

            else {

                $speed = 1;

            }

        }else {

            $speed = $ref;

        }

        if(!$oas){

            $buildarr=$this->getTypeLevel(14,$vrefka,$village->resarray);

            if($buildarr != 0 && $distance >= TS_THRESHOLD) {

                $speed = $speed * ($bid14[$buildarr]['attri']/100) ;

            }

        }







        if($speed!=0){

            return round(($distance/$speed) * 3600 / INCREASE_SPEED);

        }else{

            return round($distance * 3600 / INCREASE_SPEED);

        }

    }

	 function getTypeLevel($tid,$vid,$fdata='') {



		$keyholder = array();

            if(empty($fdata)){

			$resourcearray = $this->getResourceLevel($vid);

             }else{$resourcearray=$fdata;}



		foreach(array_keys($resourcearray,$tid) as $key) {

			if(strpos($key,'t')) {

				$key = preg_replace("/[^0-9]/", '', $key);

				array_push($keyholder, $key);

			}

		}

		$element = count($keyholder);

		if($element >= 2) {

			if($tid <= 4) {

				$temparray = array();

				for($i=0;$i<=$element-1;$i++) {

					array_push($temparray,$resourcearray['f'.$keyholder[$i]]);

				}

				foreach ($temparray as $key => $val) {

					if ($val == max($temparray))

					$target = $key;

				}

			}

			else {

				$target = 0;

				for($i=1;$i<=$element-1;$i++) {

					if($resourcearray['f'.$keyholder[$i]] > $resourcearray['f'.$keyholder[$target]]) {

						$target = $i;

					}

				}

			}

		}

		else if($element == 1) {

			$target = 0;

		}

		else {

			return 0;

		}

		if($keyholder[$target] != "") {

			return $resourcearray['f'.$keyholder[$target]];

		}

		else {

			return 0;

		}

	}

     function getTypeField($type,$fdata) {
        for($i=19;$i<=45;$i++) {
            if($fdata['f'.$i.'t'] == $type) {
                return $i;
            }
        }

    }

	function getTypeLvlFdata($tid,$fdata) {

		$keyholder = array();



		foreach(array_keys($fdata,$tid) as $key) {

			if(strpos($key,'t')) {

				$key = preg_replace("/[^0-9]/", '', $key);

				array_push($keyholder, $key);

			}

		}

		$element = count($keyholder);

		if($element >= 2) {

			if($tid <= 4) {

				$temparray = array();

				for($i=0;$i<=$element-1;$i++) {

					array_push($temparray,$fdata['f'.$keyholder[$i]]);

				}

				foreach ($temparray as $key => $val) {

					if ($val == max($temparray))

					$target = $key;

				}

			}

			else {

				$target = 0;

				for($i=1;$i<=$element-1;$i++) {

					if($fdata['f'.$keyholder[$i]] > $fdata['f'.$keyholder[$target]]) {

						$target = $i;

					}

				}

			}

		}

		else if($element == 1) {

			$target = 0;

		}

		else {

			return 0;

		}

		if($keyholder[$target] != "") {

			return $fdata['f'.$keyholder[$target]];

		}

		else {

			return 0;

		}

	}



	function addArtefact($vref, $owner, $type, $size) {



		$q = "INSERT INTO `artefacts` (`vref`, `owner`, `type`, `size`, `conquered`) VALUES ('".$vref."', '".$owner."', '".$type."', '".$size."', '" . time() . "')";

		$this->query($q);

	}



		function getArteInf($vref) {

            $p=array('V'=> $vref);

		$q = "SELECT * FROM artefacts WHERE vref = :V";

		return $this->query($q,$p);



	}

		function getOwnArtefactInfoNum($vref) {

            if($vref){

                $p=array('V'=> $vref);

		$q = "SELECT * FROM artefacts WHERE vref = :V";

		$result = $this->query($q,$p);

		return count($result);

            }

            return false;

	}

			function getOwnArtNumOwner($uid) {

                $p=array('U'=> $uid);

		$q = "SELECT id FROM artefacts WHERE owner = :U and type<11";

		$result = count($this->query($q,$p));

		return $result;

	}



	function getOwnArtefactInfo2($vref) {

        $p=array('V'=> $vref);

		$q = "SELECT * FROM artefacts WHERE vref = :V";

		return $this->query($q,$p);

	}

	function geallart(){



	$q = "SELECT * FROM artefacts";

	return $this->query($q);

       }

	function getOwnArtefactInfo3($uid) {

        if($uid){

            $p=array('U'=> $uid);

		$q = "SELECT * FROM artefacts WHERE owner = :U";

		return $this->query($q,$p);

        }

	}



	function getOwnArtefactInfoByType($vref, $type) {

        if($vref){

            $p=array('V'=> $vref,'T'=>$type);

		$q = "SELECT * FROM artefacts WHERE vref = :V AND type = :T";

            return $this->row($q,$p);

        }

	}



	function getOwnArtefactInfoByType2($vref, $type) {

        if($vref){

            $p=array('V'=> $vref,'T'=>$type);

		$q = "SELECT * FROM artefacts WHERE vref = :V AND type = :T";

		return $this->query($q,$p);

        }

	}



	function getOwnUniqueArtefactInfo($id, $type, $size) {

        if($id){

            $p=array('I'=>$id,'T'=>$type,'S'=>$size);

		$q = "SELECT * FROM artefacts WHERE owner = :I AND type = :T AND size=:S AND owner>4 AND activated=1";

            return $this->row($q,$p);

        }

	}



	function getOwnUniqueArtefactInfo2($id, $type, $size, $mode) {

        if($id){

            $p=array('I'=>$id,'T'=>$type,'S'=>$size);

		if(!$mode){

			$q = "SELECT * FROM artefacts WHERE owner = :I  AND type = :T AND size=:S AND owner>4 AND activated=1";

		}else{

			$q = "SELECT * FROM artefacts WHERE vref = :I  AND type = :T AND size=:S AND owner>4 AND activated=1";

		}

		return $this->query($q,$p);

        }

        return array();

	   }



		function getOwnMovementBack($data) {

            $p=array('R'=>$data);

		$q = "SELECT * FROM movement WHERE `ref` = :R AND `sort_type` = '4' AND `proc` = '0'";

		$result = $this->query($q,$p);

		return count($result);

	}





	function claimArtefact($vref, $ovref, $id,$activate) {

        $p=array('V'=>$vref,'I'=>$id,'A'=>$activate,'VR'=>$ovref);

		$time = time();

		$q = "UPDATE artefacts SET `vref` = :V, `owner` = :I, `conquered` = '".$time."', `activated`=:A WHERE `vref` = :VR";

		$this->query($q,$p);

	}

		function claimArtefactById($vref, $ovref, $id,$activate,$idd) {



		$time = time();

        $p=array('V'=>$vref,'I'=>$id,'A'=>$activate,'OV'=>$ovref,'II'=>$idd);

		$q = "UPDATE artefacts SET vref = :V, owner = :I, conquered = '".$time."', `activated`=:A WHERE `vref` = :OV and `id`=:II";

		$this->query($q,$p);

	}



	function getArtefactDetails($id) {



		$q = "SELECT * FROM artefacts WHERE id = :id";

		$p=array('id'=>$id);

        return $this->row($q,$p);

	}



	function getMovementById($id){

        $p=array('I'=>$id);

		$q = "SELECT * FROM movement WHERE moveid = :I";

		return $this->query($q,$p);

	}



	function getLinks($id){

        $p=array('I'=>$id);

		$q = "SELECT * FROM `links` WHERE `userid` = :I ORDER BY `pos` ASC";

		return $this->query($q,$p);

	}



	function removeLinks($id,$uid){

        $p=array('I'=>$id,'U'=>$uid);

		$q = "DELETE FROM links WHERE `id` = :I and `userid` = :U";

		$this->query($q,$p);

	}









	function getOwnArtefactInfoUid($uid) {

        $p=array('U'=> $uid);

		$q = "SELECT * FROM artefacts WHERE owner = :U";

		$result = $this->query($q,$p);

		return count($result);

	}

		function getOwnArtsizetype($s,$by) {

		$q = "SELECT * FROM artefacts WHERE `size` = ".$s." ORDER BY ".$by."";

		return $this->query($q);

	}





	function getSitUid($uid) {

        $p=array('U'=> $uid,'U1'=>$uid);

		$q = "SELECT id FROM users WHERE sit1 = :U or sit2 = :U1";

		$result = $this->query($q,$p);

		return count($result);

	}



	function getArrayMemberVillage($uid){

        $p=array('U'=> $uid);

		$q = "SELECT a.wref, a.name, b.x, b.y from vdata AS a left join wdata AS b ON b.id = a.wref where owner = :U order by capital DESC,pop DESC";

		return $this->query($q,$p);

	}

		function getbyVilName($uid){

            $p=array('U'=> $uid);

		$q = "SELECT a.wref, a.name, b.x, b.y from vdata AS a left join wdata AS b ON b.id = a.wref where owner = :U order by name";

		return $this->query($q,$p);

	}



	function addPassword($uid, $npw, $cpw){

        $p=array('U'=>$uid,'N'=>$npw,'C'=>$cpw);

		$q = "REPLACE INTO `password`(uid, npw, cpw) VALUES (:U, :N, :C)";

		$this->query($q,$p);

	}





     function  CheckSitters($uid){

         $p=array('U'=> $uid);

     $q = "SELECT sit1,sit2 FROM users where id = :U and access != " . BANNED;

         return $this->row($q,$p);

	 }



              		function getResVillageField($ref) {

                        $p=array('R'=>$ref);

		$q = "SELECT wood,clay,iron,crop FROM vdata where wref = :R";

		return $this->row($q,$p);



	}

    function getNPCVillageField($ref) {

        $p=array('R'=>$ref);

        $q = "SELECT wood,clay,iron,crop,maxstore,maxcrop FROM vdata where wref = :R";

        return $this->row($q,$p);



    }





        function processProduction($bountywid,$fdata,$info,$oasis,$plus,$upkeep,$her=array()) {
		global $bid10, $bid38, $bid11, $bid39, $bid45, $session;

            if(!count($upkeep)){
                $upkeep = $this->getUpkeep($this->getAllUnits($bountywid,0,1),$plus['tribe'],$fdata); }else{
                $upkeep = $this->getUpkeep($upkeep,$plus['tribe'],$fdata,1);}
            if(!count($her)){
				$her=$this->getHero($info['uid']);
            }

            $herores=$her;
            $wb=$clb=$ib=$cb=0;
            if($herores['wref']==$bountywid){
				if(!$herores['dead']){
					$pr=$herores['product'];

					if($herores['r0']){
						$wb=$clb=$ib=$cb=3*SPEED*$pr;
					}else{
						$wb=$herores['r1']*$pr*10*SPEED;
						$clb=$herores['r2']*$pr*10*SPEED;
						$ib=$herores['r3']*$pr*10*SPEED;
						$cb=$herores['r4']*$pr*10*SPEED;
					}
				}

            }

		$timepast = time() - $info['lastupdate'];

		$nres['woodp'] = $this->getAllProd(1,$fdata,$plus['b1'],$oasis)+$wb;
		$nres['clayp'] = $this->getAllProd(2,$fdata,$plus['b2'],$oasis)+$clb;
		$nres['ironp'] = $this->getAllProd(3,$fdata,$plus['b3'],$oasis)+$ib;
		$nres['crop+']= $this->getAllProd(4,$fdata,$plus['b4'],$oasis)+$cb;
		$nres['cropp'] = ($nres['crop+']-$info['pop']-$upkeep);
		$nres['wood'] = (($nres['woodp']) / 3600) * $timepast;
		$nres['clay'] = (($nres['clayp']) / 3600) * $timepast;
		$nres['iron'] = (($nres['ironp']) / 3600) * $timepast;
		$nres['crop'] = (($nres['cropp']) / 3600) * $timepast;
        $ress = $crop = 0;

        for ($i = 19; $i < 40; ++$i){
			if ($fdata['f' . $i . 't'] == 10){$ress += $bid10[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
			if ($fdata['f' . $i . 't'] == 38){$ress += $bid38[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
			if ($fdata['f' . $i . 't'] == 11){$crop += $bid11[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
			if ($fdata['f' . $i . 't'] == 39){$crop += $bid39[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
		}

			
            if ($ress == 0){$ress = 800 * STORAGE_MULTIPLIER;}
			if ($crop == 0){$crop = 800 * STORAGE_MULTIPLIER;}
			
			// iRedux -> storage multiple function by gold
			$upData = $this->queryFetch('SELECT * FROM `storage` WHERE `uid` = '.$session->uid.' AND `vid` = '.$bountywid.'');
			
			$ress = $ress + ($upData['storagem'] * $bid10[20]['attri'] * STORAGE_MULTIPLIER);
			$crop = $crop + ($upData['storagem'] * $bid11[20]['attri'] * STORAGE_MULTIPLIER);
			
            $zapros=$zap="";
            if($info['maxstore']!=$ress ){$zapros.="`maxstore` = '". $ress ."'";}
		    if($info['maxcrop']!=$crop){if(!empty($zapros)){$zap=",";}
            $zapros.=$zap;
			$zapros.="`maxcrop` = '". $crop ."'";}
			
            if(!empty($zapros)){
				$q="UPDATE `vdata` SET ".$zapros." WHERE `wref` = :B";
				$p=array('B'=>$bountywid);
				$this->query($q,$p);
			}


        //??????????????????

		$newloyalty=$info['loyalty'];

		if($info['loyalty']<100){
			$resid=$this->getTypeLvlFdata(25,$fdata);
			$palac=$this->getTypeLvlFdata(26,$fdata);
			$ccenter=$this->getTypeLvlFdata(44,$fdata);

			if($resid >= 1){
				$value = $resid;
			}elseif($palac >= 1){
				$value = $palac;
			}elseif($ccenter >= 1){
				$value = $ccenter;
			}else{
				$value = 0;
			}

			if($value != 0){
				$newloyalty = min(100,$info['loyalty']+$value*$timepast/(60*60));
				$this->SetVillageField($bountywid,"loyalty",$newloyalty);
			}
      	}

		$res=$this->modifyResourceReturn($bountywid,$nres['wood'],$nres['clay'],$nres['iron'],$nres['crop'],1);
		$res['maxstore']=$ress;
		$res['loyalty']= $newloyalty;
		$res['maxcrop']= $crop;

        $this->culturePoints($info['uid'],$info['lastup']);
		$this->updateVillage($bountywid);
		return array($res,$nres);

	}







    function processStarvation($info,$plus) {
		global $bid11, $bid39,$bid10,$bid38;
		
		$fdata = $this->getResourceLevel($info['wref']);

        $oasis=$this->sortOasis($this->getOasis($info['wref']));

        $troop=$this->getAllUnits($info['wref'],0,1);

            $upkeep = $this->getUpkeep($troop,0,$fdata,1);



            $her=$this->getHero($plus['id']);


        $herores=$her;

        $wb=$clb=$ib=$cb=0;

        if($herores['wref']==$info['wref']){

            if(!$herores['dead']){

                $pr=$herores['product'];

                if($herores['r0']){

                    $wb=$clb=$ib=$cb=3*SPEED*$pr;

                }else{

                    $wb=$herores['r1']*$pr*10*SPEED;

                    $clb=$herores['r2']*$pr*10*SPEED;

                    $ib=$herores['r3']*$pr*10*SPEED;

                    $cb=$herores['r4']*$pr*10*SPEED;

                }

            }

        }

        $bountywid=$info['wref'];

        $timepast = time() - $info['lastupdate'];

        $nres['woodp'] = $this->getAllProd(1,$fdata,$plus['b1'],$oasis)+$wb;

        $nres['clayp'] = $this->getAllProd(2,$fdata,$plus['b2'],$oasis)+$clb;

        $nres['ironp'] = $this->getAllProd(3,$fdata,$plus['b3'],$oasis)+$ib;

        $nres['crop+']= $this->getAllProd(4,$fdata,$plus['b4'],$oasis)+$cb;





        $nres['cropp'] = ($nres['crop+']-$info['pop']-$upkeep);

        $nres['wood'] = (($nres['woodp']) / 3600) * $timepast;

        $nres['clay'] = (($nres['clayp']) / 3600) * $timepast;

        $nres['iron'] = (($nres['ironp']) / 3600) * $timepast;

        $nres['crop'] = (($nres['cropp']) / 3600) * $timepast;

        //???????????? ?? ????????????

        $ress = $crop = 0;

        for ($i = 19; $i < 40; ++$i){

            if ($fdata['f' . $i . 't'] == 10){$ress += $bid10[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}

            if ($fdata['f' . $i . 't'] == 38){$ress += $bid38[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}

            if ($fdata['f' . $i . 't'] == 11){$crop += $bid11[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}

            if ($fdata['f' . $i . 't'] == 39){$crop += $bid39[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}

        }

        if ($ress == 0){$ress = 800 * STORAGE_MULTIPLIER;}

        if ($crop == 0){$crop = 800 * STORAGE_MULTIPLIER;}

        $zapros=$zap="";

        if($info['maxstore']!=$ress ){$zapros.="`maxstore` = '". $ress ."'";}

        if($info['maxcrop']!=$crop){if(!empty($zapros)){$zap=",";}

            $zapros.=$zap;

            $zapros.="`maxcrop` = '". $crop ."'";}

        if(!empty($zapros)){

            $q="UPDATE `vdata` SET ".$zapros." WHERE `wref` = '" . $info['wref']."'";

            $this->query($q);

        }

        //??????????????????

        $newloyalty=$info['loyalty'];

        if($info['loyalty']<100){
            $resid=$this->getTypeLvlFdata(25,$fdata);
            $palac=$this->getTypeLvlFdata(26,$fdata);
            $ccenter=$this->getTypeLvlFdata(44,$fdata);

            if($resid >= 1){ $value = $resid;

            }elseif($palac >= 1){$value = $palac;

            }elseif($ccenter >= 1){$value = $ccenter;

            } else {$value = 0; }

            if($value != 0){

                $newloyalty = min(100,$info['loyalty']+$value*$timepast/(60*60));

                $this->SetVillageField($bountywid,"loyalty",$newloyalty);

            }

        }



        $res=$this->modifyResourceReturn($bountywid,$nres['wood'],$nres['clay'],$nres['iron'],$nres['crop'],1);


        $res['loyalty']= $newloyalty;

        $res['maxcrop']= $crop;

        $this->culturePoints($info['owner'],$plus['lastup']);

        $this->updateVillage($bountywid);

        return array($res,$nres,$troop,$upkeep);

    }



	function getCropProdstarv($wref) {



		global $bid4,$bid8,$bid9;

             $wref=$this->FilterIntValue($wref);

		$basecrop = $grainmill = $bakery = 0;

		$owner = $this->getVrefField($wref, 'owner');

		$bonus = $this->getUserField($owner, 'b4', 0);

        $cropo=4;

		$buildarray = $this->getResourceLevel($wref);

		$cropholder = array();

		for($i=1;$i<=38;$i++) {

			if($buildarray['f'.$i.'t'] == 4) {

				array_push($cropholder,'f'.$i);

			}

			if($buildarray['f'.$i.'t'] == 8) {

				$grainmill = $buildarray['f'.$i];

			}

			if($buildarray['f'.$i.'t'] == 9) {

				$bakery = $buildarray['f'.$i];

			}

		}

		$q = "SELECT type FROM `odata` WHERE `conqured` = :W";

        $p=array('W'=>$wref);

		$oasis = $this->query($q,$p);

		foreach($oasis as $oa){

			switch($oa['type']) {



				case 3:



					$cropo += 1;

					break;

				case 6:

               $cropo += 1;

					break;



				case 9:



					$cropo += 1;

					break;

				case 10:

				case 11:

					$cropo += 1;

					break;

				case 12:

					$cropo += 2;

					break;

			}

		}

		for($i=0;$i<=count($cropholder)-1;$i++) {

			$basecrop+= $bid4[$buildarray[$cropholder[$i]]]['prod'];

		}

		$crop =  $basecrop * 0.25 * $cropo;

		if($grainmill >= 1 || $bakery >= 1) {

			$crop += $basecrop /100 * ($bid8[$grainmill]['attri'] + $bid9[$bakery]['attri']);

		}

		if($bonus > time()) {

			$crop *= 1.25;

		}

		$crop *= SPEED;



		return $crop;

	}

    //inСЕ ФУНКЦИИ СinЯЗАННЫЕ С ГЕРОЕМ

    function getHeroRanking() {



        $q = "SELECT h.level,h.experience,h.uid,u.username FROM hero as h LEFT JOIN users as u ON u.id=h.uid WHERE h.dead = 0 ORDER BY h.experience DESC";

        return $this->query($q);

    }

//герой

    function getHeroData($uid) {

        $p=array('U'=> $uid);

        $q = "SELECT * FROM hero WHERE uid = :U";

        return $this->row($q,$p);

    }



    function getHeroData2($uid) {

        $p=array('U'=> $uid);

        $q = "SELECT * FROM hero WHERE dead = 0 and uid = :U";

        return $this->row($q,$p);

    }



    function getHeroData3($uid) {

        $p=array('U'=> $uid);

        $q = "SELECT * FROM hero WHERE dead = 0 and hide = 0 and uid = :U";

        return $this->row($q,$p);

    }

    function HeroFace($uid) {

        $p=array('U'=> $uid);

        $q = "SELECT * FROM heroface WHERE uid = :U";

        return $this->row($q,$p);

    }



    function addHeroFace($uid, $bread, $ear, $eye, $eyebrow, $face, $hair, $mouth, $nose, $color) {



        $q = "INSERT INTO `heroface` (`id`,`uid`,`beard`, `ear`, `eye`, `eyebrow`, `face`, `hair`, `mouth`, `nose`, `color`, `foot`, `helmet`, `horse`, `leftHand`, `rightHand`) VALUES (0,'".$uid."','".$bread."', '".$ear."', '".$eye."', '".$eyebrow."', '".$face."', '".$hair."', '".$mouth."', '".$nose."', '".$color."', '0', '0', '0', '0', '0')";

        return $this->query($q);

    }



    function modifyHeroFace($uid,$column,$value) {

        $p=array('V'=>$value,'U'=>$uid);

        $q = "UPDATE heroface SET $column = :V WHERE `uid` = :U";

        return $this->query($q,$p);

    }

    function addHeroItem($uid, $btype, $type, $num,$proc=0) {

        $p=array('U'=>$uid,'B'=>$btype,'T'=>$type,'N'=>$num,'P'=>$proc);

        $q = "INSERT INTO heroitems (`uid`, `btype`, `type`, `num`, `proc`) VALUES (:U, :B, :T, :N, :P)";

        $this->query($q,$p);

        return $this->get_last_id();

    }



    function checkHeroItem($uid, $btype){

        $q = "SELECT * FROM heroitems WHERE `uid` = :U and `btype` = :B and proc = 0";

        $p=array('U'=>$uid,'B'=>$btype);

        $dbarray = $this->row($q,$p);

        if($dbarray['btype']==$btype) {

            return $dbarray['id'];

        } else {

            return false;

        }

    }

    function addHero($uid){

        //нет смысла защищать и хэш in пизду

        $time = time();

        $q = "INSERT into hero (`uid`, `wref`, `level`, `speed`, `points`, `experience`, `dead`, `health`, `power`, `offBonus`, `defBonus`, `product`, `r0`, `autoregen`, `lastupdate`, `lastadv`, `hash`) values

('".$uid."', 0, 0, '10', 0, '2', 0, '100', '0', 0, 0, '4', '1', '10', '".$time."', '".$time."', '')";

        return $this->query($q);

    }

    function addHeroinventory($uid){

        $p=array('U'=> $uid);

        $q = "INSERT into heroinventory (`uid`) values (:U)";

        return $this->query($q,$p);

    }



    function getItemData($id) {
		if($id){
			$p=array('I'=>$id);
			$q = $this->row("SELECT * FROM heroitems WHERE id = :I",$p);

			return count($q)?$q:array();
		}
        return array();

    }

    function setHeroInventory($uid, $field, $value) {

        $p=array('U'=>$uid,'V'=>$value);

        $this->query("UPDATE heroinventory set $field = :V where `uid` = :U",$p);

    }



    function editProcItem($id, $mode,$uid) {

        $p=array('I'=>$id,'U'=>$uid);

        if($mode==0){

            $q = "UPDATE heroitems set proc = 0 where `id` = :I and `uid`=:U";

        }else{

            $q = "UPDATE heroitems set proc = 1 where `id` = :I and `uid`=:U";

        }

        return $this->query($q,$p);

    }

    function modifyHero2($column,$value,$uid,$mode) {

        $p=array('U'=>$uid);

        if(!$mode){

            $q = "UPDATE hero SET $column = $value WHERE `uid` = :U";

        } elseif($mode==1){

            $q = "UPDATE hero SET $column = $column + $value WHERE `uid` = :U";

        } elseif($mode==2){

            $q = "UPDATE hero SET $column = $column - $value WHERE `uid` = :U";

        }

        return $this->query($q,$p);

    }

    function editHeroNum($id, $num, $mode) {

        $p=array('I'=>$id);

        if($mode==0){

             $q = "UPDATE heroitems set num = num - $num where `id` = :I and proc = 0";

        }elseif($mode==1){

             $q = "UPDATE heroitems set num = num + $num where `id` = :I and proc = 0";

        }else{

             $q = "UPDATE heroitems set num = $num where `id` = :I and proc = 0";

        }

        return $this->query($q,$p);

    }

    function editHeroNum2($id, $num) {

        $p=array('I'=>$id);

            $q = "UPDATE heroitems set num = num - $num where id = :I";

        return $this->query($q,$p);

    }



    function editHeroType($id, $type, $mode) {

        $p=array('I'=>$id);

        if($mode==0){

               $q = "UPDATE heroitems set type = type - $type where `id` = :I";

        }elseif($mode==1){

               $q = "UPDATE heroitems set type = type + $type where `id` = :I";

        }else{

               $q = "UPDATE heroitems set type = $type where `id` = :I";

        }

        return $this->query($q,$p);

    }

    function getHeroItemID2($uid, $btype, $type) {

        $p=array('U'=>$uid,'B'=>$btype,'T'=>$type);

        return $this->row("SELECT * FROM heroitems where `uid` = :U AND `btype` = :B AND `type` = :T",$p);



    }



    function getHeroInventory($uid) {

        $p=array('U'=> $uid);

        $q = "SELECT * FROM heroinventory WHERE uid = :U";

        return $this->row($q,$p);

    }





    function herface(){
		global $session;
		
        $size =  '64x82';
        $herodetail = $session->heroD;
        if($herodetail['color']==0){$color = "black";}
        if($herodetail['color']==1){$color = "brown";}
        if($herodetail['color']==2){$color = "darkbrown";}
        if($herodetail['color']==3){$color = "yellow";}
        if($herodetail['color']==4){$color = "red";}

        $geteye = $herodetail['eye'];
        $geteyebrow = $herodetail['eyebrow'];
        $getnose = $herodetail['nose'];
        $getear = $herodetail['ear'];
        $getmouth = $herodetail['mouth'];
        $getbeard = $herodetail['beard'];
        $gethair = $herodetail['hair'];
        $getface = $herodetail['face'];
		$gender = $herodetail['gender']; if ($gender==0) {$gdir='male';} else {$gdir='female';}
		
		@mkdir('hcache/'.$size.'/'); //
        $herohash=$geteye.$geteyebrow.$getnose.$getear.$getmouth.$getbeard.$gethair.$getface.$gender.$herodetail['color'];
        $herofd='hcache/'.$size.'/'.$herohash.'.png';
        if(!file_exists($herofd)){
            $body = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/face0.png');
            if($getbeard!=5 && $gender==0){
                $beard = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/beard/beard'.$getbeard.'-'.$color.'.png');
            }
            $eye = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/eye/eye'.$geteye.'.png');
            $eyebrow = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/eyebrow/eyebrow'.$geteyebrow.(($gender==0)?'-'.$color:'').'.png');
            $hair = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/hair/hair'.$gethair.'-'.$color.'.png');
            $ear = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/ear/ear'.$getear.'.png');
            $mouth = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/mouth/mouth'.$getmouth.'.png');
            $nose = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/nose/nose'.$getnose.'.png');
            $face = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/face/face'.$getface.'.png');
            imagecopy($body, $face, 0, 0, 0, 0, imagesx($face), imagesy($face));
            imagecopy($body, $ear, 0, 0, 0, 0, imagesx($ear), imagesy($ear));
            imagecopy($body, $eye, 0, 0, 0, 0, imagesx($eye), imagesy($eye));
            imagecopy($body, $eyebrow, 0, 0, 0, 0, imagesx($eyebrow), imagesy($eyebrow));
            imagecopy($body, $hair, 0, 0, 0, 0, imagesx($hair), imagesy($hair));
            imagecopy($body, $mouth, 0, 0, 0, 0, imagesx($mouth), imagesy($mouth));
            imagecopy($body, $nose, 0, 0, 0, 0, imagesx($nose), imagesy($nose));
            if($getbeard!=5 && $gender==0){
                imagecopy($body, $beard, 0, 0, 0, 0, imagesx($beard), imagesy($beard));
            }
            imagesavealpha($body, true);
            imagepng($body, $herofd);
            imagedestroy($body);

        }
        return $herofd;

    }

    function heroBody($uid=""){

        if(empty($uid)){

            $uid = 1;

        }

        $herodetail = $this->HeroFace($uid);





        $gender = $herodetail['gender'];

        $size = "330x422";

        $fsize = '64x82';

        if($gender==1){

                $w = 166;

                $h = 51;

            $gdir='female';

        }else {

                $w = 163;

                $h = 37;

            $gdir='male';



        }

        unset($herodetail['bag']);

        $herohash=md5(implode(',',$herodetail));

        @mkdir('hcache/body/');

        @mkdir('hcache/body/'.$size.'/');

        if($this->count_files('hcache/body/'.$size.'/')>MAX_FILESH){

            $folder='hcache/body/'.$size.'/';

            unset($folder);

            @mkdir('hcache/body/');

            @mkdir('hcache/body/'.$size.'/');

        }

        $herofd='hcache/body/'.$size.'/'.$herohash.'.png';

        if(!file_exists($herofd)){

     //   if(1){

        if($herodetail['color']==0){

            $color = "black";

        }

        if($herodetail['color']==1){

            $color = "brown";

        }

        if($herodetail['color']==2){

            $color = "darkbrown";

        }

        if($herodetail['color']==3){

            $color = "yellow";

        }

        if($herodetail['color']==4){

            $color = "red";

        }

        $geteye = $herodetail['eye'];

        $geteyebrow = $herodetail['eyebrow'];

        $getnose = $herodetail['nose'];

        $getear = $herodetail['ear'];

        $getmouth = $herodetail['mouth'];

        $getbeard = $herodetail['beard'];

        $gethair = $herodetail['hair'];

        $getface = $herodetail['face'];



        $getfoot = $herodetail['foot'];

        $getbody = $herodetail['body'];

        $gethelmet = $herodetail['helmet'];

        $gethorse = $herodetail['horse'];

        $getleftHand = $herodetail['leftHand'];

        $getrightHand = $herodetail['rightHand'];





// HERO FACE:

            $face0 = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$fsize.'/face0.png');

            if($getbeard!=5 && $gender==0){

                $beard = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$fsize.'/beard/beard'.$getbeard.'-'.$color.'.png');

            }

            $eye = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$fsize.'/eye/eye'.$geteye.'.png');

            $eyebrow = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$fsize.'/eyebrow/eyebrow'.$geteyebrow.(($gender==0)?'-'.$color:'').'.png');



                $hair = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$fsize.'/hair/hair'.$gethair.'-'.$color.'.png');





            $ear = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$fsize.'/ear/ear'.$getear.'.png');

            $mouth = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$fsize.'/mouth/mouth'.$getmouth.'.png');

            $nose = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$fsize.'/nose/nose'.$getnose.'.png');

            $face = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$fsize.'/face/face'.$getface.'.png');







// SAME COMMANDS:



            imagecopy($face0, $face, 0, 0, 0, 0, imagesx($face), imagesy($face));

            imagecopy($face0, $ear, 0, 0, 0, 0, imagesx($ear), imagesy($ear));

            imagecopy($face0, $eye, 0, 0, 0, 0, imagesx($eye), imagesy($eye));

            imagecopy($face0, $eyebrow, 0, 0, 0, 0, imagesx($eyebrow), imagesy($eyebrow));

            if($gender==1){

                imagecopy($face0, $hair, 0, 0, 0, 0, imagesx($hair), imagesy($hair));

            }

            imagecopy($face0, $mouth, 0, 0, 0, 0, imagesx($mouth), imagesy($mouth));

            imagecopy($face0, $nose, 0, 0, 0, 0, imagesx($nose), imagesy($nose));

            if($getbeard!=5 && $gender==0){

                imagecopy($face0, $beard, 0, 0, 0, 0, imagesx($beard), imagesy($beard));

            }





            if($gethelmet>=1 && $gethelmet<=3){

                $helmet = '0_'.($gethelmet-1);

            }elseif($gethelmet>=4 && $gethelmet<=6){

                $helmet = '1_'.($gethelmet-4);

            }elseif($gethelmet>=7 && $gethelmet<=9){

                $helmet = '2_'.($gethelmet-7);

            }elseif($gethelmet>=10 && $gethelmet<=12){

                $helmet = '3_'.($gethelmet-10);

            }elseif($gethelmet>=13 && $gethelmet<=15){

                $helmet = '4_'.($gethelmet-13);

            }



            if($getbody>=82 && $getbody<=84){

                $armor = '0_'.($getbody-82);

            }elseif($getbody>=85 && $getbody<=87){

                $armor = '1_'.($getbody-85);

            }elseif($getbody>=88 && $getbody<=90){

                $armor = '2_'.($getbody-88);

            }elseif($getbody>=91 && $getbody<=93){

                $armor = '3_'.($getbody-91);

            }



            if($getfoot>=94 && $getfoot<=96){

                $shoes = '0_'.($getfoot-94);

            }elseif($getfoot>=97 && $getfoot<=99){

                $shoes = '1_'.($getfoot-97);

            }elseif($getfoot>=100 && $getfoot<=102){

                $shoes = '2_'.($getfoot-100);

            }



            if($getleftHand==0){

                $leftHand = 'leftHand';

            }elseif($getleftHand>=61 && $getleftHand<=63){

                $leftHand = 'map0';

            }elseif($getleftHand>=64 && $getleftHand<=66){

                $leftHand = 'flag0';

            }elseif($getleftHand>=67 && $getleftHand<=69){

                $leftHand = 'flag1';

            }elseif($getleftHand>=73 && $getleftHand<=75){

                $leftHand = 'sack0';

            }elseif($getleftHand>=76 && $getleftHand<=78){

                $leftHand = 'shield0';

            }elseif($getleftHand>=79 && $getleftHand<=81){

                $leftHand = 'horn0';

            }

			switch ($getrightHand) {
				case 0:
					$rightHand = 'rightHand';
					break;
				case 16:
				case 17:
				case 18:
					$rightHand = 'sword0';
					break;
				case 19:
				case 20:
				case 21:
					$rightHand = 'sword1';
					break;
				case 22:
				case 23:
				case 24:
					$rightHand = 'sword2';
					break;
				case 25:
				case 26:
				case 27:
					$rightHand = 'sword3';
					break;
				case 28:
				case 29:
				case 30:
					$rightHand = 'lance0';
					break;
				case 31:
				case 32:
				case 33:
					$rightHand = 'spear0';
					break;
				case 34:
				case 35:
				case 36:
					$rightHand = 'sword4';
					break;
				case 37:
				case 38:
				case 39:
					$rightHand = 'bow0';
					break;
				case 40:
				case 41:
				case 42:
					$rightHand = 'staff0';
					break;
				case 43:
				case 44:
				case 45:
					$rightHand = 'spear1';
					break;
				case 46:
				case 47:
				case 48:
					$rightHand = 'club0';
					break;
				case 49:
				case 50:
				case 51:
					$rightHand = 'spear2';
					break;
				case 52:
				case 53:
				case 54:
					$rightHand = 'axe0';
					break;
				case 55:
				case 56:
				case 57:
					$rightHand = 'hammer0';
					break;
				case 58:
				case 59:
				case 60:
					$rightHand = 'sword5';
					break;
		
				case 115:
				case 116:
				case 117:
				$rightHand = 'club1';
				break;
				case 118:
				case 119:
				case 120:
				$rightHand = 'axe1';
				break;
				case 121:
				case 122:
				case 123:
				$rightHand = 'sword6';
				break;
				case 124:
				case 125:
				case 126:
				$rightHand = 'spear3';
				break;
				case 127:
				case 128:
				case 129:
				$rightHand = 'bow1';
				break;
		
				case 130:
				case 131:
				case 132:
				$rightHand = 'axe2';
				break;
				case 133:
				case 134:
				case 135:
				$rightHand = 'bow2';
				break;
				case 136:
				case 137:
				case 138:
				$rightHand = 'sword7';
				break;
				case 139:
				case 140:
				case 141:
				$rightHand = 'bow3';
				break;
				case 142:
				case 143:
				case 144:
				$rightHand = 'sword8';
				break;
				
		
				}


		
/*
            if($getrightHand==0){

                $rightHand = 'rightHand';

            }elseif($getrightHand>=16 && $getrightHand<=18){

                $rightHand = 'sword0';

            }elseif($getrightHand>=19 && $getrightHand<=21){

                $rightHand = 'sword1';

            }elseif($getrightHand>=22 && $getrightHand<=24){

                $rightHand = 'sword2';

            }elseif($getrightHand>=25 && $getrightHand<=27){

                $rightHand = 'sword3';

            }elseif($getrightHand>=28 && $getrightHand<=30){

                $rightHand = 'lance0';

            }elseif($getrightHand>=31 && $getrightHand<=33){

                $rightHand = 'spear0';

            }elseif($getrightHand>=34 && $getrightHand<=36){

                $rightHand = 'sword4';

            }elseif($getrightHand>=37 && $getrightHand<=39){

                $rightHand = 'bow0';

            }elseif($getrightHand>=40 && $getrightHand<=42){

                $rightHand = 'staff0';

            }elseif($getrightHand>=43 && $getrightHand<=45){

                $rightHand = 'spear1';

            }elseif($getrightHand>=46 && $getrightHand<=48){

                $rightHand = 'club0';

            }elseif($getrightHand>=49 && $getrightHand<=51){

                $rightHand = 'spear2';

            }elseif($getrightHand>=52 && $getrightHand<=54){

                $rightHand = 'axe0';

            }elseif($getrightHand>=55 && $getrightHand<=57){

                $rightHand = 'hammer0';

            }elseif($getrightHand>=58 && $getrightHand<=60){
                $rightHand = 'sword5';
            }

*/



// HERO BODY:

            $body2 = imagecreatefrompng('img/hero/'.$gdir.'/body/'.$size.'/hero_body0.png');

            if($gethorse!=0){

                $body = imagecreatefrompng('img/hero/'.$gdir.'/body/'.$size.'/horse0.png');

                imagecopy($body, $body2, 0, 0, 0, 0, imagesx($body2), imagesy($body2));

            }else{

                $body = imagecreatefrompng('img/hero/'.$gdir.'/body/'.$size.'/hero_body0.png');

            }

            imagecopy($body, $body, 0, 0, 0, 0, imagesx($body), imagesy($body));





            if($gethelmet!=0){

                $helmet = imagecreatefrompng('img/hero/'.$gdir.'/body/'.$size.'/helmet'.$helmet.'.png');

            }

            if($getbody!=0){

                $armor = imagecreatefrompng('img/hero/'.$gdir.'/body/'.$size.'/shirt'.$armor.'.png');

            }

            $leftHand = imagecreatefrompng('img/hero/'.$gdir.'/body/'.$size.'/'.$leftHand.'.png');

            $rightHand = imagecreatefrompng('img/hero/'.$gdir.'/body/'.$size.'/'.$rightHand.'.png');

            if(isset($shoes)){

                $shoes = imagecreatefrompng('img/hero/'.$gdir.'/body/'.$size.'/shoes'.$shoes.'.png');

            }













        imagecopy($body, $face0, $w, $h, 0, 0, imagesx($face0), imagesy($face0));



        imagecopy($body, $face, $w, $h, 0, 0, imagesx($face), imagesy($face));

        imagecopy($body, $ear, $w, $h, 0, 0, imagesx($ear), imagesy($ear));

        imagecopy($body, $eye, $w, $h, 0, 0, imagesx($eye), imagesy($eye));

        imagecopy($body, $eyebrow, $w, $h, 0, 0, imagesx($eyebrow), imagesy($eyebrow));

        if($gethair!=5){

            imagecopy($body, $hair, $w, $h, 0, 0, imagesx($hair), imagesy($hair));

        }

        imagecopy($body, $mouth, $w, $h, 0, 0, imagesx($mouth), imagesy($mouth));

        imagecopy($body, $nose, $w, $h, 0, 0, imagesx($nose), imagesy($nose));

        if($getbeard!=5 && $gender==0){

            imagecopy($body, $beard, $w, $h, 0, 0, imagesx($beard), imagesy($beard));

        }















            if($armor!=0){

                imagecopy($body, $armor, 0, 0, 0, 0, imagesx($armor), imagesy($armor));

            }



        if($getfoot!=0){

            imagecopy($body, $shoes, 0, 0, 0, 0, imagesx($shoes), imagesy($shoes));

        }

        imagecopy($body, $rightHand, 0, 0, 0, 0, imagesx($rightHand), imagesy($rightHand));

        imagecopy($body, $leftHand, 0, 0, 0, 0, imagesx($leftHand), imagesy($leftHand));

        if($gethelmet!=0){

            imagecopy($body, $helmet, 0, 0, 0, 0, imagesx($helmet), imagesy($helmet));

        }





// OUTPUT IMAGE:

       // header("Content-Type: image/png");

        imagesavealpha($body, true);

        imagepng($body, $herofd);

            imagedestroy($body);

           // imagepng($body, null);

    }

        return $herofd;

    }







    function editEbaloHero($uid, $beard, $ear, $eye, $eyebrow, $face, $hair, $mouth, $nose, $color){

        $p=array('U'=>$uid,'B'=>$beard,'EA'=>$ear,'EY'=>$eye,'EYW'=>$eyebrow,'F'=>$face,'H'=>$hair,'M'=>$mouth,'N'=>$nose,'C'=>$color);

        $this->query("UPDATE heroface SET `beard`=:B, `ear`=:EA, `eye`=:EY, `eyebrow`=:EYW, `face`=:F, `hair`=:H, `mouth`=:M, `nose` =:N,`color`=:C WHERE `uid` = :U",$p);

    }

    function getBattleHer($uid) {

        $heroarray = $this->getHero($uid);

        $h_atk = $heroarray['power']*100+$heroarray['itempower'];

        $h_di = $heroarray['power']*100+$heroarray['itempower'];

        $h_dc = $heroarray['power']*100+$heroarray['itempower'];

        $h_ob = 1 + 0.002 * $heroarray['offBonus'];

        $h_db = 1 + 0.002 * $heroarray['defBonus'];



        return array('heroid'=>$heroarray['heroid'],'atk'=>$h_atk,'di'=>$h_di,'dc'=>$h_dc,'ob'=>$h_ob,'db'=>$h_db,'health'=>$heroarray['health']);

    }



    function getHero($uid) {

        $p=array('U'=>$uid);

         $q = "SELECT * FROM hero WHERE `uid`=:U LIMIT 1";

        return $this->row($q,$p);



    }

    function getHeroA() {



        $q = "SELECT * FROM hero WHERE `dead`= '0' AND `lastupdate` < '".(time()-10)."'";

        return $this->query($q);



    }

    function getHero2() {



        $q = "SELECT lastupdate,dead,health,heroid,experience,revivetime,wref,uid FROM hero where id > 0";

        $result = $this->query($q);

        if (!empty($result)) {

            return $result;

        } else {

            return NULL;

        }

    }



    function getHeroField($uid){

        $p=array('U'=> $uid);

        $q = "SELECT * FROM hero WHERE uid = :U";

        return $this->query($q,$p);

    }





    function modifyHero($column,$value,$heroid,$mode=0) {

        $p=array('I'=>$heroid);

        if(!$mode) {

            $q = "UPDATE `hero` SET ".$column." = ".$value." WHERE `heroid` = :I";

        } elseif($mode==1) {

            $q = "UPDATE `hero` SET ".$column." = ".$column." + ".$value." WHERE `heroid` = :I";

        } else {

            $q = "UPDATE `hero` SET ".$column." = ".$column." - ".$value." WHERE `heroid` = :I";

        }

        $this->query($q,$p);

    }



    function modifyHeroS($sql,$heroid) {

        $p=array('I'=>$heroid);

        $q = "UPDATE `hero` SET ".$sql." WHERE `heroid` = :I";

        $this->query($q,$p);

    }



    function modifyHeroByOwner($column,$value,$uid,$mode=0) {

        $p=array('U'=>$uid);

        if(!$mode) {

            $q = "UPDATE `hero` SET ".$column." = ".$value." WHERE `uid` = :U";

        } elseif($mode==1) {

            $q = "UPDATE `hero` SET ".$column." = ".$column." + ".$value." WHERE `uid` = :U";

        } else {

            $q = "UPDATE `hero` SET ".$column." = ".$column." - ".$value." WHERE `uid` = :U";

        }

        $this->query($q,$p);

    }



    function modifyHeroXp($column,$value=0,$heroid) {



        if($value){

            $p=array('I'=>$heroid);

            $q = "UPDATE hero SET ".$column." = ".$column." + ".$value." WHERE `uid`=:I";

            $this->query($q,$p);

        }

    }





    function getHeroAlive($id) {

        $p=array('I'=>$id);

        $q = "SELECT dead,revivetime FROM hero WHERE `uid` = :I and `dead` = 0";

        $result = $this->row($q,$p);

        if(empty($result)){return array();}

        return $result;

    }

    function getHeroRevive($uid){

        $p=array('U'=> $uid);

        $q = "SELECT revivetime FROM hero WHERE `revivetime`>'0' `uid` = :U";

        $result = $this->row($q,$p);

        if(empty($result)){return false;}

        return $result;



    }







    function HeroNotInVil($id) {

        $heronum=0;

        $outgoingarray = $this->getMovement(3, $id, 0);

        if(!empty($outgoingarray)) {

            foreach($outgoingarray as $out) {

                $heronum += $out['t11'];

            }

        }

        $returningarray = $this->getMovement(4, $id, 1);

        if(!empty($returningarray)) {

            foreach($returningarray as $ret) {

                if($ret['attack_type'] != 1) {

                    $heronum += $ret['t11'];

                }

            }

        }

        return $heronum;

    }





    function KillMyHero($uid) {

        $p=array('U'=>$uid);

        $q = "UPDATE hero set dead = 1,lastupdate='".time()."',health=0 where uid = :U";

        return $this->query($q,$p);

    }

    function KillHero($hero_id,$health=0,$kill=0){

        $p=array('I'=>$hero_id);

        if(!$kill){

            $this->query("UPDATE hero set `health`= health - ".$health." , `lastupdate`='".time()."' where `heroid`=:I",$p);

        }else{

            $this->query("UPDATE hero set `dead`='1' , `lastupdate`='".time()."' , `health`='0'  where `heroid`=:I",$p);

        }

    }



    function addAdventure($wref, $uid,$count){
        $time = time()+(3600*12); // fazer um teste epico aqui , coloca pra lança aventura a cada 1 min veremos  3600*12
        $xy=$this->row("SELECT x,y FROM wdata where id ='".$wref."'");
        $x=$xy['x'];
        $y=$xy['y'];
        if($x<0 && $x-30>-WORLD_MAX){$xarray=range($x-30,$x+30);}elseif($x<0 && $x-30<-WORLD_MAX){$xarray=range($x,$x+60);}
        if($y<0 && $y-30>-WORLD_MAX){$yarray=range($y-30,$y+30);}elseif($y<0 && $y-30<-WORLD_MAX){$yarray=range($y,$y+60);}
        if($x>=0 && $x+30<WORLD_MAX){$xarray=range($x-30,$x+30);}elseif($x>=0){$xarray=range($x-60,$x);}
        if($y>=0 && $y+30<WORLD_MAX){$yarray=range($y-30,$y+30);}elseif($y>=0){$yarray=range($y-60,$y);}
        $targets=$this->query("SELECT id,x,y,type_of FROM wdata where occupied = '0' and type_of!='' and `x` IN (".implode(",",$xarray).") and `y` IN (".implode(",",$yarray).")  ORDER BY RAND() DESC LIMIT ".$count);

		foreach($targets as $row){

			$ddd = rand(0,3);
			if($ddd == 1){ $dif = 1; }else{ $dif = 0; }
				$w1=$row['id'];

				switch($row['type_of']){
					case 'forest':$type=1;break;
					case 'clay':$type=2;break;
					case 'hill':$type=3;break;
					case 'lake':$type=4;break;
				}
			
				$q = "INSERT into adventure (`wref`, `uid`, `dif`, `time`, `end`,`type`,`x`,`y`) values ('".$w1."', '".$uid."', '".$dif."', '".$time."', 0,'".$type."','".$row['x']."','".$row['y']."')";
				$this->query($q);

		}

    }

    function getAdventure($uid, $wref) {

        $p=array('U'=>$uid,'W'=>$wref);

        $q = "SELECT * FROM adventure WHERE `uid` = :U and `wref` = :W and `end`='0'";

        $result = $this->row($q,$p);

        if(count($result)) {

            return $result;

        } else {

            return false;

        }

    }

    function getHeroItemID($uid, $btype) {

        $p=array('U'=>$uid,'B'=>$btype);

        $q = "SELECT * FROM heroitems where `uid` = :U AND `btype` = :B and `proc` = '0'";

        $dbarray = $this->row($q,$p);



        return count($dbarray)?$dbarray['id']:false;

    }

    function setSilver($uid, $silver, $mode) {

        $p=array('U'=>$uid);

        if(!$mode){

            $q = "UPDATE users set silver = silver - $silver where `id` = :U";

        }else{

            $q = "UPDATE users set silver = silver + $silver where `id` = :U";

        }

         $this->query($q,$p);

    }



    function setNewSilver($id, $newsilver) {

        $p=array('I'=>$id);

        $q = "UPDATE auction set newsilver = '".$newsilver."' where `id` = :I";

        return $this->query($q,$p);

    }



    function getAuctionSilver($uid) {

        $p=array('U'=> $uid);

        $q = "SELECT * FROM auction where uid = :U and finish = 0";

        return $this->row($q,$p);

    }



    function getAuctionData($id) {

        $p=array('I'=>$id);

        $q = "SELECT * FROM auction where id = :I";

        return $this->row($q,$p);

    }



    function delAuction($id) {

        $data = $this->getAuctionData($id);

        $ownerID = $data['owner'];

        $btype = $data['btype'];

            if($btype==7 || $btype==8 || $btype==9 || $btype==10 || $btype==11 || $btype==14 || $btype==15){

                if($this->checkHeroItem($ownerID, $btype)){

                    $this->editHeroNum($this->getHeroItemID($ownerID, $btype), $data['num'], 1);

                }else{



                    $this->addHeroItem($ownerID, $data['btype'], $data['type'], $data['num']);

                }

            }else{

                $this->addHeroItem($ownerID, $data['btype'], $data['type'], $data['num']);

            }

            // $this->editProcItem($data['id'],0,$ownerID);

        $p=array('I'=>$id);

            $q = "DELETE FROM auction where id = :I and finish = 0";



         $this->query($q,$p);

    }



    function getAuctionUser($uid) {

        $p=array('U'=> $uid);

        $q = "SELECT * FROM auction where owner = :U";

        return $this->row($q,$p);

    }



    function addAuction($owner, $itemid, $btype, $type, $amount) {

        $time = time()+AUCTIONTIME;

        $p=array('A'=>$amount);

        if($btype==7 || $btype==8 || $btype==9 || $btype==10 || $btype==11 || $btype==13 || $btype==14){

            $silver = $amount;

            if($btype==7 || $btype==8 || $btype==9){

                $silver*=5;

            }



            $itemData = $this->getItemData($itemid);

            if($amount == $itemData['num']){

                $q = "INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES ('".$owner."', '".$itemid."', '".$btype."', '".$type."', :A, 0, 0, '".$silver."', '".$silver."', '".$time."', 0)";

                $this->editProcItem($itemid, 1,$owner);

            }else{

                $this->editHeroNum($itemid, $amount, 0);

                $q = "INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES ('".$owner."', '".$itemid."', '".$btype."', '".$type."', :A, 0, 0, '".$silver."', '".$silver."', '".$time."', 0)";

                $this->editProcItem($itemid, 0,$owner);

            }

        }else{

            $silver = 100;

            $q = "INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `time`, `finish`)  VALUES ('".$owner."', '".$itemid."', '".$btype."', '".$type."', :A, 0, 0, '".$silver."', '".$time."', 0)";

            $this->editProcItem($itemid, 1,$owner);

        }



         $this->query($q,$p);

    }



    function addBid($id, $uid, $newsilver) {

        $p=array('U'=>$uid,'I'=>$id);

        $q = "UPDATE auction set uid = :U, silver = newsilver + 1, newsilver = '".$newsilver."', bids = bids + 1 where `id` = :I";

         $this->query($q,$p);

    }



    function removeBidNotice($id) {

        $p=array('I'=>$id);

        $q = "DELETE FROM auction where id = :I";

      $this->query($q,$p);

    }

    function editBid($id, $silver) {

        $p=array('S'=>$silver,'I'=>$id);

        $q = "UPDATE auction set `silver` = :S where `id` = :I";

       $this->query($q,$p);

    }



    function checkBid($id, $newsilver){

        $p=array('I'=>$id);

        $q = "SELECT * FROM auction WHERE `id` = :I";

        $dbarray = $this->row($q,$p);

        if($dbarray['newsilver']>=$newsilver) {

            return false;

        } else {

            return true;

        }

    }



    function getBidData($id) {

        $p=array('I'=>$id);

        $q = "SELECT * FROM auction WHERE id = :I";

        return $this->row($q,$p);

    }



    function allHeroBonuses($heroequip){

        $somassive=array('speedb'=>1,'health'=>0,'u1'=>0,'u2'=>0,'u3'=>0,'u4'=>0,'u5'=>0,'u6'=>0,'u7'=>0,'u8'=>0,'u9'=>0,'u10'=>0,'back'=>1,'own'=>1,'ally'=>1,'plunder'=>1,'natarf'=>1,'mhealth'=>0,

    'exp'=>1,'culture'=>0,'barrack'=>1,'stable'=>1);

        if($heroequip['uid']!=3 && $heroequip['uid']){
			unset($heroequip['uid']);



        $array=array();

        foreach($heroequip as $ll){

            $array[]+=$ll;

        }

        $array=implode(",",$array);

        $heroe=$this->query("SELECT * FROM heroitems WHERE id IN (".$array.")");

        foreach($heroe as $info){



            if(isset($info['btype'])){

switch($info['btype']){

    case 1:

        switch($info['type']){

            case 1:

                $somassive['exp']=1.15;

                break;

            case 2:

                $somassive['exp']=1.20;

                break;

            case 3:

                $somassive['exp']=1.25;

                break;

            case 4:

                $somassive['health']+=10;

                break;

            case 5:

                $somassive['health']+=15;

                break;

            case 6:

                $somassive['health']+=20;

                break;

            case 7:

                $somassive['culture']+=100;

                break;

            case 8:

                $somassive['culture']+=400;

                break;

            case 9:

                $somassive['culture']+=800;

                break;

            case 10:

                $somassive['stable']=0.90;

                break;

            case 11:

                $somassive['stable']=0.85;

                break;

            case 12:

                $somassive['stable']=0.80;

                break;

            case 13:

                $somassive['barrack']=0.90;

                break;

            case 14:

                $somassive['barrack']=0.85;

                break;

            case 15:

                $somassive['barrack']=0.8;

                break;

        }

        break;

    case 2:

        switch($info['type']){

            case 82:

                $somassive['health']+=20;

                break;

            case 83:

                $somassive['health']+=30;

                break;

            case 84:

                $somassive['health']+=40;

                break;

            case 85:

                $somassive['health']+=10;

                $somassive['mhealth']+=4;

                break;

            case 86:

                $somassive['health']+=15;

                $somassive['mhealth']+=6;

                break;

            case 87:

                $somassive['health']+=20;

                $somassive['mhealth']+=8;

                break;

            case 91:

                $somassive['health']+=3;

                break;

            case 92:

                $somassive['health']+=4;

                break;

            case 93:

                $somassive['health']+=5;

                break;

        }

        break;

    case 3:

        switch($info['type']){

            case 61:

                $somassive['back']=1.3;

                break;

            case 62:

                $somassive['back']=1.4;

                break;

            case 63:

                $somassive['back']=1.5;

                break;

            case 64:

                $somassive['own']=1.3;

                break;

            case 65:

                $somassive['own']=1.4;

                break;

            case 66:

                $somassive['own']=1.5;

                break;

            case 67:

                $somassive['ally']=1.15;

                break;

            case 68:

                $somassive['ally']=1.20;

                break;

            case 69:

                $somassive['ally']=1.25;

                break;

            case 73:

                $somassive['plunder']=1.1;

                break;

            case 74:

                $somassive['plunder']=1.15;

                break;

            case 75:

                $somassive['plunder']=1.2;

                break;

            case 79:

                $somassive['natarf']=0.8;

                break;

            case 80:

                $somassive['natarf']=0.75;

                break;

            case 81:

                $somassive['natarf']=0.70;

                break;

        }

        break;

    case 4:

        switch($info['type']){
            case 16:
            case 31:
			case 46:
				// iRedux -> new
				case 115:
				case 130:
                $somassive['u1']+=3;
                break;
            case 17:
			case 32:
			case 47:
				case 116:
					case 131:
                $somassive['u1']+=4;
                break;
            case 18:
            case 33:
			case 48:
				case 117:
					case 132:
                $somassive['u1']+=5;
                break;
            case 19:
            case 34:
			case 49:
				case 118:
					case 133:
                $somassive['u2']+=3;
                break;
            case 20:
            case 35:
			case 50:
				case 119:
					case 134:
                $somassive['u2']+=4;
                break;
            case 21:
            case 36:
			case 51:
				case 120:
					case 135:
                $somassive['u2']+=5;
                break;
            case 22:
			case 52:
				case 121:
                $somassive['u3']+=3;
                break;
            case 23:
			case 53:
				case 122:
                $somassive['u3']+=4;
                break;
            case 24:
			case 54:
				case 123:
                $somassive['u3']+=5;
                break;
			case 25:
                $somassive['u5']+=9;
                break;
            case 26:
                $somassive['u5']+=12;
                break;
            case 27:
                $somassive['u5']+=15;
                break;
            case 55:
			case 40:
				case 124:
					case 139:
                $somassive['u5']+=6;
                break;
            case 56:
			case 41:
				case 125:
					case 140:
                $somassive['u5']+=8;
                break;
            case 57:
			case 42:
				case 126:
					case 141:
                $somassive['u5']+=10;
                break;
			case 37:
				case 136:
                $somassive['u4']+=6;
                break;
			case 38:
				case 137:
                $somassive['u4']+=8;
                break;
			case 39:
				case 138:
                $somassive['u4']+=10;
                break;
            case 28:
                $somassive['u6']+=12;
                break;
            case 29:
                $somassive['u6']+=16;
                break;
            case 30:
                $somassive['u6']+=20;
                break;
            case 43:
			case 58:
				case 127:
					case 142:
                $somassive['u6']+=9;
                break;
            case 44:
			case 59:
				case 128:
					case 143:
                $somassive['u6']+=12;
                break;
            case 45:
			case 60:
				case 129:
					case 144:
                $somassive['u6']+=15;

                break;



        }

        break;

    case 5:

        switch($info['type']){

            case 94:

                $somassive['health']+=10;

                break;

            case 95:

                $somassive['health']+=15;

                break;

            case 96:

                $somassive['health']+=20;

                break;

            case 97:

                $somassive['speedb']=1.25;

                break;

            case 98:

                $somassive['speedb']=1.50;

                break;

            case 99:

                $somassive['speedb']=1.75;

                break;



        }

        break;





}

}

            }

        }

return $somassive;



    }





    function NatarAttack($to,$level){
		$wid=$this->single("SELECT wref FROM vdata WHERE `owner`= 3 and `capital`='1'");

        if(SPEED>=8000){$time=10;}else{
            $time=300;
        }
        $mais = 0;//15
        if(SPEED<=100){
            $mais= 5;
            }elseif(SPEED<=365){
                $mais = 7;
            }elseif(SPEED<=800){
                $mais = 12;
            }elseif(SPEED<=9000){
                $mais = 18;
            }else{
                $mais = 51;
            }

        for($i=1;$i<=8;$i++){
            if($i!=4){
                $coef=$level/$i;
                if(SPEED>=1000){
                    $data['u'.$i]=round(300*$coef*$mais);
                }else{
                    $data['u'.$i]=round(250*$coef*$mais);
                }
            }
        }
        $reference = $this->addAttack($wid, $data['u1'], $data['u2'], $data['u3'], 0, $data['u5'], $data['u6'], $data['u7'], $data['u8'], 0, 0, 0, 3, 40, 0, 0, 0);
        $this->addMovement(3, $wid, $to, $reference, time(), ($time + time()));
		$this->insertQueue($reference, 1, time(), ($time + time()));
	}



    //auction blyati

    function auctionComplete() {
        $time = time();
        $q = "SELECT * FROM auction where finish = 0 and time < '".$time."'";
		$dataarray = $this->query($q);
		
        foreach($dataarray as $data) {
            $ownerID = $data['owner'];$biderID = $data['uid'];
            $silver = $data['silver'];$newsilver = $data['newsilver'];
			$btype = $data['btype'];
			
            if($biderID!=0){ // someone put a bid
                if($btype==7 || $btype==8 || $btype==9 || $btype==10 || $btype==11 || $btype==14 || $btype==15){

                    if($this->checkHeroItem($biderID, $btype)){

                        $this->editHeroNum($this->getHeroItemID($biderID, $btype), $data['num'], 1);

                    }else{

                        $this->addHeroItem($biderID, $data['btype'], $data['type'], $data['num']);

                    }

                }else{

                    $this->addHeroItem($biderID, $data['btype'], $data['type'], $data['num']);

                }

                $silver2 = $newsilver - $silver;

                $this->setSilver($ownerID, $silver, 1);

                $this->setSilver($biderID, $silver2, 1);

			}else{ // no bids

				// Fixed by iRedux
				$this->setSilver($ownerID, $silver, 1);
				
				/*if($this->checkHeroItem($ownerID, $btype)){
					$this->editHeroNum($this->getHeroItemID($ownerID, $btype), $data['num']);
				}*/
				/*
                if($btype==7 || $btype==8 || $btype==9 || $btype==10 || $btype==11 || $btype==14 || $btype==15){
                    if($this->checkHeroItem($ownerID, $btype)){
                        $this->editHeroNum($this->getHeroItemID($ownerID, $btype), $data['num'], 1);
                    }else{
                        $this->addHeroItem($ownerID, $data['btype'], $data['type'], $data['num']);
                    }

                }else{
                    $this->addHeroItem($ownerID, $data['btype'], $data['type'], $data['num']);
				}
				*/

               // $this->editProcItem($data['id'],0,$ownerID);

            }

            $q = "UPDATE auction set finish=1 where id = '".$data['id']."'";

            $this->query($q);

        }



    }



    //farmlist

    function getFarmlist($uid){

        $p=array('U'=> $uid);

        $q = "SELECT * FROM farmlist WHERE owner = :U ORDER BY name ASC";

        $dbarray= $this->row($q,$p);



        if($dbarray['id']!=0) {

            return true;

        } else {

            return false;

        }



    }



    function getRaidList($id) {

        $p=array('I'=>$id);

        $q = "SELECT * FROM raidlist WHERE id = :I";

        return $this->row($q,$p);

    }

    function getVilFarmlist($wref){

        $p=array('W'=>$wref);

        $q = "SELECT * FROM farmlist WHERE wref = :W ORDER BY wref ASC";

        $dbarray = $this->row($q,$p);



        if($dbarray['id']!=0) {

            return true;

        } else {

            return false;

        }



    }

    function  getVilUFl($wref,$uid){

        $p=array('U'=>$uid,'W'=>$wref);

    $q = "SELECT * FROM farmlist WHERE `wref` = :W and `owner` = :U";

    return $this->query($q,$p);

    }

    function delFarmList($id, $owner) {

        $p=array('U'=>$owner,'I'=>$id);

        $q = "DELETE FROM farmlist where `id` = :I and `owner` = :U";

        return $this->query($q,$p);

    }





    function delSlotFarm($id) {

        $p=array('I'=>$id);

        $q = "DELETE FROM raidlist where id = :I";

        return $this->query($q,$p);

    }





    function createFarmList($wref, $owner, $name) {

        $p=array('U'=>$owner,'W'=>$wref,'N'=>$name);

        $q = "INSERT INTO farmlist (`wref`, `owner`, `name`) VALUES (:W, :U, :N)";

        return $this->query($q,$p);

    }



    function addSlotFarm($lid, $towref, $x, $y, $distance, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10) {

        $p=array('L'=>$lid,'TO'=>$towref,'X'=>$x,'Y'=>$y,'D'=>$distance,'T1'=>$t1,'T2'=>$t2,'T3'=>$t3,'T4'=>$t4,'T5'=>$t5,'T6'=>$t6,'T7'=>$t7,'T8'=>$t8,'T9'=>$t9,'T10'=>$t10);

        $q = "INSERT INTO raidlist (`lid`, `towref`, `x`, `y`, `distance`, `t1`, `t2`, `t3`, `t4`, `t5`, `t6`, `t7`, `t8`, `t9`, `t10`) VALUES (:L, :TO, :X, :Y, :D, :T1, :T2, :T3, :T4, :T5, :T6, :T7, :T8, :T9, :T10)";

        return $this->query($q,$p);

    }



    function editSlotFarm($eid, $lid, $wref, $x, $y, $dist, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10) {

        $p=array('L'=>$lid,'E'=>$eid,'W'=>$wref,'X'=>$x,'Y'=>$y,'D'=>$dist,'T1'=>$t1,'T2'=>$t2,'T3'=>$t3,'T4'=>$t4,'T5'=>$t5,'T6'=>$t6,'T7'=>$t7,'T8'=>$t8,'T9'=>$t9,'T10'=>$t10);

        $q = "UPDATE raidlist set `lid` = :L, `towref` = :W, `distance` = :D, `x` = :X, `y` = :Y, t1 = :T1, t2 = :T2, t3 = :T3, t4 = :T4, t5 = :T5, t6 = :T6, t7 = :T7, t8 = :T8, t9 = :T9, t10 = :T10 WHERE `id` = :E";

        return $this->query($q,$p);



    }

    function FPG($data,$set){

        if(isset($data[$set]) && !is_numeric($data[$set])){ die("Ты что,ХаЦкер?:О");}

    }



    function getFLData($id) {

        $p=array('I'=>$id);

        $q = "SELECT * FROM farmlist where id = :I";

        return $this->row($q,$p);

    }

    function getUserInfoByfl($vid) //функ

    {

        $p=array('V'=>$vid,'V1'=>$vid,'V2'=>$vid);

        $q = "SELECT u.access,w.x,w.y,w.occupied,u.regtime,u.protect,u.id FROM (((
        wdata as w

        LEFT JOIN vdata as v ON v.wref = :V)



        LEFT JOIN odata as o ON o.wref = :V1)

        LEFT JOIN users as u ON u.id = IF(v.owner IS NULL, o.owner,v.owner))

        WHERE w.id = :V2";



        return $this->row($q,$p);

    }



// торгоinые пути



    function createTradeRoute($uid,$wid,$from,$r1,$r2,$r3,$r4,$start,$deliveries,$merchant,$time,$tribe,$timetogo) {

        $p=array('U'=>$uid,'W'=>$wid,'F'=>$from,'R1'=>$r1,'R2'=>$r2,'R3'=>$r3,'R4'=>$r4,'S'=>$start,'D'=>$deliveries,'M'=>$merchant,'T'=>$time,'TR'=>$tribe,'TI'=>$timetogo);

        $q = "INSERT into route values (0,:U,:W,:F,:R1,:R2,:R3,:R4,:S,:TR,:D,:M,:T,:TI)";

        return $this->query($q,$p);

    }

    function updateTradeRoute($id,$w,$c,$i,$cr,$start,$del,$merch){

        $p = array('W'=>$w,'C'=>$c,'I'=>$i,'CR'=>$cr,'S'=>$start,'D'=>$del,'M'=>$merch,'ID'=>$id);

        $q = "UPDATE route set `wood`=:W,`clay`=:C,`iron`=:I,`crop`=:CR,`start`=:S,`deliveries`=:D,`merchant`=:M where `id` = :ID";

        $this->query($q,$p);

    }



    function getTradeRoute($uid) {

        $p=array('U'=> $uid);

        $q = "SELECT * FROM route where uid = :U ORDER BY timestamp ASC";

        return $this->query($q,$p);

    }



    function getTradeRoute2($id) {

        $p=array('I'=>$id);

        $q = "SELECT * FROM route where id = :I";

       return $this->row($q,$p);

    }



    function getTradeRouteUid($id) {

        $p=array('I'=>$id);

        $q = "SELECT uid FROM route where id = :I";

        return $this->single($q,$p);

    }



    function editTradeRoute($id,$column,$value,$mode) {

        $p=array('I'=>$id);

        if(!$mode){

            $q = "UPDATE route set $column = $value where `id` = :I";

        }else{

            $q = "UPDATE route set $column = $column + $value where `id` = :I";

        }

        return $this->query($q,$p);

    }



    function deleteTradeRoute($id) {

        $p=array('I'=>$id);

        $q = "DELETE FROM route where id = :I";

        return $this->query($q,$p);

    }



    function starvationReinf($vilinfo) {



        $userinfo=$this->row("SELECT b1,b2,b3,b4,tribe,id,lastupdate as lastup FROM users WHERE `id` = '".$vilinfo['owner']."'");

        $procinf=$this->processStarvation($vilinfo,$userinfo);

        if($procinf[1]['cropp']<0 && $procinf[0][3]<0  && $vilinfo['owner']>3){

            $skolko=round($procinf[0][3]);

            $killunits=0;

            $reinfthere=$reinfthereo=$reinfthereo1=$reinfthere1=1;



            if($skolko<0){

while($skolko<0){

            // get enforce other player from oasis

    if($reinfthereo1){ $reinfthereo1 = false;

            $q = "SELECT e.*,o.conqured,o.wref, o.owner as ownero, v.owner as ownerv FROM enforcement as e LEFT JOIN odata as o ON e.vref=o.wref LEFT JOIN vdata as v ON e.from=v.wref where o.conqured='".$vilinfo['wref']."' AND o.owner<>v.owner";

            $enforceoasis = $this->query($q);

    }else{$enforceoasis = array();}

            $maxcount=0;

            $totalunits=0;



            if(count($enforceoasis)>0){



                foreach ($enforceoasis as $enforce){

                    $tribe=$this->getUserField($enforce['ownerv'],'tribe',0);

                    for($i=1;$i<=10;$i++){

                        $uni=($tribe-1)*10+$i;

                        if($enforce['u'.$i] > $maxcount){



                            $maxcount = $enforce['u'.$i];

                            $maxtype = $i;

                            $maxutype=$uni;

                            $enf = $enforce['id'];

                        }

                        $totalunits += $enforce['u'.$i];

                    }

                    if($totalunits == 0 && $enforce['u11']>0){

                        $maxcount = $enforce['u11'];

                        $maxtype = "hero";

                    }

                    $reinfthereo1=true;

                }

            }else{ //own troops from oasis

                if($reinfthereo){ $reinfthereo = true;

            $q = "SELECT e.*,o.conqured,o.wref, o.owner as ownero, v.owner as ownerv FROM enforcement as e LEFT JOIN odata as o ON e.vref=o.wref LEFT JOIN vdata as v ON e.from=v.wref where o.conqured='".$vilinfo['wref']."' AND o.owner=v.owner";

                $enforceoasis = $this->query($q);

                }else{$enforceoasis = array();}

                if(count($enforceoasis)>0){



                    foreach ($enforceoasis as $enforce){

                        $tribe=$this->getUserField($enforce['ownerv'],'tribe',0);

                        for($i=1;$i<=10;$i++){

                            $uni=($tribe-1)*10+$i;

                            if($enforce['u'.$i] > $maxcount){

                                $maxcount = $enforce['u'.$i];

                                $maxtype = $i;

                                $maxutype = $uni;

                                $enf = $enforce['id'];

                            }

                            $totalunits += $enforce['u'.$i];

                        }

                        if($totalunits == 0 && $enforce['u11']>0){

                            $maxcount = $enforce['u11'];

                            $maxutype = "hero";

                            $maxtype = 11;

                        }

                        $reinfthereo=true;

                    }

                }else{ //get enforce other player from village

                    if($reinfthere1){ $reinfthere1 = false;

                    $q = "SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM enforcement as e LEFT JOIN vdata as v ON e.from=v.wref LEFT JOIN vdata as v1 ON e.vref=v1.wref where e.vref='".$vilinfo['wref']."' AND v.owner<>v1.owner";

                    $enforcearray = $this->query($q);

                    }else{$enforcearray = array();}

                    if(count($enforcearray)>0){

                        foreach ($enforcearray as $enforce){

                            $tribe=$this->getUserField($enforce['ownerv'],'tribe',0);

                            for($i=1;$i<=10;$i++){

                                $uni=($tribe-1)*10+$i;

                                if($enforce['u'.$i] > $maxcount){

                                    $maxcount = $enforce['u'.$i];

                                    $maxtype = $i;

                                    $maxutype = $uni;

                                    $enf = $enforce['id'];

                                }

                                $totalunits += $enforce['u'.$i];

                            }

                            if($totalunits == 0 && $enforce['u11']>0){

                                $maxcount = $enforce['u11'];

                                $maxutype = "hero";

                                $maxtype = 11;

                            }

                            $reinfthere1=true;

                        }

                    }else{ //get own reinforcement from other village

                        if($reinfthere){ $reinfthere = false;

                        $q = "SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM enforcement as e LEFT JOIN vdata as v ON e.from=v.wref LEFT JOIN vdata as v1 ON e.vref=v1.wref where e.vref='".$vilinfo['wref']."' AND v.owner=v1.owner";

                        $enforcearray = $this->query($q);

                        }else{$enforcearray = array();}

                        if(count($enforcearray)>0){

                            foreach ($enforcearray as $enforce){

                                $tribe=$this->getUserField($enforce['ownerv'],'tribe',0);

                                for($i=1;$i<=10;$i++){

                                    $uni=($tribe-1)*10+$i;

                                    if($enforce['u'.$i] > $maxcount){

                                        $maxcount = $enforce['u'.$i];

                                        $maxtype = $i;

                                        $maxutype = $uni;

                                        $enf = $enforce['id'];

                                    }

                                    $totalunits += $enforce['u'.$i];

                                }

                                if($totalunits == 0 && $enforce['u11']>0){

                                    $maxcount = $enforce['u11'];

                                    $maxutype = "hero";

                                    $maxtype = 11;

                                }

                                $reinfthere=true;

                            }

                        }else{ //get own unit

                            $unitarray = $this->getUnit($vilinfo['wref']);



                            for($i=1;$i<=10;$i++){

                                $uni=($userinfo['tribe']-1)*10+$i;

                                if($unitarray['u'.$i] > $maxcount){

                                    $maxcount = $unitarray['u'.$i];

                                    $maxtype = $i;

                                    $maxutype = $uni;

                                }

                                $totalunits += $unitarray['u'.$i];

                            }

                            if($totalunits == 0){

                                $maxcount = $unitarray['u11'];

                                $maxutype = "hero";

                                $maxtype = 11;

                            }

                        }

                    }

                }

            }



            // counting



            $golod = false;

            if($skolko<0){$golod=true;}

            if($golod){

                $difcrop = abs($skolko); //crop eat up over time

                $oldcrop = $skolko;



                if($difcrop > 0){



                    global ${'u'.$maxutype};

                    $hungry=${'u'.$maxutype};



                    if ($hungry['crop']>0 && $oldcrop <0) {



                        $killunits = round($difcrop/$hungry['crop']);

                    }else{ $killunits=0;}



                    if($killunits > 0){



                        if (isset($enf)){

                            if($killunits < $maxcount){



                                $this->modifyEnforce($enf, array($maxtype), array($killunits), 0);

                                if($maxutype == "hero"){

                                    $uid = $this->getVillageField($enf,"owner");

                                    $this->modifyHeroByOwner("dead", 1, $uid);

                                }

                            }else{

                                $killunits = $maxcount;

                                $this->modifyEnforce($enf, array($maxtype), array($killunits), 0);

                                $this->checkReinf($enf);

                                if($maxutype == "hero"){

                                    $uid = $this->getVillageField($enf,"owner");

                                    $this->modifyHeroByOwner("dead", 1, $uid);

                                }

                            }

                        }else{

                            if($killunits < $maxcount){



                                $this->modifyUnit($vilinfo['wref'], array($maxtype), array($killunits), 0);

                                if($maxutype == "hero"){

                                    $this->modifyHeroByOwner("dead", 1, $vilinfo['owner']);

                                }

                            }elseif($killunits > $maxcount){

                                $killunits = $maxcount;

                                $this->modifyUnit($vilinfo['wref'], array($maxtype), array($killunits), 0);

                                if($maxutype == "hero"){

                                    $this->modifyHeroByOwner("dead", 1, $vilinfo['owner']);

                                }

                            }

                        }

                    }

                    $crop=$killunits*$hungry['crop'];

                    $skolko+=$crop;

                    $this->modifyResource($vilinfo['wref'],0,0,0,$crop,1);

                }

            }



if($skolko>0 ||  $killunits ==0){

break;

}

}

            }

        }

    }

    function addPrisoners($wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11) {

        $p=array('W'=>$wid,'F'=>$from,'T1'=>$t1,'T2'=>$t2,'T3'=>$t3,'T4'=>$t4,'T5'=>$t5,'T6'=>$t6,'T7'=>$t7,'T8'=>$t8,'T9'=>$t9,'T10'=>$t10,'T11'=>$t11);

        $q = "INSERT INTO prisoners values (0,:W,:F,:T1, :T2, :T3, :T4, :T5, :T6, :T7, :T8, :T9, :T10, :T11)";

        $this->query($q,$p);

        return $this->get_last_id();

    }



    function updatePrisoners($wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11) {

        $p=array('W'=>$wid,'F'=>$from);

        $q = "UPDATE prisoners set t1 = t1 + ".$t1.", t2 = t2 + ".$t2.", t3 = t3 + ".$t3.", t4 = t4 + ".$t4.", t5 = t5 + ".$t5.", t6 = t6 + ".$t6.", t7 = t7 + ".$t7.", t8 = t8 + ".$t8.", t9 = t9 + ".$t9.", t10 = t10 + ".$t10.", t11 = t11 + ".$t11." where `wref` = :W and `from` = :F";

        return $this->query($q,$p);

    }



    function getPrisoners($wid) {

        $p=array('W'=>$wid);

        $q = "SELECT * FROM prisoners where `wref` = :W";

        $result = $this->query($q,$p);

        return $result;

    }



    function getPrisoners2($wid,$from) {

        $p=array('W'=>$wid,'F'=>$from);

        $q = "SELECT id FROM prisoners where `wref` = :W and `from` = :F";

        return $this->query($q,$p);

    }



    function getPrisonersByID($id) {

        $p=array('I'=>$id);

        $q = "SELECT * FROM prisoners where id = :I";

        return $this->row($q,$p);

    }



    function getPrisoners3($from) {

        $p=array('F'=>$from);

        $q = "SELECT * FROM prisoners where `from` = :F";

        $result = $this->query($q,$p);

        return $result;

    }



    function deletePrisoners($id) {

        $p=array('I'=>$id);

        $q = "DELETE from prisoners where id = :I";

        $this->query($q,$p);

    }

    function modifyTraps($vref,$u99,$mode){

        if($mode==0){

        $this->query("UPDATE `units` SET o99=o99+".$u99." WHERE vref = '".$vref."'");

        }elseif($mode==1){

            $this->query("UPDATE `units` SET o99=0,u99=0 WHERE vref = '".$vref."'");

        }elseif($mode==2){

            $this->query("UPDATE `units` SET o99=o99-".$u99." WHERE vref = '".$vref."'");

        }

        }

function WPosition($coor,$i){

    $tmp = $coor+$i;

    if($tmp<-WORLD_MAX) $tmp = (2*WORLD_MAX)+$tmp+1;

    if($tmp>WORLD_MAX) $tmp = (-2*WORLD_MAX)+$tmp-1;

    return $tmp;



}





    function checkProcExist($uid) {

        $p=array('U'=> $uid);

        $q = "SELECT * FROM newproc where uid = :U and proc = 0";

        $result = $this->query($q,$p);

        if(count($result)) {

            return false;

        } else {

            return true;

        }

    }

    function getUserWithEmail($email) {

        $q = "SELECT id,username FROM users where email = :email";

        return $this->row($q,array('email'=>$email));

    }

    function addNewProc($uid, $npw, $nemail, $act, $mode) {

        $time = time();

        if(!$mode){

            $p=array('U'=>$uid,'N'=>$npw,'A'=>$act);

            $q = "INSERT into newproc (uid, npw, act, time, proc) values (:U, :N, :A, '$time', 0)";

        }else{

            $p=array('U'=>$uid,'N'=>$nemail,'A'=>$act);

            $q = "INSERT into newproc (uid, nemail, act, time, proc) values (:U, :N, :A, '$time', 0)";

        }



       $this->query($q,$p);

    }

    function removeProc($uid) {

        $p=array('U'=> $uid);

        $q = "DELETE FROM newproc where uid = :U";

       $this->query($q,$p);

    }



    function getNewProc($uid) {

        $p=array('U'=> $uid);

        $q = "SELECT * FROM newproc WHERE uid = :U";

        $result = $this->row($q,$p);

        if(count($result)) {

            return $result;

        } else {

            return false;

        }

    }

    function MapVersionStartControl($x0,$x1,$y0,$y1,$hash){

        $p=array('x0'=>$x0,'x1'=>$x1,'y0'=>$y0,'y1'=>$y1,'H'=>$hash);

        $q = "INSERT INTO `map_control`(`id`, `uid`, `hash`, `x0`, `x1`, `y0`, `y1`, `version`) VALUES (0,0,:H,:x0,:x1,:y0,:y1,0)";

        $this->query($q,$p);

    }

    function MapVersionControl($x0,$x1,$y0,$y1){

        $p=array('x0'=>$x0,'x1'=>$x1,'y0'=>$y0,'y1'=>$y1);

      $q= "SELECT hash,version FROM map_control WHERE `x0`=:x0 and `x1`=:x1 and `y0`=:y0 and `y1`=:y1";



        $result = $this->row($q,$p);

        if(count($result)) {

            return $result;

        } else {

            return null;

        }

    }

    function MapVersionUpdate($x0,$x1,$y0,$y1,$hash){

        $p=array('x0'=>$x0,'x1'=>$x1,'y0'=>$y0,'y1'=>$y1,'H'=>$hash);

        $this->query("UPDATE `map_control` SET version=version+1, `hash`=:H WHERE `x0`=:x0 and `x1`=:x1 and `y0`=:y0 and `y1`=:y1",$p);

    }

function bodyClass($agent){

$body_browser_class = '';

if ( strpos($agent, 'Firefox') ) $body_browser_class = 'gecko';

elseif ( strpos($agent, 'Chrome') ) $body_browser_class = 'chrome';

elseif ( strpos($agent, 'Safari') ) $body_browser_class = 'safari';

elseif ( strpos($agent, 'Opera') ) $body_browser_class = 'opera';

elseif ( strpos($agent, 'MSIE 6.0') ) $body_browser_class = 'ie6';

elseif ( strpos($agent, 'MSIE 7.0') ) $body_browser_class = 'ie7';

elseif ( strpos($agent, 'MSIE 8.0') ) $body_browser_class = 'ie8';

elseif ( strpos($agent, 'MSIE 9.0') ) $body_browser_class = 'ie9';

elseif ( strpos($agent, 'MSIE 10.0') ) $body_browser_class = 'ie10';

elseif ( strpos($agent, 'Trident/7') ) $body_browser_class = 'ie11';

    return $body_browser_class;

}

    function InsertRights($uid){

        $this->query("INSERT INTO `sitters` (`uid`) VALUES ('".$uid."')");

    }

    function SitterRights($uid){

       return $this->row("SELECT * FROM sitters WHERE `uid`=:U",array('U'=>$uid));



    }

    function UpdateRights($uid,$post){

        $p=array('U'=>$uid,'S1'=>$post['s1'],'S2'=>$post['s2'],'S3'=>$post['s3'],'S4'=>$post['s4'],'S5'=>$post['s5'],'S6'=>$post['s6'],'S21'=>$post['s21'],'S22'=>$post['s22'],'S23'=>$post['s23'],'S24'=>$post['s24'],

            'S25'=>$post['s25'],'S26'=>$post['s26']);

        $this->query("UPDATE `sitters` SET `s1`=:S1,`s2`=:S2,`s3`=:S3,`s4`=:S4,`s5`=:S5,`s6`=:S6,`s21`=:S21,`s22`=:S22,`s23`=:S23,`s24`=:S24,`s25`=:S25,`s26`=:S26 WHERE `uid`=:U",$p);

    }

    function AddAchiev($uid){

        $this->query("INSERT INTO `achiev` (`uid`,`reward1`,`reward2`,`reward3`,`reward4`) VALUES ('".$uid."','0,0','0,0','0,0','0,0')");

    }

    function UpdateAchievU($uid,$query){

        $this->query("UPDATE `achiev` SET ".$query." WHERE `uid`='".$uid."'");

    }

    function RestartAchiev(){

        $this->query("UPDATE `achiev` SET `a1`='0',`a2`='0',`a3`='0',`a4`='0',`a5`='0',`a6`='0',`a7`='0',`a8`='0',`a9`='0',`a10`='0',`reward1`='0,0',`reward2`='0,0',`reward3`='0,0',`reward4`='0,0',`points`='0'");

    }



    function getAchiev($uid){

    return $this->row("SELECT * FROM `achiev` WHERE `uid`='".$uid."'");

}

    function newAdvTime($uid,$time){

        $this->query("UPDATE `users` SET `advtime`='".$time."' WHERE `id`='".$uid."'");

    }

    function getUserGold($uid){

        return $this->column("SELECT gold FROM `users` WHERE `id`='".$uid."'");

    }

    function setNewResourse($vid,$dwood,$dclay,$diron,$dcrop){

        $p=array('V'=>$vid);

        $q = "UPDATE vdata set `wood` = '".round($dwood)."', `clay` = '".round($dclay)."', `iron` = '".round($diron)."', `crop` = '".round($dcrop)."' where `wref` = :V";

        $this->query($q,$p);

    }


    function getUserInfo($uid)

    {
        $q = "SELECT * FROM users WHERE id = :V";
        $p = array('V' => $uid);

        return $this->row($q,$p);

	}
	
	function readNotice($id){
		echo $id;
		echo "<br>"; 
        $q = "UPDATE ndata set `viewed` = '1' where `id` = :id";
        $p = array('id' => $id);
        $this->query($q, $p);

		//$this->query("UPDATE ndata SET viewed = 1 WHERE id = ".$id."");
	}

	// iRedux
	function config(){
        $q = "SELECT * FROM config";
        return $this->row($q);
	}
	
    function getUserMSG($username){
        global $database;

        $uData = $database->queryFetch('SELECT * FROM  users WHERE username = "'.$username.'"');
        if($uData['id']){
            $m = '<a href="spieler.php?uid='.$uData['id'].'">'.$uData['username'].'</a>';
        }else{
            $m = '<span style="font-style:italic;">No player was found</span>';
        }

        return $m;
    }

	function generateFarm($kid,$uid,$username) {
		global $GLOBALS;
		$kid = rand(1,4);
		$sector = rand(1,4);
		$fType = rand(1,12);
        $time=0;
	
		$nareadis = 22.1 + 2; // iRedux - Fix
		$xm=$ym=0; $queryit='';
		switch($sector){
			case 1: $queryit=" 0 > x and y > 0 and `fieldtype` = ".rand(1,12)." and `type_of`='' and occupied = 0"; $xm=-1;$ym=1; break;
			case 2: $queryit=" 0 < x and y > 0 and `fieldtype` = ".rand(1,12)." and `type_of`='' and occupied = 0"; $xm=1;$ym=1; break;
			case 3: $queryit=" 0 < x and y < 0 and `fieldtype` = ".rand(1,12)." and `type_of`='' and occupied = 0 "; $xm=1;$ym=-1; break;
			case 4: $queryit=" 0 > x and y < 0 and `fieldtype` = ".rand(1,12)." and `type_of`='' and occupied = 0"; $xm=-1;$ym=-1; break;
		}

		$q = "SELECT id FROM wdata where ".$queryit." AND (SQRT(POW(x,2)+POW(y,2))>" . ($nareadis) . ")";
		//$q = "SELECT id FROM wdata where ".$queryit;
		$dbarray = $this->query($q);
		$mmasive=array();

		foreach($dbarray as $d){
			array_push($mmasive,$d['id']);

		}

		
		for($x=0;$x<=WORLD_MAX;$x++){
			for($y=0;$y<=$x;$y++){
				$id=$this->getBaseID($x*$xm,$y*$ym);
				if(in_array($id,$mmasive)){
					if(rand(1,5)==3){
						$wid =  $id; break;
					}
				}
			}
		}

		// add Village
		$this->setFieldTaken($wid);
		$time = time();
		$total = count($this->getVillagesID($uid));
		$vname = 'village natar';
		$coo=$this->getWInfo($wid);
		$p=array('vname'=>$vname);
		$q = "INSERT into vdata (wref, owner, name, capital, pop, cp, celebration, wood, clay, iron, maxstore, crop, maxcrop, lastupdate, created,vx,vy,vtype) values ('".$wid."', '".$uid."', :vname, '0', '2', 1, 0, 750, 750, 750, ".STORAGE_BASE.", 750, ".STORAGE_BASE.", '".$time."', '".$time."','".$coo['x']."','".$coo['y']."','".$coo['fieldtype']."')";
		$this->query($q,$p);

		$this->addResourceFields($wid,$this->getVillageType($wid));
		$this->addUnits($wid);
		$this->addTech($wid);
		$this->addABTech($wid);

		$vData = $this->queryFetch("SELECT * FROM fdata WHERE vref= ".$wid."");

		for($i=1;$i<=18;$i++){
			$lvlUp = rand(1,7);
			$FIEiLD_BID = $vData['f'.$i.'t'];
			$RPA_LEVEL = $vData['f'.$i];
			$this->query("UPDATE fdata SET f".$i." = ".$lvlUp." WHERE vref= ".$wid."");
			
			for ($x = 1 + $RPA_LEVEL; $x <= $lvlUp; ++$x) {
				$pop += $GLOBALS['bid' . $FIEiLD_BID][$x]['pop'];
				$cp += $GLOBALS['bid' . $FIELD_BID][$x]['cp'];
			}
			$this->modifyPop($wid, $pop, 0);
			$this->addCP($wid, $cp / SPEED);
		}

		// add storage 10, 11
		$bID = rand(27, 38); $upLvl = rand(1,20);
		$RPA = $vData['f'.$bID];

		$this->query("UPDATE fdata SET f".$bID." = ".$upLvl." WHERE vref= ".$wid."");
		$this->query("UPDATE fdata SET f".$bID."t = 10 WHERE vref= ".$wid."");
		for ($x = 1 + $RPA; $x <= $upLvl; ++$x) {
			$pop += $GLOBALS['bid' . $FIEiLD_BID][$x]['pop'];
			$cp += $GLOBALS['bid' . $FIELD_BID][$x]['cp'];
		}

		$this->modifyPop($wid, $pop, 0);
		$this->addCP($wid, $cp / SPEED);

		$bID = rand(27, 38); $upLvl = rand(1,20);
		if($vData['f'.$bID.'t'] == 10){
			$bID = rand(27, 38);
		}
		$RPA = $vData['f'.$bID];

		$this->query("UPDATE fdata SET f".$bID." = ".$upLvl." WHERE vref= ".$wid."");
		$this->query("UPDATE fdata SET f".$bID."t = 11 WHERE vref= ".$wid."");
		for ($x = 1 + $RPA; $x <= $upLvl; ++$x) {
			$pop += $GLOBALS['bid' . $FIEiLD_BID][$x]['pop'];
			$cp += $GLOBALS['bid' . $FIELD_BID][$x]['cp'];
		}
		$this->modifyPop($wid, $pop, 0);
		$this->addCP($wid, $cp / SPEED);



		return $wid;
	}

}



	$database = new MYSQL_DB;