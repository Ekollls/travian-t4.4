<form action="build.php?id=<?=$id?>&t=4" method="post">
		<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">
        <input type="hidden" name="action" value="addRoute">
		
			<table cellpadding="1" cellspacing="1" id="npc" class="transparent">
			<thead>
			<tr>
			<th colspan="2"><?=market49?></th>
			</tr>
			</thead>
				<tbody>
				<tr>
					<th>
						<?=market54?>:					</th>
					<td>
						<select id="tvillage" name="tvillage">
<?php

foreach($session->vvillages as $vil) {
    if($vil['wref'] == $village->wid){
    	$select = 'selected="selected"';
    }else{
        $select = '';
    }
	if($vil['wref'] != $village->wid){
		echo "<option value=\"".$vil['wref']."\" ".$select.">".$vil['name']." (".$vil['vx']."|".$vil['vy'].")</option>";
    }
	}
?>						</select>
					</td>
				</tr>
				<tr>
					<th>
						<?=market50?>:					</th>
					<td>
						<img class="r1" src="img/x.gif" alt="Wood" title="Wood"> <input class="text" type="text" name="r1" id="r1" value="0" maxlength="5" tabindex="1" style="width:50px;">
                        <img class="r2" src="img/x.gif" alt="Clay" title="Clay"> <input class="text" type="text" name="r2" id="r2" value="0" maxlength="5" tabindex="1" style="width:50px;">
                        <img class="r3" src="img/x.gif" alt="Iron" title="Iron"> <input class="text" type="text" name="r3" id="r3" value="0" maxlength="5" tabindex="1" style="width:50px;">
                        <img class="r4" src="img/x.gif" alt="Crop" title="Crop"> <input class="text" type="text" name="r4" id="r4" value="0" maxlength="5" tabindex="1" style="width:50px;">

					</td>
				</tr>
				<tr>
					<th>
						<?=market51?>:					</th>
					<td>
						<select name="start"><option value="0" selected="selected">00</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option></select>
					</td>
				</tr>
				<tr>
					<th>
						<?=market52?>:					</th>
					<td>
						<select name="deliveries"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option></select>
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
