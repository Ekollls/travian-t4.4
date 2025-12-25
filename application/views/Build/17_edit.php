<?php $edited_route = $database->getTradeRoute2($_GET['routeid']); ?>
<form action="build.php" method="post">
		<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">
        <input type="hidden" name="action" value="editRoute">
		<input type="hidden" name="routeid" value="<?php echo $_GET['routeid']; ?>">
			<table cellpadding="1" cellspacing="1" id="npc" class="transparent">
			<thead>
			<tr>
			<th colspan="2"><?=market53?></th>
			</tr>
			</thead>
				<tbody>
				<tr>
					<th>
						<?=market50?>:					</th>
					<td>
                        <img class="r1" src="img/x.gif" alt="Wood" title="Wood"> <input class="text" type="text" name="r1" id="r1" value="<?=$edited_route['wood']?>" maxlength="5" tabindex="1" style="width:50px;">
                        <img class="r2" src="img/x.gif" alt="Clay" title="Clay"> <input class="text" type="text" name="r2" id="r2" value="<?=$edited_route['clay']?>" maxlength="5" tabindex="1" style="width:50px;">
                        <img class="r3" src="img/x.gif" alt="Iron" title="Iron"> <input class="text" type="text" name="r3" id="r3" value="<?=$edited_route['iron']?>" maxlength="5" tabindex="1" style="width:50px;">
                        <img class="r4" src="img/x.gif" alt="Crop" title="Crop"> <input class="text" type="text" name="r4" id="r4" value="<?=$edited_route['crop']?>" maxlength="5" tabindex="1" style="width:50px;">

                    </td>
				</tr>
				<tr>
					<th>
						<?=market51?>:					</th>
					<td>
						<select name="start"><?php for($i=0;$i<=23;$i++){?><option value="<?=$i; ?>" <?php if($i == $edited_route['start']){echo "selected";} ?>><?php if($i > 9){echo $i;}else{echo "0".$i;}?></option><?php } ?></select>
					</td>
				</tr>
				<tr>
					<th>
						<?=market52?>:					</th>
					<td>
						<select name="deliveries"><?php for($i=1;$i<=3;$i++){?><option value="<?php echo $i; ?>" <?php if($i == $edited_route['deliveries']){echo "selected";} ?>><?php echo $i; ?></option><?php } ?></select>
					</td>
				</tr>
			</tbody></table>

			</div>
				</div>

        <button type="submit" value="save" class="green">
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
