<?php
Class Quest{

    function __construct(){
        $this->checkQ();
    }

    function checkQ(){
        global $database, $session, $village, $building, $technology, $lang;
        
        $fData = $database->queryFetch("SELECT * FROM fdata WHERE vref = ".$_SESSION['wid']."");

        // this is for daily quest for auction
        if($session->acData['a4'] < 5){
            $qMO = $database->queryFetchColumn("SELECT count(*) FROM auction WHERE  `uid` = ".$session->uid." AND finish = 1");
                
            if($qMO >= 1){
                $database->UpdateAchievU($session->uid,"`a4`=a4+5");
                
            }
        }

        // 3rd Quest
        if($session->qData['quest'] == 3){
            for($i=0;$i<19;$i++){
                if($fData['f'.$i.''] > 0 && $fData['f'.$i.'t'] == 1){
                    $database->query("UPDATE quests SET step1 = 1,step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                break;
                }
            }
        }

        // 3rd Quest - make sure he has not any 2nd level wood 
        if($session->qData['quest'] == 4){
            for($i=0;$i<19;$i++){
                if($fData['f'.$i.''] > 1 && $fData['f'.$i.'t'] == 1){
                    $database->query("UPDATE quests SET step1 = 1,step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                break;
                }
            }
        }

        // 4rd Quest - make sure he has not any 1st level crop land
        if($session->qData['quest'] == 5){
            for($i=0;$i<19;$i++){
                if($fData['f'.$i.''] > 0 && $fData['f'.$i.'t'] == 4){
                    $database->query("UPDATE quests SET step1 = 1,step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                break;
                }
            }
        }

        if($session->qData['quest'] == 8){
            for($i=19;$i<39;$i++){
                if($fData['f'.$i.''] > 0 && $fData['f'.$i.'t'] == 10){
                    $database->query("UPDATE quests SET step1 = 1,step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
                    break;
                }
            }
        }

        if($session->qData['quest'] == 9){
            if($fData['f39'] > 0){
                $database->query("UPDATE quests SET step1 = 1,step2 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
            }
        }

        // check if he already sent a hero for an adventure before
        if($session->qData['quest'] == 11){

        }

        // check if read or delete report
        if($session->qData['quest'] == 12 && $session->qData['step1'] == 1){
            $reP = $database->queryFetchColumn("SELECT count(*) FROM ndata WHERE uid = ".$session->uid." AND ntype = 21 AND viewed =1");
            if($reP == 0 || $reP > 0){
                $database->query("UPDATE quests SET step2=1,isFinished=1 WHERE userid = ".$session->uid."");
            }
        }

        if($session->qArrayB2[0] == 2 && $session->qArrayB2[1] == 0){
            for($i=19;$i<39;$i++){
                if($fData['f'.$i.''] > 0 && $fData['f'.$i.'t'] == 23){
                    $database->query("UPDATE quests SET battle2='2,1' WHERE userid = ".$session->uid."");
                break;
                }
            }
        }

        // check if have barracks
        if($session->qArrayB1[0] == 3 && $session->qArrayB1[1] == 0){
            for($i=19;$i<39;$i++){
                if($fData['f'.$i.''] > 0 && $fData['f'.$i.'t'] == 19){
                    $database->query("UPDATE quests SET battle1='3,1' WHERE userid = ".$session->uid."");
                break;
                }
            }
        }

        if($session->qArrayB2[0] == 4 && $session->qArrayB2[1] == 0){
            $x=0;
            foreach($session->vvillages as $uVill){
                
                $qMO = $database->queryFetch("SELECT * FROM movement WHERE `from` = ".$uVill['wref']." AND `sort_type` =9 AND `proc` =1");
                foreach($qMO as $move){
                    $x++;
                }
            }

            if($x >= 5){
                $database->query("UPDATE quests SET battle2='4,1' WHERE userid = ".$session->uid."");
            }
        }

        /*
        if($session->qArrayB1[0] == 5 && $session->qArrayB1[1] == 0){
            if($session->heroD['power']){
                $database->query("UPDATE quests SET battle1='4,1' WHERE userid = ".$session->uid."");
            }
        }*/

        if($session->qArrayB1[0] == 5 && $session->qArrayB1[1] == 0){
            // need to check if have 2 or more footies
        }

        // check if have wall
        if($session->qArrayB2[0] == 6 && $session->qArrayB2[1] == 0){
            if($fData['f40'] > 0 ){
                $database->query("UPDATE quests SET battle2='6,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayB1[0] == 7 && $session->qArrayB1[1] == 0){
            $x=0;
            foreach($session->vvillages as $uVill){
                $qMO = $database->query("SELECT * FROM movement WHERE `from` = ".$uVill['wref']." AND `sort_type` =3 AND `proc` =1");
                foreach($qMO as $move){
                    if($database->isVillageOases($move['to']) && !$database->getOasisInfo($move['to'])['conqured']){
                        $x++;
                    }

                }
            }
            if($x >= 1){
                $database->query("UPDATE quests SET battle1='7,1' WHERE userid = ".$session->uid."");
            }
        

        }
        if($session->qArrayB2[0] == 8 && $session->qArrayB2[1] == 0){
            $x=0;
            foreach($session->vvillages as $uVill){
                
                $qMO = $database->queryFetch("SELECT * FROM movement WHERE `from` = ".$uVill['wref']." AND `sort_type` =9 AND `proc` =1");
                foreach($qMO as $move){
                    $x++;
                }
            }
            if($x >= 10){
                $database->query("UPDATE quests SET battle2='8,1' WHERE userid = ".$session->uid."");
            }
        }


        if($session->qArrayB1[0] == 9 && $session->qArrayB1[1] == 0){
            $qMO = $database->queryFetchColumn("SELECT count(*) FROM auction WHERE `owner` = ".$session->uid." OR `uid` = ".$session->uid."");
                
            if($qMO >= 1){
                $database->query("UPDATE quests SET battle1='9,1' WHERE userid = ".$session->uid."");
            }
        }

        if($session->qArrayB2[0] == 10 && $session->qArrayB2[1] == 0){
            if($this->getTypeLevel(19) >= 3){
                $database->query("UPDATE quests SET battle2='10,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayB1[0] == 11 && $session->qArrayB1[1] == 0){
            if($this->getTypeLevel(22) >= 1){
                $database->query("UPDATE quests SET battle1='11,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayB2[0] == 12 && $session->qArrayB2[1] == 0){
            
            $start = ($session->tribe*10-8);
            $end = ($session->tribe*10-1);
    
            for($i=$start,$x=0;$i<=$end;$i++) {
                if($session->tribe == 1){ $startTech = $i; }elseif($session->tribe == 2){ $startTech = $i-10; }elseif($session->tribe == 3){ $startTech = $i-20;}
                if($this->getTech($startTech)){
                    $x++;
                }
            }
            if($x != 0){
                $database->query("UPDATE quests SET battle2='12,1' WHERE userid = ".$session->uid."");
            }
        }

        if($session->qArrayB1[0] == 13 && $session->qArrayB1[1] == 0){            
            if($this->getTypeLevel(12) >= 1){
                $database->query("UPDATE quests SET battle1='13,1' WHERE userid = ".$session->uid."");
            }
        }

        if($session->qArrayB2[0] == 14 && $session->qArrayB2[1] == 0){
            $abdata = $database->getABTech($_SESSION['wid']);
            $ABups = $this->getABUpgrades('a'); 
            
            for($i=($session->tribe*10-9),$ii=0;$i<=($session->tribe*10-2);$i++) { 
                $j = $i % 10 ;
                if ( $this->getTech(($i-(($session->tribe-1)*10))) || $j == 1 ) {
                    
                    $ii++;
                    if(count($ABups) && $ABups[0]['tech']=="a".($i-(($session->tribe-1)*10))){$abdata['a'.$j]+=1;}
                    if($abdata['a'.$j] != 0){
                        $database->query("UPDATE quests SET battle2='14,1' WHERE userid = ".$session->uid."");
                    break;
                    }
                }
            }
        }


        // Economy Missions
        if($session->qArrayE1[0] == 1 && $session->qArrayE1[1] == 0){    
            if($this->getTypeLevel(3) >= 1){
                $database->query("UPDATE quests SET economy1='1,1' WHERE userid = ".$session->uid."");
            }
        }

        if($session->qArrayE2[0] == 2 && $session->qArrayE2[1] == 0){    
            if($this->getTypeLevel(1) >= 1 && $this->getTypeLevel(2) >= 1
                && $this->getTypeLevel(3) >= 1  && $this->getTypeLevel(4) >= 1){
                $database->query("UPDATE quests SET economy2='2,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayE1[0] == 3 && $session->qArrayE1[1] == 0){    
            if($this->getTypeLevel(11) >= 1){
                $database->query("UPDATE quests SET economy1='3,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayE2[0] == 4 && $session->qArrayE2[1] == 0){    
            $addOne = 0;
            for($i=0;$i<19;$i++){ if($fData['f'.$i.''] > 0){ $addOne++; }}
            if($addOne == 18){ $database->query("UPDATE quests SET economy2='4,1' WHERE userid = ".$session->uid.""); }
        }
        if($session->qArrayE1[0] == 5 && $session->qArrayE1[1] == 0){    
            if($this->getTypeLevel(1) >= 2 && $this->getTypeLevel(2) >= 2
                && $this->getTypeLevel(3) >= 2  && $this->getTypeLevel(4) >= 2){
                $database->query("UPDATE quests SET economy1='5,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayE2[0] == 6 && $session->qArrayE2[1] == 0){    
            if($this->getTypeLevel(17) >= 1){ 
                $database->query("UPDATE quests SET economy2='6,1' WHERE userid = ".$session->uid."");
            }
        }
        // do i need to add 7 ? the market  one
        if($session->qArrayE2[0] == 8 && $session->qArrayE2[1] == 0){    
            $addOne = 0;
            for($i=0;$i<19;$i++){ if($fData['f'.$i.''] >= 2){ $addOne++; }}
            if($addOne == 18){ $database->query("UPDATE quests SET economy2='8,1' WHERE userid = ".$session->uid.""); }
        }
        if($session->qArrayE1[0] == 9 && $session->qArrayE1[1] == 0){    
            if($this->getTypeLevel(10) >= 3){ 
                $database->query("UPDATE quests SET economy1='9,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayE2[0] == 10 && $session->qArrayE2[1] == 0){    
            if($this->getTypeLevel(11) >= 3){ 
                $database->query("UPDATE quests SET economy2='10,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayE1[0] == 11 && $session->qArrayE1[1] == 0){
            if($this->getTypeLevel(8) >= 1){ 
                $database->query("UPDATE quests SET economy1='11,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayE2[0] == 12 && $session->qArrayE2[1] == 0){
            $addOne = 0;
            for($i=0;$i<19;$i++){ if($fData['f'.$i.''] >= 5){ $addOne++; }}
            if($addOne == 18){ $database->query("UPDATE quests SET economy2='12,1' WHERE userid = ".$session->uid.""); }
        }

        if(ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)) == 'Statistiken'){
            if($session->qArrayW1[0] == 1 && $session->qArrayW1[1] == 0){
                $database->query("UPDATE quests SET world1='1,1' WHERE userid = ".$session->uid."");
            }
        }

        if($session->qArrayW1[0] == 3 && $session->qArrayW1[1] == 0){
            if($this->getTypeLevel(15) >= 3){ 
                $database->query("UPDATE quests SET world1='3,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayW2[0] == 4 && $session->qArrayW2[1] == 0){
            if($this->getTypeLevel(18) >= 1){ 
                $database->query("UPDATE quests SET world2='4,1' WHERE userid = ".$session->uid."");
            }
        }

        if(ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)) == 'Karte'){
            if($session->qArrayW1[0] == 5 && $session->qArrayW1[1] == 0){
                $database->query("UPDATE quests SET world1='5,1' WHERE userid = ".$session->uid."");
            }
        }

        if($session->qArrayW2[0] == 6 && $session->qArrayW2[1] == 0){
            $mData = $database->queryFetch("SELECT * FROM mdata WHERE owner = 6 AND target = ".$session->uid." ORDER BY id DESC LIMIT 1");
            
            if($mData['id']){
                if($mData['topic'] == 'wMSGT'){
                    if($mData['viewed'] == 1){
                        $database->query("UPDATE quests SET world2='6,1' WHERE userid = ".$session->uid."");
                    }
                }
            }
            
            
        }


        if($session->qArrayW2[0] == 8 && $session->qArrayW2[1] == 0){
            if($session->alliance){
                $database->query("UPDATE quests SET world2='8,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayW1[0] == 9 && $session->qArrayW1[1] == 0){
            if($this->getTypeLevel(15) >= 5){ 
                $database->query("UPDATE quests SET world1='9,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayW2[0] == 10 && $session->qArrayW2[1] == 0){
            if($this->getTypeLevel(25) || $this->getTypeLevel(26)){ 
                $database->query("UPDATE quests SET world2='10,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayW2[0] == 12 && $session->qArrayW2[1] == 0){
            if($this->getTypeLevel(10) >= 7){ 
                $database->query("UPDATE quests SET world2='12,1' WHERE userid = ".$session->uid."");
            }
        }

        if($session->qArrayW1[0] == 13 && $session->qArrayW1[1] == 0){
            if($this->getTypeLevel(25) >= 10 || $this->getTypeLevel(26) >= 10){ 
                $database->query("UPDATE quests SET world1='13,1' WHERE userid = ".$session->uid."");
            }
        }
        if($session->qArrayW2[0] == 14 && $session->qArrayW2[1] == 0){
            $unitArr = $database->WowSoQueryV($_SESSION['wid']);
            $unit = (($session->tribe-1)*10+10);

            if($unitArr['u'.($unit-($session->tribe-1)*10)] == 3){
                $database->query("UPDATE quests SET world2='14,1' WHERE userid = ".$session->uid."");
            }
        }

        if($session->qArrayW1[0] == 15 && $session->qArrayW1[1] == 0){
            $x=0; foreach($session->vvillages as $vil){$x++;}
            if($x > 1){
                $database->query("UPDATE quests SET world1='15,1' WHERE userid = ".$session->uid."");
            }
        }

    }
    
    public function userProgress(){
        global $database, $session;
        $q = $database->queryFetch("SELECT * FROM quests WHERE userid = ".$session->uid."");
        if($q['quest']){
            if($q['quest'] < 10){
                return '0'.$q['quest'];
            }else{
                return $q['quest'];
            }
        }else{
            $database->query("INSERT INTO quests VALUES(NULL,".$session->uid.",1,0,0,0,0,0,0,0,0,0,0)");
        }
        
    }

    public function getABUpgrades($type='a') {
		global $database;
		$holder = array();
		foreach($database->getResearching($_SESSION['wid']) as $research) {
			if(substr($research['tech'],0,1) == $type){
				array_push($holder,$research);
			}
		}
		return $holder;
	}

    public function getTypeLevel($tid,$vid=0) {
        global $village,$database;
        $village->resarray = $database->WowSoQueryV($_SESSION['wid']);

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

    public function getTech($tech) {
        global $database;

        $techarray= $database->WowSoQueryV($_SESSION['wid']);
		return ($techarray['t'.$tech] == 1);
    }
    
    public function getQuestMonitor($quest){
        global $database, $session, $lang;
        $qData = $database->queryFetch("SELECT * FROM quests WHERE userid = ".$session->uid."");
        
        if($quest == 16){
            // <img src="img/x.gif" class="finished">
            $qArrayB1 = explode(',',$qData['battle1']);
            $qArrayB2 = explode(',',$qData['battle2']);

            $qArrayE1 = explode(',',$qData['economy1']);
            $qArrayE2 = explode(',',$qData['economy2']);

            $qArrayW1 = explode(',',$qData['world1']);
            $qArrayW2 = explode(',',$qData['world2']);

            if($qArrayB1[0] < 10 && $qArrayB1[0] != 0){ $questIdB1 = '0'.$qArrayB1[0]; }else{ $questIdB1 = $qArrayB1[0];}
            if($qArrayB2[0] < 10 && $qArrayB2[0] != 0){ $questIdB2 = '0'.$qArrayB2[0]; }else{ $questIdB2 = $qArrayB2[0];}

            if($qArrayE1[0] < 10 && $qArrayE1[0] != 0){ $questIdE1 = '0'.$qArrayE1[0]; }else{ $questIdE1 = $qArrayE1[0];}
            if($qArrayE2[0] < 10 && $qArrayE2[0] != 0){ $questIdE2 = '0'.$qArrayE2[0]; }else{ $questIdE2 = $qArrayE2[0];}

            if($qArrayW1[0] < 10 && $qArrayW1[0] != 0){ $questIdW1 = '0'.$qArrayW1[0]; }else{ $questIdW1 = $qArrayW1[0];}
            if($qArrayW2[0] < 10 && $qArrayW2[0] != 0){ $questIdW2 = '0'.$qArrayW2[0]; }else{ $questIdW2 = $qArrayW2[0];}

            $firstBid = $questIdB1 < $questIdB2 ? $questIdB1 : $questIdB2; $SecondBid = $questIdB1 > $questIdB2 ? $questIdB1 : $questIdB2;
            $isFinishedB1 = $questIdB1 < $questIdB2 ? 1 : 2; $isFinishedB2 = $questIdB1 > $questIdB2 ? 1 : 2;

            $firstEid = $questIdE1 < $questIdE2 ? $questIdE1 : $questIdE2; $SecondEid = $questIdE1 > $questIdE2 ? $questIdE1 : $questIdE2;
            $isFinishedE1 = $questIdE1 < $questIdE2 ? 1 : 2; $isFinishedE2 = $questIdE1 > $questIdE2 ? 1 : 2;

            $firstWid = $questIdW1 < $questIdW2 ? $questIdW1 : $questIdW2; $SecondWid = $questIdW1 > $questIdW2 ? $questIdW1 : $questIdW2;
            $isFinishedW1 = $questIdW1 < $questIdW2 ? 1 : 2; $isFinishedW2 = $questIdW1 > $questIdW2 ? 1 : 2;

                        
            $ret = '
                    '.($firstBid ? '<li data-questid="Battle_'.($firstBid).'" data-category="battle">'.(${qArrayB.($isFinishedB1)}[1] ? '<img src="img/x.gif" class="finished">' : '').'<a href="#" class="quest">'.$lang['quests']['monitor']['battle'][($firstBid)].' </a></li>' : '').'
                    '.($SecondBid ? '<li data-questid="Battle_'.($SecondBid).'" data-category="battle">'.(${qArrayB.($isFinishedB2)}[1] ? '<img src="img/x.gif" class="finished">' : '').'<a href="#" class="quest">'.$lang['quests']['monitor']['battle'][($SecondBid)].' </a></li>' : '').'

                    '.($firstEid ? '<li data-questid="Economy_'.($firstEid).'" data-category="economy">'.(${qArrayE.($isFinishedE1)}[1] ? '<img src="img/x.gif" class="finished">' : '').'<a href="#" class="quest">'.$lang['quests']['monitor']['economy'][($firstEid)].' </a></li>' : '').'
                    '.($SecondEid ? '<li data-questid="Economy_'.($SecondEid).'" data-category="economy">'.(${qArrayE.($isFinishedE2)}[1] ? '<img src="img/x.gif" class="finished">' : '').'<a href="#" class="quest">'.$lang['quests']['monitor']['economy'][($SecondEid)].' </a></li>' : '').'

                    '.($firstWid ? '<li data-questid="World_'.($firstWid).'" data-category="world">'.(${qArrayW.($isFinishedW1)}[1] ? '<img src="img/x.gif" class="finished">' : '').'<a href="#" class="quest">'.$lang['quests']['monitor']['world'][($firstWid)].' </a></li>' : '').'
                    '.($SecondWid ? '<li data-questid="World_'.($SecondWid).'" data-category="world">'.(${qArrayW.($isFinishedW2)}[1] ? '<img src="img/x.gif" class="finished">' : '').'<a href="#" class="quest">'.$lang['quests']['monitor']['world'][($SecondWid)].' </a></li>' : '').'';
        }else{
            $listo = $lang['quests']['monitor'][(int)$quest]; 
            $ret = '';
            $x=0;
            foreach($listo as $list){ $x++; $ret .= '<li>'; if($qData['step'.$x.''] || $qData['isFinished']){ $ret .= '<img src="img/x.gif" class="finished">'; } $ret .= $list; $ret .= '</li>'; }
        }
        
        return $ret;
    }

    public function getQuestList($quest){

    }

    public function getQuestJS($quest){
        global $session;

        switch($quest){
            case 1: return '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id":"Tutorial_01","name":"questV2.tutorial_01_name","category":"tutorial","stepType":"task","currentStep":"0","stepCount":1,"steps":[{"stepId":0,"type":"task","stepDescription":"questV2.tutorial_01_step_01_layoutdescription"}],"answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=332#go2answer"},highlightSelectors: [{"selector":".dialog.questInformation .questButtonNext","renderer":"rectangle"},{"selector":"#questmasterButton","renderer":"rectangle"}]}'; break;
            case 2: return '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id":"Tutorial_02","name":"questV2.tutorial_02_name","category":"tutorial","stepType":"task","currentStep":"0","stepCount":4,"steps":[{"stepId":0,"type":"task","stepDescription":"questV2.tutorial_02_step_01_layoutdescription"},{"stepId":1,"type":"task","stepDescription":"questV2.tutorial_02_step_02_layoutdescription"},{"stepId":2,"type":"task","stepDescription":"questV2.tutorial_02_step_03_layoutdescription"},{"stepId":3,"type":"reward"}],"answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=332#go2answer"},highlightSelectors: [{"selector":".dialog.questInformation .iconButton.small.cancel","renderer":"rectangle"},{"selector":"#questmasterButton","renderer":"rectangle"}]}'; break;
            case 3: return '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id":"Tutorial_03","name":"questV2.tutorial_03_name","category":"tutorial","stepType":"task","currentStep":"0","stepCount":3,"steps":[{"stepId":0,"type":"task","stepDescription":"questV2.tutorial_03_step_01_layoutdescription"},{"stepId":1,"type":"task","stepDescription":"questV2.tutorial_03_step_02_layoutdescription"},{"stepId":2,"type":"reward"}],"answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=334#go2answer"},highlightSelectors: [{"selector":".perspectiveResources #village_map .level.gid1.level0","renderer":"image"},{"selector":".perspectiveBuildings #navigation .inactive","renderer":"image"},{"selector":".perspectiveResources #closeContentButton","renderer":"image"}]}'; break;
            case 4: return '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id":"Tutorial_04","name":"questV2.tutorial_04_name","category":"tutorial","stepType":"task","currentStep":"0","stepCount":3,"steps":[{"stepId":0,"type":"task","stepDescription":"questV2.tutorial_04_step_01_layoutdescription"},{"stepId":1,"type":"task","stepDescription":"questV2.tutorial_04_step_02_layoutdescription"},{"stepId":2,"type":"reward"}],"answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=335#go2answer"},highlightSelectors: [{"selector":".build .gid1.level1 button.build","renderer":"rectangle"},{"selector":".perspectiveResources #village_map .level.gid1.level1","renderer":"image"},{"selector":".perspectiveBuildings #navigation .inactive","renderer":"image"},{"selector":".perspectiveResources #closeContentButton","renderer":"image"}]}'; break;
            case 5: return '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id":"Tutorial_05","name":"questV2.tutorial_05_name","category":"tutorial","stepType":"task","currentStep":"0","stepCount":3,"steps":[{"stepId":0,"type":"task","stepDescription":"questV2.tutorial_05_step_01_layoutdescription"},{"stepId":1,"type":"task","stepDescription":"questV2.tutorial_05_step_02_layoutdescription"},{"stepId":2,"type":"reward"}],"answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=336#go2answer"},highlightSelectors: [{"selector":".build .gid4.level0 button.build", "renderer": "rectangle"},{"selector": ".perspectiveResources #village_map .level.gid4.level0", "renderer": "image"},{"selector": ".perspectiveBuildings #navigation .inactive", "renderer": "image"},{"selector": ".perspectiveResources #closeContentButton", "renderer": "image"}]}'; break;
            case 6: return $session->qData['step1'] == 0 ? '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id":"Tutorial_06","name":"questV2.tutorial_06_name", "category": "tutorial", "stepType": "task", "currentStep": 0, "stepCount": 3, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_06_step_01_layoutdescription"},{"stepId": 1, "type": "task", "stepDescription": "questV2.tutorial_06_step_02_layoutdescription"},{"stepId": 2, "type": "reward"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=337#go2answer"},highlightSelectors: [{"selector": ".hero .attributesTab.normal", "renderer": "rectangle"},{"selector": "#heroImageButton", "renderer": "image"}]}' : '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id": "Tutorial_06", "name": "questV2.tutorial_06_name", "category": "tutorial", "stepType": "task", "currentStep": 1, "stepCount": 3, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_06_step_01_layoutdescription"},{"stepId": 1, "type": "task", "stepDescription": "questV2.tutorial_06_step_02_layoutdescription"},{"stepId": 2, "type": "reward"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=337#go2answer"},highlightSelectors: [{"selector": ".hero_inventory .openCloseSwitchBar .openedClosedSwitch.switchClosed", "renderer": "rectangle"},{"selector": ".hero_inventory #saveHeroAttributes.clayClicked", "renderer": "rectangle"},{"selector": ".hero_inventory #setResource .resource.r2", "renderer": "rectangle"},{"selector": "#heroImageButton", "renderer": "image"}]}'; break;
            case 7: return '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id": "Tutorial_07", "name": "questV2.tutorial_07_name", "category": "tutorial", "stepType": "task", "currentStep": 0, "stepCount": 1, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_07_step_01_layoutdescription"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=338#go2answer"},highlightSelectors: [{"selector": ".perspectiveResources #navigation .inactive", "renderer": "image"},{"selector": ".perspectiveBuildings #closeContentButton", "renderer": "image"}]}'; break;
            case 8: return $session->qData['step1'] == 0 ? '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id": "Tutorial_08", "name": "questV2.tutorial_08_name", "category": "tutorial", "stepType": "task", "currentStep": 0, "stepCount": 3, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_08_step_01_layoutdescription"},{"stepId": 1, "type": "task", "stepDescription": "questV2.tutorial_08_step_02_layoutdescription"},{"stepId": 2, "type": "reward"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=339#go2answer"},highlightSelectors: [{"selector": ".perspectiveBuildings #village_map .iso", "renderer": "image"},{"selector": "#build.gid0 .contentNavi .container.normal.infrastructure", "renderer": "rectangle"},{"selector": ".perspectiveResources #navigation .inactive", "renderer": "image"},{"selector": ".perspectiveBuildings #closeContentButton", "renderer": "image"}]}' : '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id": "Tutorial_08", "name": "questV2.tutorial_08_name", "category": "tutorial", "stepType": "task", "currentStep": 1, "stepCount": 3, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_08_step_01_layoutdescription"},{"stepId": 1, "type": "task", "stepDescription": "questV2.tutorial_08_step_02_layoutdescription"},{"stepId": 2, "type": "reward"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=339#go2answer"},highlightSelectors: [{"selector": "#contract_building10 button.new", "renderer": "rectangle"},{"selector": ".perspectiveBuildings #village_map .iso", "renderer": "image"},{"selector": "#build.gid0 .contentNavi .container.normal.infrastructure", "renderer": "rectangle"},{"selector": ".perspectiveResources #navigation .inactive", "renderer": "image"},{"selector": ".perspectiveBuildings #closeContentButton", "renderer": "image"}]}'; break;
            case 9: return $session->qData['step1'] == 0 ? '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id": "Tutorial_09", "name": "questV2.tutorial_09_name", "category": "tutorial", "stepType": "task", "currentStep": 0, "stepCount": 3, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_09_step_01_layoutdescription"},{"stepId": 1, "type": "task", "stepDescription": "questV2.tutorial_09_step_02_layoutdescription"},{"stepId": 2, "type": "reward"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=340#go2answer"},highlightSelectors: [{"selector": ".perspectiveBuildings #village_map .building.g16e", "renderer": "image"},{"selector": ".perspectiveResources #navigation .inactive", "renderer": "image"},{"selector": ".perspectiveBuildings #closeContentButton", "renderer": "image"}]}' : '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id": "Tutorial_09", "name": "questV2.tutorial_09_name", "category": "tutorial", "stepType": "task", "currentStep": 1, "stepCount": 3, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_09_step_01_layoutdescription"},{"stepId": 1, "type": "task", "stepDescription": "questV2.tutorial_09_step_02_layoutdescription"},{"stepId": 2, "type": "reward"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=340#go2answer"},highlightSelectors: [{"selector": ".build #contract_building16 button.new", "renderer": "rectangle"},{"selector": ".perspectiveBuildings #village_map .building.g16e", "renderer": "image"},{"selector": ".perspectiveResources #navigation .inactive", "renderer": "image"},{"selector": ".perspectiveBuildings #closeContentButton", "renderer": "image"}]}'; break;
            case 10: return '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id": "Tutorial_10", "name": "questV2.tutorial_10_name", "category": "tutorial", "stepType": "task", "currentStep": 0, "stepCount": 2, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_10_step_01_layoutdescription"},{"stepId": 1, "type": "reward"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=341#go2answer"},highlightSelectors: [{"selector": "#finishNowDialog button", "renderer": "rectangle"},{"selector": ".finishNow button", "renderer": "rectangle"},{"selector": "#closeContentButton", "renderer": "image"}]}'; break;
            case 11: return '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id": "Tutorial_11", "name": "questV2.tutorial_11_name", "category": "tutorial", "stepType": "task", "currentStep": 0, "stepCount": 2, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_11_step_01_layoutdescription"},{"stepId": 1, "type": "reward"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=342#go2answer"},highlightSelectors: [{"selector": ".adventureSend button#start", "renderer": "rectangle"},{"selector": ".hero .gotoAdventure", "renderer": "rectangle"},{"selector": ".hero .adventuresTab.normal", "renderer": "rectangle"},{"selector": "#sidebarBoxHero .adventureWhite", "renderer": "image"}]}'; break;
            case 12: return '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id": "Tutorial_12", "name": "questV2.tutorial_12_name", "category": "tutorial", "stepType": "task", "currentStep": 0, "stepCount": 3, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_12_step_01_layoutdescription"},{"stepId": 1, "type": "task", "stepDescription": "questV2.tutorial_12_step_02_layoutdescription"},{"stepId": 2, "type": "reward"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=343#go2answer"},highlightSelectors: [{"selector": "#content.reports .contentNavi .overview", "renderer": "rectangle"},{"selector": "#navigation #n5 a", "renderer": "image"}]}'; break;
            //case 13: return '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id": "Tutorial_14", "name": "questV2.tutorial_14_name", "category": "tutorial", "stepType": "task", "currentStep": 0, "stepCount": 2, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_14_step_01_layoutdescription"},{"stepId": 1, "type": "reward"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=345#go2answer"},highlightSelectors: [{"selector": "#sidebarBoxQuestmaster button.bulbWhite", "renderer": "image"}]}'; break;
            case 14: return '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id": "Tutorial_14", "name": "questV2.tutorial_14_name", "category": "tutorial", "stepType": "task", "currentStep": 0, "stepCount": 2, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_14_step_01_layoutdescription"},{"stepId": 1, "type": "reward"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=345#go2answer"},highlightSelectors: [{"selector": "#sidebarBoxQuestmaster button.bulbWhite", "renderer": "image"}]}'; break;
            case 15: return '{tipsTurnoffAjaxTrigger: 1,tutorialData: {"id": "Tutorial_15", "name": "questV2.tutorial_15_name", "category": "tutorial", "stepType": "task", "currentStep": 0, "stepCount": 1, "steps": [{"stepId": 0, "type": "task", "stepDescription": "questV2.tutorial_15_step_01_layoutdescription"}], "answersLink": "http:\/\/t4.answers.travian.com\/index.php?aid=345#go2answer"},highlightSelectors: [{"selector": ".dialog.questInformation .questButtonNext", "renderer": "rectangle"}]}'; break;
            
            // Quests List
            case 16: return '{tipsTurnoffAjaxTrigger: false,listData: {"battle":{"questsTotal":15,"questsCompleted":0,"name":"battle","quests":{"Battle_'.$this->addZero($session->qArrayB1[0]).'":{"id":"Battle_'.$this->addZero($session->qArrayB1[0]).'","name":"questV2.battle_'.$this->addZero($session->qArrayB1[0]).'_name","category":"battle","stepType":"task","currentStep":"0","stepCount":2,"steps":[{"stepId":0,"type":"task","stepDescription":null},{"stepId":1,"type":"reward"}],"answersLink":""},"Battle_'.$this->addZero($session->qArrayB2[0]).'":{"id":"Battle_'.$this->addZero($session->qArrayB2[0]).'","name":"questV2.battle_'.$this->addZero($session->qArrayB2[0]).'_name","category":"battle","stepType":"task","currentStep":"0","stepCount":2,"steps":[{"stepId":0,"type":"task","stepDescription":null},{"stepId":1,"type":"reward"}],"answersLink":""}}},"economy":{"questsTotal":12,"questsCompleted":0,"name":"Economy","quests":{"Economy_'.$this->addZero($session->qArrayE1[0]).'":{"id":"Economy_'.$this->addZero($session->qArrayE1[0]).'","name":"questV2.economy_'.$this->addZero($session->qArrayE1[0]).'_name","category":"economy","stepType":"task","currentStep":"0","stepCount":2,"steps":[{"stepId":0,"type":"task","stepDescription":null},{"stepId":1,"type":"reward"}],"answersLink":""},"Economy_'.$this->addZero($session->qArrayE2[0]).'":{"id":"Economy_'.$this->addZero($session->qArrayE2[0]).'","name":"questV2.economy_'.$this->addZero($session->qArrayE2[0]).'_name","category":"economy","stepType":"task","currentStep":"0","stepCount":2,"steps":[{"stepId":0,"type":"task","stepDescription":null},{"stepId":1,"type":"reward"}],"answersLink":""}}},"world":{"questsTotal":16,"questsCompleted":0,"name":"World","quests":{"World_'.$this->addZero($session->qArrayW1[0]).'":{"id":"World_'.$this->addZero($session->qArrayW1[0]).'","name":"questV2.world_'.$this->addZero($session->qArrayW1[0]).'_name","category":"world","stepType":"task","currentStep":"0","stepCount":2,"steps":[{"stepId":0,"type":"task","stepDescription":null},{"stepId":1,"type":"reward"}],"answersLink":""},"World_'.$this->addZero($session->qArrayW2[0]).'":{"id":"World_'.$this->addZero($session->qArrayW2[0]).'","name":"questV2.world_'.$this->addZero($session->qArrayW2[0]).'_name","category":"world","stepType":"task","currentStep":"0","stepCount":2,"steps":[{"stepId":0,"type":"task","stepDescription":null},{"stepId":1,"type":"reward"}],"answersLink":""}}},"highlightSelectors":[]}}'; break;
        }
    }

    function addZero($input){
        if($input < 10){ return '0'.$input; }else{ return $input; }
    }
    public function updateQuest(){
        global $database, $session;
        $database->query("UPDATE quests SET quest = ".$quest." WHERE userid = ".$session->uid."");
    }

    function getimgClass($id, $isCompleted,$type=FALSE){
        global $session;
        if($type){
            if($type == 1){
                if($id == 5){
                    return 'battle_01';
                }else{
                    if($id == 6 || $id == 12){
                        return 'battle_'.$id.'_vid'.$session->tribe;
                    }
                    return 'battle_'.$id;
                }
                
            }elseif($type == 2){
                return 'economy_'.$id;
            }elseif($type == 3){
                if($id == 15){
                    return 'world_'.$id.'_vid'.$session->tribe;
                }else{
                    return 'world_'.$id;
                }
            }
            
        }else{
            switch($id){
                case 1: return 'tutorial_'.$id.'_task_image_vid'.$session->tribe; break;
                case 2: if($isCompleted) { return 'tutorial_'.$id.'_reward_image'; }else{  return 'tutorial_'.$id.'_task_image_vid'.$session->tribe; } break;
                case 14:case 15: if($isCompleted || $session->qData['skipped']) { return 'tutorial_'.$id.'_reward_image_vid'.$session->tribe; }else{  return 'tutorial_'.$id.'_task_image_vid'.$session->tribe; } break;
                default: if($isCompleted) { return 'tutorial_'.$id.'_reward_image'; }else{  return 'tutorial_'.$id.'_task_image'; } break;
            }
        }
    }

    public function questData($id, $type=FALSE){
        global $database, $session, $lang;
        if(!is_numeric($id)){
            if($session->qArrayB1[0] < 10){ $questIdB1 = '0'.$session->qArrayB1[0]; }else{ $questIdB1 = $session->qArrayB1[0];}
            if($session->qArrayB2[0] < 10){ $questIdB2 = '0'.$session->qArrayB2[0]; }else{ $questIdB2 = $session->qArrayB2[0];}
            if($session->qArrayE1[0] < 10){ $questIdE1 = '0'.$session->qArrayE1[0]; }else{ $questIdE1 = $session->qArrayE1[0];}
            if($session->qArrayE2[0] < 10){ $questIdE2 = '0'.$session->qArrayE2[0]; }else{ $questIdE2 = $session->qArrayE2[0];}
            if($session->qArrayW1[0] < 10){ $questIdW1 = '0'.$session->qArrayW1[0]; }else{ $questIdW1 = $session->qArrayW1[0];}
            if($session->qArrayW2[0] < 10){ $questIdW2 = '0'.$session->qArrayW2[0]; }else{ $questIdW2 = $session->qArrayW2[0];}

            $firstBid = $questIdB1 < $questIdB2 ? $questIdB1 : $questIdB2; $SecondBid = $questIdB1 > $questIdB2 ? $questIdB1 : $questIdB2;
            $firstEid = $questIdE1 < $questIdE2 ? $questIdE1 : $questIdE2; $SecondEid = $questIdE1 > $questIdE2 ? $questIdE1 : $questIdE2;
            $firstWid = $questIdW1 < $questIdW2 ? $questIdW1 : $questIdW2; $SecondWid = $questIdW1 > $questIdW2 ? $questIdW1 : $questIdW2;

            $bAll = 0; if($firstBid != 0 && $SecondBid != 0){$bAll++;}
            $eAll = 0; if($firstEid != 0 && $SecondEid != 0){$eAll++;}
            $wAll = 0; if($firstWid != 0 && $SecondWid != 0){$wAll++;}
            $html ='<div id="questTodoListDialog" class="questWrapper questToDoList">
            <h4 class="round">'.$lang['quests']['Battle'].'
                <!--<div class="categoryProgress"> '.(($session->qArrayB1[0] < $session->qArrayB2[0] ? $session->qArrayB1[0] : $session->qArrayB2[0])-1).'/15</div>-->
            </h4>
            <ul>
            '.($bAll == 0 ? 'You have completed battle missions' : ''.($firstBid != 0 ? '<li class="questName" data-questId="Battle_'.($firstBid).'" data-category="battle"><img src="img/x.gif" alt="Reward Pending"><a href="#" class="arrow quest">'.$lang['quests']['monitor']['battle'][($firstBid)].' </a></li>' : '').'
            '.($SecondBid != 0 ? '<li class="questName" data-questId="Battle_'.($SecondBid).'" data-category="battle"><img src="img/x.gif" alt="Reward Pending"><a href="#" class="arrow quest">'.$lang['quests']['monitor']['battle'][($SecondBid)].' </a></li>' : '').'').'
            

            </ul>
            <h4 class="round">'.$lang['quests']['Economy'].'
            </h4>
            <ul>
            '.($eAll == 0 ? 'You have completed economy missions' : ''.($firstEid != 0 ? '<li class="questName" data-questId="Economy_'.($firstEid).'" data-category="economy"><img src="img/x.gif" alt="Reward Pending"><a href="#" class="arrow quest">'.$lang['quests']['monitor']['economy'][($firstEid)].' </a></li>' : '').'
            '.($SecondEid != 0 ? '<li class="questName" data-questId="Economy_'.($SecondEid).'" data-category="economy"><img src="img/x.gif" alt="Reward Pending"><a href="#" class="arrow quest">'.$lang['quests']['monitor']['economy'][($SecondEid)].' </a></li>' : '').'').'
            </ul>
            <h4 class="round">'.$lang['quests']['World'].'
            </h4>
            <ul>
            '.($wAll == 0 ? 'You have completed world missions' : ''.($firstWid != 0 ? '<li class="questName" data-questId="World_'.($firstWid).'" data-category="world"><img src="img/x.gif" alt="Reward Pending"><a href="#" class="arrow quest">'.$lang['quests']['monitor']['world'][($firstWid)].' </a></li>' : '').'
            '.($SecondWid != 0 ? '<li class="questName" data-questId="World_'.($SecondWid).'" data-category="world"><img src="img/x.gif" alt="Reward Pending"><a href="#" class="arrow quest">'.$lang['quests']['monitor']['world'][($SecondWid)].' </a></li>' : '').'').'
            </ul>
            </div>';
                $html .='
                <script type="text/javascript">
                jQuery(function() {
                    Travian.Game.Quest.bindListDelegationDeg(jQuery(\'div#questTodoListDialog li\'));
                });
            </script>';
        }else{
            
            if($id < 10){ $questId = '0'.$id; }else{ $questId = $id;}
                if($type){
                    if($type == 1){ // Battle
                        $langIs = $lang['quests']['battle'];
                    }elseif($type == 2){ // Economy
                        $langIs = $lang['quests']['economy'];
                    }elseif($type == 3){ // World
                        $langIs = $lang['quests']['world'];
                    }

                }else{
                    if($id == 15 && $session->qData['skipped'] == 1){
                        $id = '15a';
                    }
                    $langIs = $lang['quests'];
                }

                $qArrayB1 = explode(',',$session->qData['battle1']);
                $qArrayB2 = explode(',',$session->qData['battle2']);
                $qArrayE1 = explode(',',$session->qData['economy1']);
                $qArrayE2 = explode(',',$session->qData['economy2']);
                $qArrayW1 = explode(',',$session->qData['world1']);
                $qArrayW2 = explode(',',$session->qData['world2']);

                $evenIs = $id % 2;
                if($evenIs == 0){
                    $isEven = TRUE;
                }
                $isEven ? $qID = 2 : $qID = 1;
                if($type == 1){
                    $firstPart = 'qArrayB';
                }elseif($type == 2){
                    $firstPart = 'qArrayE';
                }elseif($type == 3){
                    $firstPart = 'qArrayW';
                }
   
                $html = '
                    <div class="questWrapper">
                        <script type="text/javascript">
                            Travian.Translation.add({\'answers.tutorial_'.$questId.'_title\': "Travian Answers"});
                        </script>
                        <div class="questImage">
                            <img id="questLogo" src="img/x.gif" class="enumerableElementsImage '.$this->getimgClass($questId, $session->qData['isFinished'],$type).'" style="" alt="Hello">';

                        // if quest 2 and step 2 = 1
                        if(!$session->qData['isFinished']  && (${$firstPart . $qID}[1] == 0)){
                            $html .= '
                            '.($type ? '' : '<div class="tipsWrapper">
                            <button type="button" id="questTutorialLightBulb" class="layoutButton bulbActive green questButtonTipsToggle highlighted on" onclick="return false;">
                                <div class="button-container addHoverClick">
                                    <i></i>
                                </div>
                            </button>
                            <script type="text/javascript">
            
                                if ($(\'questTutorialLightBulb\')) {
                                    $(\'questTutorialLightBulb\').addEvent(\'click\', function () {
                                        window.fireEvent(\'buttonClicked\', [this, {
                                            "type": "green",
                                            "onclick": "return false;",
                                            "loadTitle": false,
                                            "boxId": "",
                                            "disabled": false,
                                            "speechBubble": "",
                                            "class": "questButtonTipsToggle",
                                            "id": "questTutorialLightBulb",
                                            "redirectUrl": "",
                                            "redirectUrlExternal": "",
                                            "questButtonTipsToggle":true,
                                            "questButtonActivateTips": "'.$lang['quests']['ActivateTips'].'",
                                            "questButtonDeactivateTips": "'.$lang['quests']['DeactivateTips'].'"
                                        }]);
                                    });
                                }
                            </script>
                            <div class="questTipsToggleDescription">'.$lang['quests']['TipsToggleDescription'].'</div>
                            <div class="clear"></div>
                            </div>').'
                            ';
                            }
                        $html .='</div>';
                        $html .= '<div class="questText">
                            <h2 class="questTitle">'.$langIs[$id]['Title'].'</h2>
                            <div class="questDescription">
                                <div id="questDescription" class="enumerableElementsDescription lala" style="" title="">
                                '.($session->qData['isFinished'] || (${$firstPart . $qID}[1] == 1)  ? $langIs[$id]['completed'] : $langIs[$id]['Description']).'
                                </div><br>';
                            
                            
                            if(!$session->qData['isFinished'] && (${$firstPart . $qID}[1] == 0)){
                                $i=0;
                                foreach($langIs[$id]['toDo'] as $toDo){ $i++; }
                                if($i != 0){
                                $html .= '<h4>'.$lang['quests']['Main']['Quest'].':</h4>
                                        <div class="questTasks">
                                            <ul id="questTodolist">';
                
                                            foreach($langIs[$id]['toDo'] as $toDo){
                                                $x++;
                                                $html .= '<li class="'.($session->qData['step'.$x.''] || $session->qData['isFinished'] ? 'finished' : '').'"><img src="img/x.gif" alt="" title="">'.$toDo.'</li>';
                                            }
                                    
                                            $html .= '</ul>
                                        </div>';
                                }
                            }
                            if($langIs[$id]['reward']){
                                $html .= '<h4 class="questRewardTitle">'.$lang['quests']['Main']['Reward'].':</h4>';
                                $html .= '<div class="questRewards"><div id="rewardDescription" class="enumerableElementsDiscription " style="" title="">'.$langIs[$id]['reward'].'</div></div>';
                            }


                            $html .= '</div>
                        </div>
                        <div class="clear"></div>
                        <div class="questButtons">';
                        if(!$type){
                            if($id == 1 || $session->isFinished || $session->qData['skipped'] == 1){
                                $html .= '<button type="submit" class="green questButtonNext highlighted on" questbuttonnext="1" id="buttonKkfN39DhHoNFH"><div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content">'.($session->qData['skipped'] ? $lang['quests']['getRewards'] : $lang['quests']['Next']).'</div></div></button>
                            <script type="text/javascript" id="buttonKkfN39DhHoNFH_script">
                            window.addEvent(\'domready\', function()
                                {
                                if($(\'buttonKkfN39DhHoNFH\'))
                                {
                                $(\'buttonKkfN39DhHoNFH\').addEvent(\'click\', function ()
                                {
                                    window.fireEvent(\'buttonClicked\', [this, {"class":"green questButtonNext","type":"submit","questButtonNext":true,"questId":"Tutorial_'.$questId.'","id":"buttonKkfN39DhHoNFH"}]);
                                });
                                }
                                });
                            </script>';
                            }
                            if($id == 1){
                                $html .= '<button type="submit" class="green questButtonSkipTutorial" questbuttonskiptutorial="1" id="button72apTvUbEYHGu"><div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content">Skip Tutorial</div></div></button>
                            <script type="text/javascript" id="button72apTvUbEYHGu_script">
                            window.addEvent(\'domready\', function()
                                {
                                if($(\'button72apTvUbEYHGu\'))
                                {
                                $(\'button72apTvUbEYHGu\').addEvent(\'click\', function ()
                                {
                                    window.fireEvent(\'buttonClicked\', [this, {"class":"green questButtonSkipTutorial","type":"submit","questButtonSkipTutorial":true,"id":"button72apTvUbEYHGu"}]);
                                });
                                }
                                });
                            </script>		<div class="clear">';
                                }
                        }else{
                            
                            if($type != 0 && (${$firstPart . $qID}[1])){ // Battle
                                if($type == 1){
                                    $Tut = 'Battle';
                                }elseif($type == 2){
                                    $Tut = 'Economy';
                                }elseif($type == 3){
                                    $Tut = 'World';
                                }
                                    $html .= '<button type="submit" class="green questButtonNext highlighted on" questbuttonnext="1" id="buttonKkfN39DhHoNFH"><div class="button-container addHoverClick">
                                    <div class="button-background">
                                        <div class="buttonStart">
                                            <div class="buttonEnd">
                                                <div class="buttonMiddle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-content">'.$lang['quests']['GetRewards'].'</div></div></button>
                                <script type="text/javascript" id="buttonKkfN39DhHoNFH_script">
                                window.addEvent(\'domready\', function()
                                    {
                                    if($(\'buttonKkfN39DhHoNFH\'))
                                    {
                                    $(\'buttonKkfN39DhHoNFH\').addEvent(\'click\', function ()
                                    {
                                        window.fireEvent(\'buttonClicked\', [this, {"class":"green questButtonNext","type":"submit","questButtonNext":true,"questId":"'.$Tut.'_'.$questId.'","id":"buttonKkfN39DhHoNFH"}]);
                                    });
                                    }
                                    });
                                </script>';

                            }
                            $html .= '<button type="submit" class="green questButtonOverview" questbuttonoverview="1" id="button53065741bafbb"><div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content">'.$lang['quests']['Overview'].'</div></div></button>
                            <script type="text/javascript">window.addEvent(\'domready\', function(){if($(\'button53065741bafbb\')){$(\'button53065741bafbb\').addEvent(\'click\', function (){window.fireEvent(\'buttonClicked\', [this, {"type":"submit","value":"Overview","name":"","id":"button53065741bafbb","class":"green questButtonOverview","title":"","confirm":"","onclick":"","questButtonOverview":true}]);});}});</script>';
    
                        }
                        //<button  type="submit" value="Collect reward." id="button53065741bb21d" class="green questButtonGainReward" questId="Battle_01" questButtonGainReward="1"><div class="button-container addHoverClick"><div class="button-background"><div class="buttonStart"><div class="buttonEnd"><div class="buttonMiddle"></div></div></div></div><div class="button-content">'.QUEST_BTTN_GETREWARD.'</div></div></button><script type="text/javascript">window.addEvent('domready', function(){if($('button53065741bb21d')){$('button53065741bb21d').addEvent('click', function (){window.fireEvent('buttonClicked', [this, {"type":"submit","value":"Collect reward.","name":"","id":"button53065741bb21d","class":"green questButtonGainReward","title":"","confirm":"","onclick":"","questId":"Battle_01","questButtonGainReward":true}]);});}});</script>

                        $html .= '
                        </div>
                        </div>
                                <script type="text/javascript">
                                Travian.Game.Quest.createHighlights();
                                Travian.Game.Quest.toggleHighlights(true);
                                $$(\'.questInformation .iconButton.small.cancel\').addEvent(\'click\', function () {
                                    setTimeout(function () {
                                        Travian.Game.Quest.createHighlights();
                                        Travian.Game.Quest.toggleHighlights(true);
                                    }, 500);
                                });
                            </script>
                        </div>';
            

            
        }
        return $html;
    }

    public function achQuest($id){
        global $lang, $database, $session;
        $acData = $database->queryFetch("SELECT * FROM achiev WHERE uid = ".$session->uid."");
        
        if($id != 10){ $idAdd = '0'.$id; }else{ $idAdd = $id; }
        $html = '<div class="questWrapper achievements">
                <hr class="achievementLine ">
                <div class="questTextHighlight"><strong>0 / 1 '.$lang['quests']['achievements'][$id]['Title'].'</strong>
                </div>
                <hr class="achievementLine ">
                <div class="questImage"><img id="questLogo" src="img/x.gif" class="enumerableElementsImage achievementQuest_'.$idAdd.'" style="">
                </div>
                <div class="questText">
                    <div class="questDescription">
                        <div id="questDescription" class="enumerableElementsDiscription " style="" title="">'.$lang['quests']['achievements'][$id]['Description'].'</div>
                    </div>
                    <div class="questAchievementPoints">
                        <strong>'.$lang['quests']['achievements'][$id]['toDo'].'<br>
                            <br>'.$lang['Daily']['PG'].' + '.$acData['a'.$id].' / 5</strong>
                    </div>
                    <hr class="achievementLine">
                    <div class="questDifficulty">
                        <strong>
                            <div id="questDifficulty" class="enumerableElementsDiscription " style="" title="">
                                '.$lang['Daily']['Difficulty'].': <span class="difficulty moderate">'.$lang['quests']['achievements'][$id]['questIn']['Hard'].'</span>
                                <br>
                                <br>'.$lang['Daily']['Requirement'].' : '.$lang['quests']['achievements'][$id]['questIn']['needReq'].'</div>
                        </strong>
                    </div>
                    <hr class="achievementLine ">
                </div>
                <div class="clear"></div>
                <div class="questButtons">
                    <button type="submit" value="'.$lang['Daily']['Overview'].'" id="button7ap01epurLstn" class="green questButtonOverviewAchievements" questbuttonoverviewachievements="1" onclick="return false;">
                        <div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content">'.$lang['Daily']['Overview'].'</div>
                        </div>
                    </button>
                    <script type="text/javascript">
                        window.addEvent(\'domready\', function () {
                            if ($(\'button7ap01epurLstn\')) {
                                $(\'button7ap01epurLstn\').addEvent(\'click\', function () {
                                    window.fireEvent(\'buttonClicked\', [this, {
                                        "type": "submit",
                                        "value": "'.$lang['Daily']['Overview'].'",
                                        "name": "",
                                        "id": "button7ap01epurLstn",
                                        "class": "green questButtonOverviewAchievements",
                                        "title": "",
                                        "confirm": "",
                                        "onclick": "",
                                        "questButtonOverviewAchievements": true,
                                        "onClick": "return false;"
                                    }]);
                                });
                            }
                        });
                    </script>
                    <div class="clear"></div>
                </div>
            </div>';

        return $html;
    }

    public function dailyReward($type){
        global $database, $session, $ajax, $lang;
        if(is_numeric($type) && $type <= 4){
            $achData = $database->queryFetch('SELECT * FROM achiev WHERE uid = '.$session->uid.'');
            $rArray = explode(',',$achData['reward'.$type.'']);

            switch($type){
                case 1:$reward = rand(1,3).',0';$prizes="<li>".questday5."</li><br><li>".questday6."</li><br><li>".questday7."</li><br>";break;
                case 2:$reward = rand(1,5).',0';$prizes="<li>".questday9."</li><br><li>".questday10."</li><br><li>".questday11."</li><br><li>".questday12."</li><br><li>".questday13."</li><br>";break;
                case 3:$reward = rand(1,3).',0';$prizes="<li>".questday15."</li><br><li>".questday16."</li><br><li>".questday17."</li><br>";break;
                case 4:$reward = rand(1,3).',0';$prizes="<li>".questday19."</li><br><li>".questday20." </li><br><li>".questday21." </li><br>";break;
            }

            
            // First time to open page
            if(!$rArray[0]){ 
                $database->query("UPDATE achiev SET reward$type = '".$reward."' WHERE uid = ".$session->uid."");
            }
            !$rArray[0] ? $rArray[0] = $reward : '';
            $html = '<div class="questWrapper achievements">
                <h2 class="questTitle">'.$lang['Daily']['Congrats01'].'</h2>
                <hr class="achievementLine">
                <div class="questImage"><img id="questLogo" src="img/x.gif" class="enumerableElementsImage AchievementQuestReward_0'.$type.'" style="" alt="'.($type * 25).'">
                </div>
                <div class="questDescription">
                    <div id="questDescription" class="enumerableElementsDiscription " style="" title="">'.$lang['Daily']['Congrats02'].' '.($type * 25).' '.$lang['Daily']['Congrats03'].' '.($type * 25).'<br>
                    '.$lang['Daily']['Congrats04'].'
                        :
                        <br>
                        <br>
                        <ul>
                            '.($prizes).'
                        </ul>
                    </div>
                    <h3 class="questRewardTitle">'.$lang['Daily']['Congrats05'].' '.($type * 25).' '.$lang['Daily']['Congrats06'].':</h3>
                    ';
                    if($type == 3){
                        $whereToGo = $rArray[0]+(($type *5)-1);
                    }elseif($type == 4){
                        $whereToGo = $rArray[0]+(($type *5)-2);
                    }else{
                        $whereToGo = $rArray[0]+($type *4);
                    }
                    $html .= '<li>'.(constant("questday".($whereToGo))).'</li>
                </div>
                <div class="clear"></div>
                <hr class="achievementLine">
                <div class="questButtons">
                    <button type="submit" value="'.$lang['Daily']['Overview'].'" id="buttonGEhpYFPK2brYO" class="green questButtonOverviewAchievements" questbuttonoverviewachievements="1">
                        <div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content">'.$lang['Daily']['Overview'].'</div>
                        </div>
                    </button>
                    <script type="text/javascript">
                        window.addEvent(\'domready\', function () {
                            if ($(\'buttonGEhpYFPK2brYO\')) {
                                $(\'buttonGEhpYFPK2brYO\')
                                    .addEvent(\'click\',
                                    function () {
                                        window.fireEvent(
                                            \'buttonClicked\', [
                                                this, {
                                                    "type": "submit",
                                                    "value": "'.$lang['Daily']['Overview'].'",
                                                    "name": "",
                                                    "id": "buttonGEhpYFPK2brYO",
                                                    "class": "green questButtonOverviewAchievements",
                                                    "title": "",
                                                    "confirm": "",
                                                    "onclick": "",
                                                    "questButtonOverviewAchievements": true
                                                }
                                            ]);
                                    });
                            }
                        });
                    </script>
                    <button type="submit" value="'.$lang['Daily']['CRewards'].'" id="buttondUrnNtIEZBy9H" class="green questButtonGainReward" questid="AchievementQuestReward_01" questbuttongainreward="1">
                        <div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content">'.$lang['Daily']['CRewards'].'</div>
                        </div>
                    </button>
                    <script type="text/javascript">
                        window.addEvent(\'domready\', function () {
                            if ($(\'buttondUrnNtIEZBy9H\')) {
                                $(\'buttondUrnNtIEZBy9H\')
                                    .addEvent(\'click\',
                                    function () {
                                        window.fireEvent(
                                            \'buttonClicked\', [
                                                this, {
                                                    "type": "submit",
                                                    "value": "'.$lang['Daily']['CRewards'].'",
                                                    "name": "",
                                                    "id": "buttondUrnNtIEZBy9H",
                                                    "class": "green questButtonGainReward",
                                                    "title": "",
                                                    "confirm": "",
                                                    "onclick": "",
                                                    "questId": "AchievementQuestReward_0'.$type.'",
                                                    "questButtonGainReward": true
                                                }
                                            ]);
                                    });
                            }
                        });
                    </script>
                    <div class="clear"></div>
                </div>
            </div>';

            return $ajax->dialog($html);
        }
    }
}

$quest = new Quest;