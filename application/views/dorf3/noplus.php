<table cellpadding="1" cellspacing="1" id="overview">
<thead>
<tr>
	<td><?=dorf5?></td>
	<td><?=dorf6?></td>
	<td><?=dorf7?></td>
	<td><?=dorf8?></td>
	<td><?=dorf9?></td>
</tr></thead><tbody>
<?php
$varray = $database->getProfileVillages($session->uid);
foreach($varray as $vil){
  $vid = $vil['wref'];
  $vdata = $database->getVillage($vid);
  if($vdata['capital'] == 1){$class = 'hl';}else{$class = '';}
  echo '
  <tr class="'.$class.'">
		   <td class="vil fc"><a href="dorf1.php?newdid='.$vid.'">'.$vdata['name'].'</a></td>
		   <td class="att"><span class="none">?</span></td>
		   <td class="bui"><span class="none">?</span></td>
		   <td class="tro"><span class="none">?</span></td>
		   <td class="tra lc"><a href="build.php?s=17">?/?</a></td>
	</tr>
  ';
}
?>
     </tbody>
</table>