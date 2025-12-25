<?php

$aid = $session->alliance;

$allianceinfo = $database->getAlliance($aid);
$allianceInvitations = $database->getAliInvitations($aid);
//echo "<h1>".$database->RemoveXSS($allianceinfo['tag'])." - ".$database->RemoveXSS($allianceinfo['name'])."</h1>";
include("alli_menu.php");
?>
<h4 class="round"><?php echo ALLIANCE7;?></h4>

<form method="POST" action="allianz.php?ss=5">
<input type="hidden" name="s" value="5">
<input type="hidden" name="o" value="4">
<input type="hidden" name="a" value="4">

    <table cellpadding="1" cellspacing="1" class="option invite transparent">
        <tbody>
<tr><th><?php echo OVERVIEW1;?></th>
<td><input class="name text" type="text" name="a_name" maxlength="20"><span class="error"></span></td>
</tr>
</tbody></table>
    <p class="option">
        <button type="submit" value="ok" name="s1" id="btn_ok" class="green">
            <div class="button-container addHoverClick ">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div><div class="button-content"><?= ally0 ?></div>
            </div>
        </button>
    </p>
</form>
<p class="error"><?php echo $form->getError("error"); ?></p>
<h4 class="round"><?php echo ALLIANCE31;?></h4>
<table cellpadding="1" cellspacing="1" class="option invitations transparent">

<tbody>
<?php
if (count($allianceInvitations) == 0) {
    echo "<tr><td class=noData>".ally1."</td></tr>";
    } else {
 	foreach($allianceInvitations as $invit) {
	$invited = $database->RemoveXSS($database->getUserField($invit['uid'],'username',0));
        echo "<tr><td class=\"abo\">";
        echo "<button type=\"button\" value=\"del\" class=\"icon\" onclick=\"window.location.href = '?o=4&s=5&d=".$invit['id']."'; return false;\"><img class=\"del\" src=\"img/x.gif\" alt=\"Cancel\" title=\"Cancel\" /></button></td><td>";
        echo "<a class=\"a arrow\" href=spieler.php?uid=".$invit['uid'].">".ally2." ".$invited."";
        echo "</td></tr>";
	}
}
?>
</tbody>
</table>