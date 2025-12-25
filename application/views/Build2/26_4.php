<table cellpadding="1" cellspacing="1" id="expansion">
<thead><tr>
	<th colspan="6"><a name="h2"></a><?=RE16?></th>
</tr>
<tr>
	<td colspan="2"><?=RE17?></td>
	<td><?=RE18?></td>
	<td><?=RE19?></td>
	<td><?=RE20?></td>
	<td><?=RE21?></td>
</tr></thead>
<tbody>
<?php
$slot=$database->ThreeExp($village->wid);
$slot1 = $slot['exp1'];
$slot2 = $slot['exp2'];
$slot3 = $slot['exp3'];

if($slot1 != 0 || $slot2 != 0 || $slot3 != 0){
	for($i=1; $i <= 3; $i++){
		if (${'slot'.$i}<>0) {
			$coor = $database->getCoor(${'slot'.$i});
			$vname = $database->getVillageField(${'slot'.$i},'name');
			$owner = $database->getVillageField(${'slot'.$i},'owner');
			$pop = $database->getVillageField(${'slot'.$i},'pop');
			$vcreated = $database->getVillageField(${'slot'.$i},'created');
			$ownername = $database->getUserField($owner,'username',0);
echo '
<tr>
<td class="ra">'.$i.'.</td>
<td class="vil"><a href="karte.php?d='.${'slot'.$i}.'&c='.$generator->getMapCheck(${'slot'.$i}).'">'.$vname.'</a></td>
<td class="pla"><a href="spieler.php?uid='.$owner.'">'.$ownername.'</a></td>
<td class="ha">'.$pop.'</td>
<td class="aligned_coords"><div class="cox">('.$coor['x'].'</div><div class="pi">|</div><div class="coy">'.$coor['y'].')</div></td>
<td class="dat">'.date('d-m-Y',$vcreated).'</td>
</tr>';
		}
	}
}
else{
echo '<tr><td colspan="6" class="none">'.RE22.'</td></tr>';
}
?>
</tbody></table>
