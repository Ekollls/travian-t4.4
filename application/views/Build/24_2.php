<div class=\"clear\"></div><br />
<?php
        if(!isset($timer)) {
        $timer = 1;
        }
		$timeleft = $village->currentcel;
		if($timeleft > time()){
            echo '<table cellpadding="1" cellspacing="1" class="under_progress">
			<thead><tr><td>'.ratusha3.'</td><td>'.ratusha12.'</td><td>'.ratusha13.'</td></tr></thead>';
            echo '<tbody><tr>';
            echo "<td class=\"desc\">a celebration </td>";
            echo "<td class=\"dur\"><span class=\"timer\" counting=\"down\" value=\"".($timeleft-time())."\">";
            echo $generator->getTimeFormat($timeleft-time());
            echo "</span></td>";
            echo "<td class=\"fin\">".date('H:i:s', $timeleft)."<span></span></td>";
            echo "</tr></tbody></table>";
            $timer +=1;
		}
