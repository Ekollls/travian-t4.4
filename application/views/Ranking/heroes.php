<?php
if(!is_numeric($_SESSION['search']) && !empty($_SESSION['search'])) {
	$igrok=OVERVIEW1;
	$nenaiden= STATISTIC3;
	echo "<p class=\"error\">".$igrok." <b>".$_SESSION['search']."</b> ".$nenaiden."</p>";
    $search = 0;
}
else {
$search = $database->FilterVar($_SESSION['search']);
}
?>
<h4 class="round"><?php echo STATISTIC10; ?></h4>

    <table cellpadding="1" cellspacing="1" id="heroes" class="row_table_data">
			<thead>

				<tr><td></td><td><?php echo OVERVIEW1; ?></td><td><?php echo LEVEL; ?></td><td><?php echo STATISTIC11; ?></td></tr>

		</thead><tbody>
        <?php
        if(isset($_GET['rank'])){
            $multiplier = 1;

            if(is_numeric($_GET['rank'])) {
                if($_GET['rank'] > count($ranking->getRank())) {
                    $_GET['rank'] = count($ranking->getRank())-1;
                }
                while($_GET['rank'] > (20*$multiplier)) {
                    $multiplier +=1;
                }
                $start = 20*$multiplier-19;
            } else { $start = ($_SESSION['start']+1); }
        } else { $start = ($_SESSION['start']+1); }
        if(count($ranking->getRank()) > 0) {
        	$ranking = $ranking->getRank();
        	for($i = $start; $i < ($start + 20); $i++) {
        		if(isset($ranking[$i]['username']) && $ranking[$i] != "pad") {
                    if($i == $search) {
        				echo "<tr class=\"hl \"><td class=\"ra  fc\" >";
        			} else {
        				echo "<tr><td class=\"ra \" >";
        			}
        			echo $i . ".</td>

					<td class=\"pla \"><center><a href=\"spieler.php?uid=" . $ranking[$i]['uid'] . "\">" . $ranking[$i]['username'] . "</a></center></td>
					<td class=\"lev \">" . $ranking[$i]['level'] . "</td>
					<td class=\"xp \">" . $ranking[$i]['experience'] . "</td>
					</tr>
					";
        		}
        	}
        } else {
        	?><td class="none" colspan="5"><?php echo STATISTIC12; ?></td>
       <?php }

?>
 </tbody>
</table>
<?php

        include("ranksearch.php");

?>