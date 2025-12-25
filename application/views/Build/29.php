<div class="clear"></div>
    <?php

    if ($building->getTypeLevel(29) > 0) { ?>

        <form method="POST" name="snd" action="build.php">

            <input type="hidden" name="id" value="<?php echo $id; ?>"/>

            <input type="hidden" name="ft" value="t3"/>

            <div class="buildActionOverview trainUnits">

                <?php

                include("29_train.php");

                ?>    <div class="clear"></div></div>

            <button type="submit"  class="green small">

                <div class="button-container addHoverClick ">

                    <div class="button-background">

                        <div class="buttonStart">

                            <div class="buttonEnd">

                                <div class="buttonMiddle"></div>

                            </div>

                        </div>

                    </div><div class="button-content"><?=mastr1?></div>

                </div>

            </button>

        </form>

            <?php

    } else {

        echo "<b>".KZ333."</b><br>\n";

    }

    $trainlist = $technology->getTrainingList(5);
	
	if (count($trainlist) > 0) {

      echo "
        <h4 class=\"round spacer\">".$lang['buildings']['texts']['TRA0']."    
    
        </h4>
<table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
    <thead><tr>
        <td>" . $lang['buildings']['texts']['TRA1'] . "</td>
        <td>" . $lang['buildings']['texts']['TRA2'] . "</td>
        <td>" . $lang['buildings']['texts']['TRA3'] . "</td>
    </tr></thead>
    <tbody>";
    $TrainCount = 0;
    if(!isset($timer)){ $timer=1;}
    foreach ($trainlist as $train) {
        $TrainCount++;
        echo "<tr><td class=\"desc\">";
        echo "<img class=\"unit u" . ($train['unit']-60) . "\" src=\"img/x.gif\" alt=\"\" title=\"\" />";
        echo $train['amt'] . " " . $train['name'] . "</td><td class=\"dur\">";
        if ($TrainCount == 1) {
            echo "<span class='timer' counting='down' value='".round($train['eachtime'] * $train['amt'])."'>" . $generator->getTimeFormat(round($train['eachtime'] * $train['amt'])) . "</span>";
        } else {
            echo $generator->getTimeFormat(round($train['eachtime'] * $train['amt']));
        }
        echo "</td><td class=\"fin\">";
        $time = $generator->procMTime($train['timestamp']);
        if ($time[0] != "today") {
            echo " $time[0]";
        }
        echo " " . $time[1];
    } ?>
    </tr>
    </tbody>	
    </table>
    <?php if(FINISH_ALL){ 
        if($session->gold < FINISH_ALL_COST){
            $isDisabled = TRUE;
        }
        ?>
    <br>
    <h4 class="round">Finish training with gold</h4>
    <?php
    //echo "<font color=darkorange>Desativado pelo Multihunter    :    </font>";
    echo "<button type=\"button\"  class=\"gold ".($isDisabled ? 'disabled' : '')."\" ".($isDisabled ? '' : "onclick=\"return Travian.Game.buyplus(14,".HOWRES."); return false;\"").">
        <div class=\"button-container addHoverClick \">
            <div class=\"button-background\">
                <div class=\"buttonStart\">
                    <div class=\"buttonEnd\">
                    <div class=\"buttonMiddle\"></div>
                </div>
            </div>
        </div>
    <div class=\"button-content\">"; 
    echo "".PLUS26." <img src=\"img\/x.gif\" class=\"goldIcon\" alt=\"\"><span class=\"goldValue\">".FINISH_ALL_COST."</span></div></div></button>";
    }
?>
<b>
                
</b>
                

<?php

}
?>