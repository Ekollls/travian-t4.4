<div id="content"  class="activate">
<h1><img src="img/x.gif" class="anmelden" alt="register for the game"></h1>

<div class="f10">
<?php
		$id = substr($_GET['id'], 0, 40);
		$id = htmlspecialchars($id);?>
<br /><br /><br /><br /><?php echo ACTIV8;?></div>
		<form action="activate.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<input type="hidden" name="ft" value="a3" />
		<table cellpadding="1" cellspacing="1">
			<tr class="top">
				<th><?php echo NICKNAME;?></th>
				<td class="name"><?php 	$naam=$database->getActivateField($id,"username",0); echo $naam; ?></td>
			</tr>
			<tr class="btm">
				<th><?php echo PASSWORD;?></th>
				<td><input class="text" type="password" name="pw" maxlength="20" /></td>
			</tr>
		</table>
		<p class="btn">
			<input type="image" src="img/x.gif" class="dynamic_img" id="btn_delete" alt="delete" value="delete" name="delreports" />
		</p>
		</form>
        </div>