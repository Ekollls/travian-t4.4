<?php


if($_GET['uid'])
{

	$user = $database->getUserArray($_GET['uid'],1);
	$varray = $database->getProfileVillages($_GET['uid']);
	if($user){
		$totalpop = 0;
		foreach($varray as $vil){
			$totalpop += $vil['pop'];
		} ?>


		<style>
			.del {width:12px; height:12px; background-image: url(img/Admin/icon/del.gif);}
		</style>

		<form action="" method="post">
			<input type="hidden" name="action" value="DelPlayer">
			<input type="hidden" name="uid" value="<?php echo $user['id'];?>">
			<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">

			<table class="table">
				<thead>
					<tr>
						<th colspan="4">delete</th>
					</tr>
				</thead>

				<tbody>

					<tr>

						<td>name:</td>
						<td><a href="?p=player&uid=<?php echo $user['id'];?>"><?php echo $user['username'];?></a></td>
						<td>gold:</td>
						<td><?php echo $user['gold'];?></td>

					</tr>

					<tr>
						<td>Arrange:</td>
						<td>???.</td>
						<td>population:</td>
						<td><?php echo $totalpop;?></td>

					</tr>

					<tr>

						<td>:</td>
						<td>
							<?php
								echo $database->queryNumRow("SELECT SQL_CACHE * FROM vdata WHERE owner = ".$user['id']."");
							?>
						</td>

						<td><b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b>:</td>

						<td>

							<?php
							if($user['plus']){
								$plus = date('d.m.Y H:i',$user['plus']);
								echo $plus;

							}else{
								echo '-';
							}
							?>

						</td>

					</tr>
					<tr>
						<td>alliance:</td>
						<td><?php echo $database->getAllianceName($user['alliance']);?></td>
						<td>:</td>
						<td>-</td>
					</tr>
					<tr>
						<td colspan="4" class="empty"></td>
					</tr>
					<tr>
						<td>password:</td>
						<td><input type="text" name="pass"></td>
						<td colspan="2"><input type="submit" class="c5" value="delete player"></td>

					</tr>

				</tbody>

			</table>

			<br /><br /><font color="Red"><b>Important:Data will not be restored after delete!</font></b><br /><br />




		</form>
		
		<?php

	if($_GET['msg'])

	{

		echo '<div style="margin-top: 50px;" class="b"><center>';

		if($_GET['msg'] == 'ursdel')

		{

			echo "Wrong password.";



		}

		

		echo '</center></div>';

	}

?>
		<?php

	}

}

else

{

	include("404.php");

}

?>