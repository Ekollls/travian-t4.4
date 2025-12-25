<?php
/*
    By iRedux - https://www.facebook.com/opito8
*/
Class Plus{

    public $plus;
    public $pBonus;

    function __construct() {
        global $session, $database, $village;
        $this->session = $session;
        $this->database = $database;
        $this->village = $village;
        $this->uid = $session->uid; $this->vid = $session->vid; 
        $this->plus = $this->duration('Plus');
        $this->pBonus = $this->duration('Bonus');

        // later delete this and put it in register
        $qCheck = $database->queryFetch('SELECT uid FROM `plusaddons` WHERE `uid` = '.$session->uid.'');
        if(!$qCheck['uid']){
            $database->query('INSERT INTO `plusaddons` VALUES(NULL,'.$session->uid.',0,0,0,0,0)');
        }
    }

    public function pAData($t){
        $pAData = $this->database->queryFetch('SELECT * FROM `plusaddons` WHERE `uid` = '.$this->uid.'');
        switch($t){
            case 'fasterTraining':
                if($pAData['fasterTraining']){
                    if(time() > $pAData['fasterTraining']){
                        return FALSE;
                    }else{
                        return $pAData['fasterTraining'];
                    }
                }else{
                    return FALSE;
                }
            break;  
            default:
                return $pAData[$t];
            break;
        }
        //return $pAData;
    }
    // 
    public function duration($type){
        global $lang;
        switch($type){
            case 'Plus':
                $bTime = PLUS_TIME;
                if(floor($bTime / 86400) == 0){
                    $bTime = ($bTime / (60*60)); // get it in hours not days
                    $Type = $lang['Plus']['Hours'];
                }else{
                    $bTime = ($bTime / 86400);
                    $Type = $lang['Plus']['Days'];
                }
                
            break;
            case 'Bonus':
                $bTime = PLUS_PRODUCTION;
                if(floor($bTime / 86400) == 0){
                    $bTime = ($bTime / (60*60)); // get it in hours not days
                    $Type = $lang['Plus']['Hours'];
                }else{
                    $bTime = ($bTime / 86400);
                    $Type = $lang['Plus']['Days'];
                }
            break;
        }

        return array(
            'Duration' => floor($bTime),
            'Type' => $Type,
        );
    }

    public function checkupAll(){
        global $database, $session, $village;
        if($this->isCapital($session->vid)){$maxLvl = 20;}else{$maxLvl = 10;}
        
        for($i=1,$x=0;$i<=18;$i++){
            if($village->resarray['f' . $i] != $maxLvl){
                $x++;
            }
        }

        return $x == 0 ? false : true;
    }

    function isCapital($vid){
        global $database;
        $q = $database->queryFetch('SELECT capital FROM vdata WHERE wref = '.$vid.'');
        if($q['capital']){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function upAll(){
        global $database, $session, $village;
        $rGold = MAX_LEVEL_COST * 18;
        
        if($rGold <= $session->gold){
            if($this->checkupAll()){
                for($i=1;$i<=18;$i++){
                    if($this->isCapital($session->vid)){$maxLvl = 20;}else{$maxLvl = 10;}
                    $database->query("UPDATE fdata SET `f$i` = ".$maxLvl." WHERE `vref` = ".$session->vid."");
                }
                
                $database->recountPop($session->vid);
                $database->modifyGold($session->uid, $rGold, 0);
                
                return $this->reloadPage();
                //return $this->reloadDialog();
            }else{
                return $this->errorMsg('Collect level 20 fields with verb');
            }
        }
        
    }

    function upStorage(){
        global $bid10,$config;
        if(25 <= $this->session->gold){
            $sData = $this->database->queryFetch('SELECT * FROM `storage` WHERE `uid` = '.$this->session->uid.' AND `vid` = '.$this->session->vid.'');
            if($sData['id']){
                $this->database->query('UPDATE `storage` SET storagem = storagem + 1 WHERE `uid` = '.$this->session->uid.' AND `vid` = '.$this->session->vid.'');
            }else{
                $this->database->query('INSERT INTO `storage` VALUES(NULL, '.$this->session->uid.', '.$this->session->vid.',1)');
            }
            //$this->database->query('UPDATE `plusaddons` SET `storage` = `storage` + 1 WHERE `uid` = '.$this->session->uid.'');
            $this->database->modifyGold($this->session->uid, $config['storageUpgrade'], 0);

            return $this->reloadPage();
        }else{
            return $this->errorMsg('Do not own enough gold');
        }
    }

    function finishTraining(){
        if(FINISH_ALL <= $this->session->gold){
            $this->database->fastTraining($this->uid, $this->vid);

            return $this->reloadPage();
        }else{
            return $this->errorMsg('Do not own enough gold');
        }
    }

    function fasterTraining(){
        global $config;
        if($config['25pFaster'] <= $this->session->gold){
            $fTraining = $this->pAData('fasterTraining');
            if($fTraining){ $aTime = $fTraining + (60*60*12); } else{ $aTime = time() + (60*60*12); }

            $this->database->query('UPDATE `plusaddons` SET `fasterTraining` = '.$aTime.' WHERE uid = '.$this->uid.'');
            $this->database->modifyGold($this->session->uid, $config['25pFaster'], 0);

            return $this->reloadDialog();
        }else{
            return $this->errorMsg('Do not own enough gold');
        }
    }

    function smithyAll(){
        $abData = $this->database->queryFetch('SELECT * FROM `abdata` WHERE `vref` = '.$this->vid.'');
        $x=0;
        for($i=1;$i<=8;$i++){
            if($abData['a'.$i] == 0){
                $x++;
            }
        }
        
        return $x ? TRUE : FALSE;
    }

    function smithyUpgradeAllToMax(){
        global $technology,$config;

        if($this->smithyAll()){
            if($config['allSmithy'] <= $this->session->gold){
                $abdata = $this->database->getABTech($this->vid);
                $ABups = $technology->getABUpgrades('a'); 
                
                for($i=($this->session->tribe*10-9),$ii=0;$i<=($this->session->tribe*10-2);$i++) { 
                    $j = $i % 10 ;
                    if ( $technology->getTech(($i-(($this->session->tribe-1)*10))) || $j == 1 ) {
                        $this->database->query("UPDATE abdata SET a$j = 20 WHERE vref = ".$this->vid."");
                        //$this->database->query("UPDATE abdata SET b$j = 20 WHERE vref = ".$this->vid."");
                    }
                }        

                $this->database->modifyGold($this->session->uid, $config['allSmithy'], 0);
                return $this->reloadPage();
            }else{
                return $this->errorMsg('Do not own enough gold');
            }
        }else{
            return $this->errorMsg('Units were already searched for units in this village');
        }
    }

    function academyAll(){
        $acData = $this->database->queryFetch('SELECT * FROM tdata WHERE vref = '.$this->vid.'');

        $x=0;
        for($i=2;$i<=9;$i++){
            if($acData['t'.$i] == 0){
                $x++;
            }
        }
        
        return $x ? TRUE : FALSE;
    }

    function academyResearchAll(){
        global $technology,$config;
        if($this->academyAll()){
            if($config['searchAll'] <= $this->session->gold){
                for($i=2;$i<=9;$i++){
                    $this->database->query("UPDATE tdata SET t$i = 1 WHERE vref = ".$this->vid."");
                }

                $this->database->modifyGold($this->session->uid, $config['searchAll'], 0);
                return $this->reloadPage();
            }else{
                return $this->errorMsg('Do not own enough gold');
            }    
        }else{
            return $this->errorMsg('A search was made for the collection of units of this village');
        }
    }

    function buyResources($type){
        global $config;
        //$eNum = 180000 * SPEED;
        switch($type){
            case 0:$eNum=$config['resources01A'];$gCost=$config['resources01'];break;
            case 1:$eNum=$config['resources02A'];$gCost=$config['resources02'];break;
            case 2:$eNum=$config['resources03A'];$gCost=$config['resources03'];break;
        }
        if($gCost <= $this->session->gold){
            $this->database->queryFetch("UPDATE vdata SET wood = wood + ".($eNum).", clay = clay + ".($eNum).", iron = iron + ".($eNum).", crop = crop + ".($eNum)."  WHERE wref = ".$this->vid."");

            $this->database->modifyGold($this->session->uid, $gCost, 0);
            return $this->reloadPage();
        }else{
            return $this->errorMsg('Do not own enough gold');
        }
    }

    function moreProtection($type){
        global $config;
        switch($type){
            case 0:$bonus=1;$gCost=$config['protect01'];break;
            case 1:$bonus=3;$gCost=$config['protect02'];break;
            case 2:$bonus=6;$gCost= $config['protect03'];break;
        }
        if($gCost <= $this->session->gold){
                    if($this->session->protection < time()){
                        $pTime = time() + ($bonus * 60 *60);
                    }else{
                        $pTime = 'ptime + '.($bonus * 60 *60).'';
                    }
                    $this->database->query('UPDATE users SET protect = 1, ptime = '.(($pTime)).' WHERE id = '.$this->uid.'');
                    $this->database->query('UPDATE plusaddons SET addonprotection = addonprotection + '.$bonus.' WHERE uid = '.$this->uid.'');
                    $this->database->modifyGold($this->session->uid, $gCost, 0);
                    return $this->reloadPage();        
        }else{
            return $this->errorMsg('Do not own enough gold');
        }
    }

    function finishNow(){
        global $building;
        
        if(2 <= $this->session->gold){
            $building->finishAll();
            //$this->database->modifyGold($this->session->uid, 2, 0);
            return $this->reloadPage();
        }else{
            return $this->errorMsg('Do not own enough gold');
        }
    }

    function demolishNow($bid){
        global $database, $session;
        $vData = $database->queryFetch('SELECT * FROM fdata WHERE vref = '.$session->vid.'');
    
        if($vData['f'.$bid]){
            $this->database->modifyGold($this->session->uid, DEMOLISH_FULL, 0);
            $database->query('UPDATE fdata SET f'.$bid.' = 0, f'.$bid.'t = 0 WHERE vref = '.$session->vid.'');
            $database->recountPop($session->vid);
        }
        
        return $this->reloadPage();
    }

    // New code to update plus times, fixed
    function updatePlus($type, $time=''){
        global $database,$session;
        switch($type){
            case 1: // Plus
                $time ? $addT = $time : $addT = PLUS_TIME;
                $session->plust ? $session->plust > time() 
                ? $nTime = $session->plust + $addT 
                : $nTime = time() + $addT 
                : $nTime = time() + $addT;
                $database->query('UPDATE users SET plus = '.$nTime.' WHERE id = '.$session->uid.'');
                $database->query('DELETE FROM pnews WHERE nid = 1 AND uid = '.$session->uid.'');
            break;

            case 2: // Wood Prod
                $time ? $addT = $time : $addT = PLUS_PRODUCTION;
                $session->bonus1 ? $session->bonus1 > time() 
                ? $nTime = $session->bonus1 + $addT 
                : $nTime = time() + $addT 
                : $nTime = time() + $addT;
                $database->query('UPDATE users SET b1 = '.$nTime.' WHERE id = '.$session->uid.'');
                $database->query('DELETE FROM pnews WHERE nid = 2 AND uid = '.$session->uid.'');
            break;

            case 3: // Clay Prod
                $time ? $addT = $time : $addT = PLUS_PRODUCTION;
                $session->bonus2 ? $session->bonus2 > time() 
                ? $nTime = $session->bonus2 + $addT 
                : $nTime = time() + $addT 
                : $nTime = time() + $addT;
                $database->query('UPDATE users SET b2 = '.$nTime.' WHERE id = '.$session->uid.'');
                $database->query('DELETE FROM pnews WHERE nid = 3 AND uid = '.$session->uid.'');
            break;
            case 4: // Iron Prod
                $time ? $addT = $time : $addT = PLUS_PRODUCTION;
                $session->bonus3 ? $session->bonus3 > time() 
                ? $nTime = $session->bonus3 + $addT 
                : $nTime = time() + $addT 
                : $nTime = time() + $addT;
                $database->query('UPDATE users SET b3 = '.$nTime.' WHERE id = '.$session->uid.'');
                $database->query('DELETE FROM pnews WHERE nid = 4 AND uid = '.$session->uid.'');
            break;
            case 5: // Crop Prod
                $time ? $addT = $time : $addT = PLUS_PRODUCTION;
                $session->bonus4 ? $session->bonus4 > time() 
                ? $nTime = $session->bonus4 + $addT 
                : $nTime = time() + $addT 
                : $nTime = time() + $addT;
                $database->query('UPDATE users SET b4 = '.$nTime.' WHERE id = '.$session->uid.'');
                $database->query('DELETE FROM pnews WHERE nid = 5 AND uid = '.$session->uid.'');
            break;
        }
    }

    function infobox($u){
        global $config, $session;
        switch($u){
            case 1: // Plus
                $reqGold = $config['Plus'];
                if($session->gold >= $reqGold){
                    $this->database->modifyGold($session->uid, $reqGold, 0);
                    $this->updatePlus(1);
                }
            break;
            case 2:
            case 3:
            case 4:
            case 5:
                $reqGold = $config['addonProduction'];
                if($session->gold >= $reqGold){
                    $this->database->modifyGold($session->uid, $reqGold, 0);
                    $this->updatePlus($u);
                }
            break;
        }

        if($session->gold >= $reqGold){
            return $this->reloadPage();
        }else{
            // Show recharge popup
            return $this->errorMsg('Do not own enough gold');
        }
    }

    function errorMsg($m){
        return '{"response":{"error":true,"errorMsg":"'.$m.'","data":[]}}';
    }

    function reloadDialog(){
        return '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"paymentWizard"}}}';
    }

    function reloadPage(){
        return '{"response": {"error":false,"errorMsg":null,"data":{"functionToCall":"reloadUrl","options":{"html":""}}}}';
    }
}

$p = new Plus;
