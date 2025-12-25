<?php
class Building {
	public $NewBuilding = false;
	private $maxConcurrent;
	private $allocated;
	private $basic,$inner,$plus = 0;
    public $master = 1;
	public $buildArray = array();

	public function __construct() {
		global $session;
		$this->maxConcurrent = 1;
		if($session->tribe == 1) {
			$this->maxConcurrent += 1;
		}
        if($session->goldclub == 2) {    ///master disable  to enable goldclub == 2 -> 1
            $this->maxConcurrent += 1;
        }
		if($session->plus) {
			$this->maxConcurrent += 1;
		}
		$this->LoadBuilding();
	}

	public function procBuild($get) {		
        global $session,$village,$database;
        // Array ( [а] => 14 [c] => 7gZ )
        $loopforbuild = 0;
		if(isset($get['а']) && $get['c'] == $session->checker && !isset($get['id']) && ($get['а']<=45 && $get['а']>=0 || $get['а']==99)) {
            if($get['а'] == 0) {
                foreach($this->buildArray as $build) {
                if($build['field'] <= 18) {
                    $this->basic = 0;
                }
                else {
                    if($session->tribe == 1) {
                        $this->inner -= 1;
                    }
                    else {
                        $this->basic = 0;
                    }
                }
                }
				$this->removeBuilding($get['d']);
			}else {
                $session->changeChecker();
				$this->upgradeBuilding($get['а']);

			}
          //  $this->buildArray = $database->getJobs($village->wid);
            $this->LoadBuilding();
		}
		if(isset($get['а']) && $get['c'] == $session->checker && isset($get['id']) && ($get['а']<=45 && $get['а']>=1 || $get['а']==99)) {
            if($get['id']==99 and $get['a']=!40){
                $session->changeChecker();
                header("Location: dorf2.php");
                exit();
         	 }else{
                $buildexist = $this->getTypeLevel($get['а']);
                $canbuildsay=false;
                if($buildexist==0){
                    $canbuildsay=true;
                }elseif($buildexist==20 and ($get['а']==10 or $get['а']==11  or $get['а']==38 or $get['а']==39 or $get['а']==36)){
                        $canbuildsay=true;}
                        elseif($get['а']==23 and $buildexist==10){
                        $canbuildsay=true;}
                        $houseexist=$database->getFieldType($village->wid,$get['id']);

                        if($this->inner==0 or $this->basic<=1 or $this->plus==0){
                        $loopforbuild=1;}

                        if($get['а']>4 and $houseexist==0  and $canbuildsay==true and $loopforbuild==1){
                        $session->changeChecker();
                        $this->constructBuilding($get['id'],$get['а']);
                        header("Location: dorf2.php");
                }
		}
           // $this->buildArray = $database->getJobs($village->wid);
            $this->LoadBuilding();
		}
		if(isset($get['buildingFinish'])) {
			if($session->gold >= 2 && $village->natar == 0) {
				$this->finishAll();
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
			}
            $this->LoadBuilding();
		}



        $this->allocated = count($this->buildArray);
        if(count($this->buildArray)){$this->NewBuilding = true;}
	}

	public function canBuild($id,$tid,$demolition='') {

		global $village,$session,$database;

        if(!is_null($demolition) && $demolition==''){
		$demolition = $database->getDemolition($village->wid);
        }
		if($demolition[0]['buildnumber']==$id) { return 11; }

		if($this->isMax($tid,$id)) {
			return 1;
		} else if($this->isMax($tid,$id,1) && ($this->isLoop($id) || $this->isCurrent($id))) {
			return 10;
		} else if($this->isMax($tid,$id,2) && $this->isLoop($id) && $this->isCurrent($id)) {
			return 10;
		}else if($this->isMax($tid,$id,3) && $this->isLoop($id) && $this->isCurrent($id) && $this->isMaster($id)) {
            return 10;
        }
		else {
			
			//if($this->allocated <= $this->maxConcurrent) { //если строющихся на данный момент меньше реального максимума
			if($this->allocated < $this->maxConcurrent) { //если строющихся на данный момент меньше реального максимума

				if(($village->allcrop - $village->pop) <= 6 && $village->resarray['f'.$id.'t'] <> 4) { ///если зерно близко к минуса и это не ферма
					return 4;
				}
                else {
					switch($this->checkResource($tid,$id)){
						case 1:
						return 5;//Upgrade Warehouseы
						break;
						case 2:
						return 6; //разinиinайте амбар
						break;
						case 3:
						return 7; //не хinатает ресоin
						break;
						case 4:
						if($id >= 19) {

							if($session->tribe == 1) {
								if($this->inner == 0) {
									return 8; //если это не поля и ты рим
								}
								else {
									if($session->plus) {
										if($this->plus == 0) {
											return 9; // строим in очередь
                                        }
									}
                                    if($session->goldclub){
                                        if($this->master == 0) {
                                            return 88; //строим с мастером
                                        }
                                    }
										return 2;

								}
							}
							else {//если это не поля и ты НЕ рим

								if($this->basic == 0) {
									return 8;
								}
								else {

									if($session->plus) {
										if($this->plus == 0) {
											return 9;
										}
									}
                                    if($session->goldclub){

                                        if($this->master == 0) {
                                            return 88; //строим с мастером
                                        }
                                    }
										return 2;

								}
							}
						}
						else { // если это поля

							if($this->basic == 1) {
								if($session->plus && $this->plus == 0) {
									return 9;
								}

                                if($session->goldclub){
                                    if($this->master == 0) {
                                        return 88; //строим с мастером
                                    }
                                }
							}
							else {
								return 8;
							}
						}
						break;
					}
				}
			}
			else {
				return 2;//inсе рабочие заняты
			}
		}
		
        return false;
	}

	public function walling() {
		global $session;
		$wall = array(31,32,33,42,43);
		foreach($this->buildArray as $job) {
			if(in_array($job['type'],$wall)) {
				return "3".$session->tribe;
			}
		}
		return false;
	}

	public function rallying() {
		foreach($this->buildArray as $job) {
			if($job['type'] == 16) {
				return true;
			}
		}
		return false;
	}

	public function procResType($ref) {
		global $lang;
		switch($ref) {
			case $ref: $build = $lang['buildings'][$ref]; break;
            default: $build = "Erro"; break;
		}
		return $build;
	}

	private function loadBuilding() {
		global $database,$village,$session;
		$this->buildArray = $database->getJobs($village->wid);

		$this->allocated = count($this->buildArray);
		if($this->allocated > 0) {
			foreach($this->buildArray as $build) {

				if($build['loopcon'] == 1) {
					$this->plus = 1;
				}
				if($build['master'] == 1) {
                    $this->master = 1;
                }
                if(!$build['master'] && !$build['loopcon']){
					if($build['field'] <= 18) {
						$this->basic = 1;
					}
					else {
						if($session->tribe == 1) {
							$this->inner += 1;
						}
						else {
							$this->basic = 1;
						}
					}
				}
            }
			$this->NewBuilding = true;
		}
	}

	private function removeBuilding($d) {
        
		global $database,$village,$session;
        $j=$jj=0;
        $mas=array();
        foreach($this->buildArray as $jobss) {
            $mas[$jobss['type']]=$j;
            $j++;
        }
		foreach($this->buildArray as $jobs) {
			if($jobs['id'] == $d && $mas[$jobs['type']]==$jj) {
                $database->query("DELETE FROM bdata where id = '".$d."'");
                    if($jobs['master'] == 0){
                        if($jobs['level']==1 && $jobs['field']>=19 && $jobs['field']<=40){
                            $database->query("UPDATE fdata SET `f".$jobs['field']."`='0', `f".$jobs['field']."t`=0 WHERE `vref`='".$jobs['wid']."'");
                            $village->resarray=$database->getResourceLevel($jobs['wid']);
                        }
                        $uprequire = $this->resourceRequired($jobs['field'],$jobs['type']);
                        $database->modifyResource($village->wid,$uprequire['wood'],$uprequire['clay'],$uprequire['iron'],$uprequire['crop'],1);
                        $village->awood+=$uprequire['wood'];
                        $village->aclay+=$uprequire['clay'];
                        $village->airon+=$uprequire['iron'];
                        $village->acrop+=$uprequire['crop'];
                    }else{
                        // if master return the 1 gold
                        $database->modifyGold($session->uid, 1, 1);
                    }

			}
            $jj++;
		}
        if(count($this->buildArray)==1){
        $this->NewBuilding = false;
        }
	}


	private function upgradeBuilding($id) { // resources
        global $database,$village,$session;
        
        $townbuild=$fieldbuild=$loopsame=$typebuild=$master=0;
        $levels=$times=$times2=$town=$field=array();
		if($this->allocated < $this->maxConcurrent) {
            $loop=count($this->buildArray);
            foreach($this->buildArray as $bui) {
                if($bui['master']==1){$loop--;}
                $times2[]+=$bui['timestamp'];
            }
            if($loop > 0) {
                $times[]+=time();
                foreach($this->buildArray as $build) {
                    if($build['field']==$id) {
                        $loopsame += 1;
                        $levels[]+=$build['level'];
                        $times[]+=$build['timestamp'];
                    }
                    if($id >= 19) {
                        $town[]+=$times[]+=$build['timestamp'];
                    }else{
                        $field[]+=$build['timestamp'];
                    }
                 }
                $uprequire = $this->resourceRequired($id,$village->resarray['f'.$id.'t'],$loopsame+1);

                if($session->tribe == 1) {
                    if($id >= 19) {
                        foreach($this->buildArray as $build) {
                            if($build['field'] >= 19) {
                                $deftime=$build['timestamp'];
                                if(count($town)){$deftime=max($town);}
                                $time = $deftime + $uprequire['time'];
                                $townbuild+=1;
                            }else{
                                $time = time() + $uprequire['time'];
                            }
                        }
                    }
                    else {
                        foreach($this->buildArray as $build) {
                            if($build['field'] <= 18) {
                                $deftime=$build['timestamp'];
                                if(count($field)){$deftime=max($field);}
                                $time = $deftime + $uprequire['time'];
                                $fieldbuild+=1;
                            }else{
                                $time = time() + $uprequire['time'];
                            }
                        }
                    }
                }
                else {
                    $time = max($times2) + $uprequire['time'];
                }
            }else{
                $uprequire = $this->resourceRequired($id,$village->resarray['f'.$id.'t']);
                $time = time() + $uprequire['time'];
            }
            $bindicate = $this->canBuild($id,$village->resarray['f'.$id.'t']);

            $loop = ($bindicate == 9 ? 1 : 0);
            $master = ($session->goldclub && $this->master==0 && ($bindicate == 88  || $bindicate<8)  ? 1 : 0);

            if($master){$time=$uprequire['time'];}


            if($bindicate==9 || $bindicate==8 || ($bindicate==88 || $master==1 && $this->master==0) && $session->goldclub){   
			global ${'bid'.$village->resarray['f'.$id.'t']};

            $nowb=count($levels);

            if($nowb){$currentlvl=max($levels);}else{$currentlvl=$village->resarray['f'.$id];}
			$maxhouselvl=(!$village->capital && $id<19)?10:(count(${'bid'.$village->resarray['f'.$id.'t']}));
            if($id<19 && $village->capital){$maxhouselvl-=1;}


                    $wwblock=0;
                    if($id==99){ $wwblock=1;
                        $wwbuildingplan = 0;
                        $plan=$database->checkArtefactsEffects($session->uid,$village->wid,11);
                        if($plan > 0){$wwbuildingplan = 1;}
                        
                    if($session->alliance != 0){
                        $alli_users = $database->getUserByAlliance($session->alliance);
                        foreach($alli_users as $users){
                            $plan = $database->checkArtefactsEffects($users['id'],0,11);
                            if($plan > 0){$wwbuildingplan += 1;}
                        }
                    }
                    if(($wwbuildingplan>0 and $village->resarray['f'.$id] <= 50) or ($wwbuildingplan>1 and $village->resarray['f'.$id] > 50)){$wwblock=0;}
                        $time+=$uprequire['time'];
                    }

			  if($maxhouselvl>$currentlvl and $wwblock==0)
			  {
                if(!$master && $id!=99 && $uprequire['time']<1 && ($session->tribe==1 && ($townbuild==0 && $id >= 19 || $fieldbuild==0 && $id < 19) || !$loop)){
                    $database->modifyResource($village->wid,$uprequire['wood'],$uprequire['clay'],$uprequire['iron'],$uprequire['crop'],0);
                    $jobs=array('field'=>$id,'level'=>$currentlvl+1,'type'=>$village->resarray['f'.$id.'t'],'wid'=>$village->wid);
                        $village->awood-=$uprequire['wood'];
                        $village->aclay-=$uprequire['clay'];
                        $village->airon-=$uprequire['iron'];
                        $village->acrop-=$uprequire['crop'];

                         // iRedux - Quest system Part
                        if($session->qData['quest'] == 3 && $session->qData['step2'] == 0){
                           if($session->fData['f'.$id.'t'] == 1){
                                $database->query("UPDATE quests SET step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                            }
                        }

                        if($session->qData['quest'] == 4 && $session->qData['step2'] == 0){
                            if($session->fData['f'.$id.'t'] == 1){
                                if($currentlvl+1 > 1){
                                    $database->query("UPDATE quests SET step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                                }
                            }
                        }

                        if($session->qData['quest'] == 5 && $session->qData['step2'] == 0){
                            if($session->fData['f'.$id.'t'] == 4){
                                $database->query("UPDATE quests SET step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                            }
                        }

                        $this->BuildNow($jobs);
                    }else{
                        if(!$master){ // no master building
                            $database->addBuilding($village->wid,$id,$village->resarray['f'.$id.'t'],$loop,$time,$currentlvl+1,$master,0);
                            $database->modifyResource($village->wid,$uprequire['wood'],$uprequire['clay'],$uprequire['iron'],$uprequire['crop'],0);
                            $village->awood-=$uprequire['wood'];
                            $village->aclay-=$uprequire['clay'];
                            $village->airon-=$uprequire['iron'];
                            $village->acrop-=$uprequire['crop'];

                            // iRedux - Quest system Part
                            if($session->qData['quest'] == 3 && $session->qData['step2'] == 0){
                                if($session->fData['f'.$id.'t'] == 1){
                                    $database->query("UPDATE quests SET step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                                }
                            }

                            if($session->qData['quest'] == 4 && $session->qData['step2'] == 0){
                                if($session->fData['f'.$id.'t'] == 1){
                                    if($currentlvl+1 > 1){
                                        $database->query("UPDATE quests SET step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                                    }
                                }
                            }

                            if($session->qData['quest'] == 5 && $session->qData['step2'] == 0){
                                if($session->fData['f'.$id.'t'] == 4){
                                    $database->query("UPDATE quests SET step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                                }
                            }


                        }else{
                            if($session->gold > 0){
                                $database->modifyGold($session->uid, 1, 0); // take 1 gold for master
                                $database->addBuilding($village->wid,$id,$village->resarray['f'.$id.'t'],$loop,$time,$currentlvl+1,$master,0);

                                // iRedux - Quest system Part
                                if($session->qData['quest'] == 3 && $session->qData['step2'] == 0){
                                    if($session->fData['f'.$id.'t'] == 1){
                                        $database->query("UPDATE quests SET step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                                    }
                                }

                                if($session->qData['quest'] == 4 && $session->qData['step2'] == 0){
                                    if($session->fData['f'.$id.'t'] == 1){
                                        if($currentlvl+1 > 1){
                                            $database->query("UPDATE quests SET step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                                        }
                                    }
                                }

                                if($session->qData['quest'] == 5 && $session->qData['step2'] == 0){
                                    if($session->fData['f'.$id.'t'] == 4){
                                        $database->query("UPDATE quests SET step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                                    }
                                }

                            }
                            


                        }
                    }
                }
			}



		}
	}





	private function constructBuilding($id,$tid) {
		global $database,$village,$session;
        if($tid==40){$id=99;}
		if($this->allocated < $this->maxConcurrent) {
			if($tid == 16) {
				$id = 39;
			}
			else if($tid == 31 || $tid == 32 || $tid == 33 || $tid == 42 || $tid == 43) {
				$id = 40;
			}
            if((($tid != 31 && $session->tribe==1) || ($tid != 32 && $session->tribe==2)  || ($tid != 33 && $session->tribe==3) || ($tid != 42 && $session->tribe==6) || ($tid != 43 && $session->tribe==7)) && $id==40 || $id==39 && $tid!=16){exit;}
            if($village->resarray['f'.$id.'t']!=0){exit;}
			$uprequire = $this->resourceRequired($id,$tid);
			$time = time() + $uprequire['time'];
			$bindicate = $this->canBuild($id,$village->resarray['f'.$id.'t']);
			$loop = ($bindicate == 9 ? 1 : 0);
            $master = (($bindicate == 88  || $bindicate<8 && $session->goldclub && $this->master==0)  ? 1 : 0);

            if($master){$time=$uprequire['time'];}


            
			if($this->meetRequirement($tid) && ($bindicate==9 || $bindicate==8 || $bindicate==88 && $session->goldclub)) {
				if($database->modifyResource($village->wid,$uprequire['wood'],$uprequire['clay'],$uprequire['iron'],$uprequire['crop'],0) || $master){
                    if($tid == 10 && $session->qData['quest'] == 8 && $session->qData['step2'] == 0){ // Quest
                        $database->query("UPDATE quests SET step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                    }
                    if($tid == 16 && $session->qData['quest'] == 9 && $session->qData['step2'] == 0){ // Quest
                        $database->query("UPDATE quests SET step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                    }
                    if(!$master && $id!=99 && $uprequire['time']<1){
                        $jobs=array('field'=>$id,'level'=>1,'type'=>$tid,'wid'=>$village->wid);
                        $this->BuildNow($jobs);
                        $village->awood-=$uprequire['wood'];
                        $village->aclay-=$uprequire['clay'];
                        $village->airon-=$uprequire['iron'];
                        $village->acrop-=$uprequire['crop'];
                    }else{
                        if(!$master){
                            $village->awood-=$uprequire['wood'];
                            $village->aclay-=$uprequire['clay'];
                            $village->airon-=$uprequire['iron'];
                            $village->acrop-=$uprequire['crop'];
                        }
                        $database->addBuilding($village->wid,$id,$tid,$loop,$time,1,$master,1);
                    }
				}

			}
		}
	}

	private function meetRequirement($id) {
		global $village,$session,$database;
		$buildcostr=$database->getJobs1($village->wid);
        $sum=(count($buildcostr));
        if ($sum>=1){
        $buildconstr1 = $buildcostr[0]['type'];
        }else{$buildconstr1=0;}
        if ($sum>=2){
        $buildconstr2 = $buildcostr[1]['type'];
        }else{$buildconstr2=0;}
        if ($sum==3){
        $buildconstr3 = $buildcostr[2]['type'];
        }else{$buildconstr3=0;}
        $nobuilding=($buildconstr1!=$id && $buildconstr2!=$id && $buildconstr3!=$id);
		switch($id) {
			case 1:
			case 2:
			case 3:
			case 4:
			case 11:
			case 15:
			case 16:
			case 18:
			case 23:
			case 31:
			case 32:
            case 33:
            case 42:
            case 43: 
			case 10:
            return $nobuilding;
            break;
			case 5:
			if($this->getTypeLevel(1) >= 10 && $this->getTypeLevel(15) >= 5 && $nobuilding) { return true; } else { return false; }
			break;
			case 6:
			if($this->getTypeLevel(2) >= 10 && $this->getTypeLevel(15) >= 5 && $nobuilding) { return true; } else { return false; }
			break;
			case 7:
			if($this->getTypeLevel(3) >= 10 && $this->getTypeLevel(15) >= 5 && $nobuilding) { return true; } else { return false; }
			break;
			case 8:
			if($this->getTypeLevel(4) >= 5 && $nobuilding) { return true; } else { return false; }
			break;
			case 9:
			if($this->getTypeLevel(15) >= 5 && $this->getTypeLevel(4) >= 10 && $this->getTypeLevel(8) >= 5 && $nobuilding) { return true; } else { return false; }
			break;
			case 12:
			if($this->getTypeLevel(22) >= 1 && $this->getTypeLevel(15) >= 3 && $nobuilding) { return true; } else { return false; }
			break;
			case 14:
			if($this->getTypeLevel(16) >= 15 && $nobuilding) { return true; } else { return false; }
			break;
			case 17:
			if($this->getTypeLevel(15) >= 3 && $this->getTypeLevel(10) >= 1 && $this->getTypeLevel(11) >= 1 && $nobuilding) { return true; } else { return false; }
			break;
			case 19:
			if($this->getTypeLevel(15) >= 3 && $this->getTypeLevel(16) >= 1 && $nobuilding) { return true; } else { return false; }
			break;
			case 20:
			if($this->getTypeLevel(12) >= 3 && $this->getTypeLevel(22) >= 5 && $nobuilding) { return true; } else { return false; }
			break;
			case 21:
			if($this->getTypeLevel(22) >= 10 && $this->getTypeLevel(15) >= 5 && $nobuilding) { return true; } else { return false; }
			break;
			case 22:
			if($this->getTypeLevel(15) >= 3 && $this->getTypeLevel(19) >= 3 && $nobuilding) { return true; } else { return false; }
			break;
			case 24:
			if($this->getTypeLevel(22) >= 10 && $this->getTypeLevel(15 && $nobuilding) >= 10) { return true; } else { return false; }
			break;
            case 25:
                    if($this->getTypeLevel(15) >= 5 && $nobuilding) { return true; } else { return false; }
			break;
            case 26:
                    if($this->getTypeLevel(18) >= 1 && $this->getTypeLevel(15) >= 5 && $this->getTypeLevel(25) == 0 && $this->getTypeLevel(44) == 0 && $nobuilding) { return true; } else { return false; }
			
			break;
			case 27:
			if($this->getTypeLevel(15) >= 10 && $nobuilding) { return true; } else { return false; }
			break;
			case 28:
			if($this->getTypeLevel(17) == 20 && $this->getTypeLevel(20) >= 10 && $nobuilding) { return true; } else { return false; }
			break;
			case 29:
			if($this->getTypeLevel(19) == 20 && $village->capital == 0 && $nobuilding) { return true; } else { return false; }
			break;
			case 30:
			if($this->getTypeLevel(20) == 20 && $village->capital == 0 && $nobuilding) { return true; } else { return false; }
			break;
			case 34:
			if($this->getTypeLevel(26) >= 3 && $this->getTypeLevel(15) >= 5 && $this->getTypeLevel(25) == 0 && $nobuilding) { return true; } else { return false; }
			break;
			case 35:
			if($this->getTypeLevel(16) >= 10 && $this->getTypeLevel(11) == 20 && $nobuilding) { return true; } else { return false; }
			break;
			case 36:
			if($this->getTypeLevel(16) >= 1 && $nobuilding) { return true; } else { return false; }
			break;
			case 37:
			if($this->getTypeLevel(15) >= 3 && $this->getTypeLevel(16) >= 1 && $nobuilding) { return true; } else { return false; }
			break;
			case 38:
			 $normalA = $database->getOwnArtefactInfoByType($village->wid,6);
             $largeA = $database->getOwnUniqueArtefactInfo($session->uid,6,2);
			if(($this->getTypeLevel(38)==20 || $this->getTypeLevel(38)==0) && $this->getTypeLevel(15) >= 10 && $nobuilding && ($largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid || $village->natar==1) ) { return true; } else { return false; }
			break;
			case 39:
			 $normalA = $database->getOwnArtefactInfoByType($village->wid,6);
             $largeA = $database->getOwnUniqueArtefactInfo($session->uid,6,2);
			if(($this->getTypeLevel(39)==20 || $this->getTypeLevel(39)==0) && $this->getTypeLevel(15) >= 10 && $nobuilding && ($largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid || $village->natar==1)) { return true; } else { return false; }
			break;
			case 40:
			$wwlevel = $village->resarray['f'.$id];
			if($wwlevel > 50){
			$needed_plan = 1;
			}else{
			$needed_plan = 0;
			}
			$wwbuildingplan = 0;
			$villages = $database->getVillagesID($session->uid);
			foreach($villages as $village1){
			$plan = count($database->getOwnArtefactInfoByType2($village1,11));
			if($plan > 0){
			$wwbuildingplan = 1;
			}
            }
            
			if($session->alliance != 0){
                $alli_users = $database->getUserByAlliance($session->alliance);
                foreach($alli_users as $users){
                    $villages = $database->getVillagesID($users['id']);
                    if($users['id'] != $session->uid){
                        foreach($villages as $village1){
                        $plan = count($database->getOwnArtefactInfoByType2($village1,11));
                            if($plan > 0){
                            $wwbuildingplan += 1;
                            }
                        }
                    }
                }
            }
            // iRedux -> Fixed
			if($village->natar == 1 && $wwbuildingplan > $needed_plan && $nobuilding) { return true; } else { return false; }
			break;
			case 41:
			if($this->getTypeLevel(16) >= 10 && $this->getTypeLevel(20) == 20 && $nobuilding) { return true; } else { return false; }
            break;
 
            case 44:
                if(!$this->getTypeLevel(44) 
                && $this->getTypeLevel(15) >= 5 
                && $this->getTypeLevel(25) == 0 
                && $this->getTypeLevel(26) == 0 
                && $nobuilding 
                && !$database->checkpalaceexist($session->villages)
                && $session->tribe == 7) {
                     return true; } else { return false; }
                break;
    
            case 45:
                if(!$this->getTypeLevel(45) 
                && $this->getTypeLevel(37) >= 10
                && $nobuilding 
                && $session->tribe == 6) {
                     return true; } else { return false; }
                break;
        
            default :
                return false;
            break;
		}

    }
    public function AvalibleBuilds($id,$buildcostr) {
        global $village,$session,$database;

        $sum=(count($buildcostr));
        if ($sum>=1){
            $buildconstr1 = $buildcostr[0]['type'];
        }else{$buildconstr1=0;}
        if ($sum>=2){
            $buildconstr2 = $buildcostr[1]['type'];
        }else{$buildconstr2=0;}
        if ($sum==3){
            $buildconstr3 = $buildcostr[2]['type'];
        }else{$buildconstr3=0;}
        $nobuilding=($buildconstr1!=$id && $buildconstr2!=$id && $buildconstr3!=$id);
        
        switch($id) {

            case 5:
                if(!$this->getTypeLevel(5) && $this->getTypeLevel(1) >= 10 && $this->getTypeLevel(15) >= 5 && $nobuilding) { return true; } else { return false; }
                break;
            case 6:
                if(!$this->getTypeLevel(6) && $this->getTypeLevel(2) >= 10 && $this->getTypeLevel(15) >= 5 && $nobuilding) { return true; } else { return false; }
                break;
            case 7:
                if(!$this->getTypeLevel(7) && $this->getTypeLevel(3) >= 10 && $this->getTypeLevel(15) >= 5 && $nobuilding) { return true; } else { return false; }
                break;
            case 8:
                if(!$this->getTypeLevel(8) && $this->getTypeLevel(4) >= 5 && $nobuilding) { return true; } else { return false; }
                break;
            case 9:
                if(!$this->getTypeLevel(9) && $this->getTypeLevel(15) >= 5 && $this->getTypeLevel(4) >= 10 && $this->getTypeLevel(8) >= 5 && $nobuilding) { return true; } else { return false; }
                break;
            case 10:
                if(!$this->getTypeLevel(10) &&  $nobuilding || $this->getTypeLevel(10)==20) { return true; } else { return false; }
                break;
            case 11:
                if(!$this->getTypeLevel(11)  && $nobuilding || $this->getTypeLevel(11)==20) { return true; } else { return false; }
                break;
            case 12:
                if(!$this->getTypeLevel(12) && $this->getTypeLevel(22) >= 1 && $this->getTypeLevel(15) >= 3 && $nobuilding) { return true; } else { return false; }
                break;

            case 14:
                if(!$this->getTypeLevel(14) && $this->getTypeLevel(16) >= 15 && $nobuilding) { return true; } else { return false; }
                break;
            case 15:
                if(!$this->getTypeLevel(15) && $nobuilding) { return true; } else { return false; }
                break;
            case 16:
                if(!$this->getTypeLevel(16) && $nobuilding) { return true; } else { return false; }
                break;
            case 17:
                if(!$this->getTypeLevel(17) && $this->getTypeLevel(15) >= 3 && $this->getTypeLevel(10) >= 1 && $this->getTypeLevel(11) >= 1 && $nobuilding) { return true; } else { return false; }
                break;
            case 18:
                if(!$this->getTypeLevel(18) && $nobuilding) { return true; } else { return false; }
                break;
            case 19:
                if(!$this->getTypeLevel(19) && $this->getTypeLevel(15) >= 3 && $this->getTypeLevel(16) >= 1 && $nobuilding) { return true; } else { return false; }
                break;
            case 20:
                if(!$this->getTypeLevel(20) && $this->getTypeLevel(12) >= 3 && $this->getTypeLevel(22) >= 5 && $nobuilding) { return true; } else { return false; }
                break;
            case 21:
                if(!$this->getTypeLevel(21) && $this->getTypeLevel(22) >= 10 && $this->getTypeLevel(15) >= 5 && $nobuilding) { return true; } else { return false; }
                break;
            case 22:
                if(!$this->getTypeLevel(22) && $this->getTypeLevel(15) >= 3 && $this->getTypeLevel(19) >= 3 && $nobuilding) { return true; } else { return false; }
                break;
            case 23:
                if(!$this->getTypeLevel(23) && $nobuilding || $this->getTypeLevel(23)==10) { return true; } else { return false; }
                break;
            case 24:
                if(!$this->getTypeLevel(24) && $this->getTypeLevel(22) >= 10 && $this->getTypeLevel(15 && $nobuilding) >= 10) { return true; } else { return false; }
                break;
            case 25:
                    if(!$this->getTypeLevel(26) && !$this->getTypeLevel(25) && !$this->getTypeLevel(44) && $this->getTypeLevel(15) >= 5 && $nobuilding) { return true; } else { return false; }
                
                break;
            case 26:
                    if(!$this->getTypeLevel(26) 
                        && !$this->getTypeLevel(44) 
                        && $this->getTypeLevel(18) >= 1 
                        && $this->getTypeLevel(15) >= 5 
                        && $this->getTypeLevel(25) == 0 
                        && $nobuilding 
                        && !$database->checkpalaceexist($session->villages)
                        && $session->tribe != 7
                    ) 
                    {
                         return true;
                    } 
                    else {
                         return false; 
                    }

                break;
            case 27:
                if(($village->resarray['f99t'] == 40 AND ($t)=='26') or ($village->resarray['f99t'] == 40 AND ($t)=='30') or ($village->resarray['f99t'] == 40 AND ($t)=='31') or ($village->resarray['f99t'] == 40)) {
                    return false;
                }else{
                    if(!$this->getTypeLevel(27) && $this->getTypeLevel(15) >= 10 && $nobuilding) { return true; } else { return false; }
                }
                break;
            case 28:
                if(!$this->getTypeLevel(28) && $this->getTypeLevel(17) == 20 && $this->getTypeLevel(20) >= 10 && $nobuilding) { return true; } else { return false; }
                break;
            case 29:
                if(!$this->getTypeLevel(29) && $this->getTypeLevel(19) == 20 && $village->capital == 0 && $nobuilding) { return true; } else { return false; }
                break;
            case 30:
                if(!$this->getTypeLevel(30) && $this->getTypeLevel(20) == 20 && $village->capital == 0 && $nobuilding) { return true; } else { return false; }
                break;
            case 31:
                if($session->tribe==1 && !$this->getTypeLevel(31) && $nobuilding) { return true; } else { return false; }
                break;
            case 32:
                if($session->tribe==2 && !$this->getTypeLevel(32) && $nobuilding) { return true; } else { return false; }
                break;
            case 33:
                if($session->tribe==3 && !$this->getTypeLevel(33) && $nobuilding) { return true; } else { return false; }
            break;

            case 42:
                if($session->tribe==6 && !$this->getTypeLevel(42) && $nobuilding) { return true; } else { return false; }
                break;
            case 43:
                if($session->tribe==7 && !$this->getTypeLevel(43) && $nobuilding) { return true; } else { return false; }
                break;

            case 34:
                if(!$this->getTypeLevel(34) && $this->getTypeLevel(26) >= 3 && $this->getTypeLevel(15) >= 5 && $this->getTypeLevel(25) == 0 && $nobuilding) { return true; } else { return false; }
            break;
            case 35:
                if($session->tribe == 2 && !$this->getTypeLevel(35) && $this->getTypeLevel(16) >= 10 && $this->getTypeLevel(11) == 20 && $nobuilding) { return true; } else { return false; }
                break;
            case 36:
                if($session->tribe == 3 && (!$this->getTypeLevel(36) && $this->getTypeLevel(16) >= 1  && $nobuilding || $this->getTypeLevel(36)==20)) { return true; } else { return false; }
                break;
            case 37:
                if(!$this->getTypeLevel(37) && $this->getTypeLevel(15) >= 3 && $this->getTypeLevel(16) >= 1 && $nobuilding) { return true; } else { return false; }
                break;
            case 38:
                $normalA = $database->getOwnArtefactInfoByType($village->wid,6);
                $largeA = $database->getOwnUniqueArtefactInfo($session->uid,6,2);
                if(($this->getTypeLevel(38)==20 || $this->getTypeLevel(38)==0) && $this->getTypeLevel(15) >= 10 && $nobuilding && ($largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid || $village->natar==1)) { return true; } else { return false; }
                break;
            case 39:
                $normalA = $database->getOwnArtefactInfoByType($village->wid,6);
                $largeA = $database->getOwnUniqueArtefactInfo($session->uid,6,2);
                if(($this->getTypeLevel(39)==20 || $this->getTypeLevel(39)==0) && $this->getTypeLevel(15) >= 10 && $nobuilding && ($largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid || $village->natar==1)) { return true; } else { return false; }
                break;
            case 40:
                $wwlevel = $village->resarray['f'.$id];
                if($wwlevel > 50){
                    $needed_plan = 1;
                }else{
                    $needed_plan = 0;
                }
                $wwbuildingplan = 0;
                $villages = $database->getVillagesID($session->uid);
                foreach($villages as $village1){
                    $plan = count($database->getOwnArtefactInfoByType2($village1,11));
                    if($plan > 0){
                        $wwbuildingplan = 1;
                    }
                }
                if($session->alliance != 0){
                    $alli_users = $database->getUserByAlliance($session->alliance);
                    foreach($alli_users as $users){
                        $villages = $database->getVillagesID($users['id']);
                        if($users['id'] != $session->uid){
                            foreach($villages as $village1){
                                $plan = count($database->getOwnArtefactInfoByType2($village1,11));
                                if($plan > 0){
                                    $wwbuildingplan += 1;
                                }
                            }
                        }
                    }
                }
                if($village->natar == 1 && $wwbuildingplan > $needed_plan && $nobuilding) { return true; } else { return false; }
                break;

                // 
            case 41:
                if($session->tribe == 1 && !$this->getTypeLevel(41) && $this->getTypeLevel(16) >= 10 && $this->getTypeLevel(20) == 20 && $nobuilding) { return true; } else { return false; }
                break;

            case 44:
            if(!$this->getTypeLevel(44) 
            && $this->getTypeLevel(15) >= 5 
            && $this->getTypeLevel(25) == 0 
            && $this->getTypeLevel(26) == 0 
            && $nobuilding 
            && !$database->checkpalaceexist($session->villages)
            && $session->tribe == 7) {
                 return true; } else { return false; }
            break;

            case 45:
                if(!$this->getTypeLevel(45) 
                && $this->getTypeLevel(37) >= 10
                && $nobuilding 
                && $session->tribe == 6) {
                     return true; } else { return false; }
                break;

            default:return false;break;
        }

    }
    public function soonBuilds($id,$buildcostr) {
        global $village,$session,$database;

        $sum=(count($buildcostr));
        if ($sum>=1){
            $buildconstr1 = $buildcostr[0]['type'];
        }else{$buildconstr1=0;}
        if ($sum>=2){
            $buildconstr2 = $buildcostr[1]['type'];
        }else{$buildconstr2=0;}
        if ($sum==3){
            $buildconstr3 = $buildcostr[2]['type'];
        }else{$buildconstr3=0;}
        $nobuilding=($buildconstr1!=$id && $buildconstr2!=$id && $buildconstr3!=$id);
        switch($id) {

            case 5:
                if(!$this->getTypeLevel(5)  && $nobuilding) { return true; } else { return false; }
                break;
            case 6:
                if(!$this->getTypeLevel(6)  && $nobuilding) { return true; } else { return false; }
                break;
            case 7:
                if(!$this->getTypeLevel(7)  && $nobuilding) { return true; } else { return false; }
                break;
            case 8:
                if(!$this->getTypeLevel(8) && $nobuilding) { return true; } else { return false; }
                break;
            case 9:
                if(!$this->getTypeLevel(9)  && $nobuilding) { return true; } else { return false; }
                break;
            case 12:
                if(!$this->getTypeLevel(12) && $nobuilding) { return true; } else { return false; }
                break;
            case 14:
                if(!$this->getTypeLevel(14) && $nobuilding) { return true; } else { return false; }
                break;
            case 17:
                if(!$this->getTypeLevel(17) && $nobuilding) { return true; } else { return false; }
                break;
            case 19:
                if(!$this->getTypeLevel(19)  && $nobuilding) { return true; } else { return false; }
                break;
            case 20:
                if(!$this->getTypeLevel(20)  && $nobuilding) { return true; } else { return false; }
                break;
            case 21:
                if(!$this->getTypeLevel(21) && $nobuilding) { return true; } else { return false; }
                break;
            case 22:
                if(!$this->getTypeLevel(22)  && $nobuilding) { return true; } else { return false; }
                break;
            case 24:
                if(!$this->getTypeLevel(24)  &&  $nobuilding ) { return true; } else { return false; }
                break;
            case 25: if(!$this->getTypeLevel(25) && $nobuilding) { return true; } else { return false; } break;
            case 26: if(!$this->getTypeLevel(26)  && $nobuilding && !$database->checkpalaceexist($session->villages)) { return true; } else { return false; } break;
            case 27:
                if(!$this->getTypeLevel(27)  && $nobuilding) { return true; } else { return false; }
                break;
            case 28:
                if(!$this->getTypeLevel(28)  && $nobuilding) { return true; } else { return false; }
                break;
            case 29:
                if(!$this->getTypeLevel(29)  && $village->capital == 0 && $nobuilding) { return true; } else { return false; }
                break;
            case 30:
                if(!$this->getTypeLevel(31)  && $village->capital == 0 && $nobuilding) { return true; } else { return false; }
                break;
            case 34:
                if(!$this->getTypeLevel(34)  && $nobuilding) { return true; } else { return false; }
                break;
            case 35:
                if($session->tribe==2 && !$this->getTypeLevel(35) && $nobuilding) { return true; } else { return false; }
                break;
            case 36:
                if($session->tribe==3 && !$this->getTypeLevel(36) && $nobuilding) { return true; } else { return false; }
                break;
            case 37:
                if(!$this->getTypeLevel(37) && $nobuilding) { return true; } else { return false; }
                break;
            case 38:
                $normalA = $database->getOwnArtefactInfoByType($village->wid,6);
                $largeA = $database->getOwnUniqueArtefactInfo($session->uid,6,2);
                if($nobuilding && ($largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid || $village->natar==1)) { return true; } else { return false; }
                break;
            case 39:
                $normalA = $database->getOwnArtefactInfoByType($village->wid,6);
                $largeA = $database->getOwnUniqueArtefactInfo($session->uid,6,2);
                if($nobuilding && ($largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid || $village->natar==1)) { return true; } else { return false; }
                break;

            case 41:
                if($session->tribe == 1 && !$this->getTypeLevel(41)  && $nobuilding) { return true; } else { return false; }
                break;

            case 44:if(!$this->getTypeLevel(44) && $session->tribe == 7 && $nobuilding && !$database->checkpalaceexist($session->villages)) { return true; } else { return false; }break;
            case 45:if(!$this->getTypeLevel(45) && $session->tribe == 6 && $nobuilding && !$database->checkpalaceexist($session->villages)) { return true; } else { return false; }break;

            default :
                return false;
                break;
        }

    }
    private function BuildNow($jobs){
        global $database,$bid18,$session,$village;

        // daily quests - build resource
        if($session->acData['a7'] < 15){$database->UpdateAchievU($session->uid,"`a7`=a7+5");}

        $q = "UPDATE fdata set f".$jobs['field']." = ".$jobs['level'].", f".$jobs['field']."t = ".$jobs['type']." where vref = '".$jobs['wid']."'";
        if($jobs['master'] == 0){
            $database->query($q);
        }

        $leader=$session->uid;
        $ally=$session->alliance;
        if($jobs['type']==18){
            if($ally!=0){
                $qlok =$database->query("SELECT leader,max FROM alidata where `id` = ".$ally."");
                $alhel=$qlok[0];

                if($alhel['leader']==$leader && $alhel['max']<60){
                    $newmax=$bid18[$this->getTypeLevel(18,$jobs['wid'])]['attri'];
                    if($alhel['max']<$newmax){
                        $database->UpdateMaxAlly($ally,$newmax);
                    }
                }
            }
        }
        $pop = $this->getPop($jobs['type'],$jobs['level']-1);
        if($pop>0){
            $database->addCPop($jobs['wid'],$pop[1],$pop[0]);
            $database->addclimberrankpopAlly($ally, $pop[0]);
        }
        $village->resarray=$database->getResourceLevel($jobs['wid']);
    }

    private function checkResource($tid,$id) {
		$name = "bid".$tid;
		global $village,$$name;
		$plus = 1;
		foreach($this->buildArray as $job) {
			if($job['type'] == $tid && $job['field'] == $id) {
				$plus += 1;
			}
		}
		$dataarray = $$name;
		$wood = $dataarray[$village->resarray['f'.$id]+$plus]['wood'];
		$clay = $dataarray[$village->resarray['f'.$id]+$plus]['clay'];
		$iron = $dataarray[$village->resarray['f'.$id]+$plus]['iron'];
		$crop = $dataarray[$village->resarray['f'.$id]+$plus]['crop'];

		if($wood > $village->maxstore || $clay > $village->maxstore || $iron > $village->maxstore) {
			return 1;
		}
		else {
			if($crop > $village->maxcrop) {
				return 2;
			}
			else {
				if($wood > $village->awood || $clay > $village->aclay || $iron > $village->airon || $crop > $village->acrop) {
					return 3;
				}
				else {
					if($village->awood-$wood > 0 && $village->aclay-$clay > 0 && $village->airon-$iron > 0 && $village->acrop-$crop >0){
						return 4;
					}
					else {
						return 3;
					}
				}
			}
		}
	}

	public function isMax($id,$field,$loop=0) {

		$name = "bid".$id;
		global $$name,$village;
		$dataarray = $$name;

$cur=$this->isCurrent($field);
$loop=$this->isLoop($field);
$master=$this->isMaster($field);
$loopsame = ($cur || $loop)?1:0;
$doublebuild = ($cur && $loop)?1:0;
      //  echo $village->resarray['f'.$field]." == ".(count($dataarray)." - 11 - ".$loopsame."-".$doublebuild."-".$master)."<br />";
		if($id <= 4) {
			if($village->capital == 1) {
				return ($village->resarray['f'.$field] == (count($dataarray) - 1 - $loopsame-$doublebuild-$master));
			}
			else {
				return ($village->resarray['f'.$field] == (count($dataarray) - 11 - $loopsame-$doublebuild-$master));
			}
		}
		else {
			return ($village->resarray['f'.$field] == count($dataarray) - $loopsame-$doublebuild-$master);
		}
	}

	public function getTypeLevel($tid,$vid=0) {
		global $village,$database;
		$keyholder = array();
        $target = 0;
		if($vid == 0) {
			$resourcearray = $village->resarray;
		} else {
			$resourcearray = $database->getResourceLevel($vid);
		}


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


	public function isCurrent($id) {

		foreach($this->buildArray as $build) {
			if($build['field'] == $id && $build['loopcon'] <> 1) {
				return true;
			}
		}
        return false;
	}

	public function isLoop($id=0) {

		foreach($this->buildArray as $build) {
			if(($build['field'] == $id && $build['loopcon']) || ($build['loopcon'] == 1 && $id == 0)) {
				return true;
			}
		}
		return false;
	}
    public function isMaster($id=0) {
    foreach($this->buildArray as $build) {
        if($build['field'] == $id && $build['master']) {
            return true;
        }
    }
    return false;
}
    public function getMaster() {
        foreach($this->buildArray as $build) {
            if($build['master']==1) {
                return true;
            }
        }
        return false;
    }

 	private function getPop($tid,$level) {
		$name = "bid".$tid;
		global $$name;
		$dataarray = $$name;
		$pop = $dataarray[($level+1)]['pop'];
		$cp = $dataarray[($level+1)]['cp'];
		return array($pop,$cp);
	}
    
    
		public function finishAll() {
		global $database,$session,$village,$bid18;
        $golduse=2;
		foreach($this->buildArray as $jobs) {
            $level = $jobs['level'];
            $x=0;
			if($jobs['type'] != 25 AND $jobs['type'] != 26 AND $jobs['type'] != 40 AND $village->natar==0) {
                if($session->qData['quest'] == 10 && $session->qData['step2'] == 0){ // Quest
                    $database->query("UPDATE quests SET step1 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                }

                $x++;
                $q = "UPDATE fdata set f".$jobs['field']." = ".$jobs['level'].", f".$jobs['field']."t = ".$jobs['type']." where vref = '".$jobs['wid']."'";
                if($jobs['master'] == 0){
                    $database->query($q);
                    $q = "DELETE FROM bdata where id = '".$jobs['id']."'";
                    $database->query($q);
                }else{

                    /*
                    $type = $jobs['type'];
                    $buildarray = $GLOBALS["bid".$type];
                    if($session->gold>0 && $database->modifyResource($jobs['wid'],$buildarray[$level]['wood'],$buildarray[$level]['clay'],$buildarray[$level]['iron'],$buildarray[$level]['crop'],0)){
                        $village->awood-=$buildarray[$level]['wood'];
                        $village->aclay-=$buildarray[$level]['clay'];
                        $village->airon-=$buildarray[$level]['iron'];
                        $village->acrop-=$buildarray[$level]['crop'];

                        $database->query($q);
                        $q = "DELETE FROM bdata where id = '".$jobs['id']."'";
                        $database->query($q);
                    }*/
                }



                $builder=$database->getUserInfoByVillageIDAtt($jobs['wid']);
                $leader=$builder['id'];
                $ally=$builder['alliance'];
                                      if($jobs['type']==18){


                       if($ally!=0){
                        $qlok =$database->query("SELECT leader,max FROM alidata where `id` = '".$ally."'");
                       	$alhel=$qlok[0];

                       	 if($alhel['leader']==$leader && $alhel['max']<60){
                       	$newmax=$bid18[$this->getTypeLevel(18,$jobs['wid'])]['attri'];
                       	if($alhel['max']<$newmax){
                       	$database->UpdateMaxAlly($ally,$newmax);
                       	}
                        }
                        }
                        }
                  $pop = $this->getPop($jobs['type'],$level-1);
                if($pop>0){
                    $database->addCPop($jobs['wid'],$pop[1],$pop[0]);
                    $database->addclimberrankpopAlly($ally, $pop[0]);
                }
                
            }
            
		}
		$database->finishDemolition($village->wid);
		$database->UpdateQueue($village->wid,9);
        //$database->finishTech($village->wid);
        if($database->finishTech($village->wid)){
            $x++;
        }
        if($x != 0){ // this fix by redux
            $database->modifyGold($session->uid,$golduse,0);
        }
		$time=time();
		$ip=$_SERVER['REMOTE_ADDR'];
		$uid=$_SESSION['id_user'];
		$infa="moment,$time,$golduse,$ip";

		$database->addPalevo($uid,$infa,3);
        if($session->acData['a5'] < 6){
            $database->UpdateAchievU($session->uid,"`a5`=a5+2");
        }


	}


	public function resourceRequired($id,$tid,$plus=1) {
		$name = "bid".$tid;
		global $$name,$village,$bid15;
		$dataarray = $$name;

		$wood = $dataarray[$village->resarray['f'.$id]+$plus]['wood'];
		$clay = $dataarray[$village->resarray['f'.$id]+$plus]['clay'];
		$iron = $dataarray[$village->resarray['f'.$id]+$plus]['iron'];
		$crop = $dataarray[$village->resarray['f'.$id]+$plus]['crop'];
		$pop = $dataarray[$village->resarray['f'.$id]+$plus]['pop'];
		if ($tid == 15) {
			if($this->getTypeLevel(15) == 0) {
				$time = round($dataarray[$village->resarray['f'.$id]+$plus]['time']/ SPEED *5);
			}
			else {
				$time = round($dataarray[$village->resarray['f'.$id]+$plus]['time'] / SPEED);
			}
		}
		else {
            $speed=SPEED;
            if($tid==40 && SPEED==800000){$speed=800;}
			if($this->getTypeLevel(15) != 0) {
				$time = round($dataarray[$village->resarray['f'.$id]+$plus]['time'] * ($bid15[$this->getTypeLevel(15)]['attri']/100)  / $speed);
			}
			else {
				$time = round($dataarray[$village->resarray['f'.$id]+$plus]['time']*5 / $speed);
			}
		}
		$cp = $dataarray[$village->resarray['f'.$id]+$plus]['cp'];
		return array("wood"=>$wood,"clay"=>$clay,"iron"=>$iron,"crop"=>$crop,"pop"=>$pop,"time"=>$time,"cp"=>$cp);
	}

	public function getTypeField($type) {
		global $village;
		for($i=19;$i<=40;$i++) {
			if($village->resarray['f'.$i.'t'] == $type) {
				return $i;
			}
		}
        return 0;
	}

	public function calculateAvaliable($id,$tid,$plus=1) {
		global $village,$generator;
		$uprequire = $this->resourceRequired($id,$tid,$plus);
		$rwood = $uprequire['wood']-$village->awood;
		$rclay = $uprequire['clay']-$village->aclay;
		$rcrop = $uprequire['crop']-$village->acrop;
		$riron = $uprequire['iron']-$village->airon;
		$rwtime = $rwood / $village->getProd("wood") * 3600;
		$rcltime = $rclay / $village->getProd("clay")* 3600;
		$rctime = $rcrop / $village->getProd("crop")* 3600;
		$ritime = $riron / $village->getProd("iron")* 3600;
		$reqtime = max($rwtime,$rctime,$rcltime,$ritime);
		$reqtime += time();
        if($rcrop>0 && $village->getProd("crop")<=0){return 0;}
		return $generator->procMtime($reqtime);
	}
}

$building = new Building;