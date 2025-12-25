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
        <img src="img/x.gif" class="tribe tribe<?php echo $database->getUserInfo($dataarray[37])['tribe']; ?> defender won" alt="">
    </div>
    <div class="role attacker">
    <div class="header">
        <div class="avatar">
            <i class="tribeIcon bigTribe2"> </i>
            <img src="img/svg/combat/svgAttack.svg" alt="attack">
        </div>
        <h2>attack</h2>
        <div class="outcome">
            <div class="arrowWrapper">
                <svg class="outcomeArrow" viewBox="0 0 20 20" preserveAspectRatio="none">
                        <path d="M0 0L20 10L0 20z"></path>
                </svg>
            </div>
                <img class="losses attack" src="img/svg/combat/svgAttack.svg">
                <img class="loot lootHalf" src="img/svg/combat/svgLootHalf.svg">
            </div>
        </div>
        <div class="troopHeadline ">
        <div >
            <!--<span class="inline-block">[<a href="allianz.php?aid=101">No War</a>]</span>-->
            <a class="player" href="spieler.php?uid=<?=$dataarray[0]?>"><?=$dataarray[1]?></a> <?=REPORT_FROM_VIL?> <a class="village" href="karte.php?d=<?=$dataarray[2]."&amp;c=".$generator->getMapCheck($dataarray[2]); ?>"><?=$dataarray[3]?></a>
        </div>
        <!--
        <div class="toolList">
            <a class="iconButton" href="build.php?id=39&amp;tt=3&amp;bid=1520999"><i class="simulate"></i></a>
        </div>
        -->
    </div>
    <table id="attacker" class="attacker" cellpadding="0" cellspacing="0">
    <tbody class="units ">

    <tr><th class="coords"></th>


<?php
$tribe = $dataarray[4];
$start = ($tribe-1)*10+1;
for($i=$start;$i<=($start+9);$i++) {
	echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".constant('U'.$i)."\" alt=\"\" /></td>";
}

	echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";

echo "</tr><tr><th><i class=\"troopCount\"> </i></th>";
for($i=5;$i<=14;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".number_format($dataarray[$i])."</td>";
    }
}
if($dataarray[15] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    echo "<td class=\"unit last\">".number_format($dataarray[15])."</td>";
    }

echo "<tbody class=\"units last\"><tr><th><i class=\"troopDead\"></i></th>";
for($i=17;$i<=26;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td>".number_format($dataarray[$i])."</td>";
    }
	
}
if($dataarray[27] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".number_format($dataarray[27])."</td>";
    }

?>
</tr></tbody></table>					<div class="clear"></div>
				</div>
			</div>
		</div>