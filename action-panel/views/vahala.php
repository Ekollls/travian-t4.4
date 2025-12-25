<?php 
    if(isset($_POST['vahala'])){
		include("../../application/config.php");
		$stmt=$baglanDB->prepare("SELECT * FROM `wdata` where x=? and y=?  LIMIT 1");
		$stmt->execute([1,2]);
		$vaha=$stmt->fetch(PDO::FETCH_ASSOC);
		$stmt=$baglanDB->prepare("UPDATE `wdata` SET `fieldtype` = '0', `oasistype` = '6', `occupied` = '0', `image` = 'o12', `oasisimg` = '0', `partimg` = '0_0', `adv` = '0', `type_of` = 'lake' WHERE `wdata`.`id` =?");
		$stmt->execute([$vaha['id']]);
		$cek=$baglanDB->prepare("SELECT * FROM `units` where vref=?  LIMIT 1");
		$cek->execute([$vaha['id']]);
		$cek=$cek->fetch(PDO::FETCH_ASSOC);
		$numberOfAnimal = 999888999777;
		if($cek){
			$stmt=$baglanDB->prepare("UPDATE units SET u1 = ?, u2 = ?, u3 = ?, u4 = ?, u5 = ?, u6 = ?, u7 = ?, u8 = ?, u9 = ?, u10 = ? WHERE vref=?");
			$stmt->execute([$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$vaha['id']]);
		}else{
			$stmt=$baglanDB->prepare("INSERT INTO `units` (`vref`, `u1`, `u2`, `u3`, `u4`, `u5`, `u6`, `u7`, `u8`, `u9`, `u10`, `u11`, `u99`, `o99`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0, 0)");
			$stmt->execute([$vaha['id'],$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal,$numberOfAnimal]);
		}
		$cek=$baglanDB->prepare("SELECT * FROM `odata` where wref=?  LIMIT 1");
		$cek->execute([$vaha['id']]);
		$cek=$cek->fetch(PDO::FETCH_ASSOC);
		if($cek){
			$stmt1=$baglanDB->prepare("UPDATE odata SET `type` = 12, conqured = 0, wood = 10000, iron = 10000, clay = 10000, maxstore = 1000000, crop = 10000, maxcrop = 10000, lastupdated = ?, loyalty = 2000, owner=4 WHERE wref=?");
			$stmt1->execute([time(),$vaha['id']]);
		}else{
			$sure=time();
			$stmt1=$baglanDB->prepare("INSERT INTO `odata` (`wref`, `type`, `conqured`, `wood`, `iron`, `clay`, `maxstore`, `crop`, `maxcrop`, `lastupdated`, `loyalty`, `owner`) VALUES (?, 12, 0, 10000, 10000, 10000, 1000000, 10000, 10000, $sure, 2000, 4)");
			$stmt1->execute([$vaha['id']]);
		}
		echo "Belirtilen Kordinata Vaha ve Hayvanlar Eklendi.";
    }
?>
<form action="" method="post">
	<div class="form-group text-center">
		<input type="submit" class="btn btn-primary" name="vahala" value="Oluştur">
	</div>
</form>
<br>
