<div id="build" class="gid42">

<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo C3; ?>:</th>
			<td><b><?php echo round($bid42[$village->resarray['f'.$id]]['attri'], 0 ,PHP_ROUND_HALF_DOWN); ?></b> %</td>
		</tr><tr>
        <?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
        ?>
			<th><?php echo C4; ?> <?php echo $next; ?>:</th>

			<td><b><?php echo round($bid42[$next]['attri'], 0, PHP_ROUND_HALF_DOWN); ?></b> %</td>
            <?php

			}
            ?>
		</tr></table>

         </div>