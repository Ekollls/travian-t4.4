<?php
$aid = $session->alliance;

$allianceinfo = $database->getAlliance($aid);
//echo "<h1>".$database->RemoveXSS($allianceinfo['tag'])." - ".$database->RemoveXSS($allianceinfo['name'])."</h1>";
include("alli_menu.php");
?>
<h4 class="round"><?php echo ALLIANCE3;?></h4>
<form method="POST" action="allianz.php?ss=5">
<input type="hidden" name="a" value="100">
<input type="hidden" name="o" value="100">
<input type="hidden" name="s" value="5">

    <table cellpadding="1" cellspacing="1" class="option name transparent">
        <tbody><tr>
<th><?php echo NAME; ?></th>
<td><input class="tag text" name="ally1" value="<?php echo $allianceinfo['tag']; ?>" maxlength="8">
</td>
</tr>

<tr>
<th><?php echo OVERVIEW17; ?></th>
<td><input class="name text" name="ally2" value="<?php echo $allianceinfo['name']; ?>" maxlength="25">
</td>
</tr>
        </tbody>
    </table>


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
<p class="error3"><?php echo $form->getError("error"); ?></p>