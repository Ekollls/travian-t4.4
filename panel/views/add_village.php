
<style>

	.del {width:12px; height:12px; background-image: url(img/Admin/icon/del.gif);}

</style>

<form method="post" action="index.php">

	<input name="action" type="hidden" value="addVillage">

	<input name="uid" type="hidden" value="<?php echo $user['id'];?>">

	<table class="table" style="width: 125px;">

		<thead>

			<tr>

				<th colspan="2">add village</th>

			</tr>

		</thead>

		<tbody>

			<tr>

				<td colspan="2"><center>Events (<b>X</b>|<b>Y</b>)</center></td>

			</tr>

			<tr>

				<td>X:</td>

				<td><input name="x" class="fm" value="" type="input"></td>

			</tr>

			<tr>

				<td>Y:</td>

				<td><input name="y" class="fm" value="" type="input"></td>

			</tr>

			<tr>

				<td colspan="2"><center><input type="image" src="../img/Admin/b/ok1.gif" value="Add Village"></center></td>

			</tr>

		</tbody>

	</table>

</form>