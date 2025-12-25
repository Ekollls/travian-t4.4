<style>

	.del {width:12px; height:12px; background-image: url(img/Admin/icon/del.gif);}

</style>


<div class="card">
	<div class="card-header"><?php echo $lang['Admin']['ban01']; ?></div>
	<div class="card-body">
		<form action="" method="get">
		<input name="action" type="hidden" value="addBan">
		<div class="form-group">
		<label><?php echo $lang['Admin']['ban09']; ?></label>
		<select name="uid" class="form-control">
		<?php foreach($database->query('SELECT username,id FROM users WHERE id > 6') as $user): ?>
			<option value="<?php echo $user['id']; ?>" <?php if($_GET['uid'] == $user['id']){ echo 'selected'; } ?>><?php echo $user['username']; ?></option>
		<?php endforeach; ?>
		</select>
		</div>
		<div class="form-group">
		<label><?php echo $lang['Admin']['ban10']; ?></label>
		<select name="reason" class="form-control">
			<?php
				$arr = array($lang['Admin']['ban02'],$lang['Admin']['ban03'],$lang['Admin']['ban04'],$lang['Admin']['ban05'],$lang['Admin']['ban06'],$lang['Admin']['ban07'],$lang['Admin']['ban02']);
				foreach($arr as $r){
					echo '<option value="'.$r.'">'.$r.'</option>';
				}
			?>
		</select>
		</div>
		<div class="form-group">
		<label><?php echo $lang['Admin']['ban11']; ?></label>
		<select name="time" class="form-control">
			<?php
				$arr = array(1,2,5,10,12);
				foreach($arr as $r){
					echo '<option value="'.($r*3600).'">'.$r.' '.$lang['Admin']['Hour'].'</option>';
				}

				$arr2 = array(1,2,5,10,30,50,90);
				foreach($arr2 as $r){
					echo '<option value="'.($r*3600*24).'">'.$r.' '.$lang['Admin']['Day'].'</option>';
				}
				echo '<option value="">'.$lang['Admin']['Forever'].'</option>';
			?>
			</select>
		</div>
			<button  class="btn btn-primary"><?php echo $lang['Admin']['Confirm']; ?></button>
		</form>
	</div>
</div>




<?php

$bannedUsers = $admin->search_banned();

?>


<div class="card mt-5 mb-5">
<div class="card-header"><?php echo $lang['Admin']['ban12']; ?> (<?php echo count($bannedUsers); ?>)</div>
<div class="card-body">
<table class="table" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td><b><?php echo $lang['Admin']['ban09']; ?></b></td>
			<td><b><?php echo $lang['Admin']['ban13']; ?></b></td>
			<td><b><?php echo $lang['Admin']['ban10']; ?></b></td>
			<td></td>
		</tr>
		</thead>
		<tbody>
		<?php
			if($bannedUsers){
				for ($i = 0; $i <= count($bannedUsers)-1; $i++){
					if($database->getUserField($bannedUsers[$i]['uid'],'username',0)==''){
						$name = $bannedUsers[$i]['name'];
						$link = "<span class=\"c b\">[".$name."]</span>";
					}else{
						$name = $database->getUserField($bannedUsers[$i]['uid'],'username',0);
						$link = '<a href="?p=player&uid='.$bannedUsers[$i]['uid'].'">'.$name.'<a/>';
					}
					if($bannedUsers[$i]['end']){
						$end = date("d.m.y H:i",$bannedUsers[$i]['end']);
					}else{
						$end = '*';
					}
					echo '
					<tr>
						<td>'.$link.'</td>
						<td ><span class="f7">'.date("d.m.y H:i",$bannedUsers[$i]['time']).' - '.$end.'</td>
						<td>'.$bannedUsers[$i]['reason'].'</td>
						<td class="on"><a href="?action=delBan&uid='.$bannedUsers[$i]['uid'].'&id='.$bannedUsers[$i]['id'].'" onClick="return del(\'unban\',\''.$name.'\')"><img src="../img/Admin/del.gif" class="del" title="cancel" alt="cancel"></img></a></td>
					</tr>';
				}
			}else{
				echo '<tr><td colspan="6" class="on">'.$lang['Admin']['ban14'].'</td></tr>';
			}
		?>
	</tbody>
</table>
</div>