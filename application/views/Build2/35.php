<h4 class="round spacer">List the celebration</h4>
<table cellpadding="1" cellspacing="1" class="build_details">
	<thead>
		<tr>
			<td>Celebrate</td>
			<td>Operations</td>
		</tr>
	</thead>
	<tbody>

			
		<?php
		$level = $village->resarray['f'.$id];
		$br_tm = explode(",",$session->brewery);
		$inuse = $br_tm[0];
		$time = Time();
		$i = 1;
			echo "<tr>";
			echo "<td class=\"desc\">";			
			echo "<div class=\"tit\">vacation</div>";

			echo '<div class="inlineIconList resourceWrapper">
			<div class="inlineIcon resource"><i class="r1Big"></i><span class="value value">38700</span></div>
			<div class="inlineIcon resource"><i class="r2Big"></i><span class="value value">16800</span></div>
			<div class="inlineIcon resource"><i class="r3Big"></i><span class="value value">59400</span></div>
			<div class="inlineIcon resource"><i class="r4Big"></i><span class="value value">13400</span></div>
			<div class="inlineIcon resource"><i class="r5Big"></i><span class="value value">0</span></div>
			</div><br><div class="inlineIcon duration"><i class="infantryBonusTime_medium"></i><span class="value ">'.$generator->getTimeFormat(round(3600*6)).'</span></div>
			<div class="cta">';
			if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
				echo '<br><button type="button" class="gold exchange " onfocus="jQuery(\'button\', \'input[type!=hidden]\', \'select\').focus(); event.stopPropagation(); return false;" id="button11">
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
				window.addEvent(\'domready\', function(){
					if($(\'button11\'))
						{
							$(\'button11\').addEvent(\'click\', function ()
							{
								window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"Exchange resources","name":"","id":"button5487115a9b649","class":"gold ","title":"Click here to exchange resources.","confirm":"","onclick":"","dialog":{"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"saveOnUnload":false,"data":{"cmd":"exchangeResources","defaultValues":{"tid":"1","nr":"1","btyp":"1","r1":38700,"r2":16800,"r3":59400,"r4":13400,"supply":"1","pzeit":0,"max1":0,"max2":0,"max3":0,"max4":0,"max":0},"did":"23037"}}}]);
							});
						}
					});
				</script><br>';
				}
				echo '</div>';
				
				if($inuse > $time){
					echo "<td class=\"act\">
					<div class=\"none\">There's an ongoing celebration</div>
					</td></tr>";
					}
                  else if(38700 > $village->awood || 16800 > $village->aclay || 59400 > $village->airon || 13400 > $village->acrop) {
					if($village->getProd("crop")>0){
						$res=array(38700,16800,59400,13400);
	                   	$time = $technology->calculateAvaliable(24,$res);
		                echo "<br><span class=\"none\">Ресурсоin будет достаточно ".$time[0]." in ".$time[1]."</span></div></td>";
					} else {
						echo "<br><span class=\"none\">Не хinатает зерна.</span></div></td>";
					}
                    echo "<td class=\"act\"><div class=\"none\">Не хinатает<br>ресурсоin</div></td></tr>";
                }
                else {
					echo "</td>";
                    echo "<td class=\"act\">";

					echo "<a class=\"research\" href=\"dorf2.php?pivo&wid=$village->wid\">celebration</a></td></tr>";
                }

?>
	</tbody>
</table>

<?php
        $br_tm = explode(",",$session->brewery);
		$timeleft = $br_tm[0];
		if($timeleft > Time()){
			?>
				<h4 class="round spacer">celebration</h4>
			<?php
			echo '<table cellpadding="1" cellspacing="1" class="under_progress">
			<thead><tr>
				<td>celebration</td>
				<td>Duration</td>
				<td>Finished</td>
			</tr></thead>';
			echo '<tr><td>';
            echo 'vacation';
            echo "</td><td><span class=\"timer\" counting=\"down\" value=\"".($timeleft-time())."\">";
            echo $generator->getTimeFormat($timeleft-time());
            echo "</span></td>";
            echo "<td>end in a ".date('H:i', $timeleft)."</td></tr>";
			echo "</table>";
            $timer +=1;
		}
?>