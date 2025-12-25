
<table id="culture_points" cellpadding="1" cellspacing="1">
<thead>
<tr><th colspan="5"><?=dorf3?></th></tr>
<tr><td><?=dorf5?></td><td><?=dorf11?></td><td><?=dorf12?></td><td><?=dorf8?></td><td><?=dorf13?></td></tr>
</thead>
<tbody>
<?php

$timer = $gesexp = $gesdorf = $gescp = $gessied = $gessen = $senator = 0;
foreach($session->villages as $vid){
	//$vid = $vil['wref'];
    $vinfo=$database->getVillagedorf34($vid);
	$cp = $vinfo['cp'];
	$exp = 0;
	for($i=1;$i<=3;$i++) {
		${'slot'.$i} = $vinfo['exp'.$i];
		if(${'slot'.$i} != 0) { $exp++;	}
	}
    $fdata=$database->getResourceLevel($vid);
	$lvlTH = $building->getTypeLevel(24,$vid,$fdata);
	$lvlRes = $building->getTypeLevel(25,$vid,$fdata);
	$lvlPal = $building->getTypeLevel(26,$vid,$fdata);
	$maxslots = ($lvlRes>=10?floor($lvlRes/10):0)+($lvlPal>=10?floor(($lvlPal-5)/5):0);
	$hasCel = $vinfo['celebration'];
	if ($hasCel <> 0) { $timer++; }

	if($vdata['capital'] == 1){$class = 'hl';}else{$class = '';}                  

	echo '<tr class="'.$class.'"><td class="vil fc"><a href="dorf1.php?newdid='.$vid.'">'.$vinfo['name'].'</a></td>';
	echo '<td class="cps">'.$cp.'</td>';
	echo '<td class="cel">'.($lvlTH>0?'<a href="build.php?newdid='.$vid.'&amp;s=24">'.($hasCel<>0?'<span id="timer'.$timer.'">'.$generator->getTimeFormat($hasCel-time()).'</span>':'●').'</a>':'&nbsp;').'</td>';
	echo '<td class="tro"><span class="">';
	$unit = $database->getUnit($vid);
	$tribe = $session->tribe;
	$siedler = $unit['u10'];
            $sett=$tribe*10;
	$siedlerp = '<img class="unit u'.$sett.'" src="img/x.gif" title="" alt="">';
	$senator = $unit['u9'];
	$senatorp = '<img class="unit u'.(($tribe-1)*10+9).'" src="img/x.gif" title="" alt="">';
	$i=1;
	while($i <=$siedler) {
		echo $siedlerp;
		$i++;
	}
	$s=1;
	while($s <=$senator) {
		echo $senatorp;
		$s++;
	}		
		
	echo '</span></td>';
	echo '<td class="slo lc">'.$exp.'/'.$maxslots.'</td>';
	$gesexp += $exp;
	$gesdorf += $maxslots;
	$gescp += $cp;
	$gessied += $siedler;
	$gessen += $senator;
	echo '</tr>';    
}
?>

<tr><td colspan="5" class="empty"></td></tr>

<tr class="sum">
	<th class="vil"><?=dorf10?></th>
	<td class="cps"><?php echo $gescp;?></td>
	<td class="cel none">&nbsp;</td>

	<td class="tro">
	<?php 	
	echo $gessied;
	echo $siedlerp;
	echo '&nbsp;';
	echo $gessen;
	echo $senatorp;
	?></td>
	<td class="slo"><?php echo $gesexp;echo '/';echo $gesdorf;?></td>
</tr></tbody></table>
