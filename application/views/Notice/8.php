<?php 
$tribe = $dataarray[6];
if(!$tribe) $tribe = 4;
$start = ($tribe-1)*10+1;

if($tribe == 4){
    $oCoor = $database->getCoor($dataarray[2]);
}
?>
<div id="reportWrapper">
    <div class="header">
                    <div class="headline withoutQuickNavigation">
                    <div class="subject"><?=$all['topic']?></div>
            </div>
                <div class="time">
                <?php $date = $generator->procMtime($all['time']); ?>
            <div class="text"><?php echo $date[0]." ".$date[1]; ?></div>
        </div>
        <div class="toolList">
        </div>
    </div>
    <div class="body">
    <div class="body">
    <img src="img/x.gif" class="reportImage reinforcement" alt="">
    <div class="supportReport" style="margin-top:-10px;">
        <div class="supportHeader">
            <div class="headline"><h2 class="from">sender</h2>
                <h2 class="to">
                    <svg viewBox="0 0 20 20" preserveAspectRatio="none">
                        <path d="M0 0L20 10L0 20z"></path>
                    </svg>
                    recipient</h2>
            </div>
            <div class="participants">
                <div class="from">
                <?php if($tribe == 4){
                    ?>
                <a class="player" href="spieler.php?uid=3">Natar</a><br><span>From</span><br><a class="village" href="karte.php?x=<?php echo $oCoor['x']; ?>&amp;y=<?php echo $oCoor['y']; ?>"><?php echo UNOCCUPIEDOASES; ?> (<?php echo $oCoor['x']; ?>|<?php echo $oCoor['y']; ?>)</a></div>
                    <?php
                }else{
                    ?>
                    <a class="player" href="spieler.php?uid=<?=$dataarray[0]?>"><?=$dataarray[1]?></a><br><span>From</span><br><a class="village" href="karte.php?d=<?php echo $dataarray[2]; ?>&amp;c=<?php echo $generator->getMapCheck($dataarray[2]); ?>"><?php echo $dataarray[3]; ?></a></div>
                    <?php
                }
                   ?>
                <div class="to">
                    <a class="player" href="spieler.php?uid=<?=$dataarray[20]?>"><?=$dataarray[21]?></a><br><span>to</span><br><a class="village" href="karte.php?d=<?=$dataarray[18]?>"><?=$dataarray[19]?></a>
					</div>
            </div>
        </div>
        <table class="supportTroops" cellpadding="0" cellspacing="0">

<thead><tr>
<tbody class="units"><tr>
<td>&nbsp;</td>
<?php
for($i=$start;$i<=($start+9);$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".constant('U'.$i)."\" alt=\"\" /></td>";
}
echo "<tbody class=\"units last\"><tr><th><i class=\"troopCount\"></i></th>";
for($i=7;$i<=16;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\" style=\"font-size: 11px;\">0</td>";
    }
    else {
    echo "<td style=\"font-size: 11px;\">".number_format($dataarray[$i])."</td>";
    }
}
	

?></tr></tbody></table>
<table class="additionalInformation">
            
        </table>
<div class="clear"></div>
				</div>
				</div>
		</div>
</div>