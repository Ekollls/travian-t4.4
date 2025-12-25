<?php
$active = $admin->getUserActive();
?>
<style>
.del {width:12px; height:12px; background-image: url(img/Admin/icon/del.gif);}
</style>
<div class="card">
<div class="card-header"><?php echo $lang['Admin']['online01']; ?> (<?php echo count($active);?>)</div>
<div class="card-body">
<table class="table">
	<tr>
		<td><?php echo $lang['Admin']['players02']; ?></td>
		<td><?php echo $lang['Admin']['players03']; ?></td>
		<td><?php echo $lang['Admin']['players04']; ?></td>
		<td><?php echo $lang['Admin']['players05']; ?></td>
		<td><?php echo $lang['Admin']['players06']; ?></td>
		<td><?php echo $lang['Admin']['players07']; ?></td>
	</tr>
<?php
if($active){

for ($i = 0; $i <= count($active)-1; $i++) {
$uid = $database->getUserField($active[$i]['username'],'id',1);
$varray = $database->getProfileVillages($uid);
$totalpop = 0;

foreach($varray as $vil) {

	$totalpop += $vil['pop'];

}

echo '
	<tr>
		<td><a href="?p=player&uid='.$uid.'">'.$active[$i]['username'].' ['.$active[$i]['access'].']</a></td>
		<td>'.date("d.m.y H:i:s",$active[$i]['timestamp']).'</td>
		<td>'.constant('TRIBE'.$active[$i]['tribe'].'').'</td>
		<td>'.$totalpop.'</td>
		<td>'.count($varray).'</td>
		<td><img src="../img/Admin/gold.gif" class="gold" alt="Gold"/> '.$active[$i]['gold'].'</td>
	</tr>
';

}

}else{

echo '<tr><td  colspan="6" class="hab">'.$lang['Admin']['online02'].'</td></tr>';



}



?>

</table>
</div>