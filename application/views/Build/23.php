<div id="build" class="gid23">
	<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th><?=TA2?></th>
<?php
		if($session->tribe == 3) {
		?>
		<td><b><?php echo $bid23[$village->resarray['f'.$id]]['attri']*2*CRANNY_CAP; ?></b> <?=TA3?></td>
		<?php
			}else{
		?>
		<td><b><?php echo $bid23[$village->resarray['f'.$id]]['attri']*CRANNY_CAP; ?></b> <?=TA3?></td>
		<?php
			}
		?>
	</tr>
	<tr>
<?php
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
        ?>
		<th><?=TA4?> <?php echo $village->resarray['f'.$id]+1+$loopsame+$doublebuild; ?>:</th>
<?php
		if($session->tribe == 3) {
		?>
		<td><b><?php echo $bid23[$village->resarray['f'.$id]+1+$loopsame+$doublebuild]['attri']*2*CRANNY_CAP; ?></b> <?=TA3?></td>
		<?php
			}else{
		?>
		<td><b><?php echo $bid23[$village->resarray['f'.$id]+1+$loopsame+$doublebuild]['attri']*CRANNY_CAP; ?></b> <?=TA3?></td>
		<?php
			}}
        ?>
	</tr>
	</table>
</div>