
<div id="build" class="gid14">

	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?=SPEEDB?>:</th>
			<td><b><?php echo $bid14[$village->resarray['f'.$id]]['attri']; ?></b> <?=PERC?></td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
        ?>
			<th><?=SPEEDBL?> <?php echo $next; ?>:</th>
			<td><b><?php echo $bid14[$next]['attri']; ?></b> <?=PERC?>
            <?php
            }
            ?>
		</tr>
	</table>
</div>
