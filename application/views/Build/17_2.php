<div class="boxes boxesColor gray traderCount">
    <div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div>
    <div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div>
    <div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>
    <div class="boxes-contents"><?php echo MERCHANTS.' '.$market->merchantAvail().' / '.$market->merchant; ?></div>
</div>
<div class="clear"></div>
<form method="POST" action="build.php">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="ft" value="mk2" />

<table id="sell" cellpadding="1" cellspacing="1">
<tr>
	<th><?=market27?></th>
	<td class="val"><input type="text" class="text" tabindex="1" name="m1" value="" maxlength="6" /></td>
	<td class="res">
		<select name="rid1" tabindex="2" class="dropdown">
			<option value="1" selected="selected"><?php echo $lang['dorf']['D1']; ?></option>
			<option value="2"><?php echo $lang['dorf']['D2']; ?></option>
			<option value="3"><?php echo $lang['dorf']['D3']; ?></option>
			<option value="4"><?php echo $lang['dorf']['D4']; ?></option>
		</select>
	</td>
	<td class="tra"><input class="check" type="checkbox" tabindex="5" name="d1" value="1" /> <?=market29?> <input type="text" class="text" tabindex="6" name="d2" value="2" maxlength="2" /> <?=market30?></td>
</tr>
<tr>
	<th><?=market28?></th>
	<td class="val"><input type="text" class="text" tabindex="3" name="m2" value="" maxlength="6" /></td>
	<td class="res">
		<select name="rid2" tabindex="4" class="dropdown">
			<option value="1"><?php echo $lang['dorf']['D1']; ?></option>
			<option value="2" selected="selected"><?php echo $lang['dorf']['D2']; ?></option>
            <option value="3"><?php echo $lang['dorf']['D3']; ?></option>
            <option value="4"><?php echo $lang['dorf']['D4']; ?></option>
		</select>
	</td>
	<td class="al">
    <?php
    if($session->alliance != 0) {
    echo "<input class=\"check\" type=\"checkbox\" tabindex=\"7\" name=\"ally\" value=\"1\" /> Just to join me";
    }
    ?>
    </td>
</tr>
</table>
    <button type="submit" value="ok" name="s1" id="btn_train" value="ok" class="green">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?=market32?></div>
        </div>
    </button>
</form>

<?php
if(count($market->onmarket) > 0) {
    echo '<h4 class="spacer">Displayed</h4>';
    echo "<table id=\"sell_overview\" cellpadding=\"1\" cellspacing=\"1\">
    <thead><tr><td>&nbsp;</td><td>".market34."</td>
<td>".market35."</td><td>".MERCHANTS."</td><td>".market36."</td><td>".market7."</td></tr></thead><tbody>";
	foreach($market->onmarket as $offer) {

        echo "<tr><td class=\"abo\"><a href=\"build.php?id=$id&t=2&a=".$session->mchecker."&del=".$offer['id']."\"><img class=\"del\"src=\"img/x.gif\" alt=\"Delete\" title=\"Delete\" /></a></td>";
		echo "<td class=\"val\">";

        switch($offer['gtype']) {
        case 1: echo "<i class=\"r1\"></i> "; break;
        case 2: echo "<i class=\"r2\"></i> "; break;
        case 3: echo "<i class=\"r3\"></i> "; break;
        case 4: echo "<i class=\"r4\"></i> "; break;
        }
        echo $offer['gamt'];
        echo "</td><td class=\"val\">";
        switch($offer['wtype']) {
        case 1: echo "<i class=\"r1\"></i> "; break;
        case 2: echo "<i class=\"r2\"></i> "; break;
        case 3: echo "<i class=\"r3\"></i> "; break;
        case 4: echo "<i class=\"r4\"></i> "; break;
        }
        echo $offer['wamt'];
        echo "</td><td class=\"tra\">1</td><td class=\"al\">";
        echo ($offer['alliance'] == 0)? ACC17 : ACC18 ;
        echo "</td><td class=\"dur\">";
        if($offer['maxtime'] != 0) {
        echo $offer['maxtime']/3600;
        echo market37;
        }
        else {
        echo market38;
        }
        echo "</td></tr>";
    }
    echo "</table>";
}

?>
