<?php
$success = 0;
			$art=$database->checkArtefactsEffects($session->uid,$village->wid,5);
if($session->heroD['wref']!=$village->wid){
  $bonuses['stable']=1;
}else{
    $bonuses=$database->allHeroBonuses($database->getHeroInventory($session->uid));
}
    for ($i=($session->tribe-1)*10+3;$i<=($session->tribe-1)*10+6;$i++) {
        if ($i <> 3 && $i <> 13 && $i <> 14 && $i <> 53 && $technology->getTech(($i-($session->tribe-1)*10))) {

            echo "<div class=\"action first\">
                	<div class=\"bigUnitSection\">
						<a >
							<img class=\"unitSection u".$i."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\">
						</a>
						<a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$i.");\">
							<img class=\"zoom\" src=\"img/x.gif\" alt=\"zoom in\">
						</a>
					</div>
					<div class=\"details\">
						<div class=\"tit\">
							<a ><img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\"></a>
							<a >".$technology->getUnitName($i)."</a>
							<span class=\"furtherInfo\">(Available: ".$village->unitarray['u'.($i-($session->tribe-1)*10)].")</span>
						</div>
                        <div class=\"showCosts\">
                        <span class=\"resources r1\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Fa\">".(${'u'.$i}['wood']*3)."</span>
                        <span class=\"resources r2\"><img class=\"r2\" src=\"img/x.gif\" alt=\"Agyag\">".(${'u'.$i}['clay']*3)."</span>
                        <span class=\"resources r3\"><img class=\"r3\" src=\"img/x.gif\" alt=\"Vasérc\">".(${'u'.$i}['iron']*3)."</span>
                        <span class=\"resources r4\"><img class=\"r4\" src=\"img/x.gif\" alt=\"Búza\">".(${'u'.$i}['crop']*3)."</span>
                        <span class=\"resources r5\"><img class=\"r5\" src=\"img/x.gif\" alt=\"Búzafogyasztás\">".${'u'.$i}['pop']."</span>
                        <div class=\"clear\"></div>
                        <span class=\"clocks\"><img class=\"clock\" src=\"img/x.gif\" alt=\"óra\">";$dur=round((${'u'.$i}['time'] * ($bid30[$village->resarray['f'.$id]]['attri'] * ($building->getTypeLevel(41)>=1?(1/$bid41[$building->getTypeLevel(41)]['attri']):1) / 100) / SPEED * $art*$bonuses['stable']),5);
                        if($p->pAData('fasterTraining')){$dur = round($dur - (0.25 * $dur));}
                        $dur=$generator->getTimeFormat($dur);
                echo $dur;      
            if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
                echo "&nbsp;&nbsp;<button id='button".crc32($i)."' type=\"button\" value=\"npc\" class=\"icon\">&nbsp;<img src=\"img/x.gif\" style=\"margin-top:6px;\" class=\"npc\" alt=\"npc\"></button>";
                ?>
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
            <?php
            }
            echo "</span><div class=\"clear\"></div></div><span class=\"value\"></span>
						<input type=\"text\" class=\"text\" name=\"t$i\" value=\"0\" maxlength=\"".MAXLENGHT."\">
                        <span class=\"value\"> / </span>
						<a href=\"#\" onClick=\"document.snd.t".$i.".value=".$technology->maxUnit($i,true)."; return false;\">".$technology->maxUnit($i,true)."</a>
					</div></div>
					<div class=\"clear\"></div><br />";
            $success += 1;
        }
    }
if($success == 0) {
    echo "<tr><td colspan=\"3\"><div class=\"none\"><center>".KO2."</center></div></td></tr>";
}
