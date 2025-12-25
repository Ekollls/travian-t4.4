<?php $idBuild = $_GET['s']; ?>
<div class="cf">
    <p>
        <a class="manualBack arrow back" href="manual.php"><?php echo $lang['Manual']['Overview']; ?></a>
    </p>

    <h1 class="titleInHeader"><img class="gebIcon g<?php echo $idBuild; ?>Icon" src="img/x.gif" alt="<?=$lang['buildings'][$idBuild];?>"> <?=$lang['buildings'][$idBuild];?></h1>
    <img class="building big black g<?php echo $idBuild == 12 ? 13 : $idBuild; ?>" src="img/x.gif" alt="Woodcutter">
    <p class="description">
        <?=$lang['desc'][$idBuild][0]?></p>
    <p class="costsHeader">
    <?php echo $lang['Manual']['CCTime']; ?> 1:<br>
    </p><div class="inlineIconList resourceWrapper">
        <div class="inlineIcon resource"><i class="r1Big"></i><span class="value value"><?php echo ${'bid'.$idBuild}[1]['wood']; ?></span></div>
        <div class="inlineIcon resource"><i class="r2Big"></i><span class="value value"><?php echo ${'bid'.$idBuild}[1]['clay']; ?></span></div>
        <div class="inlineIcon resource"><i class="r3Big"></i><span class="value value"><?php echo ${'bid'.$idBuild}[1]['iron']; ?></span></div>
        <div class="inlineIcon resource"><i class="r4Big"></i><span class="value value"><?php echo ${'bid'.$idBuild}[1]['crop']; ?></span></div>
        <div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span class="value value"><?php echo ${'bid'.$idBuild}[1]['pop']; ?></span></div>
    </div>
    <br>
    <div class="inlineIcon duration"><i class="clock_medium"></i><span class="value "><?php echo $generator->getTimeFormat(round((${'bid'.$idBuild}[1]['time']  / SPEED),5)); ?></span></div>
    <div id="prereqs"><b><?php echo $lang['Manual']['Prerequisites']; ?></b><br>
    <?php 
        

        foreach($manual->getBuildRequirements($idBuild) as $build => $level){
                if($build){
                    if($x!=0){
                        echo ', ';
                    }
                    echo '<a href="manual.php?typ=4&amp;s='.$build.'">'.($level ? $lang['buildings'][$build] : '<strike>'.$lang['buildings'][$build].'</strike>');
                    if($level){
                        echo '</a> '.$lang['Manual']['Level'].' '.$level.'';
                    }
                    $x++;
                }
            
            
        }

        if($x == 0){
            echo $lang['Manual']['Nothing'];
        }
    ?>

    
    </div>
</div>