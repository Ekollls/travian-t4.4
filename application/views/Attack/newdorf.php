<?php
$id=$database->filterIntValue($_GET['kid']);
$newvillage = $database->getWInfo($id);
$eigen = $database->getCoor($village->wid);
$from = $village->coor;
$to = array('x'=>$newvillage['x'], 'y'=>$newvillage['y']);
$fastertroops = $database->checkArtefactsEffects($session->uid,$village->wid,2);
$time = round($database->procDistanceTime($from,$to,5,1,$village->wid)*$fastertroops);
?>
<div class="troopstipo">
<h1><?=KAR5?></h1>
				<form method="POST" action="build.php?t=2&id=39">
				<input type="hidden" name="a" value="new" />
				<input type="hidden" name="s" value="<?php echo $id; ?>" />
                <input type="hidden" name="c" value="5" />

		<table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td colspan="11"><a href="karte.php?d=<?php echo $id; ?>&c=<?php echo $generator->getMapCheck($id) ?>"><?=KAR5?> (<?php echo $newvillage['x']; ?>|<?php echo $newvillage['y']; ?>)</a></td>
		</tr>
	</thead>
	<tbody class="units">
		<tr>
			<th>&nbsp;</th>
				<?php for($i=($session->tribe-1)*10+1;$i<=$session->tribe*10;$i++) {
					echo "<td><img src=\"img/x.gif\" class=\"unit u".$i."\" title=\"\" alt=\"\" /></td>";
				} ?>
		</tr>
		<tr>
			<th><?=PY8?></th>
				<?php for($i=1;$i<=9;$i++) {
					echo "<td class=\"none\">0</td>";
				} ?>
				<td>3</td>
		</tr>
	</tbody>
	<tbody class="infos">
		<tr>
			<th><?=KZ6?></th>
				<td colspan="10"><img class="clock" src="img/x.gif" alt="Duration" title="Duration" /> <?php echo $generator->getTimeFormat($time); ?></td>
		</tr>
	</tbody>
	<tbody class="infos">
		<tr>
			<th><?=HEROI19?></th>
				<td colspan="10">
				<img class="r1" src="img/x.gif" alt="Lumber" title="Wood" />750 |
				<img class="r2" src="img/x.gif" alt="Clay" title="Clay" />750 |
				<img class="r3" src="img/x.gif" alt="Iron" title="Iron" />750 |
				<img class="r4" src="img/x.gif" alt="Crop" title="Crop" />750</td>
		</tr>
	</tbody>
</table>
<p class="btn">
<?php

$mode = CP;
$need_cps = ${'cp'.$mode};
$total = count($session->villages);
$need_cps = ${'cp'.CP}[$total+1];
$cps = $session->cp;

if($cps >= $need_cps) {
?>
    <button type="submit" value="ok" name="s1" id="btn_ok" class="green">
        <div class="button-container addHoverClick ">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div><div class="button-content"><?= JR_CONFIRM ?></div>
        </div>
    </button>
<?php
} else {
  print "".$cps."/".$need_cps." ".PLUS27."";
}
?>
</form>
</p>
</div>


