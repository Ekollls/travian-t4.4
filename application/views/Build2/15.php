
<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo NGZ2; ?>:</th>
			<td><b><?php echo round($bid15[$village->resarray['f'.$id]]['attri']); ?></b> %</td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {

        ?>
			<th><?php echo NGZ3; ?> <?php echo $next; ?>:</th>
			<td><b><?php echo round($bid15[$next]['attri']); ?></b> %</td>
            <?php
            }
            ?>
		</tr>
	</table>
	
<?php 
include("upgrade.php");
if($village->resarray['f'.$id] >= 10){
	include("15_1.php");
}

?>

