<?php
class Generator0 {

	public function generateRandID(){
		return md5($this->generateRandStr(16));
		}

   public function generateRandStr($length){
	  $randstr = "";
	  for($i=0; $i<$length; $i++){
		 $randnum = mt_rand(0,61);
		 if($randnum < 10){
			$randstr .= chr($randnum+48);
		 }else if($randnum < 36){
			$randstr .= chr($randnum+55);
		 }else{
			$randstr .= chr($randnum+61);
		 }
	  }
	  return $randstr;
   }

   public function encodeStr($str,$length) {
	   $encode = md5($str);
	   return substr($encode,0,$length);
   }



	public function getTimeFormat($t) {
		return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
	}


	public function procMtime($time, $pref = 3) {
		global $session;

		// iRedux - Edited
		$today = date('d',time())-1;
		if (date('Ymd',time()) == date('Ymd',$time)) {
			$day = REPORT_TODAY;
		}elseif($today == date('d',$time)){
			$day = REPROT_YESTERDAY;
		}
		else {
			if(!$session->tformat){ 
				$day = date("j/m/y",$time);
			}else{
				switch($session->tformat){
					case 1: $day = date("m/j/y",$time); break;
					case 2: $day = date("j/m/y",$time); break;
					case 3: $day = date("y/m/j",$time); break;
				}
			}

		}
		if(!$session->tformat){ 
			$new = date("H:i:s",$time);
		}else{
			switch($session->tformat){
				case 1: $new = date("h:i:s",$time); break;
				case 2: $new = date("h:i:s",$time); break;
				case 3: $new = date("H:i:s",$time); break;
			}
		}
		if ($pref=="9"||$pref==9)
			return $new;
		else
			return array($day,$new);
	}



	public function getMapCheck($wref) {
		return substr(md5($wref),5,2);
	}


};
$generator = new Generator0;