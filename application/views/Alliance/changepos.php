<?php
if(!isset($aid)) {
$aid = $session->alliance;
}
  if($aid==$session->alliance){
$playerData = $database->getAlliPermissions($_POST['a_user'], $session->alliance);
$playername = $database->RemoveXSS($database->getUserField($_POST['a_user'],'username',0));

$allianceinfo = $database->getAlliance($aid);
//echo "<h1>".$database->RemoveXSS($allianceinfo['tag'])." - ".$database->RemoveXSS($allianceinfo['name'])."</h1>";
include("alli_menu.php");
?>
      <h4 class="round"><?php echo ALLIANCE2; ?></h4>
<form method="POST" action="allianz.php?ss=5">
    <table cellpadding="1" cellspacing="1" id="memberAdministration">
        <thead>
        <tr>
            <th><?=NAME?></th>
            <th><img src="img/x.gif" class="allyRight allyRightPosition" alt="Assign" title="Assign"></th>
            <th><img src="img/x.gif" class="allyRight allyRightDisband" alt="Kick" title="Kick"></th>
            <th><img src="img/x.gif" class="allyRight allyRightDescription" alt="Change Description" title="Change Description"></th>
            <th><img src="img/x.gif" class="allyRight allyRightDiplomacy" alt="Alliance Diplomacy" title="Alliance Diplomacy"></th>
            <th><img src="img/x.gif" class="allyRight allyRightMessage" alt="IGMs to the whole alliance" title="IGMs to the whole alliance"></th>
            <th><img src="img/x.gif" class="allyRight allyRightInvite" alt="Invite" title="Invite"></th>
            <th><?=changepos7?></th>
        </tr>
        </thead>

      <tbody>

      <tr>
          <td class="name"><?php echo $playername; ?></td>

          <td class="right"><input class="check" type="checkbox" name="e1" value="1" <?php if ($playerData['opt1']) { echo "checked=checked"; } ?> ></td>

          <td class="right"><input class="check" type="checkbox" name="e2" value="1" <?php if ($playerData['opt2']) { echo "checked=checked"; } ?> ></td>

          <td class="right"><input class="check" type="checkbox" name="e3" value="1" <?php if ($playerData['opt3']) { echo "checked=checked"; } ?> ></td>

          <td class="right"><input class="check" type="checkbox" name="e6" value="1" <?php if ($playerData['opt6']) { echo "checked=checked"; } ?> ></td>

          <td class="right"><input class="check" type="checkbox" name="e7" value="1" <?php if ($playerData['opt7']) { echo "checked=checked"; } ?> ></td>

          <td class="right"><input class="check" type="checkbox" name="e4" value="1" <?php if ($playerData['opt4']) { echo "checked=checked"; } ?> ></td>



          <td class="title"><input class="text" type="text" name="a_titel" value="<?php echo $playerData['rank']; ?>" maxlength="20" /></td>
      </tr>

      </tbody>
  </table>


						<input type="hidden" name="a" value="1">
						<input type="hidden" name="o" value="1">
						<input type="hidden" name="s" value="5">
					  <input type="hidden" name="a_user" value="<?php echo $_POST['a_user']; ?>">
                        <button type="submit" value="ok" name="s1" id="btn_ok" class="green">
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
	<?php }	?>