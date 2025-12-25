<div class="card mb-5">
	<div class="card-header"><?php echo $lang['Admin']['search01']; ?></div>
	<div class="card-body">
	<form action="" method="post">
		<table class="table">
			<tr>
				<td>
					<select name="p" size="1" class="form-control">
						<option value="player" <?php if($_POST['p']=='player'){echo "selected";}?>><?php echo $lang['Admin']['search02']; ?></option>
						<option value="alliances" <?php if($_POST['p']=='alliances'){echo "selected";}?>><?php echo $lang['Admin']['search03']; ?></option>
						<option value="villages" <?php if($_POST['p']=='villages'){echo "selected";}?>><?php echo $lang['Admin']['search04']; ?></option>
						<option value="email" <?php if($_POST['p']=='email'){echo "selected";}?>><?php echo $lang['Admin']['search05']; ?></option>
						<option value="ip" <?php if($_POST['p']=='ip'){echo "selected";}?>><?php echo $lang['Admin']['search06']; ?></option>
						<option value="deleted_players" <?php if($_POST['p']=='deleted_players'){echo "selected";}?>><?php echo $lang['Admin']['search07']; ?></option>
					</select>
				</td>
				<td>
					<input name="s" class="form-control" value="<?php echo $_POST['s'];?>">
				</td>
				<td>
					<button type="submit" class="btn btn-primary">Search</button>
				</td>
			</tr>
		</table>
	</form>

	</div>
</div>
<?php
	if($_GET['msg']){
		echo '<div style="margin-top: 50px;" class="b"><center>';
		if($_GET['msg'] == 'ursdel'){
			echo $lang['Admin']['search08'];
		}
		echo '</center></div>';
	}
?>