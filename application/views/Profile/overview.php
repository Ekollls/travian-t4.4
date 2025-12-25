<?php
$uid=$user['id'];

$displayarray = $user;
$ranking->procRankArray();
$varmedal = $database->getProfileMedal($uid);

$profiel="".$displayarray['desc1']."".md5('skJkev3')."".$displayarray['desc2']."";
require("medal.php");
$profiel=explode("".md5("skJkev3")."", $profiel);

$varray = $database->getProfileVillages($uid);

$totalpop = 0;
foreach($varray as $vil) {
	$totalpop += $vil['pop'];
}
?>

<h4 class="round"><?=PROFM1?></h4>
<?php
if($_GET['uid']!=2){
    echo '<img class="heroImage" style="width:160px;height:205px;" src="'.$database->heroBody($uid).'" alt="hero">';
}

?>
<table cellpadding="1" cellspacing="1" id="details" class="transparent">

			<tr>

                <th><?php echo OVERVIEW4; ?></th>
                <td><?php echo $ranking->getUserRank($displayarray['id']); ?></td>
            </tr>
            <tr>
                <th><?php echo OVERVIEW5; ?></th>
                <td><?=constant('TRIBE'.$displayarray['tribe'])?></td>
            </tr>

            <tr>
                <th><?php echo OVERVIEW6; ?></th>
                <td><?php if($displayarray['alliance'] == 0) {
                echo "-";
                }
                else {
                $displayalliance = $database->RemoveXSS($database->getAllianceName($displayarray['alliance']));
                echo "<a href=\"allianz.php?aid=".$displayarray['alliance']."\">".$database->RemoveXSS($displayalliance)."</a>";
                } ?></td>
            </tr>
            <tr>
                <th><?php echo OVERVIEW7; ?></th>
                <td><?php echo count($varray);?></td>

            </tr>
            <?php
			//Date of Birth
            if(isset($displayarray['birthday']) && $displayarray['birthday'] != 0) {
			$age = date('Y') - substr($displayarray['birthday'],0,4);
				if ((date('m') - substr($displayarray['birthday'],5,2)) < 0){$age --;}
				elseif ((date('m') - substr($displayarray['birthday'],5,2)) == 0){
					if(date('d') < substr($displayarray['birthday'],8,2)){$age --;}
				}
            ?><tr><th><?php echo OVERVIEW9; ?></th><td><?php echo $age; ?></td></tr><?php
            }
			//Gender
            if(isset($displayarray['gender']) && $displayarray['gender'] != 0) {
            if($displayarray['gender']== 1){ $gender = OVERVIEW10; }else{ $gender=OVERVIEW11;}
            ?><tr><th><?php echo OVERVIEW12; ?></th><td><?php echo $gender; ?></td></tr><?php
            }
			//Location
            if($displayarray['location'] != "") {
            ?><tr><th><?php echo OVERVIEW13; ?></th><td> <?php echo $database->RemoveXSS($displayarray['location']);?></td></tr>
           <?php }
            ?>
                        <tr>
                <th><?php echo $lang['profile'][2]; ?></th>
                <td><?php echo $ranking->getUserRank($displayarray['id']); ?> <span class="greyInfo">(<?php echo $totalpop; ?> <?php echo $lang['profile'][3]; ?>)</span></td>
            </tr>
            <tr>
                <th><?php echo $lang['profile'][4]; ?></th>
                <td><?php echo $ranking->getUserRankIn($displayarray['id'],1); ?> <span class="greyInfo">(<?php echo $user['apall']; ?>  <?php echo $lang['profile'][5]; ?>)</span></td>
            </tr>
            <tr>
                <th><?php echo $lang['profile'][6]; ?></th>
                <td><?php echo $ranking->getUserRankIn($displayarray['id'],2); ?> <span class="greyInfo">(<?php echo $user['dpall']; ?>  <?php echo $lang['profile'][5]; ?>)</span></td>
            </tr>
            <tr>
                <th><?php echo $lang['profile'][7]; ?></th>
                <td><?php echo $database->getHeroData($displayarray['id'])['level']; ?> <span class="greyInfo">(<?php echo $database->getHeroData($displayarray['id'])['experience']; ?>  <?php echo $lang['profile'][8]; ?>)</span></td>
            </tr>

            <tr>
                <td colspan="2" class="empty"></td>
            </tr>
            
            <tr>
                <?php
                if($uid == $session->uid) {
                    if($session->sit){
                        echo "<td colspan=\"2\"> <span class=\"a arrow disabled\">".OVERVIEW14."</span></td>";
                    }else{
                        echo "<td colspan=\"2\"> <a class=\"arrow\" href=\"spieler.php?s=1\">".OVERVIEW14."</a></td>";
                    }
                } else {
                    if($database->queryFetch('SELECT COUNT(*) AS num FROM `ignore` WHERE `uid` = '.$session->uid.' AND `uignored` = '.$uid.'')['num'] == 0){
                        echo "<td colspan=\"2\" id=\"player_message-ignore-buttons-block\"> <a class=\"message messageStatus messageStatusUnread\" href=\"nachrichten.php?t=1&id=".$_GET['uid']."\">".sendmsg."</a>";
                        echo '<br><br>';
                        echo '<a href id="ignore-player-button" data-player-ignored="false" data-uid="'.$uid.'">'.Ignored02.'.</a>';    
                        echo '</td>';
                    }else{
                        ?>
                        <td colspan="2" id="player_message-ignore-buttons-block"><span class="notice"><?php echo Ignored03; ?></span><br><a href="" id="ignore-player-button" data-player-ignored="true" data-uid="<?php echo $uid; ?>">Stop ignoring this player.</a></td>
                        <?php
                    }
                }
                ?>
            </tr>
            
            </table>


            <div class="clear"></div>
            <br />

            <h4 class="round"><?=OVERVIEW3?></h4>

            <div class="description description1"><?php echo nl2br($profiel[1]); ?></div>
            <div class="description description2"><?php echo nl2br($profiel[0]); ?></div>

            <div class="clear"></div>
            <h4 class="round"><?php echo OVERVIEW7; ?></h4>

            <style type="text/css">

    .raidList {
        background-position: 0 -130px;
    }

    .warsim {
        background-position: 0 -78px;
    }

    td.buttons {
        padding: 2px 0 2px 2px;
        text-align: left;
        white-space: nowrap;
        width: 1%;
    }
</style>            
            <table cellpadding="1" cellspacing="1" id="villages">
    <thead>
    <tr>
        <th class="name"><?php echo OVERVIEW17; ?></th>
        <th><?=FINDER12?></th>
        <th class="inhabitants"><?php echo OVERVIEW18; ?></th>
        <th class="coords"><?php echo OVERVIEW19; ?></th>
        <!--<th class="buttons"></th>-->
    </tr>
    </thead><tbody>
    <?php
    $name = 0;
    foreach($varray as $vil) {        
        $oasis=$database->getOasis($vil['wref']);

        $imgs="";
        foreach($oasis as $o){
        switch($o['type']) {
            case 1:
                $tt =  '<i class="r1"></i>';
                break;
            case 2:
                $tt =  '<i class="r1"></i>';
                break;
            case 3:
                $tt =  '<i class="r1"></i><i class="r4"></i>';
                break;
            case 4:
                $tt =  '<i class="r2"></i>';
                break;
            case 5:
                $tt =  '<i class="r2"></i>';
                break;
            case 6:
                $tt =  '<i class="r2"></i><i class="r4"></i>';
                break;
            case 7:
                $tt =  '<i class="r3"></i>';
                break;
            case 8:
                $tt =  '<i class="r3"></i>';
                break;
            case 9:
                $tt =  '<i class="r3"></i><i class="r4"></i>';
                break;
            case 10:
            case 11:
                $tt =  '<i class="r4"></i>';
                break;
            case 12:
                $tt =  '<i class="r4"></i>';
                break;
        }
            $imgs.=$tt;
        }
    $capital= OVERVIEW20;
    	echo "<tr><td class=\"name\"><a href='karte.php?d=".$vil['wref']."'>".$vil['name']."</a>";

        if($vil['capital'] == 1) {
        echo "<span class=\"mainVillage\"> (".$capital.")</span>";
        }
        echo "</td><td class=\"oases\">";
        echo $imgs;
        echo "</td>";
        echo "<td class=\"inhabitants\">".$vil['pop']."</td><td class=\"coords\"><a href=\"karte.php?x=".$vil['vx']."&y=".$vil['vy']."\"><span class=\"coordinates coordinatesWrapper coordinatesAligned coordinatesrtl\"><span class=\"coordinatesWrapper\">";
        echo "<span class=\"coordinates coordinatesWrapper coordinatesAligned coordinatesrtl\"><span class=\"coordinateX\">(".$vil['vx']."</span><span class=\"coordinatePipe\">|</span><span class=\"coordinateY\">".$vil['vy'].")</span><span class=\"clear\">‎</span>
        </td>";
        echo "</tr>";
    $name++;
    }
    ?>
        </tbody></table>

    <script type="text/javascript">
    window.addEvent('domready', function () {
        "use strict";
        var renderPlayerMessageIgnoreButtons = function () {
            var targetPlayer = '<?php echo $uid; ?>';
            Travian.ajax({
                data: {
                    cmd: 'ignoreList',
                    method: 'render_player_message_ignore_buttons',
                    params: {
                        targetPlayer: targetPlayer
                    }
                },

                onSuccess: function (response) {
                    if (response.result !== undefined) {
                        $$('#player_message-ignore-buttons-block').set('html', response.result);
                    }
                }
            });
        };
        $$('#player_message-ignore-buttons-block').addEvent("click:relay('a#ignore-player-button')", function (event) {
            var targetPlayer = $(this).get('data-uid'),
                isIgnored = $(this).get('data-player-ignored') === "false" ? false : true,
                method = isIgnored ? 'stop_ignore_target_player' : 'ignore_target_player';

            event.stop();

            Travian.ajax({
                data: {
                    cmd: 'ignoreList',
                    method: method,
                    renderPlayerMessageIgnoreButtons: true,
                    params: {
                        targetPlayer: targetPlayer
                    }
                },

                onSuccess: function (response) {
                    if (response.result !== undefined) {
                        $$('#player_message-ignore-buttons-block').set('html', response.result);
                    }
                }
            });
        });

        renderPlayerMessageIgnoreButtons();
    });
</script>                        