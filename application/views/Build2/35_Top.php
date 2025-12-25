
<div id="build" class="gid35">

<table cellpadding="1" cellspacing="1" id="build_value">
    <tr>
        <th>Increased attack power:</th>
        <td><b><?php echo $bid35[$village->resarray['f'.$id]]['attri']; ?></b> %</td>
    </tr>
    <tr>
    <?php
    $cur=$building->isCurrent($id);
    $loop=$building->isLoop($id);
    $master=$building->isMaster($id);
    if($cur+$loop+$master>0){
        foreach($building->buildArray as $bu){
            echo "<tr class=\"underConstruction\"><th>Increased attack power ".$bu['level'].":</th> <td><span class=\"number\">".$bid35[$bu['level']]['attri']." %</span> </td></tr>";
        }

    }
    if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {

    ?>
        <th>Increased attack power <?php echo $next; ?>:</th>
        <td><b><?php echo $bid35[$next]['attri']; ?></b> %</td>
        <?php } ?>
    </tr>

</table>
</div>
