<?php
// Temp

$from = $village->coor;
$to = array('x'=>$coor['x'], 'y'=>$coor['y']);
$fastertroops = $database->checkArtefactsEffects($session->uid,$village->wid,2);
$ckey= $generator->generateRandStr(6);

$scout=0;
 if (!isset($process['t1']) || $process['t1'] == ''){  $t1='0'; }else{  $t1=$process['t1']; }
 if (!isset($process['t2']) || $process['t2'] == ''){  $t2='0'; }else{  $t2=$process['t2']; }
 if (!isset($process['t3']) || $process['t3'] == ''){  $t3='0'; }else{  $t3=$process['t3']; if ($session->tribe == 3 || $session->tribe == 7){ $scout=1; } }
 if (!isset($process['t4']) || $process['t4'] == ''){ 
    $t4='0'; 
}else{  
    $t4=$process['t4']; 
    if(in_array($session->tribe, array(1,2,4,5,6))){
        $scout=1;
    } 
}
 if (!isset($process['t5']) || $process['t5'] == ''){  $t5='0'; }else{  $t5=$process['t5']; }
 if (!isset($process['t6']) || $process['t6'] == ''){  $t6='0'; }else{  $t6=$process['t6']; }
 if (!isset($process['t7']) || $process['t7'] == ''){  $t7='0'; }else{  $t7=$process['t7']; }
 if (!isset($process['t8']) || $process['t8'] == ''){  $t8='0'; }else{  $t8=$process['t8']; }
 if (!isset($process['t9']) || $process['t9'] == ''){  $t9='0'; }else{  $t9=$process['t9']; }
 if (!isset($process['t10']) || $process['t10'] == ''){  $t10='0'; }else{  $t10=$process['t10']; }
 if (!isset($process['t11']) || $process['t11'] == ''){  $t11='0'; }else{  $t11=$process['t11']; $showhero=1;}
 if ($session->tribe == 3 || $session->tribe == 7){
    $totalunits =$process['t1']+$process['t2']+$process['t4']+$process['t5']+$process['t6']+$process['t7']+$process['t8']+$process['t9']+$process['t10']+$process['t11'];

 }else{
    $totalunits =$process['t1']+$process['t2']+$process['t3']+$process['t5']+$process['t6']+$process['t7']+$process['t8']+$process['t9']+$process['t10']+$process['t11'];
 }

// iRedux
$d=$database->getBaseID($coor['x'],$coor['y']);
if($database->isVillageOases($d) && !$database->getOasisInfo($d)['conqured']){
    $scout = 0;
}

 if ($scout==1 && $totalunits==0) {
    if ($process['c'] != 2){
        $process['c'] = 1;
    }
}
    $id = $database->addA2b($ckey,time(),$process['0'],$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11,$process['c'],$process['add']);


if ($process['c']==1){

$actionType = OTPRAV9;

}else if ($process['c']==2){

$actionType = OTPRAV6;

}elseif ($process['c']==3){

$actionType = OTPRAV7;

}else{

$actionType = OTPRAV8;

}

$uid = $session->uid;

$tribe = $session->tribe;
$start = ($tribe-1)*10+1;
$end = ($tribe*10);
?>



<h1><?php echo $actionType."  ".$process[1]; ?></h1>
<form method="post" action="build.php?t=2&id=39">

            <table id="short_info" cellpadding="1" cellspacing="1">

                <tbody>

                    <tr>

                        <th><?php echo OVERVIEW16;?>:</th>

                        <td><a href="karte.php?d=<?php $d=$database->getBaseID($coor['x'],$coor['y']); echo $d."&c=".$generator->getMapCheck($d);?>"><?php echo $process[1]; ?> (<?php echo $coor['x']; ?>|<?php echo $coor['y']; ?>)</a></td>

                    </tr>

                    <tr>

                        <th><?php echo FINDER10;?>:</th>

                        <td><a href="spieler.php?uid=<?php echo $process['2']; ?>"><?php echo $process['3']; ?></a></td>

                    </tr>

                </tbody>

            </table>



            <table class="troop_details" cellpadding="1" cellspacing="1">

                <thead>

                    <tr>

                        <td><?php echo $village->vname; ?></td>

                        <td colspan="<?php if($process['t11'] != ''){ echo"11"; }else{ echo"10"; } ?>"><?php echo $actionType."  ".$process['1']; ?></td>

                    </tr>

                </thead>

                <tbody class="units">

                    <tr>

                        <td></td>
                 <?php
                for($i=$start;$i<=($end);$i++) {
                      echo "<td><img src=\"img/x.gif\" class=\"unit u".$i."\" title=\"\" alt=\"\" /></td>";
                  } if ($process['t11'] != ''){
                  echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";

                  }?>

                    </tr>

                    <tr>

                        <th><?php echo TROOPS_DORF;?></th>

                        <td <?php if (!isset($process['t1']) || $process['t1'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t1'];} ?></td>

                        <td <?php if (!isset($process['t2']) || $process['t2'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t2'];} ?></td>

                        <td <?php if (!isset($process['t3']) || $process['t3'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t3'];} ?></td>

                        <td <?php if (!isset($process['t4']) || $process['t4'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t4'];} ?></td>

                        <td <?php if (!isset($process['t5']) || $process['t5'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t5'];} ?></td>

                        <td <?php if (!isset($process['t6']) || $process['t6'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t6'];} ?></td>

                        <td <?php if (!isset($process['t7']) || $process['t7'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t7'];} ?></td>

                        <td <?php if (!isset($process['t8']) || $process['t8'] == ''){ echo "class=\"none\">0"; }else{ $kata='1'; echo ">".$process['t8'];} ?></td>

                        <td <?php if (!isset($process['t9']) || $process['t9'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t9'];} ?></td>

                        <td <?php if (!isset($process['t10']) || $process['t10'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t10'];} ?></td>

                        <?php if (!isset($process['t11']) || $process['t11'] == ''){ echo ""; }else{ echo "<td>".$process['t11']."</td>";} ?>

                     </tr>

                </tbody>
                                         <?php
                                        
                                         if ($process['c']==1){ ?>
                <tbody class="options">
                <?php if(!$database->isVillageOases($d)){ ?>
                    <tr>
                        <th><?php echo ALLIANCE1;?></th>
                        <td colspan="<?php if($process['t11'] != ''){ echo"11"; }else{ echo"10"; } ?>"><input class="radio" name="spy" value="1" checked="checked" type="radio"><?php echo OTPRAV10; ?>
                        <input class="radio" name="spy" value="2" type="radio"> <?php echo OTPRAV11; ?>
                        </td>
                    </tr>
                <?php } ?>
    </tbody>
    <?php } ?>

        <?php if(isset($kata) AND $process['c']!='2'){?><tr>

            <?php if($process['c']=='3'){ ?><tbody class="cata">
                <tr>

                    <th><?php echo OTPRAV12; ?>:</th>
                    <td colspan="<?php if($process['t11'] != ''){ echo"11"; }else{ echo"10"; } ?>">

                        <select name="ctar1" class="dropdown">
                            <option value="999"><?php echo OTPRAV13; ?></option>
                            <?php
                          $br_tm = explode(",",$session->brewery);

                            if($br_tm[0]<time()){
                                $pc=$database->getTypeLvlFdata(16,$village->resarray);
							if($pc >= 5) { ?>
                <optgroup label="<?=punktxuev0?>"> <?php for($i=1;$i<=9;$i++){ ?>
                                <option value="<?php echo $i;?>"><?php echo $lang['buildings'][$i]; ?></option>
                             <?php   }  ?>
                            </optgroup>
                            <?php } ?>
                            <?php if($pc >= 3) { ?>
                            <optgroup label="<?=punktxuev1?>">
                                <option value="10"><?php echo $lang['buildings'][10]; ?></option>
                                <option value="11"><?php echo $lang['buildings'][11]; ?></option>
                                <?php if($pc >= 10) { ?>
                                <option value="15"><?php echo $lang['buildings'][15]; ?></option>
                                <option value="17"><?php echo $lang['buildings'][17]; ?></option>
                                <option value="18"><?php echo $lang['buildings'][18]; ?></option>
                                <option value="44"><?php echo $lang['buildings'][44]; ?></option>
                                <?php for($i=24;$i<=28;$i++){ ?>
                                <option value="<?php echo $i;?>"><?php echo $lang['buildings'][$i]; ?></option>

                                <?php } } ?>
                                <option value="38"><?php echo $lang['buildings'][38]; ?></option>
                                <option value="39"><?php echo $lang['buildings'][39]; ?></option>
                                <option value="40"><?php echo $lang['buildings'][40]; ?></option>
                            </optgroup>
                            <?php } ?>
                            <?php if($pc >= 10) { ?>
                            <optgroup label="<?=punktxuev2?>">
                                <option value="12"><?php echo $lang['buildings'][12]; ?></option>

                                <option value="14"><?php echo $lang['buildings'][14]; ?></option>
                                <option value="16"><?php echo $lang['buildings'][16]; ?></option>
                                <option value="19"><?php echo $lang['buildings'][19]; ?></option>
                                <option value="20"><?php echo $lang['buildings'][20]; ?></option>
                                <option value="21"><?php echo $lang['buildings'][21]; ?></option>

                                <option value="22"><?php echo $lang['buildings'][22]; ?></option>
                                <option value="29"><?php echo $lang['buildings'][29]; ?></option>
                                <option value="30"><?php echo $lang['buildings'][30]; ?></option>
                                <option value="37"><?php echo $lang['buildings'][37]; ?></option>
                                <option value="42"><?php echo $lang['buildings'][42]; ?></option>
                            </optgroup>
                            <?php } ?>
                        </select>

            <?php if($pc == 20) { ?>
                     <select name="ctar2" class="dropdown">
                <option value="0">-</option>
                <option value="999"><?php echo OTPRAV13; ?></option>

                                           <optgroup label="<?=punktxuev0?>"> <?php for($i=1;$i<=9;$i++){ ?>
                                <option value="<?php echo $i;?>"><?php echo $lang['buildings'][$i]; ?></option>
                             <?php   }  ?>
                            </optgroup>


                            <optgroup label="<?=punktxuev1?>">
                                <option value="10"><?php echo $lang['buildings'][10]; ?></option>
                                <option value="11"><?php echo $lang['buildings'][11]; ?></option>
                                <?php if($pc >= 10) { ?>
                                <option value="15"><?php echo $lang['buildings'][15]; ?></option>
                                <option value="17"><?php echo $lang['buildings'][17]; ?></option>
                                <option value="18"><?php echo $lang['buildings'][18]; ?></option>
                                <option value="44"><?php echo $lang['buildings'][44]; ?></option>

                                 <?php for($i=24;$i<=28;$i++){ ?>
                                <option value="<?php echo $i;?>"><?php echo $lang['buildings'][$i]; ?></option>

                                <?php } } ?>
                                <option value="38"><?php echo $lang['buildings'][38]; ?></option>
                                <option value="39"><?php echo $lang['buildings'][39]; ?></option>
                                <option value="40"><?php echo $lang['buildings'][40]; ?></option>
                            </optgroup>

                            <optgroup label="<?=punktxuev2?>">
                                <option value="12"><?php echo $lang['buildings'][12]; ?></option>
                             
                                <option value="14"><?php echo $lang['buildings'][14]; ?></option>
                                <option value="16"><?php echo $lang['buildings'][16]; ?></option>
                                <option value="19"><?php echo $lang['buildings'][19]; ?></option>
                                <option value="20"><?php echo $lang['buildings'][20]; ?></option>
                                <option value="21"><?php echo $lang['buildings'][21]; ?></option>

                                <option value="22"><?php echo $lang['buildings'][22]; ?></option>
                                <option value="29"><?php echo $lang['buildings'][29]; ?></option>
                                <option value="30"><?php echo $lang['buildings'][30]; ?></option>
                                <option value="37"><?php echo $lang['buildings'][37]; ?></option>
                                <option value="42"><?php echo $lang['buildings'][42]; ?></option>
                            </optgroup>

                        </select>
                    <?php }?>

                    <span class="info"><?php echo OTPRAV15; ?></span>
                     </td>
                </tr>


            </tbody><?php
                 }else{    ?>
                 	</select><span class="info"> <?php echo OTPRAV14; ?></span>
                 	          </td>
                </tr>


            </tbody>
                 <?php	}
            }

            }
              if($process['t11']>0){
                            	$arti=$database->getArteInf($process[0]);
                             if(count($arti)){
                   ?>
                          <tr>
                     <td>
                      <?php echo OTPRAV16; ?>
                     </td>
                     <td colspan="11">
                      <select name="artefact" class="dropdown">
                      <?php
                        foreach($arti as $artifact){
                        $te = $artifact['type'];

                   $se = $artifact['size'];
                    if($te== 1 AND $se == 1){
                    $name = ART1;}
                     if($te== 1 AND $se == 2){
                    $name = ART2;}
                     if($te== 1 AND $se == 3){
                    $name = ART3;}
                     if($te== 2 AND $se == 1){
                    $name = ART4;}
                     if($te== 2 AND $se == 2){
                    $name = ART5;}
                     if($te== 2 AND $se == 3){
                    $name = ART6;}
                     if($te== 3 AND $se == 1){
                    $name = ART7;}
                     if($te== 3 AND $se == 2){
                    $name = ART8;}
                     if($te== 3 AND $se == 3){
                    $name = ART9;}
                   if($te== 5 AND $se == 1){
                    $name = ART10; }
                     if($te== 5 AND $se == 2){
                    $name = ART11; }
                     if($te== 5 AND $se == 3){
                    $name = ART12;}
                     if($te== 6){
                    $name = ART13;}
                     if($te== 11 ){
                    $name = ART14;}


                        ?>

                      <option value="<?php echo $artifact['id'];?>"><?php echo $name; ?></option>
                              <?php } ?>



                      </select></td>
                    </tr>
                       <?php }} ?>



             <tbody class="infos">
    <tr>

   <th><?php echo OTPRAV17;?>:</th>



            <?php
            $speeds = array();

            $scout = 1;
                        
            //find slowest unit.
            for($i=1;$i<=11;$i++){
                if($process['t'.$i] > 0){
                    if ($i<11){
                        $speeds[] = ${'u'.(($session->tribe-1)*10+$i)}['speed'];}
                        else{
                            $result = $database->getHeroData($uid);
                            $speeds[] = $result['speed'];
                        }
                        if($i != 4){$scout = 0;}
                    }
            }
            
            if($scout){$process['c'] = 1;}

            $bon=$bon2=$bon3=1;
            if($process['t11']>0){
            $bonuses=$database->allHeroBonuses($database->getHeroInventory($session->uid));
            if($session->alliance>0 && $session->alliance==$process['3']){$bon=$bonuses['ally'];}else{$bon=1;}
            if($session->uid==$from['2']){$bon2=$bonuses['own'];}else{$bon2=1;}
            $bon3=$bonuses['speedb'];
            }
            $time = round($database->procDistanceTime($from,$to,(min($speeds)*$bon*$bon2*$bon3),1,$village->wid)/$fastertroops);
            ?>
            <td colspan="<?php if($process['t11']>0){ echo"11"; }else{ echo"10"; } ?>">
            <div class="in"><?php echo $generator->getTimeFormat($time); ?></div>
            <div class="at"><?php echo REPORT_AT;?><span id="tp2"> <?php echo $generator->procMtime(date('U')+$time,9)?></span></div>
            </td>
        </tr>
    </tbody>
</table>
<input name="timestamp" value="<?php echo time(); ?>" type="hidden">
<input name="timestamp_checksum" value="<?php echo $ckey; ?>" type="hidden">
<input name="ckey" value="<?php echo $id; ?>" type="hidden">
<input name="id" value="39" type="hidden">
<input name="a" value="533374" type="hidden">
<input name="c" value="3" type="hidden">

<?php

    	   $protect=$session->protection;

           if ($process['c']!=2){
           if($protect>time() && $process[2] != 2 && $session->protect==1){ // // iRedux - Fixed
            $exist = $database->checkviloas($d);
                if($exist['oasistype']){
                if($database->getOasisInfo($database->getBaseID($coor['x'],$coor['y']))['conqured']){ 
                    $x=0;
                    foreach($session->vvillages as $vil){
                        if($vil['wref'] == $database->getOasisInfo($database->getBaseID($coor['x'],$coor['y']))['conqured']){
                            $x++;
                        }
                    }
                    if($x == 0){
                        echo" </br></br><span style=\"color: #DD0000\"><b>".INS121.":</b> ".OTPRAV19."</span>";
                    }
                }
                }else{
                    $x=0;
                    foreach($session->vvillages as $vil){
                        if($vil['wref'] == $database->getBaseID($coor['x'],$coor['y'])){
                            $x++;
                        }
                    }
                    if($x == 0){
                        if($database->getUserInfoByVillageID($d)['id'] != 3){
                            echo" </br></br><span style=\"color: #DD0000\"><b>".INS121.":</b> ".OTPRAV19."</span>";
                        }
                        
                    }
                }
            }
        }
?>

            <button type="submit" value="ok" name="s1" id="btn_ok" class="green ">
                <div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?=punktxuev3?></div></div></button>
</form>
