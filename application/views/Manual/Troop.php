<?php 
$idTroop = $_GET['s']; 


if($idTroop <= 10){
    $tribe = TRIBE1;
}elseif($idTroop > 10 && $idTroop <= 20){
    $tribe = TRIBE2;
}elseif($idTroop > 20 && $idTroop <= 30){
    $tribe = TRIBE3;
}elseif($idTroop > 50 && $idTroop <= 60){
    $tribe = TRIBE6;
}elseif($idTroop > 60 && $idTroop <= 70){
    $tribe = TRIBE7;
}else{
    $tribe = TRIBE5;
}
if($idTroop > 70){
    header('Location: manual.php');
}

//print_r($manual->getTroopRequirements($idTroop)) or die();
?>
<div class="cf">
    <p>
        <a class="manualBack arrow back" href="manual.php"><?php echo $lang['Manual']['Overview']; ?></a>
    </p>

    <h1 class="titleInHeader">
        <img class="unit u<?php echo $idTroop; ?>" src="img/x.gif" alt="<?php echo $technology->getUnitName($idTroop); ?>"> <?php echo $technology->getUnitName($idTroop); ?> <span class="tribe">(<?php echo $tribe; ?>)</span>
    </h1>

    <div class="bigUnitSection">
        <img class="unitSection u<?php echo $idTroop; ?>Section" src="img/x.gif" alt="<?php echo $technology->getUnitName($idTroop); ?>">
    </div>
    <div class="boxes boxesColor gray">
        <div class="boxes-tl"></div>
        <div class="boxes-tr"></div>
        <div class="boxes-tc"></div>
        <div class="boxes-ml"></div>
        <div class="boxes-mr"></div>
        <div class="boxes-mc"></div>
        <div class="boxes-bl"></div>
        <div class="boxes-br"></div>
        <div class="boxes-bc"></div>
        <div class="boxes-contents cf">
            <table id="troop_info" cellpadding="1" cellspacing="1">
                <tbody>
                <tr>
                    <td>
                        <div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r1"></i><span class="value "><?php echo ${'u'.$idTroop}['wood']; ?></span></div></div>
                    </td>
                    <td>
                        <div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r2"></i><span class="value "><?php echo ${'u'.$idTroop}['clay']; ?></span></div></div>
                    </td>
                    <td>
                        <div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r3"></i><span class="value "><?php echo ${'u'.$idTroop}['iron']; ?></span></div></div>
                    </td>
                    <td class="last">
                        <div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r4"></i><span class="value "><?php echo ${'u'.$idTroop}['crop']; ?></span></div></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img class="att_all" src="img/x.gif" alt="Dead force"><?php echo ${'u'.$idTroop}['atk']; ?></td>
                    <td>
                        <img class="def_i" src="img/x.gif" alt="Power time against"><?php echo ${'u'.$idTroop}['di']; ?></td>
                    <td>
                        <img class="def_c" src="img/x.gif" alt="Power time against"><?php echo ${'u'.$idTroop}['dc']; ?></td>
                    <td>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="boxes boxesColor gray">
        <div class="boxes-tl"></div>
        <div class="boxes-tr"></div>
        <div class="boxes-tc"></div>
        <div class="boxes-ml"></div>
        <div class="boxes-mr"></div>
        <div class="boxes-mc"></div>
        <div class="boxes-bl"></div>
        <div class="boxes-br"></div>
        <div class="boxes-bc"></div>
        <div class="boxes-contents cf">
            <table class="troopData" cellpadding="1" cellspacing="1">
                <tbody>
                <tr>
                    <th><?php echo $lang['Manual']['Speed']; ?></th>
                    <td><?php echo ${'u'.$idTroop}['speed']; ?> <?php echo $lang['Manual']['SpeedI']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $lang['Manual']['Carry']; ?></th>
                    <td><?php echo ${'u'.$idTroop}['cap']; ?> <?php echo $lang['Manual']['CarryI']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $lang['Manual']['FCrop']; ?></th>
                    <td>
                        <div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r5"></i><span class="value "><?php echo ${'u'.$idTroop}['pop']; ?></span></div></div>
                    </td>
                </tr>
                <tr>
                    <th><?php echo $lang['Manual']['TTime']; ?></th>
                    <?php 
                        $dur= round((${'u'.$idTroop}['time']  / SPEED),5);
                        $dur=$generator->getTimeFormat($dur);

                    ?>
                    <td><img class="clock" src="img/x.gif" alt="clock"><?php echo $dur; ?></td>
                </tr>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>
    </div>
    <div id="t_desc"><?php echo $lang['Manual'][$idTroop]; ?></div>
    <div class="clear"></div>
    <div id="prereqs"><b><?php echo $lang['Manual']['Prerequisites']; ?></b><br>
    <?php 

        foreach($manual->getTroopRequirements($idTroop) as $build => $level){            
                if($build){
                    if($x!=0){
                        echo ', ';
                    }
                    
                    echo '<a href="manual.php?typ=4&amp;s='.$build.'">'.$lang['buildings'][$build];
                    echo '</a> '.$lang['Manual']['Level'].' '.$level.'';
                    $x++;
                }
        }

        if($x == 0){
            echo $lang['Manual']['Nothing'];
        }
    ?>
    
    </div>
</div>