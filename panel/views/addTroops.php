<?php



if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$id = $_GET['did'];

if(isset($id))

{

	$village = $database->getVillage($id);

	$user = $database->getUserArray($village['owner'],1);

	$coor = $database->getCoor($village['wref']);

	$varray = $database->getProfileVillages($village['owner']);

	$type = $database->getVillageType($village['wref']);

	$fdata = $database->getResourceLevel($village['wref']);

	$units = $database->getUnit($village['wref']);

		  $tr=($user['tribe']-1);

	  	  if($tr==0){$tr="";}

	?>

<form  method="POST">

<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">

    <input type="hidden" name="action" value="addTroops">

<table class="table">

	<thead>

	<tr>

		<th colspan="2">Modification Forces</th>



	</tr></thead><tbody>

	<tr>

		<td class="addTroops"><img src="../img/Admin/en/u/<?php echo $tr;?>1.gif"></img> </td>

		<td class="addTroops"><input class="addTroops" name="u1" id="u1" value="<?php echo $units['u1']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">available: <b><?php echo $units['u1']; ?></b><font></td>

	</tr>



	<tr>

		<td><img src="../img/Admin/en/u/<?php echo $tr;?>2.gif"></img> </td>

		<td><input class="addTroops" name="u2" id="u2" value="<?php echo $units['u2']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">available: <b><?php echo $units['u2']; ?></b><font></td>

	</tr>



	<tr>

		<td><img src="../img/Admin/en/u/<?php echo $tr;?>3.gif"></img> </td>

		<td><input class="addTroops" name="u3" id="u3" value="<?php echo $units['u3']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">available: <b><?php echo $units['u3']; ?></b><font></td>

	</tr>



	<tr>

		<td><img src="../img/Admin/en/u/<?php echo $tr;?>4.gif"></img> </td>

		<td><input class="addTroops" name="u4" id="u4" value="<?php echo $units['u4']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">available: <b><?php echo $units['u4']; ?></b><font></td>

	</tr>



	<tr>

		<td><img src="../img/Admin/en/u/<?php echo $tr;?>5.gif"></img> </td>

		<td><input class="addTroops" name="u5" id="u5" value="<?php echo $units['u5']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">available: <b><?php echo $units['u5']; ?></b><font></td>

	</tr>



	<tr>

		<td><img src="../img/Admin/en/u/<?php echo $tr;?>6.gif"></img> </td>

		<td><input class="addTroops" name="u6" id="u6" value="<?php echo $units['u6']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">available: <b><?php echo $units['u6']; ?></b><font></td>

	</tr>



	<tr>

		<td><img src="../img/Admin/en/u/<?php echo $tr;?>7.gif"></img> </td>

		<td><input class="addTroops" name="u7" id="u7" value="<?php echo $units['u7']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">available: <b><?php echo $units['u7']; ?></b><font></td>

	</tr>



	<tr>

		<td><img src="../img/Admin/en/u/<?php echo $tr;?>8.gif"></img> </td>

		<td><input class="addTroops" name="u8" id="u8" value="<?php echo $units['u8']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">available: <b><?php echo $units['u8']; ?></b><font></td>

	</tr>



	<tr>

		<td><img src="../img/Admin/en/u/<?php echo $tr;?>9.gif"></img> </td>

		<td><input class="addTroops" name="u9" id="u9" value="<?php echo $units['u9']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">available: <b><?php echo $units['u9']; ?></b><font></td>

	</tr>



	<tr>

		<td><img src="../img/Admin/en/u/<?php echo $tr+1;?>0.gif"></img></td>

		<td><input class="addTroops" name="u10" id="u10" value="<?php echo $units['u10']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">available: <b><?php echo $units['u10']; ?></b><font></td>

	</tr>

		<tr>

		<td><img src="../img/Admin/en/u/hero.gif"></img></td>

		<td><input class="addTroops" name="hero" id="hero" value="<?php echo $units['u11']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">available: <b><?php echo $units['u11']; ?></b><font></td>

	</tr>





	</tbody></table>

	<br />

	<div align="right"><input type="image" border="0" src="../img/Admin/b/ok1.gif">

	</form>

	<?php } ?>

	<br /><br /><div align="right"><?php if(isset($_GET['d'])) { echo '<font color="Red"><b>Troops edited</font></b>';

	} ?>