<?php
if(!isset($aid)) {
    $aid = $session->alliance;
}
$allianceinfo = $database->getAlliance($aid);
//echo "<h1>".$database->RemoveXSS($allianceinfo['tag'])." - ".$database->RemoveXSS($allianceinfo['name'])."</h1>";
include("alli_menu.php");
?>
<h4 class="round"><?php echo ALLIANCE8; ?></h4>
<p class="option"><?php echo ALLIANCE12; ?></p>

<form method="POST" action="allianz.php">
<input type="hidden" name="a" value="11">
<input type="hidden" name="o" value="11">
<input type="hidden" name="s" value="5">

    <table cellpadding="1" cellspacing="1" class="option quit transparent">
        <tbody>
        <tr>
            <th>
                <?php echo PASSWORD; ?>:					</th>
            <td>
                <input class="pass text" type="password" name="pw" maxlength="20">
            </td>
        </tr>
        </tbody>
    </table>
    <p class="option">
        <button type="submit" value="ok" name="s1" id="btn_ok" class="green">
            <div class="button-container addHoverClick ">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div><div class="button-content"><?= ally7 ?></div>
            </div>
        </button>
    </p>
</form>
<p class="error"><?php echo $form->getError("error"); ?></p>