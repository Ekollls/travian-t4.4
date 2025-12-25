<?php

$id = $_GET['uid'];

if(isset($id))

{

	$player = $database->query("SELECT * FROM users WHERE id = $id");

	?>

	<table cellpadding="1" cellspacing="1" class="table">

		<thead>

			<tr>

				<th colspan="10"><a href="index.php?p=player&uid=<?php echo $player['id']; ?>"><?php echo $player['username']; ?></a> Login Log</th>

			</tr>

			<tr>

				<td>Браузер</td>

				<td>Proxy-check</td>

				<td>IP</td>

				<td>Зам</td>

				<td>inремя</td>

			</tr>

		</thead>

		<tbody>

			<?php

				$sql = "SELECT * FROM palevo WHERE `uid` = '$id' and `type` = '0'";

				$result = $database->queryFetch($sql);

				foreach($result as $row)

				{

					echo '

					<tr>

						<td>'.$row['browser'].'</td>

						<td>'.$row['from'].'</td>

						<td>'.$row['infa'].'</td>

						<td>'.$row['sit'].'</td>

						<td>'.date('m.d H:i',$row['time']).'</td>

					</tr>';

				}

			?>

		</tbody>

	</table><?php

}

else

{

	include("404.tpl");

}

?>