<?php
$baracks = "disabled";
$workshop = "disabled";
$stable = "disabled";
$market_ = "disabled";
$builds = $village->resarray;
for($i=19;$i<=40;$i++){
	if($builds['f'.$i.'t']==19){
		$baracks = "";
		$bid = $i;
	}
	if($builds['f'.$i.'t']==21){
		$workshop = "";
		$wid = $i;
	}
	if($builds['f'.$i.'t']==20){
		$stable = "";
		$sid = $i;
	}
	if($builds['f'.$i.'t']==17){
		$market_ = "";
		$mid = $i;
        $lvlm=$builds['f'.$i];
	}
}
?>
<div id="sidebarAfterContent" class="sidebar afterContent">
	<div id="sidebarBoxActiveVillage" class="sidebarBox   ">
		<div class="sidebarBoxBaseBox">
			<div class="baseBox baseBoxTop">
				<div class="baseBox baseBoxBottom">
					<div class="baseBox baseBoxCenter"></div>
				</div>
			</div>
		</div>
		<div class="sidebarBoxInnerBox">
			<div class="innerBox header ">
			<div class="buttonsWrapper">
				<button type="button" id="button5229e5254faf9"	class="layoutButton workshop<?php if($session->plus){echo 'White';}else{ echo 'Black';}?> <?=$green?> <?php echo $workshop; ?>" onclick="return false;" title="<?php
		if(!$session->plus){
			echo "". DIRECT_LINK ." || ". NO_PLUS_ESI ." ";
			if($workshop==""){ echo "<br /><span class=&quot;warning&quot;>".dorf1_activateplus." "; echo "</span>";	} else{ echo "<br /><span class=&quot;warning&quot;>". dorf1_villageNameBox_7 .". ". dorf1_villageNameBox_8 ."."; echo "</span>";	}
		}else{
		if($workshop=="" && $session->plus){ echo dorf1_villageNameBox_14." || ";
			$min = (($session->tribe - 1) * 10 ) + 7;
			$max = (($session->tribe - 1) * 10 ) + 9;
			$training = $database->query("SELECT * FROM training WHERE `unit` < '".$max."' AND `unit` >= '".$min."' AND `vref` = '".$village->wid."'");
            $tra=0;
            foreach($training as $t){ $tra++; }
            if($tra!=0){ echo dorf1_villageNameBox_11." : ".$tra; }else{ echo dorf1_villageNameBox_11n; }
			} else{ echo "". dorf1_villageNameBox_7 .".<br /><span class=&quot;warning&quot;> ". dorf1_villageNameBox_8 ."."; echo "</span>";	}}
		?>">
		<div class="button-container addHoverClick">
			<i></i>
		</div>
		</button>
		<?php if($workshop=="" || !$session->plus){ ?>
	<script type="text/javascript">
		if($('button5229e5254faf9'))
		{
			$('button5229e5254faf9').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"<?=$green?>","onclick":"return false;","loadTitle":<?php if($workshop=="" && $session->plus){ echo "true"; } else{ echo "false"; } ?>,"boxId":"activeVillage","disabled":<?php if($workshop=="" && $session->plus){ echo "false"; } else{ echo "true"; } ?>,"speechBubble":"","class":"","id":"button5229e5254ffa5","redirectUrl":"<?php if($workshop=="" && $session->plus){ echo "build.php?id=" . $wid; } else{ echo ""; } ?>","redirectUrlExternal":""<?php if($workshop=="" && $session->plus){ echo ""; } else{ echo ",\"plusDialog\":{\"featureKey\":\"directLinks\",\"infoIcon\":\"http:/\/\t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer\"}"; } ?>}]);
			});
		}
	</script>
	<?php } ?>
	<button type="button" id="button5229e5254fc5c"	class="layoutButton stable<?php if($session->plus){echo 'White';}else{ echo 'Black';}?> <?=$green?> <?php echo $stable; ?> " onclick="return false;" title="<?php
		if(!$session->plus){
			echo "". DIRECT_LINK ."||". NO_PLUS_ESI ."";
			if($stable==""){ echo "<br /><span class=&quot;warning&quot;> ".dorf1_activateplus.""; echo "</span>";	} else{ echo "<br /><span class=&quot;warning&quot;>". dorf1_villageNameBox_5 .". ". dorf1_villageNameBox_6 ."."; echo "</span>";	}
		}else{
		if($stable=="" && $session->plus){ echo dorf1_villageNameBox_12." || ";
			$extra = $session->tribe == 3 ? 2 : 3;
			$min = (($session->tribe - 1) * 10 ) + 1 + $extra;
            $max = (($session->tribe - 1) * 10 ) + 7;
            
            // iRedux - Fixed
			$training = $database->query("SELECT * FROM training WHERE `unit` < '".$max."' AND `unit` >= '".$min."' AND `vref` = '".$village->wid."' ");
            $tra=0;
            foreach($training as $t){ $tra++; }
            if($tra!=0){ echo dorf1_villageNameBox_11." : ".$tra; }else{ echo dorf1_villageNameBox_11n; }
			} else{ echo "". dorf1_villageNameBox_5 .".<br /><span class=&quot;warning&quot;> ". dorf1_villageNameBox_6 ."."; echo "</span>";	}}
		?>">
		<div class="button-container addHoverClick">
			<i></i>
		</div>
		</button>
	<?php if($stable=="" || !$session->plus){ ?>
	<script type="text/javascript">
		if($('button5229e5254fc5c'))
		{
			$('button5229e5254fc5c').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"<?=$green?>","onclick":"return false;","loadTitle":<?php if($stable=="" && $session->plus){ echo "true"; } else{ echo "false"; } ?>,"boxId":"activeVillage","disabled":<?php if($stable=="" && $session->plus){ echo "false"; } else{ echo "true"; } ?>,"speechBubble":"","class":"","id":"button5229e5254ffa5","redirectUrl":"<?php if($stable=="" && $session->plus){ echo "build.php?id=" . $sid; } else{ echo ""; } ?>","redirectUrlExternal":""<?php if($stable=="" && $session->plus){ echo ""; } else{ echo ",\"plusDialog\":{\"featureKey\":\"directLinks\",\"infoIcon\":\"http:/\/\t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer\"}"; } ?>}]);
			});
		}
	</script>
	<?php } ?>
	<button type="button" id="button5229e5254fe6f"	class="layoutButton barracks<?php if($session->plus){echo 'White';}else{ echo 'Black';}?> <?=$green?> <?php echo $baracks; ?> " onclick="return false;" title="
	<?php
		if(!$session->plus){
			echo "". DIRECT_LINK ."||". NO_PLUS_ESI ."";
			if($baracks==""){ 
                echo "<br /><span class=&quot;warning&quot;>".dorf1_activateplus.""; echo "</span>";	
            } else{
                 echo "<br /><span class=&quot;warning&quot;>". dorf1_villageNameBox_3 .". ". dorf1_villageNameBox_4 ."."; echo "</span>";	
            }
		}else{
            
		if($baracks=="" && $session->plus){ echo dorf1_villageNameBox_10." || ";
			$min = (($session->tribe - 1) * 10 ) + 1;
			$max = $session->tribe == 3 ? 2 : 3;
            $max += $min;
            
            // iRedux - Fixed
			$training = $database->query("SELECT * FROM training WHERE `unit` < '".$max."' AND `unit` >= '".$min."' AND `vref` = '".$village->wid."' ");
            $tra=0;
            foreach($training as $t){ $tra++; }
            if($tra!=0){ echo dorf1_villageNameBox_11." : ".$tra; }else{ echo dorf1_villageNameBox_11n; }
		} else{ echo "". dorf1_villageNameBox_3 .".<br /><span class=&quot;warning&quot;> ". dorf1_villageNameBox_4 ."."; echo "</span>";	}}
		?>">
		<div class="button-container addHoverClick">
			<i></i>
		</div>
		</button>
		<?php if($baracks=="" || !$session->plus){ ?>
	<script type="text/javascript">
		if($('button5229e5254fe6f'))
		{
			$('button5229e5254fe6f').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"<?=$green?>","onclick":"return false;","loadTitle":<?php if($baracks=="" && $session->plus){ echo "true"; } else{ echo "false"; } ?>,"boxId":"activeVillage","disabled":<?php if($baracks=="" && $session->plus){ echo "false"; } else{ echo "true"; } ?>,"speechBubble":"","class":"","id":"button5229e5254ffa5","redirectUrl":"<?php if($baracks=="" && $session->plus){ echo "build.php?id=" . $bid; } else{ echo ""; } ?>","redirectUrlExternal":""<?php if($baracks=="" && $session->plus){ echo ""; } else{ echo ",\"plusDialog\":{\"featureKey\":\"directLinks\",\"infoIcon\":\"http:/\/\t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer\"}"; } ?>}]);
			});
		}
	</script><?php } ?><button type="button" id="button5229e5254ffa5"	class="layoutButton market<?php if($session->plus){echo 'White';}else{ echo 'Black';}?> <?=$green?> <?php echo $market_; ?> " onclick="return false;" title="<?php
		if(!$session->plus){
			echo "". DIRECT_LINK ."||". NO_PLUS_ESI ."";
            if($market_==""){
                echo "<br /><span class=&quot;warning&quot;>".dorf1_activateplus.""; echo "</span>";	
                 //echo NO_PLUS_ESI3." || ";
            } else{
                 echo "<br /><span class=&quot;warning&quot;>". dorf1_villageNameBox_1 .". ". dorf1_villageNameBox_2 ."."; echo "</span>";	
            }
		}else{
		if($market_=="" && $session->plus){
            echo dorf1_villageNameBox_9." || ";
            echo "Dealers: ".($lvlm-$database->totalMerchantUsed($village->wid))."/".($lvlm);
			} else{ 
                echo "". dorf1_villageNameBox_1 .".<br /><span class=&quot;warning&quot;> ". dorf1_villageNameBox_2 ."."; echo "</span>";	
            }
		}
		?>">
		<div class="button-container addHoverClick">
			<i></i>
		</div>
		</button>
		<?php if($market_=="" || !$session->plus){ ?>
	<script type="text/javascript">
		if($('button5229e5254ffa5'))
		{
			$('button5229e5254ffa5').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"<?=$green?>","onclick":"return false;","loadTitle":<?php if($market_=="" && $session->plus){ echo "true"; } else{ echo "false"; } ?>,"boxId":"activeVillage","disabled":<?php if($market_=="" && $session->plus){ echo "false"; } else{ echo "true"; } ?>,"speechBubble":"","class":"","id":"button5229e5254ffa5","redirectUrl":"<?php if($market_=="" && $session->plus){ echo "build.php?id=" . $mid; } else{ echo ""; } ?>","redirectUrlExternal":""<?php if($market_=="" && $session->plus){ echo ""; } else{ echo ",\"plusDialog\":{\"featureKey\":\"directLinks\",\"infoIcon\":\"http:/\/\t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer\"}"; } ?>}]);
			});
		}
	</script>
	<?php } ?>
	</div>
	<div class="clear"></div>
			<div id="villageNameField" class="boxTitle"><?php echo $village->vname; ?></div>
			</div>
			<div class="innerBox content">
				<?php 
                if($village->loyalty < 30){
				    echo "<div class=\"loyalty low\">".LOYALTY.": <span> $village->loyalty%</span></div>";
                }elseif($village->loyalty < 90){
				    echo "<div class=\"loyalty medium\">".LOYALTY.": <span> $village->loyalty%</span></div>";
				}else{
				    echo "<div class=\"loyalty high\">".LOYALTY.": <span> $village->loyalty%</span></div>";
				}
                ?>
                
			</div>
			<div class="innerBox footer">
				<button type="button" id="button5229e5255021d"	class="layoutButton editWhite green  " onclick="return false;" title="<?php echo dorf1_villageNameBox_16; ?>">
					<div class="button-container addHoverClick">
						<i></i>
					</div>
				</button>
			<script type="text/javascript">
				if($('button5229e5255021d'))
				{
					$('button5229e5255021d').addEvent('click', function ()
					{
						window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":false,"boxId":"","disabled":false,"speechBubble":"","class":"","id":"button5229e5255021d","redirectUrl":"","redirectUrlExternal":"","title":"\u0627\u0646\u0642\u0631 \u0647\u0646\u0627 \u0645\u0631\u062a\u064a\u0646 \u0644\u062a\u063a\u064a\u0651\u0631 \u0627\u0633\u0645 \u0642\u0631\u064a\u062a\u0643","villageDialog":{"title":"<?=CHANGING_YOUR_VILLAGE_NAME?>:","description":"<?=NEW_NAME?>:","saveText":"<?=SAVE?>","villageId":"<?php echo $village->wid;?>"}}]);
					});
				}
			</script>
			</div>
		</div>
	</div>
	<div id="sidebarBoxVillagelist" class="sidebarBox toggleable collapsed ">
		<div class="sidebarBoxBaseBox">
			<div class="baseBox baseBoxTop">
				<div class="baseBox baseBoxBottom">
					<div class="baseBox baseBoxCenter"></div>
				</div>
			</div>
		</div>
		<div class="sidebarBoxInnerBox">
			<div class="innerBox header ">
			<div class="buttonsWrapper">
				<button type="button" id="button5229e52550643"	class="layoutButton toggleCoordsWhite green  toggle" onclick="return false;" title="<?php echo dorf1_villageNameBox2_2; ?>">
		<div class="button-container addHoverClick">
			<i></i>
		</div>
		</button>
	<script type="text/javascript">
		if($('button5229e52550643'))
		{
			$('button5229e52550643').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":false,"boxId":"","disabled":false,"speechBubble":"","class":"toggle","id":"button5229e52550643","redirectUrl":"","redirectUrlExternal":""}]);
			});
		}
	</script><button type="button" id="button5229e52550762"	class="layoutButton overviewWhite green  " onclick="return false;" title="<?php echo dorf1_villageNameBox2_1; ?>">
		<div class="button-container addHoverClick">
			<i></i>
		</div>
		</button>
	<script type="text/javascript">
		if($('button5229e52550762'))
		{
			$('button5229e52550762').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":false,"boxId":"","disabled":false,"speechBubble":"","class":"","id":"button5229e52550762","redirectUrl":"dorf3.php","redirectUrlExternal":""}]);
			});
		}
	</script>
<?php if($session->goldclub != 0){  ?>
                            <style type="text/css">
                    button.layoutButton.buildOff div.button-container i {
                        background-position: right -758px;
                    }

                    button.layoutButton.buildOn div.button-container i {
                        background-position: right -800px;
                    }
                </style>

                <button type="button" id="buttonBuild" class="layoutButton build<?=$_COOKIE['builder']?>  green"
                        title="<?php echo $_COOKIE['builder'] == "On" ? 'speed on':'speed off'; ?>" onclick="return false;">
                    <div class="button-container addHoverClick ">
                        <i></i>
                    </div>
                </button>            
                <script type="text/javascript">
                    if($('buttonBuild'))
                    {
                        $('buttonBuild').addEvent('click', function ()
                        {
                            window.fireEvent('buttonClicked', [this, {"type":"green","onclick":"return false;","loadTitle":false,"boxId":"","disabled":false,"speechBubble":"","class":"","id":"buttonBuild","redirectUrl":"<?php echo (($dorf1=='')?'dorf2.php':'dorf1.php') . "?builder=" . $another; ?>","redirectUrlExternal":""}]);
                        });
                    }
                </script>
    <?php } ?>
	</div>
	<div class="clear"></div>
	<?php
	$count = count($session->vvillages);
	$mode = CP;
    $c=1;
    while(${'cp'.$mode}[$c] < $session->cp){
        $c++;
    }
    $c--;
	?>
	<div class="expansionSlotInfo" title="<?php echo dorf1_villageNameBox2_3; ?> :  <?=$count?>/<?php echo $c; ?> ‏<br /><?php echo dorf1_villageNameBox2_5;?>  <?php echo $session->cp;?> / <?php echo ${'cp'.$mode}[$c+1];?>">
		<div class="boxTitleAdditional"><?=$count."/".$c?></div>
		<div class="boxTitle"><?php echo dorf1_villageNameBox2_3; ?></div>
		<div class="villageListBarBox">
			<div class="bar" style="width:<?php echo (($session->cp / ${'cp'.$mode}[$c+1]) * 100);?>%">&nbsp;</div>
		</div>
	</div>
	<script type="text/javascript">
		window.addEvent('domready', function()
		{
					Travian.Translation.add(
			{
				'villagelist_collapsed': '<?php echo dorf1_villageNameBox2_2; ?>',
				'villagelist_expanded': '<?php echo dorf1_villageNameBox2_4; ?>'
			});
			var box = $('sidebarBoxVillagelist');
			box.down('button.toggle').addEvent('click', function(e)
			{
				Travian.Game.Layout.toggleBox(box, 'travian_toggle', 'villagelist');
			});
		});
		</script>		</div>
			<div class="innerBox content">
					<ul>
	<?php
    $attt=array();
    if ($session->plus) {
        $att = $database->getMovement(88,$villmas, 1);
        foreach($att as $lol){
            $attt[$lol['to']]+=1;
        }
    }
	foreach($session->vvillages as $vil){
        $village_attack="";
        $village_title = $vil['name'];
        if ($session->plus) {
            if($attt[$vil['wref']]){
                $village_attack = "attack ";
                $village_title = "attacks on this village: ".$attt[$vil['wref']];
            }
        }
        $newquery=explode("&",$_SERVER['QUERY_STRING']);
        if(isset($_GET['newdid']) || isset($_GET['id'])){unset($newquery[0]);}
        if(isset($_GET['newdid']) && isset($_GET['id'])){unset($newquery[1]); }
        $newquery = implode("&",$newquery);
        if ($_SERVER['PHP_SELF'] == "/build.php") {
            $build = true;
        } else {
            $build = false;
        }
        if ($build && $id > 18) {
            $buildvil = $fff[$vil['wref']];
            $newidbuild = $_GET['id'];
            $exist=0;
            for ($b = 19; $b <= 40; $b++) {
                if ($buildvil['f' . $b . 't'] == $village->resarray['f' . $_GET['id'] . 't'] && $buildvil['f' . $b] > 0) {
                    $newidbuild = $b;
                    $exist=1;
                }
            }
        }
        if(isset($_GET['id'])){
            $link = "?newdid=" . $vil['wref'] . "&id=".$_GET['id']."" . ($newquery ? '&'.$newquery : '');}else{
            $link = "?newdid=" . $vil['wref'] . "" . ($newquery ? '&'.$newquery : '');
        }
        if ($build && $id > 18) {
            if ($newidbuild != $_GET['id']) {
                $link = "?newdid=" . $vil['wref'] . "&id=" . $newidbuild."" . ($newquery ? '&'.$newquery : '');
            }elseif(!$exist){ $link = "?newdid=" . $vil['wref'] . "&id=" . $newidbuild;}
        }
	?>
						<li class=" <?php if($vil['wref'] == $village->wid){ echo "active"; } ?> <?=$village_attack?>" title="<?php echo $vil['name']; ?> (<?php echo $vil['vx']; ?>|<?php echo $vil['vy']; ?>)">
						<a  href="<?=$_SERVER['PHP_SELF'] . $link;?>" accesskey="b" class="active">
						<img src="img/x.gif" alt="" />
						<div id="vul_<?php echo $vil['name']; ?>" class="name"><?php echo $vil['name']; ?></div>
						‏<span class="coordinates coordinatesWrapper coordinatesAligned coordinates<?php echo DIRECTION; ?>"><span class="coordinateX">(<?php echo $vil['vx']; ?></span><span class="coordinatePipe">|</span><span class="coordinateY"><?php echo $vil['vy']; ?>)</span></span></a>
				</li>
	<?php }
	?>
				</ul>
			</div>
			<div class="innerBox footer">
						</div>
		</div>
	</div>
    <div id="sidebarBoxDailyquests" class="sidebarBox   ">
        <div class="sidebarBoxBaseBox">
            <div class="baseBox baseBoxTop">
                <div class="baseBox baseBoxBottom">
                    <div class="baseBox baseBoxCenter"></div>
                </div>
            </div>
        </div>
        <div class="sidebarBoxInnerBox">
            <div class="innerBox header ">
                <div class="travianBirthdayRibbon">
                    <div class="headline">
                        <?=quest173?>   </div>
                </div>
                <div class="boxTitle"><?=quest174?></div>		</div>
            <div class="innerBox content">
                <form>
                    <div class="questAchievementContainer">
                        <button onclick="return false;" questbuttonoverviewachievements="1" class="green questButtonOverviewAchievements" id="button545dec96b3573" value="Подробности" type="submit">
                            <div class="button-container addHoverClick ">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?=quest175?></div>
                            </div>
                        </button>
                        <script type="text/javascript">
                            window.addEvent('domready', function()
                            {
                                if($('button545dec96b3573'))
                                {
                                    $('button545dec96b3573').addEvent('click', function ()
                                    {
                                        window.fireEvent('buttonClicked', [this, {"type":"submit","value":"\u041f\u043e\u0434\u0440\u043e\u0431\u043d\u043e\u0441\u0442\u0438","name":"","id":"button545dec96b3573","class":"green questButtonOverviewAchievements","title":"","confirm":"","onclick":"","questButtonOverviewAchievements":true,"onClick":"return false;"}]);
                                    });
                                }
                            });
                        </script>
                    </div>
                </form>
				<script type="text/javascript">
				window.addEvent('domready', function () {
					Travian.Game.Quest.addListData(
						{"achievementquests":{"questsTotal":10,"questsCompleted":0,"name":"Achievement Quests"
						,"quests":{
						 "AchievementQuest_01":{"id":"AchievementQuest_01","name":"achievementQuests.achQuest_01_name","category":"achievementquests","stepType":"achievementtask","currentStep":"0","stepCount":1,"steps":[{"stepId":0,"type":"achievementtask","stepDescription":null}],"answersLink":"http:\\\/\\\/t4.answers.travian.com\\\/index.php?aid=%%achievementQuests.achQuest_01_answer (en)%%#go2answer"}
						,"AchievementQuest_02":{"id":"AchievementQuest_02","name":"achievementQuests.achQuest_02_name","category":"achievementquests","stepType":"achievementtask","currentStep":"0","stepCount":3,"steps":[{"stepId":0,"type":"achievementtask","stepDescription":null},{"stepId":1,"type":"achievementtask","stepDescription":null},{"stepId":2,"type":"achievementtask","stepDescription":null}],"answersLink":"http:\\\/\\\/t4.answers.travian.com\\\/index.php?aid=%%achievementQuests.achQuest_02_answer (en)%%#go2answer"}
						,"AchievementQuest_03":{"id":"AchievementQuest_03","name":"achievementQuests.achQuest_03_name","category":"achievementquests","stepType":"achievementtask","currentStep":"0","stepCount":3,"steps":[{"stepId":0,"type":"achievementtask","stepDescription":null},{"stepId":1,"type":"achievementtask","stepDescription":null},{"stepId":2,"type":"achievementtask","stepDescription":null}],"answersLink":"http:\\\/\\\/t4.answers.travian.com\\\/index.php?aid=%%achievementQuests.achQuest_03_answer (en)%%#go2answer"}
						,"AchievementQuest_04":{"id":"AchievementQuest_04","name":"achievementQuests.achQuest_04_name","category":"achievementquests","stepType":"achievementtask","currentStep":"0","stepCount":1,"steps":[{"stepId":0,"type":"achievementtask","stepDescription":null}],"answersLink":"http:\\\/\\\/t4.answers.travian.com\\\/index.php?aid=%%achievementQuests.achQuest_04_answer (en)%%#go2answer"}
						,"AchievementQuest_05":{"id":"AchievementQuest_05","name":"achievementQuests.achQuest_05_name","category":"achievementquests","stepType":"achievementtask","currentStep":"0","stepCount":3,"steps":[{"stepId":0,"type":"achievementtask","stepDescription":null},{"stepId":1,"type":"achievementtask","stepDescription":null},{"stepId":2,"type":"achievementtask","stepDescription":null}],"answersLink":"http:\\\/\\\/t4.answers.travian.com\\\/index.php?aid=%%achievementQuests.achQuest_05_answer (en)%%#go2answer"}
						,"AchievementQuest_06":{"id":"AchievementQuest_06","name":"achievementQuests.achQuest_06_name","category":"achievementquests","stepType":"achievementtask","currentStep":"0","stepCount":3,"steps":[{"stepId":0,"type":"achievementtask","stepDescription":null},{"stepId":1,"type":"achievementtask","stepDescription":null},{"stepId":2,"type":"achievementtask","stepDescription":null}],"answersLink":"http:\\\/\\\/t4.answers.travian.com\\\/index.php?aid=%%achievementQuests.achQuest_06_answer (en)%%#go2answer"}
						,"AchievementQuest_07":{"id":"AchievementQuest_07","name":"achievementQuests.achQuest_07_name","category":"achievementquests","stepType":"achievementtask","currentStep":"0","stepCount":3,"steps":[{"stepId":0,"type":"achievementtask","stepDescription":null},{"stepId":1,"type":"achievementtask","stepDescription":null},{"stepId":2,"type":"achievementtask","stepDescription":null}],"answersLink":"http:\\\/\\\/t4.answers.travian.com\\\/index.php?aid=%%achievementQuests.achQuest_07_answer (en)%%#go2answer"}
						,"AchievementQuest_08":{"id":"AchievementQuest_08","name":"achievementQuests.achQuest_08_name","category":"achievementquests","stepType":"achievementtask","currentStep":"0","stepCount":3,"steps":[{"stepId":0,"type":"achievementtask","stepDescription":null},{"stepId":1,"type":"achievementtask","stepDescription":null},{"stepId":2,"type":"achievementtask","stepDescription":null}],"answersLink":"http:\\\/\\\/t4.answers.travian.com\\\/index.php?aid=%%achievementQuests.achQuest_08_answer (en)%%#go2answer"}
						,"AchievementQuest_09":{"id":"AchievementQuest_09","name":"achievementQuests.achQuest_09_name","category":"achievementquests","stepType":"achievementtask","currentStep":"0","stepCount":3,"steps":[{"stepId":0,"type":"achievementtask","stepDescription":null},{"stepId":1,"type":"achievementtask","stepDescription":null},{"stepId":2,"type":"achievementtask","stepDescription":null}],"answersLink":"http:\\\/\\\/t4.answers.travian.com\\\/index.php?aid=%%achievementQuests.achQuest_09_answer (en)%%#go2answer"}
						,"AchievementQuest_10":{"id":"AchievementQuest_10","name":"achievementQuests.achQuest_10_name","category":"achievementquests","stepType":"achievementtask","currentStep":"0","stepCount":3,"steps":[{"stepId":0,"type":"achievementtask","stepDescription":null},{"stepId":1,"type":"achievementtask","stepDescription":null},{"stepId":2,"type":"achievementtask","stepDescription":null}],"answersLink":"http:\\\/\\\/t4.answers.travian.com\\\/index.php?aid=%%achievementQuests.achQuest_10_answer (en)%%#go2answer"}}}
						
						,"achievementrewards":{"questsTotal":4,"questsCompleted":0,"name":"Achievement Rewards"
						,"quests":{
							"AchievementQuestReward_01":{"id":"AchievementQuestReward_01","name":"achievementQuests.achQuestReward_01_name","category":"achievementrewards","stepType":"reward","currentStep":0,"stepCount":1,"steps":{"stepId":0,"type":"reward"},"answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=%%achievementQuests.achQuestReward_01_answer (en)%%#go2answer"},
							"AchievementQuestReward_02":{"id":"AchievementQuestReward_02","name":"achievementQuests.achQuestReward_02_name","category":"achievementrewards","stepType":"reward","currentStep":0,"stepCount":1,"steps":{"stepId":0,"type":"reward"},"answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=%%achievementQuests.achQuestReward_02_answer (en)%%#go2answer"},
							"AchievementQuestReward_03":{"id":"AchievementQuestReward_03","name":"achievementQuests.achQuestReward_03_name","category":"achievementrewards","stepType":"reward","currentStep":0,"stepCount":1,"steps":{"stepId":0,"type":"reward"},"answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=%%achievementQuests.achQuestReward_03_answer (en)%%#go2answer"},
							"AchievementQuestReward_04":{"id":"AchievementQuestReward_04","name":"achievementQuests.achQuestReward_04_name","category":"achievementrewards","stepType":"reward","currentStep":0,"stepCount":1,"steps":{"stepId":0,"type":"reward"},"answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=%%achievementQuests.achQuestReward_04_answer (en)%%#go2answer"}
							}}});
				});
			</script>
				</div>
            <div class="innerBox footer">
            </div>
		</div>
		</div>

	<?php if($session->access == 9){ ?>
		<div id="sidebarBoxDailyquests" class="sidebarBox   ">
        <div class="sidebarBoxBaseBox">
            <div class="baseBox baseBoxTop">
                <div class="baseBox baseBoxBottom">
                    <div class="baseBox baseBoxCenter"></div>
                </div>
            </div>
        </div>

	<div class="sidebarBoxInnerBox">
            <div class="innerBox header ">
                <div class="travianBirthdayRibbon">
                    <div class="headline">
                        <?php echo $lang['Admin']['Panel']; ?>   </div>
                </div></div>
            <div class="innerBox content"><?php echo $lang['Admin']['Panel01']; ?><br><br>
                    <div class="questAchievementContainer">
						<a href="panel">
                        <button  class="green" id="button545dec96b3573">
                            <div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?php echo $lang['Admin']['Panel02']; ?></div>
                            </div>
						</button>
	</a>
                    </div>
				</div>
				    <div class="innerBox content"><?php echo $lang['Admin']['Panel01']; ?><br><br>
                    <div class="questAchievementContainer">
						<a href="action-panel">
                        <button  class="green" id="button545dec96b3573">
                            <div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content">Action-Panel</div>
                            </div>
						</button>
	</a>
                    </div>
				</div>
            <div class="innerBox footer">
            </div>
			</div>
			</div>
<?php } ?>

    <?php
    $vote = $database->query("SELECT dgold FROM `users` WHERE `id`='".$session->uid."'"); //проinерка голосоinал ли уже игрок

?> 


	<?php 
	$disable = false;
	
	 if ($session->access != 9 && ($session->uid && !$disable && $session->qData['quest'] != 16)  ||
	($session->qData['quest'] == 16 
	&& ($session->qArrayB1[0] != 0 || $session->qArrayB2[0] != 0
	|| $session->qArrayE1[0] != 0 || $session->qArrayE2[0] != 0
	|| $session->qArrayW1[0] != 0 || $session->qArrayW2[0] != 0))){
		?>
		<div id="sidebarBoxQuestmaster" class="sidebarBox   ">
	<div class="sidebarBoxBaseBox">
		<div class="baseBox baseBoxTop">
			<div class="baseBox baseBoxBottom">
				<div class="baseBox baseBoxCenter"></div>
			</div>
		</div>
	</div>
	<div class="sidebarBoxInnerBox">
		<div class="innerBox header ">
			<button id="questmasterButton" title="" class="forceDisplayElement vid_<?php echo $session->tribe; ?> highlighted on" type="button">
				<img class="border" alt="" src="img/x.gif">
				<img class="animation" alt="" src="img/x.gif">
				<img class="mentor" alt="" src="img/x.gif">
				<?php if($session->qData['isFinished'] || ($session->qData['skipped'] 
				&& !$session->qData['battle1'] 
				&& !$session->qData['battle2'] 
				&& !$session->qData['economy1'] 
				&& !$session->qData['economy2']
				&& !$session->qData['world1']
				&& !$session->qData['world2'] ) ){ ?>
				<div class="bigSpeechBubble newQuestSpeechBubble" title="">
                        <img src="img/x.gif" alt="">
                    </div>
				<?php } ?>
							</button>
			<div class="buttonsWrapper">
			<button type="button" id="buttong6PCZTDC7HwhS" class="layoutButton bulbWhite green  " onclick="return false;">
				<div class="button-container addHoverClick">
					<i></i>
				</div>
			</button>
			</div>

			<script type="text/javascript">

				if ($('buttong6PCZTDC7HwhS')) {
					$('buttong6PCZTDC7HwhS').addEvent('click', function () {
						window.fireEvent('buttonClicked', [this, {
							"type": "green",
							"onclick": "return false;",
							"loadTitle": false,
							"boxId": "",
							"disabled": false,
							"speechBubble": "",
							"class": "",
							"id": "buttong6PCZTDC7HwhS",
							"redirectUrl": "",
							"redirectUrlExternal": "",
							"overlay": []
						}]);
					});
				}
			</script>
			<?php if(DIRECTION != "rtl"){ ?>
			<div class="clear"></div>
			<?php } ?>
			<div class="boxTitle"><?php echo $lang['quests']['Main']['QuestsList']; ?></div>

			<script type="text/javascript">
				window.addEvent('domready', function () {
					Travian.Game.Quest.setOptions({isTutorial: <?php echo $quest->userProgress() == 16 ? 'false' : 'true'; ?>});
					// Dialog an den Questmaster binden
					$('questmasterButton').addEvent('click', function () {
						<?php if( $quest->userProgress() == 16){ ?>
							Travian.Game.Quest.mentorClick('');
						<?php }else{ ?>
							Travian.Game.Quest.mentorClick('Tutorial_<?php	echo $quest->userProgress(); ?>');
						<?php } ?>
					});
				});
			</script>
			<div>
				<script type="text/javascript">
					Travian.Game.Quest.createHighlights();
					Travian.Game.Quest.toggleHighlights(true);
					$$('.questInformation .iconButton.small.cancel').addEvent('click', function () {
						setTimeout(function () {
							Travian.Game.Quest.createHighlights();
							Travian.Game.Quest.toggleHighlights(true);
						}, 500);
					});

				</script>
			</div>
		</div>
		<div class="innerBox content">
			<ul id="mentorTaskList" class="notClickable">
				<?php echo $quest->getQuestMonitor($quest->userProgress()); ?>
				<script type="text/javascript">
					Travian.Translation.add('answers.tutorial_<?php	echo $quest->userProgress(); ?>_title', "Travian Answers");
				</script>
							</ul>
			<script type="text/javascript">
				window.addEvent('domready', function () {
					Travian.Game.Quest.setOptions(<?php echo $quest->getQuestJS($quest->userProgress()); ?>);
					Travian.Game.Quest.addListData([]);

					Travian.Game.Quest.bindListDelegationDeg(jQuery('ul#mentorTaskList li'));
					Travian.Game.Quest.createHighlights();
					Travian.Game.Quest.initializeQuests();
					
				});
			</script>

		</div>
		<div class="innerBox footer">
		</div>
	</div>
</div>    <?php } ?>

</div>