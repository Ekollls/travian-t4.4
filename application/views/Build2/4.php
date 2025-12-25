<?php 
if($session->qData['quest'] == 5 && $session->qData['step1'] == 0){ 
	$database->query("UPDATE quests SET step1 = 1 WHERE userid = ".$session->uid."");
}

?><table  id="build_value">
	<tr>
		<th><?php echo CUR_PROD; ?></th>
		<td><b><?php echo $bid4[$village->resarray['f'.$id]]['prod']* SPEED; ?></b> <?php echo PER_HR; ?></td>
	</tr>
	<tr>
	 <?php
     $cur=$building->isCurrent($id);
     $loop=$building->isLoop($id);
     $master=$building->isMaster($id);
     if($cur+$loop+$master>0){
         foreach($building->buildArray as $bu){
             echo "<tr class=\"underConstruction\"><th>Etat level ".$bu['level'].":</th> <td><span class=\"number\">".${'bid'.$bu['type']}[$bu['level']]['prod']* SPEED." ".PER_HR."</span> </td></tr>";
         }

     }
    if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
    ?>
	<tr>
		<th><?php echo NEXT_PROD; echo $next; ?>:</th>
		<td><b><?php echo $bid4[$next]['prod']* SPEED; ?></b> <?php echo PER_HR; ?></td>
	</tr>
    <?php
    }
    ?>

</table>

