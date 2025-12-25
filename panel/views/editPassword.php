<?php $user = $database->queryFetch("SELECT * FROM users WHERE id = ".$_GET['uid'].""); ?>
	<form action="../application/panel/Mods/editPassword.php" method="POST">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="uid" id="uid" value="<?php echo $_GET['uid']; ?>">
		<table class="table" cellpadding="1" cellspacing="1" >
			<thead>
				<tr>
					<th colspan="2">player <a href="index.php?p=player&uid=<?php echo $user['id'];?>"><?php echo $user['username'];?></a></th>
				</tr>
				<tr>
					<td></td>
					<td>New word</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>password</th>
					<td>
						<input type="text" style="width: 80%;" class="fm" name="newpw" placeholder="New password">
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						<center>
							<input type="image" value="submit" src="../img/Admin/b/ok1.gif" title="Edit Location">
						</center>
					</td>
				</tr>
			</tbody>
		</table>
	</form>