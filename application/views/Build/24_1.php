<div class="clear"></div>
		<?php
		$level = $village->resarray['f'.$id];
		$inuse = $village->currentcel;
		$time = time();
		$i = 1;
        echo "
<div class=\"build_details researches\">
	<div class=\"research\">
		<div class=\"information\">
			<div class=\"title\">
                <a>
                <img class=\"celebration celebrationSmall\" src=\"img/x.gif\" alt=\"".ratusha14."\">
                </a>
                <a>".ratusha14."</a>
                <span class=\"points\">(500 ".ratusha11.")</span>
            </div>
            <div class=\"inlineIconList resourceWrapper\">
                <div class=\"inlineIcon resource\"><i class=\"r1Big\"></i><span class=\"value value\">".$cel[$i]['wood']."</span></div>
                <div class=\"inlineIcon resource\"><i class=\"r2Big\"></i><span class=\"value value\">".$cel[$i]['clay']."</span></div>
                <div class=\"inlineIcon resource\"><i class=\"r3Big\"></i><span class=\"value value\">".$cel[$i]['iron']."</span></div>
                <div class=\"inlineIcon resource\"><i class=\"r4Big\"></i><span class=\"value value\">".$cel[$i]['crop']."</span></div>
            </div>
            <br>
            <div class=\"inlineIcon duration\"><i class=\"infantryBonusTime_medium\"></i><span class=\"value \">";
        echo $generator->getTimeFormat(round($cel[$i]['time'] * ($bid24[$building->getTypeLevel(24)]['attri'] / 100)/SPEED));
        echo "</span></div>";
        echo '<div class="cta">';
        //echo $village->resourceSUM;
        $totalNeed = $cel[$i]['wood'] + $cel[$i]['clay'] + $cel[$i]['iron'] + $cel[$i]['crop'];
                    if($session->gold >= 3 && $building->getTypeLevel(17) >= 1
                    && (($cel[$i]['wood'] > $village->awood || $cel[$i]['clay'] > $village->aclay || $cel[$i]['iron'] > $village->airon || $cel[$i]['crop'] > $village->acrop) && $totalNeed <= $village->resourceSUM ) 
                    ) {
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
                                        window.fireEvent('buttonClicked', [this, {"type":"button","value":"Exchange resources","name":"","id":"button5487115a9b649","class":"gold ","title":"Click here to exchange resources.","confirm":"","onclick":"","dialog":{"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"saveOnUnload":false,"data":{"cmd":"exchangeResources","defaultValues":{"tid":"1","nr":"1","btyp":"1","r1":<?=(($cel[$i]['wood']))?>,"r2":<?=(($cel[$i]['clay']))?>,"r3":<?=(($cel[$i]['iron']))?>,"r4":<?=(($cel[$i]['crop']))?>,"supply":"1","pzeit":0,"max1":0,"max2":0,"max3":0,"max4":0,"max":0},"did":"<?=$village->wid;?>"}}}]);
                                    });
                                }
                            });
                        </script>
                    <?php
                   }
        //echo "<div class=\"clear\"></div></div>";
				if($inuse > $time){
                    echo "<span class=\"none\">".ratusha3." ".ratusha4."</span>";
					}
                  else if($cel[$i]['wood'] > $village->awood || $cel[$i]['clay'] > $village->aclay || $cel[$i]['iron'] > $village->airon || $cel[$i]['crop'] > $village->acrop) {
					if($village->getProd("crop")>0){
	                   	$time = $technology->calculateAvaliable(24,$cel[$i]);
		                echo "<span class=\"none\">".ratusha11." ".$time[0]." at ".$time[1]."</span></td>";
					} else {
						echo "<span class=\"none\">".ratusha5."</span></td>";
					}
                    echo "<td class=\"act\"><div class=\"none\">".ratusha6." ".ratusha7."</div></td></tr>";
                }
                else {

                    echo "<button type=\"button\" value=\"\" class=\"green\" onclick=\"window.location.href = 'build.php?id=$id&type=1'; return false;\">
						<div class=\"button-container addHoverClick\">
  <div class=\"button-background\">
   <div class=\"buttonStart\">
    <div class=\"buttonEnd\">
     <div class=\"buttonMiddle\"></div>
    </div>
   </div>
  </div>
  <div class=\"button-content\">".ratusha8."</div>
						</div>
					</button>";
                }
        echo "</div><div class=\"clear\"></div></div></div></div>";
			if($level >= 10){
                $i=2;
		$level = $village->resarray['f'.$id];
                echo "
<div class=\"build_details researches\">
<div class=\"research\">
<div class=\"information\">
<div class=\"title\">
<a>
<img class=\"celebration celebrationSmall\" src=\"img/x.gif\" alt=\"".ratusha9."\">
</a>
<a>".ratusha9."</a>
<span class=\"points\">(2000 ".ratusha11.")</span>
</div>
<div class=\"inlineIconList resourceWrapper\">
<div class=\"inlineIcon resource\"><i class=\"r1Big\"></i><span class=\"value value\">".$cel[$i]['wood']."</span></div>
<div class=\"inlineIcon resource\"><i class=\"r2Big\"></i><span class=\"value value\">".$cel[$i]['clay']."</span></div>
<div class=\"inlineIcon resource\"><i class=\"r3Big\"></i><span class=\"value value\">".$cel[$i]['iron']."</span></div>
<div class=\"inlineIcon resource\"><i class=\"r4Big\"></i><span class=\"value value\">".$cel[$i]['crop']."</span></div>
</div>
<br>
<div class=\"inlineIcon duration\"><i class=\"infantryBonusTime_medium\"></i><span class=\"value \">";
echo $generator->getTimeFormat(round($cel[$i]['time'] * ($bid24[$building->getTypeLevel(24)]['attri'] / 100)/SPEED));
                echo "</span></div>";
                echo '<div class="cta">';
                if($session->gold >= 3 && $building->getTypeLevel(17) >= 1
                && (($cel[$i]['wood'] > $village->awood || $cel[$i]['clay'] > $village->aclay || $cel[$i]['iron'] > $village->airon || $cel[$i]['crop'] > $village->acrop) && $totalNeed <= $village->resourceSUM ) 
                ) {

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
                           
                            <script type="text/javascript">
                                window.addEvent('domready', function()
                                {
                                    if($('button<?=crc32($i)?>'))
                                    {
                                        $('button<?=crc32($i)?>').addEvent('click', function ()
                                        {
                                            window.fireEvent('buttonClicked', [this, {"type":"button","value":"Exchange resources","name":"","id":"button5487115a9b649","class":"gold ","title":"Click here to exchange resources.","confirm":"","onclick":"","dialog":{"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"saveOnUnload":false,"data":{"cmd":"exchangeResources","defaultValues":{"tid":"1","nr":"1","btyp":"1","r1":<?=(($cel[$i]['wood']))?>,"r2":<?=(($cel[$i]['clay']))?>,"r3":<?=(($cel[$i]['iron']))?>,"r4":<?=(($cel[$i]['crop']))?>,"supply":"1","pzeit":0,"max1":0,"max2":0,"max3":0,"max4":0,"max":0},"did":"<?=$village->wid;?>"}}}]);
                                        });
                                    }
                                });
                            </script>
                        <?php }
        //echo "<div class=\"clear\"></div></div></div>";
        if($inuse > $time){
            echo "<span class=\"none\">".ratusha3." ".ratusha4."</span>";
        }
        else if($cel[$i]['wood'] > $village->awood || $cel[$i]['clay'] > $village->aclay || $cel[$i]['iron'] > $village->airon || $cel[$i]['crop'] > $village->acrop) {
            if($village->getProd("crop")>0){
                $time = $technology->calculateAvaliable(24,$cel[$i]);
                echo "<span class=\"none\">".ratusha11." ".$time[0]." at ".$time[1]."</span></td>";
            } else {
                echo "<span class=\"none\">".ratusha5."</span></td>";
            }
            echo "<td class=\"act\"><div class=\"none\">".ratusha6." ".ratusha7."</div></td></tr>";
        }
        else {

            echo "
                	<button type=\"button\" value=\"\" class=\"green\" onclick=\"window.location.href = 'build.php?id=$id&type=2'; return false;\">
						<div class=\"button-container addHoverClick\">
  <div class=\"button-background\">
   <div class=\"buttonStart\">
    <div class=\"buttonEnd\">
     <div class=\"buttonMiddle\"></div>
    </div>
   </div>
  </div>
  <div class=\"button-content\">".ratusha8."</div>
						</div>
					</button>";
        }
        echo "</div><div class=\"clear\"></div></div></div></div>";
            }
?>

