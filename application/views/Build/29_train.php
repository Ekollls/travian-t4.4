<?php
$art=$database->checkArtefactsEffects($session->uid,$village->wid,5);
            if($session->heroD['wref']!=$village->wid){
                $bonuses['barrack']=1;
            }else{
                $bonuses=$database->allHeroBonuses($database->getHeroInventory($session->uid));
            }
                for ($i=($session->tribe-1)*10+1;$i<=($session->tribe-1)*10+4;$i++) {
                    if ($i <> 4 && $i <> 23 && $i <> 24 && $i <> 54 && $i <> 63 && $i <> 64 &&($technology->getTech((($i)-(( $session->tribe-1)*10))) || $i%10 == 1)) {
                        echo "<div class=\"action first\">
                                <div class=\"bigUnitSection\">
                                <a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.", 1);\">
                                    <img class=\"unitSection u".$i."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\">
                                </a>
                                <a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$i.", 1);\">
                                    <img class=\"zoom\" src=\"img/x.gif\" alt=\"Zoom in\">
                                </a>
                                </div>
                                <div class=\"details\">
                                <div class=\"tit\">
                                    <a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.", 1);\"><img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\"></a>
                                    <a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.", 1);\">".$technology->getUnitName($i)."</a>
                                    <span class=\"furtherInfo\">(available:  ".$village->unitarray['u'.($i-($session->tribe-1)*10)].")</span>
                                </div>
                                    <div class=\"inlineIconList resourceWrapper\">
                                    <div class=\"inlineIcon resource\"><i class=\"r1Big\"></i><span class=\"value value\">".(${'u'.$i}['wood']*3)."</span></div>
                                    <div class=\"inlineIcon resource\"><i class=\"r2Big\"></i><span class=\"value value\">".(${'u'.$i}['clay']*3)."</span></div>
                                    <div class=\"inlineIcon resource\"><i class=\"r3Big\"></i><span class=\"value value\">".(${'u'.$i}['iron']*3)."</span></div>
                                    <div class=\"inlineIcon resource\"><i class=\"r4Big\"></i><span class=\"value value\">".(${'u'.$i}['crop']*3)."</span></div>
                                    <div class=\"inlineIcon resource\"><i class=\"r5Big\"></i><span class=\"value value\">".${'u'.$i}['pop']."</span></div>
                                    </div><br>
                                    <div class=\"inlineIcon duration\"><i class=\"infantryBonusTime_medium\"></i><span class=\"value \">";
                                    $dur= round((${'u'.$i}['time'] * ($bid19[$village->resarray['f'.$id]]['attri'] / 100) / SPEED * $art*$bonuses['barrack']),5);
                                    if($p->pAData('fasterTraining')){$dur = round($dur - (0.25 * $dur));}
                                    $dur=$generator->getTimeFormat($dur);
                                    echo $dur.'</span></div>';
                                    echo '<div class="cta">';
                                    if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
                                        ?>
                                    <button type="button" class="gold exchange <?php echo $isDisabled ? 'disabled': ''; ?>"  onfocus="jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;" id="button<?php echo $i; ?>">
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
                                            <?php if(!$isDisabled){ ?>
                                            if($('button<?=$i;?>'))
                                            {
                                                $('button<?=$i;?>').addEvent('click', function ()
                                                {
                                                    window.fireEvent('buttonClicked', [this, {"type":"button","value":"Exchange resources","name":"","id":"button5487115a9b649","class":"gold ","title":"Click here to exchange resources.","confirm":"","onclick":"","dialog":{"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"saveOnUnload":false,"data":{"cmd":"exchangeResources","defaultValues":{"tid":"1","nr":"1","btyp":"1","r1":<?=((${'u'.$i}['wood'])*$technology->maxUnitPlus($i));?>,"r2":<?=((${'u'.$i}['clay'])*$technology->maxUnitPlus($i));?>,"r3":<?=((${'u'.$i}['iron'])*$technology->maxUnitPlus($i));?>,"r4":<?=((${'u'.$i}['crop'])*$technology->maxUnitPlus($i));?>,"supply":"1","pzeit":0,"max1":0,"max2":0,"max3":0,"max4":0,"max":0},"did":"<?=$village->wid;?>"}}}]);
                                                });
                                            }
                                            <?php } ?>
                                        });
                                    </script>
								    <?php }
            echo "</span><div class=\"clear\"></div></div><span class=\"value\"> </span>
                        <input type=\"text\" class=\"text\" name=\"t".$i."\" value=\"0\" maxlength=\"".MAXLENGHT."\">
                        <span class=\"value\"> / </span>
                        <a href=\"#\" onClick=\"document.snd.t".$i.".value=".$technology->maxUnit($i,true)."; return false;\">".$technology->maxUnit($i,true)."</a>
                    </div></div>
                    <div class=\"clear\"></div><br />";
        }
    }

