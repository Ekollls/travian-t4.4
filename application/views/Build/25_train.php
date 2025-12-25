<?php
$art=$database->checkArtefactsEffects($session->uid,$village->wid,5);
$slots = $database->getAvailableExpansionTraining($session->tribe,$village->wid);

if ($slots['settlers']+$slots['chiefs']>0) { ?>
<div class="clear"></div>
	<h4 class="round">Settler training</h4>

    <form method="POST" name="snd" action="build.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="ft" value="t1" />
        <div class="buildActionOverview trainUnits">
            <?php
            for ($i=9;$i<=10;$i++) {
                if($i==9 and ($technology->getTech(9))==1 or $i==10){
                    if ($slots['settlers']>0  || $slots['chiefs']>0 ) {
                        $maxunit = MIN($technology->maxUnit(($session->tribe-1)*10+$i),($i==10?$slots['settlers']:$slots['chiefs']));
                        $unit = (($session->tribe-1)*10+$i);
                        echo "<div class=\"action first\">
                                <div class=\"bigUnitSection\">
                                <a href=\"#\" onclick=\"return Travian.Game.iPopup(".$unit.", 1);\">
                                <img class=\"unitSection u".$unit."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($unit)."\">
                                </a>
                                <a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$unit.", 1);\">
                                    <img class=\"zoom\" src=\"img/x.gif\" alt=\"Zoom in\">
                                </a>
                                </div>
                                <div class=\"details\">
                                <div class=\"tit\">
                                    <a href=\"#\" onclick=\"return Travian.Game.iPopup(".$unit.", 1);\"><img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($unit)."\"></a>
                                    <a href=\"#\" onclick=\"return Travian.Game.iPopup(".$unit.", 1);\">".$technology->getUnitName($unit)."</a>
                                    <span class=\"furtherInfo\">(available:  ".$village->unitarray['u'.($unit-($session->tribe-1)*10)].")</span>
                                </div>
                                <div class=\"inlineIconList resourceWrapper\">
                                <div class=\"inlineIcon resource\"><i class=\"r1Big\"></i><span class=\"value value\">".(${'u'.$unit}['wood'])."</span></div>
                                <div class=\"inlineIcon resource\"><i class=\"r2Big\"></i><span class=\"value value\">".(${'u'.$unit}['clay'])."</span></div>
                                <div class=\"inlineIcon resource\"><i class=\"r3Big\"></i><span class=\"value value\">".(${'u'.$unit}['iron'])."</span></div>
                                <div class=\"inlineIcon resource\"><i class=\"r4Big\"></i><span class=\"value value\">".(${'u'.$unit}['crop'])."</span></div>
                                <div class=\"inlineIcon resource\"><i class=\"r5Big\"></i><span class=\"value value\">".${'u'.$unit}['pop']."</span></div>
                                </div><br>
                                <div class=\"inlineIcon duration\"><i class=\"infantryBonusTime_medium\"></i><span class=\"value \">";
               
                        $dur=round((${'u'.(($session->tribe-1)*10+$i)}['time'] * (${'bid'.$village->resarray['f'.$id.'t']}[$village->resarray['f'.$id]]['attri'] / 100) / SPEED * $art),5);
                        //    $dur = 10000;
                        echo $generator->getTimeFormat($dur);
                        echo '</span></div>';
                        echo '<div class="cta">';
                        if($session->gold >= 3 && $building->getTypeLevel(17) > 1) {
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
                                                    window.fireEvent('buttonClicked', [this, {"type":"button","value":"Exchange resources","name":"","id":"button5487115a9b649","class":"gold ","title":"Click here to exchange resources.","confirm":"","onclick":"","dialog":{"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"saveOnUnload":false,"data":{"cmd":"exchangeResources","defaultValues":{"tid":"1","nr":"1","btyp":"1","r1":<?=((${'u'.(($session->tribe-1)*10+$i)}['wood']))?>,"r2":<?=((${'u'.(($session->tribe-1)*10+$i)}['clay']))?>,"r3":<?=((${'u'.(($session->tribe-1)*10+$i)}['iron']))?>,"r4":<?=((${'u'.(($session->tribe-1)*10+$i)}['crop']))?>,"supply":"1","pzeit":0,"max1":0,"max2":0,"max3":0,"max4":0,"max":0},"did":"<?=$village->wid;?>"}}}]);
                                                });
                                            }
                                        });
                                    </script>
                        <?php
                        }
                        echo "<div class=\"status none\"></div><span class=\"value\">Quantity</span>
                        <input type=\"text\" class=\"text\" name=\"t".(($session->tribe-1)*10+$i)."\" value=\"0\" maxlength=\"".MAXLENGHT."\"><span class=\"value\"> / </span>
						<a href=\"#\" onClick=\"document.snd.t".(($session->tribe-1)*10+$i).".value=".$maxunit."; return false;\">".$maxunit."</a>
						</div></div>
                        <div class=\"clear\">&nbsp;</div><br />";
                        echo '</div>';
                    }
                }
            } ?>
            <div class="clear"></div></div>
        <button type="submit" name="s1" id="btn_train" value="ok" class="green startTraining">
            <div class="button-container addHoverClick ">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div><div class="button-content">Training</div>
            </div>
        </button>

    </form>
<?php
} else {
    echo '<div class="c">'.dvrc1.'</div>';
}
include ("26_progress.php");
?>