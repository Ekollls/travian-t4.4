<div class="card">
<div class="card-header"><?php echo $lang['Admin']['notregistered01']; ?></div>
<div class="card-body">
<table cellpadding="1" cellspacing="1" class="table">
	<thead>
		<tr>
			<td class="on">#</td>
			<td class="on"><?php echo $lang['Admin']['notregistered02']; ?></td>
			<td class="on"><?php echo $lang['Admin']['notregistered03']; ?></td>
			<td class="on"><?php echo $lang['Admin']['notregistered04']; ?></td>
			<td class="on"><?php echo $lang['Admin']['notregistered05']; ?></td>
			<td class="on"><?php echo $lang['Admin']['notregistered06']; ?></td>
			<td class="on"><?php echo $lang['Admin']['notregistered07']; ?></td>
			<td class="on"><?php echo $lang['Admin']['notregistered08']; ?></td>
		</tr>
	</thead>

	<tbody>
		<?php
			$sql = "SELECT * FROM activate";
			$result = $database->query($sql);
			foreach($result as $row){
				$i++;
				echo "
				<tr>
					<td>".$i."</td>
					<td>".$row['id']."</td>
					<td>".$row['username']."</td>
					<td><a href=\"mailto:".$row['email']."\">".$row['email']."</a></td>
					<td>".constant('TRIBE'.$row['tribe'])."</td>
					<td>".$row['act']."</td>
					<td>".$row['act2']."</td>
					<td class=\"hab\">".date('d:m:Y H:i', $row['timestamp'])."</td>
				</tr>";
			}

		?>

	</tbody>

</table>
</div>