<?php

$time = $all['time'];
$data = $all['data'];
$dataarray = explode(",",$data);
//print_r($dataarray);
?>
<div class="paper" id="report_surround">
	<div class="layout">
		<div class="paperTop">
			<div class="paperContent">
				<div id="subject">
					<div class="header label"><?=rpts6?>:</div>
					<div class="header text"><?=$all['topic']?> </div>
				<div class="clear"></div>
				</div>

				<div id="time">
						<?php
                $date = $generator->procMtime($all['time']); ?>
					<div class="header label"><?=rpts8?>:</div>
					<div class="header text"><?php echo $date[0]." in ".$date[1]; ?></div>
				</div>
			<div id="message">
					<img src="img/x.gif" class="reportImage reportType6" alt="">					<table id="attacker" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<td class="role"><div class="boxes boxesColor red">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf"><div class="role"><?=rpts11?></div>	</div>
</div></td><td class="troopHeadline" colspan="10"><p><a href="spieler.php?uid=<?php echo $database->getUserField($dataarray[0],"id",0); ?>"><?php echo $database->getUserField($dataarray[0],"username",0); ?></a> <?=rpts4?> <a href="karte.php?d=<?php echo $dataarray[1]."&amp;c=".$generator->getMapCheck($dataarray[1]); ?>"><?php echo $database->getVillageField($dataarray[1],"name"); ?></a></p></td>
</tr>
</thead>
<tbody class="units">
<tr>
<tr><th class="coords"></th>
<?php
$tribe = $dataarray[2];
$start = ($tribe-1)*10+1;
for($i=$start;$i<($start+9);$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";

echo "</tr><tr><th>".rpts0."</th>";
for($i=3;$i<12;$i++) {
if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
if($dataarray[12] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".$dataarray[12]."</td>";
    }
echo "<tr><tbody class=\"units last\"><th>".rpts1."</th>";
for($i=13;$i<22;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
if($dataarray[22] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".$dataarray[22]."</td>";
    }
echo "</tr></tbody>";
?>
</table>

<?php
$targettribe=$dataarray['25'];
       if ($targettribe==1){  $start=1; }elseif($targettribe==2){$start=11;}elseif($targettribe==3){$start=21;}elseif($targettribe==4){$start=31;}elseif($targettribe==5){$start=41;}elseif($targettribe==6){$start=51;}
?>
	  <table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<td class="role"><div class="boxes boxesColor green">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf"><div class="role"><?=rpts9?></div>	</div>
	 </div></td><td class="troopHeadline" colspan="10"><p><?php  echo'<a href="spieler.php?uid='.$database->getUserField($dataarray[24],"id",0).'">'.$database->getUserField($dataarray[23],"username",0).'</a> '.rpts4.'  <a href="karte.php?d='.$dataarray[24].'&amp;c='.$generator->getMapCheck($dataarray[24]).'">'.$database->getVillageField($dataarray[24],"name").'</a>';  ?></p></td>
	</tr></thead>
	<tbody class="units">
	<tr><th class="coords"></th>


	<?php
for($i=$start;$i<($start+9);$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
 echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
 echo "</tr><tr><th>".rpts0."</th>";
for($i=1;$i<10;$i++) {
    	echo "<td class=\"unit none\">?</td>";
}
echo "<td class=\"unit none last\">?</td>";
echo "<tr><tbody class=\"units last\"><th>".rpts1."</th>";
for($i=1;$i<10;$i++) {
    	echo "<td class=\"unit none\">?</td>";

}
echo "<td class=\"unit none last\">?</td>";
?>
</tr></tbody></table>

    	</div>
			</div>
		</div>
		<div class="paperBottom"></div>
	</div>
</div>