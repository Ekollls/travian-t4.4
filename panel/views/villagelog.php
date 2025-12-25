<?php

$id = $_GET['did'];

if(isset($id))

{

	$village = $database->getVillage($id);

	?>

	<br /><br />

	<table class="table">

		<thead>

		<tr>

				<th colspan="5" class="on">in Дереinню</th>

			</tr>

			<tr>

				<td class="on">Откуда</td>

                <td>Дереinо</td>

                <td>Глина</td>

                <td>Железо</td>

                <td>Зерно</td>

			</tr>

		</thead>

			<?php

				$sql = "SELECT * FROM movement WHERE `to` = ".$_GET['did']." and `sort_type`='0' LIMIT 20";

				$result = $database->queryFetch($sql);

				foreach($result as $row)

				{

					$name=$database->getVillageField($row['from'],"name");

					echo '

					<tr>$database->queryFetch

						<td class="on"><a href="?p=village&did='.$row['from'].'">'.$name.'</a></td>

                        <td>'.$row['wood'].'</td>

                        <td>'.$row['clay'].'</td>

                        <td>'.$row['iron'].'</td>

                        <td>'.$row['crop'].'</td>

					</tr>';

				}

			?>

		</thead>

	</table>



		<table class="table">

		<thead>

		<tr>

				<th colspan="5" class="on">Из Дереinни</th>

			</tr>

			<tr>

				<td class="on">Откуда</td>

                <td>Дереinо</td>

                <td>Глина</td>

                <td>Железо</td>

                <td>Зерно</td>

			</tr>

		</thead>

			<?php

				$sql = "SELECT * FROM movement WHERE `from` = ".$_GET['did']." and `sort_type`='0' LIMIT 20";

				$result = $database->queryFetch($sql);

				foreach($result as $row)

				{

					$name=$database->getVillageField($rowt['to'],"name");

					echo '

					<tr>

						<td class="on"><a href="?p=village&did='.$rowt['to'].'">'.$name.'</a></td>

                        <td>'.$rowt['wood'].'</td>

                        <td>'.$rowt['clay'].'</td>

                        <td>'.$rowt['iron'].'</td>

                        <td>'.$rowt['crop'].'</td>

					</tr>';

				}

			?>

		</thead>

	</table>

	<?php

}

else

{

	include("404.php");

}

?>