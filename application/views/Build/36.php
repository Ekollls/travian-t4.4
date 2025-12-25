
    <p><?php echo sprintf($lang['Build']['build36_04'],$village->unitarray['u99'],$village->unitarray['o99']);?></p>

    <div class="clear"></div>
    <?php if ($building->getTypeLevel(36) > 0) { ?>
        <form method="POST" name="snd" action="build.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="ft" value="t1" />
            <?php
            $train_amt=0;
            $trainlist = $technology->getTrainingList(8);
            foreach($trainlist as $train) {
                $train_amt += $train['amt'];
            }

            $max = $technology->maxUnit(99,false);
            $max1 = 0;
            for($i=19;$i<41;$i++){
                if($village->resarray['f'.$i.'t'] == 36){
                    $max1 += $bid36[$village->resarray['f'.$i]]['attri']*TRAPPER_CAPACITY;
                }
            }
            if($max > $max1 - ($village->unitarray['u99'] + $train_amt)){
                $max = $max1 - ($village->unitarray['u99'] + $train_amt);
            }
            if($max < 0){
                $max = 0;
            }
            ?>
            <tr>
                <div class="buildActionOverview trainUnits">
                    <div class="action">
                        <div class="details">
                            <div class="tit">
                                <a href="#" onclick="return Travian.Game.iPopup(36, 4);"><img class="unit u99" src="img/x.gif" alt="Trap"></a>
                                <a href="#" onclick="return Travian.Game.iPopup(36, 4);">Trap</a>
                                <span class="furtherInfo">(available:  <?php echo $village->unitarray['u99']; ?>)</span>
                            </div>

                            <div class="inlineIconList resourceWrapper">
                                <div class="inlineIcon resource"><i class="r1Big"></i><span class="value value">35</span></div>
                                <div class="inlineIcon resource"><i class="r2Big"></i><span class="value value">30</span></div>
                                <div class="inlineIcon resource"><i class="r3Big"></i><span class="value value">10</span></div>
                                <div class="inlineIcon resource"><i class="r4Big"></i><span class="value value">20</span></div>
                                <div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span class="value value">0</span></div>
                            </div>
                            <br>
                            <div class="inlineIcon duration"><i class="maxTraps_medium"></i><span class="value "><?php $dur=$generator->getTimeFormat(round(${'u99'}['time'] * ($bid19[$village->resarray['f'.$id]]['attri'] / 100) / SPEED)); echo ($dur=="00:00:00")? "00:00:01":$dur; ?></span></div>
                            <div class="cta">
                            <?php if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) { ?>
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
                                                    window.fireEvent('buttonClicked', [this, {"type":"button","value":"Exchange resources","name":"","id":"button5487115a9b649","class":"gold ","title":"Click here to exchange resources.","confirm":"","onclick":"","dialog":{"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"saveOnUnload":false,"data":{"cmd":"exchangeResources","defaultValues":{"tid":"1","nr":"1","btyp":"1","r1":35,"r2":30,"r3":10,"r4":20,"supply":"1","pzeit":0,"max1":0,"max2":0,"max3":0,"max4":0,"max":0},"did":"<?=$village->wid;?>"}}}]);
                                                });
                                            }
                                            <?php } ?>
                                        });
                                    </script>

                            <?php } ?> 
                            
                            <span class="value">Quantity</span> <input type="text" class="text" name="t999" value="0" maxlength="<?=MAXLENGHT?>"><span class="value">
			/ </span> <a href="#" onClick="document.snd.t999.value=<?php echo $max; ?>; return false;"><?php echo $max; ?></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </tr>
            </div>
            <button type="submit" value="ok" name="s1" id="s1" class="green startTraining">
                <div class="button-container addHoverClick ">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div><div class="button-content"><?php echo $lang['Build']['Train']; ?></div>
                </div>
            </button>
            
        </form>
        
    <?php
    } else {
        echo "<b>Training can commence when trapper are completed.</b><br>\n";
    }
    if(count($trainlist) > 0) {
        echo "<h4 class=\"round spacer\">".$lang['buildings']['texts']['TRA0']."</h4>";
        echo "
    <table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
		<thead><tr>
			<td>".$lang['Build']['Train01']."</td>
			<td>".$lang['Build']['Train02']."</td>
			<td>".$lang['Build']['Train03']."</td>
		</tr></thead>
		<tbody>";
        $TrainCount = 0;
        if(!isset($timer)){ $timer=1;}
        foreach($trainlist as $train) {
            $TrainCount++;
            echo "<tr><td class=\"desc\">";
            echo "<img class=\"unit u".$train['unit']."\" src=\"img/x.gif\" alt=\"".U99."\" title=\"".U99."\" />";
            echo $train['amt']." ".U99."</td><td class=\"dur\">";
            if ($TrainCount == 1 ) {
                echo "<span class='timer' counting='down' value='".($train['timestamp']-time())."'>".$generator->getTimeFormat($train['timestamp']-time())."</span>";
            } else {
                echo $generator->getTimeFormat($train['eachtime']*$train['amt']);
            }
            echo "</td><td class=\"fin\">";
            $time = $generator->procMTime($train['timestamp']);
            if($time[0] != "today") {
                echo $time[0]." ".$lang['Build']['on']." ";
            }
            echo $time[1];
        } ?>
        </tr>
        </tbody></table>
    <?php } ?>
    </p>