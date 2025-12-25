<?php 

Class newTravian
{
    public function __construct() {
        global $database;
        $this->glob =& $database;
    }

	public function doThisNow(){
		global $database;
		$users = $database->query("SELECT * FROM s1_users");
		while($row = mysqli_fetch_assoc($users)){
			$time = $row['protect'] - (MINPROTECTION);
			$database->query("UPDATE " . TB_PREFIX . "users set protect = '" . $time . "' WHERE id = " . $row['id']);
		}
	}
	
	public function addGold($gold, $username){
		global $database, $message;
		//echo $username; die();
		$playerQuery = $database->query("SELECT * FROM " . TB_PREFIX . "users WHERE username = '".$username."'");
		if(mysqli_num_rows($playerQuery) == 0){
			return 'No player with this name found';
		}else{
			$database->query("UPDATE " . TB_PREFIX . "users set gold = gold + ".$gold." WHERE username = '".$username."'");
			$playerData = mysqli_fetch_assoc($playerQuery);
			
			$nowGold = $playerData['gold'] + $gold;
			$topic = 'Has been shipped '.$gold.' gold '.$nowGold.'.';
			$database->sendMessage($playerData['id'], 4, 'Has been shipped gold',htmlspecialchars(addslashes($topic)), 0, 0, 0, 0,0);
			return 'add gold was successfully completed';
		}
		//$database->sendMessage($user, $session->uid, htmlspecialchars(addslashes($topic)), htmlspecialchars(addslashes($text)), 0, $alliance, $player, $coor, $report);
		
	}
	
	public function getUser($uid){
		global $database;
		$q = "SELECT * FROM " . TB_PREFIX . "users WHERE id =".$uid." LIMIT 1";
		$result = $database->query($q);
		
		return mysqli_fetch_array($result);
		
		
	}
	public function getInfoMessages(){
		global $database;
        $q = "SELECT * FROM " . TB_PREFIX . "adminmessages ORDER BY id ASC";
		$result = $this->glob->query($q);
		
		while ($msg = mysqli_fetch_array($result )){
			$output .= "<li class=\"firstElement\">".$msg['content']."</li>";
		}
		
		return $output;
	}
	
	//Residence CP Functions
	public function villageNumber($uid){
		global $database;
        $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = ".$uid."";
		$result = $database->query($q);
		
		return mysqli_num_rows($result);
	}
	
	public function otherVillages($uid,$wref){
		global $database;
        $qQ = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = ".$uid." AND wref != ".$wref."";
        $q = "SELECT sum(cp) FROM " . TB_PREFIX . "vdata WHERE owner = ".$uid." AND wref != ".$wref."";
		$result = $database->query($q);
		
		if(mysqli_num_rows($database->query($qQ)) == 0){
			return 0;
		}else{
			$row = mysqli_fetch_row($result);
			return $row[0];
		}

	}
	
	public function getVillagesLoyalty($uid){
		global $database;
        $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = ".$uid." ORDER BY wref";
		$result = $database->query($q);
		while ($data = mysqli_fetch_array($result)){
			$output .= '
			<tr>
			<td class="name"><a href="karte.php?d='.$data['wref'].'">'.$data['name'].'</a> '.($data['capital'] == 1 ? '<span class="mainVillage">('.BL_CAPITAL.')</span>' : '').'</td>
			<td>'.$data['pop'].'</td>
			<td class="medium">'.$data['loyalty'].'%</td>
			</tr>';
		}
		return $output;
	}
	
	// New Hero System
	public function ItemtypeToData($btype){
		switch($btype){
			case 1: // Helmet
				$slot = "helmet";
				$isUsableIfDead = "false";
			break;
			case 2: // Armour
				$slot = "body";
				$isUsableIfDead = "false";
			break;
			case 3: // left hand
				$slot = "leftHand";
				$isUsableIfDead = "false";
			break;
			case 4: // right hand
				$slot = "rightHand";
				$isUsableIfDead = "false";
			break;
			case 5: // boots
				$slot = "shoes";
				$isUsableIfDead = "false";
			break;
			case 6: // Horses
				$slot = "horse";
				$isUsableIfDead = "false";
			break;
			case 7: // Small bandage
			case 8: // Bandage
			case 9: // Cage
			case 10: // Scroll Gives hero 10 experience Stackable
			case 11: // Ointment Instantly heals hero by 1% Stackable
			case 12: // Bucket
			case 13: // Book of Wisdom
			case 14: // Tablet of Law
			case 15: // Artwork
				$slot = "bag";
				$instant = "true";
				$isUsableIfDead = "true";
			break;
		}
		
		return array('slot' => $slot,
		'instant' => $instant ? $instant : '',
		'isUsableIfDead' => $isUsableIfDead
		);
	}
	
	public function getuserItems($uid){
		
		global $database,$name,$title;
		$HeroItems = $database->getHeroFace($uid);
		$hero = $database->getHeroData($uid);
		$output .= '';
		$x=0;
		foreach ($database->getHeroItems($uid) as $row) {
			$dataArray = $this->ItemtypeToData($row['btype']);
			$btype = $row['btype']; $type=$row['type'];
			include_once "./application/application/views/Auction/alt.tpl";
			
			if ($row['btype'] <= 11 or $row['btype'] == 13) {
				if ($hero['dead'] == 1) {
					$dis = ' disabled';
					$deadTitle = "<span class='itemNotMoveable'>" . HERO_HERODEADORNOTHERE . "</span><br>";
				}
			}
			
			if($row['num'] != 0){
				$x++;
				if($btype <= 6){
					$output .= '{"id":'.$row['id'].',"typeId":'.$row['type'].',"placeId":'.$x.',"name":"'.$name.'","place":"inventory","slot":"'.$dataArray['slot'].'","amount":'.$row['num'].',"isUsableIfDead":'.$dataArray['isUsableIfDead'].',"attributes":["'.$title.'."]},';
				}else{
					$output .= '{"id":'.$row['id'].',"typeId":'.$row['type'].',"placeId":'.$x.',"name":"'.$name.'","place":"inventory","slot":"'.$dataArray['slot'].'","amount":'.$row['num'].',"instant":"'.$dataArray['instant'].'","isUsableIfDead":'.$dataArray['isUsableIfDead'].',"attributes":["'.$title.'."]},';
				}
			}
			switch($row['id']){
				case $HeroItems['bag']:
					$output .= '{"id":'.$row['id'].',"typeId":'.$row['type'].',"placeId":0,"name":"'.$name.'","place":"bag","slot":"bag","amount":'.$HeroItems['num'].',"instant":'.$dataArray['instant'].',"isUsableIfDead":'.$dataArray['isUsableIfDead'].',"attributes":["'.$title.'."]},';
				break;
				
				case $HeroItems['horse']:
					$output .= '{"id":'.$row['id'].',"typeId":'.$row['type'].',"placeId":0,"name":"'.$name.'","place":"horse","slot":"'.$dataArray['slot'].'","amount":1,"isUsableIfDead":'.$dataArray['isUsableIfDead'].',"attributes":["'.$title.'."]},';
				break;
				
				case $HeroItems['body']:
					$output .= '{"id":'.$row['id'].',"typeId":'.$row['type'].',"placeId":0,"name":"'.$name.'","place":"body","slot":"'.$dataArray['slot'].'","amount":1,"isUsableIfDead":'.$dataArray['isUsableIfDead'].',"attributes":["'.$title.'."]},';
				break;
				
				case $HeroItems['leftHand']:
					$output .= '{"id":'.$row['id'].',"typeId":'.$row['type'].',"placeId":0,"name":"'.$name.'","place":"leftHand","slot":"'.$dataArray['slot'].'","amount":1,"isUsableIfDead":'.$dataArray['isUsableIfDead'].',"attributes":["'.$title.'."]},';
				break;
				
				case $HeroItems['rightHand']:
					$output .= '{"id":'.$row['id'].',"typeId":'.$row['type'].',"placeId":0,"name":"'.$name.'","place":"rightHand","slot":"'.$dataArray['slot'].'","amount":1,"isUsableIfDead":'.$dataArray['isUsableIfDead'].',"attributes":["'.$title.'."]},';
				break;
				
				case $HeroItems['shoes']:
					$output .= '{"id":'.$row['id'].',"typeId":'.$row['type'].',"placeId":0,"name":"'.$name.'","place":"shoes","slot":"'.$dataArray['slot'].'","amount":1,"isUsableIfDead":'.$dataArray['isUsableIfDead'].',"attributes":["'.$title.'."]},';
				break;
				
				case $HeroItems['helmet']:
					$output .= '{"id":'.$row['id'].',"typeId":'.$row['type'].',"placeId":0,"name":"'.$name.'","place":"helmet","slot":"'.$dataArray['slot'].'","amount":1,"isUsableIfDead":'.$dataArray['isUsableIfDead'].',"attributes":["'.$title.'."]},';
				break;
				
				default:
				break;
			}
		}
		
		return rtrim($output, ", ");
	}
	
	public function itemToInventory(){
		
	}
	
	function helmetEffects($type, $mode){
		global $database,$session;
		$uid=$session->uid;
		// mode 1 = +, 2 = -
		switch ($type) {
			case 1:
				$database->modifyHero($uid, 0, "itemextraexpgain", 15, $mode);
			break;
			case 2:
				$database->modifyHero($uid, 0, "itemextraexpgain", 20, $mode);
			break;
			case 3:
				$database->modifyHero($uid, 0, "itemextraexpgain", 25, $mode);
			break;
			case 4:
				$database->modifyHero($uid, 0, "itemautoregen", 10, $mode);
			break;
			case 5:
				$database->modifyHero($uid, 0, "itemautoregen", 15, $mode);
			break;
			case 6:
				$database->modifyHero($uid, 0, "itemautoregen", 20, $mode);
			break;
			case 7:
				$database->modifyHero($uid, 0, "itemcpproduction", 5, $mode);
			break;
			case 8:
				$database->modifyHero($uid, 0, "itemcpproduction", 10, $mode);
			break;
			case 9:
				$database->modifyHero($uid, 0, "itemcpproduction", 15, $mode);
			break;
			case 10:
				$database->modifyHero($uid, 0, "itemcavalrytrain", 10, $mode);
			break;
			case 11:
				$database->modifyHero($uid, 0, "itemcavalrytrain", 15, $mode);
			break;
			case 12:
				$database->modifyHero($uid, 0, "itemcavalrytrain", 20, $mode);
			break;
			case 13:
				$database->modifyHero($uid, 0, "iteminfantrytrain", 10, $mode);
			break;
			case 14:
				$database->modifyHero($uid, 0, "iteminfantrytrain", 15, $mode);
			break;
			case 15:
				$database->modifyHero($uid, 0, "iteminfantrytrain", 20, $mode);
			break;
		}		
	}
	function bodyEffects($type, $mode){
		global $database,$session;
		$uid=$session->uid;
		// mode 1 = +, 2 = -
		switch ($type) {
			case 82:
			$database->modifyHero($uid, 0, "itemautoregen", 20, $mode);
			break;
			case 83:
			$database->modifyHero($uid, 0, "itemautoregen", 30, $mode);
			break;
			case 84:
			$database->modifyHero($uid, 0, "itemautoregen", 40, $mode);
			break;
			case 85:
			$database->modifyHero($uid, 0, "itemautoregen", 10, $mode);
			$database->modifyHero($uid, 0, "itemextraresist", 4, $mode);
			break;
			case 86:
			$database->modifyHero($uid, 0, "itemautoregen", 15, $mode);
			$database->modifyHero($uid, 0, "itemextraresist", 6, $mode);
			break;
			case 87:
			$database->modifyHero($uid, 0, "itemautoregen", 20, $mode);
			$database->modifyHero($uid, 0, "itemextraresist", 8, $mode);
			break;
			case 88:
			$database->modifyHero($uid, 0, "itemfs", 500, $mode);
			break;
			case 89:
			$database->modifyHero($uid, 0, "itemfs", 1000, $mode);
			break;
			case 90:
			$database->modifyHero($uid, 0, "itemfs", 1500, $mode);
			break;
			case 91:
			$database->modifyHero($uid, 0, "itemfs", 250, $mode);
			$database->modifyHero($uid, 0, "itemextraresist", 3, $mode);
			break;
			case 92:
			$database->modifyHero($uid, 0, "itemfs", 500, $mode);
			$database->modifyHero($uid, 0, "itemextraresist", 4, $mode);
			break;
			case 93:
			$database->modifyHero($uid, 0, "itemfs", 750, $mode);
			$database->modifyHero($uid, 0, "itemextraresist", 5, $mode);
			break;
		}
	}
	function leftHandEffects($type, $mode){
		global $database,$session;
		$uid=$session->uid;
		// mode 1 = +, 2 = -
			switch ($type) {
                    case 61:
                        $database->modifyHero($uid, 0, "itemreturnmspeed", 30, $mode);
                        break;
                    case 62:
                        $database->modifyHero($uid, 0, "itemreturnmspeed", 40, $mode);
                        break;
                    case 63:
                        $database->modifyHero($uid, 0, "itemreturnmspeed", 50, $mode);
                        break;
                    case 64:
                        $database->modifyHero($uid, 0, "itemaccountmspeed", 30, $mode);
                        break;
                    case 65:
                        $database->modifyHero($uid, 0, "itemaccountmspeed", 40, $mode);
                        break;
                    case 66:
                        $database->modifyHero($uid, 0, "itemaccountmspeed", 50, $mode);
                        break;
                    case 67:
                        $database->modifyHero($uid, 0, "itemallymspeed", 15, $mode);
                        break;
                    case 68:
                        $database->modifyHero($uid, 0, "itemallymspeed", 20, $mode);
                        break;
                    case 69:
                        $database->modifyHero($uid, 0, "itemallymspeed", 25, $mode);
                        break;
                    case 73:
                        $database->modifyHero($uid, 0, "itemrob", 10, $mode);
                        break;
                    case 74:
                        $database->modifyHero($uid, 0, "itemrob", 15, $mode);
                        break;
                    case 75:
                        $database->modifyHero($uid, 0, "itemrob", 20, $mode);
                        break;
                    case 76:
                        $database->modifyHero($uid, 0, "itemfs", 500, $mode);
                        break;
                    case 77:
                        $database->modifyHero($uid, 0, "itemfs", 1000, $mode);
                        break;
                    case 78:
                        $database->modifyHero($uid, 0, "itemfs", 1500, $mode);
                        break;
                    case 79:
                        $database->modifyHero($uid, 0, "itemvsnatars", 25, $mode);
                        break;
                    case 80:
                        $database->modifyHero($uid, 0, "itemvsnatars", 50, $mode);
                        break;
                    case 81:
                        $database->modifyHero($uid, 0, "itemvsnatars", 75, $mode);
                        break;
                }
                		
	}	
	function rightHandEffects($type, $mode){
		global $database,$session;
 		$uid=$session->uid;
               switch ($type) {
                    case 16:
                    case 19:
                    case 22:
                    case 25:
                    case 28:
                    case 31:
                    case 34:
                    case 37:
                    case 40:
                    case 43:
                    case 46:
                    case 49:
                    case 52:
                    case 55:
                    case 58:
					case 115:
					case 118:
					case 121:
					case 124:
					case 127:
					case 130:
					case 133:
					case 136:
					case 139:
					case 142:
                        $database->modifyHero($uid, 0, "itemfs", 500, $mode);
                        break;
                    case 17:
                    case 20:
                    case 23:
                    case 26:
                    case 29:
                    case 32:
                    case 35:
                    case 38:
                    case 41:
                    case 44:
                    case 47:
                    case 50:
                    case 53:
                    case 56:
                    case 59:
					case 116:
					case 119:
					case 122:
					case 125:
					case 128:
					case 131:
					case 134:
					case 137:
					case 140:
					case 143:
                        $database->modifyHero($uid, 0, "itemfs", 1000, $mode);
                        break;
                    case 18:
                    case 21:
                    case 24:
                    case 27:
                    case 30:
                    case 33:
                    case 36:
                    case 39:
                    case 42:
                    case 45:
                    case 48:
                    case 51:
                    case 54:
                    case 57:
                    case 60:
					case 117:
					case 120:
					case 123:
					case 126:
					case 129:
					case 132:
					case 135:
					case 138:
					case 141:
					case 144:
                        $database->modifyHero($uid, 0, "itemfs", 1500, $mode);
                        break;
                }
	}
	function shoesEffects($type, $mode){
		global $database,$session;
		$uid=$session->uid;
		switch ($type) {
                    case 94:
                        $database->modifyHero($uid, 0, "itemautoregen", 10, $mode);
                        break;
                    case 95:
                        $database->modifyHero($uid, 0, "itemautoregen", 15, $mode);
                        break;
                    case 96:
                        $database->modifyHero($uid, 0, "itemautoregen", 20, $mode);
                        break;
                    case 97:
                        $database->modifyHero($uid, 0, "itemattackmspeed", 25, $mode);
                        break;
                    case 98:
                        $database->modifyHero($uid, 0, "itemattackmspeed", 50, $mode);
                        break;
                    case 99:
                        $database->modifyHero($uid, 0, "itemattackmspeed", 75, $mode);
                        break;
                    case 100:
                        $database->modifyHero($uid, 0, "itemspeed", 3, $mode);
                        break;
                    case 101:
                        $database->modifyHero($uid, 0, "itemspeed", 4, $mode);
                        break;
                    case 102:
                        $database->modifyHero($uid, 0, "itemspeed", 5, $mode);
                        break;
                }
	}
	function horseEffects($type, $mode){
		global $database,$session;
		$uid=$session->uid;
		switch ($type) {
			case 103:
			$database->modifyHero($uid, 0, "itemspeed", 14, $type);
			break;
			case 104:
			$database->modifyHero($uid, 0, "itemspeed", 17, $type);
			break;
			case 105:
			$database->modifyHero($uid, 0, "itemspeed", 20, $type);
			break;
		}	
	}
	function itemType($btype){
		switch($btype){
			case 1: // Helmet
			$itemType = array('column' => 'helmet','functionEffect' => 'helmetEffects');
			break;
			case 2: // Armour
			$itemType = array('column' => 'body','functionEffect' => 'bodyEffects');
			break;
			case 3: // left hand
			$itemType = array('column' => 'leftHand','functionEffect' => 'leftHandEffects');
			break;
			case 4: // right hand
			$itemType = array('column' => 'rightHand','functionEffect' => 'rightHandEffects');
			break;
			case 5: // boots
			$itemType = array('column' => 'shoes','functionEffect' => 'shoesEffects');
			break;
			case 6 :// Horses
			$itemType = array('column' => 'horse','functionEffect' => 'horseEffects');
			break;
		}
		return $itemType;
	}
	public function useHeroItem($data){
		global $database,$session,$village,$Quest;
		$uid = $session->uid;
		$heroFace = $database->getHeroFace($uid);
		$heroData = $database->getHeroData($session->uid);
        if ($data['drid'] == 'helmet') {
            $item = $database->getHeroItem($data['id']);
            if ($item) {
				if($heroFace['helmet'] != 0){
					$helmetData = mysqli_fetch_assoc($database->query("SELECT * FROM ".TB_PREFIX."heroitems WHERE id='".$heroFace['helmet']."'"));
					$this->helmetEffects($helmetData['type'],2);
					$database->modifyHeroItem($helmetData['id'], 'proc', 0, 0);
					$database->modifyHeroItem($helmetData['id'], 'num', 1, 0);
					$database->modifyHeroFace($uid, "helmet", 0);
				}
				
				$database->modifyHeroItem($item['id'], 'proc', 1, 0);
				$database->modifyHeroItem($item['id'], 'num', 0, 0);
				$database->modifyHeroFace($uid, "helmet", $item['id']);
				$this->helmetEffects($item['type'],1);
				
            }
        } elseif ($data['drid'] == 'body') {
            $item = $database->getHeroItem($data['id']);
            if ($item) {
				if($heroFace['body'] != 0){
					$bodyData = mysqli_fetch_assoc($database->query("SELECT * FROM ".TB_PREFIX."heroitems WHERE id='".$heroFace['body']."'"));
					$this->bodyEffects($bodyData['type'],2);
					$database->modifyHeroItem($bodyData['id'], 'proc', 0, 0);
					$database->modifyHeroItem($bodyData['id'], 'num', 1, 0);
					$database->modifyHeroFace($uid, "body", 0);
				}
				
				$database->modifyHeroItem($data['id'], 'proc', 1, 0);
				$database->modifyHeroItem($data['id'], 'num', 0, 0);
				$database->modifyHeroFace($uid, "body", $item['id']);
				$this->bodyEffects($item['type'],1);
				
            }
        } elseif ($data['drid'] == 'leftHand') {
            $item = $database->getHeroItem($data['id']);
            if ($item) {
                if($heroFace['leftHand'] != 0){
					$leftHandData = mysqli_fetch_assoc($database->query("SELECT * FROM ".TB_PREFIX."heroitems WHERE id='".$heroFace['leftHand']."'"));
					$this->leftHandEffects($leftHandData['type'],2);
					$database->modifyHeroItem($leftHandData['id'], 'proc', 0, 0);
					$database->modifyHeroItem($leftHandData['id'], 'num', 1, 0);
					$database->modifyHeroFace($uid, "leftHand", 0);
				}
				$database->modifyHeroItem($item['id'], 'proc', 1, 0);
				$database->modifyHeroItem($item['id'], 'num', 0, 0);
				$database->modifyHeroFace($uid, "leftHand", $item['id']);
				$this->leftHandEffects($item['type'],1);
            }
        } elseif ($data['drid'] == 'rightHand') {
            $item = $database->getHeroItem($data['id']);
            if ($item) {
				if($heroFace['rightHand'] != 0){
					$rightHandData = mysqli_fetch_assoc($database->query("SELECT * FROM ".TB_PREFIX."heroitems WHERE id='".$heroFace['rightHand']."'"));
					$this->rightHandEffects($rightHandData['type'],2);
					$database->modifyHeroItem($rightHandData['id'], 'proc', 0, 0);
					$database->modifyHeroItem($rightHandData['id'], 'num', 1, 0);
					$database->modifyHeroFace($uid, "rightHand", 0);
				}
				$database->modifyHeroItem($item['id'], 'proc', 1, 0);
				$database->modifyHeroItem($item['id'], 'num', 0, 0);
				$database->modifyHeroFace($uid, "rightHand", $item['id']);
				$this->rightHandEffects($item['type'],1);
            }
        } elseif ($data['drid'] == 'shoes') {
            $item = $database->getHeroItem($data['id']);
            if ($item) {
                if($heroFace['shoes'] != 0){
					$shoesData = mysqli_fetch_assoc($database->query("SELECT * FROM ".TB_PREFIX."heroitems WHERE id='".$heroFace['shoes']."'"));
					$this->shoesEffects($shoesData['type'],2);
					$database->modifyHeroItem($shoesData['id'], 'proc', 0, 0);
					$database->modifyHeroItem($shoesData['id'], 'num', 1, 0);
					$database->modifyHeroFace($uid, "shoes", 0);
				}
				
				$database->modifyHeroItem($data['id'], 'proc', 1, 0);
				$database->modifyHeroItem($data['id'], 'num', 0, 0);
				$database->modifyHeroFace($uid, "shoes", $data['id']);
				$this->shoesEffects($item['type'],1);
            }
        } elseif ($data['drid'] == 'horse') {
			$item = $database->getHeroItem($data['id']);
			if($heroFace['horse'] != 0){
				$horseData = mysqli_fetch_assoc($database->query("SELECT * FROM ".TB_PREFIX."heroitems WHERE id='".$heroFace['horse']."'"));
				$this->horseEffects($horseData['type'],2);
				$database->modifyHeroItem($horseData['id'], 'proc', 0, 0);
				$database->modifyHeroItem($item['id'], 'num', 1, 0);
				$database->modifyHeroFace($uid, "horse", 0);
			}

			$database->modifyHeroItem($item['id'], 'proc', 0, 1);
			$database->modifyHeroItem($item['id'], 'num', 0, 0);
			$database->modifyHeroFace($uid, "horse", $item['id']);
			
        } elseif ($data['drid'] == 'bag') {
			// need code if have something on bag swap
			$item = $database->getHeroItem($data['id']);
			if($item['num'] < $data['amount']){ $data['amount'] = $item['num']; }
			if($item['btype'] == 12){ // Bucket for revive
				if($heroData['dead'] == 1){
					$database->query("UPDATE ".TB_PREFIX."hero SET dead = 0,health = 100 WHERE uid =".$uid." ");
					$database->modifyHeroItem($item['id'], 'num', $data['amount'], 2);
					$database->modifyHeroItem($item['id'], 'proc', 0, 0);
					$database->editTableField('units', 'hero', 1, 'vref', $village->wid);
					$_SESSION['reload'] = TRUE;
				}
			}elseif($item['btype'] == 10){ // Scrolls
				echo "test<br>";
				if($heroData['dead'] == 0){
					if($data['amount'] >= $item['num']){ $numberUsed = $item['num'];
						$database->modifyHeroItem($item['id'], 'num', $item['num'], 2);
						$database->modifyHeroItem($item['id'], 'proc', 0, 0);
					}else{ $numberUsed = $data['amount'];
						$database->modifyHeroItem($item['id'], 'num', $data['amount'], 2);
					}
					$newEXP = $heroData['experience'] + ($numberUsed*200);
					$database->query("UPDATE ".TB_PREFIX."hero SET experience = ".$newEXP." WHERE uid =".$uid." ");
				}
				$_SESSION['reload'] = TRUE;
			}elseif($item['btype'] == 11){ // Ointment
				if($heroData['dead'] == 0){
					if ($session->quest_progress[0] == 12 && $session->quest_progress[2] != 1) {
						$Quest->UpdateQuestProgress($session->uid,'12,1,1,0,0');
					}
					if($data['amount'] >= $item['num']){ $numberUsed = $item['num'];
						$database->modifyHeroItem($item['id'], 'num', $item['num'], 2);
						$database->modifyHeroItem($item['id'], 'proc', 0, 0);
					}else{ $numberUsed = $data['amount'];
						$database->modifyHeroItem($item['id'], 'num', $data['amount'], 2);
					}
					
					if(round($heroData['healt']) != 100){
						$newHealth = $heroData['health'] + $numberUsed;
						if($newHealth > 100){
							$remainingOin = $newHealth - 100;
							$newHealth = 100;
							//$database->modifyHeroItem($item['id'], 'num', $remainingOin, 0);
							$database->modifyHeroFace($uid, "bag", $item['id']);
							$database->modifyHeroFace($uid, "num", $remainingOin,1);
						}
						$database->query("UPDATE ".TB_PREFIX."hero SET health = ".$newHealth." WHERE uid =".$uid." ");
					}else{
						$database->modifyHeroFace($uid, "bag", $item['id']);
						$database->modifyHeroFace($uid, "num", $data['amount'],1);
					}
					
				}
			}else{
				$database->modifyHeroItem($item['id'], 'num', $data['amount'], 2);
				$database->modifyHeroItem($item['id'], 'proc', 1, 0);
				$database->modifyHeroFace($uid, "bag", $item['id']);
				$database->modifyHeroFace($uid, "num", $data['amount'],1);
			}
			
        }else{
			$item = $database->getHeroItem($data['id']);						
			// Just a secure for items
			if($item['btype'] > 7 && $item['btype'] != 12){
				if($data['amount'] > $heroFace['num']){
					$data['amount'] = $heroFace['num']; 
				}
				$database->modifyHeroFace($uid, "bag", 0);
				$database->modifyHeroFace($uid, "num", 0);
				$database->modifyHeroItem($item['id'], 'num', $heroFace['num'], 1);
				
			}else{
				$this->{$this->itemType($item['btype'])['functionEffect']}($item['type'],2);
				$database->modifyHeroItem($data['id'], 'num', 1, 0);
				$database->modifyHeroItem($data['id'], 'proc', 0, 0);
				$database->modifyHeroFace($uid, $this->itemType($item['btype'])['column'], 0);
			}
		}		
	}
	
	public function getRandomApperance(){
		global $database,$session;
		$heroData = $database->getHeroFace($session->uid);
		if ($heroData['gender'] == 0) {
			$face = $_SESSION['face'] = rand(0, 4);
			$gen = 'male';
		} else {
			$face = $_SESSION['face'] = rand(0, 5);
			$gen = 'female';
		}
		$headp = '<img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"'.GP_LOCATE.'/img/hero/'.$gstr.'/'.$gen.'/head/254x330/face0.png\" alt=\"\">';
		$headp .= '<img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"'.GP_LOCATE.'/img/hero/'.$gstr.'/'.$gen.'/head/254x330/face/face' . $face . '.png\" alt=\"\">';
		$color = $_SESSION['getcolor'] = rand(0, 4);
		switch ($color) {
			case 0:
			$color = 'black';
			break;
		case 1:
			$color = 'brown';
			break;
		case 2:
			$color = 'darkbrown';
			break;
		case 3:
			$color = 'yellow';
			break;
		case 4:
			$color = 'red';
			break;
		}
		$gethair = $_SESSION['gethair'] = rand(0, 5);
		$hearp = '<img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"' . GP_LOCATE . 'img/hero/'.$gen.'/head/254x330/hair/hair' . $gethair . '-' . $color . '.png\" alt=\"\" >';
                    
		if ($heroData['gender'] == 0) {
		$getear = $_SESSION['getear'] = rand(0, 4);
		} else {
		$getear = $_SESSION['getear'] = rand(0, 7);
		}
					
		$earp = '<img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"' . GP_LOCATE . '\/img\/hero\/'.$gen.'\/head\/254x330\/ear\/ear' . $getear . '.png\" alt=\"\">';
                    
		if ($heroData['gender'] == 0) {
		$geteyebrow = $_SESSION['geteyebrow'] = rand(0, 3);
		} else {
		$geteyebrow = $_SESSION['geteyebrow'] = rand(0, 9);
		}
					
		if ($heroData['gender'] == 0) {
		$eyebrow = $geteyebrow . '-' . $color;
		} else {
		$eyebrow = $geteyebrow;
		}
					
		$eyebp = '<img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"' . GP_LOCATE . '\/img\/hero\/'.$gen.'\/head\/254x330\/eyebrow\/eyebrow' . $eyebrow . '.png\" alt=\"\">';
		if ($heroData['gender'] == 0) {
		$geteye = $_SESSION['geteye'] = rand(0, 4);
		} else {
		$geteye = $_SESSION['geteye'] = rand(0, 9);
		}
		$eyep = '<img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"' . GP_LOCATE . '\/img\/hero\/'.$gen.'\/head\/254x330\/eye\/eye' . $geteye . '.png\" alt=\"\">';
		if ($heroData['gender'] == 0) {
		$getnose = $_SESSION['getnose'] = rand(0, 4);
		} else {
		$getnose = $_SESSION['getnose'] = rand(0, 7);
		}
		$nosep = '<img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"' . GP_LOCATE . '\/img\/hero\/'.$gen.'\/head\/254x330\/nose\/nose' . $getnose . '.png\" alt=\"\">';
		if ($heroData['gender'] == 0) {
		$getmouth = $_SESSION['getmouth'] = rand(0, 3);
		} else {
		$getmouth = $_SESSION['getmouth'] = rand(0, 8);
		}
					
		$mop = '<img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"' . GP_LOCATE . '\/img\/hero\/'.$gen.'\/head\/254x330\/mouth\/mouth' . $getmouth . '.png\" alt=\"\">';
                    
		if ($heroData['gender'] == 0) {
                        $getbeard = $_SESSION['getbeard'] = rand(0, 5);
						$beardp = '<img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"' . GP_LOCATE . '\/img\/hero\/'.$gen.'\/head\/254x330\/beard\/beard' . $getbeard . '-' . $color . '.png\" alt=\"\">';
		} else {
			$beardp = '';
		}		
		
		return $headp . $hearp . $earp . $eyebp . $eyep . $nosep . $mop . $beardp;
	}
	
	function getRandomNumber($min,$max,$exclude='') {
		if($exclude != ''){
			do {
				$n = mt_rand($min,$max);
			} while(in_array($n, $exclude));
		}else{
			$n = mt_rand($min,$max);
		}
		// 30% percent to find nothing
		if((float)rand()/(float)getrandmax()  <= 0.3){
			return 0;
		}else{
			return $n;
		}
	}
	
	public function getResTitle($type){
		global $database, $village, $generator;
		//$village->maxstore
		switch($type){
			case 'wood':
				if(time()-((($village->maxstore-$village->awood) / $village->getProd('wood'))*60*60) < time()){
					$timeToFull = round((($village->maxstore-$village->awood) / $village->getProd('wood'))*60*60);
				}
				$ouput = ''.PD_LUMBER.'||'.RES_PRODUCTION.': '.number_format($village->getProd('wood')).'<br>'.RES_FULLIN.': '.gmdate('H:i:s',$timeToFull).'<br>'.RES_MOREINFO.'';
			break;
			
			case 'clay':
				if(time()-((($village->maxstore-$village->aclay) / $village->getProd('clay'))*60*60) < time()){
					$timeToFull = round((($village->maxstore-$village->aclay) / $village->getProd('clay'))*60*60);
				}
				$ouput = ''.PD_CLAY.'||'.RES_PRODUCTION.': '.number_format($village->getProd('clay')).'<br>'.RES_FULLIN.': '.gmdate('H:i:s',$timeToFull).'<br>'.RES_MOREINFO.'';
			break;
			
			case 'iron':
				if(time()-((($village->maxstore-$village->airon) / $village->getProd('iron'))*60*60) < time()){
					$timeToFull = round((($village->maxstore-$village->airon) / $village->getProd('iron'))*60*60);
				}
				$ouput = ''.PD_IRON.'||'.RES_PRODUCTION.': '.number_format($village->getProd('iron')).'<br>'.RES_FULLIN.': '.gmdate('H:i:s',$timeToFull).'<br>'.RES_MOREINFO.'';
			break;
			
			case 'crop':
				if(time()-((($village->maxstore-$village->acrop) / $village->getProd('crop'))*60*60) < time()){
					$timeToFull = round((($village->maxstore-$village->acrop) / $village->getProd('crop'))*60*60);
				}
				$ouput = ''.PD_CROP.'||'.RES_PRODUCTION.': '.number_format($village->getProd('crop')).'<br>'.RES_FULLIN.': '.gmdate('H:i:s',$timeToFull).'<br>'.RES_MOREINFO.'';
			break;
			
			case 'FreeCrop':
				$ouput = ''.RES_CROPBALANCETITLE.'||'.RES_CROPBALANCE.': '.number_format($village->allcrop).'<br>'.RES_MOREINFO.'';
			break;
		}
		
		return $ouput;
	}
	
	public function checkHeroMovement($wref){
		global $database;
		
		$q = "SELECT * FROM " . TB_PREFIX . "movement WHERE (`from` =".$wref." OR `to` =".$wref.") AND isHero != 0 AND proc = 0";
		$result = $database->query($q);
		$data = mysqli_fetch_assoc($result);
		
		if(mysqli_num_rows($result) == 1){
			return array(
				'isHero' => explode(',',$data['isHero']),
				'isAdventure' => 1,
				'toValley' => $data['to'],
				'endTime' =>  $data['endtime']
			);
		}else{
			return mysqli_num_rows($result);
		}
				
	}
	
	public function getReport($id,$mode){
		global $database, $session;
		if($mode == 'Next'){
			$q = $database->query("SELECT * FROM ".TB_PREFIX."ndata WHERE `uid` = " . $session->uid . " and `archive` = 0 and `id` > ".$id." ORDER BY id ASC LIMIT 1");
			if(mysqli_num_rows($q) != 0){
				return array(
					'Data' =>mysqli_fetch_assoc($q),
					'isDisable' => 0
				);
			}else{
				return array('isDisable' => 1);
			}
		}elseif($mode == 'Last'){
			$q = $database->query("SELECT * FROM ".TB_PREFIX."ndata WHERE `uid` = " . $session->uid . " and `archive` = 0 and `id` < ".$id." ORDER BY id DESC LIMIT 1");
			if(mysqli_num_rows($q) != 0){
				return array(
					'Data' =>mysqli_fetch_assoc($q),
					'isDisable' => 0
				);
			}else{
				return array('isDisable' => 1);
			}
		}
	}
	
	public function getReportImage($ntype){
		switch($ntype){
			case 1:
			break;
			
			case 9: // Adventure
			break;
			
			case 8: // Reinforcement
			break;
			
		}
	}
		
	public function getVillData($wref){
		global $database;
		$q = "SELECT * FROM " . TB_PREFIX . "wdata WHERE `id` =".$wref."";
		
		return mysqli_fetch_assoc($database->query($q));
	}
	
	public function getVillageData($wref){
		global $database;
		$q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE `wref` =".$wref."";
		
		return mysqli_fetch_assoc($database->query($q));
	}
	
	public function redirect($location){
		header('Location: '.$location.'.php');
		exit();
	}
	public function plusData(){
		global $database, $session;
		
	}
	
	public function sanitize_output($buffer) {

		$search = array(
			'/\>[^\S ]+/s',     // strip whitespaces after tags, except space
			'/[^\S ]+\</s',     // strip whitespaces before tags, except space
			'/(\s)+/s',         // shorten multiple whitespace sequences
			'/<!--(.|\s)*?-->/' // Remove HTML comments
		);

		$replace = array(
			'>',
			'<',
			'\\1',
			''
		);

		$buffer = preg_replace($search, $replace, $buffer);
		$buffer = str_replace('\t', '', $buffer);
		$buffer = str_replace('\n', '', $buffer);
		$buffer = str_replace('
	', '', $buffer);

		return $buffer;
	}
	
	public function getTribe($tribe){
		return constant('TRIBE'.$tribe);
	}
	
	public function tribeData($tribe){
		switch($tribe){
			case 1:
				$data = array(
					'start' => 1,
					'end' => 9
				);
		}
		
		return $data;
	}
	
	public function getDistance($coorx1, $coory1, $coorx2, $coory2){
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
	
	
	// Panel Functions
	function getWref($x,$y) {
		global $database;
		$q = "SELECT * FROM ".TB_PREFIX."wdata where x = $x and y = $y";      
		$result = $database->query($q);
		$r = mysqli_fetch_assoc($result);				
		return $r['id'];
	}

	public function ResetMap($post){ // Reinstall the whole thing
		global $database,$account,$session;
		set_time_limit(0);
		
		$database->query("TRUNCATE TABLE ".TB_PREFIX."a2b");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."abdata");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."activate");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."active");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."adventure");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."alidata");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."ali_invite");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."ali_log");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."ali_permission");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."allimedal");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."artefacts");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."attacks");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."auction");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."autoauction");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."bdata");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."deleting");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."demolition");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."diplomacy");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."emailinvite");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."enforcement");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."farmlist");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."fdata");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."forum_cat");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."forum_edit");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."forum_poll");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."forum_post");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."forum_topic");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."fpost_rules");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."gold_fin_log");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."hero");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."heroface");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."heroitems");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."links");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."map_marks");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."market");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."mdata");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."medal");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."movement");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."msg_reports");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."natarsprogress");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."ndata");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."newproc");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."odata");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."raidlist");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."refrence");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."research");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."route");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."send");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."stats");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."tdata");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."training");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."trapped");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."units");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."users_setting");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."vdata");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."fdata");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."wdata");
		$database->query("TRUNCATE TABLE ".TB_PREFIX."x_world");
		
		$database->query("INSERT INTO ".TB_PREFIX."natarsprogress VALUES(0, 0, 0, 0, ".$post['artefactreleasedat'].", 0, ".$post['wwbpreleasedat'].")");
		
		// Delete the accounts
		$database->query("DELETE FROM ".TB_PREFIX."users WHERE id>4");
		
		// Update the config 
		//stats_time
		$database->query("UPDATE ".TB_PREFIX."config SET commence=".time()."");
		$database->query("UPDATE ".TB_PREFIX."config SET isInstalled=1");
		
		// Wdata 
		$xyas = (1 + (2 * WORLD_MAX));
		$nareadis = NATARS_MAX;
		for ($i = 0; $i < $xyas; $i++) {
			$y = (WORLD_MAX - $i);
			for ($j = 0; $j < $xyas; $j++) {
				$x = ((WORLD_MAX * -1) + $j);
				//choose a field type
				if ($x >= -2 && $x <= 2 && $y >= -2 && $y <= 1) {
					if ($x == 0 && $y == 0) {
						$typ = '1';
					} else {
						$typ = '3';
					}
					$otype = '0';
				} else {
					$rand = rand(1, 1000);
					if (900 >= $rand) {
						if (10 >= $rand) {
							$typ = '1';
							$otype = '0';
						} else if (90 >= $rand) {
							$typ = '2';
							$otype = '0';
						} else if (400 >= $rand) {
							$typ = '3';
							$otype = '0';
						} else if (480 >= $rand) {
							$typ = '4';
							$otype = '0';
						} else if (560 >= $rand) {
							$typ = '5';
							$otype = '0';
						} else if (570 >= $rand) {
							$typ = '6';
							$otype = '0';
						} else if (600 >= $rand) {
							$typ = '7';
							$otype = '0';
						} else if (630 >= $rand) {
							$typ = '8';
							$otype = '0';
						} else if (660 >= $rand) {
							$typ = '9';
							$otype = '0';
						} else if (740 >= $rand) {
							$typ = '10';
							$otype = '0';
						} else if (820 >= $rand) {
							$typ = '11';
							$otype = '0';
						} else {
							$typ = '12';
							$otype = '0';
						}
					}
				}

			//image pick
			$image = "grassland" . rand(1, 11) . "";

			$q = "INSERT into " . TB_PREFIX . "wdata values (0,'" . $typ . "','" . $otype . "','" . $x . "','" . $y . "',0,'" . $image . "','')";
			$database->query($q);
			}
		}
		
		// Tiles
		$list = array('lake0','clay0','hill0','forest0','lake1','clay1','lake0','clay0','hill1','forest1','lake2','clay2','hill0','forest0','hill2','forest2','lake3','clay3','lake0','clay0','hill3','forest3','lake4','clay4','hill0','forest0','hill4','forest4','lake5','clay5','hill0','forest0','hill5','forest5','lake6','clay6','lake0','clay0','hill6','forest0','lake7','clay7','hill0','forest0','hill2','forest5',);
		$xt = 60;
		for ($rand1 = 0; $rand1 <= 198; $rand1++) {
			$xtile[$rand1] = $xt;
			$xt += 60;
		}

		$Volcanolist = 'vulcano';

		$vol_location = array(
			'-2 1 0', '-1 1 4', '0 1 8', '1 1 12', '2 1 16',
			'-2 0 1', '-1 0 5', '0 0 9', '1 0 13', '2 0 17',
			'-2 -1 2', '-1 -1 6', '0 -1 10', '1 -1 14', '2 -1 18',
			'-2 -2 3', '-1 -2 7', '0 -2 11', '1 -2 15', '2 -2 19',
		);

		$counter = $totalz = $maxcounter = 0;

		foreach ($vol_location as $loc) {
			$locs = explode(' ', $loc);
			$x = $locs[0];
			$y = $locs[1];
			$pos = $locs[2];
			$image = $Volcanolist;
			//if ($pos == 10) {
			//    $image = 'grassland1';
			//}
			if ($pos == 13) {
				$fieldtyp = 3;
			} else {
				$fieldtyp = 0;
			}
			$q = "UPDATE " . TB_PREFIX . "wdata set `fieldtype` = $fieldtyp , `image` = '$image' , `pos` ='$pos' WHERE x = '$x' AND y = '$y'";
			$database->query($q);
		}

		$max[] = "5880 6060";
		$max[] = "5940 6060";
		$max[] = "6000 6060";
		$max[] = "6060 6060";
		$max[] = "6120 6060";

		$max[] = "5880 6000";
		$max[] = "5940 6000";
		$max[] = "6000 6000";
		$max[] = "6060 6000";
		$max[] = "6120 6000";

		$max[] = "5880 5940";
		$max[] = "5940 5940";
		$max[] = "6000 5940";
		$max[] = "6060 5940";
		$max[] = "6120 5940";

		$max[] = "5880 5880";
		$max[] = "5940 5880";
		$max[] = "6000 5880";
		$max[] = "6060 5880";
		$max[] = "6120 5880";

		for ($i = 0; $i <= 198; $i += $rand_i) {
			unset($temp, $tile_counter);
			for ($z = 0; $z <= 198; $z += $rand_z) {
				unset($temp, $tile_counter);
				$lists = $list[mt_rand(0, 35)];
				if (isset($lists)) {
					$imgloc = "". GP_LOCATE . "img/mkarte/" . $lists . ".gif";
					//$img = imagecreatefromgif($imgloc);
					list($width, $height) = getimagesize($imgloc);
					$width2 = $width - 60;
					$height2 = $height - 60;
					$pic_x_max = ($width) / 60;
					$pic_y_max = ($height) / 60;
					$maxwidth = round((540 - $width) / 60);
					$maxheight = round((540 - $height) / 60);
					$start_x = $xtile[$i];
					$start_y = $start_y_org = $xtile[$z];
					$temp = array();
					if ($start_x < 11820 && $start_y < 11820) {
						$tile_counter[] = $lists;
						for ($iii = 0; $iii <= $width2 / 60; $iii++) {
							if ($start_x >= 11820&& $start_y >= 11820) {
								unset($temp);
								break;
							}
							for ($zzz = 0; $zzz <= $height2 / 60; $zzz++) {
								$temp[] = "$start_x $start_y";
								$start_y += 60;
							}
							$start_x += 60;
							$start_y = $start_y_org;

						}
						$notallow = $tiles = 0;
						foreach ($temp as $temporary) {
							//foreach ($max as $max2) {
								if (in_array($temporary, $max) != false) {
									$notallow = 1;
									break;
								}
						   // }
						}

						if($notallow == 1){
							unset($temp);
							continue;
						}

						$maxcounter = 0;
						if ($notallow == 0) {
							foreach ($temp as $temporary) {
								$max[] = $temporary;
								$tile_split = preg_split('#(?=\d)(?<=[a-z])#i', $tile_counter[0]);
								$xtp = 0;
								for ($rand3 = -99; $rand3 <= 99; $rand3++) {
									$maptile[$xtp] = $rand3;
									$xtp += 60;
								}
								$xtp2 = 0;
								for ($rand4 = 99; $rand4 > -99; $rand4--) {
									$maptile2[$xtp2] = $rand4;
									$xtp2 += 60;
								}

								$res = explode(' ', $temporary);
								$x = $maptile[$res[0]];
								$y = $maptile2[$res[1]];

								$t = $tiles;
								$notil = $tile_split[0] . '_' . $tile_split[1];
								$text = $notil . "_" . $t;
								$rander = rand(0, 10);
								
								$advance = '';

								if ($rander < 5) {
									if ($tile_split[0] == 'lake') {
										$advance = "`oasistype` = " . rand(10, 12) . " , `fieldtype` = 0 , ";
									} elseif ($tile_split[0] == 'hill') {
										$advance = "`oasistype` = " . rand(7, 9) . " , `fieldtype` = 0 , ";
									} elseif ($tile_split[0] == 'clay') {
										$advance = "`oasistype` = " . rand(4, 6) . " , `fieldtype` = 0 , ";
									} elseif ($tile_split[0] == 'forest') {
										$advance = "`oasistype` = " . rand(1, 3) . " , `fieldtype` = 0 , ";
									}
								} else {
									$advance = "`oasistype` = 0 , `fieldtype` = 0 , ";
								}

								$q = "UPDATE " . TB_PREFIX . "wdata set $advance `image` = '$notil' , `pos` ='$t' WHERE x = '$x' AND y = '$y'";
								$database->query($q);
								$tiles++;
							}
						}
						//$maxcounter++;
					}
				}
				$rand_z = rand(1, 4);
			}
			$rand_i = rand(1, 4);
		}
		
		// Natars
		$wid = $this->getWref(0, 0); $uid = 2;
        $status = $database->getVillageState($wid);
        if($status == 0) {
        	$database->setFieldTaken($wid);
        	$database->addVillage($wid, $uid, 'Natars', '1');
        	$database->addResourceFields($wid, $database->getVillageType($wid));
        	$database->addUnits($wid);
        	$database->addTech($wid);
        	$database->addABTech($wid);
        }
        $database->query("UPDATE " . TB_PREFIX . "vdata SET pop = '781' WHERE owner = $uid");
        $database->query("UPDATE " . TB_PREFIX . "units SET u41 = " . (274700 * SPEED) . ", u42 = " . (995231 * SPEED) . ", u43 = 10000, u44 = " . (3048 * SPEED) . ", u45 = " . (964401 * SPEED) . ", u46 = " . (617602 * SPEED) . ", u47 = " . (6034 * SPEED) . ", u48 = " . (3040 * SPEED) . " , u49 = 1, u50 = 9 WHERE vref = " . $wid . "");
		$status = 0;
		for($i=1;$i<=13;$i++){
			$nareadis = NATARS_MAX;
			do{
				$x = rand(3,intval(floor(NATARS_MAX)));if(rand(1,10)>5)$x = $x*-1;
				$y = rand(3,intval(floor(NATARS_MAX)));if(rand(1,10)>5)$y = $y*-1;
				$dis = sqrt(($x*$x)+($y*$y));
				$wid = $this->getWref($x, $y);
				$status = $database->getVillageState($wid);
			}while(($dis>$nareadis) || $status!=0);
			if($status == 0) {
				$database->setFieldTaken($wid);
				$database->addVillage($wid, $uid, 'Natars', '1');
				$database->addResourceFields($wid, $database->getVillageType($wid));
				$database->addUnits($wid);
				$database->addTech($wid);
				$database->addABTech($wid);
				$database->query("UPDATE " . TB_PREFIX . "vdata SET pop = '238' WHERE wref = '$wid'");
				$database->query("UPDATE " . TB_PREFIX . "vdata SET name = 'WW Village' WHERE wref = '$wid'");
				$database->query("UPDATE " . TB_PREFIX . "vdata SET capital = 0 WHERE wref = '$wid'");
				$database->query("UPDATE " . TB_PREFIX . "vdata SET natar = 1 WHERE wref = '$wid'");
				$database->query("UPDATE " . TB_PREFIX . "units SET u41 = " . (rand(3000, 6000) * SPEED) . ", u42 = " . (rand(4500, 6000) * SPEED) . ", u43 = 10000, u44 = " . (rand(635, 1575) * SPEED) . ", u45 = " . (rand(3600, 5700) * SPEED) . ", u46 = " . (rand(4500, 6000) * SPEED) . ", u47 = " . (rand(1500, 2700) * SPEED) . ", u48 = " . (rand(300, 900) * SPEED) . " , u49 = 0, u50 = 9 WHERE vref = " . $wid . "");
				$database->query("UPDATE " . TB_PREFIX . "fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 10, f19t = 23, f19 = 10, f99t = 40, f26 = 0, f26t = 0, f21 = 1, f21t = 15, f39 = 1, f39t = 16 WHERE vref = " . $wid . "");
			}
		}
		
		// Oasis
		$database->poulateOasisdata();
		$database->populateOasis();
		$database->populateOasisUnitsLow();
		
		// Install Villages for support and multihunter
		$frandom0 = rand(0, 3); $frandom1 = rand(0, 3); $frandom2 = rand(0, 4); $frandom3 = rand(0, 3);
		$database->addHeroFace(1, $frandom0, $frandom1, $frandom2, $frandom3, $frandom3, $frandom2, $frandom1, $frandom0, $frandom2);
		$database->addHero(1);
		//$database->updateUserField(1, "act", "", 1);
		$this->generateBase('', 1, 'Support');
		$database->modifyUnit($database->getVFH(1), 'hero', 1, 1);
		$database->modifyHero(1, 0, 'wref', $database->getVFH(1), 0);
		for ($s = 1; $s <= 3; $s++) {
			$database->addAdventure($database->getVFH(1), 1);
		}
		$database->modifyGold($uid, 1000, 1);
		$database->query("INSERT INTO " . TB_PREFIX . "users_setting (`id`) values ('1')");
		
		$frandom0 = rand(0, 3); $frandom1 = rand(0, 3); $frandom2 = rand(0, 4); $frandom3 = rand(0, 3);
		$database->addHeroFace(4, $frandom0, $frandom1, $frandom2, $frandom3, $frandom3, $frandom2, $frandom1, $frandom0, $frandom2);
		$database->addHero(4);
		//$database->updateUserField(4, "act", "", 1);
		$this->generateBase('', 4, 'Multihunter');
		$database->modifyUnit($database->getVFH(4), 'hero', 1, 1);
		$database->modifyHero(4, 0, 'wref', $database->getVFH(4), 0);
		for ($s = 1; $s <= 3; $s++) {
			$database->addAdventure($database->getVFH(4), 1);
		}
		$database->modifyGold($uid, 1000, 1);
		$database->query("INSERT INTO " . TB_PREFIX . "users_setting (`id`) values ('4')");
		
		header('Location: panel.php?p=2&done');
	}
	
	function generateBase($kid, $uid, $username){
		global $database;
		if ($kid == '') {
			$kid = rand(1, 4);
		}
		if ($kid == 'nw') {
			$kid = 2;
		} elseif ($kid == 'no') {
			$kid = 3;
		} elseif ($kid == 'sw') {
			$kid = 1;
		} elseif ($kid == 'so') {
			$kid = 4;
		}

		$wid = $database->generateBase($kid);
		
		$database->setFieldTaken($wid);
		$database->addVillage($wid, $uid, $username, 1);
		$database->addResourceFields($wid, $database->getVillageType($wid));
		$database->addUnits($wid);
		$database->addTech($wid);
		$database->addABTech($wid);
		$database->updateUserField($uid, "location", "", 1);
		
        }
	
	
	public function getFieldType($wref){
		global $database;
		$isoasis = $database->isVillageOases($wref);
		if ($isoasis) {
			$get = $database->getOMInfo($wref);
			$type = $get['type'];
		} else {
			$get = $database->getMInfo($wref);
			$type = $get['fieldtype'];
		}
		
		switch ($type) {
			case 1:
			case 2:
			case 3:
				return 'forest';
			break;
			case 4:
			case 5:
			case 6:
				return 'grassland';
			break;
			case 7:
			case 8:
			case 9:
				return 'mountain';
			break;
			case 10:
			case 11:
			case 12:
				return 'sea';
			break;
			default:
				return 'clay';
			break;
		}
		
	}
	
	public function getData($table,$addon='',$column=''){
		global $database;
		
		if(isset($column)){
			return mysqli_fetch_assoc($database->query("SELECT ".$column." FROM ".$table." ".$addon.""));
		}else{
			return mysqli_fetch_assoc($database->query("SELECT * FROM ".$table." ".$addon.""));
		}
	}
	
	public function userData($id, $required){
		global $database;
		$Query = $database->query("SELECT * FROM ".TB_PREFIX."users WHERE id=".$id."");
		$userData = mysqli_fetch_assoc($Query);
		
		return $userData[$required];
	}
	
	public function setLang($lang){
		if(in_array($lang, array("ar","en"))){
			$_SESSION['language'] = $lang;
			header("Location: dorf1.php");

		}
	}
	
	public function getSVG($idBuilding, $t, $isWall = ''){
		global $session;
		//echo $idBuilding; die();
		if(!empty($isWall)){
			switch($idBuilding){
				case '31Bottom': // Teuton
					$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
				break;
				case '31Top': // Teuton
					$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
				break;
				case '32Bottom': // Teuton
					$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
				break;
				case '32Top': // Teuton
					$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
				break;
				case '33Bottom': // 
					$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
				break;
				case '33Top': // 
					$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
				break;

				case '42Bottom': // 
					$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
				break;
				case '42Top': // 
					$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
				break;


				case '43Bottom': // 
					$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
				break;
				case '43Top': // 
					$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
				break;
			}
		}else{
			switch($idBuilding){
				
				case 0:				
					$sVG = '
					<svg class="buildingShape iso" width="120" height="120" viewBox="0 0 120 120" >
					<g class="clickShape">
						<path d="M49.4 70.4c-7.8 1.8-13.5 4.7-16.8 8.6-3.5 4.3-4.1 7.2-2.1 11.3 3.3 7.1 13.9 11.7 28.5 12.4 19.8 1.1 35-6.5 35-17.5 0-4.9-5.8-10.2-14.2-13.1-8.1-2.8-22-3.6-30.4-1.7z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
					</g>
					<g class="hoverShape">
						<path d="M49.4 70.4c-7.8 1.8-13.5 4.7-16.8 8.6-3.5 4.3-4.1 7.2-2.1 11.3 3.3 7.1 13.9 11.7 28.5 12.4 19.8 1.1 35-6.5 35-17.5 0-4.9-5.8-10.2-14.2-13.1-8.1-2.8-22-3.6-30.4-1.7z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
					</g>
					<g class="clickShapeWinter">
						<path d="M49.4 70.4c-7.8 1.8-13.5 4.7-16.8 8.6-3.5 4.3-4.1 7.2-2.1 11.3 3.3 7.1 13.9 11.7 28.5 12.4 19.8 1.1 35-6.5 35-17.5 0-4.9-5.8-10.2-14.2-13.1-8.1-2.8-22-3.6-30.4-1.7z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
					</g>
					<g class="hoverShapeWinter">
						<path d="M49.4 70.4c-7.8 1.8-13.5 4.7-16.8 8.6-3.5 4.3-4.1 7.2-2.1 11.3 3.3 7.1 13.9 11.7 28.5 12.4 19.8 1.1 35-6.5 35-17.5 0-4.9-5.8-10.2-14.2-13.1-8.1-2.8-22-3.6-30.4-1.7z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
					</g>
					</svg>
					';

				break;
				
				
				
				case 16:
					$sVG = '
					<svg width="125" height="160" viewBox="0 0 125 160" class="buildingShape g16">
    <g class="clickShape">
        <path d="M113.5 112.5c-1.3-8.8-2.4-11.4-4.7-11.5-.4 0-.7-2.6-.6-5.8 0-7.1-1-13-3-15.9-1.6-2.6-3.2-3-3.2-.9a2.53 2.53 0 0 1-1.5 2c-.8.3-2.8 4.9-13.5-.4l-9.36-22a15.87 15.87 0 0 1-.07-10.76L85.3 25.4c1.8-.6 2.4-2.4.7-2.4l-3.21-2.2-.09-.1a6.89 6.89 0 0 0-2.18-1.5L74.67 14l-.48.13a9.34 9.34 0 0 0-1.69-.53 4.38 4.38 0 0 1-3.1-3.2C69 9 68.2 8.1 67.6 8.3s-3.1.2-5.4-.3-4.2-.3-4.2.2-1 .8-2.2.7c-4-.4-5.9.1-5.3 1.1.8 1.3-.1 1.3-2.6 0-1.5-.9-1.9-.7-1.9.6s-.4 1.4-1.2.7c-2.5-2-4.8-2.2-6.3-.7-1.2 1.3-2.1 1.4-5 .4s-3.9-.9-5.1.1-1.8.9-2.6.1-1.6-.4-3.2 1.2c-1.8 1.9-3.1 2.2-8.9 2-6.7-.1-6.9 0-6.4 2.3.3 1.5 0 2.3-1 2.3-.8 0-1.2.4-.9.9s-.4 1.2-1.7 1.5c-2.2.6-2.2.7-.3 2.1 1.7 1.3 6 2.1 8.9 1.6.4 0 .7.3.7.9s2.1 1 4.6 1c3.9 0 4.5.2 3.4 1.4-.65.87-.61 1.37.66 1.88l3.45 9.78a.56.56 0 0 0 .19.53L32 61.1l-2 8.79a.57.57 0 0 0 0 .21c0 .39.4.65 1 .79l5.63 4.64c.13.3.27.47.41.47a.34.34 0 0 0 .11 0L54.4 90.2c-.3.4 5.8 3.9 13.6 7.8 0 0 6.71 4.69 9.67 10s2.17 11.23 1.44 11.57c-6.64 3.1-15.11 7.56-15.11 8.23L43.59 140c-1-.08-1.59.23-1.59 1 0 1.4 10 6.2 11.7 5.6h.08l5.31 2.51v.32c1.3 1.2 9.1 4.6 10.4 4.6s1.69-.35 1.44-.93l5.61-3.61a8.07 8.07 0 0 0 1.95.54c1.92 0 1.95-.82.44-2.07l3.94-2.54c3.06 1.28 4.12 1.1 4.12-.49 0-.2-.56-.66-1.42-1.24l3.82-2.46 9.8-4.8c8.7-4.3 12.2-7.3 8.6-7.4-.7 0-.4-.6.7-1.2a23.18 23.18 0 0 0 4.2-3.3c2.31-2.23 2.31-2.33.81-12.03z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
    </g>
    <g class="hoverShape">
        <path d="M58 8.2c0 .5-1 .8-2.2.7-4-.4-5.9.1-5.3 1.1.8 1.3-.1 1.3-2.6 0-1.5-.9-1.9-.7-1.9.6s-.4 1.4-1.2.7c-2.5-2-4.8-2.2-6.3-.7-1.2 1.3-2.1 1.4-5 .4s-3.9-.9-5.1.1-1.8.9-2.6.1-1.6-.4-3.2 1.2c-1.8 1.9-3.1 2.2-8.9 2-6.7-.1-6.9 0-6.4 2.3.3 1.5 0 2.3-1 2.3-.8 0-1.2.4-.9.9s-.4 1.2-1.7 1.5c-2.2.6-2.2.7-.3 2.1 1.7 1.3 6 2.1 8.9 1.6.4 0 .7.3.7.9s2.1 1 4.6 1c3.9 0 4.5.2 3.4 1.4-.9 1.2-.5 1.7 2.7 2.5a89 89 0 0 0 8.8 1.5c6.1.6 5.5.4 5.5 1.6 0 .5-.9 1-2.1 1s-1.7.4-1.4 1-.7 1-2.7 1c-3.4.1-7.7 2.5-6.5 3.6.4.4 3 1.1 5.9 1.5 5.5.9 8.8 3.5 8.8 7a3.67 3.67 0 0 1-1.7 2.8c-1.7 1-1.6 1 .2 1.1 1.4.1 1.6.3.5.7-2.6 1-7 5.6-7 7.4a2.76 2.76 0 0 0 1.9 2.4c1 .3 1.8 1.1 1.8 1.8-.2 5.4.5 10.7 1.3 10.7.6 0 1-1.7 1-3.8 0-3.7.1-3.8 3-3.4 3.7.5 3.9 1.9.5 3.4-3.8 1.7-3 3.4 1.3 2.9.7-.1 1.2 1 1.2 2.9 0 2.8 1.4 4.2 2.2 2.1.2-.5 2.7-2.1 5.7-3.6 3.9-1.9 5.1-2.9 4.2-3.8s-2.3-.5-5.6 1.1c-2.6 1.2-4.7 1.7-5 1.2s.9-1.7 2.8-2.6c2.4-1.2 3.3-2.2 3-3.4a1.65 1.65 0 0 1 1.4-2.2c1-.3 2.6-.9 3.6-1.3 1.5-.6 1.7-.1 1.9 4.1.1 3.8.2 4.1.5 1.4.9-9 1.3-10 3.9-10 4.1 0 6.8-3.4 6.7-8.2-.2-4.1-1.7-6.2-4-5.3a1 1 0 0 1-1.3-1c0-2.2-3.7-2.8-6.4-1l-2.4 1.6.1-3.8a24.08 24.08 0 0 0-.7-6c-1.1-3.1 5.3-7.3 11.2-7.3a18.74 18.74 0 0 0 7.4-1.6 21.68 21.68 0 0 1 6.7-2 54.25 54.25 0 0 0 5.4-1c1.8-.6 2.4-2.4.7-2.4-.6 0-2.1-1-3.3-2.3-1.6-1.6-3.4-2.2-6.4-2.2-3.7 0-4-.2-2.7-1.6 1.9-2.1 1.8-2.6-1.1-3.3a4.38 4.38 0 0 1-3.1-3.2C69 9 68.2 8.1 67.6 8.3s-3.1.2-5.4-.3-4.2-.3-4.2.2zm-1 19.2c0 .9-.7 1.2-2 .9-1.1-.3-2-.9-2-1.4s.9-.9 2-.9 2 .6 2 1.4zm-9.2 6.5q.45 1.35-.9.6a9 9 0 0 0-3.7-1.1c-4.1-.5-3.9-1.6.2-1.2 2.2.2 4.1.9 4.4 1.7zm2.5 7.7c1 1-1.5 5.3-4 7-1.4.8-2.6 1.4-2.7 1.2-1.8-2.9-2.5-6.2-1.5-7.4 1.1-1.4 7-2 8.2-.8zM47 53.1c-1.1.8-.6.9 2.1.6 3.2-.5 3.8-.2 4.8 1.9 1.6 3.5 1.5 3.7-2.1 3.2-2.2-.4-3.6 0-4.4 1-.6.8-1.6 1.2-2.2.8-1.6-1-1.5-2.2.3-3.9 1.3-1.3 1.3-1.6 0-2.1-2.3-.8-1.8-2.6.8-2.6 1.8 0 1.9.2.7 1.1zM31.8 68.7c-1 .3-1.8.9-1.8 1.4 0 1.2 3.7 1.2 4.5 0s-.5-1.9-2.7-1.4zm70.2 9.7a2.53 2.53 0 0 1-1.5 2 3.16 3.16 0 0 0-1.5 2.8c-.1 5.5-1.3 5.6-12 .3l-10-4.9L65.9 84c-6.1 3-11.3 5.8-11.5 6.2S60.2 94.1 68 98l14 7 7-3.5c6.8-3.4 6.9-3.4 5.9-1.1a8.44 8.44 0 0 1-3.5 3.5c-2.1.9-2.4 1.7-2.4 6.6 0 5.1-.2 5.5-2.7 6.1-3.7.9-22.3 10.2-22.3 11.2 0 .4 5.7 3.6 12.7 7.1l12.7 6.3 9.8-4.8c8.7-4.3 12.2-7.3 8.6-7.4-.7 0-.4-.6.7-1.2a23.18 23.18 0 0 0 4.2-3.3c2.3-2.2 2.3-2.3.8-12-1.3-8.8-2.4-11.4-4.7-11.5-.4 0-.7-2.6-.6-5.8 0-7.1-1-13-3-15.9-1.6-2.6-3.2-3-3.2-.9zM63 99c0 .5 1.2 1 2.6 1s2.3-.4 1.9-1-1.5-1-2.6-1-1.9.4-1.9 1zm-3.5 1c-.3.5.1 1 1 1s1.3-.5 1-1-.8-1-1-1-.7.4-1 1zm0 32c-1 1.5 10.2 6.7 11.6 5.3.9-.9-.2-1.8-3.9-3.7-5.6-2.8-6.8-3.1-7.7-1.6zm-7 5c-.9 1.5 10.2 6.7 11.6 5.3.8-.8-.1-1.8-3.3-3.7-4.7-2.7-7.3-3.2-8.3-1.6zm23 3.1c-.9 1.4-.5 1.7 5.4 4.4 4.6 2.2 6.1 2.3 6.1.4 0-.8-9.1-5.9-10.4-5.9-.3 0-.8.5-1.1 1.1zM42 141c0 1.4 10 6.2 11.7 5.6 2.1-.8.9-2.1-4.2-4.5-4.8-2.3-7.5-2.7-7.5-1.1zm26.5 3.1c-.4.6-.5 1.2-.4 1.3 1.3 1.2 9.1 4.6 10.4 4.6 3 0 1.4-2-3.5-4.5-5.6-2.9-5.7-2.9-6.5-1.4zm-9 4c-.4.6-.5 1.2-.4 1.3 1.3 1.2 9.1 4.6 10.4 4.6 3 0 1.4-2-3.5-4.5-5.6-2.9-5.7-2.9-6.5-1.4z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
    </g>
</svg>
					';
				
				break;
				
				case 31:
			$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
						break;
				
				case 32:
						$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
						break;
						
					case 33:
					$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
					break;
					case 42:
						$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
						break;

					case 43:
						$sVG = '<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape wallBottom">
                                    <g class="clickShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                    <g class="hoverShape">
                                       <path d="M588 436c-54.6 24.76-139.16 38-213 38-85.26 0-183 1.06-241-31-64.24-35.51-82.38-116.45-82.38-172.86a121.71 121.71 0 0 1 9.21-46H34.34a11.56 11.56 0 0 1-1.92 1.86h-3.3l-1.45 1.91c-1.46.29-2.68-.41-3.93.82a14.22 14.22 0 0 0-2.74 9.51c.2 2.85.59 5.89-1.8 8.11v6.29c3.34 3.34 3.34 3.34 3.9 5.82L20 261v3.6c.81.38 1.13 1.64 2.45 1.38l2.07-2c4.75 2.82 4.75 2.82 7.79 7.85h3.15c.84 1.23 2.24 1.75 2.68 3.39-2.39 4.29-.72 8.84-.07 12.78-1.3 3.24-5.44.49-6.07 3.92 0 1 1 1.25 1.4 1.92 1.81.42 3.77-.33 5.53.42-1.29 2.13-2.36 4-1.91 6.16l-2 2v4.11a30.2 30.2 0 0 0-7.17 8.73l3 3.05v4.2c-.69.94-1.75 1.32-1.88 2.44.41 2.41 2.89 1.54 4.55 2.76a6 6 0 0 0 2.63 3.75c-1.07 3.73 1.64 7.2.61 11.47l2.3 1.43c-.31 1.36.4 2.59-.54 3.56-2.85.39-3.54.87-3.54 2.46l1.5 1.62h6.09c.74 1.94 2 3.54 1.43 5.26l2.36 2.64c3.62.19 6.82 1.9 10.08 1.06a7.63 7.63 0 0 1 2.56 4.42L57.52 367h-8l-1.35 1.35v4c1.58 2.42 3.81 3.52 5.8 4.9v2.92c.89 1.48 2.55 2.22 3.1 3.83.57 1.43-1.57 2.15-1 3.32l1.4 1.63h5.44c-.43 1.79 1.21 2.37 2 3.33a10 10 0 0 1-3.49 4.72h-3.58l-2.4-3c-2 0-4-.42-4.45 2.16.41 1.53 1.88 1.6 3 2.29v1.41c0 4.56-1.58 8.08-5.77 10.63a23.75 23.75 0 0 1-6 2.45 2.63 2.63 0 0 0-2.24 2.2l.87 1.49-2.85 2.86c.42 1.76-.63 3.12-1.46 4.38-1.26 1.9-.36 3 1.25 4.34 2.63-1.32 5 1.54 7.68.78 1.7 1.71 3.39 3.2 4.38 5.33a7.9 7.9 0 0 0 4.88 4.68c0 1.92 1.32 3.4.37 5.33-.57 1.16.89 2.68 2.29 2.68l2.09-1.89h4.17a8.61 8.61 0 0 0 3.18 2.29c1.11.53 2.5.78 3.16 2.13v2.07c2.56 1.54 3.39 4.44 4.88 7v4c-.69 1-1.79 1.33-1.87 2.49a2.76 2.76 0 0 0 3.39 1.9c2.09-1.46 3.12-3.59 4-5.91h4.27c2.77 2.69 4.1 5.62 2.73 8.57l2.06 3.47h3.41c1.57 2.72 4.62 3.64 6.77 5.92 3.63-.82 7.1 1.73 10.42 1a9.09 9.09 0 0 1 5.88 5.59 2.08 2.08 0 0 0-.82 2.58 2.36 2.36 0 0 0 2 1.82c11.08-6.19 11.08-6.19 15.8-5.6 3 2.33-.4 4.76.18 7.13.74.58 1.17 1.67 3.13 1.33l3.33-3.92c1.68.24 3.19-.36 4.72.62a14 14 0 0 0-1.11 8c.67.42.92 1.42 2 1.39s1.2-1 2-1.55v-3c1.06-1.44 2.19-1.83 3.77-1.18V497l3 3.36c4.68 2.37 9 1.16 13.13 1.82-.36 2 .23 3.15 1.84 3.79 1.48 0 1.69-2 3.16-2h2.48c2.23.91 2.16 3.62 3.93 4.94h2c.94-.5 1.32-1.85 2.59-2a6.68 6.68 0 0 0 6.88.48c2-1.09 3-.21 4.12 1.23v5c.8.22.92 1.38 2.06 1.32 1.28-.48 2.18-1.31 1.89-2.89s1-2.59 1.36-4h4.28l2.93 3c2.58.48 2.22-3.82 4.79-3.91s4.9 0 7.24 0l5.21 5 2-2c2.74-.25 4.84-.48 6.52 1.1 1.58-2.09 4.09-2.45 5.19-4.14h8.14l1.88 1.87c1.11.17 2.29-.3 3.35.32.32 2.26 1.62 3 3.77 2.59 1.47-.88 1.31-3 2.9-3.86h1.93l4.49 4.15c2.19-.89 1.91-3.33 3.61-4.18h2.32l1.83 2.34c5.27-2 10.66-1.17 15.61-1.36 2.36 1.21 1.08 4.12 3.4 5h2.82c3.08-3.38 7.22-3 10.18-3l5.51-5.51c-.47-1.27-1.8-3-1-5.22l2.27-2.26h4.1c1.55 2.25 4.23 3.23 6 4.83 1.79.78 2.56-1.1 3.61-.9 1.73 1 3.44 1.64 4.45 3.25 2.47-1 4.47.72 6.48.84l2.21-2.21h6.39c.67-.78 1.56-1.16 1.25-2.39.39-.56-1.35-.33-.58-1.35h13.15l3 3c2.19-1.24 2.81 1.61 4 1.91 3.3-.77 2-3.32 2.5-4.79 2.46-.71 4-3.46 6.8-1.87v1.79c-.91 2.11-3.18 1.71-3.81 3.36-.53 1.8.31 2.83 1.81 3.51a12.5 12.5 0 0 0 5.45-3.89 2.54 2.54 0 0 1 3.45-.87c.26 1.52.18 3.28 2.39 3.75a5.37 5.37 0 0 0 3-5.24c4.28 1.66 6.75-2.4 10.24-3 1.51 3.82 1.64 8.06 5.41 10.29 2.6-1 5-2.39 7.74-2 .63 1.13.72 2.59 2.24 3 .5 0 1.12.19 1.48 0 3.06-1.85 6.38-1.23 9.45-.52a4.46 4.46 0 0 0 3.88-.36 24 24 0 0 0 5.82-4c1.41.05 2.73-.25 4.13.87s2.81-1.39 4.51-.91c1.39.14 1.56 2.21 3.36 2 4.4-1.89 9.21-.53 13.78-1.05 1.51.9 2.18 2.62 4 3.17l2.23-2h4.08c.89.69 1.32 1.7 2.81 2 1.57-1.67 3.54-3.31 6.34-3.08s4.19 2.72 6.39 4.44c1.55-2 4-1.94 5.65-3.63 3.37-3.51 8.07-3.85 12.39-5.05 4.2 4.05 8.9 3.11 13.54 3.25.29 1.32 1.43.94 2.52 1 1.09-1.14 3.43-.87 3.78-3.06.43-2.69 3.45-1.22 4.58-2.92.44-.66.07-1.69 1.08-2 .46 0 1.11.21 1.43 0 4.75-3.51 10.61-2.53 15.88-3.91 3.36-.88 6.47.93 9.43 2 .54-.54 1.13-.85 1.21-1.26.58-2.78 1.06-5.59 1.58-8.44l2.27-2.4h3.06l1.61 1.61v5c1.7 2 3.19 1.86 4.76 0v-3.2c-.53-.75-1.54-1.1-1.69-2.1 1-.93 2-1.79 2.12-3.29 2.43 0 5 .42 6.8-1.66 1.65-1.93 4.84-1.7 6.14-4.63L580 473.7l.49-.67h-4.39v-2.63c3.93-2.43 7.21-6.45 12.76-5 0 3.7 4.51 1.93 5.57 4.53.13.33 1.47.17 2.41.24l2.7-5.06h3a4.44 4.44 0 0 0 1.83-3.05c2.4.5 4.63-.51 7-1.08l3.13 3a2 2 0 0 0 2.07-1.08c2.54-3.34 7.38-6.4 11.58-6.82a4.33 4.33 0 0 0 2.86-1.6v-5c2.16-2 3-5.1 6.1-6.66 2 1.83 4.83 2.08 7.26 3.25 2.59-2.15 2.44-5.5 4.16-7.72a19.67 19.67 0 0 1 5.9-3.49c.42 1.28 1.6 1.15 3.27 1.09.24-2.74 3.41-1.21 4.76-3 .8 1.07.85 2.8 3.15 3l1-1.95.41.4v-3.86l9.52-9.62h4.8l4 4c.58.06.82-1 1.47-1.37.63-1.17-.49-2.66.74-3.71h4l1.33-1.33c1-1.73-1.1-2.68-.84-4.25 1.85-.89 1.86-3.31 3.52-4.36h9c3 2.9 6.7 1.72 9.89 2 2.74-1.89 1-4.51 1.71-6.61 2.6-.52 3.16-2.72 4-4.89l-2-1.47h-3.7l-2.12-2.12h-3.28L709 395l2.92-2.92c.24-1.73-.24-2.91.43-4 1.71-.43 4.22.74 4.7-2.57l-3.22-3.23c.43-1.79.36-3.3-1.19-4.15-1.2-.66-2.3.12-3.37.69-.36-1.19-1.56-.55-2.12-1.21a4.14 4.14 0 0 0 .81-3.26c-.79-.17-.88-1.59-2.18-1.39l-1.39.88c-1-1.29-3.45-.89-3.37-3.52 1.53-.63 4.48-.1 3.86-3.85-2-1.21-1.79-3.91-2.8-5.62 1.08-2.56 2.91-1.77 4.49-1.83.81 1.07.7 3 2.7 3 1.79-.84 1.9-2.77 2.76-4.11l-3-5.64c.08-.85-.36-2 .7-3.82.65-1.78 5 1.14 5.25-2.64l-4.61-4.52 4.7-4.7c.18-1-.55-2-1.94-2.6-1.67.79-3.45 2.09-5-.52v-3.27c2.86-1.36 5-3.26 5-6.76 1.39-.23.19-2.93 2.42-2.5.37.07 1.28-.81 1.35-1.33.49-3.74 3.85-6 4.38-9.23 2.59-1.47 3.21 1.38 5.26 1.91.74-2 3.13-2 4.58-3.94-.82-3 1.09-5.71 1.94-8.76l-2-2.14v-2.95l-1.51-1.5c-1.85-.34-4.08.8-5.6-1.72V288h-22.69C694.84 344.42 658.8 403.89 588 436z" onclick="window.location.href=\'build.php?id='.$t.'&fastUP=0\'"></path>
                                    </g>
                                 </svg>';
						break;
				
				default:
					$sVG = FALSE;
				break;
			}
			}
		return $sVG;
	}
	
	public function getTitle($i){
		global $building,$village,$lang;
		//global $village;
		
		
		if($village->resarray['f' . ($i) . 't'] == 5 
			|| $village->resarray['f' . ($i) . 't'] == 6
			|| $village->resarray['f' . ($i) . 't'] == 7
			|| $village->resarray['f' . ($i) . 't'] == 7
			|| $village->resarray['f' . ($i) . 't'] == 9
		){
			$maxLevel = 5;
		}elseif($village->resarray['f' . ($i) . 't'] == 23
			|| $village->resarray['f' . ($i) . 't'] == 35){
			$maxLevel = 10;
		}else{
			$maxLevel = 20;
		}

			if($village->resarray['f'.$i] != $maxLevel){
				$loopsame[$i] = $building->isCurrent($i) ? 1 : 0;
				$doublebuild[$i] = 0;
				if ($loopsame[$i] > 0 && $building->isLoop($i)) {
					$doublebuild[$i] = 1;
				}
				$uprequire[$i] = $building->resourceRequired($i, $village->resarray['f' . $i . 't'], ($loopsame[$i] > 0 ? 2 : 1) + $doublebuild[$i]);
				$nextLevel[$i] = $village->resarray['f' . $i] + ($loopsame[$i] > 0 ? 2 : 1);
				
				return htmlentities($lang['buildings'][$village->resarray['f'.$i.'t']]." <span class=\"level\">".$lang['Build']['Level']." ".$village->resarray['f'.$i]."</span>||".$lang['Build']['Costs']." ".$nextLevel[$i].":
                <br/>
	            <div class=\"inlineIconList resourceWrapper\">
                    <div class=\"inlineIcon resources\" title=''>
                        <i class=\"r1\"></i>
						<span class=\"value\">".$uprequire[$i]['wood']."</span>
                    </div>
                    <div class=\"inlineIcon resources\" title=''>
                        <i class=\"r2\"></i>
                        <span class=\"value\">".$uprequire[$i]['clay']."</span>
                    </div>
                    <div class=\"inlineIcon resources\" title=''>
                        <i class=\"r3\"></i>
                        <span class=\"value\">".$uprequire[$i]['iron']."</span>
                    </div>
	                <div class=\"inlineIcon resources\" title=''>
	                    <i class=\"r4\"></i>
	                    <span class=\"value\">".$uprequire[$i]['crop']."</span>
	                </div>
	            </div>
				");				
			}else{
				return $lang['buildings'][$village->resarray['f'.$i.'t']]."&amp;nbsp;&lt;span class=&quot;".BD_LEVEL."&quot;&gt;".BD_LEVEL." ".$village->resarray['f'.$i]."&lt;/span&gt;||&lt;span class=&quot;notice&quot;&gt;".constant('B'.$village->resarray['f'.$i.'t'])." ".MAXLEVEL.".&lt;/span&gt;";
			}
	}
	
	public function getStatus($i){
		$i = $i+18;
		global $building,$village;

		$bindicate[$i] = $building->canBuild($i, $village->resarray['f' . $i . 't']);
		if (in_array($bindicate[$i], array(1,2,3,4,5,6,7,10,11,20,21,22,88))) {
			return 'notNow';
		}else{
			return 'good';
		}
	}	
	
	public function heroStatus(){
		global $session, $database;
		// 1 -> in village , 2 -> in adventure , 3 -> returning to village , 4 -> support to a village 5 trapped 6 attacking
		$hero = $database->getHeroData($uid);
		
		foreach ($session->villages as $myvill) {
			
			if($hero['dead'] == 1){
				return array(
					'status' => 7,
					'atVillage' => $database->getHeroTrain($myvill)['vref']
				);

			}
			// In one of player villages
			$q3 = $database->query("SELECT * from " . TB_PREFIX . "units where `vref` = '" . $myvill . "' AND hero = 1");
			$d3 = mysqli_fetch_assoc($q3);
			
			if(mysqli_num_rows($q3) != 0){
				return array(
					'status' => 1,
					'atVillage' => $d3['vref']
				);
				break;
			}
			
			// In adventure
			if (!empty($database->getMovement(9, $myvill, 0))) {
				foreach($database->getMovement(9, $myvill, 0) as $Adventure) {					
					return array(
						'status' => 2,
						'atVillage' => $Adventure['to']
					);				
					break;
				}
			}
			
			// Returning from adventure
			if (!empty($database->getMovement(10, $myvill, 1))) {
				foreach($database->getMovement(10, $myvill, 1) as $Adventure) {
					return array(
						'status' => 3,
						'atVillage' => $Adventure['to'],
						'endTime' => $Adventure['endtime']
					);				
					break;
				}
			}
			
			// Returning from village
			$q9 = $database->query("SELECT * from " . TB_PREFIX . "movement where `to` = '" . $myvill . "' AND isHero = 1 AND proc = 0");
			$d9 = mysqli_fetch_assoc($q9);
			
			if(mysqli_num_rows($q9) != 0){
				return array(
					'status' => 9,
					'atVillage' => $d9['to'],
					'endTime' => $d9['endtime']
				);
				break;
			}
			
			// attacking a village
			$q10 = $database->query("SELECT * from " . TB_PREFIX . "movement where `from` = '" . $myvill . "' AND isHero = 1 AND proc = 0");
			$d10 = mysqli_fetch_assoc($q10);
			
			if(mysqli_num_rows($q10) != 0){
				return array(
					'status' => 10,
					'atVillage' => $d10['to'],
					'endTime' => $d10['endtime']
				);
				break;
			}
			
			
			// Support to a village
			$q1 = $database->query("SELECT * from " . TB_PREFIX . "enforcement where `from` = '" . $myvill . "' AND hero = 1");
			$d1 = mysqli_fetch_assoc($q1);
			
			if(mysqli_num_rows($q1) != 0){
				return array(
					'status' => 4,
					'atVillage' => $d1['vref']
				);
				break;
			}
			
			// Trapped
			$q2 = $database->query("SELECT * from " . TB_PREFIX . "trapped where `from` = '" . $myvill . "'  AND hero = 1");
			$d2 = mysqli_fetch_assoc($q2);
			if(mysqli_num_rows($q2) != 0){
				return array(
					'status' => 6,
					'atVillage' => $d2['vref']
				);
				break;
			}
			
			// Hero in revive
			if($database->getHeroTrain($myvill)){
				return array(
					'status' => 8,
					'atVillage' => $database->getHeroTrain($myvill)['vref'],
					'checkT' => $database->getHeroTrain($myvill)
				);		
				break;
			}
		}
	}
	
	public function adventureData($id){
		global $database, $session, $generator;
		
		
		$Query = $database->query("SELECT * from " . TB_PREFIX . "adventure where `wref` = '" . $id . "' AND end = 0");
		$Result = mysqli_fetch_assoc($Query);
		
		
		if(mysqli_num_rows($Query) == 0){
			header('Location: hero.php?t=3'); exit();
		}else{
			
			$heroData = $database->getHero($session->uid);
			
			$eigen = $database->getCoor($heroData['wref']);
			$coor = $database->getCoor($id);
			$from = array('x' => $eigen['x'], 'y' => $eigen['y']);
			$to = array('x' => $coor['x'], 'y' => $coor['y']);
			$speed = $heroData['speed'] + $heroData['itemspeed'];
			$time = $generator->procDistanceTime($from, $to, $speed, 1);
			
			return array(
				'time' => $generator->getTimeFormat($time),
				'back' => $generator->getTimeFormat($time*2)
			);
		}
	}
	
	public function getAllpop($type, $level){		
		global $database;
		
		$name = "bid".$type;
		global $$name;
		$dataarray = $$name;
		$pop=0; $cp=0;
		for($i=1;$i<=$level;$i++){			
			$pop = $pop + $dataarray[($i)]['pop'];
			$cp = $cp+ $dataarray[($i)]['cp'];
		}

		return array($pop,$cp);
	}

	public function array_flatten($array) { 
		if (!is_array($array)) { 
		  return FALSE; 
		} 
		$result = array(); 
		foreach ($array as $key => $value) { 
		  if (is_array($value)) { 
			$result = array_merge($result, array_flatten($value)); 
		  } 
		  else { 
			$result[$key] = $value; 
		  } 
		} 
		return $result; 
	  } 

	  public function getItemData($btype, $type){
		if($btype==1){
    
			if($type==1){
				$name = ITEM0;
				$title = IEFF0;
				$item = 1;
				$effect = 15;
			}elseif($type==2){
				$name = ITEM1;
				$title = IEFF1;
				$item = 2;
				$effect = 20;
			}elseif($type==3){
				$name = ITEM2;
				$title = IEFF2;
				$item = 3;
				$effect = 25;
			}
			if($type==4){
				$name = ITEM3;
				$title = IEFF3;
				$item = 4;
				$effect = 10;
			}elseif($type==5){
				$name = ITEM4;
				$title = IEFF4;
				$item = 5;
				$effect = 15;
			}elseif($type==6){
				$name = ITEM5;
				$title = IEFF5;
				$item = 6;
				$effect = 20;
			}
			if($type==7){
				$name = ITEM6;
				$title = IEFF6;
				$item = 7;
				$effect = 100;
			}elseif($type==8){
				$name = ITEM7;
				$title = IEFF7;
				$item = 8;
				$effect = 400;
			}elseif($type==9){
				$name = ITEM8;
				$title = IEFF8;
				$item = 9;
				$effect = 800;
			}
			if($type==10){
				$name = ITEM9;
				$title = IEFF9;
				$item = 10;
				$effect = 10;
			}elseif($type==11){
				$name = ITEM10;
				$title = IEFF10;
				$item = 11;
				$effect = 15;
			}elseif($type==12){
				$name = ITEM11;
				$title = IEFF11;
				$item = 12;
				$effect = 20;
			}
			if($type==13){
				$name = ITEM12;
				$title = IEFF12;
				$item = 13;
				$effect = 10;
			}elseif($type==14){
				$name = ITEM13;
				$title = IEFF13;
				$item = 14;
				$effect = 15;
			}elseif($type==15){
				$name = ITEM14;
				$title = IEFF14;
				$item = 15;
				$effect = 20;
			}
			
		}elseif($btype==2){
	
			if($type==82){
				$name = ITEM15;
				$title = IEFF15;
				$item = 82;
				$effect = 20;
			}elseif($type==83){
				$name = ITEM16;
				$title = IEFF16;
				$item = 83;
				$effect = 30;
			}elseif($type==84){
				$name = ITEM17;
				$title = IEFF17;
				$item = 84;
				$effect = 40;
			}
			if($type==85){
				$name = ITEM18;
				$title = IEFF18;
				$item = 85;
				$effect = 10;
			}elseif($type==86){
				$name = ITEM19;
				$title = IEFF19;
				$item = 86;
				$effect = 15;
			}elseif($type==87){
				$name = ITEM20;
				$title = IEFF20;
				$item = 87;
				$effect = 20;
			}
			if($type==88){
				$name = ITEM21;
				$title = IEFF21;
				$item = 88;
				$effect = 500;
			}elseif($type==89){
				$name = ITEM22;
				$title = IEFF22;
				$item = 89;
				$effect = 1000;
			}elseif($type==90){
				$name = ITEM23;
				$title = IEFF23;
				$item = 90;
				$effect = 1500;
			}
			if($type==91){
				$name = ITEM24;
				$title = IEFF24;
				$item = 91;
				$effect = 3;
			}elseif($type==92){
				$name = ITEM25;
				$title = IEFF25;
				$item = 92;
				$effect = 4;
			}elseif($type==93){
				$name = ITEM26;
				$title = IEFF26;
				$item = 93;
				$effect = 5;
			}
			
		}elseif($btype==3){
		
			if($type==61){
				$name = ITEM27;
				$title = IEFF27;
				$item = 61;
				$effect = 30;
			}elseif($type==62){
				$name = ITEM28;
				$title = IEFF28;
				$item = 62;
				$effect = 40;
			}elseif($type==63){
				$name = ITEM29;
				$title = IEFF29;
				$item = 63;
				$effect = 50;
			}
			if($type==64){
				$name = ITEM30;
				$title = IEFF30;
				$item = 64;
				$effect = 30;
			}elseif($type==65){
				$name = ITEM31;
				$title = IEFF31;
				$item = 65;
				$effect = 40;
			}elseif($type==66){
				$name = ITEM32;
				$title = IEFF32s;
				$item = 66;
				$effect = 50;
			}
			if($type==67){
				$name = ITEM33;
				$title = IEFF33;
				$item = 67;
				$effect = 15;
			}elseif($type==68){
				$name = ITEM34;
				$title = IEFF34;
				$item = 68;
				$effect = 20;
			}elseif($type==69){
				$name = ITEM35;
				$title = IEFF35;
				$item = 69;
				$effect = 25;
			}
			if($type==73){
				$name = ITEM36;
				$title = IEFF36;
				$item = 73;
				$effect = 10;
			}elseif($type==74){
				$name = ITEM37;
				$title = IEFF37;
				$item = 74;
				$effect = 15;
			}elseif($type==75){
				$name = ITEM38;
				$title = IEFF38;
				$item = 75;
				$effect = 20;
			}
			if($type==76){
				$name = ITEM39;
				$title = IEFF39;
				$item = 76;
				$effect = 500;
			}elseif($type==77){
				$name = ITEM40;
				$title = IEFF40;
				$item = 77;
				$effect = 1000;
			}elseif($type==78){
				$name = ITEM41;
				$title = IEFF41;
				$item = 78;
				$effect = 1500;
			}
			if($type==79){
				$name = ITEM42;
				$title = IEFF42;
				$item = 79;
				$effect = 20;
			}elseif($type==80){
				$name = ITEM43;
				$title = IEFF43;
				$item = 80;
				$effect = 25;
			}elseif($type==81){
				$name = ITEM44;
				$title = IEFF44;
				$item = 81;
				$effect = 30;
			}
			
	}elseif($btype==4){
    
		if($type==16){
        	$name = ITEM45;
        	$title = IEFF45;
            $item = 16;
            $effect = 500;
		}elseif($type==17){
        	$name = ITEM46;
        	$title = IEFF46;
            $item = 17;
            $effect = 1000;
		}elseif($type==18){
        	$name = ITEM47;
        	$title = IEFF47;
            $item = 18;
            $effect = 1500;
		}
        if($type==19){
        	$name = ITEM48;
        	$title = IEFF48;
            $item = 19;
            $effect = 500;
        }elseif($type==20){
        	$name = ITEM49;
        	$title = IEFF49;
            $item = 20;
            $effect = 1000;
        }elseif($type==21){
        	$name = ITEM50;
        	$title = IEFF50;
            $item = 21;
            $effect = 1500;
        }
        if($type==22){
        	$name = ITEM51;
			$title = IEFF51;
            $item = 22;
            $effect = 500;
		}elseif($type==23){
        	$name = ITEM52;
			$title = IEFF52;
            $item = 23;
            $effect = 1000;
		}elseif($type==24){
        	$name = ITEM53;
			$title = IEFF53;
            $item = 24;
            $effect = 1500;
		}
        if($type==25){
        	$name = ITEM54;
			$title = IEFF54;
            $item = 25;
            $effect = 500;
		}elseif($type==26){
        	$name = ITEM55;
			$title = IEFF55;
            $item = 26;
            $effect = 1000;
		}elseif($type==27){
        	$name = ITEM56;
			$title = IEFF56;
            $item = 27;
            $effect = 1500;
		}
        if($type==28){
        	$name = ITEM57;
        	$title = IEFF57;
            $item = 28;
            $effect = 500;
        }elseif($type==29){
        	$name = ITEM58;
        	$title = IEFF58;
            $item = 29;
            $effect = 1000;
        }elseif($type==30){
        	$name = ITEM59;
        	$title = IEFF59;
            $item = 30;
            $effect = 1500;
        }
        if($type==31){
        	$name = ITEM60;
			$title = IEFF60;
            $item = 31;
            $effect = 500;
		}elseif($type==32){
        	$name = ITEM61;
			$title = IEFF61;
            $item = 32;
            $effect = 1000;
		}elseif($type==33){
        	$name = ITEM62;
			$title = IEFF62;
            $item = 33;
            $effect = 1500;
		}
        if($type==34){
        	$name = ITEM63;
        	$title = IEFF63;
            $item = 34;
            $effect = 500;
        }elseif($type==35){
        	$name = ITEM64;
        	$title = IEFF64;
            $item = 35;
            $effect = 1000;
        }elseif($type==36){
        	$name = ITEM65;
        	$title = IEFF65;
            $item = 36;
            $effect = 1500;
        }
        if($type==37){
        	$name = ITEM66;
			$title = IEFF66;
            $item = 37;
            $effect = 500;
		}elseif($type==38){
        	$name = ITEM67;
			$title = IEFF67;
            $item = 38;
            $effect = 1000;
		}elseif($type==39){
        	$name = ITEM68;
			$title = IEFF68;
            $item = 39;
            $effect = 1500;
		}
        if($type==40){
        	$name = ITEM69;
			$title = IEFF69;
            $item = 40;
            $effect = 500;
		}elseif($type==41){
        	$name = ITEM70;
			$title = IEFF70;
            $item = 41;
            $effect = 1000;
		}elseif($type==42){
        	$name = ITEM71;
			$title = IEFF71;
            $item = 42;
            $effect = 1500;
		}
        if($type==43){
        	$name = ITEM72;
        	$title = IEFF72;
            $item = 43;
            $effect = 500;
        }elseif($type==44){
        	$name = ITEM73;
        	$title = IEFF73;
            $item = 44;
            $effect = 1000;
        }elseif($type==45){
        	$name = ITEM74;
        	$title = IEFF74;
            $item = 45;
            $effect = 1500;
        }
        if($type==46){
        	$name = ITEM75;
			$title = IEFF75;
            $item = 46;
            $effect = 500;
		}elseif($type==47){
        	$name = ITEM76;
			$title = IEFF76;
            $item = 47;
            $effect = 1000;
		}elseif($type==48){
        	$name = ITEM77;
			$title = IEFF77;
            $item = 48;
            $effect = 1500;
		}
        if($type==49){
        	$name = ITEM78;
        	$title = IEFF78;
            $item = 49;
            $effect = 500;
        }elseif($type==50){
        	$name = ITEM79;
        	$title = IEFF79;
            $item = 50;
            $effect = 1000;
        }elseif($type==51){
        	$name = ITEM80;
        	$title = IEFF80;
            $item = 51;
            $effect = 1500;
        }
        if($type==52){
        	$name = ITEM81;
			$title = IEFF81;
            $item = 52;
            $effect = 500;
		}elseif($type==53){
        	$name = ITEM82;
			$title = IEFF82;
            $item = 53;
            $effect = 1000;
		}elseif($type==54){
        	$name = ITEM83;
			$title = IEFF83;
            $item = 54;
            $effect = 1500;
		}
        if($type==55){
        	$name = ITEM84;
			$title = IEFF84;
            $item = 55;
		}elseif($type==56){
        	$name = ITEM85;
			$title = IEFF85;
            $item = 56;
		}elseif($type==57){
        	$name = ITEM86;
			$title = IEFF86;
            $item = 57;
		}
        if($type==58){
        	$name = ITEM87;
        	$title = IEFF87;
            $item = 58;
            $effect = 500;
        }elseif($type==59){
        	$name = ITEM88;
        	$title = IEFF88;
            $item = 59;
            $effect = 1000;
        }elseif($type==60){
        	$name = ITEM89;
        	$title = IEFF89;
            $item = 60;
            $effect = 1500;
        }
        
	}elseif($btype==5){
		
			if($type==94){
				$name = ITEM90;
				$title = IEFF90;
				$item = 94;
				$effect = 10;
			}elseif($type==95){
				$name = ITEM91;
				$title = IEFF91;
				$item = 95;
				$effect = 15;
			}elseif($type==96){
				$name = ITEM92;
				$title = IEFF92;
				$item = 96;
				$effect = 20;
			}
			if($type==97){
				$name = ITEM93;
				$title = IEFF93;
				$item = 97;
				$effect = 25;
			}elseif($type==98){
				$name = ITEM94;
				$title = IEFF94;
				$item = 98;
				$effect = 30;
			}elseif($type==99){
				$name = ITEM95;
				$title = IEFF95;
				$item = 99;
				$effect = 35;
			}
			if($type==100){
				$name = ITEM96;
				$title = IEFF96;
				$item = 100;
				$effect = 3;
			}elseif($type==101){
				$name = ITEM97;
				$title = IEFF97;
				$item = 101;
				$effect = 4;
			}elseif($type==102){
				$name = ITEM98;
				$title = IEFF98;
				$item = 102;
				$effect = 5;
			}
			
		}elseif($btype==6){
			if($type==103){
				$name = ITEM99;
				$title = IEFF99;
				$item = 103;
				$effect = 14;
			}elseif($type==104){
				$name = ITEM100;
				$title = IEFF100;
				$item = 104;
				$effect = 17;
			}elseif($type==105){
				$name = ITEM101;
				$title = IEFF101;
				$item = 105;
				$effect = 20;
			}
			
		}elseif($btype==7){
			$name =  ITEM102;
			$title =  IEFF102;
			$item = 112;
		}elseif($btype==8){
			$name = ITEM103;
			$title =  IEFF103;
			$item = 113;
		}elseif($btype==9){
			$name = ITEM104;
			$title =  IEFF104;
			$item = 114;
		}elseif($btype==10){
			$name = ITEM105;
			$title = IEFF105;
			$item = 107;
		}elseif($btype==11){
			$name = ITEM106;
			$title = IEFF106;
			$item = 106;
		}elseif($btype==12){
			$name = ITEM107;
			$title = IEFF107;
			$item = 108;
		}elseif($btype==13){
			$name = ITEM108;
			$title = IEFF108;
			$item = 110;
		}elseif($btype==14){
			$name = ITEM109;
			$title = IEFF109;
			$item = 109;
		}elseif($btype==15){
			$name = ITEM110;
			$title = IEFF110;
			$item = 111;
		}	
		
		return array(
			'name' =>$name,
			'title'=>$title,
			'item' => $item
		);
	  }
	  
	  public function getAutoRenewal($type){
		global $database, $session;
		$q = $database->query("SELECT * FROM autorenewals WHERE userid = ".$session->uid."");

		foreach($q as $auto){
			return $auto[$type];
		}
	  }
}

$Travian = new newTravian;

if(isset($_GET['lang'])){
	$Travian->setLang($_GET['lang']);
}
?>