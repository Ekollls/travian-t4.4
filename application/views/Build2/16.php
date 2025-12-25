<div id="build" class="gid16">


<?php
if(isset($_GET['t']) && $_GET['t'] == 1){
$units_type = $database->getMovement("34",$village->wid,1);
		$oasis = $village->oasisowned;
		$oas_incoming=0;
		foreach($oasis as $oa){
$oas_incoming += count($database->getMovement("33",$oa['wref'],1));
}
$units_incoming = count($units_type)+$oas_incoming;
for($i=0;$i<$units_incoming;$i++){
	if($units_type[$i]['attack_type'] == 1 && $units_type[$i]['sort_type'] == 3)
		$units_incoming -= 1;
}

if($units_incoming > 0){
?>
<h4><?=PY1?> (<?php echo $units_incoming; ?>)</h4>
	<?php include("16_incomming.php");
    }
    
    

$units_type = $database->getMovement("3",$village->wid,0);
$units_incoming = count($units_type);
for($i=0;$i<$units_incoming;$i++){
	if($units_type[$i]['vref'] != $village->wid)
		$units_incoming -= 1;
}
if($units_incoming >= 1){
	echo "<h4>".PY15."</h4>";
	include("16_walking.php");
}
?>

<h4><?=PY5;?></h4>
        <table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td class="role"><a href="karte.php?d=<?php echo $village->wid; ?>"><?php echo $village->vname; ?></a></td><td colspan="<?php if($village->unitarray['u11'] == 0) {echo"10";}else{echo"11";}?>">
            Forces Own</td></tr></thead>
            <tbody class="units">
                <?php include("16_troops.php"); ?>
            </tbody></table>

            <?php      
            // iRedux - Fixed
            $enforcetome=$database->getEnforceVillage($village->wid,0); //подкрепы у меня
            if(count($enforcetome) > 0) {
                foreach($enforcetome as $enforce) {
                    //print_r($enforce); die();

                $info=$database->getUserVillInfoByVillageID($enforce['from']);
                
                $colspan = 10+$enforce['u11'];
                    if($enforce['from']!=0){
                        $tribe = $info['tribe'];
                        
                        $output = "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">";
                        $tribe ? $output .= "<a href=\"karte.php?d=".$enforce['from']."\">".$info['name']."</a>" : $output .= 'Wild';
                        
                        $output .= "</td><td colspan=\"".$colspan."\">";
                        $output .= "Forces ".$info['username'];
                        $output .= "</td></tr></thead><tbody class=\"units\">";
                        
                        
                        
                        $output .= "<tr><th class=\"coords\">";
                        if($tribe) $output .= '<span class="coordinates coordinatesWrapper coordinatesAligned coordinates<?php echo DIRECTION; ?>"><span class="coordinateX">('.$info['vx'].'</span><span class="coordinatePipe">|</span><span class="coordinateY">'.$info['vy'].')</span></span><span class="clear"></span>';
                        if(!$tribe) $tribe =4; // Monsters
                        $output .= '</th>';
                            for($i=1;$i<=10;$i++) {
                                $uni=($tribe-1)*10+$i;
                                $output .= "<td><img src=\"img/x.gif\" class=\"unit u".$uni."\" title=\"".$technology->getUnitName($uni)."\" alt=\"".$technology->getUnitName($uni)."\" /></td>";
                            }
                            
                            if($enforce['u11']!=0){
                                $output .= "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
                            }
                        $output .= "</tr><tr><th>".PY8."</th>";
                        for($i=1;$i<=10;$i++) {
                        if($enforce['u'.$i] == 0) {
                            $output .= "<td class=\"none\">";
                            }
                            else {
                                $output .= "<td>";
                                }
                                $output .= $enforce['u'.$i]."</td>";
                        }
                        if($enforce['u11']!=0){
                            $output .= "<td>".$enforce['u11']."</td>";
                        }
                        $output .= "</tr></tbody>
                    <tbody class=\"infos\"><tr><th>".PY9."</th><td colspan=\"$colspan\"><div class='sup'>".$database->getUpkeep($enforce,$tribe,$village->resarray)."<i class=\"r4\"></i> ".PY10."</div><div class='sback'><a href='build.php?t=2&id=39&w=".$enforce['id']."'>".PY11."</a></div></td></tr>";

                        $output .= "</tbody></table>";

                        echo $output;
                    }
                }
            }
            $enforcetoyou = $database->getEnforceVillage($village->wid,1); //подкрепы от меня
            if(count($enforcetoyou) > 0) {

            echo "<h4>".PY12."</h4>";
            foreach($enforcetoyou as $enforce) {
                
               // echo $enforce['vref']."<br />";
                $fr=!$database->isVillageExist($enforce['from']);
                $vr=!$database->isVillageExist($enforce['vref']);
                if ($vr && $fr) {
                    if($vr){echo 'from ';}else{ echo 'vref ';}
                    echo 'Дереinня с подкрепом не найдена.Напишите Админу ид ' . $enforce[$vr] . '<br /> Village with reinforce not found,please,write this id ' . $enforce[$vr] . ' to administrator';
                } else {
               //     $info = $database->getUserVillInfoByVillageID($enforce['from']);
                    $isoasis = $database->isVillageOases($enforce['vref']);
                    if ($isoasis == 0) {
                        $to = $database->getMInfo($enforce['vref']);
                        $database->starvationReinf($to);
                        $vname = $to['name'];
                    } else {
                        $to = $database->getOMInfo($enforce['vref']);
                        $database->starvationReinf($database->getVillage($to['conqured']));
                        $vname = PY18 . " (" . $to['x'] . "|" . $to['y'] . ")";
                    }
                    $colspan = 10 + $enforce['u11'];
                    echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">

                  <td colspan=\"" . $colspan . "\">";
                    echo "<a href=\"karte.php?d=" . $enforce['vref'] . "\">" . PY13 . $vname . "</a>";
                    echo "</td></tr></thead><tbody class=\"units\">";
                    $tribe = $session->tribe;

                    echo "<tr><th>&nbsp;</th>";
                    for ($i = 1; $i <= 10; $i++) {
                        $uni = ($tribe - 1) * 10 + $i;
                        echo "<td><img src=\"img/x.gif\" class=\"unit u" . $uni . "\" title=\"" . $technology->getUnitName($uni) . "\" alt=\"" . $technology->getUnitName($uni) . "\" /></td>";
                    }
                    if ($enforce['u11'] != 0) {
                        echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
                    }
                    echo "</tr><tr><th>" . PY8 . "</th>";
                    for ($i = 1; $i <= 10; $i++) {
                        if ($enforce['u' . $i] == 0) {
                            echo "<td class=\"none\">";
                        } else {
                            echo "<td>";
                        }
                        echo $enforce['u' . $i] . "</td>";
                    }
                    if ($enforce['u11'] != 0) {
                        echo "<td>" . $enforce['u11'] . "</td>";
                    }
                    echo "</tr></tbody><tbody class=\"infos\"><tr><th>" . PY9 . "</th><td colspan=\"" . $colspan . "\"><div class='sup'>" . $database->getUpkeep($enforce, $tribe, $village->resarray) . "<i class=\"r4\"></i> " . PY10 . "</div><div class='sback'><a href='build.php?t=2&id=39&r=" . $enforce['id'] . "'>" . PY14 . "</a></div></td></tr>";

                    echo "</tbody></table>";
                }
            }
            }
    $prisoner3=$database->getPrisoners3($village->wid);
    if(count($prisoner3) > 0) {
        echo "<h4>".PRISONERS."</h4>";
        foreach($prisoner3 as $prisoners) {
            $colspan = 10+$prisoners['t11'];
            echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
</td>
<td colspan=\"$colspan\">";
            echo "<a href=\"karte.php?d=".$prisoners['wref']."&c=".$generator->getMapCheck($prisoners['wref'])."\">".PRISONERSIN." ".$database->getVillageField($prisoners['wref'],"name")."</a>";
            echo "</td></tr></thead><tbody class=\"units\">";
            $uinf=$database->getUserTribeIdByVillageID($prisoners['from']);
            $tribe = $uinf['tribe'];
            $start = ($tribe-1)*10+1;
            $end = ($tribe*10);
            echo "<tr><th>&nbsp;</th>";
            for($i=$start;$i<=($end);$i++) {
                echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
            }
            if($prisoners['t11']!=0){
                echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
            }
            echo "</tr><tr><th>".TROOPS_DORF."</th>";
            for($i=1;$i<=10;$i++) {
                if($prisoners['t'.$i] == 0) {
                    echo "<td class=\"none\">";
                }
                else {
                    echo "<td>";
                }
                echo $prisoners['t'.$i]."</td>";
            }
            if($prisoners['t11']!=0){
                echo "<td>".$prisoners['t11']."</td>";
            }
            echo "</tr></tbody>
<tbody class=\"infos\"><tr><td colspan=\"".($colspan+1)."\"><div class='sback'><a href='build.php?t=1&id=39&delprisoners=".$prisoners['id']."'>Kill</a></div></td></tr>";
            echo "</tbody></table>";
        }
    }
   $prison= $database->getPrisoners($village->wid);
    if(count($prison) > 0) {
        echo "<h4>".PRISONERS."</h4>";
        foreach($prison as $prisoners) {
            $colspan = 10+$prisoners['t11'];
            $colspan2 = 11+$prisoners['t11'];
            echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\"></td>
<td colspan=\"$colspan\">";
            echo "<a href=\"karte.php?d=".$prisoners['from']."&c=".$generator->getMapCheck($prisoners['from'])."\">".PRISONERSFROM." ".$database->getVillageField($prisoners['from'],"name")."</a>";
            echo "</td></tr></thead><tbody class=\"units\">";
            $uinf=$database->getUserTribeIdByVillageID($prisoners['from']);
            $tribe = $uinf['tribe'];
            $start = ($tribe-1)*10+1;
            $end = ($tribe*10);
            echo "<tr><th>&nbsp;</th>";
            for($i=$start;$i<=($end);$i++) {
                echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
            }
            if($prisoners['t11']!=0){
                echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
            }
            echo "</tr><tr><th>".TROOPS_DORF."</th>";
            for($i=1;$i<=10;$i++) {
                if($prisoners['t'.$i] == 0) {
                    echo "<td class=\"none\">";
                }
                else {
                    echo "<td>";
                }
                echo $prisoners['t'.$i]."</td>";
            }
            if($prisoners['t11']!=0){
                echo "<td>".$prisoners['t11']."</td>";
            }
            echo "</tr></tbody>
<tbody class=\"infos\"><tr><td colspan=\"".($colspan+1)."\"><div class='sback'><a href='build.php?t=1&id=39&delprisoners=".$prisoners['id']."'>".PY11."</a></div></td></tr>";
            echo "</tbody></table>";
        }
    }

    if(count($village->oasisowned)>0){
    foreach($village->oasisowned as $oasid){
    $enforcetome=$database->getEnforceVillage($oasid['wref'],0); //подкрепы in оазе
    if(count($enforcetome) > 0) {
       echo "<h4>".PY19."</h4>";
        foreach($enforcetome as $enforce) {
            $info=$database->getUserVillInfoByVillageID($enforce['from']);
          //  $isoasis = $database->isVillageOases($enforce['vref']);

                $to = $database->getOMInfo($enforce['vref']);
                $database->starvationReinf($database->getVillage($to['conqured']));
                $vname=PY18." (".$to['x']."|".$to['y'].")";
            $colspan = 10+$enforce['u11'];

                echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$enforce['from']."\">".$info['name']."</a></td>
                  <td colspan=\"".$colspan."\">";
               echo "<a href=\"karte.php?d=".$enforce['vref']."\">".PY13.$vname."</a>";
                echo "</td></tr></thead><tbody class=\"units\">";
                $tribe = $info['tribe'];
                echo "<tr><th>&nbsp;</th>";
                for($i=1;$i<=10;$i++) {
                    $uni=($tribe-1)*10+$i;
                    echo "<td><img src=\"img/x.gif\" class=\"unit u".$uni."\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
                }
                if($enforce['u11']!=0){
                    echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
                }
                echo "</tr><tr><th>".PY8."</th>";
                for($i=1;$i<=10;$i++) {
                    if($enforce['u'.$i] == 0) {
                        echo "<td class=\"none\">";
                    }
                    else {
                        echo "<td>";
                    }
                    echo $enforce['u'.$i]."</td>";
                }
                if($enforce['u11']!=0){
                    echo "<td>".$enforce['u11']."</td>";
                }
                echo "</tr></tbody>
            <tbody class=\"infos\"><tr><th>".PY9."</th><td colspan=\"$colspan\"><div class='sup'>".$database->getUpkeep($enforce,$tribe,$village->resarray)."<i class=\"r4\"></i> ".PY10."</div><div class='sback'><a href='build.php?t=2&id=39&w=".$enforce['id']."'>".PY11."</a></div></td></tr>";

                echo "</tbody></table>";

        }
    }
        }
    }




//$units_incoming += count($settlers);

}elseif($_GET['t']==99){
    ?>
<div id="raidList">
	<?php if(!$session->goldclub) { 
        header('Location: build.php?id=39');
}else{
        if($_GET['action'] == 'addList') {
            include("application/views/goldClub/farmlist_add.php");
        }
        if($_GET['action'] == 'showSlot' && $_GET['lid']) {
            // iRedux
            include("application/views/goldClub/farmlist_addraid.php");
        }elseif($_GET['action'] == 'showSlot' && $_GET['eid']) {
            include("application/views/goldClub/farmlist_editraid.php");
        }
        if($_GET['action'] == 'deleteList') {
            $database->delFarmList($_GET['lid'], $session->uid);
            header("Location: build.php?id=39&t=99");
        }elseif($_GET['action'] == 'deleteSlot') {
            $database->delSlotFarm($_GET['eid']);
            header("Location: build.php?id=39&t=99");
        }
        if($_POST['action'] == 'startRaid'){
                include ("application/views/Attack/startRaid.php");

        }
        if(!isset($_GET['action'])){
        include_once "application/views/goldClub/farmlist.php"; }
    }

            ?>
</div>
    <?php
    }elseif($_GET['t'] == 2){
        $kid = $_GET['kid'];
        if(!empty($kid)) {
            if(isset($_GET['s'])){
                include("application/views/Attack/newdorf.php");
            }elseif(isset($_GET['h'])){
                header('Location: start_adventure.php?kid='.$kid.'&h=1');
                //include_once "application/views/Attack/adventure.php";
            }
		} else
			if(isset($w)) {
				$enforce = $database->getEnforceArray($w, 0);
              //  echo $enforce['vref']; print_r($village->oasisowned); die;
				if($enforce['vref'] == $village->wid || in_array($enforce['vref'],array($village->oasisowned[0]['wref'],$village->oasisowned[1]['wref'],$village->oasisowned[2]['wref']))) {
					$to = $database->getVillage($enforce['from']);
					$ckey = $w;
					include("application/views/Attack/sendback.php");
				} else {
					include("application/views/Attack/units.php");
					include("application/views/Attack/search.php");
				}
			} else
				if(isset($r)) {
					$enforce = $database->getEnforceArray($r, 0);
					if($enforce['from'] == $village->wid) {
						$to = $database->getVillage($enforce['from']);
						$ckey = $r;
						include("application/views/Attack/sendback.php");
					} else {
						include("application/views/Attack/units.php");
						include("application/views/Attack/search.php");
					}
				}  else {
					if(isset($process['0'])) {
						$coor = $database->getCoor($process['0']);
						include("application/views/Attack/attack.php");
					} else {
						include("application/views/Attack/units.php");
						include("application/views/Attack/search.php");
					}
                }
            }elseif($_GET['t']==3){
                include("application/views/Simulator/overview.php");
}else{
    ?>
        <div id="raidList">
            <div class="round spacer listTitle">
                <div class="listTitleText">
                    <?=build20?>
                </div>
            <div class="clear"></div>
        </div>

    <?php
    if(!$session->goldclub) {
        ?>
    <div class="build_desc"><p>Club Gold, you have the right to hide the Forces and escape them outside the village when attacks on the village occur</p>
            <button type="button" class="gold builder " id="buttonjzlRVAnXm5wIW"><div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content">club gold</div></div></button>
        <script type="text/javascript" id="buttonjzlRVAnXm5wIW_script">
        window.addEvent('domready', function()
            {
            if($('buttonjzlRVAnXm5wIW'))
            {
            $('buttonjzlRVAnXm5wIW').addEvent('click', function ()
            {
                window.fireEvent('buttonClicked', [this, {"type":"button","class":"gold builder ","value":"\u0646\u0627\u062f\u064a \u0627\u0644\u0630\u0647\u0628","goldclubDialog":{"featureKey":"troopEscape","infoIcon":"http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"},"title":"\u0627\u0644\u0647\u0631\u0648\u0628||\u0644\u0647\u0630\u0647 \u0627\u0644\u0645\u064a\u0632\u0629 \u062a\u062d\u062a\u0627\u062c \u0625\u0644\u0649 \u0646\u0627\u062f\u064a \u0627\u0644\u0630\u0647\u0628.","id":"buttonjzlRVAnXm5wIW"}]);
            });
            }
            });
        </script>    </div>
        <?php
    }else{
    ?>
            <div class="options">
                <?php
                if($session->evasion == 1){
                    ?>
                    <input type="checkbox" class="check" name="hideShow" onclick="window.location.href = '?id=39&t=100&disable';" checked="checked"> <?=build21?>
                <?php
                }else{
                    ?>
                    <input type="checkbox" class="check" name="hideShow" onclick="window.location.href = '?id=39&t=100&enable';"> <?=build21?>
                <?php } ?>
            </div>

        
<?php 
    } 
    echo '</div>';
}
?>
    </div>
