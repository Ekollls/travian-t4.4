<?php
$result = $admin->search_village($_POST['s']);

?>
<div class="card">
<div class="card-header"><?=$lang['Admin']['search16'];?> (<?php echo count($result);?>)</div>
<div class="card-body">
<table class="table">
	<thead>
		<tr>
			<td >ID</th>
			<td><?=$lang['Admin']['search17'];?></th>
			<td><?=$lang['Admin']['search18'];?></th>
			<td><?=$lang['Admin']['search19'];?></th>
			<td></th>
		</tr>
	</thead>
	<tbody>
		<?php
			if($result){
				for ($i = 0; $i <= count($result)-1; $i++){
					$delLink = '<a href="?action=delVil&did='.$result[$i]['wref'].'" onClick="return del(\'did\','.$result[$i]['wref'].');"><img src="../img/Admin/del.gif" class="del"></a>';
					echo '
					<tr>
						<td>'.$result[$i]["wref"].'</td>
						<td><a href="?p=village&did='.$result[$i]["wref"].'">'.$result[$i]["name"].'</a></td>
						<td><a href="?p=player&uid='.$result[$i]["owner"].'">'.$database->getUserField($result[$i]["owner"],'username',0).'</a></td>
						<td>'.$result[$i]["pop"].'</td>
						<td>'.$delLink.'</td>
					</tr>';
				}
				echo '
					<tr>
						<td colspan="5"></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="5" style="background-image: url(../../<?php echo GP_LOCATE; ?>img/f/c4.gif);">
							<center>
								<font color="red">'.count($result).'</font> Villages Found "<font color="red">'.$_POST['s'].'</font>"
							</center>
						</td>
					</tr>';
			}else{
				echo '
					<tr>
						<td></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="5" style="background-image: url(../../<?php echo GP_LOCATE; ?>img/f/c4.gif);">
							<center>
								<font color="#9F9F90">No Villages Called</font> <font color="red">'.$_POST['s'].'</font>
							</center>
						</td>
					</tr>';
			}

		?>
	</tfoot>
</table>
</div>