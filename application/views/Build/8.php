	<table id="build_value">
		<tr>
			<th><?=CURB?>:</th>
			<td><b><?php echo $bid8[$village->resarray['f'.$id]]['attri']; ?></b> <?php echo PERC;?></td>
		</tr>
		<tr>
		<?php
        $cur=$building->isCurrent($id);
        $loop=$building->isLoop($id);
        $master=$building->isMaster($id);
        if($cur+$loop+$master>0){
            foreach($building->buildArray as $bu){
                echo "<tr class=\"underConstruction\"><th>Production at the level ".$bu['level'].":</th> <td><span class=\"number\">".${'bid'.$bu['type']}[$bu['level']]['attri']." ".PERC."</span> </td></tr>";
            }

        }
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {

        ?>
			<th><?=CURBL?> <?php echo $next; ?>:</th>
			<td><b><?php echo $bid8[$next]['attri']; ?></b> <?php echo PERC;?></td>
            <?php
            }
            ?>
		</tr>
	</table>
