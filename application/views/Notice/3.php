<div id="reportWrapper">
    <div class="header">
        <div class="headline withoutQuickNavigation">
        <div class="subject"><?=$all['topic']?>.</div>
        </div>

        <div class="time">
            <?php $date = $generator->procMtime($all['time']); ?>
            <div class="text"><?= $date[0]." ".$date[1]; ?></div>
        </div>

		</div>
		<div class="body">
		<div class="victory">
			<img src="img/x.gif" class="reportImage outcome wonLost" alt="">
			<img src="img/x.gif" class="tribe tribe<?php echo $database->getUserInfo($dataarray[0])['tribe']; ?> attacker lost" alt="">
			<img src="img/x.gif" class="tribe tribe<?php echo $database->getUserInfo($dataarray[27])['tribe']; ?> defender won" alt="">
		</div>
		<div class="role attacker">
    <div class="header">
        <div class="avatar">
            <i class="tribeIcon bigTribe<?php echo $database->getUserInfo($dataarray[0])['tribe']; ?>"> </i>
            <img src="img/svg/combat/svgAttack.svg" alt="attack">
        </div>
        <h2>attack</h2>
        <div class="outcome">
            <div class="arrowWrapper">
                <svg class="outcomeArrow" viewBox="0 0 20 20" preserveAspectRatio="none">
                        <path d="M0 0L20 10L0 20z"></path>
                </svg>
            </div>
                <img class="losses attack" src="img/svg/combat/svgAttackLost.svg">
                <img class="loot lootHalf" src="img/svg/combat/svgSkull.svg">
            </div>
        </div>
        <div class="troopHeadline ">
        <div >
		
            <!--<span class="inline-block">[<a href="allianz.php?aid=101">No War</a>]</span>-->
            <a class="player" href="spieler.php?uid=<?=$dataarray[0]?>"><?=$dataarray[1]?></a> <?=REPORT_FROM_VIL?> <a class="village" href="karte.php?d=<?=$dataarray[2]."&amp;c=".$generator->getMapCheck($dataarray[2]); ?>"><?=$dataarray[3]?></a>
        </div>
        <div class="toolList">
            <?php if($dataarray[0] == $session->uid){ ?>
                <a class="iconButton" title="return attack" href="build.php?t=2&id=39&z=<?php echo $dataarray[29]; ?>&nid=<?php echo $_GET['id']; ?>&re"><i style="top:-3px" class="simulate"></i></a>
            <?php } ?>
        </div>
    </div>
	<table id="attacker" class="attacker" cellpadding="0" cellspacing="0">
    <tbody class="units ">
    <tr><th class="coords"></th>
<?php
$start = ($dataarray[4]-1)*10+1;
for($i=$start;$i<=($start+9);$i++) {
	echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".constant('U'.$i)."\" alt=\"\" /></td>";
}
	echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";


echo "</tr></tbody><tbody class=\"units\"><tr><th><i class=\"troopCount\"> </i></th>";
for($i=5;$i<15;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".number_format($dataarray[$i])."</td>";
    }
}
if($dataarray[15] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".number_format($dataarray[15])."</td>";
    }


echo "</tr></tbody><tbody class=\"units last\"><tr><th><i class=\"troopDead\"></i></th>";
for($i=16;$i<26;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".number_format($dataarray[$i])."</td>";
    }
}
if($dataarray[26] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".number_format($dataarray[26])."</td>";
    }
if($all['data1']!=''){
    $datar=explode(',',$all['data1']);
    echo "<tr><th>".rpts2."</th>";
    for($i=0;$i<=10;$i++) {
        if($datar[$i] == 0) {
            echo "<td class=\"unit none\">0</td>";
        }
        else {
           echo "<td class=\"unit\">".number_format($datar[$i])."</td>";
        }
    }

}
echo '</table>';
echo '<table class="additionalInformation">';

if ($dataarray[32]){ //ram
?>
	<tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
	<img class="unit u<?=($dataarray[4]-1)*10+7; ?>" src="img/x.gif" alt="Ram" title="Ram" />
	<?php echo $dataarray[32]; ?>
    </td></tr></tbody>
<?php }
if ($dataarray[33]){ //cata
?>
	<tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
	<img class="unit u<?=($dataarray[4]-1)*10+8; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
	<?php echo $dataarray[33]; ?>
    </td></tr></tbody>
<?php }
if ($dataarray[34]){ //cata
?>
	<tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
	<img class="unit u<?=($dataarray[4]-1)*10+8; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
	<?php echo $dataarray[34]; ?>
    </td></tr></tbody>
<?php }
if ($dataarray[35]){ //герой
?>
	<tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
	<img class="unit uhero" src="img/x.gif" alt="hero" title="hero" />
	<?php echo $dataarray[35]; ?>
    </td></tr></tbody>
<?php } ?>
<?php
echo "</tr></tbody>"; ?>
</table>
    </div>

    <div class="role defender">
    <div class="header">
        <div class="avatar">
            <i class="tribeIcon bigTribe<?php echo $database->getUserInfo($dataarray[27])['tribe']; ?>"> </i>
            <img src="img/svg/combat/svgDefend.svg" alt="Defense">
        </div>
        <h2>Defense</h2>
        <div class="outcome">
            <div class="arrowWrapper">
                <svg class="outcomeArrow" viewBox="0 0 20 20" preserveAspectRatio="none">
                    <path d="M0 0L20 10L0 20z"></path>
                </svg>
            </div>
                            <img class="losses defend" src="img/svg/combat/svgDefend.svg">
                                </div>
    </div>
    <div class="troopHeadline ">
        <div >
        <a class="player" href="spieler.php?uid=<?php echo $dataarray[27]; ?>"><?php echo $dataarray[28]; ?></a> From <a class="village" href="karte.php?d=<?php echo $dataarray[29]; ?>&amp;c=<?php echo $generator->getMapCheck($dataarray[29]); ?>"><?php echo $dataarray[30]; ?></a></p>
            </div>
        
        <!--<div class="toolList">
            <a class="iconButton" href="build.php?id=39&amp;tt=3&amp;bid=1520999"><i class="simulate"></i></a>
        </div>-->
    </div>
    <table id="defender" class="defender" cellpadding="0" cellspacing="0">
                <tbody class="units">
                <tr><th class="coords"></th>



	<?php
    $start = ($dataarray[31]-1)*10+1;
for($i=$start;$i<($start+9);$i++) {
	echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".(constant('U'.$i))."\" alt=\"\" /></td>";
}

echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".(constant('U'.$i))."\" alt=\"\" /></td>";
echo "</tr><tr><th><i class=\"troopCount\"> </i></th>";
for($i=1;$i<10;$i++) {
        echo "<td class=\"unit none\">?</td>";

}
echo "<td class=\"unit last none\">?</td>";
echo "<tbody class=\"units last\"><th><i class=\"troopDead\"></i></th>";
for($i=1;$i<10;$i++) {
        echo "<td class=\"none\">?</td>";
}
echo "<td class=\"unit last none\">?</td>";

?>
</tr></tbody></table>					<div class="clear"></div>
				</div>
	</div>
</div>