<?php

$j=1;
include_once "Data/hero_full.php";
$sizes=array(16 =>'500',17 =>'1000',18 =>'1500',19 =>'500',20 =>'1000',21 =>'1500',22 =>'500',23 =>'1000',24 =>'1500',25 =>'500',26 =>'1000',27 =>'1500',28 =>'500',29 =>'1000',30 =>'1500',31 =>'500',32 =>'1000',33 =>'1500',34 =>'500',35 =>'1000',36 =>'1500',37 =>'500',38 =>'1000',39 =>'1500',40 =>'500',41 =>'1000',42 =>'1500',43 =>'500',44 =>'1000',45 =>'1500',46 =>'500',47 =>'1000',48 =>'1500',49 =>'500',50 =>'1000',51 =>'1500',52 =>'500',53 =>'1000',54 =>'1500',55 =>'500',56 =>'1000',57 =>'1500',58 =>'500',59 =>'1000',60 =>'1500'
,115 =>'500',116 =>'1000',117 =>'1500',118 =>'500',119 =>'1000',120 =>'1500',121 =>'500',122 =>'1000',123 =>'1500',124 =>'500',125 =>'1000',126 =>'1500',127 =>'500',128 =>'1000',129 =>'1500');
$hero_levels = $GLOBALS["hero_levels"];
if($_POST && $_POST['a']=='inventory'){
	//print_r($_POST); die();
	// Array ( [a] => inventory [id] => 6 [amount] => 30 [btype] => 7 [type] => 0 )

	$data = $_POST;
	$uid = $session->uid;
	$itemData = $database->getItemData($data['id']);

	if($itemData['btype']==1){
		if($gi['helmet']!=0){

			$database->editProcItem($gi['helmet'], 0, $uid);

		}
        $database->editProcItem($itemData['id'], 1, $uid);
        $database->setHeroInventory($uid, 'helmet', $itemData['id']);
        $database->modifyHeroFace($uid, 'helmet', $itemData['type']);
	}

	elseif($itemData['btype']==2){

        if($itemData['type']>=88 && $itemData['type']<=93){
            switch($itemData['type']){
                case 88:
                case 92:
                    $strong=500;
                    break;
                case 89:$strong=1000;
                    break;
                case 90:$strong=1500;
                    break;
                case 91:$strong=250;
                    break;
                case 93:$strong=750;
                    break;
            }
            $database->modifyHero2("itempower",$strong,$uid,1);
        }
		if($gi['body']!=0){
            $id=$database->getItemData($gi['body']);
            $database->editProcItem($gi['body'], 0, $uid);

            if($id['type']>=88 && $id['type']<=93){
                switch($id['type']){
                    case 88:
                    case 92:
                        $strong=500;
                        break;
                    case 89:$strong=1000;
                        break;
                    case 90:$strong=1500;
                        break;
                    case 91:$strong=250;
                        break;
                    case 93:$strong=750;
                        break;
                }
                $database->modifyHero2("itempower",$strong,$uid,2);
            }
		}
        $database->editProcItem($itemData['id'], 1, $uid);
        $database->setHeroInventory($uid, 'body', $itemData['id']);
        $database->modifyHeroFace($uid, 'body', $itemData['type']);
	}

	elseif($itemData['btype']==3){


        if($itemData['type']>=76 && $itemData['type']<=78){
            switch($itemData['type']){
                case 76:
                    $strong=500;
                    break;
                case 77:$strong=1000;
                    break;
                case 78:$strong=1500;
                    break;

            }
            $database->modifyHero2("itempower",$strong,$uid,1);
        }
		if($gi['leftHand']!=0){
            $id=$database->getItemData($gi['leftHand']);
            $database->editProcItem($gi['leftHand'], 0, $uid);
            if($id['type']>=76 && $id['type']<=78){
                switch($id['type']){
                    case 76:
                        $strong=500;
                        break;
                    case 77:$strong=1000;
                        break;
                    case 78:$strong=1500;
                        break;

                }
                $database->modifyHero2("itempower",$strong,$uid,2);
            }
		}

        $database->editProcItem($itemData['id'], 1, $uid);
        $database->setHeroInventory($uid, 'leftHand', $itemData['id']);
        $database->modifyHeroFace($uid, 'leftHand', $itemData['type']);
	}

	elseif($itemData['btype']==4){


		if($gi['rightHand']!=0){
            $id=$database->getItemData($gi['rightHand']);
            $database->editProcItem($gi['rightHand'], 0, $uid);
            $database->modifyHero2("itempower",$sizes[$id['type']],$uid,2);
		}
        $database->editProcItem($itemData['id'], 1, $uid);
        $database->setHeroInventory($uid, 'rightHand', $itemData['id']);
        $database->modifyHero2("itempower",$sizes[$itemData['type']],$uid,1);
        $database->modifyHeroFace($uid, 'rightHand', $itemData['type']);

	}

	elseif($itemData['btype']==5){
		if($gi['shoes']!=0){
            $id=$database->getItemData($gi['shoes']);
            $database->editProcItem($gi['shoes'], 0, $uid);
            if($id['type']>=100 && $id['type']<=102){
                if($id['type']==100){
                    $value = 3;
                }elseif($id['type']==101){
                    $value = 4;
                }elseif($id['type']==102){
                    $value = 5;
                }
                $database->modifyHero2('speed', $value, $uid, 2);
            }elseif($itemData['type']>=94 && $itemData['type']<=96){
                if($itemData['type']==94){
                    $value = 10;
                }elseif($itemData['type']==95){
                    $value = 15;
                }elseif($itemData['type']==96){
                    $value = 20;
                }
                $database->modifyHero2('autoregen', $value, $uid, 2);
                //exit;
            }
		}
        if($itemData['type']>=100 && $itemData['type']<=102){
        if($itemData['type']==100){
            $value = 3;
        }elseif($itemData['type']==101){
            $value = 4;
        }elseif($itemData['type']==102){
            $value = 5;
        }
        $database->modifyHero2('speed', $value, $uid, 1);
        }elseif($itemData['type']>=94 && $itemData['type']<=96){
            if($itemData['type']==94){
                $value = 10;
            }elseif($itemData['type']==95){
                $value = 15;
            }elseif($itemData['type']==96){
                $value = 20;
            }
            $database->modifyHero2('autoregen', $value, $uid, 1);
        }
        $database->editProcItem($itemData['id'], 1, $uid);
        $database->setHeroInventory($uid, 'shoes', $itemData['id']);
        $database->modifyHeroFace($uid, 'foot', $itemData['type']);
	}

	elseif($itemData['btype']==6){

		if($gi['horse']!=0){
            $id=$database->getItemData($gi['horse']);
            $database->editProcItem($gi['horse'], 0, $uid);
		$itemData2 = $id;
			if($itemData2['type']==103){
				$value2 = 7;
			}elseif($itemData2['type']==104){
				$value2 = 10;
			}elseif($itemData2['type']==105){
				$value2 = 13;
			}
			$database->modifyHero2('speed', $value2, $uid, 2);
		}
			if($itemData['type']==103){
				$value = 7;
			}elseif($itemData['type']==104){
				$value = 10;
			}elseif($itemData['type']==105){
				$value = 13;
			}
        $database->editProcItem($itemData['id'], 1, $uid); //одеinаем шмотку
        $database->setHeroInventory($uid, 'horse', $itemData['id']); //чет делаем in инinентаре
			$database->modifyHeroFace($uid, 'horse', $itemData['type']);
			$database->modifyHero2('speed', $value, $uid, 1);
	}

	elseif($itemData['btype']==7 && $data['amount']>0){ //походу inоскрешает немного сдохших inойск 25%  $itemData['type'] тут число уже надетых поinязок/хуязок
	if($data['amount'] <= $itemData['num']-$itemData['type']){ //если число ininеденых поinязок меньше или раinно их реальном кол-inу
		if($data['amount']==$itemData['num']-$itemData['type']){$database->editProcItem($itemData['id'], 1, $uid);}
		$database->editHeroType($itemData['id'], $data['amount'], 1);
		if($gi['bag']!=0){
            $id=$database->getItemData($gi['bag']);
            $database->editProcItem($id['id'], 0, $uid);
            $database->editHeroType($id['id'], $id['type'], 0);
		}
			$database->setHeroInventory($uid, 'bag', $itemData['id']);
		}
	}

	elseif($itemData['btype']==8 && $data['amount']>0){ //походу inоскрешает немного сдохших inойск 33%
		if($data['amount'] <= $itemData['num']){
		$database->editProcItem($itemData['id'], 1, $uid);
		$database->editHeroType($itemData['id'], $data['amount'], 1);
		if($gi['bag']!=0){
            $id=$database->getItemData($gi['bag']);
            $database->editProcItem($id['id'], 0, $uid);
            $database->editHeroType($id['id'], $id['type'], 0);
		}
			$database->setHeroInventory($uid, 'bag', $itemData['id']);
		}
	}

	elseif($itemData['btype']==9 && $data['amount']>0){ // Cages 
		if($data['amount'] <= $itemData['num']){
           // print_r($database->getItemData($gi['bag'])); echo $uid;die;
          //  print_r($gi);die;
		$database->editProcItem($itemData['id'], 1, $uid);
		$database->editHeroType($itemData['id'], $data['amount'], 1);

		if($gi['bag']!=0){
            $id=$database->getItemData($gi['bag']);
            $database->editProcItem($id['id'], 0, $uid);
            $database->editHeroType($id['id'], $id['type'], 0);
		}
		$database->setHeroInventory($uid, 'bag', $itemData['id']);
		}
	}

	elseif($itemData['btype']==10 && $data['amount']>0){ //опыт геру сinитками!
		if($data['amount'] <= $itemData['num']){
			$value = ($data['amount']*10);
			if($data['amount'] < $itemData['num']){
				$database->modifyHero2('experience', $value, $uid, 1);
				$database->editHeroNum($itemData['id'], $data['amount'], 0);
			}else{
				$database->editProcItem($itemData['id'], 1, $uid);
				$database->modifyHero2('experience', $value, $uid, 1);
			}
		}
	} 

	elseif($itemData['btype']==11 && $data['amount']>0){//хилим героя
		if($session->qData['quest'] == 13 && $session->qData['step1'] == 1 && $session->qData['step2'] == 0){ 
			$database->query("UPDATE quests SET step2 = 1,isFinished=1 WHERE userid = ".$session->uid."");
			header('Location: hero_inventory.php');
		}
		
		if($session->heroD['health']<100){
			if($data['amount'] <= $itemData['num']){
				$health = round($session->heroD['health']);
				if(($health+$data['amount'])>100){
					$database->modifyHero2('health', 100, $uid, 0);
					$newAmount = intval(100-$health);
					$database->editHeroNum($itemData['id'], $newAmount, 0);
				}
				else{
					if($data['amount'] < $itemData['num']){
						$database->modifyHero2('health', $data['amount'], $uid, 1);
						$database->editHeroNum($itemData['id'], $data['amount'], 0);
					}else{
						$database->editProcItem($itemData['id'], 1, $uid);
						$database->modifyHero2('health', $data['amount'], $uid, 1);
					}
				}
			}
		}
	}

	elseif($itemData['btype']==12){//inоскрешаем героя
        $hero=0;
        $vills=implode(",",$session->villages);
        $q1 = "SELECT SUM(u11) as sum1 from enforcement where `from` IN (".$vills.")";       // check if hero is send as reinforcement
        $he1 = $database->query($q1);
        $hero+=$he1[0]['sum1'];
        $q2 = "SELECT SUM(u11) as sum2 from units where `vref` IN (".$vills.")";   // check if hero is on my account (all villages)
        $he2 = $database->query($q2);
        $hero+=$he2[0]['sum2'];
        foreach($session->villages as $myvill){
            $hero+=$database->HeroNotInVil($myvill); // check if hero is not in village (come back from attack , raid , etc.)
        }

            if(!$hero && !$session->heroD['revivetime']){


		if($session->heroD['dead']!=0){
			$database->modifyHero2('dead', 0, $uid, 0);
			$database->modifyHero2('health', 100, $uid, 0);
			$database->modifyHero2('wref', $village->wid, $uid, 0);
			$database->editProcItem($itemData['id'], 1, $uid);
            $database->modifyUnit($village->wid, array(11), array(1), 1);
		}
            }
	}

	elseif($itemData['btype']==13){//скидыinаем очки героя

		$database->modifyHero2('power', 0, $uid, 0);
		$database->modifyHero2('offBonus', 0, $uid, 0);
		$database->modifyHero2('defBonus', 0, $uid, 0);
		$database->modifyHero2('product', 0, $uid, 0);
		for($i=0;$i<=4;$i++){
			$database->modifyHero2('r'.$i, 0, $uid, 0);
		}
		$database->editProcItem($itemData['id'], 1, $uid);
	}

	elseif($itemData['btype']==14 && $data['amount']>0){ //даем одобряшку дере
		if($village->loyalty<=125){
			if($data['amount'] <= $itemData['num']){
				if(($village->loyalty+$data['amount'])>125){
					$database->setVillageField($village->wid, 'loyalty', 125);
					$newAmount = intval(125-$village->loyalty);
					$database->editHeroNum($itemData['id'], $newAmount, 0);
				}
				else{
					if($data['amount'] < $itemData['num']){
						$database->setVillageField($village->wid, 'loyalty', ($village->loyalty+$data['amount']));
						$database->editHeroNum($itemData['id'], $data['amount'], 0);
					}else{
						$database->editProcItem($itemData['id'], 1, $uid);
						$database->setVillageField($village->wid, 'loyalty', ($village->loyalty+$data['amount']));
					}
				}
			}
		}
	}

	elseif($itemData['btype']==15 && $data['amount']>0){ //даем ек акку
		if($data['amount'] <= $itemData['num']){
			$value = ($data['amount']*($database->getVSumField($uid, 'cp')/2));
            $q = "UPDATE users set `cp` = cp + '".$value."' where `id` = '".$uid."'";
            $database->query($q);
			if($data['amount'] < $itemData['num']){
				$database->editHeroNum($itemData['id'], $data['amount'], 0);
			}else{
				$database->editProcItem($itemData['id'], 1, $uid);
			}
		}
	}

}
