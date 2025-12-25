<div id="build" class="gid20">
<div class="clear"></div>
	<h4 class="round">Training Knights</h4>

    <?php if ($building->getTypeLevel(20) > 0) { ?>
        <form method="POST" name="snd" action="build.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="hidden" name="ft" value="t1"/>
            <div class="buildActionOverview trainUnits">
            <?php
                $art=$database->checkArtefactsEffects($session->uid,$village->wid,5);
                $success = 0;
                if($session->heroD['wref']!=$village->wid){
                    $bonuses['stable']=1;
                }else{
                    $bonuses=$database->allHeroBonuses($database->getHeroInventory($session->uid));
                }
                switch($session->tribe){
                    case 1: $uniq=4; break;
                    case 2: $uniq=15; break;
                    case 3: $uniq=23; break;
                    case 6: $uniq=54; break;
                    case 7: $uniq=63; break;
                }
                $drinking=array(1=>10,2=>15,3=>20);
                $drink=0;
                for($i=$uniq;$i<=($session->tribe-1)*10+6;$i++) {
                    $drink++;
                    if($technology->getTech(($i-($session->tribe-1)*10))) {
                        echo "<div class=\"action first\">
                                    <div class=\"bigUnitSection\">
                                        <a onclick=\"return Travian.Game.iPopup(".$i.", 1);\">
                                            <img class=\"unitSection u".$i."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\">
                                        </a>
                                        <a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$i.", 1);\">
                                            <img class=\"zoom\" src=\"img/x.gif\" alt=\"zoom in\">
                                        </a>
                                    </div>
                                    <div class=\"details\">
                                        <div class=\"tit\">
                                            <a onclick=\"return Travian.Game.iPopup($i,1);\"><img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\"></a>
                                            <a onclick=\"return Travian.Game.iPopup($i,1);\">".$technology->getUnitName($i)."</a>
                                            <span class=\"furtherInfo\">(available: ".$village->unitarray['u'.($i-($session->tribe-1)*10)].")</span>
                                        </div>
                                        <div class=\"inlineIconList resourceWrapper\">
                                        <div class=\"inlineIcon resource\"><i class=\"r1Big\"></i><span class=\"value value\">".(${'u'.$i}['wood'])."</span></div>
                                        <div class=\"inlineIcon resource\"><i class=\"r2Big\"></i><span class=\"value value\">".(${'u'.$i}['clay'])."</span></div>
                                        <div class=\"inlineIcon resource\"><i class=\"r3Big\"></i><span class=\"value value\">".(${'u'.$i}['iron'])."</span></div>
                                        <div class=\"inlineIcon resource\"><i class=\"r4Big\"></i><span class=\"value value\">".(${'u'.$i}['crop'])."</span></div>
                                        <div class=\"inlineIcon resource\"><i class=\"r5Big\"></i><span class=\"value value\">".(($session->tribe==1 &&  $drinking[$drink]<= $building->getTypeLevel(41)) ? (${'u'.$i}['pop']-1) : (${'u'.$i}['pop']))."</span></div>
                                        </div><br>
                                        <div class=\"inlineIcon duration\"><i class=\"infantryBonusTime_medium\"></i><span class=\"value \">";
                                        $dur=round((${'u'.$i}['time'] * ($bid20[$village->resarray['f'.$id]]['attri'] / 100) * (($building->getTypeLevel(41)>=1 and $session->tribe==1)?(1/$bid41[$building->getTypeLevel(41)]['attri']):1) / SPEED * $art*$bonuses['stable']),5);
                                        if($p->pAData('fasterTraining')){$dur = round($dur - (0.25 * $dur));}
                                        $dur=$generator->getTimeFormat($dur);
                                        echo $dur.'</span></div>';
                                        echo '<div class="cta">';
                                        if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
                                                //echo "&nbsp;&nbsp;<button id='button".crc32($i)."' type=\"button\" value=\"npc\" class=\"icon\">&nbsp;<img src=\"img/x.gif\" style=\"margin-top:6px;\" class=\"npc\" alt=\"npc\"></button>";
                                                ?>
                                                    <button type="button" class="gold exchange <?php echo $isDisabled ? 'disabled': ''; ?>"  onfocus="jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;" id="button<?php echo crc32($i); ?>">
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
                                                                    window.fireEvent('buttonClicked', [this, {"type":"button","value":"Exchange resources","name":"","id":"button5487115a9b649","class":"gold ","title":"Click here to exchange resources.","confirm":"","onclick":"","dialog":{"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"saveOnUnload":false,"data":{"cmd":"exchangeResources","defaultValues":{"tid":"1","nr":"1","btyp":"1","r1":<?=((${'u'.$i}['wood'])*$technology->maxUnitPlus($i))?>,"r2":<?=((${'u'.$i}['clay'])*$technology->maxUnitPlus($i))?>,"r3":<?=((${'u'.$i}['iron'])*$technology->maxUnitPlus($i))?>,"r4":<?=((${'u'.$i}['crop'])*$technology->maxUnitPlus($i))?>,"supply":"1","pzeit":0,"max1":0,"max2":0,"max3":0,"max4":0,"max":0},"did":"<?=$village->wid;?>"}}}]);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                <?php }
                                                    echo "<div class=\"status none\"></div><span class=\"value\">Quantity</span>
                                                    <input type=\"text\" class=\"text\" name=\"t".$i."\" value=\"0\" maxlength=\"".MAXLENGHT."\">
                                                    <span class=\"value\"> / </span>
                                                    <a href=\"#\" onClick=\"document.snd.t".$i.".value=".$technology->maxUnit($i,false)."; return false;\">".$technology->maxUnit($i,false)."</a>
                                                </div></div>
                                                <div class=\"clear\"></div><br />";
                                                echo '</div>';
                                    $success += 1;
                                        }
                                    }
                                    if($success == 0) {
                                        echo "<tr><td colspan=\"3\"><div class=\"none\" align=\"center\">".KO2."</div></td></tr>";
                                    }

                ?>

        <div class="clear"></div></div>

            <?php if($success) {?>

                <button type="submit"  class="green startTraining">
                <div class="button-container addHoverClick ">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div><div class="button-content"><?= mastr1 ?></div>
                </div>
            </button>

            <?php } ?>

        </form>

    <?php

    } else {
        echo "<b>". KA3." </b><br>\n";

    }
    $trainlist = $technology->getTrainingList(2);
    include_once("trainList.php");
    ?>

    </div>

    <div class="clear">&nbsp;</div>

    <div class="clear"></div>