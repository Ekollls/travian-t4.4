<?php

        $artefact = $database->getOwnArtefactInfo2($village->wid);
        $result = count($artefact);


?>

    <table id="near" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <td></td>
                <td><?=sokr11?></td>
                <td><?=sokr14?></td>
                <td><?=sokr15?></td>
            </tr>
        </thead>
        <tbody>
          <?php
                   $arts=$database->geallart();

                   $coarts=count($arts);
        if($coarts == 0) {
        	echo '<td colspan="4" class="none">'.sokr16.'</td>';
        } else {


        	$rows = array();
        	$coor = $village->coor;
            $numeric=0;
            $ids='';
        	foreach($arts as $row) {
                $numeric++;
                if($coarts>$numeric){
                    $ids.=$row['vref'].',';
                }else{ 
                    $ids.=$row['vref'];
                }
            }
        	$xyid=$database->getxyart($ids);
        	foreach($xyid as $xyi){
        		$xy[$xyi['id']]=array('x'=>$xyi['x'],'y'=>$xyi['y']);
        	}

        	foreach($arts as $row) {
        		$coor2 = $xy[$row['vref']];

                $xdistance = ABS($coor['x'] - $coor2['x']);
                if($xdistance > WORLD_MAX) {
                    $xdistance = (2 * WORLD_MAX + 1) - $xdistance;
                }
                $ydistance = ABS($coor['y'] - $coor2['y']);
                if($ydistance > WORLD_MAX) {
                    $ydistance = (2 * WORLD_MAX + 1) - $ydistance;
                }
                $dist = round(SQRT(POW($xdistance,2)+POW($ydistance,2)),1);

                array_push($row,$dist);
        		$rows[$dist] = $row;
            }
            
        	ksort($rows, SORT_DESC);
        	foreach($rows as $row) {

                $wref2 = $row['vref'];

                  $te = $row['type'];
                   $se = $row['size'];
                if($te== 1){
                    $image =  '<img class="artefact_icon_2" src="img/x.gif">';
                }elseif($te== 2){
                    $image =  '<img class="artefact_icon_4" src="img/x.gif">';
                }if($te== 3){
                    $image =  '<img class="artefact_icon_5" src="img/x.gif">';
                }elseif($te== 4){
                    $image =  '<img class="artefact_icon_6" src="img/x.gif">';
                }elseif($te== 5){

                    $image =  '<img class="artefact_icon_8" src="img/x.gif">';
                }elseif($te== 6){
                    $image =  '<img class="artefact_icon_9" src="img/x.gif">';
                }elseif($te== 11){
                    $image =  '<img class="artefact_icon_1" src="img/x.gif">';
                }
                    if($te== 1 AND $se == 1){
                    $name = ART1;
                    $bonus= "(4x) " ;
                    }
                     if($te== 1 AND $se == 2){
                    $name = ART2;
                    $bonus= "(3x) " ;

                    }
                     if($te== 1 AND $se == 3){
                    $name = ART3;
                    $bonus= "(5x) " ;

                    }
                     if($te== 2 AND $se == 1){
                    $name = ART4;
                    $bonus= "(2x) " ;

                    }
                     if($te== 2 AND $se == 2){
                    $name = ART5;
                    $bonus= "(1.5x) " ;

                    }
                     if($te== 2 AND $se == 3){
                    $name = ART6;
                    $bonus= "(3x) " ;

                    }
                     if($te== 3 AND $se == 1){
                    $name = ART7;
                     $bonus= "(5x) " ;

                    }
                     if($te== 3 AND $se == 2){
                    $name = ART8;
                    $bonus= "(3x) " ;

                    }
                     if($te== 3 AND $se == 3){
                    $name = ART9;
                     $bonus= "(10x) " ;

                   }

                     if($te== 5 AND $se == 1){
                    $name = ART10;
                    $bonus= "(50%) " ;

                   }
                     if($te== 5 AND $se == 2){
                    $name = ART11;
                    $bonus= "(25%) " ;

                   }
                     if($te== 5 AND $se == 3){
                    $name = ART12;
                    $bonus= "(50%) " ;

                   }
                     if($te== 6){
                    $name = ART13;
                    $bonus= ART15 ;

                     }

                     if($te== 11 ){
                    $name = ART14;

                    $bonus= ART15 ;

                   }

        		echo '<tr>';
        		echo '<td class="icon">'.$image.'</td>';
        		echo '<td class="nam">';
        		echo '<a href="build.php?id=' . $id . '&show='.$row['id'].'">' . $name . '</a> <span class="bon">' . $bonus . '</span>';
        		echo '<div class="info">';
        		if($row['size'] == 1) {
        			$reqlvl = 10;
        			$effect = sokr1;
        		} elseif($row['size'] == 2 or $row['size'] == 3) {
        			$reqlvl = 20;
        			$effect = pluss11;
        		}
        		echo '<div class="info">'.sokr17.' <b>' . $reqlvl . '</b>, effect  <b>' . $effect . '</b>';
        		echo '</div></td><td class="pla"><a href="karte.php?d=' . $row['vref'] . '&c=' . $generator->getMapCheck($row['vref']) . '">' . $database->getUserField($row['owner'], "username", 0) . '</a></td>';
        		echo '<td class="dist">'.$row[0].'</td>';
        		echo '</tr>';
        	}
        }

?>
        </tbody>
    </table>
