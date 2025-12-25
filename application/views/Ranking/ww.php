<?php
if (WW == True)
{
$result=$database->Chekwwlvl();
    $wid0=$database->query("SELECT wref FROM vdata WHERE `owner`= 3 and `capital`='1'");
    $wid=$wid0[0]['wref'];
?>
    <h4 class="round"><?php echo STATISTIC27; ?></h4>
    <table cellpadding="1" cellspacing="1" id="wonder">
    <thead>
        <tr>
            <td></td>
            <td><?php echo OVERVIEW1; ?></td>
            <td><?php echo OVERVIEW17; ?></td>
            <td><?php echo OVERVIEW6; ?></td>
            <td><?php echo LEVEL; ?></td>
            <td><?=ATTACK?></td>

        </tr>
    </thead>
    <tbody>
        <?php
        $cont = 1;
        foreach ($result as $row)
        {
            $ally = $database->getAlliance($row['alliance']);
$att0=$database->query("SELECT endtime FROM movement WHERE `to`='".$row['vref']."' and `from` ='".$wid."' and `proc`='0' ORDER BY endtime ASC Limit 1");

        ?>
            <tr class="hover">
                <td class="ra"><?php echo $cont; $cont++; ?>.</td>
                <td class="pla"><?php echo "<a href=\"karte.php?d=" . $row['vref'] . "&amp;c=" . $generator->getMapCheck($row['vref']) . "\">"; ?><?php echo $row['username']; ?></a></td>
                <td class="nam"><?php echo $row['wwname']; ?></td>
                <td class="al"><a href="allianz.php?aid=<?php echo $ally['id']; ?>"><?php echo $ally['tag']; ?></a></td>
                <td class="lev"><?php echo $row['f99']; ?></td>
                <td><?php
                    if(count($att0)>0){
echo '<img src="img/x.gif" class="att1"  title="'.$generator->getTimeFormat($att0[0]["endtime"]-time()).'" />';
                    }
                ?>
                    </td>
           </tr>
        <?php
        }?>
    </tbody>
    </table>
        <?php
}
else
{
    header("Location: statistiken.php");
}
?>