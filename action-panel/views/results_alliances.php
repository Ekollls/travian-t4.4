<?php

$result = $admin->search_alliance($_POST['s']);

?>
<div class="card">
<div class="card-header"><?php echo $lang['Admin']['search12']; ?> (<?php echo count($result);?>)</div>
<div class="card-body">
<table class="table">
	<tr>
		<td class="b">AID</td>
		<td class="b"><?php echo $lang['Admin']['search13']; ?></td>
		<td class="b"><?php echo $lang['Admin']['search14']; ?></td>
		<td class="b"><?php echo $lang['Admin']['search15']; ?></td>
	</tr>
<?php

if($result){
for ($i = 0; $i <= count($result)-1; $i++) {
echo '
	<tr>
		<td>'.$result[$i]["id"].'</td>
		<td><a href="?p=alliance&aid='.$result[$i]["id"].'">'.$result[$i]["name"].'</a></td>
		<td><a href="?p=alliance&aid='.$result[$i]["id"].'">'.$result[$i]["tag"].'</a></td>
		<td><a href="?p=player&uid='.$result[$i]["id"].'">'.$database->getUserField($result[$i]["leader"],'username',0).'</a></td>
	</tr>

';

}}

else{

echo '

	<tr>

		<td colspan="4">No results</td>

	</tr>

';

}

?>
</table>
</div>