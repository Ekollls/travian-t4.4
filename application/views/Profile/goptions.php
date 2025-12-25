<form id="settings" action="options.php" method="post">
<input type="hidden" name="ft" value="p5">
<input type="hidden" name="e" value="1">

<style>
div.options #timeSettings label, div.options #advertisement label {
    margin: 6px 0;
    display: block;
}

div.options table.set input.radio {
    position: relative;
    top: 1px;
}</style>
<h4 class="round spacer"><?php echo $lang['Options']['TZ01']; ?></h4>
<table class="transparent set" cellpadding="1" cellspacing="1" id="timeSettings">
		<tbody>
		<tr>
			<td colspan="2"><?php echo $lang['Options']['TZ02']; ?></td>
		</tr>
		<tr>
			<th>
			<?php echo $lang['Options']['TZ03']; ?>:
			</th>
			<td>
				<select name="timezone">
					<optgroup label="local time zones">
						<option value="441"<?php if($session->stime == 441){ echo ' selected="selected"'; } ?>>Canada/Newfoundland</option>
						<option value="99"<?php if($session->stime == 99){ echo ' selected="selected"'; } ?>>Europe/Paris</option>
						<option value="495"<?php if($session->stime == 495){ echo ' selected="selected"'; } ?>>Europe/Berlin</option>
						<option value="496"<?php if($session->stime == 496){ echo ' selected="selected"'; } ?>>Europe/London</option>
						<option value="497"<?php if($session->stime == 497){ echo ' selected="selected"'; } ?>>Asia/Amman</option>
						<option value="570"<?php if($session->stime == 570){ echo ' selected="selected"'; } ?>>Saudi Arabia</option>
						<option value="328"<?php if($session->stime == 328){ echo ' selected="selected"'; } ?>>Asia/Calcutta</option>
						<option value="562"<?php if($session->stime == 562){ echo ' selected="selected"'; } ?>>Australia/ACT</option>
					</optgroup>
					<optgroup label="general time zones">
						<option value="0"<?php if($session->stime == 0){ echo ' selected="selected"'; } ?>>UTC +1</option>
						<option value="1"<?php if($session->stime == 1){ echo ' selected="selected"'; } ?>>UTC +2</option>
						<option value="2"<?php if($session->stime == 2){ echo ' selected="selected"'; } ?>>UTC +3</option>
						<option value="3"<?php if($session->stime == 3){ echo ' selected="selected"'; } ?>>UTC +4</option>
						<option value="4"<?php if($session->stime == 4){ echo ' selected="selected"'; } ?>>UTC +5</option>
						<option value="5"<?php if($session->stime == 5){ echo ' selected="selected"'; } ?>>UTC +6</option>
						<option value="6"<?php if($session->stime == 6){ echo ' selected="selected"'; } ?>>UTC +7</option>
						<option value="7"<?php if($session->stime == 7){ echo ' selected="selected"'; } ?>>UTC +8</option>
						<option value="8"<?php if($session->stime == 8){ echo ' selected="selected"'; } ?>>UTC +9</option>
						<option value="9"<?php if($session->stime == 9){ echo ' selected="selected"'; } ?>>UTC +10</option>
						<option value="10"<?php if($session->stime == 10){ echo ' selected="selected"'; } ?>>UTC +11</option>
						<option value="11"<?php if($session->stime == 11){ echo ' selected="selected"'; } ?>>UTC +12</option>
						<option value="12"<?php if($session->stime == 12){ echo ' selected="selected"'; } ?>>UTC -11</option>
						<option value="13"<?php if($session->stime == 13){ echo ' selected="selected"'; } ?>>UTC -10</option>
						<option value="14"<?php if($session->stime == 14){ echo ' selected="selected"'; } ?>>UTC -9</option>
						<option value="15"<?php if($session->stime == 15){ echo ' selected="selected"'; } ?>>UTC -8</option>
						<option value="16"<?php if($session->stime == 16){ echo ' selected="selected"'; } ?>>UTC -7</option>
						<option value="17"<?php if($session->stime == 17){ echo ' selected="selected"'; } ?>>UTC -6</option>
						<option value="18"<?php if($session->stime == 18){ echo ' selected="selected"'; } ?>>UTC -5</option>
						<option value="19"<?php if($session->stime == 19){ echo ' selected="selected"'; } ?>>UTC -4</option>
						<option value="20"<?php if($session->stime == 20){ echo ' selected="selected"'; } ?>>UTC -3</option>
						<option value="21"<?php if($session->stime == 21){ echo ' selected="selected"'; } ?>>UTC -2</option>
						<option value="22"<?php if($session->stime == 22){ echo ' selected="selected"'; } ?>>UTC -1</option>
						<option value="23"<?php if($session->stime == 23){ echo ' selected="selected"'; } ?>>UTC</option>
					</optgroup>
				</select>
			</td>
		</tr>
		<tr>
			<th class="timeFormat">
				<?php echo $lang['Options']['TZ04']; ?>:
			</th>
			<td>
				<label>
					<input class="radio" type="radio" name="tformat" value="0"<?php if($session->tformat == 0){ echo ' checked="checked"'; } ?>> EU (dd.mm.yy 24h) </label>
				<label>
					<input class="radio" type="radio" name="tformat" value="1"<?php if($session->tformat == 1){ echo ' checked="checked"'; } ?>> US (mm/dd/yy 12h) </label>
				<label>
					<input class="radio" type="radio" name="tformat" value="2"<?php if($session->tformat == 2){ echo ' checked="checked"'; } ?>> UK (dd/mm/yy 12h) </label>
				<label>
					<input class="radio" type="radio" name="tformat" value="3"<?php if($session->tformat == 3){ echo ' checked="checked"'; } ?>> ISO (yy/mm/dd 24h) </label>
			</td>
		</tr>
		</tbody>
	</table>

<h4 class="round spacer"><?php echo $lang['main']['options'][2]; ?></h4>
<table class="transparent set" cellpadding="1" cellspacing="1" id="languageSettings">
		<tbody>
		<tr>
			<th>
			<?php echo $lang['main']['options'][3]; ?>:</th>
			<td>
				<select name="languageNew">
					<option value="en" <?php if($session->lang == 'en'){ echo 'selected="selected"'; } ?>><?php echo $lang['main']['options'][4]; ?></option>
                    <option value="ar" <?php if($session->lang == 'ar'){ echo 'selected="selected"'; } ?>><?php echo $lang['main']['options'][5]; ?></option>
                </select>
			</td>
		</tr>
		</tbody>
	</table>
    <div class="submitButtonContainer">
		<button type="submit" value="save" name="s1" id="btn_ok" class="green disabled" disabled="">
			<div class="button-container addHoverClick">
				<div class="button-background">
					<div class="buttonStart">
						<div class="buttonEnd">
							<div class="buttonMiddle"></div>
						</div>
					</div>
				</div>
				<div class="button-content"><?php echo $lang['main']['options'][6]; ?></div>
			</div>
		</button>
		<script type="text/javascript">
			window.addEvent('domready', function () {
				if ($('btn_ok')) {
					$('btn_ok').addEvent('click', function () {
						window.fireEvent('buttonClicked', [this, {
							"type": "submit",
							"value": "save",
							"name": "s1",
							"id": "btn_ok",
							"class": "green ",
							"title": "",
							"confirm": "",
							"onclick": ""
						}]);
					});
				}
			});
		</script>
	</div>
</form>
    <script type="text/javascript">
	window.addEvent('domready', function () {
		Travian.Form.UnloadHelper.watchHtmlForm($('settings'));

	});
</script>