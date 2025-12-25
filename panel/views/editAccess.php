<?php

if(isset($_POST['uid'])){
	$database->query("UPDATE users SET access = ".$_POST['access']." WHERE id = ".$_POST['uid']."");
	header('Location: index.php?p=editAccess&uid='.$_POST['uid'].'&g');
}
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

	$id = $_SESSION['id'];

	$curaccess = $database->queryFetch("SELECT access FROM users WHERE id = ".$_GET['uid']."");
	$player = $database->queryFetch("SELECT * FROM users WHERE id = ".$id."");
	?>
	<form action="" method="POST">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="uid" id="uid" value="<?php echo $_GET['uid']; ?>">
		<table class="table" style="width:300px;">
			<thead>
				<tr>
					<th colspan="2">Modification <?php echo $player['username']; ?></th>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<center>
							<b></b>
						</center>
					</td>
					<td>
						<center>
							<select name="access" class="dropdown">
								<option value="9" <?php if($curaccess['access'] == 9) { echo 'selected="selected"'; } else { echo ''; } ?>>Admin</option>
								<option value="2" <?php if($curaccess['access'] == 2) { echo 'selected="selected"'; } else { echo ''; } ?>>Player</option>

							</select>
						</center>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<center>
							<input type="image" src="../img/Admin/b/ok1.gif" value="submit" title="Give Players Free Gold">
						</center>

					</td>

				</tr>

			</tbody>

		</table>
	</form><?php
	if(isset($_GET['g']))

	{

		echo '<br /><br /><font color="Red"><b>The properties of a member have changed</font></b>';

	}

?>