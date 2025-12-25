<?php
$dataarray = explode(",",$all['data']);

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
        
        <div class="toolList">
        <?php if($dataarray[0] == $session->uid){ ?>

            <a class="iconButton" title="return attack" href="build.php?t=2&id=39&z=<?php echo $dataarray[39]; ?>&nid=<?php echo $_GET['id']; ?>&re"><i style="top:-3px" class="simulate"></i></a>
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


echo "</tr><tr><th><i class=\"troopCount\"> </i></th>";
for($i=5;$i<=14;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
if(!$dataarray[15]){
    echo "<td class=\"unit none last\">".$dataarray[15]."</td>";
}else{
    echo "<td class=\"unit last\">".$dataarray[15]."</td>";
}
echo "</tbody>";
echo "<tbody class=\"units last\">";
echo "<tr><th><i class=\"troopDead\"></i></th>";
for($i=16;$i<=25;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}

if(!$dataarray[26]){
    echo "<td class=\"unit none last\">".$dataarray[26]."</td>";
}else{
    echo "<td class=\"unit last\">".$dataarray[26]."</td>";
}

echo "</tr>";
if($all['data1']!=''){
    $datar=explode(',',$all['data1']);
    echo "<tr><th>".rpts2."</th>";
    for($i=0;$i<=9;$i++) {
        if($datar[$i] == 0) {
            echo "<td class=\"none\">0</td>";
        }
        else {
            echo "<td>".$datar[$i]."</td>";
        }
    }

        echo "<td class=\"unit last\">".$datar[10]."</td>";
}
for($i=0,$x=16,$z=5,$ii=0;$i<=9;$i++) {
    if($dataarray[$z] == 0){
        $ii++;
    }
    if($dataarray[$x] + $datar[$i] == $dataarray[$z] && $dataarray[$z] != 0){
        $ii++;
    }
    $x++; $z++;
}

echo '</tbody><tbody><tr><td class="empty" colspan="12"></td></tr></tbody></table>';
echo '<tbody><tr><td class="empty" colspan="12"></td></tr></tbody>';

echo '<table class="additionalInformation">';
if ($dataarray[32]){ //ram
?>
	<tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
	<img class="unit u<?=($dataarray[4]-1)*10+7; ?>" src="img/x.gif" alt="Ram" title="Ram" />
	<?= $dataarray[32]; ?>
    </td></tr></tbody>
<?php }
if($all['data1']!='' && $datar[11]!=''){?>
    <tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
<?php
echo "<img src=\"".GP_LOCATE."img/u/98.gif\"   alt=\"Trap\" title=\"Trap\" /> ".$datar[11];
}

if ($dataarray[33]){ //cata
?>
	<tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
	<img class="unit u<?=($dataarray[4]-1)*10+8; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
	<?= $dataarray[33]; ?>
    </td></tr></tbody>
<?php }
if ($dataarray[34]){ //cata
?>
	<tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
	<img class="unit u<?=($dataarray[4]-1)*10+8; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
	<?= $dataarray[34]; ?>
    </td></tr></tbody>
<?php }
if ($dataarray[35]){ //chief
?>
	<tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
	<img class="unit u<?=($dataarray[4]-1)*10+9; ?>" src="img/x.gif" alt="Chief" title="Chief"  />
	<?= $dataarray[35]; ?>
    </td></tr></tbody>
<?php }

if ($dataarray[36]){ //hero
?>
    <tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
    <img class="unit uhero" src="img/x.gif" />
    <?= $dataarray[36]; ?>
    </td></tr></tbody>
<?php } ?>
<tbody class="goods">
    <tr>
        <th><?php echo REPORT_BOUNTY; ?></th>
        <td colspan="11">
        <div class="res">
        <div class="inlineIconList resourceWrapper">
            <div class="inlineIcon resources">
                <i class="r1"></i>
                <span class="value "><?php echo number_format($dataarray[27]); ?></span>
            </div>
            
            <div class="inlineIcon resources">
                <i class="r2"></i>
                <span class="value "><?php echo number_format($dataarray[28]); ?></span>
            </div>
            <div class="inlineIcon resources">
                <i class="r3"></i>
                <span class="value "><?php echo number_format($dataarray[29]); ?></span>
            </div>
            
            <div class="inlineIcon resources">
                <i class="r4"></i>
                <span class="value "><?php echo number_format($dataarray[30]); ?></span>
            </div>
        </div>
        </div>
        <div class="clear"></div>
        <div class="carry">
        <?php
            if ($dataarray[29]+$dataarray[30]+$dataarray[27]+$dataarray[28] == 0) {
                echo"<img title=\"";
                echo ($dataarray[29]+$dataarray[30]+$dataarray[27]+$dataarray[28])."/".$dataarray[31];
                echo"\" src=\"img/x.gif\" class=\"carry empty\">";
            } elseif ($dataarray[29]+$dataarray[30]+$dataarray[27]+$dataarray[28] != $dataarray[31]) {
                echo "<img title=\"";
                echo ($dataarray[29]+$dataarray[30]+$dataarray[27]+$dataarray[28])."/".$dataarray[31];
                echo"\" src=\"img/x.gif\" class=\"carry half\">";
            } else {
                echo"<img title=\"";
                echo ($dataarray[29]+$dataarray[30]+$dataarray[27]+$dataarray[28])."/".$dataarray[31];
                echo"\" src=\"img/x.gif\" class=\"carry full\">";
            }
        ?>
        <?php echo number_format($dataarray[29]+$dataarray[30]+$dataarray[27]+$dataarray[28])."/".number_format($dataarray[31]); ?></div></td></tr></tbody>

    </tbody></table>
    </div>

    <?php
$targettribe=$dataarray['41'];
$l=41;
$k=$m=42;
//echo $database->getUserInfo($dataarray[37])['tribe'];
for($y=0;$y<=MAX_TRIBE-1;$y++) {
    //echo $y;
    //echo $y;
    $k++;
    $m++;
    $l++;
    /*echo $database->getUserInfo($dataarray[37])['tribe'];
    echo "<br>";
    echo $y+1;
    echo '__________';
    echo "<br>";*/
    //echo $dataarray[$l+$y*22]; echo "<br>";

    // iRedux -> Review this later
    /*if($targettribe == 6 || $targettribe == 7){
        if($dataarray[$l+$y*22]==0){
            $PASS = TRUE;
        }
    }else{
        if ($dataarray[$l+$y*22]>0){
            $PASS = TRUE;
        }
    }*/
if ($dataarray[$l+$y*22]>0 && $database->getUserInfo($dataarray[37])['tribe'] == $y+1){
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

        <?php if($dataarray[41]==$y+1){ echo'<a class="player" href="spieler.php?uid='.$dataarray[37].'">'.$dataarray[38].'</a> From <a class="village" href="karte.php?d='.$dataarray[39].'&amp;c='.$generator->getMapCheck($dataarray[39]).'">'.$dataarray[40].'</a></p>'; } else { echo OTPRAV2; } ?>
            </div>
        
        <!--<div class="toolList">
            <a class="iconButton" href="build.php?id=39&amp;tt=3&amp;bid=1520999"><i class="simulate"></i></a>
        </div>-->
    </div>
    <table id="defender" class="defender" cellpadding="0" cellspacing="0">
                <tbody class="units">
                <tr><th class="coords"></th>


	<?php
for($i=$y*10+1;$i<=$y*10+10;$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".constant('U'.$i)."\" alt=\"\" /></td>";
}
	echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
echo "</tr><tr><th><i class=\"troopCount\"> </i></th>";
for($i=$k;$i<=$k+9;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
//echo$k+9;
//echo "<br>";
	if($dataarray[$k+10] != 0) {
	echo "<td class=\"unit last\">".$dataarray[$k+10]."</td></tr></tbody>";}
	else {
	echo "<td class=\"unit none last\">0</td></tr></tbody>";}
    $k+=11;
	
echo "<tbody class=\"units last\"><tr><th><i class=\"troopDead\"></i></th>";

for($i=$k;$i<=$k+9;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
// iRedux - fix the hero bug
if($dataarray[$k+10] != 0) {
	echo "<td class=\"unit last\">".$dataarray[$k+10]."</td></tr></tbody></table></div>";}
	else {
	echo "<td class=\"unit none last\">0</td></tr></tbody></table></div>";}
$k+=11;
?>
<?php } $m+=22; $k=$m; }  ?>

<?php
$targettribe=$dataarray['41'];
$l=41;
$k=$m=42;
//echo $database->getUserInfo($dataarray[37])['tribe'];
for($y=0;$y<=MAX_TRIBE-1;$y++) {
    //echo $y;
    $k++;
    $m++;
    $l++;
if ($dataarray[$l+$y*22]>0 && $database->getUserInfo($dataarray[37])['tribe'] != $y+1){
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

        <?php if($dataarray[41]==$y+1){ echo'<a class="player" href="spieler.php?uid='.$dataarray[37].'">'.$dataarray[38].'</a> From <a class="village" href="karte.php?d='.$dataarray[39].'&amp;c='.$generator->getMapCheck($dataarray[39]).'">'.$dataarray[40].'</a></p>'; } else { echo OTPRAV2; } ?>
            </div>
        
        <!--<div class="toolList">
            <a class="iconButton" href="build.php?id=39&amp;tt=3&amp;bid=1520999"><i class="simulate"></i></a>
        </div>-->
    </div>
    <table id="defender" class="defender" cellpadding="0" cellspacing="0">
                <tbody class="units">
                <tr><th class="coords"></th>


	<?php
for($i=$y*10+1;$i<=$y*10+10;$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".constant('U'.$i)."\" alt=\"\" /></td>";
}
	echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
echo "</tr><tr><th><i class=\"troopCount\"> </i></th>";
for($i=$k;$i<=$k+9;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
//echo$k+9;
//echo "<br>";
	if($dataarray[$k+10] != 0) {
	echo "<td class=\"unit last\">".$dataarray[$k+10]."</td></tr></tbody>";}
	else {
	echo "<td class=\"unit none last\">0</td></tr></tbody>";}
    $k+=11;
	
echo "<tbody class=\"units last\"><tr><th><i class=\"troopDead\"></i></th>";

for($i=$k;$i<=$k+9;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
// iRedux - fix the hero bug
if($dataarray[$k+10] != 0) {
	echo "<td class=\"unit last\">".$dataarray[$k+10]."</td></tr></tbody></table></div>";}
	else {
	echo "<td class=\"unit none last\">0</td></tr></tbody></table></div>";}
$k+=11;
?>
<?php } $m+=22; $k=$m; }  ?>
</tr></tbody></table>
                <div class="clear"></div>
	
			</div>
		</div>
