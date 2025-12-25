<div class="clear"></div>
<h4 class="round">Improved weapons and armor</h4>
<div class="build_details researches">
    <?php
    $abdata = $database->getABTech($village->wid);
    $ABups = $technology->getABUpgrades('a'); 

    for($i=($session->tribe*10-9),$ii=0;$i<=($session->tribe*10-2);$i++) { 
        $j = $i % 10 ;

        if ( $technology->getTech(($i-(($session->tribe-1)*10))) || $j == 1 ) {
            if($ii != 0){
                echo "<hr>";
            }
            $ii++;
            if(count($ABups) && $ABups[0]['tech']=="a".($i-(($session->tribe-1)*10))){$abdata['a'.$j]+=1;}
            echo "<div class=\"research\">
                <div class=\"bigUnitSection\">
                    <a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.", 1);\">
                        <img class=\"unitSection u".$i."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\">
                    </a>
                    <a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$i.");\">
                        <img class=\"zoom\" src=\"img/x.gif\" alt=\"Zoom\">
                    </a>
		    </div>
		<div class=\"information\">
            <div class=\"title\">
            <a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.", 1);\">
            <img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\"></a>
            <a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.", 1);\">".$technology->getUnitName($i)."</a>
            <span class=\"level\">".LVL." ".$abdata['a'.$j]."</span>
        </div>";
            if($abdata['a'.$j] != 20) {
                echo "<div class=\"inlineIconList resourceWrapper\">
                    <div class=\"inlineIcon resource\"><i class=\"r1Big\"></i><span class=\"value value\">".${'ab'.$i}[$abdata['a'.$j]+1]['wood']."</span></div>
                    <div class=\"inlineIcon resource\"><i class=\"r2Big\"></i><span class=\"value value\">".${'ab'.$i}[$abdata['a'.$j]+1]['clay']."</span></div>
                    <div class=\"inlineIcon resource\"><i class=\"r3Big\"></i><span class=\"value value\">".${'ab'.$i}[$abdata['a'.$j]+1]['iron']."</span></div>
                    <div class=\"inlineIcon resource\"><i class=\"r4Big\"></i><span class=\"value value\">".${'ab'.$i}[$abdata['a'.$j]+1]['crop']."</span></div>
                </div>
                <br>
                <div class=\"cta\">
                <div class=\"inlineIcon duration\"><i class=\"clock_medium\"></i><span class=\"value \">";
                echo $generator->getTimeFormat(round(${'ab'.$i}[$abdata['a'.$j]+1]['time']*($bid12[$building->getTypeLevel(12)]['attri'] / 100)/SPEED));
                echo "</span></div><br>";

                $totalRes = ${'ab'.$i}[$abdata['a'.$j]+1]['wood'] + ${'ab'.$i}[$abdata['a'.$j]+1]['clay'] + ${'ab'.$i}[$abdata['a'.$j]+1]['iron'] + ${'ab'.$i}[$abdata['a'.$j]+1]['crop'];
				if($session->gold >= 3 && $building->getTypeLevel(17) >= 1 
				&& (${'ab'.$i}[$abdata['a'.$j]+1]['wood'] > $village->awood || ${'ab'.$i}[$abdata['a'.$j]+1]['clay'] > $village->aclay || ${'ab'.$i}[$abdata['a'.$j]+1]['iron'] > $village->airon || ${'ab'.$i}[$abdata['a'.$j]+1]['crop'] > $village->acrop) 
					&& $totalRes <= $village->resourceSUM) {
                    //echo "&nbsp;&nbsp;<button id='button".crc32($i)."' type=\"button\" value=\"npc\" class=\"icon\">&nbsp;<img src=\"img/x.gif\" style=\"margin-top:6px;\" class=\"npc\" alt=\"npc\"></button>";
                    ?>
								<button type="button" class="gold exchange <?php echo $isDisabled ? 'disabled': ''; ?>"  onfocus="jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;" id="button<?=crc32($i)?>">
								<div class="button-container addHoverClick">
								<div class="button-background">
									<div class="buttonStart">
										<div class="buttonEnd">
											<div class="buttonMiddle"></div>
										</div>
									</div>
								</div>
								<div class="button-content">Sharing resources</div></div></button>

                    <script type="text/javascript">
                        window.addEvent('domready', function()
                        {
                            if($('button<?=crc32($i)?>'))
                            {
                                $('button<?=crc32($i)?>').addEvent('click', function ()
                                {
                                    window.fireEvent('buttonClicked', [this, {"type":"button","value":"Exchange resources","name":"","id":"button5487115a9b649","class":"gold ","title":"Click here to exchange resources.","confirm":"","onclick":"","dialog":{"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"saveOnUnload":false,"data":{"cmd":"exchangeResources","defaultValues":{"tid":"1","nr":"1","btyp":"1","r1":<?=((${'ab'.$i}[$abdata['a'.$j]+1]['wood']))?>,"r2":<?=((${'ab'.$i}[$abdata['a'.$j]+1]['clay']))?>,"r3":<?=((${'ab'.$i}[$abdata['a'.$j]+1]['iron']))?>,"r4":<?=((${'ab'.$i}[$abdata['a'.$j]+1]['crop']))?>,"supply":"1","pzeit":0,"max1":0,"max2":0,"max3":0,"max4":0,"max":0},"did":"<?=$village->wid;?>"}}}]);
                                });
                            }
                        });
                    </script>
                <?php
                }
                
            }else{
                echo "<div class=\"cta\">";
            }
            
            if (${'ab'.$i}[$abdata['a'.$j]+1]['wood'] > $village->maxstore || ${'ab'.$i}[$abdata['a'.$j]+1]['clay'] > $village->maxstore || ${'ab'.$i}[$abdata['a'.$j]+1]['iron'] > $village->maxstore) {
                echo "<span class=\"none\">Upgrade Warehouse</span>";
            }
            else if (${'ab'.$i}[$abdata['a'.$j]+1]['crop'] > $village->maxcrop) {
                echo "<span class=\"none\">Upgrade Granary</span>";
            }
            else if (${'ab'.$i}[$abdata['a'.$j]+1]['wood'] > $village->awood || ${'ab'.$i}[$abdata['a'.$j]+1]['clay'] > $village->aclay || ${'ab'.$i}[$abdata['a'.$j]+1]['iron'] > $village->airon || ${'ab'.$i}[$abdata['a'.$j]+1]['crop'] > $village->acrop) {
                if($village->getProd("crop")>0){
                    $time = $technology->calculateAvaliable(12,${'ab'.$i}[$abdata['a'.$j]+1]);
                    echo "<span class=\"none\">Will be available Resources ".$time[0]." in a ".$time[1]."</span>";
                } else {
                    echo "<span class=\"none\">Wheat production is negative, there will never be enough resources</span>";
                }
                //echo "<div class=\"contractLink\"><span class=\"none\">few resources</span></div>"; // estava em comentario epico
            }else if ($building->getTypeLevel(12) <= $abdata['a'.$j]) {
                if ($abdata['a'.$j] == 20){
                    echo "<span class=\"none\">".kuzupg0." </span>";
                }else{
                    echo "<span class=\"none\">".kuzupg1."</span>";
                }
            }else if (count($ABups) > 1) {
                echo "<span class=\"none\">".kuzupg2."</span>";
            }else {

                echo "<button type=\"button\" value=\"Upgrade level\" class=\"green\" onclick=\"window.location.href = 'build.php?id=$id&amp;a=$j&amp;c=$session->mchecker'; return false;\">
                    <div class=\"button-container addHoverClick\">
                    <div class=\"button-background\">
                    <div class=\"buttonStart\">
                        <div class=\"buttonEnd\">
                        <div class=\"buttonMiddle\"></div>
                        </div>
                    </div>
                    </div>
                    <div class=\"button-content\">".KZ2."</div></button>";
                    
            }
            echo '</div>'; // for cta class

            echo "</div>
            <div class=\"clear\"></div>
            </div>";
        }
        
    }
    
    ?>
</div>


<?php

if(count($ABups) > 0) {
    echo "<table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\"><thead><tr><td>".KZ5."</td><td>".KZ6."</td><td>".KZ7."</td></tr>
</thead><tbody>";
    if(!isset($timer)) {
        $timer = 1;
    }
    foreach($ABups as $black) {
        $unit = ($session->tribe-1)*10 + substr($black['tech'],1,2);
        echo "<tr><td class=\"desc\"><img class=\"unit u$unit\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($unit)."\" title=\"".$technology->getUnitName($unit)."\" />".$technology->getUnitName($unit)."</td>";
        echo "<td class=\"dur\"><span class=\"timer\" counting=\"down\" value=\"".($black['timestamp']-time())."\">".$generator->getTimeFormat($black['timestamp']-time())."</span></td>";
        $date = $generator->procMtime($black['timestamp']);
        echo "<td class=\"fin\"><span>".$date[1]."</span><span> </span></td>";
        echo "</tr>";
        $timer +=1;
    }
    echo "</tbody></table>";
}
?>
