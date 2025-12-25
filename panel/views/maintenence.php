<table class="table" cellpadding="1" cellspacing="1" >

	<thead>

		<tr>

			<th colspan="2">Server Maintenence</th>

		</tr> 

		<tr>

			<td class="on">description</td>

			<td class="hab">Execute</td>

		</tr>

	</thead>

	<tbody> 

		<tr>

			<td class="hab">Close Server for Maintenece, This will ban all players (Access 2) till you can fix bugs, or a crap version of a ceasefire lol</td>

			<td class="hab"><center><a href="index.php?p=maintenenceBan"><img src="http://forum.ragezone.com/f742/img/Admin/b/ok1.gif"></a></center></td>

		</tr>

		<tr>

			<td class="hab">Bring Server Back for Maintenece, This will unban all players (By Banning Reason)</td>

			<td class="hab"><center><a href="index.php?p=maintenenceUnban"><img src="http://forum.ragezone.com/f742/img/Admin/b/ok1.gif"></a></center></td>

		</tr>

		<tr>

			<form action="../application/panel/Mods/mainteneceCleanBanData.php" method="POST">

			<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">

			<td class="hab">Clean Banlist Data (TRUNCATE)</td>

			<td class="hab"><center><input type="image" src="../img/Admin/b/ok1.gif" value="submit"></center></td>

			</form>

		</tr>

	</tbody>

</table>