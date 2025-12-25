
<?php
	if ($building->getTypeLevel(22) > 0) {
		$start = ($session->tribe*10-9);
		$end = ($session->tribe*10-1);
		?>
		<div class="clear"></div>
		<h4 class="round">Search villages <?php echo $village->vname; ?></h4>
		<?php
		$fail = $success = 0;
		$acares = $technology->grabAcademyRes();
		echo '<div class="build_details researches">';
		for($i=$start,$x=0;$i<=$end;$i++) {
			switch($session->tribe){
				case 1: $startTech = $i; break;
				case 2: $startTech = $i-10; break;
				case 3: $startTech = $i-20; break;
				case 6: $startTech = $i-50; break;
				case 7: $startTech = $i-60; break;
			}

			if($technology->meetRRequirement($i) && !$technology->getTech(($startTech)) && !$technology->isResearch(($startTech),1)) {
				if($x != 0){
					echo '<hr>';
				}
				$x++;

				echo "
				<div class=\"research\">
					
					<div class=\"bigUnitSection\">
						<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">
						<img class=\"unitSection u".$i."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\">
						</a> <a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$i.");\">
						<img class=\"zoom\" src=\"img/x.gif\" alt=\"zoom in\">
						</a>
					</div>       

					<div class=\"information contractWrapper\">
						<div class=\"title\">
						<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">
							<img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\">
						</a>

						<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">".$technology->getUnitName($i)."</a>
					</div>
					
						<div class=\"inlineIconList resourceWrapper\">
							<div class=\"inlineIcon resource\"><i class=\"r1Big\"></i><span class=\"value value\">".${'r'.$i}['wood']."</span></div>
							<div class=\"inlineIcon resource\"><i class=\"r2Big\"></i><span class=\"value value\">".${'r'.$i}['clay']."</span></div>
							<div class=\"inlineIcon resource\"><i class=\"r3Big\"></i><span class=\"value value\">".${'r'.$i}['iron']."</span></div>
							<div class=\"inlineIcon resource\"><i class=\"r4Big\"></i><span class=\"value value\">".${'r'.$i}['crop']."</span></div>
						</div>
						<br>
						<div class=\"cta\">
						<div class=\"inlineIcon duration\"><i class=\"clock_medium\"></i><span class=\"value \">";
				echo $generator->getTimeFormat(round(${'r'.$i}['time'] * ($bid22[$village->resarray['f'.$id]]['attri'] / 100)/SPEED));
				echo "</span></div>";

				$totalRes = ${'r'.$i}['wood'] + ${'r'.$i}['clay'] + ${'r'.$i}['woironod'] + ${'r'.$i}['crop'];

				if($session->gold >= 3 && $building->getTypeLevel(17) >= 1 
				&& (${'r'.$i}['wood'] > $village->awood || ${'r'.$i}['clay'] > $village->aclay || ${'r'.$i}['iron'] > $village->airon || ${'r'.$i}['crop'] > $village->acrop) 
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
									window.fireEvent('buttonClicked', [this, {"type":"button","value":"Exchange resources","name":"","id":"button5487115a9b649","class":"gold ","title":"Click here to exchange resources.","confirm":"","onclick":"","dialog":{"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"saveOnUnload":false,"data":{"cmd":"exchangeResources","defaultValues":{"tid":"1","nr":"1","btyp":"1","r1":<?=((${'r'.$i}['wood']))?>,"r2":<?=((${'r'.$i}['clay']))?>,"r3":<?=((${'r'.$i}['iron']))?>,"r4":<?=((${'r'.$i}['crop']))?>,"supply":"1","pzeit":0,"max1":0,"max2":0,"max3":0,"max4":0,"max":0},"did":"<?=$village->wid;?>"}}}]);
								});
							}
						});
					</script>
				<?php } 
				if(${'r'.$i}['wood'] > $village->maxstore || ${'r'.$i}['clay'] > $village->maxstore || ${'r'.$i}['iron'] > $village->maxstore) {
					echo "<br><div class=\"contractLink\"><span class=\"none\">
							The ore store must be developed</span></div></div></div></div>
							<div class=\"clear\">&nbsp;</div>";
				}
				else if(${'r'.$i}['crop'] > $village->maxcrop) {
					echo "<br><div class=\"contractLink\"><span class=\"none\">
							The granary must be developed</span></div></div></div></div>
							<div class=\"clear\">&nbsp;</div>";
				
				}
				else if(${'r'.$i}['wood'] > $village->awood || ${'r'.$i}['clay'] > $village->aclay || ${'r'.$i}['iron'] > $village->airon || ${'r'.$i}['crop'] > $village->acrop) {
					if($village->getProd("crop")>0){
						$time = $technology->calculateAvaliable(22,${'r'.$i});
						echo '</div>';
						echo "
						<div class=\"contractLink\">
							<span class=\"none\">Availability of necessary resources ".$time[0]." in a ".$time[1]."</span>
						</div></div>
		<div class=\"clear\">&nbsp;</div>
		</div>";
					} else {
						echo '</div>';
						echo "<br><div class=\"contractLink\"><span class=\"none\">Crop production is negative so you will never reach the required resources</span></div></div>
		<div class=\"clear\">&nbsp;</div>
		</div>";
					}
					//echo "<div class=\"contractLink\"><div class=\"none\">Too few<br>resources</div></div></div></div>";
				}
				else if (count($acares) > 0) {
				// echo '</div>';
					echo "<br><div class=\"contractLink\"><span class=\"none\">
							".$lang['buildings']['texts']['AKA1']."</span></div></div></div></div>
							<div class=\"clear\">&nbsp;</div>
					";
				}
				else {
					echo "<div class=\"contractLink\"><button type=\"button\"  class=\"green\" onclick=\"window.location.href = 'build.php?id=$id&amp;a=$i&amp;c=".$session->mchecker."'; return false;\">
						<div class=\"button-container addHoverClick\">
							<div class=\"button-background\">
								<div class=\"buttonStart\">
									<div class=\"buttonEnd\">
									<div class=\"buttonMiddle\"></div>
									</div>
								</div>
						</div>
						<div class=\"button-content\">".AK8."</div></div></button></div>
						</div>
						<div class=\"clear\">&nbsp;</div>
						</div></div><div class=\"clear\">&nbsp;</div>";
				}
				$success += 1;
			}
			else {
				$fail += 1;
			}
		}

		for($uc=13,$ii=0;$uc<=19;$uc++){
			if(!$technology->meetRRequirement($uc) && !$technology->getTech($uc)) {
				$ii++;
			}
		}
		/*if($ii == 0){
			?>
			<div class="noResearchPossible">
				<span class="errorMessage">All forces were searched for the academy.</span>
			</div>
		<?php

		}else{*/

			if($success == 0) {
				?>
					<div class="noResearchPossible">
						<span class="errorMessage"><?php echo AK3; ?></span>
					</div>
				<?php
			}
		//}
		?>
		</div>
		<?php
		if($fail > 0 && $ii != 0) {
			
			echo "<p class=\"switch\"><a class=\"openedClosedSwitch switchOpened\" id=\"researchFutureLink\" href=\"#\" onclick=\"Travian.toggleSwitch($('researchFuture'), this);\">".AK6."</a></p>
			<div id=\"researchFuture\" class=\"researches hide \">";
			for($uc=($start+1),$xx=0;$uc<=$end;$uc++){
				
				$j = $uc % 10 ;
				if(!$technology->meetRRequirement($uc) && !$technology->getTech($j)) {
					if($xx != 0){
						echo '<hr>';
					}
					$xx++; 
					echo"<div class=\"research\">
						<div class=\"bigUnitSection\"><a href=\"#\" onclick=\"return Travian.Game.iPopup(".$uc.",1);\"><img class=\"unitSection u".$uc."Section\" src=\"img/x.gif\" alt=\"".constant('U'.$uc)."\"></a><a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$uc.");\"><img class=\"zoom\" src=\"img/x.gif\" alt=\"zoom in\"></a></div>
						<div class=\"information contractWrapper\">
						<div class=\"title\">
							<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$uc.",1);\">
								<img class=\"unit u".$uc."\" src=\"img/x.gif\" alt=\"".constant('U'.$uc)."\">
							</a>
							<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$uc.",1);\">".constant('U'.$uc)."</a>
						</div>
						<div class=\"inlineIconList resourceWrapper\">
							<div class=\"inlineIcon resource\"><i class=\"r1Big\"></i><span class=\"value value\">".${'r'.$uc}['wood']."</span></div>
							<div class=\"inlineIcon resource\"><i class=\"r2Big\"></i><span class=\"value value\">".${'r'.$uc}['clay']."</span></div>
							<div class=\"inlineIcon resource\"><i class=\"r3Big\"></i><span class=\"value value\">".${'r'.$uc}['iron']."</span></div>
							<div class=\"inlineIcon resource\"><i class=\"r4Big\"></i><span class=\"value value\">".${'r'.$uc}['crop']."</span></div>
						</div>
						<br>
						<div class=\"inlineIcon duration\"><i class=\"clock_medium\"></i><span class=\"value \">";
						echo $generator->getTimeFormat(round(${'r'.$uc}['time'] * ($bid22[$village->resarray['f'.$id]]['attri'] / 100)/SPEED));
						echo '</span></div><div class="requirements">';

						$x=0;
						foreach($manual->getTroopRequirements($uc) as $build => $level){            
							if($build){
								if($x!=0){
									echo ', ';
								}
								echo '<a href="#" onclick="return Travian.Game.iPopup('.$build.', 4);">'.$lang['buildings'][$build];
								echo '</a> level '.$level.'';
								$x++;
							}
						}
		
						echo '</div>'; // 
						echo '</div>'; //requirements
					echo '</div>';
				}
				echo '<div class="clear"></div>';
			}
			echo '</div>';

			echo "<script type=\"text/javascript\">
				//<![CDATA[
					$(\"researchFuture\").toggle = (function()
					{
						this.toggleClass(\"hide\");

						$(\"researchFutureLink\").set(\"text\",
							this.hasClass(\"hide\")
							?	\"Показать еще\"
							:	\"Скрыть\"
						);

						return false;
					}).bind($(\"researchFuture\"));
				//]]>
				</script>";
			//echo "<div class=\"clear\"></div></div>";
			
		}
		//$acares = $technology->grabAcademyRes();
		if(count($acares) > 0) {
			
			echo "<table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
			<thead><tr><td>".$lang['buildings']['texts']['TRA1']."</td>
			<td>".$lang['buildings']['texts']['TRA2']."</td>
			<td>".$lang['buildings']['texts']['TRA3']."</td></tr>
			</thead><tbody>";
			if(!isset($timer)){$timer = 1;}
			foreach($acares as $aca) {
				$unit = substr($aca['tech'],1,2);
				$unit+=($session->tribe-1)*10;
				echo "<tr><td class=\"desc\"><img class=\"unit u$unit\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($unit)."\" title=\"".$technology->getUnitName($unit)."\" />".$technology->getUnitName($unit)."</td>";
				echo "<td class=\"dur\"><span class=\"timer\" counting=\"down\" value=\"".($aca['timestamp']-time())."\">".$generator->getTimeFormat($aca['timestamp']-time())."</span></td>";
				$date = $generator->procMtime($aca['timestamp']);
				echo "<td class=\"fin\"><span>".$date[1]."</span><span> hour</span></td>";
				echo "</tr>";
				$timer +=1;
			}
			echo "</tbody></table>";
		}


	} else {
		echo "<p><b>".$lang['buildings']['texts']['AKA2']."</b><br>\n";
	}

?>


