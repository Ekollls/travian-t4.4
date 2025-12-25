<?php

$ranking->procARankArray();
if(isset($_GET['aid'])) {
$aid = $database->FilterIntValue($database->FilterVar($_GET['aid']));
}
else {
$aid = $session->alliance;
}
$varmedal = $database->getProfileMedalAlly($aid);


$members = $database->getAllMemO($aid);
$totalpop = $members['pop'];
$memberlist = $database->getAllMember($aid);



$profiel="".$allianceinfo['notice']."".md5("skJkev3")."".$allianceinfo['desc']."";
require("medal.php");
$profiel=explode("".md5("skJkev3")."", $profiel);

include("alli_menu.php");

?>
<div id="details">
    <h4 class="round small"><?=ally4?>:</h4>
    <table cellpadding="1" cellspacing="1" class="transparent">
        <tbody>
        <tr>
                <th>TAG:</th>
                <td><?php echo $tag; ?></td>
            </tr>
            <tr>
                <th><?php echo OVERVIEW17; ?>:</th>
                <td><?php echo $aname; ?></td>
            </tr>
                <tr>
                <td colspan="2" class="empty"></td>
            </tr>
            <tr>
                <th><?php echo OVERVIEW4; ?></th>
                <td><?php echo $ranking->getAllianceRank($aid); ?></td>
            </tr>
            <tr>
                <th>Points</th>
                <td><?php echo $totalpop; ?></td>
            </tr>
            <tr>
                <th><?php echo STATISTIC28; ?></th>
                <td><?php echo $members['user']; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<div id="memberTitles">
    <h4 class="round small"><?=ally5?></h4>
    <table cellpadding="1" cellspacing="1" class="transparent">
        <tbody>
                <?php
                foreach($memberlist as $member) {

                //rank name
                $rank = $database->getAlliancePermission($member['id'],"rank",0);

                //username
                $name = $member['username'];

                if(!empty($rank)){
                echo "<tr>";
                echo "<th>".stripslashes($database->RemoveXSS($rank))."</th>";
                echo "<td><a href='spieler.php?uid=".$member['id']."'>".$database->RemoveXSS($name)."</td>";
                echo "</tr>";
                }
				}

			?>
        </tbody>
    </table>
</div>
<div class="contentNavi tabNavi tabFavorSubWrapper">
    <div title="" class="container <?php echo ($_GET['action']  == 'description' || !$_GET['action']) ? 'active' : 'normal'; ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor favorActive favorKeydescription">
            <a id="buttonO7" href="allianz.php?<?php echo ($_GET['aid'] ? 'aid='.$_GET['aid'].'&' : ''); ?>action=description" class="tabItem">
                description <img src="img/x.gif" class="favorIcon" alt="Iron This tab is set as your favorite">
            </a>
        </div>
    </div>

    <script type="text/javascript">
            jQuery('#buttonO7').click(function (event)
            {
                jQuery(window).trigger('tabClicked', [this, {"class":"active","title":false,"target":false,"id":"buttonO7","href":"allianz.php?<?php echo ($_GET['aid'] ? 'aid='.$_GET['aid'].'&' : ''); ?>action=description","onclick":false,"enabled":true,"text":"Description","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"buttonO7"}]);

            });
    </script>

    <div title="" class="container <?php echo $_GET['action']  == 'members' ? 'active' : 'normal'; ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor  favorKeymembers">

            <a id="buttonI8" href="allianz.php?<?php echo ($_GET['aid'] ? 'aid='.$_GET['aid'].'&' : ''); ?>action=members" class="tabItem">
                Players <img src="img/x.gif" class="favorIcon" alt="Iron This tab is set as your favorite">
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if(jQuery('#buttonI8'))
        {
            jQuery('#buttonI8').click(function (event)
            {
                jQuery(window).trigger('tabClicked', [this, {"class":"normal","title":false,"target":false,"id":"buttonI8","href":"allianz.php?<?php echo ($_GET['aid'] ? 'aid='.$_GET['aid'].'&' : ''); ?>action=members","onclick":false,"enabled":true,"text":"Members","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"buttonI8"}]);

            });
        }
    </script>
    <a type="submit" id="nestedTabFavorButton" class="icon nestedTabRowButton" onclick="Travian.ajax({data: {cmd: 'tabFavorite',name: 'allyPageProfile',number: 'description'},onSuccess: function(data) {if (data.success) { jQuery('.tabFavorSubWrapper .favor').removeClass('favorActive');jQuery('.tabFavorSubWrapper .favor.favorKeydescription').addClass('favorActive');}}});return false;"><img src="img/x.gif" class="&nbsp;" alt="&nbsp;"></a>
    <div class="clear"></div>
</div>

<div class="clear"></div>
<?php if($_GET['action']  == 'description' || !$_GET['action']){ ?>
<div class="description description1">
    <?php echo nl2br($profiel[1]); ?>
</div>
<div class="description description2">
    <?php echo nl2br($profiel[0]); ?>
</div>
<?php }else{ ?>

<table cellpadding="1" cellspacing="1" class="allianceMembers">
<tbody>
    <tr>
    <td class="counter"></td>
    <td class="tribe"></td>
    <td><?php echo OVERVIEW1; ?></td>
    <td><?php echo OVERVIEW8; ?></td>
    <td><?php echo Villages; ?></td>
    </tr>
<?php
// Alliance Member list loop
$rank=0;
foreach($memberlist as $member) {

    $rank = $rank+1;
    $TotalUserPop = $database->getVSumField($member['id'],"pop");
    $TotalVillages = $database->getProfileVillages($member['id']);

    echo "<tr>";
    echo '<td class="counter">'.$rank.'.</td>';
    echo '<td class="tribe"><i class="tribe'.$database->getUserInfo($member['id'])['tribe'].'_medium"></i></td>';
    echo "<td class=\"player\">";


    if($aid == $session->alliance){
        if ((time()-600) < $member['timestamp']){ // 0 Min - 10 Min
            echo "<img class='online online1' src=img/x.gif  title='".oweronline0."' alt='".oweronline0."' />";
        }elseif ((time()-86400) < $member['timestamp'] && (time()-600) > $member['timestamp']){ // 10 Min - 1 Days
            echo "<img class='online online2' src=img/x.gif title='".oweronline1."' alt='".oweronline1."' />";
            }elseif ((time()-259200) < $member['timestamp'] && (time()-86400) > $member['timestamp']){ // 1-3 Days
            echo "<img class='online online3' src=img/x.gif title='".oweronline2."' alt='".oweronline2."' />";
        }elseif ((time()-604800) < $member['timestamp'] && (time()-259200) > $member['timestamp']){
            echo "<img class='online online4' src=img/x.gif title='".oweronline3."' alt='".oweronline3."' />";
        }else{
             echo "<img class='online online5' src=img/x.gif title=now online alt=now online />";
        }
    }
    echo " <a href=spieler.php?uid=".$member['id'].">".$database->RemoveXSS($member['username'])."</a>";
    echo "<td class=hab>".$TotalUserPop."</td>";
    echo "<td class=vil>".count($TotalVillages)."</td>";
    echo "</tr>";
}

?>
</tbody>
</table>
<?php } ?>
<div class="clear"></div>
<div class="clear"></div>
