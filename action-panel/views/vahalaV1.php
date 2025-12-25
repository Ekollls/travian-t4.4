<?php 
    if(isset($_POST['vahala'])){
		include("../../application/config.php");
		$stmt=$baglanDB->prepare("SELECT * FROM `wdata` where x=? and y=?  LIMIT 1");
		$stmt->execute([$_POST['xcor'],$_POST['ycor']]);
		$vaha=$stmt->fetch(PDO::FETCH_ASSOC);
		$stmt=$baglanDB->prepare("UPDATE `wdata` SET `fieldtype` = '0', `oasistype` = '6', `occupied` = '0', `image` = 'o12', `oasisimg` = '0', `partimg` = '0_0', `adv` = '0', `type_of` = 'lake' WHERE `wdata`.`id` =?");
		$stmt->execute([$vaha['id']]);
		$cek=$baglanDB->prepare("SELECT * FROM `units` where vref=?  LIMIT 1");
		$cek->execute([$vaha['id']]);
		$cek=$cek->fetch(PDO::FETCH_ASSOC);
		if($cek){
			$stmt=$baglanDB->prepare("UPDATE units SET u1 = ?, u2 = ?, u3 = ?, u4 = ?, u5 = ?, u6 = ?, u7 = ?, u8 = ?, u9 = ? WHERE vref=?");
			$stmt->execute([$_POST['u1'],$_POST['u2'],$_POST['u3'],$_POST['u4'],$_POST['u5'],$_POST['u6'],$_POST['u7'],$_POST['u8'],$_POST['u9'],$vaha['id']]);
		}else{
			$stmt=$baglanDB->prepare("INSERT INTO `units` (`vref`, `u1`, `u2`, `u3`, `u4`, `u5`, `u6`, `u7`, `u8`, `u9`, `u10`, `u11`, `u99`, `o99`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0, 0, 0)");
			$stmt->execute([$vaha['id'],$_POST['u1'],$_POST['u2'],$_POST['u3'],$_POST['u4'],$_POST['u5'],$_POST['u6'],$_POST['u7'],$_POST['u8'],$_POST['u9']]);
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
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label>X Kordinat</label>
				<input type="number" step="1" name="xcor" class="form-control" placeholder="x" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Y Kordinat</label>
				<input type="number" step="1" name="ycor" class="form-control" placeholder="y" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Sıçan</label>
				<input type="number" step="1" name="u1" class="form-control" placeholder="1" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Örümcek</label>
				<input type="number" step="1" name="u2" class="form-control" placeholder="1" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Yılan</label>
				<input type="number" step="1" name="u3" class="form-control" placeholder="1" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Yarasa</label>
				<input type="number" step="1" name="u4" class="form-control" placeholder="1" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Yaban Domuzu</label>
				<input type="number" step="1" name="u5" class="form-control" placeholder="1" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Kurt</label>
				<input type="number" step="1" name="u6" class="form-control" placeholder="1" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Ayı</label>
				<input type="number" step="1" name="u7" class="form-control" placeholder="1" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Timsah</label>
				<input type="number" step="1" name="u8" class="form-control" placeholder="1" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Kaplan</label>
				<input type="number" step="1" name="u9" class="form-control" placeholder="1" required>
			</div>
		</div>
	</div>
	<div class="form-group text-center">
		<input type="submit" class="btn btn-primary" name="vahala" value="Oluştur">
	</div>
</form>
<br>
