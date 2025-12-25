<?php
Class Hero{
    function heroData($d){
        global $database, $session;

        $hData = $database->queryFetch('SELECT * FROM hero WHERE uid = '.$session->uid.'');
        return $hData[$d];
    }

    function getHeroStatus(){
        global $database, $session;
        // 9 => on the way
        // 100 => Home
        // 101 => dead
        // 102 => caged
        // 103 => enforcement

        // need to edit code to check if hero is already in one of the players villages, give 100
        $hData = $database->queryFetch('SELECT * FROM hero WHERE uid = '.$session->uid.'');
        if($hData['dead'] == 1){
            $status = 101;
        }else{
            //print_r($database->getVillID2($session->uid));
            $unitN = $database->queryFetch('SELECT u11 FROM units WHERE `vref` = '.$hData['wref'].'');
            if($unitN['u11'] == 0){ // Not in the village (enforcement or caged) or in adventure
                $mNumber = $database->queryNumRow('SELECT `sort_type` FROM `movement` WHERE sort_type = 9 AND `from` = '.$hData['wref'].' AND endtime > '.time().'');
                if($mNumber != 0){
                    $status = 9;
                }
                
                $enf = $database->queryFetch('SELECT `u11` FROM `enforcement` WHERE `from` ='.$hData['wref'].'');
                if($enf['u11'] != 0){
                    $status = 103;
                }
            }else{
                $status =  100;
            }
        }
        if(!$status){
            $status = 9;
        }
        return $status;
    }

    function printHeroSt(){
        global $database, $session, $generator, $lang;
        switch($this->getHeroStatus()){
            case 9:
                // make a query to check if going to adv to block it's view when the hero is returning to the village
                // also to get the movement data to get x,y
                $mData = $database->queryFetch('SELECT `sort_type`,`to`,`endtime` FROM `movement` WHERE sort_type = 9 AND `from` = '.$this->heroData('wref').' AND endtime > '.time().'');
                if($mData['sort_type']){ // 
                    $advCoors = $database->getCoor($mData['to']);
                    $reqTime = $mData['endtime'] - time();

                    return '<img alt="Held tot!" src="img/x.gif" class="heroStatus50">
                    '.$lang['Hero']['status01'].' <a class="" href="karte.php?x='.$advCoors['x'].'&amp;y='.$advCoors['y'].'">&lrm;&#8237;<span class="coordinates coordinatesWrapper"><span class="coordinateX">('.$advCoors['x'].'&#8236;&#8236;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#8237;'.$advCoors['y'].'&#8236;&#8236;)</span></span>&#8236;&lrm;</a>. '.$lang['Hero']['OW01'].' <span class="timer" counting="down" value="'.$reqTime.'">'.$generator->getTimeFormat($reqTime).'</span> '.$lang['Hero']['OW02'].' '.date('H:s', $mData['endtime']).'.<div class="subMessage"> ('.$lang['Hero']['OW03'].' <a href="build.php?gid=16&amp;tt=1&amp;newdid=26019">'.$lang['Hero']['OW04'].'</a>.) </div>';    
                }else{
                    return '<img alt="Held tot!" src="img/x.gif" class="heroStatus9">
				    '.$lang['Hero']['status02'].'.';

                }
            break;
            
            case 101: // dead
                return '<img alt="Held tot!" src="img/x.gif" class="heroStatus101">
				'.$lang['Hero']['status03'].'';
            break;
            case 103:
                // make a query to check the enforcement data to get vid
                $enf = $database->queryFetch('SELECT `u11`,`vref` FROM `enforcement` WHERE `from` ='.$this->heroData('wref').'');
                $eVCoors = $database->getCoor($enf['vref']);
                $vData = $database->getUserVillInfoByVillageID($enf['vref']);

                return '<img alt="Held tot!" src="img/x.gif" class="heroStatus103">
				'.$lang['Hero']['status04'].' <a href="karte.php?d='.$enf['vref'].'">'.$vData['name'].'</a>.';
            break;

            case 100:
                $vData = $database->getUserVillInfoByVillageID($this->heroData('wref'));
                return '<img alt="Held tot!" src="img/x.gif" class="heroStatus100">
				'.$lang['Hero']['status05'].' <a href="karte.php?d='.$this->heroData('wref').'">'.$vData['name'].'</a>.';
            break;
        }

    }

    function heroHash(){
        global $session;
        $herodetail = $session->heroD;
        $geteye = $herodetail['eye'];
        $geteyebrow = $herodetail['eyebrow'];
        $getnose = $herodetail['nose'];
        $getear = $herodetail['ear'];
        $getmouth = $herodetail['mouth'];
        $getbeard = $herodetail['beard'];
        $gethair = $herodetail['hair'];
        $getface = $herodetail['face'];
		$gender = $herodetail['gender']; if ($gender==0) {$gdir='male';} else {$gdir='female';}
		
		//@mkdir('hcache/'.$size.'/'); //
        return $geteye.$geteyebrow.$getnose.$getear.$getmouth.$getbeard.$gethair.$getface.$gender.$herodetail['color'];

    }

    function heroFace(){
        global $session;
        header('Pragma: public');
        header('Cache-Control: max-age=86400');
        header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + 86400));
        header('Content-Type: image/png');
        
        $size =  '64x82';
        $herodetail = $session->heroD;
        if($herodetail['color']==0){$color = "black";}
        if($herodetail['color']==1){$color = "brown";}
        if($herodetail['color']==2){$color = "darkbrown";}
        if($herodetail['color']==3){$color = "yellow";}
        if($herodetail['color']==4){$color = "red";}

        $geteye = $herodetail['eye'];
        $geteyebrow = $herodetail['eyebrow'];
        $getnose = $herodetail['nose'];
        $getear = $herodetail['ear'];
        $getmouth = $herodetail['mouth'];
        $getbeard = $herodetail['beard'];
        $gethair = $herodetail['hair'];
        $getface = $herodetail['face'];
		$gender = $herodetail['gender']; if ($gender==0) {$gdir='male';} else {$gdir='female';}
		
		//@mkdir('hcache/'.$size.'/'); //
        $herohash=$geteye.$geteyebrow.$getnose.$getear.$getmouth.$getbeard.$gethair.$getface.$gender.$herodetail['color'];
        //$herofd='hcache/'.$size.'/'.$herohash.'.png';
        //if(!file_exists($herofd)){
            $body = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/face0.png');
            if($getbeard!=5 && $gender==0){
                $beard = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/beard/beard'.$getbeard.'-'.$color.'.png');
            }
            $eye = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/eye/eye'.$geteye.'.png');
            $eyebrow = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/eyebrow/eyebrow'.$geteyebrow.(($gender==0)?'-'.$color:'').'.png');
            $hair = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/hair/hair'.$gethair.'-'.$color.'.png');
            $ear = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/ear/ear'.$getear.'.png');
            $mouth = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/mouth/mouth'.$getmouth.'.png');
            $nose = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/nose/nose'.$getnose.'.png');
            $face = imagecreatefrompng('img/hero/'.$gdir.'/head/'.$size.'/face/face'.$getface.'.png');
            imagecopy($body, $face, 0, 0, 0, 0, imagesx($face), imagesy($face));
            imagecopy($body, $ear, 0, 0, 0, 0, imagesx($ear), imagesy($ear));
            imagecopy($body, $eye, 0, 0, 0, 0, imagesx($eye), imagesy($eye));
            imagecopy($body, $eyebrow, 0, 0, 0, 0, imagesx($eyebrow), imagesy($eyebrow));
            imagecopy($body, $hair, 0, 0, 0, 0, imagesx($hair), imagesy($hair));
            imagecopy($body, $mouth, 0, 0, 0, 0, imagesx($mouth), imagesy($mouth));
            imagecopy($body, $nose, 0, 0, 0, 0, imagesx($nose), imagesy($nose));
            if($getbeard!=5 && $gender==0){
                imagecopy($body, $beard, 0, 0, 0, 0, imagesx($beard), imagesy($beard));
            }
            imagesavealpha($body, true);
            imagepng($body, $herofd);
            imagedestroy($body);
        //}
        return $herofd;
    }
}

$heroF = new Hero;
