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

    <table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">

        <thead><tr>

            <td>".mastr2."</td>

            <td>".mastr3."</td>

            <td>".mastr4."</td>

        </tr></thead>

        <tbody>";

        $TrainCount = 0;

        if(!isset($timer)){ $timer=1;}

        foreach ($trainlist as $train) {

            $TrainCount++;

            echo "<tr><td class=\"desc\">";

            echo "<img class=\"unit u" . ($train['unit']-60) . "\" src=\"img/x.gif\" alt=\"" . $train['name'] . "\" title=\"" . $train['name'] . "\" />";

            echo $train['amt'] . " " . $train['name'] . "</td><td class=\"dur\">";

            if ($TrainCount == 1) {

                echo "<span class='timer' counting='down' value='".$timer."'>" . $generator->getTimeFormat(round($train['eachtime'] * $train['amt'])) . "</span>";

            } else {

                echo $generator->getTimeFormat(round($train['eachtime'] * $train['amt']));

            }

            echo "</td><td class=\"fin\">";

            $time = $generator->procMTime($train['timestamp']);

            if ($time[0] != "today") {

                echo "on " . $time[0] . " at ";

            }

            echo $time[1];

        } ?>

        </tr>

        </tbody></table>

        <?php

		//echo "<font color=darkorange>Desativado pelo Multihunter :    </font>";

		if($session->gold >= 999999999) {

    //echo "<button type=\"button\"  class=\"green ".$disabl."\" onclick=\"return Travian.Game.buyplus(14,".HOWRES."); return false;\"><div class=\"button-container addHoverClick \">     <div class=\"button-background\">         <div class=\"buttonStart\">             <div class=\"buttonEnd\">                 <div class=\"buttonMiddle\"></div>             </div>         </div>     </div>     <div class=\"button-content\">".PLUS26."</div></div></button>";

} else {

    //echo "<button type=\"button\" class=\"gold \"  class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container\"><div class=\"button-position\"><div class=\"btl\"><div class=\"btr\"><div class=\"btc\"></div></div></div><div class=\"bml\"><div class=\"bmr\"><div class=\"bmc\"></div></div></div><div class=\"bbl\"><div class=\"bbr\"><div class=\"bbc\"></div></div></div></div><div class=\"button-contents\">".PLUS14."</div></div></button>";

    //echo "<button class=\"gold \" type=\"button\"  class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\"><div class=\"button-container addHoverClick \">     <div class=\"button-background\">         <div class=\"buttonStart\">             <div class=\"buttonEnd\">                 <div class=\"buttonMiddle\"></div>             </div>         </div>     </div>     <div class=\"button-content\">".pluss27."</div></div></button>";

}

?>

 <b>

                    

                    

                </b>

                

	

	

	<?php



    }



    ?>

