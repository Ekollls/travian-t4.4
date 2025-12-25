<?php
class Units
{
    public function procUnits($post)
    {
        if (isset($post['c'])) {
            switch ($post['c']) {
                case 1:
                case 2:
                case 3:
                case 4:
                    if (isset($post['a']) && $post['a'] == 533374) {
                        $this->sendTroops($post);
                    } else {
                        $post = $this->loadUnits($post);
                        return $post;
                    }
                    break;
                case 8:
                    $this->sendTroopsBack($post);
                    break;
                case 5:
                    if (isset($post['a']) && $post['a'] == "new") {
                        $this->Settlers($post);
                    } else {
                        $post = $this->loadUnits($post);
                        return $post;
                    }
                    break;
                case 6:

                    if (isset($post['a']) && $post['a'] == "adventure") {
                    $this->Adventures($post);
                    }else{
                        $post = $this->loadUnits($post);
                        return $post;
                    }
                    break;
            }
        }
        return false;
    }

    private function loadUnits($post)
    {
        global $database, $village, $session, $form;
        // Busqueda por nombre de pueblo
        // Confirmamos y buscamos las coordenadas por nombre de pueblo
        $oasis= $id = $addhero = 0;
        $disabledr=$dis=$disableN=false;
        if ($post['x'] != "" && $post['y'] != "") {
            $id = $database->getBaseID($post['x'], $post['y']);
            if (!$database->getVillageState($id)) {
                $form->addError("error", "Village doesn't exist");
            }
            $oasis = $database->isVillageOases($id);
            $info = array("regtime"=>0,"protect"=>0);
            if (!$oasis) {
                $info = $database->getAcOwByVillID($id);
                $owner = $info['id'];
            }

        } elseif (!$post['x'] && !$post['y']) {
            $form->addError("error", "Insert name or coordinates");
        }

        if ($oasis) {
            $owner = 2;
            $oasi=$database->checkviloas2($id);
            if ($oasi['owner'] == 2) {
                $disabledr = true;
                $dis=true;
            }
        }
        if(!$session->right['s1']){
            $disableN=true;
        }
        if(!$session->right['s2']){
            $disabledr = true;
        }
        
        // Edited by iRedux
        //if (time() > $info['ptime'] && $info['protect'] != 0 && $session->uid!=$owner) {
        if ((time() < $info['ptime'] || $info['protect'] == 1) && $session->uid!=$owner) {
            $form->addError("error", "player under protection");
        }

        if (($owner == 3 || $disabledr) && $post['c'] == 2) {
            $form->addError("error", "You can't reinforce this village/oasis");
        }

        // fix this
        if ($session->sit && $post['c'] == 3 || $dis && $post['c'] == 3) {
            $form->addError("error", "You can't attack this village/oasis with normal attack");
        }
        if ($disableN && $post['c'] == 4) {
            $form->addError("error", "You can't attack this village/oasis with raid (sitter settings)");
        }
		
		//echo $post['c']; die();
		
        // Redux -> make sure he raid only to oasis and attack only natars
        $exist = $database->checkviloas($id);
        $targData = $database->queryFetch('SELECT * FROM users WHERE id = '.$exist['owner'].'');

		if(($database->isVillageOases($id) && $post['c'] != 4 && $exist['owner'] == 4)){
			$form->addError("error", "");
        }

        // if occupied oasis and player still under protection
        if($session->protection > time() 
            && $session->uid != $exist['owner']
            && $database->isVillageOases($id) 
            && $exist['owner'] != 4
            && $post['c'] != 2 ){
			$form->addError("error", "Under protection");
        }

        if($session->protection > time()
            && $session->uid != $exist['owner']
            && $exist['owner'] != 3
            && $exist['owner'] != 4
            && $post['c'] != 2){
            $form->addError("error", "Under protection");
        }
        
        
		if($database->getUserInfoByVIDD($id)['id'] == 3 && $post['c'] == 2){
			$form->addError("error", "Can't send troops to natars!");
		}

        $sendnum = 0;
        for ($i = 1; $i <= 11; $i++) {
            if(isset($post['t' . $i])){
            $post['t' . $i] = preg_replace("/[^0-9]/", "", $post['t' . $i]);
            }
            if (empty($post['t' . $i])) {
                $post['t' . $i] = 0;
            }
            if ($post['t' . $i] > $village->unitarray['u' . $i]) {
                $form->addError("error", "You can't send more units than you have");
                break;
            }
            if ($post['t' . $i] < 0) {
                $form->addError("error", "You can't send negative units.");
                break;
            }
            $sendnum += $post['t' . $i];
        }
        if (!$sendnum) {
            $form->addError("error", "You need to mark min. one troop");
        }

        // old code
        /*
        if(isset($post['redeployHero']) && $post['redeployHero']==1 && $post['t11']>0 && $post['c'] == 2){
            $addhero=1;
        }*/

        // iRedux code
        if(isset($post['redeployHero']) && $post['redeployHero']==1 && $post['t11']>0){
            $post['c'] = 2;
            $addhero=1;
        }

        if (!$oasis) {
            //check if banned/admin:
            $userAccess = $info['access'];
            if ($userAccess == '0') {
            //if ($userAccess == '0' or $userAccess == '8' or $userAccess == '9') {
                $form->addError("error", "Player is Banned. You can't attack him");
                //break;
            }
            //check if attacking same village that units are in
            if ($id == $village->wid) {
                $form->addError("error", "You cant attack same village you are sending from.");
                //break;
            }
            // Procesamos el array con los errores dados en el formulario
            if ($form->returnErrors() > 0) {
                $_SESSION['errorarray'] = $form->getErrors();
                $_SESSION['valuearray'] = $_POST;
                header("Location: build.php?t=2&id=39&z=".$id."");
            } else {
                // Debemos devolver un array con $post, que contiene todos los datos mas
                // otra variable que definira que el flag esta levantado y se va a enviar y el tipo de envio
                $villageName = $database->RemoveXSS($info['name']);


                array_push($post, $id, $villageName, $owner, $info['username'],$info['alliance']);
                $post['add']=$addhero;
                return $post;

            }
        } else {

            if ($form->returnErrors() > 0) {
                $_SESSION['errorarray'] = $form->getErrors();
                $_SESSION['valuearray'] = $_POST;
                header("Location: build.php?t=2&id=39&z=".$id."");
            } else {
                $villageName = FINDER5;

                array_push($post, $id, $villageName, $oasi['owner'],  TRIBE4, 0);
                $post['add']=$addhero;
                return $post;
            }


        }
return false;
    }

    private function sendTroops($post)
    {
        global $form, $database, $village, $session;

        $data = $database->getA2b($post['timestamp_checksum'], $post['timestamp']);
        if($data['sent']==0){
            $p=array('ckey'=>$post['timestamp_checksum'],'check'=>$post['timestamp']);
			$database->query("UPDATE a2b SET sent='1' WHERE ckey = :ckey AND time_check = :check",$p);

			$exist = $database->checkviloas($data['to_vid']);

            $to = array('x' => $exist['x'], 'y' => $exist['y']);

            $speeds = $unitarray = array();
            $sendnum = 0;
            $unitarra = $database->getUnit($village->wid);
			

            for ($i = 1; $i <= 11; $i++) {
                $data['u' . $i] = preg_replace("/[^0-9]/", "", $data['u' . $i]);
                if (empty($data['u' . $i])) {
                    $data['u' . $i] = 0;
                }
                if ($data['u' . $i] > $unitarra['u' . $i]) {
                    $form->addError("error", "Can't send more units than you own");
                    break;
                }
                if ($data['u' . $i] < 0) {
                    $form->addError("error", "Cannot send negative units");
                    break;
                }
                $sendnum += $data['u' . $i];
            }
            if (!$sendnum) {
                $form->addError("error", "At least one unit must be specified.");
            }

			if(!$exist['owner'] || $exist['owner']==''){
				$form->addError("error", "!");
			}
			
            if($database->getUserInfo($exist['owner'])['protect'] && $exist['owner'] != $session->uid){
                $form->addError("error", "player Still under protection for beginners!");
            }

            if($session->protection > time() && !$exist['oasistype'] && $exist['owner'] && $post['c'] != 3){
                $form->addError("error", "Still under the protection of beginners!");
            }

            if ($form->returnErrors() > 0) {
                $_SESSION['errorarray'] = $form->getErrors();
                $_SESSION['valuearray'] = $_POST;
                header("Location: build.php?t=2&id=39&z=".$data['to_vid']."");
            } else {
                //if(!$exist['owner'] || empty($exist['owner'])){$exist['owner']=2;}
                //find slowest unit.
                $bonuses=$database->allHeroBonuses($database->getHeroInventory($session->uid));
                for ($i = 1; $i <= 10; $i++) {
                    if ($data['u' . $i] > 0) {
                        global ${"u" . (($session->tribe - 1) * 10 + $i)};
                        $unitarray = ${"u" . (($session->tribe - 1) * 10 + $i)};
                        $speeds[] = $unitarray['speed'];

                    }
                }
                if ($data['u11'] > 0) {
                    $speeds[] = $session->heroD['speed'];
                }
                $fastertroops = $database->checkArtefactsEffects($session->uid, $village->wid, 2);


                if (empty($post['artefact'])  || $data['u11'] == 0) {
                    $post['artefact'] = 0;
                } elseif ($post['artefact'] != 0) {
                    $vrefofart = $database->getArtefactDetails($post['artefact']);
                    if ($data['to_vid'] != $vrefofart['vref']) {
                        $post['artefact'] = 0;
                    }
                }
                $bon2=$bon=1;
                if($data['u11']>0){
                $tally=$database->getUserAllianceID($exist['owner']);
                if($session->alliance>0 && $session->alliance==$tally){$bon=$bonuses['ally'];}
                if($session->uid==$exist['owner']){$bon2=$bonuses['own'];}
                }else{$bonuses['speedb']=1;}
                $time = round($database->procDistanceTime($village->coor, $to, min($speeds)*$bon*$bon2*$bonuses['speedb'], 1, $village->wid) / $fastertroops);
                if (!isset($post['ctar1'])) {
                    $post['ctar1'] = 0;
                }
                if (!isset($post['ctar2'])) {
                    $post['ctar2'] = 0;
                }
                if (!isset($post['spy'])) {
                    $post['spy'] = 0;
                }



                if ($exist['oasistype'] || $exist['owner']) {
                    
               //for ($i = 0; $i <= 49; $i++) {
                    $hero = $data['u11'];
                    if($data['u11']>1){$hero=1;}
                        $reference = $database->addAttack($village->wid, $data['u1'], $data['u2'], $data['u3'], $data['u4'], $data['u5'], $data['u6'], $data['u7'], $data['u8'], $data['u9'], $data['u10'], $hero, $data['type'], $post['ctar1'], $post['ctar2'], $post['spy'], $post['artefact'],$data['add']);
                        if ($database->addMovement(3, $village->wid, $data['to_vid'], $reference, time(), ($time + time()))) {

                            $typo=1;
                            if($data['type']==2){$typo=3;}
                            $database->insertQueue($reference, $typo, time(), ($time + time()));
                            $database->modifyUnit(
                                $village->wid,
                                array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11),
                                array($data['u1'], $data['u2'], $data['u3'], $data['u4'], $data['u5'], $data['u6'], $data['u7'], $data['u8'], $data['u9'], $data['u10'], $data['u11']),
                                0
                            );
                        }

                // }
                    $protect = $session->protection;
                    if ($protect > time() && $session->protect == 1 && $data['type']!=2 || $session->protect == 1 && $protect < time() && $session->uid!=$exist['owner']) {
                        if($exist['oasistype']){
                            if($database->getOasisInfo($data['to_vid'])['conqured']){ // iRedux - Fixed
                                $x=0;
                                foreach($session->vvillages as $vil){
                                    if($vil['wref'] == $database->getOasisInfo($data['to_vid'])['conqured']){
                                        $x++;
                                    }
                                }
                                
                                if($x == 0){
                                    $database->Updateuserfield($session->uid, "ptime", 0, 1);
                                    $database->Updateuserfield($session->uid, "protect", 0, 1);
                                }
                            }
                        }else{
                            $x=0;
                            foreach($session->vvillages as $vil){
                                if($vil['wref'] == $data['to_vid']){
                                    $x++;
                                }
                            }
                            if($x == 0){
                                if($database->getUserInfoByVillageID($data['to_vid'])['id'] != 3){
                                    $database->Updateuserfield($session->uid, "ptime", 0, 1);
                                    $database->Updateuserfield($session->uid, "protect", 0, 1);
                                }
                                
                            }
                        }
                    }
                }
                //

               header("Location: build.php?t=1&id=39");
            }
        }else{header("Location: build.php?t=1&id=39");}

    }

    private function sendTroopsBack($post)
    {
        global $form, $database, $village,$session;

            $post['ckey']=$database->filterintvalue($post['ckey']);
            $enforce = $database->getEnforceArray($post['ckey'], 0);
            if (($enforce['from'] == $village->wid) || ($enforce['vref'] == $village->wid || in_array($enforce['vref'],array($village->oasisowned[0]['wref'],$village->oasisowned[1]['wref'],$village->oasisowned[2]['wref'])))) {

                $to = $database->getVillage($enforce['from']);
                $from = $database->checkviloas($enforce['vref']);
                for ($i = 1; $i <= 11; $i++) {
                    if (isset($post['t' . $i])) {
                        $post['t' . $i] = preg_replace("/[^0-9]/", "", $post['t' . $i]);


                        if ($post['t' . $i] > $enforce['u' . $i]) {
                            $form->addError("error", "You can't send more units than you have");
                            break;
                        }

                        if ($post['t' . $i] < 0) {
                            $form->addError("error", "You can't send negative units.");
                            break;
                        }

                    }
                    if (empty($post['t' . $i])) {
                        $post['t' . $i] = 0;
                    }
                }


                if (!$post['t1'] && !$post['t2'] && !$post['t3'] && !$post['t4'] && !$post['t5'] &&
                    !$post['t6'] && !$post['t7'] && !$post['t8'] && !$post['t9'] && !$post['t10'] && !$post['t11']
                ) {
                    $form->addError("error", "You need to mark min. one troop");
                }

                if ($form->returnErrors() > 0) {
                    $_SESSION['errorarray'] = $form->getErrors();
                    $_SESSION['valuearray'] = $_POST;
                    header("Location: build.php?t=2&id=39");
                } else {

                    $fromCor = array('x' => $from['x'], 'y' => $from['y']);
                    $toCor = array('x' => $to['vx'], 'y' => $to['vy']);

                    $speeds = $unitarray = array();
                    $sestr = $database->getUserField($to['owner'], "tribe", 0);
                    //find slowest unit.
                    for ($i = 1; $i <= 10; $i++) {
                        if ($post['t' . $i] > 0) {
                            if ($unitarray) {
                                reset($unitarray);
                            }
                            global ${"u" . (($sestr - 1) * 10 + $i)};
                            $unitarray = ${"u" . (($sestr - 1) * 10 + $i)};
                            $speeds[] = $unitarray['speed'];
                        }
                    }
                    if ($post['t11'] > 0) {
                        $herod = $database->getHeroData($to['owner']);
                        $speeds[] = $herod['speed'];
                    }
                    $fastertroops = $database->checkArtefactsEffects($to['owner'], $enforce['from'], 2);


                    $bon2=$bon=$bonuses['speedb']=$bonuses['back']=1;
                    if($post['t11']>0){
                        $bonuses=$database->allHeroBonuses($database->getHeroInventory($session->uid));
                        $tally=$database->getUserAllianceID($from['owner']);
                        if($session->alliance>0 && $session->alliance==$tally){$bon=$bonuses['ally'];}
                        if($session->uid==$from['owner']){$bon2=$bonuses['own'];}
                    }
                    $time = round($database->procDistanceTime($fromCor, $toCor, (min($speeds)*$bon*$bon2*$bonuses['back']*$bonuses['speedb']), 1, $enforce['from']) / $fastertroops);
                    $reference = $database->addAttack($enforce['from'], $post['t1'], $post['t2'], $post['t3'], $post['t4'], $post['t5'], $post['t6'], $post['t7'], $post['t8'], $post['t9'], $post['t10'], $post['t11'], 2, 0, 0, 0, 0);
                    if ($database->addMovement(4, $enforce['vref'], $enforce['from'], $reference, time(), ($time + time())) and $reference) {
                        $database->insertQueue($reference, 2, time(), ($time + time()));
                        $database->modifyEnforce($post['ckey'],
                            array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11),
                            array($post['t1'], $post['t2'], $post['t3'], $post['t4'], $post['t5'], $post['t6'], $post['t7'], $post['t8'], $post['t9'], $post['t10'], $post['t11']),
                            0);
                    }
                    $database->checkReinf($post['ckey']);

                    header("Location: build.php?t=1&id=39");

                }
            } else {
                $form->addError("error", "You cant change someones troops.");
                if ($form->returnErrors() > 0) {
                    $_SESSION['errorarray'] = $form->getErrors();
                    $_SESSION['valuearray'] = $_POST;
                    header("Location: build.php?t=2&id=39");
                }
            }

    }

    private function Settlers($post)
    {
        global $form, $database, $village, $session;
            $mode = CP;
            $total = count($session->villages);
            $need_cps = ${'cp' . $mode}[$total + 1];
            $cps = $session->cp;
            $post['s']=$database->filterintvalue($post['s']);
            $rallypoint = $village->resarray;
            if (!$database->getVillageState($post['s'])) {
                if ($rallypoint['f39'] > 0) {
                    if ($cps >= $need_cps) {
                        $newvillage = $database->getMInfo($post['s']);
                        if(!empty($newvillage['type_of'])){
                            $form->addError("error", "You can't send settlers to oases field.");
                        }
                        $from = $village->coor;
                        $to = array('x' => $newvillage['x'], 'y' => $newvillage['y']);
                        $fastertroops = $database->checkArtefactsEffects($session->uid, $village->wid, 2);
                        $time = round($database->procDistanceTime($from, $to, 5, 1, $village->wid) * $fastertroops);

                        if (3 > $village->unitarray['u10']) {
                            $form->addError("error", "You can't send more units than you have");

                        }
                        if ($form->returnErrors() > 0) {
                            $_SESSION['errorarray'] = $form->getErrors();
                            $_SESSION['valuearray'] = $_POST;
                            header("Location: build.php?t=2&id=39");
                        } else {
                            $database->modifyResource($village->wid, 750, 750, 750, 750, 0);
                            $database->modifyUnit($village->wid, array(10), array(3), 0);
                            $ref = $database->addAttack($village->wid, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 5, 0, 0, 0, 0);
                            $database->addMovement(3, $village->wid, $post['s'], $ref, time(), time() + $time);
                            $database->insertQueue($ref, 4, time(), ($time + time()));
                            header("Location: build.php?t=1&id=39");
                        }
                    } else {
                        header("Location: build.php?t=1&id=39");
                    }
                } else {
                    $form->addError("error", "Build a rally Point");

                    $_SESSION['errorarray'] = $form->getErrors();
                    $_SESSION['valuearray'] = $_POST;
                    header("Location: build.php?t=2&id=39");

                }
            }

    }
    public function Adventures($post) {
        global  $database, $village, $session, $heroF;

        $hero=$session->heroD;
        $post['h'] = $database->FilterIntValue($post['h']);
        $adv=$database->getAdventure($session->uid,$post['h']);
        if($adv && !$adv['end']){
            $eigen = $database->getCoor($heroF->heroData('wref'));
            $adventure = $database->getMInfo($adv['wref']);
            $from = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
            $to = array('x'=>$adventure['x'], 'y'=>$adventure['y']);
            $herodetail = $session->heroD;
            $speed = $herodetail['speed'];
            $time = $database->procDistanceTime($from,$to,$speed,1);
            if(!$hero['dead'] && $heroF->getHeroStatus() == 100) {
                if($session->qData['quest'] == 11){ 
                    $database->query("UPDATE quests SET step1=1,isFinished = 1 WHERE userid = ".$session->uid."");
                }

                if($session->qArrayB1[0] == 1){ 
                    $database->query("UPDATE quests SET battle1 = '1,1' WHERE userid = ".$session->uid."");
                }

                $database->modifyUnit($heroF->heroData('wref'),array(11),array(1),0);
                $ref = $database->addAttack($heroF->heroData('wref'), 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0);

                $database->addMovement(9,$heroF->heroData('wref'),$adv['wref'],$ref,time(),time()+$time);
                $database->insertQueue($ref, 13, time(), ($time + time()));

            }
        }
        header('Location: start_adventure.php?kid='.$adv['wref'].'&h=1');
        //header('Location: build.php?t=2&id=39&kid='.$adv['wref'].'&h=1');
        //header('Location: dorf2.php');
        //header("Location: build.php?t=1&id=39");
    }


}


$units = new Units;
