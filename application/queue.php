<?php
define("oMonsters", 86400);

if(file_exists(APP_BASE_PATH."/queue.txt")){
$curr_time = time();
if ($curr_time - @filemtime(APP_BASE_PATH."/queue.txt") >= 1) {
    @unlink(APP_BASE_PATH."/queue.txt");
    
    if($curr_time > OPENING){
        // iRedux - Better system
        $lastMedals = $database->config()['lastmedal'];
        if(time() - $lastMedals > MEDALS){
            $database->query("UPDATE config SET lastmedal = ".time()."");
            $medals->dMedals();
        }
    }
    
    $ourFileHandle = fopen(APP_BASE_PATH."/queue.txt", 'w');
    @fclose($ourFileHandle);
    include 'Attacks.php';

    class cron extends Att
    {


        function __construct()
        {
            global $database, $global;
            $t = time();

            $database->query("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
            $database->starttransaction();
            $sql = $database->query("SELECT id,if1,jobID,type FROM queue WHERE finish <= '" . $t . "' and status ='0' ORDER BY finish ASC,id ASC FOR UPDATE");
            //$database->query("UPDATE queue set `status` ='1' WHERE finish <= '" . $t . "'");

            if (!empty($sql)) {
                $this->queue($sql);
            }
            $database->commitq();
            $this->Builder();
            $this->TradeRoute();
            $this->MasterBuilder();
            $this->updateProtect();
            if(time() - $database->config()['lastioasisUpdate'] > oMonsters){ $this->updateOases(); }
            if(time() - $database->config()['lastAchiev'] > 86400){ 
                $database->RestartAchiev();
                $database->query("UPDATE config SET lastAchiev = ".time()."");
             }
            $this->autoRenew();
            

            if(ARTEFACTS<= time() && !file_exists(APP_MAIN_PATH."/artefacts.txt")) {
                $ourFileHandle = fopen(APP_MAIN_PATH."/artefacts.txt", 'w') or die("Unable to open file!");
                fclose($ourFileHandle);
                $this->showArts();
                $global->updateGlobal('Arts');

            }
            
            if(WW_PLAN<= time()  && !file_exists(APP_MAIN_PATH."/ww_plans.txt")) {
                $ourFileHandle = fopen(APP_MAIN_PATH."/ww_plans.txt", 'w') or die("Unable to open file!");
                fclose($ourFileHandle);
                $this->showWWPlans();
                $global->updateGlobal('WW');
            }        
        }

        function showWWPlans(){
            global $database;
            $amt = 13;
            $speed = round(SPEED/100);
            for($i=1;$i<=$amt;$i++) {
                $kid += 1;
                if($kid>4){
                 $kid=1;}
                $wid = $database->generateBase($kid);
                $database->setFieldTaken($wid);
                $time = time();
                $coo=$database->getWInfo($wid);
                $q = "INSERT  into vdata (`wref`,`owner`,`name`,`capital`,`pop`,`cp`,`celebration`,`type`,`wood`,`clay`,`iron`,`maxstore`,`crop`,`maxcrop`,`lastupdate`,`loyalty`,`exp1`,`exp2`,`exp3`,`created`,`vx`,`vy`,`vtype`) values ('$wid','3','plan Building',0,230,0,0,0,80000.00,80000.00,80000.00,80000,80000.00,80000,1314974534,100,0,0,0,1314968914,".$coo['x'].",".$coo['y'].",".$coo['fieldtype'].")";
                $database->query($q);
                $q = "INSERT  into fdata (`vref`,`f1`,`f1t`,`f2`,`f2t`,`f3`,`f3t`,`f4`,`f4t`,`f5`,`f5t`,`f6`,`f6t`,`f7`,`f7t`,`f8`,`f8t`,`f9`,`f9t`,`f10`,`f10t`,`f11`,`f11t`,`f12`,`f12t`,`f13`,`f13t`,`f14`,`f14t`,`f15`,`f15t`,`f16`,`f16t`,`f17`,`f17t`,`f18`,`f18t`,`f19`,`f19t`,`f20`,`f20t`,`f21`,`f21t`,`f22`,`f22t`,`f23`,`f23t`,`f24`,`f24t`,`f25`,`f25t`,`f26`,`f26t`,`f27`,`f27t`,`f28`,`f28t`,`f29`,`f29t`,`f30`,`f30t`,`f31`,`f31t`,`f32`,`f32t`,`f33`,`f33t`,`f34`,`f34t`,`f35`,`f35t`,`f36`,`f36t`,`f37`,`f37t`,`f38`,`f38t`,`f39`,`f39t`,`f40`,`f40t`,`f99`,`f99t`,`wwname`) values ($wid,0,1,0,4,0,1,0,3,0,2,0,2,0,3,0,4,0,4,0,3,0,3,0,4,0,4,0,1,0,4,0,2,0,1,0,2,20,17,20,11,10,27,20,10,10,22,10,25,0,0,20,15,10,19,0,0,0,0,0,0,10,23,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,16,0,0,0,0,'Miracle uncle')";
                $database->query($q);
                $database->addUnits($wid);
                $database->addTech($wid);
                $database->addABTech($wid);
                $database->query("UPDATE units SET u1 = " . (rand(2000, 4000) * $speed) . ", u2 = " . (rand(3000, 4000) * $speed) . ", u3 = " . (rand(4600, 5600) * $speed) . ", u4 = " . (rand(50, 150) * $speed) . ", u5 = " . (rand(2400, 3800) * $speed) . ", u6 = " . (rand(3000, 4000) * $speed) . ", u7 = " . (rand(1000, 1800) * $speed) . ", u8 = " . (rand(200, 600) * $speed) . " , u9 = " . (rand(2, 10) * $speed) . ", u10 = " . (rand(2, 10) * $speed) . " WHERE vref = " . $wid . "");
                $database->addArtefact($wid, 3, 11, 1);
            }
        }

        // Show arts
        function showArts(){
            for ($kid = 1; $kid <=4; $kid++) {
                if ($kid == 1) {$this->Artefact($uid, 1, 3, 'A rare architectural masterpiece', $kid);}
                if ($kid == 2) {$this->Artefact($uid, 2, 3, 'A rare speed masterpiece', $kid);}
                if ($kid == 3) {$this->Artefact($uid, 3, 3, 'A rare explorer masterpiece', $kid);}
                if ($kid == 4) {$this->Artefact($uid, 5, 3, 'A rare building masterpiece', $kid);}
                $this->Artefact($uid, 1, 1, 'A masterpiece of a small architect', $kid);
                $this->Artefact($uid, 1, 2, 'Masterpiece of a great architect', $kid);
        
                /**
                 * MILITARY HASTE
                 */
                 $this->Artefact($uid, 2, 1, 'a small speed masterpiece', $kid);
                $this->Artefact($uid, 2, 2, 'a speed masterpiece', $kid);
        
                /**
                 * HAWK'S EYESIGHT
                 */
                $this->Artefact($uid, 3, 1, 'a small explorer masterpiece', $kid);
                $this->Artefact($uid, 3, 2, 'A great explorer masterpiece', $kid);
                $this->Artefact($uid, 5, 1, 'A small building masterpiece', $kid);
                $this->Artefact($uid, 5, 2, 'A masterpiece building', $kid);

                /**
                 * STORAGE MASTER PLAN
                 */
                 $this->Artefact($uid, 6, 1, 'a small storage masterpiece', $kid);
                $this->Artefact($uid, 6, 2, 'a great storage masterpiece', $kid);
        
            }
        }

        function Artefact($uid, $type, $size, $village_name, $kid)
        {
            global $database;
            $uid = 3;
            $speed = round(SPEED/100);
            $wid = $database->generateBase2($kid);
            $database->addArtefact($wid, $uid, $type, $size);
            $database->setFieldTaken($wid);
            $database->addVillage($wid, $uid, $village_name, '0', 163);
            $database->addResourceFields($wid, $database->getVillageType($wid));
            $database->addUnits($wid);
            $database->addTech($wid);
            $database->addABTech($wid);
            $database->setVillageField($wid, "name", $village_name);
            $speed = round(SPEED/100);
            if ($size == 1) {
                $database->query("UPDATE units SET u1 = " . (rand(1000, 2000) * $speed) . ", u2 = " . (rand(1500, 2000) * $speed) . ", u3 = " . (rand(2300, 2800) * $speed) . ", u4 = " . (rand(25, 75) * $speed) . ", u5 = " . (rand(1200, 1900) * $speed) . ", u6 = " . (rand(1500, 2000) * $speed) . ", u7 = " . (rand(500, 900) * $speed) . ", u8 = " . (rand(100, 300) * $speed) . " , u9 = " . (rand(1, 5) * $speed) . ", u10 = " . (rand(1, 5) * $speed) . " WHERE vref = " . $wid . "");
                $database->query("UPDATE fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 10, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
            } elseif ($size == 2) {
                $database->query("UPDATE units SET u1 = " . (rand(2000, 4000) * $speed) . ", u2 = " . (rand(3000, 4000) * $speed) . ", u3 = " . (rand(4600, 5600) * $speed) . ", u4 = " . (rand(50, 150) * $speed) . ", u5 = " . (rand(2400, 3800) * $speed) . ", u6 = " . (rand(3000, 4000) * $speed) . ", u7 = " . (rand(1000, 1800) * $speed) . ", u8 = " . (rand(200, 600) * $speed) . " , u9 = " . (rand(2, 10) * $speed) . ", u10 = " . (rand(2, 10) * $speed) . " WHERE vref = " . $wid . "");
                $database->query("UPDATE fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 20, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
            } elseif ($size == 3) {
                $database->query("UPDATE units SET u1 = " . (rand(4000, 8000) * $speed) . ", u2 = " . (rand(6000, 8000) * $speed) . ", u3 = " . (rand(9200, 11200) * $speed) . ", u4 = " . (rand(100, 300) * $speed) . ", u5 = " . (rand(4800, 7600) * $speed) . ", u6 = " . (rand(6000, 8000) * $speed) . ", u7 = " . (rand(2000, 3600) * $speed) . ", u8 = " . (rand(400, 1200) * $speed) . " , u9 = " . (rand(4, 20) * $speed) . ", u10 = " . (rand(4, 20) * $speed) . " WHERE vref = " . $wid . "");
                $database->query("UPDATE fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 20, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
            }
        }

        
        function autoRenew(){
            global $database, $config;

            $users = $database->query("SELECT * FROM users");
            foreach($users as $user){
                $qq = $database->query("SELECT * FROM autorenewals WHERE userid = ".$user['id']."");
                $xx = 0;
                foreach($qq as $qdata){ $xx++; }
                if($xx == 0){ $database->query("INSERT INTO autorenewals VALUES(NULL,".$user['id'].",0,0,0,0,0)"); }
            }

            $q = $database->query("SELECT * FROM autorenewals");
            foreach($q as $autoData){
                $userData = $database->queryFetch("SELECT * FROM users WHERE id = ".$autoData['userid']."");
                if($autoData['plus']){
                    if(time() >= $userData['plus']){
                        if($userData['gold'] >= $config['Plus']){
                            $database->modifyGold($userData['id'], $config['Plus'], 0);
                            $database->query("UPDATE users SET plus = plus + ".PLUS_TIME." WHERE id = ".$userData['id']."");
                        }else{
                            $database->query("UPDATE autorenewals SET plus = 0 WHERE userid =".$userData['id']."");
                        }
                    }
                }

                if($autoData['productionboostWood']){
                    if(time() >= $userData['b1']){
                        if($userData['gold'] >= $config['addonProduction']){
                            $database->modifyGold($userData['id'], $config['addonProduction'], 0);
                            $database->query("UPDATE users SET b1 = b1 + ".PLUS_PRODUCTION." WHERE id = ".$userData['id']."");
                        }else{
                            $database->query("UPDATE autorenewals SET productionboostWood = 0 WHERE userid =".$userData['id']."");
                        }
                    }
                }
                
                if($autoData['productionboostClay']){
                    if(time() >= $userData['b2']){
                        if($userData['gold'] >= $config['addonProduction']){
                            $database->modifyGold($userData['id'], $config['addonProduction'], 0);
                            $database->query("UPDATE users SET b2 = b2 + ".PLUS_PRODUCTION." WHERE id = ".$userData['id']."");
                        }else{
                            $database->query("UPDATE autorenewals SET productionboostClay = 0 WHERE userid =".$userData['id']."");
                        }
                    }
                }
                
                if($autoData['productionboostIron']){
                    if(time() >= $userData['b3']){
                        if($userData['gold'] >= $config['addonProduction']){
                            $database->modifyGold($userData['id'], $config['addonProduction'], 0);
                            $database->query("UPDATE users SET b3 = b3 + ".PLUS_PRODUCTION." WHERE id = ".$userData['id']."");
                        }else{
                            $database->query("UPDATE autorenewals SET productionboostIron = 0 WHERE userid =".$userData['id']."");
                        }
                    }
                }
                
                if($autoData['productionboostCrop']){
                    if(time() >= $userData['b4']){
                        if($userData['gold'] >= $config['addonProduction']){
                            $database->modifyGold($userData['id'], $config['addonProduction'], 0);
                            $database->query("UPDATE users SET b4 = b4 + ".PLUS_PRODUCTION." WHERE id = ".$userData['id']."");
                        }else{
                            $database->query("UPDATE autorenewals SET productionboostCrop = 0 WHERE userid =".$userData['id']."");
                        }
                    }
                }
                
            }
        }

        // Update Oasis - iRedux
        function updateOases(){
            global $database;
            $database->query("UPDATE config SET lastioasisUpdate = ".time()."");

            // Update Resources and troops
            $oases = $database->query("SELECT * FROM odata WHERE conqured = 0");
            foreach($oases as $oasis){
                // maxOasisRes
                if($oasis['wood'] < maxOasisRes){ $database->query("UPDATE odata SET wood = wood + ".maxOasisRes." WHERE wref =  ".$oasis['wref'].""); }
                if($oasis['clay'] < maxOasisRes){ $database->query("UPDATE odata SET clay = clay + ".maxOasisRes." WHERE wref =  ".$oasis['wref'].""); }
                if($oasis['iron'] < maxOasisRes){ $database->query("UPDATE odata SET iron = iron + ".maxOasisRes." WHERE wref =  ".$oasis['wref'].""); }
                if($oasis['crop'] < maxOasisRes){ $database->query("UPDATE odata SET crop = crop + ".maxOasisRes." WHERE wref =  ".$oasis['wref'].""); }

                $oasisData = $database->query("SELECT * FROM wdata WHERE id = ".$oasis['wref']."");
                if($oasisData[0]['oasistype']){
                    // 25% - 50% lumbar
                    if($oasisData[0]['oasistype'] == 1 || $oasisData[0]['oasistype'] == 2){
                        $database->query("UPDATE units 
                        SET
                        u5 = u5 + ".(FLOOR(5 + RAND(1,5) * 1)).", 
                        u6 = u6 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u7 = u7 + ".(FLOOR(0 + RAND(1,5) * 1))." WHERE vref=".$oasis['wref']." AND u5 < 100");
                    }

                    // +25% lumber and +25% crop oasis
                    if($oasisData[0]['oasistype'] == 3){
                        $database->query("UPDATE units 
                        SET
                        u5 = u5 + ".(FLOOR(5 + RAND(1,5) * 1)).", 
                        u6 = u6 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u7 = u7 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u8 = u8 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u10 = u10 + ".(FLOOR(0 + RAND(1,5) * 1))." WHERE vref=".$oasis['wref']." AND u5 < 100");
                    }

                    // +25% - 50% clay oasis
                    if($oasisData[0]['oasistype'] == 4 || $oasisData[0]['oasistype'] == 5){
                        $database->query("UPDATE units 
                        SET
                        u1 = u1 + ".(FLOOR(5 + RAND(1,5) * 1)).", 
                        u2 = u2 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u5 = u5 + ".(FLOOR(0 + RAND(1,5) * 1))." WHERE vref=".$oasis['wref']." AND u1 < 100");
                    }


                    // +25% clay and +25% crop oasis
                    if($oasisData[0]['oasistype'] == 6){
                        $database->query("UPDATE units 
                        SET
                        u1 = u1 + ".(FLOOR(5 + RAND(1,5) * 1)).", 
                        u2 = u2 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u5 = u5 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u10 = u10 + ".(FLOOR(0 + RAND(1,5) * 1))." WHERE vref=".$oasis['wref']." AND u1 < 100");
                    }

                    // +25% - 50% iron oasis
                    if($oasisData[0]['oasistype'] == 7 || $oasisData[0]['oasistype'] == 8){
                        $database->query("UPDATE units 
                        SET
                        u1 = u1 + ".(FLOOR(5 + RAND(1,5) * 1)).", 
                        u2 = u2 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u4 = u4 + ".(FLOOR(0 + RAND(1,5) * 1))." WHERE vref=".$oasis['wref']." AND u1 < 100");
                    }

                    // +25% iron and +25% crop oasis
                    if($oasisData[0]['oasistype'] == 9){
                        $database->query("UPDATE units 
                        SET
                        u1 = u1 + ".(FLOOR(5 + RAND(1,5) * 1)).", 
                        u2 = u2 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u4 = u4 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u9 = u9 + ".(FLOOR(0 + RAND(1,5) * 1))." WHERE vref=".$oasis['wref']." AND u1 < 100");
                    }

                    // +25% crop oasis
                    if($oasisData[0]['oasistype'] == 10 || $oasisData[0]['oasistype'] == 11){
                        $database->query("UPDATE units 
                        SET
                        u1 = u1 + ".(FLOOR(5 + RAND(1,5) * 1)).", 
                        u3 = u3 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u7 = u7 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u8 = u8 + ".(FLOOR(0 + RAND(1,5) * 1)).",
                        u9 = u9 + ".(FLOOR(0 + RAND(1,5) * 1))." WHERE vref=".$oasis['wref']." AND u1 < 100");
                    }

                    // +50% crop oasis
                    if($oasisData[0]['oasistype'] == 12){
                        $database->query("UPDATE units 
                        SET
                        u1 = u1 + ".(FLOOR(5 + RAND(1,5) * 2)).", 
                        u3 = u3 + ".(FLOOR(0 + RAND(1,5) * 2)).",
                        u7 = u7 + ".(FLOOR(0 + RAND(1,5) * 2)).",
                        u8 = u8 + ".(FLOOR(0 + RAND(1,5) * 2)).",
                        u9 = u9 + ".(FLOOR(0 + RAND(1,5) * 2)).",
                        u10 = u10 + ".(FLOOR(0 + RAND(1,5) * 2))." WHERE vref=".$oasis['wref']." AND u1 < 100");
                    }
                }
            }
        }
        
        function updateProtect(){
            global $database;
            $q = $database->query("SELECT * FROM users WHERE protect != 0");
            foreach($q as $user){
                //if(time() - $user['ptime'] > PROTECTION){ // Edited by iRedux
                if(time() > $user['ptime']){ // Edited by iRedux
                    $database->query("UPDATE users SET protect  = 0 WHERE id = ".$user['id']."");
                }
            }
        }

        function DelTrash($id,$type){
            global $database;
            $database->query("DELETE FROM `queue` WHERE `jobID`='" . $id."' and `type`='".$type."'");
        }

        function queue($s)
        {
            global $database, $session;


            foreach ($s as $f) {
                switch ($f['type']) {
                    case 1: //атака
                        if($this->attCom($f['jobID'])){
                        }else{
                            $database->query("INSERT INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','атака','" . $f['id']."','".$f['jobID']."')");
                        }
                        break;
                    case 2: //inозinрат
                        if($this->returnCom($f['jobID'])){
                            $database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
                        }else{
                            $database->query("INSERT INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','inозinрат','" . $f['id']."','".$f['jobID']."')");
                        }
                        break;
                    case 3: //подкреп

                        if($this->reiCom($f['jobID'])){
                            $database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
                        }else{
                            $database->query("INSERT INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','подкреп','" . $f['id']."','".$f['jobID']."')");
                        }
                        break;
                    case 4: //   поселы

                        if($this->settCom($f['jobID'])){
                            $database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
                        }else{
                            $database->query("INSERT INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','поселы','" . $f['id']."','".$f['jobID']."')");
                        }
                        break;

                    case 6: //   изучение
                        if($this->researchComplete($f['jobID'])){
                        $database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
                    }else{
                            $database->query("INSERT INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','изучение','" . $f['id']."','".$f['jobID']."')");
                        }
                        break;
                    case 7: //   рынок отпраinка
                        if($this->marketComplete($f['jobID'])){
                        $database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
                    }else{
                            $database->query("INSERT INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','рынок х1','" . $f['id']."','".$f['jobID']."')");
                        }
                        break;
                    case 8: //   рынок inозinрат и х2/х3 транспорт
                        if($this->Market2($f['jobID'])){
                        $database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
                    }else{
                            $database->query("INSERT INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','рынок х2/3','" . $f['id']."','".$f['jobID']."')");
                        }
                        break;
                    case 9: //   снос здания
                        if($this->demolitionComplete($f['jobID'])){
                        $database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
                    }else{
                            $database->query("INSERT INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','снос здания','" . $f['id']."','".$f['jobID']."')");
                        }
                        break;
                    case 10: //   удаление аккаунта
                        if($this->clearDeleting($f['if1'])){
                        $database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
                    }else{
                            $database->query("INSERT INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','удаление аккаунта','" . $f['id']."','".$f['jobID']."')");
                        }
                        break;
                    case 11: //   ожиinление герыча
                        if($this->reviveHero($f['jobID'], $f['if1'])){
                        $database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
                    }else{
                            $database->query("INSERT INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','ожиinление героя','" . $f['id']."','".$f['jobID']."')");
                        }
                        break;
                    case 13:

                        if($this->sendAdventuresComplete($f['jobID'])){
                        $database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
                    }else{
                            $database->query("INSERT INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','приключения','" . $f['id']."','".$f['jobID']."')");
                        }
                        break;
                }

            }

        }


    }

    new cron ();

}
}else{
    //
    $ourFileHandle = fopen(APP_BASE_PATH."/queue.txt", 'w')  or die("Unable to create queue file!");
    fclose($ourFileHandle);
}