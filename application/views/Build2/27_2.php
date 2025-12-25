 <table class="show_artefacts" cellpadding="1" cellspacing="1">
    		<thead>
    			<tr>
    				<td></td>
	    			<td><?=sokr11?></td>
	    			<td><?=sokr14?></td>
	    			<td><?=sokr2?></td>
    			</tr>
    		</thead>
    		<tbody>
            <?php
$arts=$database->getOwnArtsizetype(1,"type ASC");
$type=1;
        if(count($arts) == 0) {
        	echo '<td colspan="4" class="none">'.sokr19.'</td>';
        } else {
        	foreach($arts as $row) {
                //if($type<$row['type']){$type=$row['type']; echo "<tr><td colspan=\"4\"></td></tr>";}
                    if($type<$row['type']){
                        $type=$row['type'];
                        ?>
                        </tbody></table>
                        <table class="show_artefacts" cellpadding="1" cellspacing="1">
    		<thead>
    			<tr>
    				<td></td>
	    			<td><?=sokr11?></td>
	    			<td><?=sokr14?></td>
	    			<td><?=sokr2?></td>
                    
    			</tr>
    		</thead>
    		<tbody>
                        <?php
                         //echo "<tr><td colspan=\"4\"></td></tr>";
                        }
                if($type== 1){
                    $image =  '<img class="artefact_icon_2" src="img/x.gif">';
                }elseif($type== 2){
                    $image =  '<img class="artefact_icon_4" src="img/x.gif">';
                }if($type== 3){
                    $image =  '<img class="artefact_icon_5" src="img/x.gif">';
                }elseif($type== 4){
                    $image =  '<img class="artefact_icon_6" src="img/x.gif">';
                }elseif($type== 5){

                    $image =  '<img class="artefact_icon_8" src="img/x.gif">';
                }elseif($type== 6){
                    $image =  '<img class="artefact_icon_9" src="img/x.gif">';
                }elseif($type== 11){
                    $image =  '<img class="artefact_icon_1" src="img/x.gif">';
                }
                   switch($type){
                    case 1:
                    $name = ART1;
                    $bonus= "(4x) " ;
                    break;
                     case 2:
                    $name = ART4;
                    $bonus= "(2x) " ;
                    break;
                     case 3:
                    $name = ART7;
                     $bonus= "(5x) " ;
                      break;
                     case 5:
                    $name = ART10;
                    $bonus= "(50%) " ;
                   break;
                     case 6:
                    $name = ART13;
                    $bonus= ART15 ;
                     break;
                     case 11:
                    $name = ART14;

                    $bonus= ART15 ;
                   break;
                        }

                        $alli="";

                   if($row['owner']==3){ $user=TRIBE5;}else{
                   $ui=$database->getUserforsoc($row['owner']);
                   $user=$ui['username'];
                   if($ui['id']){
                   $alli='<a href="allianz.php?aid='.$ui['id'].'">'.$ui['tag'];
                   }
                   }

        		echo '<tr>';
                echo '<td class="icon">'.$image.'</td>';
        		echo '<td class="nam">';
        		echo '<a href="build.php?id=' . $id . '&show='.$row['id'].'">' . $name . '</a> <span class="bon">' . $bonus . '</span><div class="info">'.sokr17.' <b>10</b>, '.sokr3.' <b>'.sokr1.'</b></div>';
        		echo '</td>';
        		echo '<td class="pla"><a href="karte.php?d=' . $row['vref'] . '&c=' . $generator->getMapCheck($row['vref']) . '">'.$user.'</a></td>';
        		echo  '<td class="al">'.$alli.'</a></td>';
        		echo '</tr>';

        	}
             }
?>
    	</tbody></table>

