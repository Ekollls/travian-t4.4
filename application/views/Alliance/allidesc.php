<?php

$aid = $session->alliance;

$varmedal = $database->getProfileMedalAlly($aid);
$allianceinfo = $database->getAlliance($aid);
$memberlist = $database->getAllMember($aid);
$totalpop = 0;
$tag=$database->RemoveXSS($allianceinfo['tag']);
$aname=$database->RemoveXSS($allianceinfo['name']);
foreach($memberlist as $member) {
	$totalpop += $database->getVSumField($member['id'],"pop");
}

//echo "<h1>".$database->RemoveXSS($allianceinfo['tag'])." - ".$database->RemoveXSS($allianceinfo['name'])."</h1>";
include("alli_menu.php");
?>
<h4 class="round"><?=ALLIANCE5?></h4>

<form method="POST" action="allianz.php?ss=5">
<input type="hidden" name="a" value="3">
<input type="hidden" name="o" value="3">
<input type="hidden" name="s" value="5">
    <textarea class="editDescription editDescription1" tabindex="1" name="be1"><?php echo $allianceinfo['desc']; ?></textarea>
    <textarea class="editDescription editDescription2" tabindex="2" name="be2"><?php echo $allianceinfo['notice']; ?></textarea>
    <div class="clear"></div>
    <script type="text/javascript">
        window.addEvent('domready', function()
        {
            if ($('switchMedals'))
            {
                $('switchMedals').addEvent('click', function(e)
                {
                    Travian.toggleSwitch($('medals'), $('switchMedals'));
                });
            }
        });


    </script>
    <div class="switchWrap">
        <div class="openedClosedSwitch switchClosed" id="switchMedals"><?=OVERVIEW35?></div>
        <div class="clear"></div>
    </div>
    <br /><table cellpadding="1" cellspacing="1" id="medals" class="hide">
        <tr>
           			<td><?php echo OVERVIEW36; ?></td>
			<td><?php echo OVERVIEW4; ?></td>
			<td><?php echo OVERVIEW37; ?></td>
			<td>BB-<?php echo OVERVIEW38; ?></td>
		</tr>
				<?php
					$titel=BONUS;
	$days=DNYA;
	foreach($varmedal as $medal) {

	switch ($medal['categorie']) {
    case "1":
        $titel=MEDAL1;
        $titel=$titel." ".$days;
        break;
    case "2":
       $titel=MEDAL2;
        $titel=$titel." ".$days;
        break;
    case "3":
        $titel=MEDAL3;
         $titel=$titel." ".$days;
        break;
    case "4":
        $titel=MEDAL4;
        $titel=$titel." ".$days;
        break;    }
                 echo"<tr>
                   <td> ".$titel."</td>
                   <td>".$medal['plaats']."</td>
                   <td>".$medal['week']."</td>
                   <td>[#".$medal['id']."]</td>
                  </tr>";
                 } ?>
    </table></p>


    <button type="submit" name="s1" id="btn_save" tabindex="3" class="green">
        <div class="button-container addHoverClick ">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div><div class="button-content"><?= SAVE ?></div>
        </div>
    </button>

</form>

<p class="error"><?php echo $form->getError("error"); ?></p>