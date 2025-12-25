<?php
if($session->qData['quest'] == 6 && $session->qData['step1'] == 0){ 
    $database->query("UPDATE quests SET step1 = 1 WHERE userid = ".$session->uid."");
    header('Location: hero_inventory.php');
}

if($session->qData['quest'] == 13 && $session->qData['step1'] == 0){ 
    $database->query("UPDATE quests SET step1 = 1 WHERE userid = ".$session->uid."");
    header('Location: hero_inventory.php');
}

if ($tribe == 1) {
    $tp = 100;
} else {
    $tp = 80;
}


ob_start();
$availiblepoint = $session->heroD['level'] * 4;

$freepoints = $availiblepoint - ($session->heroD['power'] + $session->heroD['offBonus'] + $session->heroD['defBonus'] + $session->heroD['product']);
$rp = 3 * SPEED * $session->heroD['product'];
?>
<div id="attributes" class="hero-<?php echo $session->heroD['dead'] == 1 ? 'dead' : 'alive'; ?>">
<?php if ($session->heroD['dead'] == 0) { ?>
<div class="roundedCornersBox lightGreen">
<div class="boxes-tl"></div>
<div class="boxes-tr"></div>
<div class="boxes-tc"></div>
<div class="boxes-ml"></div>
<div class="boxes-mr"></div>
<div class="boxes-mc"></div>
<div class="boxes-bl"></div>
<div class="boxes-br"></div>
<div class="boxes-bc" ></div>
    <div class="boxes-contents cf">

        <div class="attribute heroStatus">
            <div class="heroStatusMessage ">
            <?php echo $heroF->printHeroSt(); ?>  
               	</div>

        </div>

        <div class="attribute heroStatus">
            <?php if($session->heroD['hide']==0){ echo HEROI39;}else{ echo HEROI40;}?></div>

            <table cellspacing="0" cellpadding="0" class="transparent attributes noPointsToSet">
	<tbody>

		<tr class="attribute health tooltip" title="<?php echo HEROI25?>||<?php echo HEROI44;?>">
		<td class="element attribName"><?php echo HEROI25; ?></td>
                        <td class="element current powervalue">
                            <span class="value" style="font-size: 11px;"><?php echo round($session->heroD['health']); ?>%</span>
                        </td>
                        <td class="element progress">
                            <div class="bar-bg">
                                <div class="bar" style="width:<?php echo $session->heroD['health']; ?>%;"></div>
                                <div class="clear"></div>
                            </div>
                        </td>
                        <td class="element pointsValueSetter sub"></td>
                        <td class="element points"></td>
                        <td class="element pointsValueSetter add"></td>
                    </tr>
                    <tr class="attribute experience tooltip" title="<?php if($session->heroD['level']!=100){  ?><?=HEROI33?>||<?php echo HEROI31.' '; echo($hero_levels[$session->heroD['level'] + 1] - $session->heroD['experience']); ?> <?=HEROI32?> <?php echo($session->heroD['level'] + 1); ?> <?php  }else{ echo 'Достигнут максимальный уроinень'; } ?>.">
                        <td class="element attribName"><?php echo HEROI33; ?></td>
                        <td class="element current powervalue">
                            <span class="value" style="font-size: 11px;"><?php echo $session->heroD['experience']; ?></span>
                        </td>
                        <td class="element progress">
                            <div class="bar-bg">
                                <div class="bar" style="width:<?php
                                if($session->heroD['level']!=100){
                                    $width = round(100 * (($hero_levels[$session->heroD['level']] - $session->heroD['experience']) /($hero_levels[$session->heroD['level']] - $hero_levels[$session->heroD['level'] + 1])), 1);
                                    if($width >= 0){
                                        echo $width;
                                    }else{
                                        echo 0;
                                    }
                                
                                }else { echo '100';} ?>%;"></div>
                                <div class="clear"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
					<span class="speed tooltip">
						<?php echo $lang['Hero']['Speed']; ?>:<strong id="heroSpeedValueNumber"><?php echo $session->heroD['speed'] * INCREASE_SPEED; ?></strong> <?php echo HEROI38;?></span>
                        </td>
                        <td class="pointsText" colspan="4">
                            <div class="production tooltip" title="<?php echo HEROI43?>||<?php echo HEROI47;?>&lt;br /&gt;&lt;span class=&quot;
            heroAttributeInformation&quot;&gt;<?php echo HEROI43?>&lt;img title=&quot;inсе ресурсы&quot; alt=&quot;
            inсе ресурсы&quot; class=<?php if($session->heroD['r0'] != 0)
            { echo 'r0';} elseif($session->heroD['r1'] != 0)
            { echo 'r1';} elseif($session->heroD['r2'] != 0)
            { echo 'r2';} elseif($session->heroD['r3'] != 0)
            { echo 'r3';} else {echo 'r4';}?> src=&quot;img/x.gif&quot; /&gt;<?php if ($session->heroD['r0'] != 0) { echo number_format($rp);} else{ echo number_format($session->heroD['product']* 10 * SPEED);}?>
             &lrm;&amp;#x202d;&amp;#x202d;&amp;#x202c;&amp;#x202c;&lrm;&lt;/span&gt;">
							<span class="current"><?php echo HEROI43;?> 
														<img alt="All" class="<?php if($session->heroD['r0'] != 0)
                { echo 'r0';} elseif($session->heroD['r1'] != 0)
                { echo 'r1';} elseif($session->heroD['r2'] != 0)
                { echo 'r2';} elseif($session->heroD['r3'] != 0)
                { echo 'r3';} else {echo 'r4';}?>" src="img/x.gif"> 
							<span class="value" style="font-size: 11px;"><?php if ($session->heroD['r0'] != 0) { echo number_format($rp);} else{ echo number_format($session->heroD['product']* 10 * SPEED);}?></span>
														

							+ <img alt="Crop" class="r4" src="img/x.gif"> <span class="current">6</span></span>        
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>


</div>
</div>
<?php } ?>
<?php if ($session->heroD['dead'] == 1) { ?>
<div class="roundedCornersBox lightRed">
    <div class="boxes-tl"></div>
    <div class="boxes-tr"></div>
    <div class="boxes-tc"></div>
    <div class="boxes-ml"></div>
    <div class="boxes-mr"></div>
    <div class="boxes-mc"></div>
    <div class="boxes-bl"></div>
    <div class="boxes-br"></div>
    <div class="boxes-bc" ></div>
    <div class="boxes-contents cf">
    <div class="attribute heroStatus">
<?php 

    $vRes = ($village->awood + $village->aclay + $village->airon + $village->acrop);
    $hRes = ($hero_t[$session->heroD['level']]['wood'] + $hero_t[$session->heroD['level']]['clay'] + $hero_t[$session->heroD['level']]['iron'] + $hero_t[$session->heroD['level']]['crop']);
    $checkT = $session->heroD['revivetime'] != 0;

    if (!$checkT) {
    ?>

        <div class="heroStatusMessage header error">
        <?php echo $heroF->printHeroSt(); ?>  
             </div>
        </div>
        <div class="attribute regenerate tooltip"
             title="<?=HEROI23?> <?php echo $session->heroD['autoregen'] * INCREASE_SPEED; ?>% <?=HEROI24?></font>">

             <div class="element attributesHeadline">
                            <?php echo $lang['Hero']['Revive01']; ?> <a href="karte.php?d=<?php echo $session->heroD['wref']; ?>"><?php echo $database->getVillage($session->heroD['wref'])['name']; ?></a>. <?php echo $lang['Hero']['Revive02']; ?> <a href="karte.php?d=<?php echo $village->wid; ?>"><?php echo $village->vname; ?></a>.
                            </div>
                        <div class="element attributesHeadline"><?php echo $lang['Hero']['Revive03']; ?></div>
                        <div class="element attributesHeadline"></div>
                        <div class="roundedCornersBox white">
                            <div class="element resourceDemandCaption"><?php echo $lang['Hero']['Revive04']; ?>:
                            </div>      
				
                <div class="clear"></div>

					
        <div class="inlineIconList resourceWrapper">
        <div class="inlineIcon resource"><i class="r1Big"></i><span class="value value"><?php echo $hero_t[$session->heroD['level']]['wood']; ?></span></div>
        <div class="inlineIcon resource"><i class="r2Big"></i><span class="value value"><?php echo $hero_t[$session->heroD['level']]['clay']; ?></span></div>
        <div class="inlineIcon resource"><i class="r3Big"></i><span class="value value"><?php echo $hero_t[$session->heroD['level']]['iron']; ?></span></div>
        <div class="inlineIcon resource"><i class="r4Big"></i><span class="value value"><?php echo $hero_t[$session->heroD['level']]['crop']; ?></span></div>
        <div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span class="value value">6</span></div>
					
        </div>
        <div class="lineWrapper">
        <div class="inlineIcon duration"><i class="clock_medium"></i><span class="value "><?php echo $generator->getTimeFormat(($hero_t[$session->heroD['level']]['time'] / SPEED * 1.5)); ?></span></div>             
                  
				<button type="submit"  value="Revive" name="save" id="save" class="green startTraining" onclick="window.location.href = 'hero_inventory.php?revive=1'; return false;">
                                            <div class="button-container addHoverClick ">
                                                <div class="button-background">
                                                    <div class="buttonStart">
                                                        <div class="buttonEnd">
                                                            <div class="buttonMiddle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-content"><?=HEROI28?></div>
                                            </div>
                                        </button>
										<?php if ($hero_t[$session->heroD['level']]['wood'] > $village->awood ||
												  $hero_t[$session->heroD['level']]['clay'] > $village->aclay ||
												  $hero_t[$session->heroD['level']]['iron'] > $village->airon ||
												  $hero_t[$session->heroD['level']]['crop'] > $village->acrop) { ?>
										
                            <button type="button" value="" class="icon"
                                    onclick="window.location.href = 'build.php?s=17&amp;t=3&amp;r1=<?php echo $hero_t[$session->heroD['level']]['wood']; ?>&amp;r2=<?php echo $hero_t[$session->heroD['level']]['clay']; ?>&amp;r3=<?php echo $hero_t[$session->heroD['level']]['iron']; ?>&amp;r4=<?php echo $hero_t[$session->heroD['level']]['crop']; ?>'; return false;">
                                <img src="img/x.gif" class="npc" alt="npc"></button>
                                </div>
                            <div class="clear"></div>
							<?php }?>
                        </div>
                    </div>
                
                    <div class="clear"></div>
                <?php }else{ // hero is in revive
                    ?>
                    <div class="heroStatusMessage header warning">
                        <img alt="Held tot!" src="img/x.gif" class="heroStatus101Regenerate">
                        <?php echo $lang['Hero']['Revive05']; ?> <a href="karte.php?d=<?php echo $session->heroD['wref']; ?>"><?php echo $database->getVillage($session->heroD['wref'])['name']; ?></a> : <?php echo $lang['Hero']['Revive06']; ?> <span class="timer " counting="down" value="<?php echo ($session->heroD['revivetime'] - time()); ?>"><?php echo $generator->getTimeFormat($session->heroD['revivetime'] - time()); ?></span>
                    
                    <?php
                    
                    echo '</div>'; }
            ?>
        </div>

        <div class="clear"></div>
    </div>
</div>
<?php } ?>	

<div class="roundedCornersBox">
<h4>
    <div class="openCloseSwitchBar">
        <img alt="<?php echo $lang['Hero']['Attributes']; ?>" src="img/x.gif" class="openedClosedSwitch switchOpened">
        <span class="title"><?php echo $lang['Hero']['Attributes']; ?></span>
        <span class="heroAttributesFormMessage notice hide"><?php echo $lang['Hero']['saveChanges']; ?></span>
        <div class="clear"></div>
    </div>
</h4>

<div class="heroPropertiesContent <?php if($freepoints<=0 && $session->qData['quest'] != 6){echo 'hide';}?>">
    <div class="attribute res" id="setResource">

        <div class="changeResourcesHeadline"><?=HEROI21?></div>
        <div class="clear"></div>
            <div class="resourcePick">

            <div class="resource r0">
            <label for="resourceHero0">

                <input type="radio"   name="resource" value="0"
                       id="resourceHero0" <?php if ($session->heroD['r0'] != 0) {
                    echo $checked = "checked";
                } ?>>
                    <i class="r0"></i>
                    <span class="current"> <?php if($rp > 10000){echo $rp/1000;echo 'k'; }else {echo $rp;}  ?></span>
                </label>
            </div>


            <div class="resource r1">
            <label for="resourceHero1">
               <input type="radio" name="resource" value="1"
                       id="resourceHero1" <?php if ($session->heroD['r1'] != 0) {
                    echo $checked = "checked";
                } ?> <?php echo $form->getRadio('resource', 1); ?>>
                <i class="r1"></i>
                    <span class="current"> <?php if(($session->heroD['product']*10*SPEED) > 10000){echo ($session->heroD['product']* 10
                            * SPEED)/1000;echo 'k'; }else {echo $session->heroD['product']* 10 * SPEED;}  ?></span>
                </label>
            </div>
            
            <div class="resource r2">
            <label for="resourceHero2">
                <input type="radio"  name="resource" value="2"
                       id="resourceHero2" <?php if ($session->heroD['r2'] != 0) {
                    echo $checked = "checked";
                } ?> <?php echo $form->getRadio('resource', 2); ?>>
                
                <i class="r2"></i>
                    <span class="current"> <?php if(($session->heroD['product']*10*SPEED) > 10000){echo ($session->heroD['product']* 10
                            * SPEED)/1000;echo 'k'; }else {echo $session->heroD['product']* 10 * SPEED;}  ?></span>
                </label>
            </div>
            
            <div class="resource r3">
            <label for="resourceHero3">
                <input type="radio"  name="resource" value="3"
                       id="resourceHero3" <?php if ($session->heroD['r3'] != 0) {
                    echo $checked = "checked";
                } ?> <?php echo $form->getRadio('resource', 3); ?>>
                
                <i class="r3"></i>
                    <span class="current"> <?php if(($session->heroD['product']*10*SPEED) > 10000){echo ($session->heroD['product']* 10
                            * SPEED)/1000;echo 'k'; }else {echo $session->heroD['product']* 10 * SPEED;}  ?></span>
                </label>
            </div>
            
            <div class="resource r4" >
            <label for="resourceHero4">
                <input type="radio"  name="resource" value="4"
                       id="resourceHero4" <?php if ($session->heroD['r4'] != 0) {
                    echo $checked = "checked";
                } ?> <?php echo $form->getRadio('resource', 4); ?>>
                
                <i class="r4"></i>
                    <span class="current"> <?php if(($session->heroD['product']*10*SPEED) > 10000){echo ($session->heroD['product']* 10
                            * SPEED)/1000;echo 'k'; }else {echo $session->heroD['product']* 10 * SPEED;}  ?></span>
                </label>
            </div>
        </div>
    </div>
    <div class="clear"></div>

            <div class="attribute attackBehaviour">
                <div class="changeResourcesHeadline"><?=HEROI41?></div>
                <div class="options">
		<input type="radio" class="radio" name="attackBehaviour" id="attackBehaviour" value="hide"  <?php if($session->heroD['hide']==1){ echo 'checked="checked"'; }?>> <label for="attackBehaviourHide"><?=HEROI40?> </label><br />
		<input type="radio" class="radio" name="attackBehaviour" id="attackBehaviour" value="fight"  <?php if($session->heroD['hide']==0){ echo 'checked="checked"'; }?>> <label for="attackBehaviourFight"><?=HEROI39?></label>
</div>

            </div>
<div class="clear"></div>


    <table id="attributesOfHero" cellspacing="0" cellpadding="0" class="transparent attributes">
        <thead>
        <tr>
        <th class="headline"><?=HEROI0?></th>
            <?php if($freepoints>0){?>
            <th class="pointsText" colspan="3">
                <?=HEROI50?>			</th>
            <th class="pointsValue">
                <span id="availablePoints"><?=$freepoints?></span>/<?=$freepoints?>				</th>
            <th></th>
            <?php } ?>
        </tr>
        </thead>

        <tbody>

        <tr id="attributepower" class="attribute power" title="<?=HEROI8?>||<?=HEROI7?><br><span class='heroAttributeInformation'><?php echo $lang['Hero']['FStrength']; ?>: ‎‭‭<?php echo (100 + $tp * $session->heroD['power'] + $session->heroD['itempower']); ?> <?php echo $lang['Hero']['FHero']; ?></span>">
            <td class="element attribName tooltip"><?=HEROI8?></td>
        <td class="element current powervalue tooltip">
            <span class="value">‎‭‭<?php echo (100 + $tp * $session->heroD['power'] + $session->heroD['itempower']); ?>‬‬‎</span>
        </td>
        <td class="element progress tooltip">
            <div class="bar-bg">
                <div class="bar" style="width:<?php echo $session->heroD['power']; ?>%;"></div>
                <div class="bar setted" style="width: 0%;"></div>
                <div class="clear"></div>
            </div>
            <?php if($freepoints <= 0) { ?> <td class="element points"><?php echo $session->heroD['power']; }?></td>
        </td>



    <?php if ($session->heroD['power'] < 100 AND $freepoints > 0) {
        ?>
        <td class="element pointsValueSetter sub">
            <a class="setPoint disabled" href="#"></a>
        </td>
        <td class="element points">
            <input type="text" class="text" value="<?php echo $session->heroD['power'];?>" name="attributepower">
        </td>
        <td class="element pointsValueSetter add">
            <a class="setPoint" href="#"></a>
        </td>
    <?php } ?>
    <tr id="attributeoffBonus" class="attribute offBonus" title="<?=HEROI14?>||<?=HEROI13?>">
        <td class="element attribName tooltip">
            <?=HEROI14?>					</td>
        <td class="element current powervalue tooltip">
            <span class="value"><?php echo round($session->heroD['offBonus'])/5; ?></span>%
        </td>
        <td class="element progress tooltip">
            <div class="bar-bg">
                <div class="bar" style="width:<?php echo $session->heroD['offBonus']; ?>%;"></div>
                <div class="bar setted" style="width: 0%;"></div>
                <div class="clear"></div>
            </div>
			<?php if($freepoints <= 0) { ?> <td class="element points"><?php echo $session->heroD['offBonus']; }?></td>
        </td>
        <?php if ($session->heroD['offBonus'] < 100 AND $freepoints > 0) {
            ?>
            <td class="element pointsValueSetter sub">
                <a class="setPoint disabled" href="#"></a>
            </td>
            <td class="element points">
                <input type="text" class="text" value="<?php echo $session->heroD['offBonus'];?>" name="attributeoffBonus">
            </td>
            <td class="element pointsValueSetter add">
                <a class="setPoint" href="#"></a>
            </td>
        <?php } ?>
       </tr>
    <tr id="attributedefBonus" class="attribute defBonus" title="<?=HEROI16?>||<?=HEROI15?>">
        <td class="element attribName tooltip">
            <?=HEROI16?>					</td>
        <td class="element current powervalue tooltip">
            <span class="value"><?php echo round($session->heroD['defBonus'])/5; ?></span>%
        </td>
        <td class="element progress tooltip">
            <div class="bar-bg">
                <div class="bar" style="width:<?php echo $session->heroD['defBonus']; ?>%;"></div>
                <div class="bar setted" style="width: 0%;"></div>
                <div class="clear"></div>
            </div>
			<?php if($freepoints <= 0) { ?> <td class="element points"><?php echo $session->heroD['defBonus']; }?></td>
        </td>
        <?php if ($session->heroD['defBonus'] < 100 AND $freepoints > 0) {
            ?>
            <td class="element pointsValueSetter sub">
                <a class="setPoint disabled" href="#"></a>
            </td>
            <td class="element points">
                <input type="text" class="text" value="<?php echo $session->heroD['defBonus'];?>" name="attributedefBonus">
            </td>
            <td class="element pointsValueSetter add">
                <a class="setPoint" href="#"></a>
            </td>
        <?php } ?>
        </tr>
    <tr id="attributeproductionPoints" class="attribute productionPoints" title="<?=HEROI19?>||<?=HEROI17?>.">
        <td class="element attribName tooltip">
            <?=HEROI19?>				</td>
        <td class="element current powervalue tooltip">
            <span class="value"><?php echo $session->heroD['product']; ?></span>
        </td>
        <td class="element progress tooltip">
            <div class="bar-bg">
                <div class="bar" style="width:<?php echo $session->heroD['product']; ?>%;"></div>
                <div class="bar setted" style="width: 0%;"></div>
                <div class="clear"></div>
            </div>
			<?php if($freepoints <= 0) { ?> <td class="element points"><?php echo $session->heroD['product']; }?></td>
        </td>
        <?php if ($session->heroD['product'] < 100 AND $freepoints > 0) {
            ?>
            <td class="element pointsValueSetter sub">
                <a class="setPoint disabled" href="#"></a>
            </td>
            <td class="element points">
                <input type="text" class="text" value="<?php echo $session->heroD['product'];?>" name="attributeproductionPoints">
            </td>
            <td class="element pointsValueSetter add">
                <a class="setPoint" href="#"></a>
            </td>
        <?php } ?>

</table>
<div class="saveHeroAttributes">
    <button type="button" value="save changes" name="saveHeroAttributes" id="saveHeroAttributes"   class="green disabled" disabled="">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?=HEROI51?></div>
        </div>
    </button>
    <script type="text/javascript">
        window.addEvent('domready', function()
        {
            if($('saveHeroAttributes'))
            {
                $('saveHeroAttributes').addEvent('click', function ()
                {
                    window.fireEvent('buttonClicked', [this, {"type":"button","value":"save changes","name":"saveHeroAttributes","id":"saveHeroAttributes","class":"green disabled","title":"","confirm":"","onclick":""}]);
                });
            }
        });
    </script>
</div>
<script type="text/javascript">
    window.addEvent('domready', function()
    {
        $$('.hero_inventory #attributes .openCloseSwitchBar').addEvent('click', function(e)
        {
            Travian.toggleSwitch($$('.hero_inventory #attributes .heroPropertiesContent'), $$('.hero_inventory #attributes .openCloseSwitchBar .openedClosedSwitch'));
            $$('.hero_inventory #attributes .openCloseSwitchBar .availablePoints').toggleClass('hide');
        });

        var attributeForm = new Travian.Game.Hero.Properties.PropertyForm();
        attributeForm.addInputElementByName('saveHeroAttributes');
        attributeForm.addInputElementByName('resource');
        attributeForm.addInputElementByName('attackBehaviour');
<?php if($freepoints>0){?>
        var propertySetterElement = new Travian.Game.Hero.PropertySetter(attributeForm,
            {
                element: 'attributesOfHero',
                elementAvailablePoints: 'availablePoints',
                availablePoints: <?=$freepoints?>,
                attributes:
                    [
                     <?php   if($session->heroD['power']<100){ ?>
                        new Travian.Game.Hero.PropertySetter.Attribute.Power(
                            {
                                id: 'power',
                                element: 'attributepower',
                                value: <?=$session->heroD['power']*100?>,
                                usedPoints: <?=$session->heroD['power']?>,
                                maxPoints: 100,
                                valueOfItems: <?=$session->heroD['itempower']?>,
                                valueBonus: 0    					})<?php  } if($session->heroD['offBonus']<100){ ?>
                        ,
                        new Travian.Game.Hero.PropertySetter.Attribute.OffBonus(
                        {
                            id: 'offBonus',
                            element: 'attributeoffBonus',
                            value: <?=round($session->heroD['offBonus'])/5?>,
                            usedPoints: <?=$session->heroD['offBonus']?>,
                            maxPoints: 100,
                            valueOfItems: 0,
                            valueBonus: 0    					})
                        <?php  } if($session->heroD['defBonus']<100){ ?>
                        ,    				    					new Travian.Game.Hero.PropertySetter.Attribute.DefBonus(
                        {
                            id: 'defBonus',
                            element: 'attributedefBonus',
                            value: <?=round($session->heroD['defBonus'])/5?>,
                            usedPoints: <?=$session->heroD['defBonus']?>,
                            maxPoints: 100,
                            valueOfItems: 0,
                            valueBonus: 0    					})
                        <?php  } if($session->heroD['product']<100){ ?>
                        ,
                        new Travian.Game.Hero.PropertySetter.Attribute.ProductionPoints(
                        {
                            id: 'productionPoints',
                            element: 'attributeproductionPoints',
                            value: <?=$rp?>,
                            usedPoints: <?=$session->heroD['product']?>,
                            maxPoints: 100,
                            valueOfItems: 0,
                            valueBonus: 0    					})  <?php }?>  				    			]
            });

        attributeForm.addElement('properties', propertySetterElement);
        attributeForm.onDirty(false);
        <?php } ?>
    });
</script>


</div>
</div>

</div>

