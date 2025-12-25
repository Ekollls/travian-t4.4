<?php
$units = $database->getMovement("34",$village->wid,1);
$total_for = count($units);
$send = $database->getMovement("1",$village->wid,1);
$total_for2 = count($send);
 $total_artefact = $database->checkArtefactsEffects($session->uid,$village->wid,3);
if(!isset($timer)){$timer=1;}
for($y=0;$y < $total_for;$y++){
$res=$units[$y];

if ($units[$y]['sort_type']==3){
	if ($units[$y]['attack_type']==1){
		$actionType = "Coming back from ";
	} else if ($units[$y]['attack_type']==2){
		$actionType = "Reinforcement for ";
	} else if ($units[$y]['attack_type']==3){
		$actionType = "Attack on ";
	} else if ($units[$y]['attack_type ']==4){
		$actionType = "Raid on ";
	}
	$info=$database->getUserVillInfoByVillageID($units[$y]['from']);
	$reinfowner = $info['id'];
	if($units[$y]['attack_type'] != 1){
	if($units[$y]['from'] != 0){
				  if($units[$y]['t11'] != 0 && $reinfowner == $session->uid) {
                  $colspan = 11;
				  }else{
				  $colspan = 10;
				  }
		echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$units[$y]['from']."&c=".$generator->getMapCheck($units[$y]['from'])."\">".$info['name']."</a></td>
                  <td colspan=\"".$colspan."\">";
                  echo "<b>$actionType</b><a href=\"karte.php?d=".$units[$y]['from']."\">".$village->vname."</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $info['tribe'];
                  $start = ($tribe-1)*10+1;
				  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u".$i."\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
                  }

                    if($units[$y]['t11'] != 0 && $reinfowner == $session->uid) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
                  }
                  echo "</tr><tr><th>Troops</th>";
                  $totalunits = $units[$y]['t1']+$units[$y]['t2']+$units[$y]['t3']+$units[$y]['t4']+$units[$y]['t5']+$units[$y]['t6']+$units[$y]['t7']+$units[$y]['t8']+$units[$y]['t9']+$units[$y]['t10']+$units[$y]['t11'];

                  for($i=1;$i<=$colspan;$i++) {
				  if($units[$y]['attack_type'] == 2){
				  if($reinfowner != $session->uid){
						echo "<td class=\"none\">?</td>";
				  }else{



            	if($units[$y]['t'.$i] == 0) {
                	echo "<td class=\"none\">0</td>";
                }
                else {
                echo "<td>";
                echo $units[$y]['t'.$i]."</td>";
				}
				  }}else{

				  if($totalunits > $building->getTypeLevel(16) && $total_artefact == 1){
                 		echo "<td class=\"none\">?</td>";
                  }else{
				  if($units[$y]['t'.$i] == 0) {
                    echo "<td class=\"none\">0</td>";
				  }else{
					echo "<td>?</td>";
                  }
				  }
				  }
				  }
                  echo "</tr></tbody>";
                  echo '
                  <tbody class="infos">
									<tr>
										<th>Crop consumption</th>
										<td colspan="'.$colspan.'">
										<div class="in small"><span id=timer'.($units[$y]['endtime']-time()).'>'.$generator->getTimeFormat($units[$y]['endtime']-time()).'</span></div>';
										    $datetime = $generator->procMtime($units[$y]['endtime']);
										    echo "<div class=\"at small\">";
										    if($datetime[0] != "today") {
										    echo "".$datetime[0]." ";
										    }
										    echo "в ".$datetime[1]."</div>
											</div>
										</td>
									</tr>
								</tbody>";
		echo "</table>";
		}
	}
}else if ($units[$y]['sort_type']==4){
	if ($units[$y]['attack_type']==1){
		$actionType = "Back from ";
	} else if ($units[$y]['attack_type']==2){
		$actionType = "Strengthen ";
	} else if ($units[$y]['attack_type']==3){
		$actionType = "Back from ";
	} else if ($units[$y]['attack_type']==4){
		$actionType = "Back from ";
	}
    $actionType = "Return from captivity ";

$to = $database->getMInfo($units[$y]['vref']);
$tryv=$database->checkOasisExist($units[$y]['from']);

if($tryv==true){
	$vname="The oasis";
	}elseif ($units[$y]['attack_type']==88){
    $vname = "The evasion. ";
}else{$vname=$database->getVillageField($units[$y]['from'],"name");}
?>
<table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td class="role"><a href="karte.php?d=<?php echo $village->wid."&c=".$generator->getMapCheck($village->wid); ?>"><?php echo  $village->vname; ?></a></td>
			<td colspan="<?php if($units[$y]['t11'] != 0) {echo"11";}else{echo"10";}?>"><a href="karte.php?d=<?php echo $units[$y]['from']."&c=".$generator->getMapCheck($units[$y]['from']); ?>"><?php echo "Back from ".$vname; ?></a></td>
		</tr>
	</thead>
	<tbody class="units">
			<?php

				  $tribe = $session->tribe;
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u".$i."\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
                  }
                  if($units[$y]['t11'] != 0 ) {
                   echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
                  }
			?>
			</tr>
      <tr><th>Troops</th>
            <?php
            for($i=1;$i<($units[$y]['t11'] != 0?12:11);$i++) {
            	if($units[$y]['t'.$i] == 0) {
                	echo "<td class=\"none\">0</td>";
                }
                else {
                echo "<td>";
                echo $units[$y]['t'.$i]."</td>";
                }
			}
            ?>
           </tr>
            <?php
			$totalres = $res['wood']+$res['clay']+$res['iron']+$res['crop'];
			if($units[$y]['attack_type']!=2 and $units[$y]['attack_type']!=1 and $totalres != ""){?>
       <tr><th>Resources</th>

			<td colspan="<?php if($units[$y]['t11'] == 0) {echo"10";}else{echo"11";}?>">
			<?php
			$totalcarry = $units[$y]['t1']*${'u'.$start.''}['cap']+$units[$y]['t2']*${'u'.($start+1).''}['cap']+$units[$y]['t3']*${'u'.($start+2).''}['cap']+$units[$y]['t4']*${'u'.($start+3).''}['cap']+$units[$y]['t5']*${'u'.($start+4).''}['cap']+$units[$y]['t6']*${'u'.($start+5).''}['cap']+$units[$y]['t7']*${'u'.($start+6).''}['cap']+$units[$y]['t8']*${'u'.($start+7).''}['cap']+$units[$y]['t9']*${'u'.($start+8).''}['cap']+$units[$y]['t10']*${'u'.($start+9).''}['cap'];
			echo "<div class=\"in small\"><i class=\"r1\"></i> ".number_format($res['wood'])." <i class=\"r2\"></i> ".number_format($res['clay'])." <i class=\"r3\"></i> ".number_format($res['iron'])." <i class=\"r4\"></i> ".number_format($res['crop'])."";
			echo " <img src=\"img/x.gif\" class=\"carry full\"> ".number_format($totalres)."/".number_format($totalcarry)."</div>";
            ?>
           </tr>
		   <?php } ?>
    </tbody>
		<tbody class="infos">
			<tr>
				<th>Upkeep</th>
				<td colspan="<?php if($units[$y]['t11'] == 0) {echo"10";}else{echo"11";}?>">
				<?php
				    echo "<div class=\"in small\"><span class='timer' counting='down' value='".($units[$y]['endtime']-time())."'>".$generator->getTimeFormat($units[$y]['endtime']-time())."</span></div>";
				    $datetime = $generator->procMtime($units[$y]['endtime']);
				    echo "<div class=\"at small\">";
				    if($datetime[0] != "today") {
				    echo " ".$datetime[0]." ";
				    }
				    echo "в ".$datetime[1]."</div>";
    		?>
					</div>
				</td>
			</tr>
		</tbody>
          </table>



<?php        }
$timer++;
}

		$oasis = $village->oasisowned;
        $total_for33=0;
        $iatt=1;
		foreach($oasis as $oa){
$oasistroo[$iatt] = $database->getMovement("33",$oa['wref'],1);
$iatt++;
$total_for33 += count($database->getMovement("33",$oa['wref'],1));
}

for($t=1;$t <=3;$t++){
	if(count($oasistroo[$t])>0){
		foreach ($oasistroo[$t] as $oasistroop){
$vname=$database->getVillageField($oasistroop['from'],"name");
		echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$oasistroop['from']."&c=".$generator->getMapCheck($oasistroop[$t]['from'])."\">".$vname."</a></td>
                  <td colspan=\"10\">";
                  echo "<b>Attack on your </b><a href=\"karte.php?d=".$oasistroop['from']."\">Оазис</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $database->getUserTribeByOasisID($oasistroop['to']);
                  $start = ($tribe-1)*10+1;
				  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u".$i."\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
                  }

                  echo "</tr><tr><th>Troops</th>";
                  for($i=1;$i<=10;$i++) {


						echo "<td class=\"none\">?</td>";
				  }

				?>
           </tr>

		<tbody class="infos">
			<tr>
				<th>Upkeep</th>
				<td colspan="10">
				<?php
				    echo "<div class=\"in small\"><span class='timer' counting='down' value='".($oasistroop['endtime']-time())."'>".$generator->getTimeFormat($oasistroop['endtime']-time())."</span></div>";
				    $datetime = $generator->procMtime($oasistroop['endtime']);
				    echo "<div class=\"at small\">";
				    if($datetime[0] != "today") {
				    echo $datetime[0]." ";
				    }
				    echo "в ".$datetime[1]."</div>";
			          ?>
					</div>
				</td>
			</tr>
		</tbody>
</table>
	 <?php
	 }
	 }
    $timer++;
				    }

    		?>
