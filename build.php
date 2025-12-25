<?php
if(isset($_GET['id']) && !is_numeric($_GET['id'])) die('Hacking Attemp');
if(isset($_GET['gid']) && !is_numeric($_GET['gid'])) die('Hacking Attemp');
if(isset($_GET['t']) && !is_numeric($_GET['t'])) die('Hacking Attemp');
if(isset($_GET['s']) && !is_numeric($_GET['s'])) die('Hacking Attemp');
if(isset($_GET['moveid']) && !is_numeric($_GET['moveid'])) die('Hacking Attemp');
if(isset($_POST['did']) && !is_numeric($_POST['did'])) die('Hacking Attemp');
if(isset($_GET['eid']) && !is_numeric($_GET['eid'])) die('Hacking Attemp');
if(isset($_POST['eid']) && !is_numeric($_POST['eid'])) die('Hacking Attemp');
if(isset($_GET['routeid']) && !is_numeric($_GET['routeid'])) die('Hacking Attemp');
if(isset($_POST['start']) && !is_numeric($_POST['start'])) die('Hacking Attemp');
if(isset($_POST['deliveries']) && !is_numeric($_POST['deliveries'])) die('Hacking Attemp');
if(isset($_GET['type']) && !is_numeric($_GET['type'])) die('Hacking Attemp');
if(isset($_GET['delprisoners']) && !is_numeric($_GET['delprisoners'])) die('Hacking Attemp');
for($i=1;$i<=4;$i++){
    if(isset($_POST['r1'])){
    if($_POST['r'.$i] == ""){
        $_POST['r'.$i] = 0;
    }
    }
}
if(isset($_POST['r1']) && !is_numeric($_POST['r1'])) die('Hacking Attemp');
if(isset($_POST['r2']) && !is_numeric($_POST['r2'])) die('Hacking Attemp');
if(isset($_POST['r3']) && !is_numeric($_POST['r3'])) die('Hacking Attemp');
if(isset($_POST['r4']) && !is_numeric($_POST['r4'])) die('Hacking Attemp');
for($i=1;$i<=10;$i++){
    if(isset($_POST['t'.$i]) && !empty($_POST['t'.$i]) && !is_numeric($_POST['t'.$i])){
        //die('Hacking Attemp');
    }
}
if(isset($_POST['lid']) && !is_numeric($_POST['lid'])) die('Hacking Attemp');
if(isset($_POST['y']) && !empty($_POST['y']) && !is_numeric($_POST['y'])) die('Hacking Attemp');
if(isset($_POST['x']) && !empty($_POST['x']) && !is_numeric($_POST['x'])) die('Hacking Attemp');

include_once "application/Account.php";
include_once "application/Units.php";
include("application/Manual.php");

if($_GET['id'] == 39 && $_GET['t'] == 2){

    if(isset($_GET['z']) && !is_numeric($_GET['z'])) die('Hacking Attemp');
    if(isset($_GET['w']) && !is_numeric($_GET['w'])) die('Hacking Attemp');
    if(isset($_GET['r']) && !is_numeric($_GET['r'])) die('Hacking Attemp');
    if(isset($_GET['o']) && !is_numeric($_GET['o'])) die('Hacking Attemp');
    if(isset($_GET['id']) && !is_numeric($_GET['id'])) die('Hacking Attemp');
    $id=0;
    if(isset($_GET['id'])) {
        $id = $database->FilterIntValue($_GET['id']);
    }
    
    
    if(isset($_GET['id'])) {
        $id = $database->FilterIntValue($_GET['id']);
    
    }
    if(isset($_GET['w'])) {
        $w = $database->FilterIntValue($_GET['w']);
    }
    if(isset($_GET['r'])) {
        $r = $database->FilterIntValue($_GET['r']);
    }
    
    $checked=$disabledr=$disabled=$disableN="";
    if($session->sit == 1){
        $disabled ="disabled=disabled";
    }
    if(!$session->right['s1']){
        $disableN="disabled='disabled'";
    }
    if(!$session->right['s2']){
        $disabler="disabled='disabled'";
    }
    if(isset($_GET['z'])) {
        $z=$database->FilterIntValue($_GET['z']);
    
        if($database->isVillageOases($z)){
    
            $oasi=$database->checkviloas2($z);
    if($oasi['owner'] == 2){$disabledr ="disabled=disabled"; $disabled ="disabled=disabled"; $checked="checked=checked";}
    
    
    }
    }
    
        $process = $units->procUnits($_POST);
    
}else{
if(isset($_GET['delprisoners'])){
$prisoner = $database->getPrisonersByID($_GET['delprisoners']);
if($prisoner['wref'] == $village->wid){
    $p_owner = $database->getVillageField($prisoner['from'],"owner");
    $p_eigen = $database->getCoor($prisoner['wref']);
    $p_from = array('x'=>$p_eigen['x'], 'y'=>$p_eigen['y']);
    $p_ander = $database->getCoor($prisoner['from']);
    $p_to = array('x'=>$p_ander['x'], 'y'=>$p_ander['y']);
    $p_tribe = $database->getUserField($p_owner,"tribe",0);

    $p_speeds = array();

    //find slowest unit.
    for($i=1;$i<=10;$i++){
        if ($prisoner['t'.$i]){
            if($prisoner['t'.$i] != '' && $prisoner['t'.$i] > 0){
                $p_unitarray = $GLOBALS["u".(($p_tribe-1)*10+$i)];
                $p_speeds[] = $p_unitarray['speed'];
            }
        }
    }

    if ($prisoner['t11']>0){
        $p_qh = "SELECT * FROM hero WHERE uid = ".$p_owner."";
        $p_resulth = $database->query($p_qh);
        $p_speeds[] = $p_resulth[0]['speed'];
    }


    $p_time = round($database->procDistanceTime($p_to,$p_from,min($p_speeds),1));
    $p_reference = $database->addAttack($prisoner['from'],$prisoner['t1'],$prisoner['t2'],$prisoner['t3'],$prisoner['t4'],$prisoner['t5'],$prisoner['t6'],$prisoner['t7'],$prisoner['t8'],$prisoner['t9'],$prisoner['t10'],$prisoner['t11'],3,0,0,0,0);
    $database->insertQueue($p_reference, 2, time(), ($p_time + time()));
    $database->addMovement(4,$prisoner['wref'],$prisoner['from'],$p_reference,time(),($p_time+time()));
    $troops = $prisoner['t1']+$prisoner['t2']+$prisoner['t3']+$prisoner['t4']+$prisoner['t5']+$prisoner['t6']+$prisoner['t7']+$prisoner['t8']+$prisoner['t9']+$prisoner['t10']+$prisoner['t11'];
    $database->modifyTraps($prisoner['wref'],$troops,2);
    $database->deletePrisoners($prisoner['id']);
}else if($prisoner['from'] == $village->wid){
    $troops = $prisoner['t1']+$prisoner['t2']+$prisoner['t3']+$prisoner['t4']+$prisoner['t5']+$prisoner['t6']+$prisoner['t7']+$prisoner['t8']+$prisoner['t9']+$prisoner['t10']+$prisoner['t11'];
    if($prisoner['t11'] > 0){
        $p_owner = $database->getVillageField($prisoner['from'],"owner");
        $database->query("UPDATE hero SET `dead` = '1', `health` = '0' WHERE `uid` = '".$p_owner."'");
        $database->modifyTraps($prisoner['wref'],$troops,2);
    }
    $database->query("UPDATE `units` SET `o99`= o99 - ".$troops . " WHERE `vref` =:V",array('V'=>$prisoner['wref']));
   // $database->modifyUnit($prisoner['wref'],array("99o"),array($troops),array(0));
    $database->deletePrisoners($prisoner['id']);
}
}


if(isset($_GET['t']) && isset($_GET['t'])==100 && $session->goldclub == 1) {
    if(isset($_GET['enable'])) {
        $database->updateUserField($session->uid, "evasion", 1, 1);
        $session->evasion=1;

    }else if(isset($_GET['disable'])){
        $database->updateUserField($session->uid, "evasion", 0, 1);
        $session->evasion=0;
    }
}
if(isset($_GET['type']) && in_array($_GET['type'],array(1,2)) && isset($_GET['id'])){
    if($village->resarray['f'.$_GET['id'].'t'] == 24 and $village->currentcel == 0  and $village->resarray['f'.$_GET['id']]>0){
        if($_GET['type'] == 1){
            if(6400 < $village->awood and 6650 < $village->aclay and 5940 < $village->airon and 1340 < $village->acrop){
                $endtime = ($sc[$village->resarray['f'.$_GET['id']]]/ SPEED) + time();
                $wood = 6400;
                $clay = 6650;
                $iron = 5940;
                $crop = 1340;
                $database->modifyResource($village->resarray['vref'],$wood,$clay,$iron,$crop,$mode);
                $database->addCel($village->resarray['vref'],$endtime,$_GET['type']);
                $village->currentcel=$endtime;
                // daily mission - mission 10
				if($session->acData['a10'] < 15){
					$database->UpdateAchievU($session->uid,"`a10`=a10+5");
				}

            }
        }
        elseif($_GET['type'] == 2){
            if(29700 < $village->awood and 33250 < $village->aclay and 32000 < $village->airon and 6700 < $village->acrop and $village->resarray['f'.$_GET['id']]>9){
                $endtime = ($gc[$village->resarray['f'.$_GET['id']]]/ SPEED) + time();
                $wood= 29700;
                $clay= 33250;
                $iron= 32000;
                $crop= 6700;
                $database->modifyResource($village->resarray['vref'],$wood,$clay,$iron,$crop,$mode);
                $database->addCel($village->resarray['vref'],$endtime,$_GET['type']);
                $village->currentcel=$endtime;
                // daily mission - mission 10
				if($session->acData['a10'] < 15){
					$database->UpdateAchievU($session->uid,"`a10`=a10+5");
				}
            }
        }
    }
    header("Location: build.php?id=".$_GET['id']);
}
ob_start();

$ww=$village->natar;
if($_GET['id']==99 AND $ww==0 || $_GET['id']!=99 && $_GET['id']>=43){header("Location: dorf1.php");  exit();}

/*if(isset($_GET['buildingFinish'])) {
	if($session->gold >= 2) {
		$building->finishAll();
$building->buildArray=array();
	}
}*/


$technology->procTech($_POST);

if(isset($_GET['gid'])) {
	$_GET['id'] = strval($building->getTypeField(preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['gid'])));
} else if(isset($_POST['id'])) {
	$_GET['id'] = preg_replace("/[^a-zA-Z0-9_-]/","",$_POST['id']); // WTF is this?
}
if(isset($_POST['t'])){
	$_GET['t'] = preg_replace("/[^a-zA-Z0-9_-]/","",$_POST['t']);
}
if(isset($_GET['id'])) {
	if (!ctype_digit(preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['id']))){
		$_GET['id'] = "1";
	}

	if($village->resarray['f'.$_GET['id'].'t'] == 18) {

		include ("application/Alliance.php");
        $alliance->procAlliance($_GET);
		$alliance->procAlliForm($_POST);

	}
	if($village->resarray['f'.$_GET['id'].'t'] == 12 || $village->resarray['f'.$_GET['id'].'t'] == 13 || $village->resarray['f'.$_GET['id'].'t'] == 22) {
		$technology->procTechno($_GET);

	}
}

if($session->goldclub == 1 && count($session->villages) > 1){
    if(isset($_POST['action']) || isset($_GET['action'])){
        include("application/Market.php");
        $market->procMarket($_POST);
        $market->procRemove($_GET);
    }
    if(isset($_POST['action']) && $_POST['action'] == 'addRoute') {
        if(!in_array($_POST['tvillage'],$session->villages)){die("У тебя нет такой деревни,дружище..");}

                $totalres = $_POST['r1']+$_POST['r2']+$_POST['r3']+$_POST['r4'];
        if($totalres>0 &&  $_POST['r1']>=0  &&  $_POST['r2']>=0 &&  $_POST['r3']>=0 &&  $_POST['r4']>=0){
                $reqMerc = ceil($totalres/$market->maxcarry);

                $second = date("s");
                $minute = date("i");
                $hour = date("G")-$_POST['start'];
                if(date("G") > $_POST['start']){
                    $day = 1;
                }else{
                    $day = 0;
                }
            $coor = $database->getCoor($_POST['tvillage']);

                $timetaken = $database->procDistanceTime($coor,$village->coor,$session->tribe,0);
                $timestamp = strtotime("-$hour hours -$second second -$minute minutes +$day day");
                if($totalres > 0 && 20>=$reqMerc){
                    $database->createTradeRoute($session->uid,$_POST['tvillage'],$village->wid,$_POST['r1'],$_POST['r2'],$_POST['r3'],$_POST['r4'],$_POST['start'],$_POST['deliveries'],$reqMerc,$timestamp,$session->tribe,$timetaken);

                    $route = 1;
                }
        }
    }
    if(isset($_POST['action']) && $_POST['action'] == 'editRoute') {
            $totalres = $_POST['r1']+$_POST['r2']+$_POST['r3']+$_POST['r4'];
            $reqMerc = ceil($totalres/$market->maxcarry);
            if($totalres > 0 &&  $_POST['r1']>=0  &&  $_POST['r2']>=0 &&  $_POST['r3']>=0 &&  $_POST['r4']>=0 && 20>=$reqMerc){
                $database->updateTradeRoute($_POST['routeid'],$_POST['r1'],$_POST['r2'],$_POST['r3'],$_POST['r4'],$_POST['start'],$_POST['deliveries'],$reqMerc);
                $second = date("s");
                $minute = date("i");
                $hour = date("G")-$_POST['start'];
                if(date("G") > $_POST['start']){
                    $day = 1;
                }else{
                    $day = 0;
                }
                $timestamp = strtotime("-$hour hours -$second seconds -$minute minutes +$day day");
                $database->editTradeRoute($_POST['routeid'],"timestamp",$timestamp,0);
            }
            header("Location: build.php?s=17&t=4");
            $route = 1;
        }

    if(isset($_GET['action']) && $_GET['action'] == 'delRoute') {
            $traderoute = $database->getTradeRouteUid($_GET['routeid']);
            if($traderoute == $session->uid){
                $database->deleteTradeRoute($_GET['routeid']);
                $route = 1;
            }
        }

}


if(isset($_GET['mode']) && $_GET['mode']=='troops' && $_GET['cancel']==1){

$_GET['moveid']=$database->filterintvalue($_GET['moveid']);
$oldmovement=$database->getMovementById($_GET['moveid']);
$now=time();
if(($now-$oldmovement[0]['starttime'])<90 && $oldmovement[0]['from'] == $village->wid){

$qc="SELECT * FROM movement where `proc` = '0' and (`sort_type`='3' or `sort_type`='9') and `moveid` = '".$oldmovement[0]['moveid']."' and `from`='".$village->wid."'";
$resultc=$database->query($qc);

	if (count($resultc)==1){
	$database->DeleteQueue("`jobID`='".$resultc[0]['ref']."' and (`type`='1' or `type`='3' or `type`='4') and `finish`='".$resultc[0]['endtime']."'");
	$database->setMovementProc($resultc[0]['moveid']);
	$database->addMovement(4,$resultc[0]['to'],$resultc[0]['from'],$resultc[0]['ref'],$now,($now+($now - $resultc[0]['starttime'])));
	$database->insertQueue($resultc[0]['ref'],2,$now,($now+($now - $resultc[0]['starttime'])));
}
}
header("Location: ".$_SERVER['PHP_SELF']."?id=".$_GET['id']);
    exit();

}
}
if(isset($_GET['id'])){
$database->isWinner();
}


if(($village->resarray['f99t'] == 40) or ($village->resarray['f99t'] == 40) or ($village->resarray['f99t'] == 40) or ($village->resarray['f99t'] == 40)) {
    $isWW = TRUE;
}else{
    $isWW = False;
}

?>


<?php include("application/views/html.php");?>
<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE build  <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'gidResources perspectiveResources';} ?> <?php echo DIRECTION; ?> season- buildingsV3">
<script type="text/javascript">

    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">

        <div id="header">
            <div id="mtop">
                <?php
                include("application/views/topheader.php");
                include("application/views/toolbar.php");
                ?>
            </div>
        </div>
        <div id="center">
            <?php include("application/views/sideinfo.php"); ?>
            <div id="contentOuterContainer" class="size1">
                <?php include("application/views/res.php"); ?>
                <div class="contentTitle"><a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="Close window">&nbsp;</a>
                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a></div>

                <div class="contentContainer">
                    <div id="content" class="<?php if($_GET['id'] == 39 && $_GET['t'] == 2){ echo 'a2b'; }else{ echo 'build'; } ?>" >
<?php

if(isset($_GET['id']) or isset($_GET['gid'])) {

	$id = $_GET['id'];



      if($id=='99' AND $village->resarray['f99t'] == 40 AND $ww==1 ){
      if(isset($_POST['wwname']) and !empty($_POST['wwname'])){
      if($village->resarray['wwname']!=$_POST['wwname']){
      $database->submitWWname($village->wid,$_POST['wwname']);
      header("Location: build.php?id=99&n");
          exit();
      }
      }
	include("application/views/Build/ww.php"); }

      else{

	if($village->resarray['f'.$_GET['id'].'t'] == 0 && $_GET['id'] >= 19) {
		include("application/views/Build/avaliable.php");
	}else{
if(file_exists("application/views/Build/".$village->resarray['f'.$_GET['id'].'t'].".php")){
    $cur=$building->isCurrent($id);
    $loop=$building->isLoop($id);
    $master=$building->isMaster($id);
    $loopsame = ($cur || $loop)?1:0;
    $doublebuild = ($cur && $loop)?1:0;
	
	$bid = $village->resarray['f'.$id.'t'];
	$bindicate = $building->canBuild($id,$bid); //
    
    $showTop = TRUE;

	if(in_array($bid , array(16, 17,25,26,27,37,44))){
		include("application/views/Build/".$bid."_menu.php");
    }
    
    if(in_array($bid, array(25,26,16,17,27,44))){
        if((isset($_GET['t']) && is_numeric($_GET['t'])) || $_GET['show']){
            $showTop = FALSE;
        }
    }
    ?>
        <h1 class="titleInHeader"><?=$lang['buildings'][$village->resarray['f'.$_GET['id'].'t']]?> <span class="level"> <?=LEVEL?> <?=$village->resarray['f'.$id]?></span></h1>
        <div id="build" class="gid<?=$village->resarray['f'.$_GET['id'].'t']?> level<?=$village->resarray['f'.$id]?>">
        
    <?php
    if($showTop){
	?>

        
                            <div id="descriptionAndInfo">
								<div class="build_desc">
								<?=$lang['desc'][$village->resarray['f'.$_GET['id'].'t']][0]?>
								</div>
								<div class="clear"></div>
									<!--<a  class="build_logo">
										<img class="building big white g<?=$village->resarray['f'.$_GET['id'].'t']?>" src="img/x.gif" alt="" title="" />
									</a>-->
									
								
							
                        <?php
                        
                        $upgrade = false;
						
                        $next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
												
						if(!in_array($bid , array(12, 16, 17, 18, 19, 20, 21,22,24,25,26,27,29,30,36,37,40,44))){
                            if($bid == 35){
                                include("application/views/Build/".$village->resarray['f'.$_GET['id'].'t']."_Top.php");
                                include("application/views/Build/upgrade.php");
                                include("application/views/Build/".$village->resarray['f'.$_GET['id'].'t'].".php");
                            }else{
                                include("application/views/Build/".$village->resarray['f'.$_GET['id'].'t'].".php");
                                if(!in_array($bid, array(15))){
                                    include("application/views/Build/upgrade.php");
                                }
                            }
						}else{	
                            if($bid == 36){
                                include("application/views/Build/".$village->resarray['f'.$_GET['id'].'t']."_Top.php");
                                include("application/views/Build/upgrade.php");
                                include("application/views/Build/".$village->resarray['f'.$_GET['id'].'t'].".php");
                            }else{		
                                include("application/views/Build/upgrade.php");
                                include("application/views/Build/".$village->resarray['f'.$_GET['id'].'t'].".php");
                            }	
						}

						
                    }else{
                        include("application/views/Build/".$village->resarray['f'.$_GET['id'].'t'].".php");
                    }
                    echo '</div>';
						}else{
							header("Location: dorf1.php");  exit();
						}
							}
						}
                        }
                    

?>
                            <div class="clear">&nbsp;</div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="contentFooter">&nbsp;</div>
                </div>
                <?php
                include("application/views/rightsideinfor.php");
                ?>
                <div class="clear"></div>
            </div>
            <?php
            include("application/views/header.php");
            ?>

            <div id="ce"></div>
        </div></div>

</body>
</html>


