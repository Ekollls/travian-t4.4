<div class="destination"><div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">
            <table cellpadding="0" cellspacing="0" class="transparent compact">
                <tbody>
                <tr>
                    <td>
                        <span class="or"><?=search4?></span>

                        <?php
                        if(isset($_GET['z'])){
                            $_GET['z']=$database->FilterIntValue($_GET['z']);
                            $coor = $database->getCoor($_GET['z']);
                        }
                        else{
                            $coor['x'] = "";
                            $coor['y'] = "";
                        }
                        ?>
                        <div class="coordinatesInput">
                            <div class="xCoord">
                                <label for="xCoordInput">X:</label>
                                <input class="text" name="x" value="<?php echo $coor['x']; ?>" maxlength="4" type="text">
                            </div>
                            <div class="yCoord">
                                <label for="yCoordInput">Y:</label>
                                <input class="text" name="y" value="<?php echo $coor['y']; ?>" maxlength="4" type="text">
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>	</div>
<div class="option">
    <label>
        <input class="radio" name="c" <?php if (!$checked && $database->getUserInfoByVIDD($z)['id'] != 3) {?> checked="checked" <?php }?>value="2" type="radio" <?php if(($database->isVillageOases($z) || $database->getUserInfoByVIDD($z)['id'] == 3) && !$database->getOasisInfo($z)['conqured']){ echo 'disabled'; } ?>>
        <?=nap0?>
    </label>
    <br>

    <label>
        <input class="radio" name="c" value="3" type="radio" <?php if($database->isVillageOases($z) && !$database->getOasisInfo($z)['conqured']){ echo 'disabled'; } ?>>
        <?=nap1?>
    </label>
    <br>

    <label>
        <input class="radio" name="c" <?php if(isset($_GET['re'])){ echo 'checked="checked"'; } ?> <?php if($database->isVillageOases($z) || $database->getUserInfoByVIDD($z)['id'] == 3){ echo 'checked'; }  ?> <?=$disableN?> value="4" type="radio">
        <?=nap2?>
    </label>

</div>
<?php
if($village->unitarray['u11']>0){
	//if($database->getUserInfoByVIDD($z)['id'] == $session->uid){
    ?>
    <div class="redeployHero">
        <label><input type="checkbox" value="1" name="redeployHero" class="redeployHeroSetting check">Deploy</label> </div>
<?php
	//}
}
?>
<div class="clear"></div>
<button type="submit" value="ok" name="s1" id="btn_ok" class="green ">
    <div class="button-container addHoverClick">
        <div class="button-background">
            <div class="buttonStart">
                <div class="buttonEnd">
                    <div class="buttonMiddle"></div>
                </div>
            </div>
        </div>
        <div class="button-content"><?=JR_CONFIRM?></div></div></button>
<p class="error"><?php echo $form->getError("error"); ?></p>
<div class="clear">&nbsp;</div>