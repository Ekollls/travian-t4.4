<?php
if(isset($_GET['u'])) {
$u = $_GET['u'];
}
else {
$u=0;
}

if($session->plus) {
?>
    <div class="boxes boxesColor gray traderCount"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"> <?php echo MERCHANTS.' '.$market->merchant.' / '.$market->merchantAvail(); ?>  </div>
    </div><div class="clear"></div>
    <div class="boxes boxesColor gray search_select"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"><table id="search_select" class="buy_select transparent" cellpadding="1" cellspacing="1">
                <thead>
                <tr>
                    <td colspan="4"><?php echo IMSEARCHING;?></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <button type="button" value="r1Big" title="<?php echo $lang['dorf']['D1']; ?>" <?php if(isset($_GET['s']) && $_GET['s'] == 1) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&s=1<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>'; return false;"><i class="r1"></i></button>
                    </td>
                    <td>
                        <button type="button" value="r2Big" title="<?php echo $lang['dorf']['D2']; ?>" <?php if(isset($_GET['s']) && $_GET['s'] == 2) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&s=2<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>'; return false;"><i class="r2"></i></button>
                    </td>
                    <td>
                        <button type="button" value="r3Big" title="<?php echo $lang['dorf']['D3']; ?>" <?php if(isset($_GET['s']) && $_GET['s'] == 3) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&s=3<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>'; return false;"><i class="r3"></i></button>
                    </td>
                    <td>
                        <button type="button" value="r4Big" title="<?php echo $lang['dorf']['D4']; ?>" <?php if(isset($_GET['s']) && $_GET['s'] == 4) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&s=4<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>'; return false;"><i class="r4"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="boxes boxesColor gray ratio_select"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">
            <table id="ratio_select" class="buy_select transparent" cellpadding="1" cellspacing="1">
                <tbody>
                <tr>
                    <td>
                        <button type="button" value="marketPercentage marketPercentage1_1" <?php if(isset($_GET['v'])) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&v=1:1<?php if(isset($_GET['s'])) echo "&s=".$_GET['s']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>'; return false;">
                            <img src="img/x.gif" class="marketPercentage marketPercentage1_1" alt="marketPercentage marketPercentage1_1"></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="button" value="marketPercentage marketPercentage1_x" <?php if(!isset($_GET['v'])) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1<?php if(isset($_GET['s'])) echo "&s=".$_GET['s']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>'; return false;">
                            <img src="img/x.gif" class="marketPercentage marketPercentage1_x" alt="marketPercentage marketPercentage1_x"></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div></div>

    <div class="boxes boxesColor gray bid_select"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">
            <table id="bid_select" class="buy_select transparent" cellpadding="1" cellspacing="1">
                <thead><tr>
                    <td colspan="4"><?php echo IMOFFERING;?></td>
                </tr></thead>
                <tbody>
                <tr>
                    <td>
                        <button type="button" value="r1Big" title="<?php echo $lang['dorf']['D1']; ?>" <?php if(isset($_GET['b']) && $_GET['b'] == 1) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&b=1<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['s'])) echo "&s=".$_GET['s']; ?>'; return false;">
                            <i class="r1"></i></button>
                    </td>
                    <td>
                        <button type="button" value="r2Big" title="<?php echo $lang['dorf']['D2']; ?>" <?php if(isset($_GET['b']) && $_GET['b'] == 2) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&b=2<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['s'])) echo "&s=".$_GET['s']; ?>'; return false;">
                            <i class="r2"></i></button>
                    </td>
                    <td>
                        <button type="button" value="r3Big" title="<?php echo $lang['dorf']['D3']; ?>" <?php if(isset($_GET['b']) && $_GET['b'] == 3) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&b=3<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['s'])) echo "&s=".$_GET['s']; ?>'; return false;">
                            <i class="r3"></i></button>
                    </td>
                    <td>
                        <button type="button" value="r4Big" title="<?php echo $lang['dorf']['D4']; ?>" <?php if(isset($_GET['b']) && $_GET['b'] == 4) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&b=4<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['s'])) echo "&s=".$_GET['s']; ?>'; return false;">
                            <i class="r4"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div></div>
<?php
}
?>
<div class="clear"></div>
<h4 class="spacer">Offers in a market</h4>

<table id="range" cellpadding="1" cellspacing="1">
<thead>
<tr>
	<td>Show</td>
	<td><?=market4?> <?=market5?></td>
	<td><?=market6?></td>
	<td><?=market7?></td>
	<td><?=market8?></td>
</tr></thead>
<tbody>
<?php

if(count($market->onsale) > 0) {
for($i=0+$u;$i<=40+$u;$i++) {
if(isset($market->onsale[$i])) {
echo "<tr><td class=\"val\">";
$reqMerc = 1;
if($market->onsale[$i]['wamt'] > $market->maxcarry) {
			$reqMerc = round($market->onsale[$i]['wamt']/$market->maxcarry);
			if($market->onsale[$i]['wamt'] > $market->maxcarry*$reqMerc) {
				$reqMerc += 1;
			}
		}
switch($market->onsale[$i]['gtype']) {
    case 1: echo "<i class=\"r1\"></i> "; break;
    case 2: echo "<i class=\"r2\"></i> "; break;
    case 3: echo "<i class=\"r3\"></i> "; break;
    case 4: echo "<i class=\"r4\"></i> "; break;
 	}
    echo $market->onsale[$i]['gamt'];
    echo "</td> <td class=\"val\">";
    switch($market->onsale[$i]['wtype']) {
    case 1: echo "<i class=\"r1\"></i> "; break;
    case 2: echo "<i class=\"r2\"></i> "; break;
    case 3: echo "<i class=\"r3\"></i> "; break;
    case 4: echo "<i class=\"r4\"></i> "; break;
    }
    echo $market->onsale[$i]['wamt'];
    echo "</td><td class=\"pla\" title=\"".$database->getVillageField($market->onsale[$i]['vref'],"name")."\">";
    echo "<a href=\"karte.php?d=".$market->onsale[$i]['vref']."&c=".$generator->getMapCheck($market->onsale[$i]['vref'])."\">".$database->getUserField($database->getVillageField($market->onsale[$i]['vref'],"owner"),"username",0)."</a></td>";
    echo "<td class=\"dur\">".$generator->getTimeFormat($market->onsale[$i]['duration'])."</td>";
    if(($market->onsale[$i]['wtype'] == 1 && $village->awood <= $market->onsale[$i]['wamt']) ||($market->onsale[$i]['wtype'] == 2 && $village->aclay <= $market->onsale[$i]['wamt']) ||($market->onsale[$i]['wtype'] == 3 && $village->airon <= $market->onsale[$i]['wamt']) ||($market->onsale[$i]['wtype'] == 4 && $village->acrop <= $market->onsale[$i]['wamt'])) {
    echo "<td class=\"act none\">".market9."</td></tr>";
    }
    else if($reqMerc > $market->merchantAvail()) {
    echo "<td class=\"act none\">".market10."</td></tr>";
    }
    else {
    echo "<td class=\"act\"><a href=\"build.php?id=".$id."&t=1&a=".$session->mchecker."&g=".$market->onsale[$i]['id']."\"><button type=\"button\" value=\"Upgrade level\" class=\"green small\">
<div class=\"button-container addHoverClick \">
    <div class=\"button-background\">
        <div class=\"buttonStart\">
            <div class=\"buttonEnd\">
                <div class=\"buttonMiddle\"></div>
            </div>
        </div>
    </div><div class=\"button-content\">".market11."</div></div></button></a></td>";
    }
    echo"</tr>";
    }
}
}
else {
echo "<tr><td class=\"none\" colspan=\"5\">".market12."</td></tr>";
}
?>
</tbody>
</table>
<div class="paginator">
<?php
if(!isset($_GET['u']) && count($market->onsale) < 40) {
    echo "<span class=\"none\"><b>&laquo;</b></span><span class=\"none\"><b>&raquo;</b></span>";
    }
    else if (!isset($_GET['u']) && count($market->onsale) > 40) {
    echo "<span class=\"none\"><b>&laquo;</b></span><a href=\"build.php?id=".$id."&t=1&u=40\">&raquo;</a>";
    }
    else if(isset($_GET['u']) && count($market->onsale) > $_GET['u']) {
    	if(count($market->onsale) > ($_GET['u']+40) && $_GET['u']-40 < count($market->onsale) && $_GET['u'] != 0) {
         echo "<a href=\"build.php?id=".$id."&t=1&u=".($_GET['u']-40)."\">&laquo;</a><a href=\"build.php?id=".$id."&t=1&u=".($_GET['u']+40)."\">&raquo;</a>";
         }
         else if(count($market->onsale) > $_GET['u']+40) {
         	echo "<span class=\"none\"><b>&laquo;</b></span><a href=\"build.php?id=".$id."&t=1&u=".($_GET['u']+40)."\">&raquo;</a>";
         }
        else {
        echo "<a href=\"build.php?id=".$id."&t=1&u=".($_GET['u']-40)."\">&laquo;</a><span class=\"none\"><b>&raquo;</b></span>";
        }
    }
?>
</div>
