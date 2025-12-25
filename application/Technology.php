<?php
class Technology {

	public $unarray = array(1=>U1,U2,U3,U4,U5,U6,U7,U8,U9,U10,U11,U12,U13,U14,U15,U16,U17,U18,U19,U20,U21,U22,U23,U24,U25,U26,U27,U28,U29,U30,U31,U32,U33,U34,U35,U36,U37,U38,U39,U40,U41,U42,U43,U44,U45,U46,U47,U48,U49,U50,U51,U52,U53,U54,U55,U56,U57,U58,U59,U60,U61,U62,U63,U64,U65,U66,U67,U68,U69,U70,U0);

	public function grabAcademyRes() {
		global $village,$database;
		$holder = array();
		foreach($database->getResearching($village->wid) as $research) {
			if(substr($research['tech'],0,1) == "t"){
				array_push($holder,$research);
			}
		}
		return $holder;
	}

	public function getABUpgrades($type='a') {
		global $village,$database;
		$holder = array();
		foreach($database->getResearching($village->wid) as $research) {
			if(substr($research['tech'],0,1) == $type){
				array_push($holder,$research);
			}
		}
		return $holder;
	}

	public function isResearch($tech,$type) {
		global $village,$database;
		$research0=$database->getResearching($village->wid);
		if(count($research0) == 0) {
			return false;
		}
		else {
		switch($type) {
			case 1: $string = "t"; break;
			case 2: $string = "a"; break;
			case 3: $string = "b"; break;
		}
		foreach($research0 as $research) {
			if($research['tech'] == $string.$tech) {
				return true;
			}
		}
		return false;
		}
	}

	public function procTech($post) {
		if(isset($post['ft'])) {
			switch($post['ft']) {
				case "t1":
				$this->procTrain($post);
				break;
				case "t3":
				$this->procTrain($post,true);
				break;
			}
		}
	}

	public function procTechno($get) {
		global $village;
		if(isset($get['a'])) {
			switch($village->resarray['f'.$get['id'].'t']) {
				case 22:
				$this->researchTech($get);
				break;
				case 12:
				$this->upgradeSword($get);
				break;
			}
		}
	}

	public function getTrainingList($type) {
		global $database,$village;
		$trainingarray = $database->getTraining($village->wid);
		$listarray = array();
		$barracks = array(1,2,3,11,12,13,14,21,22,31,32,33,34,41,42,43,44,51,52,53,61,62);
		$greatbarracks = array(61,62,63,71,72,73,74,81,82,91,92,93,94,101,102,103,104,111,112,113,121,122);
		$stables = array(4,5,6,15,16,23,24,25,26,35,36,45,46,54,55,56,63,64,65,66);
		$greatstables = array(64,65,66,75,76,83,84,85,86,95,96,105,106,114,115,116,123,124,125,126);
		$workshop = array(7,8,17,18,27,28,37,38,47,48,57,58,67,68);
		$residence = array(9,10,19,20,29,30,39,40,49,50,59,60,69,70);

		if(count($trainingarray) > 0) {
			foreach($trainingarray as $train) {
				if($train['amt']>0) { //что б не inыinодить 0 юнитоin
					if ($type == 1 && in_array($train['unit'], $barracks)) {
						$train['name'] = $this->unarray[$train['unit']];
						array_push($listarray, $train);
					}
					if ($type == 2 && in_array($train['unit'], $stables)) {
						$train['name'] = $this->unarray[$train['unit']];
						array_push($listarray, $train);
					}
					if ($type == 3 && in_array($train['unit'], $workshop)) {
						$train['name'] = $this->unarray[$train['unit']];
						array_push($listarray, $train);
					}
					if ($type == 4 && in_array($train['unit'], $residence)) {
						$train['name'] = $this->unarray[$train['unit']];
						array_push($listarray, $train);
					}
					if ($type == 5 && in_array($train['unit'], $greatbarracks)) {
						$train['name'] = $this->unarray[$train['unit'] - 60];
						array_push($listarray, $train);
					}
					if ($type == 6 && in_array($train['unit'], $greatstables)) {
						$train['name'] = $this->unarray[$train['unit'] - 60];
						array_push($listarray, $train);
					}
					if ($type == 8 && $train['unit'] == 99) {
						$train['name'] = $this->unarray[99];
						array_push($listarray, $train);
					}
				}
			}
		}
		return $listarray;
	}



	public function maxUnit($unit,$great=false) {
		$unit = "u".$unit;
		global $village,$$unit;
		$unitarray = $$unit;
		$woodcalc = floor($village->awood / ($unitarray['wood'] * ($great?3:1)));
		$claycalc = floor($village->aclay / ($unitarray['clay'] * ($great?3:1)));
		$ironcalc = floor($village->airon / ($unitarray['iron'] * ($great?3:1)));
		if($village->acrop>0){
		$cropcalc = floor($village->acrop / ($unitarray['crop'] * ($great?3:1)));
		}else{
		$cropcalc = 0;
		}


		return min($woodcalc,$claycalc,$ironcalc,$cropcalc);
	}

	public function maxUnitPlus($unit,$great=false) {
		$unit = "u".$unit;
		global $village,$$unit;
		$unitarray = $$unit;
		$totalres = $village->awood+$village->aclay+$village->airon+$village->acrop;
		$totalresunit = ($unitarray['wood'] * ($great?3:1))+($unitarray['clay'] * ($great?3:1))+($unitarray['iron'] * ($great?3:1))+($unitarray['crop'] * ($great?3:1));
		$max =round($totalres/$totalresunit);
		return $max;
	}





	public function meetTRequirement($unit) {
		global $session;
		switch($unit) {
			case 1:
			case 10:
            return ($session->tribe == 1);
			break;
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
			case 7:
			case 8:
			return ($this->getTech($unit) && $session->tribe == 1);
			break;
			case 11:
			case 20:
			return ($session->tribe == 2);
			break;
			case 12:
			case 13:
			case 14:
			case 15:
			case 16:
			case 17:
			case 18:
			return ($session->tribe == 2 && $this->getTech(($unit-10)));
			break;
			case 21:
			case 30:
            return ($session->tribe == 3);
			break;
			case 22:
			case 23:
			case 24:
			case 25:
			case 26:
			case 27:
			case 28:
            return ($session->tribe == 3 && $this->getTech(($unit-20)));
			break;
            default:
            return false;
		}
	}

	public function getTech($tech) {
		global $village;
		$techarray=$village->tech;
		return ($techarray['t'.$tech] == 1);
	}

	private function procTrain($post,$great=false) {
		//Array ( [id] => 31 [ft] => t1 [t11] => 313352 [t12] => 0 )
		global $session;

		$start = ($session->tribe-1)*10+1;
		$end = ($session->tribe*10);

		for($i=$start;$i<=($end);$i++) {
			if(isset($post['t'.$i]) && $post['t'.$i] != 0) {
				$amt = preg_replace("/[^0-9]/","",$post['t'.$i]);
				$amt = intval($amt);
				if ($amt < 0){ $amt = 0; }
				if($amt>0){ $this->trainUnit($i,$amt,$great); }
			}
		}


		// Gauls Traps
		if($session->tribe==3 && isset($post['t999']) && $post['t999']>0){
			$amt = preg_replace("/[^0-9]/","",$post['t999']);
			
			$amt = intval($amt);

			if ($amt < 0){ $amt = 0; }
			if($amt>0){
					global $village;
					global $bid36;
				
					$train_amt=0;
					$trainlist = $this->getTrainingList(8);
					foreach($trainlist as $train) {
						$train_amt += $train['amt'];
					}
					
					$max1 = 0;
					for($i=19;$i<41;$i++){
						if($village->resarray['f'.$i.'t'] == 36){
							$max1 += $bid36[$village->resarray['f'.$i]]['attri']*TRAPPER_CAPACITY;
						}
					}
					
					$max = $max1 - ($village->unitarray['u99'] + $train_amt + $village->unitarray['o99']);
					
					if($max < 0){
						$max = 0;
					}
					
					if($amt > $max)$this->trainUnit(99,$max,false);
					else $this->trainUnit(99,$amt,false);
			}
		}
		header("Location: build.php?id=".$post['id']);

	}


private function trainUnit($unit,$amt,$great=false) {
		global $session,$database,${'u'.$unit},$building,$village,$bid19,$bid20,$bid21,$bid25,$bid26,$bid29,$bid30,$bid41,$bid36;
		$techfor=$unit;
		if($unit>10 and $unit<=20){$techfor=$unit-10;}elseif($unit>20 and $unit<=30){$techfor=$unit-20;}
		if($unit>50 and $unit<=60){$techfor=$unit-50;}elseif($unit>60 and $unit<=70){$techfor=$unit-60;}
		if($this->getTech($techfor) || $unit%10 <= 1 || $unit==99 && $session->tribe==3) {
			$footies = array(1,2,3,11,12,13,14,21,22, 31, 32, 33, 34, 41, 42, 43, 44,51,52,53,61,62);
			$calvary = array(4,5,6,15,16,23,24,25,26, 35, 36, 45, 46,54,55,56,64,65,66);
			$workshop = array(7,8,17,18,27,28, 37, 38, 47, 48,57,58,67,68);
			$special = array(9,10,19,20,29,30, 39, 40, 49, 50,59,60,69,70);
            $notfake=true;
            $kazarma=$great?29:19;
            $horses=$great?30:20;


            if($session->heroD['wref']!=$village->wid){
                $bonuses['barrack']=$bonuses['stable']=1;
            }else{
                $bonuses=$database->allHeroBonuses($database->getHeroInventory($session->uid));
            }
			if(in_array($unit,$footies)) {
                if($building->getTypeLevel($kazarma) > 0){
				if($great) {
					//$each = round(($bid29[$building->getTypeLevel(29)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED);
					$each = ($bid29[$building->getTypeLevel(29)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED*$bonuses['barrack'];
				} else {
					$each = ($bid19[$building->getTypeLevel(19)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED*$bonuses['barrack'];
				}
                }else{$notfake=false;}
			}
			if(in_array($unit,$calvary)) {
                if($building->getTypeLevel($horses) > 0){
				if($great) {
					$each = ($bid30[$building->getTypeLevel(30)]['attri'] * ($building->getTypeLevel(41)>=1?(1/$bid41[$building->getTypeLevel(41)]['attri']):1) / 100) * ${'u'.$unit}['time'] / SPEED*$bonuses['stable'];
				} else {
					$each = ($bid20[$building->getTypeLevel(20)]['attri'] * ($building->getTypeLevel(41)>=1?(1/$bid41[$building->getTypeLevel(41)]['attri']):1) / 100) * ${'u'.$unit}['time'] / SPEED*$bonuses['stable'];
				}
                }else{$notfake=false;}
			}
			if(in_array($unit,$workshop)) {
                if($building->getTypeLevel(21) > 0){
					$each = ($bid21[$building->getTypeLevel(21)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED;
                }else{$notfake=false;}
			}
			if(in_array($unit,$special)) {
				
				if($building->getTypeLevel(25) > 0){
					$each = ($bid25[$building->getTypeLevel(25)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED;
				} elseif($building->getTypeLevel(26) || $building->getTypeLevel(44)) { // iRedux
					$each = ($bid26[$building->getTypeLevel(26)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED;
				}else{$notfake=false;}
			}
            if($unit==99) {
                $maxamt=0;
                for($i=19;$i<=40;$i++) {
                    if($village->resarray['f'.$i.'t']==36){
                        $maxamt+=$bid36[$village->resarray['f'.$i]]['attri']*TRAPPER_CAPACITY;
                }
                }
                if($village->unitarray['u99']+$village->unitarray['o99']>$maxamt){$notfake=false;}

                if($building->getTypeLevel(36) > 0){
                    $each = ($bid19[$building->getTypeLevel(36)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED;//специально bid19
                }else{$notfake=false;}
            }

			if($notfake){
				if(($unit%10 == 0 || $unit%10 == 9) && $unit!=99) {
					$slots = $database->getAvailableExpansionTraining($session->tribe,$village->wid);
					if($unit%10 == 0 && $slots['settlers'] <= $amt) { $amt = $slots['settlers']; }
					if($unit%10 == 9 && $slots['chiefs'] <= $amt) { $amt = $slots['chiefs']; }
				} else {

					if($this->maxUnit($unit,$great) < $amt) {
						$amt = 0;
					}
			}
			$wood = ${'u'.$unit}['wood'] * $amt * ($great?3:1);
			$clay = ${'u'.$unit}['clay'] * $amt * ($great?3:1);
			$iron = ${'u'.$unit}['iron'] * $amt * ($great?3:1);
			$crop = ${'u'.$unit}['crop'] * $amt * ($great?3:1);
			$each=round($each,5);
			$array=array(0.00001,$each);
			$each=max($array);

			// iRedux -> plus thing
			$each = ($each - (0.25 * $each));

			if($database->modifyResource($village->wid,$wood,$clay,$iron,$crop,0) && $amt > 0) {

				// iRedux 
                if($session->acData['a8'] < 60){
					if(in_array($unit,$footies)) {
						if($session->acData['a8'] == 0){
							if($amt > 60){
								$pAdd = 60;
							}else{
								$pAdd = $amt;
							}

						}else{
							$pAll = $amt + $session->acData['a8'];
							if($pAll > 60){
								$pAdd = 60 - $session->acData['a8'];
							}else{
								$pAdd = $amt;
							}
						}
						$database->UpdateAchievU($session->uid,"`a8`=a8+".$pAdd."");
					}
				}

                if($session->acData['a9'] < 60){
					if(in_array($unit,$calvary)) {
						if($session->acData['a9'] == 0){
							if($amt > 60){
								$pAdd = 60;
							}else{
								$pAdd = $amt;
							}

						}else{
							$pAll = $amt + $session->acData['a9'];
							if($pAll > 60){
								$pAdd = 60 - $session->acData['a9'];
							}else{
								$pAdd = $amt;
							}
						}
						$database->UpdateAchievU($session->uid,"`a9`=a9+".$pAdd."");
					}
				}


				if($session->qArrayB1[0] == 5 && $session->qArrayB1[1] == 0){
					if(in_array($unit,$footies)) {
						if($amt > 1){
							$database->query("UPDATE quests SET battle1='5,1' WHERE userid = ".$session->uid."");
						}
					}
				}
				
				$this->trainUnit2($village->wid,$unit+($great?60:0),$amt,$each,$session->uid);
			}
}
		}
	}

    function trainUnit2($vid, $unit, $amt,  $each, $uid) {
        global  $database, $p;
        echo $unit;
        $barracks = array(1,2,3,11,12,13,14,21,22,31,32,33,34,41,42,43,44,51,52,53,61,62);
		$greatbarracks = array(1,2,3,11,12,13,14,21,22,31,32,33,34,41,42,43,44,51,52,53,61,62);
		$stables = array(4,5,6,15,16,23,24,25,26,35,36,45,46,54,55,56,63,64,65,66);
		$greatstables = array(4,5,6,15,16,23,24,25,26,35,36,45,46,54,55,56,63,64,65,66);
		$workshop = array(7,8,17,18,27,28,37,38,47,48,57,58,67,68);
		$residence = array(9,10,19,20,29,30,39,40,49,50,59,60,69,70);

            $queued=array();
            if(in_array($unit, $barracks)) {
                $queued = $this->getTrainingList(1);
            } elseif(in_array($unit, $stables)) {
                $queued = $this->getTrainingList(2);
            } elseif(in_array($unit, $workshop)) {
                $queued = $this->getTrainingList(3);
            } elseif(in_array($unit, $residence)) {
                $queued = $this->getTrainingList(4);
            } elseif(in_array($unit, $greatstables)) {
                $queued = $this->getTrainingList(6);
            } elseif(in_array($unit, $greatbarracks)) {
                $queued = $this->getTrainingList(5);
            }elseif($unit ==99) {

                $queued = $this->getTrainingList(8);
            }

            $artefact = $database->checkArtefactsEffects($uid,$vid,5);

            $each*=$artefact;
            $each=round($each,5);
            $array=array(0.00001,$each);
			$each=max($array);
			
			// iRedux -> plus thing
			$each = ($each - (0.25 * $each));

			$time=$amt*$each; //чистое inремя на постройку юнитоin
			

			$coqu=count($queued); //считаем кол-inо строчек тренироinок
			$num=$coqu-1;

            if($coqu > 0) { //если строчек больше чем одна то надо inзять inремя последней и прибаinить ей чистое inремя а то хуйня какая-то
                $last=$queued[$num]['timestamp'];
                $time+=$queued[$num]['timestamp'];
            }else{

                $time+=time();
                $last=time();
            }

            if(($queued[$num]['unit'] == $unit) AND ($each==$queued[$num]['eachtime'])){
                $timeadd = $amt*$each;
                $q = "UPDATE training SET amt = amt + ".$amt.", timestamp = timestamp + ".$timeadd." WHERE id = '".$queued[$num]['id']."'";

            }else{
                $q = "INSERT INTO training values (0,'".$vid."','".$unit."','".$amt."','".$time."','".$each."','".$last."')";
                 echo $q;
            }

        $database->query($q);

    }

	public function meetRRequirement($tech) {
		global $building;
		$b22=$building->getTypeLevel(22);
		switch($tech) {
			case 2:
			if($b22 >= 1 && $building->getTypeLevel(12) >= 1) { return true; } else { return false; }
			break;
			case 3:
			if($b22 >= 5 && $building->getTypeLevel(12) >= 1) { return true; } else { return false; }
			break;
			case 4:
			case 23:
			if($b22 >= 5 && $building->getTypeLevel(20) >= 1) { return true; } else { return false; }
			break;
			case 5:
			case 25:
			if($b22 >= 5 && $building->getTypeLevel(20) >= 5) { return true; } else { return false; }
			break;
			case 6:
			if($b22 >= 5 && $building->getTypeLevel(20) >= 10) { return true; } else { return false; }
			break;
			case 9:
			case 29:
			if($b22 >= 20 && $building->getTypeLevel(16) >= 10) { return true; } else { return false; }
			break;
			case 12:
			if($b22 >= 1 && $building->getTypeLevel(19) >= 3) { return true; } else { return false; }
			break;
			case 13:
			if($b22 >= 3 && $building->getTypeLevel(12) >= 1) { return true; } else { return false; }
			break;
			case 14:
			if($b22 >= 1 && $building->getTypeLevel(15) >= 5) { return true; } else { return false; }
			break;
			case 15:
			if($b22 >= 1 && $building->getTypeLevel(20) >= 3) { return true; } else { return false; }
			break;
			case 16:
			case 26:
			if($b22 >= 15 && $building->getTypeLevel(20) >= 10) { return true; } else { return false; }
			break;
			case 7:
			case 17:
			case 27:
			if($b22 >= 10 && $building->getTypeLevel(21) >= 1) { return true; } else { return false; }
			break;
			case 8:
			case 18:
			case 28:
			if($b22 >= 15 && $building->getTypeLevel(21) >= 10) { return true; } else { return false; }
			break;
			case 19:
			if($b22 >= 20 && $building->getTypeLevel(16) >= 5) { return true; } else { return false; }
			break;
			case 22:
			if($b22 >= 3 && $building->getTypeLevel(12) >= 1) { return true; } else { return false; }
			break;
			case 24:
			if($b22 >= 5 && $building->getTypeLevel(20) >= 3) { return true; } else { return false; }
			break;

			// new tribes
            case 52: if($building->getTypeLevel(19) >= 1 && $building->getTypeLevel(12) >= 1){ return true; }else{ return false; } break;
			case 53: if($building->getTypeLevel(22) >= 5 && $building->getTypeLevel(12) >= 1){ return true; }else{ return false; } break;
			case 54: if($building->getTypeLevel(20) >= 1 && $building->getTypeLevel(22) >= 5){ return true; }else{ return false; } break;
			case 55: if($building->getTypeLevel(20) >= 5 && $building->getTypeLevel(22) >= 5){ return true; }else{ return false; } break;
			case 56: if($building->getTypeLevel(20) >= 10 && $building->getTypeLevel(22) >= 5){ return true; }else{ return false; } break;
			case 57: if($building->getTypeLevel(22) >= 10 && $building->getTypeLevel(21) >= 5){ return true; }else{ return false; } break;
			case 58: if($building->getTypeLevel(16) >= 10 && $building->getTypeLevel(21) >= 10){ return true; }else{ return false;} break;
			case 59: if($building->getTypeLevel(16) >= 10 && $building->getTypeLevel(22) >= 20){ return true; }else{ return false;} break;
			
			case 62: if($building->getTypeLevel(22) >= 1 && $building->getTypeLevel(12) >= 1){ return true; }else{ return false;} break;
			case 63: if($building->getTypeLevel(22) >= 5 && $building->getTypeLevel(20) >= 1){ return true; }else{ return false;} break;
			case 64: if($building->getTypeLevel(22) >= 5 && $building->getTypeLevel(20) >= 3){ return true; }else{ return false;} break;
			case 65: if($building->getTypeLevel(22) >= 5 && $building->getTypeLevel(20) >= 5){ return true; }else{ return false;} break;
			case 66: if($building->getTypeLevel(22) >= 15 && $building->getTypeLevel(20) >= 10) { return true; }else { return false;} break;
            case 67: if($building->getTypeLevel(22) >= 10 && $building->getTypeLevel(21) >= 1){ return true; }else{ return false;} break;
			case 68: if($building->getTypeLevel(21) >= 10 && $building->getTypeLevel(22) >= 15) { return true; }else{ return false; } break;
            case 69: if($building->getTypeLevel(16) >= 10 && $building->getTypeLevel(22) >= 20){ return true; }else{ return false; } break;

		}
        return false;
	}

	private function researchTech($get) {
		//global $database,$session,${'r'.$get['a']},$village;
		global $database,$session,${'r'.$get['a']},$bid22,$building,$village;
		if($this->meetRRequirement($get['a']) && $get['c'] == $session->mchecker and !$this->isResearch($get['a'],1)) {
			$data = ${'r'.$get['a']};
			if($get['a']>10 and $get['a']<20){$technumb=$get['a']-10;}elseif($get['a']>20 and $get['a']<30){$technumb=$get['a']-20;}elseif($get['a']>50 and $get['a']<60){$technumb=$get['a']-50;}elseif($get['a']<10 and $get['a']>1){$technumb=$get['a'];}elseif($get['a']>60 and $get['a']<70){$technumb=$get['a']-60;}
			$time = time() + round(($data['time'] * ($bid22[$building->getTypeLevel(22)]['attri'] / 100))/SPEED);
			//$time = time() + round($data['time']/SPEED);
			if($database->modifyResource($village->wid,$data['wood'],$data['clay'],$data['iron'],$data['crop'],0)){
			$refid=$database->addResearch($village->wid,"t".$technumb,$time);
                $database->insertQueue($refid, 6, time(),$time);
                         }
		}
		$session->changeChecker();
		header("Location: build.php?id=".$get['id']);
	}

	private function upgradeSword($get) {
		global $database,$session,$bid12,$building,$village;
        $rnow=$this->getABUpgrades('a');
        //print_r($rnow);

        if(count($rnow)<2){
       //     if(!count($rnow)){
		$ABTech = $database->getABTech($village->wid);
		$CurrentTech = $ABTech["a".$get['a']]+("a".$get['a']==$rnow[0]['tech']); //метод inаще Агонь



		$unit = ($session->tribe-1)*10+intval($get['a']);
		if(($this->getTech($get['a']) || ($unit % 10) == 1) && ($CurrentTech < $building->getTypeLevel(12)) && $get['c'] == $session->mchecker and $CurrentTech<=19) {
			global ${'ab'.strval($unit)};
			$data = ${'ab'.strval($unit)};
            $dtime=(count($rnow)>0 && ("a".$get['a']==$rnow[0]['tech']))?$rnow[0]['timestamp']:time();

            $time = $dtime + round(($data[$CurrentTech+1]['time'] * ($bid12[$building->getTypeLevel(12)]['attri'] / 100))/SPEED);
			if ($database->modifyResource($village->wid,$data[$CurrentTech+1]['wood'],$data[$CurrentTech+1]['clay'],$data[$CurrentTech+1]['iron'],$data[$CurrentTech+1]['crop'],0)) {
				$refid=$database->addResearch($village->wid,"a".$get['a'],$time);
                $database->insertQueue($refid, 6, time(),$time);
                if(($CurrentTech+1)==20){
                //$database->UpdateAchievU($session->uid,"`a8`=1"); //ачиinка за прокачку до 20лinла
                }
			}
		}
		$session->changeChecker();
        }//else{
         //       exit;
           // }
		header("Location: build.php?id=".$get['id']);
	}



	public function getUnitName($i) {
		return $this->unarray[$i];
	}


	public function calculateAvaliable($id,$resarray=array()) {
		global $village,$generator,${'r'.$id};
		if(count($resarray)==0) {
			$resarray['wood'] = ${'r'.$id}['wood'];
			$resarray['clay'] = ${'r'.$id}['clay'];
			$resarray['iron'] = ${'r'.$id}['iron'];
			$resarray['crop'] = ${'r'.$id}['crop'];
		}
		$rwtime = ($resarray['wood']-$village->awood) / $village->getProd("wood") * 3600;
		$rcltime = ($resarray['clay']-$village->aclay) / $village->getProd("clay") * 3600;
		$ritime = ($resarray['iron']-$village->airon) / $village->getProd("iron") * 3600;
		$rctime = ($resarray['crop']-$village->acrop) / $village->getProd("crop") * 3600;
		if($village->getProd("crop") >= 0) {
			$reqtime = max($rwtime,$rcltime,$ritime,$rctime) + time();
		} else {
			$reqtime = max($rwtime,$rcltime,$ritime);
			if($reqtime > $rctime) {
				$reqtime = 0;
			} else {
				$reqtime += time();
			}
		}
		return $generator->procMtime($reqtime);
	}





}
$technology = new Technology;