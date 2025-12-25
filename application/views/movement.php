<?php
$oasis = $village->oasisowned;
        $aantal6=array();
		foreach($oasis as $oa){
			$infa=$database->getMovement("33",$oa['wref'],1);
			if(count($infa)){$aantal6[]=$infa;}

}
$countoas=count($aantal6);
$allmov=$database->allMov($village->wid);
$aantal55 = $aantal22 = $aantal11 = $a = array();
foreach($allmov as $all){
	switch($all['sort_type']){
		case 3:
			if($all['to']==$village->wid){
				$aantal55[] = $all;
			}elseif($all['from']==$village->wid){
				$aantal11[] = $all;
			}
		break;
		case 4:
			if($all['to']==$village->wid){
				$aantal22[] = $all;
			}
		break;
        case 9:
            if($all['from']==$village->wid){
                $a[] = $all;
            }
		break;
	}
}

$co2= count($aantal22);
$co5= count($aantal55);
$co11= count($aantal11);
$aantal = ($co2)+($co5)+($co11)+$countoas +count($a);


if($aantal > 0){
if($aantal != "") { $class = ''; } else { $class = 'hide'; }
?>
<div class="movements <?php echo $class ?>"><div class="boxes villageList movements">

    <div class="boxes-tl"></div>
    <div class="boxes-tr"></div>
    <div class="boxes-tc"></div>
    <div class="boxes-ml"></div>
    <div class="boxes-mr"></div>
    <div class="boxes-mc"></div>
    <div class="boxes-bl"></div>
    <div class="boxes-br"></div>
    <div class="boxes-bc"></div>
    <div class="boxes-contents cf">
            <table id="movements" cellpadding="1" cellspacing="1"><thead><tr><th colspan="3"><?php echo TROOP_MOVEMENTS; ?></th></tr></thead><tbody>
<?php

$NextArrival = array();
$NextArrival1 = array();
$NextArrival2 = array();
$NextArrival3 = array();
$NextArrival4 = array();
$NextArrival7 = array();

$aantal = $co2;
$aantal4 = $co5;
$lala = $aantal4;

for($i=0;$i<$aantal4;$i++){
	if(($aantal55[$i]['attack_type']==1) or ($aantal55[$i]['attack_type']==3) or ($aantal55[$i]['attack_type']==4) or ($aantal55[$i]['attack_type']==5)) { $lala -= 1; }
}
$aantal = $aantal+$lala;
if($aantal > 0){
	foreach($aantal22 as $receive) {
		$action = 'def1';
		$aclass = 'd1';
		$title = ''.ARRIVING_REINF_TROOPS.'';
		$short = ''.ARRIVING_REINF_TROOPS_SHORT.'';
		$NextArrival[] = $receive['endtime'];
	}

	foreach($aantal55 as $receive) {
	if ($receive['attack_type'] == 2) {
		$action = 'def1';
		$aclass = 'd1';
		$title = ''.OWN_REINFORCING_TROOPS.'';
		$short = ''.ARRIVING_REINF_TROOPS_SHORT.'';
		$NextArrival[] = $receive['endtime'];
	}
	}
	echo '<tr><td class="typ"><a href="build.php?t=1&id=39"><img src="img/x.gif" class="'.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'.$aclass.'">&raquo;</span></td>
	<td><div class="mov"><span class="'.$aclass.'">'.$aantal.'&nbsp;'.$short.'</span></div><div class="dur_r">in a&nbsp;<span class="timer" counting="down" value="'.(min($NextArrival)-time()).'">'.$generator->getTimeFormat(min($NextArrival)-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
	$timer += 1;
}

/* attack/raid on you! */
$aantal = $aantal1 = $co5;
$aantal2 = $aantal55;
for($i=0;$i<$aantal1;$i++){
	if($aantal2[$i]['attack_type'] == 2) { $aantal -= 1; }
	if($aantal2[$i]['attack_type'] == 1) { $aantal -= 1; }
	if($aantal2[$i]['attack_type'] == 5) { $aantal -= 1; }
}

if($aantal > 0){

	if(!empty($NextArrival1)) { reset($NextArrival1); }
	foreach($aantal2 as $receive) {
		if ($receive['attack_type'] != 2 && $receive['attack_type'] != 1) {
			$action = 'att1';
			$aclass = 'a1';
			$title = ''.OWN_ATTACKING_TROOPS.'';
			$short = ''.ATTACK.'';
			$NextArrival1[] = $receive['endtime'];
		}
	}
	echo '<tr><td class="typ"><a href="build.php?t=1&id=39"><img src="img/x.gif" class="'.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'.$aclass.'">&raquo;</span></td>
	<td><div class="mov"><span class="'.$aclass.'">'.$aantal.'&nbsp;'.$short.'</span></div><div class="dur_r">in a&nbsp;<span class="timer" counting="down" value="'.(min($NextArrival1)-time()).'">'.$generator->getTimeFormat(min($NextArrival1)-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
	$timer += 1;
}

/* on attack, raid */
$aantal = $aantal1 = $co11;

$aantal2 = $aantal11;
for($i=0;$i<$aantal1;$i++){
	if($aantal2[$i]['attack_type'] == 2) { $aantal -= 1; }
}
if($aantal > 0){
	if(!empty($NextArrival2)) { reset($NextArrival2); }
		foreach($aantal2 as $receive) {
			if($receive['attack_type'] == 5){
				$action = 'settlersOnTheWay';
				$aclass = 'a3';
				$title = $short = 'New Village';
				$NextArrival2[] = $receive['endtime'];
			}else
			if ($receive['attack_type'] != 2) {
				$action = 'att2';
				$aclass = 'a2';
				$title = ''.OWN_ATTACKING_TROOPS.'';
				$short = ''.ATTACK.'';
				$NextArrival2[] = $receive['endtime'];
			}
		}
	echo '<tr><td class="typ"><a href="build.php?t=1&id=39"><img src="img/x.gif" class="'.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'.$aclass.'">&raquo;</span></td>
	<td><div class="mov"><span class="'.$aclass.'">'.$aantal.'&nbsp;'.$short.'</span></div><div class="dur_r">in a&nbsp;<span class="timer" counting="down" value="'.(min($NextArrival2)-time()).'">'.$generator->getTimeFormat(min($NextArrival2)-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
	$timer += 1;
}



   if($countoas > 0){

	if(!empty($NextArrival7)) { reset($NextArrival7); }
		foreach($aantal6 as $receive) {
			if ($receive[0]['attack_type'] != 2) {

				$action = 'att3';
				$aclass = 'a3';
				$title = ''.OWN_ATTACKING_TROOPS.'';
				$short = ''.ATTACK.'';
				$NextArrival7[] = $receive[0]['endtime'];
			}

		}
	echo '<tr><td class="typ"><a href="build.php?t=1&id=39"><img src="img/x.gif" class="'.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'.$aclass.'">&raquo;</span></td>
	<td><div class="mov"><span class="'.$aclass.'">'.$countoas.'&nbsp;'.$short.'</span></div><div class="dur_r">in a&nbsp;<span class="timer" counting="down" value="'.(min($NextArrival7)-time()).'">'.$generator->getTimeFormat(min($NextArrival7)-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
	$timer += 1;
}




/* Units send to reinf. (to other town) */
$aantal = $co11;
$lala=$aantal;
$aantal2 = $aantal11;
for($i=0;$i<$aantal;$i++){
	if(($aantal2[$i]['attack_type']==1) or ($aantal2[$i]['attack_type']==3 or $aantal2[$i]['attack_type']==5) or ($aantal2[$i]['attack_type']==4)) { $lala -= 1; }
}
if($lala > 0){
	if(!empty($NextArrival3)) { reset($NextArrival3); }
		foreach($aantal2 as $receive) {
			if ($receive['attack_type'] == 2) {
				$action = 'def2';
				$aclass = 'd2';
				$title = ''.OWN_REINFORCING_TROOPS.'';
				$short = ''.ARRIVING_REINF_TROOPS_SHORT.'';
				$NextArrival3[] = $receive['endtime'];
			}
		}
	echo '<tr><td class="typ"><a href="build.php?t=1&id=39"><img src="img/x.gif" class="'.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'.$aclass.'">&raquo;</span></td>
	<td><div class="mov"><span class="'.$aclass.'">'.$lala.'&nbsp;'.$short.'</span></div><div class="dur_r">in a&nbsp;<span class="timer" counting="down" value="'.(min($NextArrival3)-time()).'">'.$generator->getTimeFormat(min($NextArrival3)-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
	$timer += 1;
}


    $aantal = count($a);
    $aantal2 = $a;
    if($aantal > 0){
        foreach($aantal2 as $receive) {
            $action = 'hero_on_adventure';
            $aclass = 'adventure';
            $title = 'adventure';
            $short = 'adventure';
        }

        echo '
		<tr>
			<td class="typ"><a href="build.php?t=1&id=39"><img src="img/x.gif" class="'.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'.$aclass.'">&raquo;</span></td>
			<td><div class="mov"><span class="'.$aclass.'">'.$aantal.'&nbsp;'.$short.'</span></div><div class="dur_r">&nbsp;<span class="timer" counting="down" value="'.($receive['endtime']-time()).'">'.$generator->getTimeFormat($receive['endtime']-time()).'</span>&nbsp;'.HOURS.'</div></div></td>
		</tr>';

        $timer += 1;

    }

    echo "</tbody></table>
        </div></div></div>";
}