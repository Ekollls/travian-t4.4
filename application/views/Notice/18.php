<?php
$dataarray = explode(",",$all['data']);
//print_r($dataarray);
?>

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
for($i=$start;$i<($start+9);$i++) {
	echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".constant('U'.$i)."\" alt=\"\" /></td>";
}
echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".constant('U'.$i)."\" alt=\"\" /></td>";
echo "</tr><tr><th><i class=\"troopCount\"> </i></th>";
for($i=5;$i<14;$i++) {//героя не inключаем(15)
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
if($dataarray[14] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".$dataarray[14]."</td>";
    }
echo "<tr><tbody class=\"units last\"><th><i class=\"troopDead\"></i></th>";
for($i=16;$i<25;$i++) { //героя не inключаем(26)
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
if($dataarray[25] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".$dataarray[25]."</td>";
    }

echo "</tr></tbody>";
echo '</table>';
echo '<table class="additionalInformation">';

if($dataarray[27]==1){

//spy
?>
            <th><?php echo REPORT_BOUNTY; ?></th>
        <td colspan="11">
        <div class="res">
        <div class="inlineIconList resourceWrapper">
            <div class="inlineIcon resources">
                <i class="r1"></i>
                <span class="value "><?php echo number_format($dataarray[28]); ?></span>
            </div>
            
            <div class="inlineIcon resources">
                <i class="r2"></i>
                <span class="value "><?php echo number_format($dataarray[29]); ?></span>
            </div>
            <div class="inlineIcon resources">
                <i class="r3"></i>
                <span class="value "><?php echo number_format($dataarray[30]); ?></span>
            </div>
            
            <div class="inlineIcon resources">
                <i class="r4"></i>
                <span class="value "><?php echo number_format($dataarray[31]); ?></span>
            </div>
        </div>
        </div>
        <div class="clear"></div>
        <div class="carry">
        <?php
            
                echo"<img title=\"";
                echo number_format($dataarray[30]+$dataarray[31]+$dataarray[28]+$dataarray[29]);
                echo"\" src=\"img/x.gif\" class=\"carry full\">";
            
        ?>
        <?php echo number_format($dataarray[29]+$dataarray[30]+$dataarray[27]+$dataarray[28]); ?></div></td></tr></tbody>
</tbody>
<?php }elseif($dataarray[27]==2){?>
            <tbody class="goods"><tr><th><?=rpts3?></th><td colspan="10">
			<?php 

echo "<img src=\"".GP_LOCATE."img/g/g26-ltr.gif\" height=\"20\" width=\"20\" alt=\"Palace\" title=\"Palace\" /> ".$dataarray[28];
echo "<br/><img src=\"".GP_LOCATE."img/g/g23-ltr.gif\" height=\"20\" width=\"20\" alt=\"Cranny\" title=\"Cranny\" />".$dataarray[29]."<br>".$dataarray[30];

} ?>
    </tbody></table>
    </div>

<?php
$targettribe=$dataarray['37'];

$l=37;
$k=$m=38;
for($y=0;$y<=MAX_TRIBE-1;$y++) {
    $k++;
    $l++;
    $m++;
    if ($dataarray[$l+$y*11]>0){
 ?>
     <div class="role defender">
    <div class="header">
        <div class="avatar">
            <i class="tribeIcon bigTribe2"> </i>
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

        <?php if($dataarray[37]==$y+1){ 
            echo'<a class="player" href="spieler.php?uid='.$dataarray[33].'">'.$dataarray[34].'</a> From <a class="village" href="karte.php?d='.$dataarray[35].'&amp;c='.$generator->getMapCheck($dataarray[35]).'">'.$dataarray[36].'</a></p>'; 
        } else {
             echo rpts5.'</p>'; 
             } ?>
            </div>
			</div>
    	<table id="defender" class="defender" cellpadding="0" cellspacing="0">
		<tbody class="units">
                <tr><th class="coords"></th>


                <?php
                for($i=$y*10+1;$i<=$y*10+10;$i++) {
                    echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
                }
                echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";

                echo "</tr><tr><th><i class=\"troopCount\"></i></th>";
                for($i=$k;$i<$k+10;$i++) {
                    if($dataarray[$i] == 0) {
                        echo "<td class=\"none\">0</td>";
                    }
                    else {
                        echo "<td>".$dataarray[$i]."</td>";
                    }
                }
				if($dataarray[$i++] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".$dataarray[$i--]."</td>";
    }
				
                echo "<tr><tbody class=\"units last\"><th><i class=\"troopDead\"></i></th>";
                for($i=0;$i<10;$i++) {
                        echo "<td class=\"unit none\">0</td>";

                }
				echo "<td class=\"unit none last\">0</td>";
                ?>
            </tr></tbody></table></div>
    <?php } $m+=11; $k=$m; }  ?>
</div></div>