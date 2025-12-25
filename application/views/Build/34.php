    <div id="build" class="gid34">

	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Current stability bonus:</th>
			<td><b><?php echo $bid34[$village->resarray['f'.$id]]['attri']; ?></b> <?=PERC?>
		</tr>
		<tr>
		<?php
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {

		if($next<=20){
        ?>
			<th>Stability bonus at level <?php echo $next; ?>:</th>
			<td><b><?php echo $bid34[$next]['attri']; ?></b> <?=PERC?>
            <?php
            }else{
        ?>
			<th>Stability bonus at level 20:</th>
			<td><b><?php echo $bid34[20]['attri']; ?></b> <?=PERC?>
            <?php
			}}
            ?>
		</tr>
	</table>
</div>