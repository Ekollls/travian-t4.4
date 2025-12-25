 <?php
    $trainlist = $technology->getTrainingList(4);
    if(count($trainlist) > 0) {
    	echo "
   <br /><table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
		<thead><tr>
			<td>".RE23."</td>
			<td>".RE24."</td>
			<td>".RE25."</td>
		</tr></thead>
		<tbody>";
		$TrainCount = 0;
        if(!isset($timer)){ $timer=1;}
        foreach($trainlist as $train) {
			$TrainCount++;
	        echo "<tr><td class=\"desc\">";
			echo "<img class=\"unit u".$train['unit']."\" src=\"img/x.gif\" alt=\"".$train['name']."\" title=\"".$train['name']."\" />";
			echo $train['amt']." ".$train['name']."</td><td class=\"dur\">";
			if ($TrainCount == 1 ) {
				echo "<span class='timer' counting='down' value='".(round($train['eachtime']*$train['amt']))."'>".$generator->getTimeFormat(round($train['eachtime']*$train['amt']))."</span>";
			} else {
				echo $generator->getTimeFormat(round($train['eachtime']*$train['amt']));
			}
			echo "</td><td class=\"fin\">";
			$time = $generator->procMTime($train['timestamp']);
			if($time[0] != "today") {
				echo "on ".$time[0]." at ";
            }
			echo $time[1];
		} ?>
		</tr>
		</tbody></table>
    <?php }
?>
