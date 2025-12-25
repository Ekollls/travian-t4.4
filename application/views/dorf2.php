<?php

function get_tribe(){
	global $session;
	
	switch($session->tribe){
		case 1: return "roman";
		case 2: return "teuton";
		case 3: return "gaul";
		case 6: return "egyptian";
		case 7: return "hun";
	}	
}
if($session->qData['quest'] == 7){
	$database->query("UPDATE quests SET quest = 8 WHERE userid = ".$session->uid."");
} ?>
<div id="village_map" class="tribeSpecific <?php echo DIRECTION; ?>">
<?php
	if($session->quest_progress[0]==6 && $session->quest_progress[1] == 0){
		$qst = 7;
		$_SESSION['qst'] = 7;
		$Quest->UpdateQuestProgress($session->uid,'7,0,0,0,0');
	}

    $tx = $_SESSION['wid'];
    if ($building->walling()) {
        $wtitle = $building->procResType($building->walling()) . ' Level ' . $village->resarray['f40'];
    } else {
        $wtitle = ($village->resarray['f40'] == 0) ? 'Building site' : $building->procResType($village->resarray['f40t'], 0) . ' Level ' . $village->resarray['f40'];
    }


    for ($t = 19,$x=0; $t <= 40; $t++) {
		// iRedux - WW
		if(($village->resarray['f99t'] == 40 AND ($t)=='26') or ($village->resarray['f99t'] == 40 AND ($t)=='30') or ($village->resarray['f99t'] == 40 AND ($t)=='31') or ($village->resarray['f99t'] == 40 AND ($t)=='32')) {
			if($x  == 0){ // To show only one slut

				$x++;
				$output = '<div class="buildingSlot a'.$t.' g40 aid'.$t.'">';

				// get Level
				$bindicate = $building->canBuild($t,$village->resarray['f99t']);
				$output .= '<div class="level colorLayer '.(($village->resarray['f99'] == 0) ? 'good' : ($bindicate == 1 ? 'maxLevel' : $Travian->getStatus(99))).' '.($database->getBuildingByField($tx, 99) ? 'underConstruction' : '' ).' aid99" title="'.$Travian->getTitle(99).'" onclick="window.location.href=\'build.php?id=99\'">
					<div class="labelLayer">'.$village->resarray['f99'].'</div>
				</div>';
				/* if($village->resarray['f99'] >= 0 && $village->resarray['f99'] <= 9) { $imageBuild = 'g40_0'; }
				if($village->resarray['f99'] >= 10 && $village->resarray['f99'] <= 19) { $imageBuild = 'g40_1'; }
				if($village->resarray['f99'] >= 20 && $village->resarray['f99'] <= 29) { $imageBuild = 'g40_2'; }
				if($village->resarray['f99'] >= 30 && $village->resarray['f99'] <= 39) { $imageBuild = 'g40_3'; }
				if($village->resarray['f99'] >= 40 && $village->resarray['f99'] <= 49) { $imageBuild = 'g40_4'; }
				if($village->resarray['f99'] >= 50 && $village->resarray['f99'] <= 59) { $imageBuild = 'g40_5'; }
				if($village->resarray['f99'] >= 60 && $village->resarray['f99'] <= 69) { $imageBuild = 'g40_6'; }
				if($village->resarray['f99'] >= 70 && $village->resarray['f99'] <= 79) { $imageBuild = 'g40_7'; }
				if($village->resarray['f99'] >= 80 && $village->resarray['f99'] <= 89) { $imageBuild = 'g40_8'; }
				if($village->resarray['f99'] >= 90 && $village->resarray['f99'] <= 94) { $imageBuild = 'g40_9'; }
				if($village->resarray['f99'] >= 95 && $village->resarray['f99'] <= 99) { $imageBuild = 'g40_10'; }
				if($village->resarray['f99'] == 100) { $imageBuild = 'g40_11'; } */
				if($village->resarray['f99'] >= 0 && $village->resarray['f99'] <= 9) { $imageBuild = 'g40 '.get_tribe().' g40_0 '.get_tribe(); }
				if($village->resarray['f99'] >= 10 && $village->resarray['f99'] <= 29) { $imageBuild = 'g40 '.get_tribe().' g40_1 '.get_tribe(); }
				if($village->resarray['f99'] >= 30 && $village->resarray['f99'] <= 49) { $imageBuild = 'g40 '.get_tribe().' g40_2 '.get_tribe(); }
				if($village->resarray['f99'] >= 50 && $village->resarray['f99'] <= 79) { $imageBuild = 'g40 '.get_tribe().' g40_3 '.get_tribe(); }
				if($village->resarray['f99'] >= 80 && $village->resarray['f99'] <= 99) { $imageBuild = 'g40 '.get_tribe().' g40_4 '.get_tribe(); }
				if($village->resarray['f99'] == 100 ) { $imageBuild = 'g40 '.get_tribe().' g40_5 '.get_tribe(); }

				if ($database->getBuildingByField($tx, $t)) {
					if ($village->resarray['f' . ($t)] == 0) {
						$imageBuild .= 'b';
					}
				}

				$output .= '<img src="img/x.gif" style="height:100%;width:100%" class="building '.($t == 39 ? 'g16' : $imageBuild).'">';
				$buildId = $village->resarray['f' . ($t) . 't'];
				//$output .= $Travian->getSVG($buildId, $t, $isWall);
				$output .= '</div>';
			}
		}else{
		if($_COOKIE['builder']=="Off" || !$village->resarray['f'.$t.'t'] || in_array($bindicate[$i], array(1,2,3,4,5,6,7,10,11,20,21,22)) || $session->goldclub == 0){
			$link = 'build.php?id='.$t.'';
		}else{
			$link = 'dorf2.php?а='.$t.'&c='.$session->checker.'';
		}
		if($t == 40){
			// Check if already have a wall
			if ($village->resarray['f' . ($t) . 't'] != 0) {
				$buildId = 3 .$session->tribe;
				if($buildId == 36){
					$buildId = 42;
				}
				if($buildId == 37){
					$buildId = 43;
				}
				// Wall Bottom
				$output = '<div class="buildingSlot a'.$t.' g'.$village->resarray['f' . ($t) . 't'].' bottom">';
				// get Level
				if ($village->resarray['f' . ($t) . 't'] != 0) {
					$bindicate = $building->canBuild($t,$village->resarray['f'.$t.'t']);
					$output .= '<div class="level colorLayer '.(($village->resarray['f' . ($t)] == 0) ? 'good' : ($bindicate == 1 ? 'maxLevel' : $Travian->getStatus($t))).' '.($database->getBuildingByField($tx, $t) ? 'underConstruction' : '' ).' aid'.$t.'" title="'.$Travian->getTitle($t).'" onclick="window.location.href=\''.$link.'\'">
									<div class="labelLayer">'.$village->resarray['f' . ($t)].'</div>
								</div>';
				}
				$output .= '<img src="img/x.gif" class="wall g'.$buildId.'Bottom">';

				$output .= $Travian->getSVG($buildId.'Bottom', $t, 'isWall');
				$output .= '</div>';

				// Wall Top
				$output .= '<div class="buildingSlot a'.$t.' g'.$village->resarray['f' . ($t) . 't'].' top">';
				// get Level
				if ($village->resarray['f' . ($t) . 't'] != 0) {
					$bindicate = $building->canBuild($t,$village->resarray['f'.$t.'t']);
					$output .= '<div class="level colorLayer '.(($village->resarray['f' . ($t)] == 0) ? 'good' : ($bindicate == 1 ? 'maxLevel' : $Travian->getStatus($t))).' '.($database->getBuildingByField($tx, $t) ? 'underConstruction' : '' ).' aid'.$t.'" title="'.$Travian->getTitle($t).'" onclick="window.location.href=\''.$link.'\'">
									<div class="labelLayer">'.$village->resarray['f' . ($t)].'</div>
								</div>';
				}
				$output .= '<img src="img/x.gif" class="wall g'.$buildId.'Top">';

				$output .= $Travian->getSVG($buildId.'Top', $t, 'isWall');
				$output .= '</div>';
			// No wall, just bring the svg
			}else{
				$buildId = 3 .$session->tribe;
				if($buildId == 36){
					$buildId = 42;
				}
				if($buildId == 37){
					$buildId = 43;
				}

				$output = '<div class="buildingSlot a'.$t.' g'.$village->resarray['f' . ($t) . 't'].' aid'.$t.'">';
				// get Level
				if ($village->resarray['f' . ($t) . 't'] != 0) {
					$bindicate = $building->canBuild($t,$village->resarray['f'.$t.'t']);
					$output .= '<div class="level colorLayer '.(($village->resarray['f' . ($t)] == 0) ? 'good' : ($bindicate == 1 ? 'maxLevel' : $Travian->getStatus($t))).' '.($database->getBuildingByField($tx, $t) ? 'underConstruction' : '' ).' aid'.$t.'" title="'.$Travian->getTitle($t).'" onclick="window.location.href=\''.$link.'\'">
									<div class="labelLayer">'.$village->resarray['f' . ($t)].'</div>
								</div>';
				}
				$imageBuild = $village->resarray['f' . ($t) . 't'] ? 'g'.$village->resarray['f' . ($t) . 't'] : 'iso';
				if ($database->getBuildingByField($tx, $t)) {
					if ($village->resarray['f' . ($t)] == 0) {
						$imageBuild .= 'b';
					}
				}
				$output .= $Travian->getSVG($buildId, $t);
				$output .= '</div>';
			}
		}else{ // Normal Buildings, not the wall!
			$output = '<div class="buildingSlot a'.$t.' g'.($t != 39 ? $village->resarray['f' . ($t) . 't'] : '16e' ).' aid'.$t.'">';
			// get Level
			if ($village->resarray['f' . ($t) . 't'] != 0) { //
				$bindicate = $building->canBuild($t,$village->resarray['f'.$t.'t']);
				$output .= '<div class="level colorLayer '.(($village->resarray['f' . ($t)] == 0) ? 'good' : ($bindicate == 1 ? 'maxLevel' : $Travian->getStatus($t))).' '.($database->getBuildingByField($tx, $t) ? 'underConstruction' : '' ).' aid'.$t.'" title="'.$Travian->getTitle($t).'" onclick="window.location.href=\''.$link.'\'">
								<div class="labelLayer">'.$village->resarray['f' . ($t)].'</div>
							</div>';
			}


			$imageBuild = $village->resarray['f' . ($t) . 't'] ? 'g'.($village->resarray['f' . ($t) . 't'] == 12 ? 13 : $village->resarray['f' . ($t) . 't']) : 'iso';


			if ($database->getBuildingByField($tx, $t)) {
				if ($village->resarray['f' . ($t)] == 0) {
					$imageBuild .= 'b';
				}
			}
			$tribeCss = get_tribe();
			if($t == 39){
				if ($village->resarray['f' . ($t) . 't'] != 0) {
					$output .= '<img src="img/x.gif" class="building '.($t == 39 ? 'g16' : $imageBuild).' ' . $tribeCss . '">';
				}else{
					$output .= '<img src="img/x.gif" class="building '.($t == 39 ? '16' : $imageBuild).' ' . $tribeCss . '">';
				}
			}else{

				$output .= '<img src="img/x.gif" class="building '.($t == 39 ? 'g16' : $imageBuild).' ' . $tribeCss . '">';
			}
			// get SVG
			if($t == 39 OR $t == 40){
				switch($t){
					case 39:
					$buildId = 16;
					break;

					case 40:
					if ($village->resarray['f' . ($t) . 't'] != 0) {
						// if have a wall
						$buildId = 3 .$session->tribe;
						$isWall = TRUE;
					}else{
						$buildId = 'wall';
					}
					break;
				}

			}else{
				$buildId = $village->resarray['f' . ($t) . 't'];
			}
			$output .= $Travian->getSVG($buildId, $t, $isWall);
			$output .= '</div>';
		}

        ?>
    <?php
	}
	echo $output;
    }

?>
<img id="lswitch" class="lswitchMinus" src="img/x.gif" alt="" onclick="window.location.href='build.php?id=40&amp;fastUP=0'">

</div>
<div class="clear">&nbsp;</div>
<script>


       window.addEvent('domready', function () {
		var b = $$(".a40 svg");
		var a = $$(b.getElements("path"));

		a.addEvents({
          'mouseenter': function() { b.addClass('hover'); },
          'mouseleave': function() { b.removeClass('hover'); },
          'mousedown touchstart': function() {b.addClass("active"); },
          'mouseup mouseleave blur touchend': function() {b.removeClass("active"); }
        });

	});
    </script>
