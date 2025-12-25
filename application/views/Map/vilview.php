<div id="content" class="positionDetails">

<?php
$getd=$d=$_GET['d'];
$basearray = $database->getMInfo($getd);

if($basearray['type_of']!='' && $basearray['oasistype']==0){
    ?>
    <h1 class="titleInHeader"><?=farmlist21?><span class="coordinates coordinatesWrapper">
            <span class="coordinateX"><?php echo "(".$basearray['x'].""; ?></span>
        <span class="coordinatePipe">|</span>
        <span class="coordinateY"><?php echo "".$basearray['y'].")"; ?></span>
<span class="clear">&nbsp;</span></h1>
    <div id="tileDetails" class="landscape landscape-<?=$basearray['type_of']?>">
        <div class="detailImage">
            <div class="options">
                <div class="option"><a href="karte.php?x=<?=$basearray['x']?>&y=<?=$basearray['y']?>" class="a arrow"><?=logint410?>"</a></div>		</div>
        </div>
        <div class="clear"></div>
        <div class="clear"></div>
    </div>
<?php
    die;
}
$topic="";
if($basearray['fieldtype']==0){
    $oasis = $database->getOasisInfo($basearray['id']);
    $uinfo = $database->getUserArray($oasis['owner'],1);
}else{
    $vinfo = $basearray;
    $uinfo = $database->getUserArray($basearray['owner'],1);
}



$tt="";
$toWref = $basearray['id'];

if($session->alliance!=0){
    $what="ntype!=21 and ntype!=20 and ntype!=8 AND ntype!=9 AND ntype!=10 AND ntype!=11 AND ntype!=12 AND ntype!=13 AND ntype!=14 AND ntype!=15 and ntype!=25 and ntype!=26 and ntype!=27 AND ally = ".$session->alliance." AND toWref = ".$toWref." ORDER BY time DESC Limit 5";
    $result = $database->getinfoforndata($what);
}else{
    $what="uid = ".$session->uid." AND toWref = ".$toWref." ORDER BY time DESC Limit 5";
    $result = $result = $database->getinfoforndata($what);
}
$query = count($result);
?>
<h1 class="titleInHeader"><?php if($basearray['fieldtype']!=0){
        echo !$basearray['occupied']?  KAR1 : $basearray['name']; echo " (".$basearray['x']."|".$basearray['y'].")";
    }else{

        if($oasis['type']==88){$oasisname=KARG;}else{
            $oasisname = !$oasis['conqured']? KAR2:KAR3;}


        echo $oasisname; 	?><span class="coordinates coordinatesWrapper">
        <span class="coordinateX"><?php echo "(".$basearray['x'].""; ?></span>
        <span class="coordinatePipe">|</span>
        <span class="coordinateY"><?php echo "".$basearray['y'].")"; ?></span>

        </span><?php
    } if($basearray['occupied'] && $basearray['capital']) { echo " <small><span class=\"a disabled\"><small>(".OVERVIEW20.")</small></span></small>";}?><span class="clear">&nbsp;</span></h1>
<div id="tileDetails" class="village <?php echo ($basearray['fieldtype'] == 0)? 'oasis-'.$map->oasisphoto($basearray['oasistype']) : 'village-'.$basearray['fieldtype'] ?>">

<div class="detailImage">
    <div id="options">
        <div class="option"><a href="karte.php?x=<?php echo $basearray['x']; ?>&y=<?php echo $basearray['y']; ?>" class="a arrow"><?=logint410?></a></div>
        <?php if(!$basearray['occupied']) { ?>
            <div class="option">
                <?php
                $mode = CP;
                $total = count($session->villages);
                $need_cps = ${'cp'.$mode}[$total+1];
                $cps = $session->cp;

                if($cps >= $need_cps) {        $enough_cp = true;
                } else {
                    $enough_cp = false;
                }

                $otext = ($basearray['occupied'] == 1)? ".logint41." : ".logint42.";
                if($village->unitarray['u10'] >= 3 AND $enough_cp) {
                    $test = "<a class=\"a arrow\" href=\"build.php?t=2&id=39&kid=".$getd."&amp;s=1\">".logint411."</a>";
                } elseif($village->unitarray['u10'] >= 3 AND !$enough_cp) {
                    $test = "<span class=\"a arrow disabled\" title=\"(".$cps."/".$need_cps." culture points\">".logint411."</span>";
                } else {
                    $test = "<span class=\"a arrow disabled\">".logint411."</span>";
                }


                $userDataOasis = $database->getUserInfoByVillageID($database->getOasisInfo($getd)['conqured']);

                // iRedux Fix
                $xx=0;
                foreach($session->vvillages as $vil){
                    if($vil['wref'] == $database->getOasisInfo($getd)['conqured']){
                        $xx++;
                    }
                }
                echo ($basearray['fieldtype']==0)? ($village->resarray['f39']==0) ?
                        ($basearray['owner'] == $session->uid)?


                            "<a class=\"a arrow\" target=\"_top\" href=\"build.php?id=39\"> ".KAR9." (".KAR8.")</a>" :
                            "<span class=\"a arrow disabled\"> ".KAR9." (".KAR8.")</span>" :

                        //(!$database->getOasisInfo($getd)['conqured']) ? 
                        "<a class=\"a arrow ".($userDataOasis['protect'] && $xx == 0 && $xx == 0 ? 'disabled' : '')."\" target=\"_top\" ".(!$userDataOasis['protect'] || $xx != 0 ? "href=\"build.php?t=2&id=39&z=".$getd."\"" : '')."> ".($userDataOasis['protect'] && $xx == 0 ? KAR10 : KAR9)." </a>" 
                         :"$test"
            ?>
            </div>
        <?php }
        else if ($basearray['occupied']==1 && $basearray['oasistype']==0 && $basearray['wref'] != $_SESSION['wid']) {
            ?>
            <div class="option">
                <?php

                if($uinfo['access']=='0' || $uinfo['access']=='8' || $uinfo['access']=='9') {
                    echo "<span class=\"a arrow disabled\">".KAR9." (".BAN.")</span>";
                } else if(($uinfo['ptime'] < time() || $uinfo['protect']==0) || $basearray['owner']==$session->uid) {
                    if($session->protection > time() 
                        && $session->uid != $uinfo['id']
                        && $uinfo['id'] != 4
                        && $uinfo['id'] != 3){
                    echo '<span class="a arrow disabled" title="Under the protectors of beginners</span>';
                    }else{
                        echo $village->resarray['f39']? "<a class=\"a arrow\" href=\"build.php?t=2&id=39&z=".$getd."\"> ".KAR9."</a>" : "<span class=\"a arrow disabled\">".KAR9." (".KAR8.")</span>";
                    }
                } else {

                    echo "<span class=\"a arrow disabled\" title=\"player Under the protectors of beginners\">".KAR9."</span>";
                }
                ?>
            </div>
            <div class="option">
                <?php
                if($uinfo['access']=='0' || $uinfo['access']=='8' || $uinfo['access']=='9') {
                    echo "<span class=\"a arrow disabled\"> ".KAR11." (".BAN.")</span>";
                } else {
                    
                    echo $database->getTypeLvlFdata(17,$village->resarray)? "<a class=\"a arrow\" href=\"build.php?z=".$getd."&id=" . $database->getTypeField(17,$village->resarray) . "&t=5\"> ".KAR11."</a>" : "<span class=\"a arrow disabled\"> ".KAR11." (".KAR17.")</span>";
                }
                ?>

            </div>
        <?php }else if ($basearray['occupied']==1 && $basearray['oasistype']!=0 && $basearray['wref'] != $_SESSION['wid']) { ?>

            <div class="option">
                <?php
                //print_r($session);
                //echo $session->protection;
                //if($session->protection > time()){

                //}else{
                    echo $village->resarray['f39']? "<a class=\"a arrow\" href=\"build.php?t=2&id=39&z=".$d."\">Forces.</a>" : "<span class=\"a arrow disabled\" title=\"(Build a rally point)\">".OTPRAV1."</span>";
                //}
                
                ?>
            </div>
        <?php } ?>
        <br>
        <?php if($session->goldclub){ ?>
            <div class="option">
            <?php $fList = $database->queryFetch('SELECT * FROM farmlist WHERE owner = '.$session->uid.''); 
                if($fList['id']){ 
                    if(($uinfo['ptime'] > time() || $uinfo['protect']==1)){
                        echo "<span class=\"a arrow disabled\" title=\"player Under beginner protectors\">Add a farm to the list</span>";
                    }else{
                    ?>
                    <a href="build.php?id=39&t=99&action=showSlot&lid=1&vid=<?php echo $getd; ?>&sort=distance&direction=asc"><span class="a arrow GoldClub">Add a farm to the list</span></a>
                <?php } }else{ ?>
                    <span class="a arrow disabled" title="Create a list of farms first From Rally Point">Add a farm to the list</span></span>
                <?php } ?>

            </div>
        <?php } ?>
        <!-- iRedux -> Programm this later
        <div class="option"><span class="a arrow needGoldClub" id="raidListButtonNoGoldClub">Add a farm to the list</span></div>
        <script type="text/javascript">jQuery(function() { jQuery('#raidListButtonNoGoldClub').click(function () {jQuery(window).trigger('buttonClicked', [event.target, {"goldclubDialog":{"featureKey":"raidList","infoIcon":"http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"}}]);})});</script>
            -->
    </div>
</div>
<div id="map_details">
<?php if($uinfo['id']!=2  && !$basearray['fieldtype'] && $database->getOasisInfo($basearray['id'])['conqured']){ // iRedux - Fixed ?>
    <table cellpadding="1" cellspacing="1" id="distribution" class="transparent">

        <tbody>
        <tr class="first">
            <th><?php echo OVERVIEW5;?></th>
            <td><?=constant('TRIBE'.$uinfo['tribe'])?></td>
        </tr>
        <tr>
            <th><?php echo OVERVIEW6;?></th>
            <?php if($uinfo['alliance'] == 0){
                echo '<td>-</td>';
            } else echo '
			<td><a href="allianz.php?aid='.$uinfo['alliance'].' ">'.$database->RemoveXSS($database->getUserAlliance($oasis['owner'])).'</a></td>'; ?>
        </tr>
        <tr>
            <th><?php echo OVERVIEW1;?></th>
            <td><a href="spieler.php?uid=<?php echo $oasis['owner']; ?>"><?php if($oasis['owner']!=2){echo $database->RemoveXSS($database->getUserField($oasis['owner'],'username',0));}else{ echo "Nature";} ?></a></td>
        </tr>
        <tr>
            <th>Village:</th>
            <td><a href="karte.php?d=<?php echo $oasis['conqured'];?>&c=<?php echo $generator->getMapCheck($oasis['conqured']);?>"><?php echo $database->RemoveXSS($database->getVillageField($oasis['conqured'], "name"));?></a></td>
        </tr>
        </tbody>
    </table>
<?php }?>
<h4><?php if(!$basearray['fieldtype'] && !$basearray['oasistype']){ echo ""; } else { echo logint418; } ?></h4>
<table cellpadding="0" cellspacing="0" id="distribution" class="transparent">
    <tbody>
    <tr>
        <?php
        switch($basearray['fieldtype']) {
            case 1:
                $tt =  "
<td><i class=\"r1\"></i> 3</td>
<td><i class=\"r2\"></i> 3</td>
<td><i class=\"r3\"></i> 3</td>
<td><i class=\"r4\"></i> 9</td>";

                break;
            case 2:
                $tt =  "
<td><i class=\"r1\"></i> 3</td>
<td><i class=\"r2\"></i> 4</td>
<td><i class=\"r3\"></i> 5</td>
<td><i class=\"r4\"></i> 6</td>";
                break;
            case 3:
                $tt =  "
<td><i class=\"r1\"></i> 4</td>
<td><i class=\"r2\"></i> 4</td>
<td><i class=\"r3\"></i> 4</td>
<td><i class=\"r4\"></i> 6</td>";
                break;
            case 4:
                $tt =  "
<td><i class=\"r1\"></i> 4</td>
<td><i class=\"r2\"></i> 5</td>
<td><i class=\"r3\"></i> 3</td>
<td><i class=\"r4\"></i> 6</td>";
                break;
            case 5:
                $tt =  "
<td><i class=\"r1\"></i> 5</td>
<td><i class=\"r2\"></i> 3</td>
<td><i class=\"r3\"></i> 4</td>
<td><i class=\"r4\"></i> 6</td>";
                break;
            case 6:
                $tt = "
<td><i class=\"r1\"></i> 1</td>
<td><i class=\"r2\"></i> 1</td>
<td><i class=\"r3\"></i> 1</td>
<td><i class=\"r4\"></i> 15</td>";
                break;
            case 7:
                $tt =  "
<td><i class=\"r1\"></i> 4</td>
<td><i class=\"r2\"></i> 4</td>
<td><i class=\"r3\"></i> 3</td>
<td><i class=\"r4\"></i> 7</td>";
                break;
            case 8:
                $tt =  "
<td><i class=\"r1\"></i> 3</td>
<td><i class=\"r2\"></i> 4</td>
<td><i class=\"r3\"></i> 4</td>
<td><i class=\"r4\"></i> 7</td>";
                break;
            case 9:
                $tt =  "
<td><i class=\"r1\"></i> 4</td>
<td><i class=\"r2\"></i> 3</td>
<td><i class=\"r3\"></i> 4</td>
<td><i class=\"r4\"></i> 7</td>";
                break;
            case 10:
                $tt =  "
<td><i class=\"r1\"></i> 3</td>
<td><i class=\"r2\"></i> 5</td>
<td><i class=\"r3\"></i> 4</td>
<td><i class=\"r4\"></i> 6</td>";
                break;
            case 11:
                $tt =  "
<td><i class=\"r1\"></i> 4</td>
<td><i class=\"r2\"></i> 3</td>
<td><i class=\"r3\"></i> 5</td>
<td><i class=\"r4\"></i> 6</td>";
                break;
            case 12:
                $tt =  "
<td><i class=\"r1\"></i> 5</td>
<td><i class=\"r2\"></i> 4</td>
<td><i class=\"r3\"></i> 3</td>
<td><i class=\"r4\"></i> 6</td>";
                break;
            case 0:
                switch($basearray['oasistype']) {
                    case 1:
                        $tt =  "
<td class=\"ico\"><i class=\"r1\"></i></td>
<td class=\"val\">25%</td><td class=\"desc\">".LUMBER."</td>";
                        break;
                    case 2:
                        $tt =  "
<td class=\"ico\"><i class=\"r1\"></i></td>
<td class=\"val\">50%</td><td class=\"desc\">".LUMBER."</td>";
                        break;
                    case 3:
                        $tt =  "
<tr><td class=\"ico\"><i class=\"r1\"></i></td>
<td class=\"val\">25%</td><td class=\"desc\">".LUMBER."</td></tr>
<tr><td class=\"ico\"><i class=\"r4\"></i></td>
<td class=\"val\">25%</td><td class=\"desc\">".CROP."</td></tr>";
                        break;
                    case 4:
                        $tt =  "
<td class=\"ico\"><i class=\"r2\"></i></td>
<td class=\"val\">25%</td><td class=\"desc\">".CLAY."</td>";
                        break;
                    case 5:
                        $tt =  "
<td class=\"ico\"><i class=\"r2\"></i></td>
<td class=\"val\">50%</td><td class=\"desc\">".CLAY."</td>";
                        break;
                    case 6:
                        $tt =  "
<tr><td class=\"ico\"><i class=\"r2\"></i></td>
<td class=\"val\">25%</td><td class=\"desc\">".CLAY."</td></tr>
<tr><td class=\"ico\"><i class=\"r4\"></i></td>
<td class=\"val\">25%</td><td class=\"desc\">".CROP."</td></tr>";
                        break;
                    case 7:
                        $tt =  "
<td class=\"ico\"><i class=\"r3\"></i></td>
<td class=\"val\">25%</td><td class=\"desc\">".IRON."</td>";
                        break;
                    case 8:
                        $tt =  "
<td class=\"ico\"><i class=\"r3\"></i></td>
<td class=\"val\">50%</td><td class=\"desc\">".IRON."</td>";
                        break;
                    case 9:
                        $tt =  "
<tr><td class=\"ico\"><i class=\"r3\"></i></td>
<td class=\"val\">25%</td><td class=\"desc\">".IRON."</td></tr>
<tr><td class=\"ico\"><i class=\"r4\"></i></td>
<td class=\"val\">25%</td><td class=\"desc\">".CROP."</td></tr>";
                        break;
                    case 10:
                    case 11:
                        $tt =  "
<td class=\"ico\"><i class=\"r4\"></i></td>
<td class=\"val\">25%</td><td class=\"desc\">".CROP."</td>";
                        break;
                    case 12:
                        $tt =  "
<td class=\"ico\"><i class=\"r4\"></i></td>
<td class=\"val\">50%</td><td class=\"desc\">".CROP."</td>";
                        break;
                }
                break;
        }
        echo $tt;
        ?>
    </tr>
    </tbody>
</table>


<?php  if($basearray['fieldtype'] == 0 && !$oasis['conqured']) {
    ?><br />
    <h4>Units</h4>
    <table cellpadding="0" cellspacing="0" id="troop_info" class="transparent">
        <tbody>
        <?php
        $unit = $database->getUnit($d);

        $unarray = array(31=>U31,U32,U33,U34,U35,U36,U37,U38,U39,U40);
        $a = 0;
        for ($i = 1; $i <= 9; $i++) {
            if($unit['u'.$i]){
                echo '<tr>';
                echo '<td class="ico"><img class="unit u3'.$i.'" src="img/x.gif" alt="" title="" /></td>';
                echo '<td class="val">'.$unit['u'.$i].'</td>';
                echo '<td class="desc">'.constant('U'.($i +30)).'</td>';
                echo '</tr>';
            }else{
                $a = $a+1;
            }
        }
        if($a == 10){
            echo '<tr><td>'.ACC18.'</td></tr>';
        }


        ?>
        </tbody>
    </table>
<?php
}
else if ($basearray['occupied'] && !$basearray['oasistype']){
    ?>
    <h4><?=logint413?></h4>
    <table cellpadding="0" cellspacing="0" id="village_info" class="transparent">
        <tbody>

        <tr class="first">
            <th><?=logint414?></th>
            <td><?=constant('TRIBE'.$uinfo['tribe']) ?></td>
        </tr>
        <tr>
            <th><?=logint415?></th>
            <?php if($uinfo['alliance'] == 0){
                echo '<td>-</td>';
            } else echo '
			<td><a target=\"_top\" href="allianz.php?aid='.$uinfo['alliance'].'">'.$database->getUserAlliance($basearray['owner']).'</a></td>'; ?>
        </tr>
        <tr>
            <th><?=logint416?></th>
            <td><a target="_top" href="spieler.php?uid=<?php echo $basearray['owner']; ?>"><?php echo $uinfo['username']; ?></a></td>
        </tr>
        <tr>
            <th><?=logint417?></th>
            <td><?php echo $basearray['pop']; ?></td>
        </tr>
        </tbody>
    </table>
<?php } ?>

<br />

<h4>Reports</h4>
<table cellpadding="0" cellspacing="0" id="troop_info" class="rep transparent">
    <tbody>
    <?php if($query != 0){
        foreach($result as $row){

            $type = $row['ntype'];
            echo "<tr><td>";
            echo "<img src=\"img/x.gif\" class=\"iReport iReport".$row['ntype']."\" title=\"".$topic."\"> ";
            $date = $generator->procMtime($row['time']);
            echo "<a href=\"berichte.php?id=".$row['id']."\">".$date[0]." ".date('H:i',$row['time'])."</a> ";
            echo "</td></tr>";
        }
    } ?>
    </tbody>

</table>
</div>
</div>
<div class="clear"></div>
</div>
