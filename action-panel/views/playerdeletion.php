<?php

$id = $_GET['uid'];



	$user = $database->getUserArray($id,1);

   $time=$user['deleting']-time();

	?>

<table class="table" cellpadding="1" cellspacing="1">

				<tr>

					<td>

						Аккаунт будет удален through<span class="c2"><?php echo  date('H:i:s',$time);?></span>

						<a href="?action=StopDel&uid=<?php echo $user['id'];?>" onClick="return del('stopDel','<?php echo $user['username'];?>');"><img src="img/x.gif" class="del"></a>

					</td>

				</tr>

			</table>