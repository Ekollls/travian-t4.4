<form method="post" action="build.php">
<table cellpadding="1" cellspacing="1" id="found" class="transparent">

	<input type="hidden" name="id" value="<?php echo $id ?>">
	<input type="hidden" name="ft" value="ali1">
        <div class="clear"></div>
        <h4 class="round"><?=posl7?></h4>
	<tbody><tr>
		<th><?=posl1?></th>
		<td class="tag">
			<input class="text" name="ally1" value="<?php echo $form->getValue("ally1"); ?>" maxlength="15">
			<span class="error"><?php echo $form->getError("ally1"); ?></span>

		</td>
	</tr>
	<tr>
		<th><?=posl2?></th>
		<td class="nam">
			<input class="text" name="ally2" value="<?php echo $form->getValue("ally2"); ?>" maxlength="50">
			<span class="error"><?php echo $form->getError("ally2"); ?></span>
		</td>

	</tr></tbody>
	</table>
	
	<p>
	<button type="submit" id="btn_ok" name="s1" value="ok" class="green">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?=posl8?></div></div></button>
        </form></p><table cellpadding="1" cellspacing="1" id="join">