<?php
$last_pos=0;
if(isset($_GET['del']) && is_numeric($_GET['del'])){
	$database->removeLinks($database->filterIntValue($database->filterVar($_GET['del'])),$session->uid);
	header("Location: spieler.php?s=2");
    exit();
}

// Save new link or just edit a link
if($_POST) {

    $links = array();

    // let's do some complicated code x'D
    foreach($_POST as $key => $value) {
	if(substr($key, 0, 2) == 'nr') {
	    $i = substr($key, 2);
	    $links[$i]['nr'] = $value;
	}

	if(substr($key, 0, 2) == 'id') {
	    $i = substr($key, 2);
	    $links[$i]['id'] = $value;
	}

	if(substr($key, 0, 8) == 'linkname') {
	    $i = substr($key, 8);
	    $links[$i]['linkname'] = $database->RemoveXSS($value);
	}

	if(substr($key, 0, 8) == 'linkziel') {
	    $i = substr($key, 8);
	    $links[$i]['linkziel'] = $value;
	}
    }

    // Save
    foreach($links as $link) {
	settype($link['nr'], 'int');

	if(trim($link['nr']) != '' AND trim($link['linkname']) != '' AND trim($link['linkziel']) != '' AND trim($link['id']) == '') {
	    // Add new link

            $p=array("name"=>$link['linkname'],"ziel"=>$link['linkziel'],"nr"=>$link['nr']);
       	    $query = $database->query('INSERT INTO `links` (`userid`, `name`, `url`, `pos`) VALUES (' . $session->uid . ',:name,:ziel,:nr)',$p);

		} elseif(trim($link['nr']) != '' AND trim($link['linkname']) != '' AND trim($link['linkziel']) != '' AND trim($link['id']) != '') {
	    // Update link
	    $query = $database->query('SELECT * FROM `links` WHERE `id` = ' . $link['id']);
	    $data = $query[0];

	    // May the user update this entry?
	    if($data['userid'] == $session->uid) {
	    	$p=array("name"=>$link['linkname'],"ziel"=>$link['linkziel'],"nr"=>$link['nr']);
		$database->query('UPDATE `links` SET `name` = :name, `url` = :ziel, `pos` = :nr WHERE `id` = ' . $link['id'].'',$p);
	    }
	} elseif(trim($link['nr']) == '' AND trim($link['linkname']) == '' AND trim($link['linkziel']) == '' AND trim($link['id']) != '') {
	    // Delete entry
	    $query = $database->query('SELECT * FROM `links` WHERE `id` = ' . $link['id']);
	    $data = $query[0];

	    // May the user delete this entry?
	    if($data['userid'] == $session->uid) {
		$database->query('DELETE FROM `links` WHERE `id` = ' . $link['id']);
	    }
	}
    }

    //print '<meta http-equiv="refresh" content="0">';
}


// Fetch all links
$query = $database->query('SELECT * FROM `links` WHERE `userid` = ' . $session->uid . ' ORDER BY `pos` ASC');
$links = $query;
?>
<div class="boxes boxesColor gray recommendedLinks">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf">
		<div class="switchWrap">
			<div class="openedClosedSwitch switchOpened" id="linkRecommendationsToggle">Recommended links</div>
			<div class="clear"></div>
		</div>
		<div id="linkRecommendations" class="">
        These are links that I found in a From before the number of From Players. Add them to List the Your Own Person Links.			<table class="transparent" cellpadding="1" cellspacing="1" id="recommendedLinks">
				<tbody>
				<tr id="recommendedLinksRow0">
                    <td class="nr">
                        <input class="text" type="text" name="nr" value="0" size="1" maxlength="3" disabled="disabled">
                    </td>
                    <td class="nam">
                        <input class="text" type="text" name="linkname" value="questions" maxlength="30" disabled="disabled">
                    </td>
                    <td class="link">
                        <input class="text" type="text" name="linkziel" value="http://t4.answers.travian.com/?lang=ae" maxlength="255" disabled="disabled">
                    </td>
                    <td class="add">
                        <button type="button" class="addElement " onclick="takeOverRecommendedLink('0')"></button>
                    </td>
                </tr><tr id="recommendedLinksRow1">
                    <td class="nr">
                        <input class="text" type="text" name="nr" value="0" size="1" maxlength="3" disabled="disabled">
                    </td>
                    <td class="nam">
                        <input class="text" type="text" name="linkname" value="Overview on village" maxlength="30" disabled="disabled">
                    </td>
                    <td class="link">
                        <input class="text" type="text" name="linkziel" value="dorf3.php?s=0" maxlength="255" disabled="disabled">
                    </td>
                    <td class="add">
                        <button type="button" class="addElement " onclick="takeOverRecommendedLink('1')"></button>
                    </td>
                </tr><tr id="recommendedLinksRow2">
                    <td class="nr">
                        <input class="text" type="text" name="nr" value="0" size="1" maxlength="3" disabled="disabled">
                    </td>
                    <td class="nam">
                        <input class="text" type="text" name="linkname" value="Overview on Warehouses" maxlength="30" disabled="disabled">
                    </td>
                    <td class="link">
                        <input class="text" type="text" name="linkziel" value="dorf3.php?s=3" maxlength="255" disabled="disabled">
                    </td>
                    <td class="add">
                        <button type="button" class="addElement " onclick="takeOverRecommendedLink('2')"></button>
                    </td>
                </tr><tr id="recommendedLinksRow3">
                    <td class="nr">
                        <input class="text" type="text" name="nr" value="0" size="1" maxlength="3" disabled="disabled">
                    </td>
                    <td class="nam">
                        <input class="text" type="text" name="linkname" value="Reports alliance" maxlength="30" disabled="disabled">
                    </td>
                    <td class="link">
                        <input class="text" type="text" name="linkziel" value="allianz.php?s=3" maxlength="255" disabled="disabled">
                    </td>
                    <td class="add">
                        <button type="button" class="addElement " onclick="takeOverRecommendedLink('3')"></button>
                    </td>
                </tr><tr id="recommendedLinksRow4">
                    <td class="nr">
                        <input class="text" type="text" name="nr" value="0" size="1" maxlength="3" disabled="disabled">
                    </td>
                    <td class="nam">
                        <input class="text" type="text" name="linkname" value="Nearby villages" maxlength="30" disabled="disabled">
                    </td>
                    <td class="link">
                        <input class="text" type="text" name="linkziel" value="reports.php?t=5" maxlength="255" disabled="disabled">
                    </td>
                    <td class="add">
                        <button type="button" class="addElement " onclick="takeOverRecommendedLink('4')"></button>
                    </td>
                </tr><tr id="recommendedLinksRow5">
                    <td class="nr">
                        <input class="text" type="text" name="nr" value="0" size="1" maxlength="3" disabled="disabled">
                    </td>
                    <td class="nam">
                        <input class="text" type="text" name="linkname" value="the memories" maxlength="30" disabled="disabled">
                    </td>
                    <td class="link">
                        <input class="text" type="text" name="linkziel" value="options.php" maxlength="255" disabled="disabled">
                    </td>
                    <td class="add">
                        <button type="button" class="addElement " onclick="takeOverRecommendedLink('5')"></button>
                    </td>
                </tr>				</tbody>
			</table>
		</div>
	</div>
</div>
<h4 class="round spacer"><?php echo LINK1; ?></h4>
<form action="spieler.php?s=2" id="settings" method="POST">
  <input type="hidden" name="ft" value="p2">
  <input type="hidden" name="uid" value="<?php echo $session->uid; ?>" />
    <table class="transparent" cellpadding="1" cellspacing="1" id="links">
    <thead>

      <tr>
	<td><img class="del" src="img/x.gif" alt="delete" title="delete" /></td>
	<td>№</td>
	<td><?php echo OVERVIEW17; ?></td>
	<td><?php echo LINK2; ?></td>
      </tr>
    </thead>
    <tbody>
	  <?php $i = 0; foreach($links as $link): ?>
      <tr>
	  <td>
	  <a href="spieler.php?del=<?php echo $link['id']; ?>&s=2"><img class="del" src="img/x.gif" alt="delete" title="delete"></a>
	  </td>
	 <td class="nr"><input <?php if(!$session->plus){echo"disabled";} ?> class="text" type="text" name="nr<?php print $i; ?>" value="<?php print $database->RemoveXSS($link['pos']); ?>" size="1" maxlength="3" /><input type="hidden" name="id<?php print $i; ?>" value="<?php print $link['id']; ?>" /></td>
	 <td class="nam"><input <?php if(!$session->plus){echo"disabled";} ?> class="text" type="text" name="linkname<?php print $i; ?>" value="<?php print $database->RemoveXSS($link['name']); ?>" maxlength="30" /></td>
	 <td class="link"><input <?php if(!$session->plus){echo"disabled";} ?> class="text" type="text" name="linkziel<?php print $i; ?>" value="<?php print $database->RemoveXSS($link['url']); ?>" maxlength="255" /></td>
      </tr>
      <?php ++$i; $last_pos = $link['pos']; endforeach; ?>
      <tr>
	<td></td>
	<td class="nr"><input <?php if(!$session->plus){echo"disabled";} ?> class="text" type="text" name="nr<?php print $i; ?>" value="<?php print ($last_pos + 1); ?>" size="1" maxlength="3"></td>
	<td class="nam"><input <?php if(!$session->plus){echo"disabled";} ?> class="text" type="text" name="linkname<?php print $i; ?>" value="" maxlength="30"></td>
	<td class="link"><input <?php if(!$session->plus){echo"disabled";} ?> class="text" type="text" name="linkziel<?php print $i; ?>" value="" maxlength="255"></td>
      </tr>

    </tbody>
  </table>
    <script type="text/javascript">
        window.addEvent('domready', function()
        {
            var lastNumber = <?php print ($last_pos + 1); ?>;
            new Travian.Game.AddLine(
                {
                    entryCount: <?php print ($last_pos + 1); ?>,
                    elements:
                    {
                        table: $('links')
                    },
                    onInsertInputBefore: function(addLine, newInsertElement, newInputElement)
                    {
                        if (newInputElement.name.indexOf('nr<?php print $i; ?>') == 0)
                        {
                            newInputElement.value = ++lastNumber;
                        }
                    }
                });
        });
    </script>
	<div id="hiddenRecommendedLinks">
		<input class="textNr" type="text" name="nrNew[]" value="" size="1" maxlength="3"/>
		<input class="textName" type="text" name="linknameNew[]" value="" maxlength="30"/>
		<input class="textTarget" type="text" name="linkzielNew[]" value="" maxlength="255"/>
		<input type="radio" name="usedRecommended" id="usedRecommended" value="yes"/>
	</div>


    <div class="submitButtonContainer">
        <button type="submit" class="green" name="s1" id="btn_ok">
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
    </div>

    <script type="text/javascript">
		window.addEvent('domready', function () {

			var linkRecommendationsToggle = $('linkRecommendationsToggle');
			if (linkRecommendationsToggle !== null) {
				linkRecommendationsToggle.addEvent('click', function () {
					Travian.toggleSwitch($('linkRecommendations'), linkRecommendationsToggle);
				});
			}
		});

		function takeOverRecommendedLink(linkID) {
			if ($('recommendedLinksRow' + linkID) !== null) {
				// Write the recommended link data in the hidden input fields

				var linkNumber = $$('#recommendedLinksRow' + linkID + ' .nr .text').get('value');
				var linkName = $$('#recommendedLinksRow' + linkID + ' .nam .text').get('value');
				var linkTarget = $$('#recommendedLinksRow' + linkID + ' .link .text').get('value');

				$$('#hiddenRecommendedLinks .textNr').set('value', linkNumber);
				$$('#hiddenRecommendedLinks .textName').set('value', linkName);
				$$('#hiddenRecommendedLinks .textTarget').set('value', linkTarget);

				// Set the usedRecommended parameter

				$('usedRecommended').set('checked', 'checked');

				// Submit the form to save the changes

				$('settings').submit();
			}
		}
	</script>

</form>
