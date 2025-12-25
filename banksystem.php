<?php
class banksystem
{

    function getInfo($milo)
    { 
global $mailer,$db;
		
        $value = substr($milo, 0, 40);
        $email = htmlspecialchars($value);
        $who = $database->queryFetch("SELECT * FROM bank WHERE `email`='" . $email . "'");
        $info = mysql_fetch_array($who);
        if (count($info)) {
            $code = $this->generateRandStr(10);
            $ip = $_SERVER['REMOTE_ADDR'];
            $mailer->sendGold($email,$code);
            $database->queryFetch("UPDATE operation SET `status`='1' WHERE `email`='" . $email . "'");
            $database->queryFetch("INSERT INTO operation (`id`,`email`,`code`,`gold`,`ip`,`time`,`status`) VALUES ('0','" . $info['email'] . "','" . $code . "','0','" . $ip . "','" . time() . "','0')");

        }
        return $info;
    }
	function getGoldCount($email) {
		global $db;
        $value = substr($email, 0, 30);
        $email1 = htmlspecialchars($value);
		$who = $database->queryFetch("SELECT gold FROM bank WHERE email='" . $email1 . "'");
		$info = mysql_fetch_array($who);
		$return['gold']  = $info['gold'];
		return $return;
	}
	
	
	
	
	function CheckUser($server, $id, $email, $code, $gold)
    {
        
        global $db,$database,$connect;
        $back = array();
        $email = substr($email, 0, 30);
        $email = htmlspecialchars($email);
        $code = substr($code, 0, 30);
        $code = htmlspecialchars($code);
        $gold = substr($gold,0,10);
        $gold = preg_replace("/[^0-9]/", "", $gold);
        $gold=intval($gold);



      //  echo $server." ; ".$id." ; ".$email." ; ".$code." ; ".$gold;
        
        $who = $database->queryFetch("SELECT o.id,b.email,o.code,o.status,b.gold FROM operation as o INNER JOIN bank as b ON o.email = b.email
        WHERE
        o.email='" . $email . "' and o.status ='0' ORDER BY o.id DESC");
        
        $lineinfo = mysql_fetch_array($who);
        
        if($lineinfo['gold']>=$gold && !empty($lineinfo) && $lineinfo['code']==$code){
          
        
        if (empty($id)) {
            $back['id'] = 0;
            $back['fail']=false;
        } else {
            $back['id'] = $id;
            $back['gold'] = $gold;
            $database->queryFetch("UPDATE operation SET `gold`=".$gold.",`server`='".$server."',`userid`='". $back['id']."' WHERE `id`=".$lineinfo['id']."");
            $back['fail']=false;
      }
        $back['code'] = $lineinfo['code'];
        $back['nick'] = $nick;
            $back['email'] = $lineinfo['email'];
            return $back;
        }
        $back['id']=0;
        $back['fail']=true;
        return $back;
    }


    function generateRandStr($length)
    {
        $randstr = "";
        for ($i = 0; $i < $length; $i++) {
            $randnum = mt_rand(0, 61);
            if ($randnum < 10) {
                $randstr .= chr($randnum + 48);
            } else if ($randnum < 36) {
                $randstr .= chr($randnum + 55);
            } else {
                $randstr .= chr($randnum + 61);
            }
        }
        return $randstr;
    }

    

    function addGold($code,$email)
    {
        $result = false;
        global $db,$database;
        $email = substr($email, 0, 30);
        $email = htmlspecialchars($email);
        $code = substr($code, 0, 30);
        $code = htmlspecialchars($code);
        
        $getline2 = $database->queryFetch("SELECT gold,server,userid,email,code FROM operation WHERE `email`='".$email."' and `code`='" . $code . "' and `status`='0'");
        $lineinfo2 = mysql_fetch_array($getline2);
        
        if(!empty($lineinfo2)){
        $checode = $lineinfo2['code'];
            $gold = $lineinfo2['gold'];
         $database->queryFetch("UPDATE bank SET `gold`=`gold`-".$gold." WHERE `email`='".$email."'");
            $database->queryFetch("UPDATE operation SET `status`='1' WHERE `code`='".$checode."'");

            $userid = $lineinfo2['userid'];
            $server = $lineinfo2['server'];


            //для юзера
						$ttema = "Зачисление золота!";
						$ttext = "[message]Золото успешно переinедено из банка ! in размере ".$gold." золота.[/message]";
						
            $database->query("UPDATE users SET `gold`= `gold` + '" . $gold . "' WHERE `id` = '" . $userid . "'");
            $database->query("INSERT INTO mdata (id, target, owner, topic, message, viewed, send, time) VALUES('','".$userid."','6','".$ttema."','".$ttext."','0','0','".time()."')");

            //для банкоinских шняг
            $ip = $_SERVER['REMOTE_ADDR'];
            $db->query("INSERT INTO log (`id`,`userid`,`email`,`gold`,`ip`,`time`,`server`) VALUES ('0','" . $userid . "','" . $lineinfo2['email'] . "','".$gold."','" . $ip . "','" . time() . "','".$server."')");

            $result = true;

        }
        return $result;
    }
}
$banksystem = new banksystem;