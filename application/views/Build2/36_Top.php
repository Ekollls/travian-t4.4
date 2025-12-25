<table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo $lang['Build']['build36_01']; ?>:</th>

            <td><b><?php echo $bid36[$village->resarray['f'.$id]]['attri']*TRAPPER_CAPACITY; ?></b> <?php echo $lang['Build']['build36_06']; ?></td>
        </tr>
        <tr>
            <?php
            $cur=$building->isCurrent($id);
            $loop=$building->isLoop($id);
            $master=$building->isMaster($id);
            if($cur+$loop+$master>0){
                foreach($building->buildArray as $bu){
                    echo "<tr class=\"underConstruction\"><th>Etat level ".$bu['level'].":</th> <td><span class=\"number\">".${'bid'.$bu['type']}[$bu['level']]['attri']*TRAPPER_CAPACITY."</span> Traps </td></tr>";
                }

            }
            if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
                $next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
                if($next<=20){
                    ?>
                    <th>Maximum traps to train at level <?php echo $next; ?>:</th>
                    <td><b><?php echo $bid36[$next]['attri']*TRAPPER_CAPACITY; ?></b> Traps</td>
                <?php
                }else{
                    ?>
                    <th>Maximum traps to train at level 20:</th>
                    <td><b><?php echo $bid36[20]['attri']*TRAPPER_CAPACITY; ?></b> Traps</td>
                <?php
                }
            }
            ?>

        </tr>
    </table>