
<div id="build" class="gid39">
	<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th>Current capacity:</th>
		<td><b><?php echo $bid39[$village->resarray['f'.$id]]['attri']*STORAGE_MULTIPLIER; ?></b> units</td>
	</tr>

	<tr>
<?php
$cur=$building->isCurrent($id);
$loop=$building->isLoop($id);
$master=$building->isMaster($id);
if($cur+$loop+$master>0){
    foreach($building->buildArray as $bu){
        echo "<tr class=\"underConstruction\"><th>Etat level ".$bu['level'].":</th> <td><span class=\"number\">".${'bid'.$bu['type']}[$bu['level']]['attri']*STORAGE_MULTIPLIER."</span> </td></tr>";
    }

}
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {

        ?>
		<th>Capacity at level <?php echo $next ?>:</th>
		<td><b><?php echo $bid39[$next]['attri']*STORAGE_MULTIPLIER; ?></b> units</td>
        <?php
            }
            ?>
	</tr>
	</table>

</p></div>
