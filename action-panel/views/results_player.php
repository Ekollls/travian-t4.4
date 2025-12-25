<?php
$result = $admin->search_player($_POST['s']);
?>
<div class="card">
<div class="card-header"><?php echo $lang['Admin']['Player']; ?> (<?php echo count($result);?>)</div>
<div class="card-body">
<table class="table">
	<tr>
		<td class="b">UID</td>
		<td class="b"><?php echo $lang['Admin']['search09']; ?></td>
		<td class="b"><?php echo $lang['Admin']['search10']; ?></td>
		<td class="b"><?php echo $lang['Admin']['search11']; ?></td>
	</tr>
<?php
if($result){
for ($i = 0; $i <= count($result)-1; $i++) {
	$varray = $database->getProfileVillages($result[$i]["id"]);
	$totalpop = 0;
	foreach($varray as $vil) {
		$totalpop += $vil['pop'];
	}
echo '

	<tr>

		<td>'.$result[$i]["id"].'</td>

		<td><a href="?p=player&uid='.$result[$i]["id"].'">'.$result[$i]["username"].'</a></td>

		<td>'.count($varray).'</td>

		<td>'.$totalpop.'</td>

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